<!DOCTYPE html>
<?php 
if(!isset($_SESSION)) { 
	session_start(); 
}

?>

<html lang="en">
<head>

	<meta charset="UTF-8">
	<title>Create Account</title>
	<link href="css/create_account.css" rel="stylesheet">
		
</head>
<body>
<?php

require_once "database/connect.php";

if($_SERVER['REQUEST_METHOD'] == 'POST') {
		
	$errorDiv = "";
	$errors = checkFormErrors($DB);
		
	if($errors) {
		$errorDiv = "<ul class='form-error'>";
		
		foreach ($errors as $error) {
			$errorDiv .= "<li>$error</li>";
		}

		$errorDiv .= "</ul>";
		
	}else{
			
		$email = $_POST['createEmail'];
		$first_name = $_POST['createFirstName'];
		$last_name = $_POST['createLastName'];
		$password = $_POST['createPassword'];
			
		$result = $DB->INSERT("users", [
		"email" => $email,
		"first_name" => $first_name,
		"last_name" => $last_name,
		"password" => $password
		]);
			
		$sql = "SELECT * FROM users WHERE email= :email";
		$result = $DB->QUERY($sql, [
			"email" => $email
		]);
			
		if($user = $result->fetch()) {
			$_SESSION['user_info'] = $user;
		}
			
		header('Location: home.php');
	}
}	

function checkFormErrors($DB) {

	$errors = [];
	
	if ($_POST['createPassword'] != $_POST['reEnterPassword']){
		array_push($errors, "The passwords you entered did not match");
	}

	if (!isset($_POST['createEmail']) || $_POST['createEmail'] == "") {
		array_push($errors, "Please enter an email address");
	
	}
		
	if (!isset($_POST['createFirstName']) || $_POST['createFirstName'] == "") {
		array_push($errors, "Please enter a first name");
	
	}
		
	if (!isset($_POST['createLastName']) || $_POST['createLastName'] == "") {
		array_push($errors, "Please enter an last name");
	}

	if (!isset($_POST['createPassword']) || $_POST['createPassword'] == "") {
		array_push($errors, "Please enter a password");
		}
		
	if (!isset($_POST['reEnterPassword']) || $_POST['reEnterPassword'] == "") {
		array_push($errors, "Please re-enter a your password");
	}
	
	//Check for duplicate email address
	$sql = "SELECT * FROM users WHERE email= :email";
	
	$email = $_POST['createEmail'];
	$result = $DB->QUERY($sql, [
		"email" => $email
	])->fetchAll();
	
	if(count($result) > 0) {
		array_push($errors, "This email address is already registered");
	}
	
	return $errors;
} 

?>
<div id="pagewrapper">
	<div id="content">

		<div id="createAccountBlock"><div id="storeText">
		<h1 id="createAccountHeading">LET'S GET YOU READY TO REVIEW YOUR PEERS</h1>
			</div>
		</div><!--create account block-->
		<?php if(isset($errorDiv)) echo $errorDiv;?>

		<form id="createAccountForm" method="post" action="create_account.php">
			
			<input type="text" class="createAccountTextBox" id="createEmail" name="createEmail" placeholder="Email" value="<?php if(isset($_POST['createEmail'])) echo $_POST['createEmail'];?>"/></br>
			<input type="text" class="createAccountTextBox" id="createFirstName" name="createFirstName" placeholder="First Name" value="<?php if(isset($_POST['createFirstName'])) echo $_POST['createFirstName'];?>"/></br>
			<input type="text" class="createAccountTextBox" id="createLastName" name="createLastName" placeholder="Last Name" value="<?php if(isset($_POST['createLastName'])) echo $_POST['createLastName'];?>"/></br>
			<input type="password" class="createAccountTextBox" id="createPassword" name="createPassword" placeholder="Password" /></br>
			<input type="password" class="createAccountTextBox" id="reEnterPassword" name="reEnterPassword" placeholder="Re-Enter Password" /></br>
			<input type="submit" id="submitAccount" name="submit" value="create"/>
			
		</form>
	</div><!--end content-->
</div><!--end pagewrapper-->
</body>
</html>