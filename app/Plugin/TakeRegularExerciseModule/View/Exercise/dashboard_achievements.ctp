<?php
if (empty($achievements)) {?>
<p>You haven't yet recorded enough weekly data to be able to calculate your achievements.</p>
<?php } else { ?>
<p><strong>My best week so far:</strong> Week beginning  
	<?php echo date('jS F Y',strtotime($achievements['ExerciseAchievement']['best_week_so_far'])); ?></p>
<p><strong>My total minutes of activity:</strong> 
	<?php 
		$totalmins = $achievements['ExerciseAchievement']['total_minutes'];
		$totalhours = round($totalmins/60,1);
		echo "$totalmins minutes ($totalhours hours)"; ?></p>
<p><strong>How many weeks have I achieved 150 minutes?:</strong> 
<?php echo $achievements['ExerciseAchievement']['total_full_weeks_healthy'];?></p>
<?php }?>