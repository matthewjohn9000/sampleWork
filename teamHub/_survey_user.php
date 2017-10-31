
<?php /* Displays Survey information to the users joined the survey */ ?>

<div class="view-survey page">
		<header class="page-title">
			<h1 class="col-xs-10"><?php echo $survey->name; ?></h1>
			<div class="col-xs-2">
				<?php 
				if ($survey->status == "approved") {
					?>
				<a class="button" href='<?php echo "$home_url/survey_results.php?survey_id=".$survey->id; ?>' id="results">Results</a>
				<?php
				} 
				?>
			</div>
			<div class="clear-fix"></div>
		</header>
		<div class="content">
				<section>
					<?php if ($survey->status == "approved") {
						?>
						<div class="row">
							<div class="col-xs-12">
								<h4 class="closed-warning"><b>This survey is closed. <a href="<?php echo "$home_url/survey_results.php?survey_id=".$survey->id; ?>">View Results</a></b></h4>
							</div>
						</div>
						
						<?php
					} ?>
				</section>
				<section>
					<header class="setcion-header">
						<h2 class="section-title">People To Review</h2>
						<div class="tools">
							<div class="option">
							</div>
						</div>
					</header>
				<?php 
				
				$participants = $QUERY->SURVEY_PARTICIPANTS($survey->id);

				if ($participants) { ?>
					<ul>
					<?php
					for ($j=0; $j < count($participants); $j++) { 
						$participant = $participants[$j];

						// Making sure that we only show the other participants. Aka the ones 
						// without the same id as the current one.
						if ($participant->id != $_SESSION['user_info']->id) {

							$questionairre_status = $QUERY->QUESTIONNAIRE_STATUS($survey->id, $_SESSION['user_info']->id, $participant->id);

							switch ($questionairre_status) {
								case 'published':
									$status = "Submitted";
									break;
								
								case 'flagged':
									$status = "Flagged";
									break;

								default:
									$status = "";
									break;
							}
					?>
						<li class="panel-group">
						  <div class="panel panel-default">
						    <div class="panel-heading">
								<?php if($survey->status == "approved") {
									?>
								<span class="person-name disabled">
									<?php echo $participant->first_name . " " . $participant->last_name ?><span class="status"><?php echo $status; ?></span>
								</span>
									<?php
								} elseif ($status === "Submitted") {
							?>
								<span class="person-name disabled">
									<?php echo $participant->first_name . " " . $participant->last_name ?><span class="status submitted"><?php echo $status; ?></span>
								</span>

							<?php } else if ($status === "Flagged") { ?>
						      	<?php 
						      	$survey_id = $survey->id;
						      	$particpant_id = $participant->id;

						      	$link = "$home_url/questionnaire.php?survey_id=$survey_id&reviewee_id=$particpant_id";
						      	 ?>
						        <a href="<?php echo "$link" ?>" class="person-name">
						          <?php echo $participant->first_name . " " . $participant->last_name; ?><span class="status flagged"><?php echo $status; ?></span>
						        </a>
						    </div>
						  </div>
						</li>	
					<?php	} else { 

								$survey_id = $survey->id;
						      	$particpant_id = $participant->id;
						      	
								$link = "$home_url/questionnaire.php?survey_id=$survey_id&reviewee_id=$particpant_id";
								?>
								<a href="<?php echo "$link" ?>" class="person-name">
						          <?php echo $participant->first_name . " " . $participant->last_name; ?><span class="status"><?php echo $status; ?></span>
						        </a>
					<?php   }
						}
					}
				}
						?>
				</ul>
		</section>
		</div>
	</div>