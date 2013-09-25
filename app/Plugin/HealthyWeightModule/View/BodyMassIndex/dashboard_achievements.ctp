<?php
if (empty($achievements)) {?>
<p>You haven't yet recorded enough weekly data to be able to calculate your achievements.</p>
<?php } else { ?>
<ul class="list-group">
  	<li class="list-group-item">
  		My current BMI score:
		<span class="label label-primary pull-right"><?php echo $achievements['BmiAchievement']['latest_bmi'];?></span>
	</li>
  	<li class="list-group-item">
		My total weight change since week 1:
		<span class="label label-primary pull-right"><?php 
			$kgs = $achievements['BmiAchievement']['change_since_start'];
			if ($kgs >= 0) $sign = "+ ";
			else $sign = " "; 
			echo $sign . round(($kgs * 2.20462),0) . "lbs"; 
			echo " (" . $sign . $kgs; ?>kg)</span>
	</li>
</ul>
<?php } ?>