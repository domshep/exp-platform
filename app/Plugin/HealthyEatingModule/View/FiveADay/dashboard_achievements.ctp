<?php
if (empty($achievements)) {?>
<p>You haven't yet recorded enough weekly data to be able to calculate your achievements.</p>
<?php } else {?>
<p><strong>Number of days achieving 5-a-day last week:</strong> 
	<?php echo $achievements['FiveADayAchievement']['healthy_days_last_week'];?> days</p>
<p><strong>My total number of days achieving 5-a-day:</strong> 
	<?php echo $achievements['FiveADayAchievement']['total_days_healthy'];?> days</p>
<p><strong>My total weeks achieving 5-a-day all week:</strong> <?php echo 
	$achievements['FiveADayAchievement']['total_full_weeks_healthy'];?> weeks</p>
<?php }?>