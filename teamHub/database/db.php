<?php 

/**
* Provides methods to manipulate the database
*/

class DB extends PDO {

	public function __construct($HOST,$USERNAME,$PASSWORD,$NAME) {

       	try {
       		
       		parent::__construct("mysql:host=$HOST;dbname=$NAME;charset=utf8", $USERNAME, $PASSWORD);
       		$this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       		$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
			
       	} catch (exception $e) {
       	
       		die("<h1 style='font-size: 2.5em;'>Error Establishing Database Connection <b>:/</b> </h1>");
       	
       	}
    }

    /**
	*  	Inserts values into the provided table.
	*	
	*	@param string 	$table 	The table to insert values into
	*	@param array 	$values The values to insert into the table
	*
    */
    public function INSERT($table, $values, $debug = false) {  
		

		// Storing column names in a seperate array.
		$cols = [];

		// These will be the place holders for the prepared statement
		$placeholders = [];
		
		foreach ($values as $key => $value) { 
			array_push($cols, $key);

			array_push($placeholders, ":$key");
		}

		// Converting them to a string
		$placeholders = implode(',', $placeholders);

		// Then the columns and values are imploded with ',' to match the sql syntax
		$cols = implode(",", $cols);

		# Using the created column names and values to insert data in the database. 
		$sql = "INSERT INTO $table ($cols) VALUES ($placeholders)";
	
		$this->QUERY($sql, $values, $debug = $debug);
	}

	public function QUERY($sql, $params = [], $debug = false) {
		
		$statement;

		try {

			$statement = $this->prepare($sql);

			foreach ($params as $key => $value) {
				
				if (strpos($key, ":") !== 0) {
					$key = ":$key";
				}

				$statement->bindValue("$key", $value);	
			}

			if ($debug) $statement->debugDumpParams();

			$statement->execute();

			return $statement;

		} catch (Exception $e) {
			
			if ($debug) $this->echoForDebug($e->getMessage());

			return $statement;
		
		}
		
	}

	function UPDATE($table, $matching_conditions, $new_values) {
		
		$condition_as_sql = implode(" AND ", $matching_conditions);

		$values_as_sql = [];

		foreach ($new_values as $key => $value) {
			array_push($values_as_sql, "`$key`=:$key");
		}
		$values_as_sql = implode(",", $values_as_sql);

		$sql = "UPDATE `$table` SET $values_as_sql WHERE $condition_as_sql";

		$this->QUERY($sql, $new_values);
		
	}

	public function get_last_id($table, $column_name = "id") {
		
		$statement = $this->QUERY("SELECT MAX($column_name) as $column_name FROM $table");

		if($result = $statement->fetch()) {
			return $result->$column_name;
		
		} else {

			return false;
		
		}
	}

	public function get_survey_grading_system($survey_id) {
		$survey = $this->QUERY("SELECT * FROM surveys WHERE id = $survey_id LIMIT 1")->fetch();

		$grading_system_id = $survey->grading_system;

		if ($grading_system_id) {
			$sql = "SELECT * FROM grading_systems WHERE id = $grading_system_id";
			$grading_system_row = $this->QUERY($sql)->fetch();

			$grading_system = explode(",",$grading_system_row->options);

		} else {
			$grading_system = ["100", "75", "50", "25", "0"];
		}

		return $grading_system;
	}
	
	private function echoForDebug($var) {
		echo "<p class=\"debug\">";
		var_dump($var);
		echo "</p>";
	}

	public function tablesNames() {
	
		###	Returns: The names of all the tables in it.
		
		# querying for data.
		$result = $this->query("SHOW TABLES");
		
		$tables = [];

		# Getting all the tables with a loop and appending them to [array: table].
		while($row = $result->fetch(PDO::FETCH_NUM)){
			# row[0] is the name of the table.
			$name = $this->strip_str($row[0]);
			
			array_push($tables, $name);
		}

		return($tables);
	}

	public function strip_str($str) {
		### Takes a string.
		### Returns the same string with dashes and underscores stripped out.
		
		# strrpos returns the position of the underscore.
		# of False if it doesn't exist, 
		# so if it was a number then it evaluates to True in the IF statement
		if (strrpos($str, "-")) {
			$str = implode(" ",explode("-", $str));
		}
		if (strrpos($str, "_")) {
			$str = implode(" ",explode("_", $str));
		}
		return $str;
	}

	function lookupRowId($table, $columnToSearchIn,$searchString) {
		$query = $this->prepare("SELECT id FROM `table` WHERE $columnToSearchIn LIKE '%$searchString%' LIMIT 1");

		$query->execute();

		return $query->fetch();
	}

	function getColumnNames($TABLE_NAME) {
		### Takes: query result like -> "SELECT * FROM table_name."
		### Returns: - names of columns in that table in an array.
		###          - additionaly: it also gets the length of that column.
		###							for <input> use if wanted.
		try {
			$result = $this->query("SELECT * FROM $TABLE_NAME");

		} catch (exception $e) {
			echo "{$e->getMessage()}";
		} 
		
		$columns = [];

		$row = $result->fetch(PDO::FETCH_ASSOC);
		
		foreach ($row as $key => $value) {
			$columns[count($columns)] = $key;
		}	

		return $columns;
	}

	function echoTableOfRecords($sqlQuery, $columnsWanted,$tableIdInDOM, $tableNameInDB = "") {
	## $ColumnsToDisplay is an array 
	## of (column_name => column_name_in_the_DB)

	$query = $this->query($sqlQuery);

	$data = $query->fetchAll();
	?>
	<table class="records" id="<?php echo $tableIdInDOM; ?>">
	<input type="hidden" name="table" value="<?php echo $tableNameInDB ?>">
		<thead>
			<tr>
				<?php 
				foreach ($columnsWanted as $displayCol) {
					echo "<th>$displayCol</th>";
				}
				 ?>
			</tr>
		</thead>
		<tbody>
			<?php 
			foreach ($data as $row) {
				echo "<tr>";
				
				foreach ($columnsWanted as $DbCol => $displayCol) {
					$DbCol = (is_numeric($DbCol)) ? $displayCol : $DbCol;
					echo "<td>".$row->$DbCol."</td>";
				}

				foreach ($row as $column => $value) {
					echo "<input type='hidden' name='$column' value='$value'>";
				}
				echo "</tr>\n";
			}
			 ?>
		</tbody>
	</table>
	<?php
	}
}

?>