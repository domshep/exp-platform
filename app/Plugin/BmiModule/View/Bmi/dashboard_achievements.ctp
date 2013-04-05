<?php
if (empty($achievements)) {?>
<p>You haven't yet recorded enough weekly data to be able to calculate your achievements.</p>
<?php } else { ?>
<p><strong>My current BMI score:</strong> 
	<?php 
		echo $achievements['BmiAchievement']['latest_bmi'];
	?></p>
<p><strong>My total weight change since week 1:</strong> 
<?php 
	$kgs = $achievements['BmiAchievement']['change_since_start'];
	if ($kgs >= 0) $sign = "+ ";
	else $sign = " "; 
	echo $sign . round(($kgs * 2.20462),0) . "lbs"; 
	echo " (" . $sign . $kgs; ?>kg) </p>
<?php } ?>