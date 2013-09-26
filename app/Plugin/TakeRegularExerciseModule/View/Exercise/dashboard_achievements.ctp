<?php
if (empty($achievements)) {?>
<p>You haven't yet recorded enough weekly data to be able to calculate your achievements.</p>
<?php } else { ?>
<ul class="list-group">
  	<li class="list-group-item">My best week so far:
  		<span class="label label-primary pull-right">w/c   
			<?php echo date('jS F Y',strtotime($achievements['ExerciseAchievement']['best_week_so_far'])); ?></span>
	</li>
  	<li class="list-group-item">My total minutes of activity:
		<span class="label label-primary pull-right"><?php 
			$totalmins = $achievements['ExerciseAchievement']['total_minutes'];
			$totalhours = round($totalmins/60,1);
			echo "$totalmins minutes ($totalhours hours)"; ?></span>
	</li>
  	<li class="list-group-item">How many weeks have I achieved 150 minutes?:
		<span class="label label-primary pull-right"><?php echo $achievements['ExerciseAchievement']['total_full_weeks_healthy'];?></span>
	</li>
</ul>
<?php }?>
		