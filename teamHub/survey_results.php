<?php require_once "app.php";



$survey;
$questions;
$answers;

if ($_GET['survey_id']) {
	
	$survey_id = $_GET['survey_id'];

	if ($QUERY->SURVEY($survey_id)) {

		$survey = $QUERY->SURVEY($survey_id);

		if ($survey->status == "approved") {
			
			$questions = $QUERY->SURVEY_QUESTIONS($survey->id);
			//$answers = $QUERY->ANSWERS($survey_id, $_USER->id, "*");
			$answers = $QUERY->ANSWERS($survey_id, "*",$_USER->id);
			

		} else {
			header("Location: 404.php");
		}
		


	} else {
		header("Location: 404.php");
	}

} else { header("Location: 404.php"); }

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

PAGE::HEADER($survey->name." - Results"); ?>

	<div class="questionnaire page">
		<header class="page-title">
			<h1><?php echo $survey->name . " > " . "Result"; ?></h1>
		</header>	
	</div>
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
					      
					      	<?php if (isset($answers[$i])) {
					      	?>
								<div class="col-xs-12 grade">
						        	
								</div>
								<div class="col-xs-12 answer">
									<?php for($j=0 ; $j < count($answers); $j++) { 
										if($questions[$i]->id == $answers[$j]->question_id){ ?>
											<?php $grade_index = grade_index($answers[$j]->grade); ?>
											<div class="grade-value <?php grade_class($grade_index) ?>"><?php 
											echo $grading_system[$grade_index]; ?></div>
											<p id="answer-<?php echo $question_number; ?>"><?php echo $answers[$j]->answer; ?></p>
									<?php }	
									} ?>
								</div>
					      	<?php
					      	} else {
					      		echo "<p>Not Answered</p>";
					      	} ?>
					        
					      </div>
					    </div>
					  </div>
					</li>
			<?php	}	?>
					</ol>
					<div class="clear-fix"></div>
		
		<?php	}	?>
			</main>
			</section>
			<script src="js/collapse-all.js"></script>
			<script src="js/fixable.js"></script>


	</div>

<?php PAGE::FOOTER(); ?>