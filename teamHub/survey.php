<?php 

require_once "app.php";

$survey;

if ($_GET['id']) {
	
	$survey_id = $_GET['id'];

	if ($survey = $QUERY->SURVEY($survey_id)) {
		$page_title = $survey->name;

		if ($survey->author == $_SESSION['user_info']->id) {
		
			$page_to_load = "_survey_admin.php";
		
		} else if ($QUERY->IS_USER_IN_SURVEY($_SESSION['user_info']->id, $survey->id)) {
		
			$page_to_load = "_survey_user.php";
		
		} else {
			header("Location: 404.php");
		}

	} else {
		header("Location: 404.php");
	}

} else { header("Location: 404.php"); }


$page_title = $survey->name;

PAGE::HEADER($page_title);

require_once $page_to_load;

PAGE::FOOTER();
	