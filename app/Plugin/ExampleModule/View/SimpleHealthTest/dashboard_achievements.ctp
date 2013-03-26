<?php
if (empty($achievements)) {?>
<p>You haven't yet recorded enough weekly data to be able to calculate your achievements.</p>
<?php } else {?>
<p><strong>Number of days feeling healthy last week:</strong> <?php echo $achievements['SimpleHealthTestAchievement']['healthy_days_last_week'];?> days</p>
<p><strong>My total number of days feeling healthy:</strong> <?php echo $achievements['SimpleHealthTestAchievement']['total_days_healthy'];?> days</p>
<p><strong>My total weeks feeling healthy all week:</strong> <?php echo $achievements['SimpleHealthTestAchievement']['total_full_weeks_healthy'];?> weeks</p>
<p><strong>My consecutive weeks feeling healthy all week:</strong> <?php $total_consecutive_weeks;?> weeks</p>
<?php }?>