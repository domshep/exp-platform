<?php
	$medal = "";
	$consecWeeks = $achievements['BmiAchievement']['consec_healthy_weeks'];
	if ($consecWeeks >= 12){ 
		$medal = "Gold";
		$weekstogo = 0;
		$nextmedal = "";
	}
	elseif ($consecWeeks >= 8){
	 	$medal = "Silver";
		$weekstogo = 12-$consecWeeks;
		$nextmedal = "Gold";
	}
	elseif ($consecWeeks >= 4){ 
		$medal = "Bronze";
		$weekstogo = 8-$consecWeeks;
		$nextmedal = "Silver";
	}
	else
	{
		$medal = "";
		$weekstogo = 4-$consecWeeks;
		$nextmedal = "Bronze";
	}
	
	if ($medal == "") echo "<h4><strong>Keep it Up</strong></h4>";
	else echo "<h4><strong>Congratulations, You have earned your ". $medal ." medal!</strong></h4>"; 
	
	if ($consecWeeks != 1) $s = "s";
	else $s = "";
	
	if ($medal != "")
	{
		echo "<p>";
		echo $this->Html->image(
			'Medal-'. $medal .'-icon.png',
			array('alt' => $medal . ' Medal', 'align' => 'right')
		);
		echo "You have achieved Your " . $medal . " Medal by eating an average of 5-a-day for " . $consecWeeks;
		echo " week". $s . ".</p>"; 
	}
	else echo "<p>So far you have eaten 5-a-day for ". $consecWeeks . " week". $s .".</p>";
	
	if ($nextmedal != "")
	{ 
		echo "<p>Just "; 
		if ($weekstogo != 1) $s = "s";
		else $s = "";
		echo $weekstogo . " more week". $s ." before you reach the " . $nextmedal . " medal! Keep up the good work!</p>";
	} 
	echo "<p>You can do it!</p>";
?>