<!DOCTYPE html>
<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>Login</title>
	<link href="css/login.css" rel="stylesheet">
		
</head>
<body class="login-page">
<?php

	//Begin the session
	if(!isset($_SESSION)) { 
		session_start(); 
	}

	require_once "database/connect.php";
	
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
		//Define variables
		$email = $_POST['login_id'];
		$password = $_POST['password'];
		$errorDiv = "";
	
		//Check for errors
		$errors = checkFormErrors();

		//Append errors onto $errorDiv
		if($errors) {
			$errorDiv = "<ul class='form-error'>";
		
			foreach ($errors as $error) {
				$errorDiv .= "<li>$error</li>";
			}

			$errorDiv .= "</ul>";
		
		}else{
			
			//Create sql string with placeholders
			$sql = "SELECT * FROM users WHERE email= :login_id AND password= :pass";
			
			//prepare sql in the database
			$statement = $DB->prepare($sql);

			//Bind parameters
			$statement->bindParam(":login_id", $email);
			$statement->bindParam(":pass", $password);

			//Execute query 
			$statement->execute();
			
			//Check to see if the query was successful
			if($row = $statement->fetchObject()) {

				//Assign user info to the session
				$_SESSION['user_info'] = $row;
				
				header("Location: index.php");
				
			}else{
				$loginError = "<p>Name and password do not match</p>";
			}
			//Insert code for incorrect password
		}
	}
	
	function checkFormErrors() {

		$errors = [];

		if (!isset($_POST['login_id']) || $_POST['login_id'] == "") {
	
			array_push($errors, "Please enter an email address");
	
		}

		if (!isset($_POST['password']) || $_POST['password'] == "") {
	
			array_push($errors, "Please enter a password");
	
		}

		return $errors;
	} 
	
?>

<div id="pagewrapper">
	
	<div id="content">
	<div id="topSquare">
		 <div id="graphicContainer">
			<svg id="Layer_3" data-name="Layer 2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 2217.81 2133.21"><defs><style>.cls-1,.cls-2{opacity:0.5;}.cls-2{fill:none;stroke:#000;stroke-miterlimit:10;stroke-width:1.72px;}</style></defs><title>graphic</title><ellipse class="cls-1" cx="455.83" cy="64.69" rx="31.52" ry="64.69"/><ellipse class="cls-1" cx="1299.36" cy="74.88" rx="31.52" ry="64.69"/><ellipse class="cls-1" cx="882.1" cy="1104.38" rx="31.52" ry="64.69"/><ellipse class="cls-1" cx="2186.29" cy="790.18" rx="31.52" ry="64.69"/><ellipse class="cls-1" cx="819.07" cy="2047.63" rx="31.52" ry="64.69"/><ellipse class="cls-1" cx="31.52" cy="2068.53" rx="31.52" ry="64.69"/><ellipse class="cls-1" cx="94.56" cy="1169.07" rx="31.52" ry="64.69"/><ellipse class="cls-1" cx="1749.78" cy="1608.93" rx="31.52" ry="64.69"/><polygon class="cls-2" points="455.83 74.89 882.1 1104.38 1299.36 74.89 455.83 74.89"/><polygon class="cls-2" points="94.56 1169.07 455.83 64.69 31.52 2068.53 819.07 2047.63 1749.78 1608.93 2186.29 790.18 1299.36 74.89 819.07 2047.63 2186.29 790.18 882.1 1104.38 1749.78 1608.93 1299.36 74.89 94.56 1169.07"/><path class="cls-2" d="M484.76,1383.33-239.75,504.76l787.55-64.69-850.59,964.15s2147.26-1300,2146.5-1285S-239.75,504.76-239.75,504.76" transform="translate(334.31 664.3)"/></svg>
			
		</div> 
	

		<h1 id="mainTitle">TEAMHUB</h1>
		<h2 id="subTitle">Peer To Peer Review</h2>		
	</div><!-- end topSquare -->
	
		<div id="login">
			<div class="container">				
			<form method="post" action="login.php">
				<?php if(isset($errorDiv)) echo $errorDiv;?>
				<?php if(isset($loginError)) echo "<p id=\"loginError\">" . $loginError . "</p>";?>
				
				<input type="text" name="login_id" id="loginIdField" value="<?php if(isset($_POST['login_id'])) echo $_POST['login_id'];?>" placeholder="Email" />
				<input type="password" name="password" id="passwordField" placeholder="Password" />
				<input type="submit" id="loginButton" name="login" value="sign in" />
				
				<div id="create">
				<a href="create_account.php" id="createAccountLink">CREATE ACCOUNT</a>
			</div>
			</form>
			</div>
			
			
		</div><!-- End login -->
	</div><!-- End content -->
</div><!-- End pagewrapper -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!--
<script>$("#subTitle").animate({
		left: '10px'}, 'slow');
	</script>
-->
</body>
</html>

