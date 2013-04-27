<?php
if (empty($achievements)) {?>
<p>You haven't yet recorded enough weekly data to be able to calculate your achievements.</p>
<?php } else {?>
<p><strong>My smoke free days last week:</strong> 
<?php echo $achievements['StopSmokingAchievement']['healthy_days_last_week'];?> days</p>
<p><strong>My total number of smoke free days:</strong> 
<?php echo $achievements['StopSmokingAchievement']['total_days_healthy'];?> days</p>
<p><strong>My total weeks smoke free all week:</strong> 
<?php echo $achievements['StopSmokingAchievement']['total_full_weeks_healthy'];?> weeks</p>
<p><strong>I've saved in total:</strong> 
&pound;<?php echo sprintf('%0.2f',round(7.47 * $achievements['StopSmokingAchievement']['total_days_healthy'],2));?></p>
<?php }?>