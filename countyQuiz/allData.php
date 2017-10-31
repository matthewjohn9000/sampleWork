<?php
session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Quiz Example</title>
<link rel="stylesheet" href="style/style.css">

</head>
<body>
<?php
require'includes/quizQuestions.inc.php';
	
if (isset( $_GET['quiz'] ) ) {
	$reset = $_GET['quiz'];
} else {
	$reset = '';
}

if(!isset($_SESSION['curQuestion']) || $reset == 'start') {
	$_SESSION['curQuestion'] = 0;
	$_SESSION['results'] = array();
}
	
$question = $bronzeQuiz['questions'][0];

$question_text = $question['question'];

$option = $question['options'];

$_SESSION['score'] = 0;

$score = $_SESSION['score'];
	
if (isset($_POST['question'])){
	$entered = $_POST['question'];
	$actual = $bronzeQuiz['questions'][$_SESSION['curQuestion']]['answer'];
	
	// Add to Session Array
	array_push($_SESSION['results'], 
		array(
		$bronzeQuiz['questions'][$_SESSION['curQuestion']]['question'],
		$bronzeQuiz['questions'][$_SESSION['curQuestion']]['options'][$entered]['option'],
		$bronzeQuiz['questions'][$_SESSION['curQuestion']]['options'][$entered]['hint'],
		$actual,
		$entered,
		$_SESSION['curQuestion'])
	);

	if( $entered == $actual ) {
		$_SESSION['score'] += 1;
	}

	$_SESSION['curQuestion']++;
}

if ($_SESSION['curQuestion'] > 11){
		header ("Location: feedback.php");
		print_r($_POST);

}


?>



<!--container for content and footer placement-->
<div class = "quizWrapper">

<!--container to center content-->
<div class = "container">

<!--main question box-->
<div class = "quizBox">

<?php
	$curQuestion = $_SESSION['curQuestion'];

echo "<h1>" . $bronzeQuiz['questions'][$curQuestion]['question'] . "</h1>";
	?>
<!--close quiz box-->
	</div>
	<br>
<div class = "answerSection">

<!--container for answer options left -->
<div class = "answerOptions">

<!--quiz answer options-->
<div class = "answerText">

	<form action="allData.php" method="post">

	<?php
		$questionNum = count( $bronzeQuiz['questions'][$curQuestion]['options']);
		for( $i = 0; $i < $questionNum; $i++ ) { ?>
		<label><p><input type="radio" name="question" value="<?php echo $i; ?>"> <?php echo $bronzeQuiz['questions'][$curQuestion]['options'][$i]['option']; ?></p></label><hr><br>
	<?php } ?>


	<input type="submit" value="Submit" >

</form>

<!--close quiz answer text-->
</div>
<?php
//	add code to show current question number out of total questions
?>

<!--close quiz answer options left container-->
	</div>

<!--container for answer options image right-->
<div class = "answerOptionsImage">

<img src="<?php echo $bronzeQuiz['questions'][$curQuestion]['image']; ?>">
<!--close answer options images container right-->
</div>

<!--closing containter for answer section-->
	</div>



<!--!--closing container	-->
</div>

	<!--closing wrapper-->
		</div>

<!--footer-->
<div class = "footer">

<!--<div class = "footer logo">-->

	<div class = "footerLogo"><a href="index.html"><img src="images/cutLogoR.svg" alt=""></a>

</div>

<!--close footer-->
	</div>

</body>
</html>
