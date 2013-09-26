<?php
if (empty($achievements)) {?>
<p>You haven't yet recorded enough weekly data to be able to calculate your achievements.</p>
<?php } else { ?>
<ul class="list-group">
  	<li class="list-group-item">
  		Total days within sensible drinking limits:
  		<span class="label label-primary pull-right"><?php echo $achievements['DrinkingAchievement']['total_sensible_days']; ?></span>
	</li>
	<li class="list-group-item">
  		Total days exceeding sensible drinking limits:
		<span class="label label-primary pull-right"><?php echo $achievements['DrinkingAchievement']['total_excess_days']; ?></span>
	</li>
	<li class="list-group-item">
		Total days exceeding binge drinking levels:
		<span class="label label-primary pull-right"><?php echo $achievements['DrinkingAchievement']['total_binge_days'];?></span>
	</li>
</ul>
<?php }?>