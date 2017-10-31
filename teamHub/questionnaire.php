<?php 
require_once "app.php";

$survey;
$reviewee;
$questions;

$prevAnswers = [];

PAGE::checkRequiredParams('survey_id','reviewee_id');

$survey_id = $_GET['survey_id'];
$reviewee_id = $_GET['reviewee_id'];
$reviewer_id = $_SESSION['user_info']->id;

// checking if the provided IDs are valid. If not we kick to 404;
if ( 	($survey = $QUERY->SURVEY($survey_id)) 
	 && ($QUERY->IS_USER_IN_SURVEY($reviewee_id, $survey_id))
	 && ($QUERY->IS_USER_IN_SURVEY($reviewer_id, $survey_id)) ) {
	
	$page_title = $survey->name;

} else {
	header("Location: 404.php");
}

$reviewee = $QUERY->USER($reviewee_id);
$questions = $QUERY->SURVEY_QUESTIONS($survey_id);
$grading_system = $DB->get_survey_grading_system($survey_id);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = validateForm();

	if ($errors) {
		$errorDiv = "<ul class='form-error'>";
		
		foreach ($errors as $error) {
			
			$errorDiv .= "<li>$error</li>";
			
		}
		$errorDiv .= "</ul>";

		foreach ($_POST['answers'] as $key => $answer) {
			$prevAnswers[$key]['grade'] = (isset($answer['grade'])) ? $answer['grade'] : "none";
			$prevAnswers[$key]['text'] = (isset($answer['text'])) ? $answer['text'] : "";
			$prevAnswers[$key]['status'] = (isset($answer['status'])) ? $answer['status'] : "";
			$prevAnswers[$key]['comment'] = (isset($answer['comment'])) ? $answer['comment'] : "";
		}

	} else {
		// submit
		$status 	= "published";
		$reviewee_id = $reviewee_id;
		$survey_id = $survey->id;
		$answers = $_POST['answers'];
		
		
		if ($QUERY->ANSWERS($survey_id, $reviewer_id, $reviewee_id)) {

			foreach ($answers as $answer_number => $answer) {
				$DB->UPDATE("answers", 
					[
					"reviewer_id = $reviewer_id",
					"reviewee_id = $reviewee_id",	
					"survey_id = $survey_id",	
					"question_id = " . $questions[$answer_number]->id	
					], [
						'answer' 		=> $answer['text'],
						'grade' 		=> $answer['grade'],
						'status' 		=> $status,
					]);
			}
		} else {
			
			foreach ($answers as $answer_number => $answer) {
				$DB->INSERT("answers", [
					'reviewer_id'	=> $reviewer_id,
					'reviewee_id' 	=> $reviewee_id,
					'survey_id'		=> $survey_id,
					'answer' 		=> $answer['text'],
					'grade' 		=> $answer['grade'],
					'question_id' 	=> $questions[$answer_number]->id,
					'status' 		=> $status,
				]);
			}
			
		}

		header("Location: $home_url/survey.php?id=$survey_id");
		
	}
}

if ($QUERY->QUESTIONNAIRE_STATUS($survey_id, $reviewer_id, $reviewee_id) != null) {
	
	$answers = $QUERY->ANSWERS($survey_id, $reviewer_id, $reviewee_id);

	foreach ($questions as $question_number => $question) {
		foreach ($answers as $answer) {
			if ($answer->question_id == $question->id) {
				$prevAnswers[$question_number]['grade'] = $answer->grade;
				$prevAnswers[$question_number]['text'] = $answer->answer;
				$prevAnswers[$question_number]['status'] = $answer->status;
				$prevAnswers[$question_number]['comment'] = $answer->comment;
			}
		}
	}
	
}

PAGE::HEADER($page_title);


?>

<div class="questionnaire page">
	<header class="page-title">
		<h1><?php echo $page_title . " &#10095; " . $reviewee->first_name . " " . $reviewee->last_name; ?></h1>
	</header>
	<div class="content">
		<?php if(isset($errorDiv)) echo $errorDiv;?>
		<section>
			<header class="setcion-header fixable">
				<h2 class="section-title">Questions</h2>
				<div class="tools">
					<div class="option">
						<a href="#" class="collapse-all">Collapse All</a>
					</div>
					<div class="option">
						<a href="#" class="expand-all">Expand All</a>
					</div>
				</div>
			</header>
				<?php 
				

				if ($questions) {

				?>
				<form class="questions" action="<?php echo $home_url . str_replace("/teamhub","", $_SERVER['REQUEST_URI']); ?>" method="post">
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
					        <div class="form-group col-xs-12 grade">
								<label>Grade</label>
								<div class="radio-slider">
									<?php 
									$grade_fraction = (1 / (count($grading_system) - 1)) * 100;

									$grade_counter = 100;
									for ($j=0; $j < count($grading_system); $j++) { 
									?>
							<input type="radio" name="answers[<?php echo $i; ?>][grade]" id="grade-<?php echo $question_number."-".($j+1); ?>" value="<?php echo $grade_counter; ?>" <?php if(isset($prevAnswers[$i]['grade']) && $prevAnswers[$i]['grade'] == $grade_counter) echo 'checked'; ?>><label for="grade-<?php echo $question_number."-".($j+1); ?>"><?php echo $grading_system[$j]; ?></label>
										<?php
										$grade_counter -= $grade_fraction;
									} 

									?>
								</div>
							</div>
							<div class="form-group col-xs-12 answer">
								<label for="answer-<?php echo $question_number; ?>">Explain ... </label>
								<textarea name="answers[<?php echo $i; ?>][text]" id="answer-<?php echo $question_number; ?>" class="analyze  <?php if(isset($prevAnswers[$i])) echo $prevAnswers[$i]['status'] ?>" rows="5"><?php if(isset($prevAnswers[$i]['text'])) echo $prevAnswers[$i]['text']; ?></textarea>
							</div>
							<?php 
								if (isset($prevAnswers[$i]) && $prevAnswers[$i]['status'] == "flagged" && $prevAnswers[$i]['comment']) {
									?>
								<div class="form-group col-xs-12 form-error">
									<b>Admin Note:</b>
									<p> 
										<?php echo $prevAnswers[$i]['comment']; ?>
									</p>
								</div>
									<?php
								}
							 ?>
					      </div>
					    </div>
					  </div>
					</li>

			<?php	}	?>
					</ol>
					<div class="clear-fix"></div>
					<div class="form-group submission">
						<input type="submit" class="button" id="buttonQ">
					</div>
				</form>
		
		<?php	}	?>
			</section>
			<script src="js/collapse-all.js"></script>
			<script src="js/Watson-Analyzer/watsonAnalyzer.js"></script>
	</div>
</div>

<?php

PAGE::FOOTER();

function validateForm() {

	$answers = $_POST['answers'];

	$errors = [];

	foreach ($answers as $key => $answer) {
		$answer_number = $key + 1;

		$grade = (isset($answer['grade'])) ? $answer['grade'] : null;
		$text = trim($answer['text']);

		if (!$grade && strlen($text) < 1) {
			// If both of them are not provided then we continue with the next iteration

			array_push($errors, "Please answer question " . $answer_number);
			continue;
		}

		if ($grade === null) {
			array_push($errors, "Please select a grade for question ". $answer_number);
		} 

		if (strlen($text) < 1) {
			array_push($errors, "Please provide an explanation for answer ". $answer_number);
		}
	}

	return $errors;

}
