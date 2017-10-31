<?php /* Displays Survey information to the Admin of the survey */ 


if ($_SERVER['REQUEST_METHOD'] == "POST") {
	if (isset($_POST['approve'])) {
		$DB->UPDATE("surveys", [
				
				// Conditions
				'id='.$_GET['id']
			
			], [

				// New values
				"status" => 'approved'

			]);

		$survey = $QUERY->SURVEY($survey_id);
	}
}

?>
<div class="view-survey page">
		<header class="page-title">
			<h1 class="col-xs-10"><?php echo $survey->name; ?></h1>
			<div class="col-xs-2">
				<?php 
				if ($survey->status == "approved") {
					?>

				<button id="approveButton" disabled>Approved</button>
				<?php
				} else {
					?>
				<form action="" method="post">
					<input id="approveButton" name="approve" class="button" title="Send Results to Participants" type="submit" value="Approve">
				</form>
	
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
								<h4 class="closed-warning"><b>This survey is closed.</b></h4>
							</div>
						</div>
						
						<?php
					} ?>
				</section>
				<section>
					<header class="setcion-header">
						<h2 class="section-title">Survey Participants</h2>
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
				
				$participants = $QUERY->SURVEY_PARTICIPANTS($survey->id);

				if ($participants) {

				?>
				<ul>
				<?php
					for ($i=0; $i < count($participants); $i++) { 
						$participant = $participants[$i];

				?>
					<li class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
					  <div class="panel panel-default">
					    <div class="panel-heading" role="tab" id="heading-<?php echo $i; ?>">
					      <h4 class="panel-title">
					        <a class="person-name" role="button" data-toggle="collapse" href="#collapse-<?php echo $i; ?>" aria-expanded="true" aria-controls="collapse-<?php echo $i; ?>">
					          <?php echo $participant->first_name . " " . $participant->last_name; ?>
					        </a>
					      </h4>
					    </div>
					    <div id="collapse-<?php echo $i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
					      <div class="panel-body">
					        <ul class="other-particpants">
								<?php 
									for ($j=0; $j < count($participants); $j++) { 
										$other_participant = $participants[$j];

										// Making sure that we only show the other participants. Aka the ones 
										// without the same id as the current one.
										if ($other_participant->id != $participant->id) {

											$questionairre_status = $QUERY->QUESTIONNAIRE_STATUS($survey->id, $participant->id, $other_participant->id);

											switch ($questionairre_status) {
												case 'published':
													$status = "Submitted";
													break;
												
												case 'flagged':
													$status = "Waiting for answer review";
													break;

												default:
													$status = "Not submitted";
													break;
											}

											if ($status === "Submitted" && $survey->status != "approved") {
												?>
												<li><a href="<?php echo "$home_url/admin_review.php?survey_id=".$survey->id."&reviewer_id=".$participant->id."&reviewee_id=".$other_participant->id; ?>"><?php echo $other_participant->first_name . " " . $other_participant->last_name ?><span class="status submitted"><?php echo $status; ?></span></a></li>
												<?php
											} else { 
												?>
												<li><?php echo $other_participant->first_name . " " . $other_participant->last_name ?><span class="status"><?php echo $status; ?></span></li>
									<?php	}

										?>

											

									<?php }
									}
								 ?>
					        </ul>
					      </div>
					    </div>
					  </div>
					</li>


			<?php	}	?>
				</ul>
		
		<?php	}	?>
			</section>
			
		</div>
	</div>
	<script>
		window.addEventListener('load', function() {
			var collapse_all = $(".collapse-all");
			var expand_all = $(".expand-all");

			collapse_all.click(function() {
				
				var section = $(this).parentsUntil('section').parent();
				
				var panel = section.find('.panel-collapse.collapse.in').collapse('toggle');

			});

			expand_all.click(function() {
				
				var section = $(this).parentsUntil('section').parent();
				
				var panel = section.find('.panel-collapse.collapse:not(.in)').collapse('toggle');

			});
			
		});
	</script>

<?php

PAGE::FOOTER();
