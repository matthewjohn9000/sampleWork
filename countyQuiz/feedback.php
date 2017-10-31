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


<!--container for content and footer placement-->
<div class = "quizWrapper">

<!--container to center content-->
<div class = "container">

<!--main question box-->
<div class = "quizBox">


	<h1>Here are your results</h1>
	
<!--close quiz box-->
	</div>

<?php
		
//set table headers: Questions, Your Answer, Feedback
echo "<table>\n";
	echo "<table border=1>";
	echo "<tr><th>Question</th><th>Your Answer Received</th><th>Result</th></tr>";




foreach ($_SESSION['results'] as $result => $value) {
	echo "<tr>";
	echo "<td>" . $value[0] . "</td>";
	echo "<td>" . $value[1] . "</td>";
	if ($value[4] != $value[3]){
		echo "<td><div class = red>" . $value[2] . "</div></td>";
	}else{
		echo "<td><div class = green>" . $value[2] . "</div></td>";
	}
	}
	echo "</table>\n";
	?>


<?php	
foreach ($_SESSION['results'] as $result => $value) {
//	echo "<p>Question #: " . $value[0] . "<br>";
//	echo "Your answer: " . $value[1] . "<br>";
//	echo "Hint: " . $value[2] . "<br>";
//	echo "Correct answer: " . $value[3] . "<br>";
//	echo "Your answer value: " . $value[4] . "<br>";
//	echo "You completed: " . $value[5]  . " questions<br>";
////	echo "You had: " . $score . "correct <br>";
////	echo "Out of: " . $totalTaken . "<br>";
////	echo "Your score is: " . $total ."</p>";
//	$score = 0;	
	$score = $_SESSION['score'];
	
	if( $value[4] == $value[3] ) {
		$_SESSION['score'] += 1;
}
}
$totalQuestions = $value[5] + '1';
$yourPercent = $score / $totalQuestions;
	
	if ($yourPercent == 1){
		echo "<h1>Congrats you received a perfect score!!</h1><br><a href=\"certificate.html\"><h2>Print your certificate here</a></h2>";
	}elseif ($yourPercent >= .7  && $yourPercent <= .99){
		echo "<h1>You scored " . sprintf("%.0f%%", $yourPercent * 100) . " nice job!</h1><h2><a href=\"certificate.html\">Print your certificate here</a></h2>";
		}else{
		echo "<h1>You scored " . sprintf("%.0f%%", $yourPercent * 100) . " you may choose to retake the quiz.</h1>";
	}	

?>

	
<h4>Scores over 70% may choose to print a personalized certificate of completion.</h4>


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
