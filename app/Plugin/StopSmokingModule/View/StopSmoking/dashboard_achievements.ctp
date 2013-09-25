<?php
if (empty($achievements)) {?>
<p>You haven't yet recorded enough weekly data to be able to calculate your achievements.</p>
<?php } else { ?>
<ul class="list-group">
  	<li class="list-group-item">
		My smoke free days last week:
		<span class="label label-primary pull-right"><?php echo $achievements['StopSmokingAchievement']['healthy_days_last_week'];?> days</span>
	</li>
  	<li class="list-group-item">
  		My total number of smoke free days:
		<span class="label label-primary pull-right"><?php echo $achievements['StopSmokingAchievement']['total_days_healthy'];?> days</span>
	</li>
  	<li class="list-group-item">
  		My total weeks smoke free all week:
		<span class="label label-primary pull-right"><?php echo $achievements['StopSmokingAchievement']['total_full_weeks_healthy'];?> weeks</span>
	</li>
  	<li class="list-group-item">
  		I've saved in total:
		<span class="label label-primary pull-right">&pound;<?php echo sprintf('%0.2f',round(7.47 * $achievements['StopSmokingAchievement']['total_days_healthy'],2));?></span>
	</li>
</ul>
<?php }?>
