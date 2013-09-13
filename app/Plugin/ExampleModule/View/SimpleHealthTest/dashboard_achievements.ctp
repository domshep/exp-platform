<?php
if (empty($achievements)) {?>
<p>You haven't yet recorded enough weekly data to be able to calculate your achievements.</p>
<?php } else {?>
<ul class="list-group">
  <li class="list-group-item">
    Number of days feeling healthy last week:
    <span class="label label-primary pull-right"><?php echo $achievements['SimpleHealthTestAchievement']['healthy_days_last_week'];?> days</span>
  </li>
  <li class="list-group-item">
    My total number of days feeling healthy:
    <span class="label label-primary pull-right"><?php echo $achievements['SimpleHealthTestAchievement']['total_days_healthy'];?> days</span>
  </li>
  <li class="list-group-item">
    My total weeks feeling healthy all week:
    <span class="label label-primary pull-right"><?php echo $achievements['SimpleHealthTestAchievement']['total_full_weeks_healthy'];?> weeks</span>
  </li>
</ul>
<?php }?>