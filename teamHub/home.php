<?php require_once "app.php"; ?>

<?php PAGE::HEADER("TeamHub"); ?>

	<div class="homepage">
		<header class="page-title">
			<div class="mainIcon"><img src="assets/mainIcon.svg" alt="to do list icon"></div>
			<h1>Welcome,</h1>
			<h3>please review your dashboard</h3>
		</header>
		<div class="container-fluid">
			<div class="row">
				<div class="col-s-1 col-md-3">
				<div class="dashHead1"><div class="icon"><img src="assets/flag.svg" alt=""></div>Attention Required</div>
					<div class="homeFeed">
						<?php
							$surveys_joined = $QUERY->SURVEYS_JOINED($_USER->id);
							
							foreach($surveys_joined as $survey) {
								if ($survey->status != "approved") {
									$status = $QUERY->QUESTIONNAIRE_STATUS($survey->id, $_USER->id, "*");
									
									if($status == "flagged") {
										echo "<a href='$home_url/survey.php?id=".$survey->id."'>". $survey->name ."</a>";
									}
								}
							}
						?>
					</div>
				</div>
				<div class="col-s-1 col-md-3">
				<div class="dashHead2"><div class="icon"><img src="assets/view.png" alt=""></div>View Your Results</div>
					<div class="homeFeedVR">
						<?php
								$surveys_joined = $QUERY->SURVEYS_JOINED($_USER->id);

								foreach($surveys_joined as $survey) {

									if($survey->status == "approved") {
										echo "<a href='$home_url/survey.php?id=".$survey->id."'>". $survey->name ."</a>";
									}
								}
							?>
					</div>
				</div>
				
				<div class="col-s-1 col-md-3">
				<div class="dashHead3"><div class="icon"><img src="assets/answer.svg" alt=""></div>Surveys to Complete</div>
					<div class="homeFeed">
						<?php
								$surveys_joined = $QUERY->SURVEYS_JOINED($_USER->id);
								foreach($surveys_joined as $survey) {
									$participants = $QUERY->SURVEY_PARTICIPANTS($survey->id);
									foreach ($participants as $participant) {

										if ($participant->id != $_USER->id) {
											$answers = $QUERY->ANSWERS($survey->id, $_USER->id, $participant->id);
											
											if (!count($answers)) {
												echo "<a href='$home_url/questionnaire.php?survey_id=".$survey->id."&reviewee_id=".$participant->id."'>". $survey->name ." &#10095; ". $participant->first_name . " " . $participant->last_name ."</a>";
											}

										}
										
									}	
								}
							?>
					</div>
				</div>	
				
				<div class="col-s-1 col-md-3">
				<div class="dashHead4"><div class="icon"><img src="assets/approve.svg" alt=""></div>Surveys to Approve</div>
				<div class="homeFeed">
				
					<?php
									$surveys_created = $QUERY->SURVEYS_CREATED($_USER->id);

									foreach($surveys_created as $survey) {
										if ($survey->status != 'approved') {
										
											$done = false;
											$participants = $QUERY->SURVEY_PARTICIPANTS($survey->id);

											foreach ($participants as $participant) {

												foreach ($participants as $other_participant) {

													if ($participant != $other_participant) {
														$status = $QUERY->QUESTIONNAIRE_STATUS($survey->id, $participant->id, $other_participant->id);
														if($status != "published") {
															
															$done = false;
															break;
														}
													$done = true;

												}
												
											}

										}
										if ($done) {
										echo "<a href='$home_url/survey.php?id=".$survey->id."'>". $survey->name ."</a>";
										}
									
									}

								}
										
									
								?>
					
				
				
				
				</div>
				</div>
				
				
				
				
			</div>

			
		</div>
	</div>

<?php PAGE::FOOTER(); ?>