<?php 
require_once "app.php";

$survey;
$reviewee;
$questions;

PAGE::checkRequiredParams('survey_id', 'reviewee_id', 'reviewer_id');

$survey_id = $_GET['survey_id'];
$reviewee_id = $_GET['reviewee_id'];
$reviewer_id = $_GET['reviewer_id'];

// checking if the provided IDs are valid. If not we kick to 404;
if ( 	($survey = $QUERY->SURVEY($survey_id)) 
	 && ($QUERY->IS_USER_IN_SURVEY($reviewee_id, $survey_id))
	 && ($QUERY->IS_USER_IN_SURVEY($reviewer_id, $survey_id))
	 &&	($QUERY->QUESTIONNAIRE_STATUS($survey_id, $reviewer_id, $reviewee_id) == 'published') ) {
	
	$page_title = $survey->name;

} else {
	header("Location: 404.php");
}

$reviewee = $QUERY->USER($reviewee_id);
$reviewer = $QUERY->USER($reviewer_id);
$questions = $QUERY->SURVEY_QUESTIONS($survey_id);
$answers = $QUERY->ANSWERS($survey_id, $reviewer_id, $reviewee_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$comments = $_POST['comments'];

	foreach ($comments as $key => $value) {
		if (trim($value) != "") {
			$QUERY->FLAG_ANSWER($answers[$key]->id, $value);
		}
	}

	header("Location: survey.php?id=".$survey->id);
}

$questions_answers = [];	

foreach ($questions as $question_number => $question) {
	foreach ($answers as $answer) {
		if ($answer->question_id == $question->id) {
			$questions_answers[$question_number]['grade'] = $answer->grade;
			$questions_answers[$question_number]['text'] = $answer->answer;
		}
	}
}
$grading_system = $DB->get_survey_grading_system($survey_id);

function grade_index($grade) {
	global $grading_system;
	$grade_index = ($grade == 0) ? count($grading_system) - 1 : floor(100 / intval($grade)) - 1;
	return $grade_index;
}

function grade_class($grade_index) {
	global $grading_system;

	switch ($grade_index) {
		case 0:
			echo "good";
			break;
		
		case count($grading_system) - 1:
			echo "bad";
			break;
		
		default:
			echo "okay";
			break;
	}
};

PAGE::HEADER($page_title);
?>

<div class="admin-review page">
	<header class="page-title">
		<h1><?php echo $page_title . " &#10095; " . $reviewer->first_name . " " . $reviewer->last_name . " reviewing " . $reviewee->first_name . " " . $reviewee->last_name; ?></h1>
	</header>
	<div class="content">
		<section>
			<header class="section-header fixable">
				<h2 class="section-title">Answers</h2>
				<div class="tools">
					<div class="option">
						<a href="#" class="collapse-all">Collapse All</a>
					</div>
					<div class="option">
						<a href="#" class="expand-all">Expand All</a>
					</div>
				</div>
			</header>
			<main>
				<form action="" method="post" id="comments-form">
					
				<?php 
				
				if ($questions) {

				?>
				<ol>
				<?php
					for ($i=0; $i < count($questions); $i++) { 
						$question = $questions[$i];
						$question_number = $i + 1;
				?>
					<li class="question panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  <div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="heading-<?php echo $i; ?>">
					      <h4 class="panel-title">
					        <a class="question-text" role="button" data-toggle="collapse" href="#collapse-<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $i; ?>">
					          <?php echo $question->text; ?>
					        </a>
					      </h4>
					    </div>

					    <div id="collapse-<?php echo $i; ?>" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
					      <div class="panel-body">
					        <div class="col-xs-12 grade">
					        	<?php 
								$grade_index = grade_index($questions_answers[$i]['grade']);

					        	 ?>
								<div class="grade-value <?php grade_class($grade_index) ?>"><?php 
								echo $grading_system[$grade_index]; ?></div>
							</div>
							<div class="col-xs-12 answer">
								<p id="answer-<?php echo $question_number; ?>"><?php echo $questions_answers[$i]['text']; ?></p>
							</div>
							<div class="col-xs-12 actions">
								<input type="checkbox" id="comment-toggle-<?php echo $i; ?>" class="comment-toggle" style="display: none;"><label title="Add flag and return answer" class="comment-toggle-controller action-button" for="comment-toggle-<?php echo $i; ?>"><img src="assets/flag.svg" alt="flag icon"></label>
								<textarea placeholder="Your comment" name="comments[]" id="comment-<?php  echo $i; ?>" cols="30" rows="3" class="comment-box"></textarea>
							</div>
					      </div>
					    </div>
					  </div>
					</li>
			<?php	}	?>
					</ol>
					<div class="clear-fix"></div>
		
		<?php	}	?>
				<input type="submit" class="button" value="Submit Flagged Comments">
				</form>
			</main>
			</section>
			<script src="js/collapse-all.js"></script>
			<script src="js/fixable.js"></script>
			<script src="js/admin-review.js"></script>
			<!-- <script src="js/Watson-Analyzer/watsonAnalyzer.js"></script> -->
	</div>
</div>

<?php

PAGE::FOOTER();
