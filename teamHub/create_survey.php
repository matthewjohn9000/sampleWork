<?php 
/* Creates A New Survey */

require "app.php";

$page_title = "Create a Survey";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && sizeof($_POST)) {
	
	$errorDiv = "";
	
	$errors = checkFormErrors();

	if ($errors) {
		$errorDiv = "<ul class='form-error'>";
		
		foreach ($errors as $error) {
			
			$errorDiv .= "<li>$error</li>";
			
		}

		$errorDiv .= "</ul>";
	
	} else {

		$status = "published";
		$user_id = $_SESSION['user_info']->id;
		$survey_name = $_POST['survey-name'];
		$grading_system = $_POST['grading-system'];
		$questions = $_POST['questions'];
		$people = $_POST['people'];
		
		$DB->INSERT("surveys", [
			'name'	 		=> $survey_name,
			'author' 		=> $user_id,
			'grading_system'=> $grading_system,
			'status' 		=> $status,
		]);

		$last_survey_id = $DB->get_last_id("surveys");

		foreach ($people as $key => $value) {
			$DB->INSERT("survey_participants", [
				'survey_id'	 =>	$last_survey_id,
				'user_id' => $value,
			]);
		}

		foreach ($questions as $value) {
			// Only insert the question if it has a length
			if (strlen(trim($value)) > 0) {
				$DB->INSERT("questions", [
					'text'	 =>	$value
				]);			

				$last_question_id = $DB->get_last_id("questions");

				$DB->INSERT("survey_questions", [
					'question_id' =>	$last_question_id,
					'survey_id'	  =>	$last_survey_id,
				]);
			}
		}

		header("Location: survey.php?id=$last_survey_id");
	}
}	

PAGE::HEADER($page_title);

?>	
	<link rel="stylesheet" href="css/awesomplete.css" />
	
	<div class="create-survey page">
		<header class="page-title">
			<h1><?php echo $page_title ?></h1>
		</header>
		<div class="content">

			<?php if(isset($errorDiv)) echo $errorDiv;?>
			<form id="main-form" method="post">
				
				<div class="form-group col-sm-6">
				    <label for="survey-name">Survey Name</label>
				    <input value="<?php if (isset($_POST['survey-name'])) echo $_POST['survey-name']; ?>" type="text" class="form-control" id="survey-name" name="survey-name" placeholder="Name">
				</div>
				
				<div class="form-group col-xs-12">
				    <label for="search-participant">Add participants</label>
				    <div class="grey-box col-xs-12 list-box">
					<div class="form-group">
						<label for="search-participant">Search</label>
			    		
			    		<input type="text" class="form-control text-box awesomplete" id="search-participant" placeholder="Student Name" list='mylist'>
			    		
			    		<datalist id="mylist">
			    			<?php 

			    				$users = $QUERY->USERS();

			    				foreach ($users as $user) {
			    					if ($user->id != $_SESSION['user_info']->id) {
								?>
									<option value="<?php echo $user->id; ?>"><?php echo $user->first_name . " " . $user->last_name; ?></option>
			    				<?php	
			    					}
			    				}
			    			 ?>
						</datalist>

			    	</div>
			    	<div class="display-names list-container">

			    	
			    	</div>
			    	<script>
			    		// This Makes the user search box sticky
						window.addEventListener('load', function() {
							<?php
				    		if (isset($_POST['people']) && sizeof($_POST['people'])) { 
				    			$submitted_people = "";
				    			
				    			foreach ($_POST['people'] as $key => $value) {
				    				$person_name = "";
				    				foreach ($users as $user) {
				    					if ($user->id == $value) {
				    						$person_name = $user->first_name . " " . $user->last_name;
				    					} else { continue; }
				    				}
				    				$submitted_people .= "{label: '$person_name', value: '$value'},";
				    			}
				    			echo "var people = [$submitted_people]";
				    			?>

								initAutoComplete(people);

							<?php
							} else { ?>
								initAutoComplete();
					<?php	} ?>
						});
			    	</script>
			    </div>
				</div>
				<div class="form-group col-xs-12 grading-system">
					<label>Grading System</label>
					<div class="radio-slider">
						<input type="radio" name="grading-system" id="percentage-option" value="" <?php if (!isset($_POST['grading-system']) || $_POST['grading-system'] == "") echo "checked" ?>><label for="percentage-option">Percentage</label>
						<input type="radio" name="grading-system" id="letter-option" value="1" <?php if (isset($_POST['grading-system']) && $_POST['grading-system'] == "1") echo "checked" ?>><label for="letter-option">Letter</label>
					</div>
				</div>
				<div class="form-group col-xs-12 questions">
					<label>Questions</label>
					<div class="col-xs-12 grey-box">
						<div id="questions-container">
							<?php 
							if (isset($_POST['questions'])) {
								foreach ($_POST['questions'] as $key =>$question) {
									$question_number = $key + 1;
									?>
								<div class="single-question row">
									<textarea id="question-<?php echo $question_number ?>" name="questions[]"><?php echo $question ?></textarea>
									<label class="question-label" for="question-<?php echo $question_number ?>">Q<?php echo $question_number; ?>:</label>
								</div>
									<?php
								}
							} else {
							 ?>
								<div class="single-question row">
									<textarea id="question-1" name="questions[]"></textarea>
									<label class="question-label" for="question-1">Q1:</label>
								</div>
					<?php	}
							?>
						</div>
						<a class="button" id="add_question">+</a>
					</div>
				</div>
				<div class="clear-fix"></div>
				<div class="form-group submission">
					<input type="submit" class="button">
				</div>
			</form>
		</div>
	</div>
	<script src="js/create_survey.js"></script>


<?php PAGE::FOOTER(); ?>

<?php 

function checkFormErrors() {

	$errors = [];

	if (!isset($_POST['survey-name']) || $_POST['survey-name'] == "") {
	
		array_push($errors, "Please enter a survey name");
	
	}

	if (!isset($_POST['people']) || count($_POST['people']) == 0) {
	
		array_push($errors, "Please add particpants to the survey");
	
	} else if (count($_POST['people']) < 2) {
	
		array_push($errors, "Please add at least 2 participants");
	
	}

	// This is done because questions can be submitted as empty fields
	// so we make sure that at least one of them is filled
	$questionsFilled = 0;

	foreach ($_POST['questions'] as $question) {
		
		if (strlen(trim($question)) > 0) {
			$questionsFilled++;
			break;
		}
	}

	if (!$questionsFilled) {
		array_push($errors, "Please enter at least 1 question");
	}

	return $errors;
}

 ?>