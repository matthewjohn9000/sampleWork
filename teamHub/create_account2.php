<?php

require_once "database/connect.php";
require_once 'database/db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_POST['createPassword'] == $_POST['reEnterPassword']) {
		
		$errors = checkFormErrors();
		
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
		$userTable = 'users';
		
		$result = $DB->INSERT("users", [
		"email" => $email,
		"first_name" => $first_name,
		"last_name" => $last_name,
		"password" => $password
		]);
		
		//Add logic to check if the query was successful
		header('Location: home.php');
		
		}
	} 
}	
function checkFormErrors() {

	$errors = [];

	if (!isset($_POST['createEmail']) || $_POST['createEmail'] == "") {
		array_push($errors, "Please enter an email address");
	
	}
		
	if (!isset($_POST['createFirstName']) || $_POST['createFirstName'] == "") {
		array_push($errors, "Please enter a first name");
	
	}
		
	}else {
		//echo "<h2>Please fill out the form completely</h2>";
	if (!isset($_POST['createLastName']) || $_POST['createLastName'] == "") {
		array_push($errors, "Please enter an last name");
	}

	if (!isset($_POST['createPassword']) || $_POST['createPassword'] == "") {
		array_push($errors, "Please enter a password");
		}
		
	} 
}
	if (!isset($_POST['reEnterPassword']) || $_POST['reEnterPassword'] == "") {
		array_push($errors, "Please re-enter a your password");
	}
	
	return $errors;
} 


?>
<div id="pagewrapper">
		<h1 id="createAccountHeading">LET'S GET YOU READY TO REVIEW YOUR PEERS</h1>
		</div><!--create account block-->
		<form id="createAccountForm" method="post" action="create_account.php">
		
			<p id="status"><?php if(isset($errorDiv)) echo $errorDiv;?></p>
			
			<input type="text" class="createAccountTextBox" id="createEmail" name="createEmail" placeholder="Email" value="<?php if(isset($_POST['createEmail'])) echo $_POST['createEmail'];?>"/></br>
			<input type="text" class="createAccountTextBox" id="createFirstName" name="createFirstName" placeholder="First Name" value="<?php if(isset($_POST['createFirstName'])) echo $_POST['createFirstName'];?>"/></br>
			<input type="text" class="createAccountTextBox" id="createLastName" name="createLastName" placeholder="Last Name" value="<?php if(isset($_POST['createLastName'])) echo $_POST['createLastName'];?>"/></br>