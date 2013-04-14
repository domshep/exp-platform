<?php
	$medal = "";
	$consecWeeks = $achievements['ExerciseAchievement']['consec_healthy_weeks'];
	if ($consecWeeks >= 8){ 
		$medal = "Gold";
		$weekstogo = 0;
		$nextmedal = "";
	}
	elseif ($consecWeeks >= 4){
	 	$medal = "Silver";
		$weekstogo = 8-$consecWeeks;
		$nextmedal = "Gold";
	}
	elseif ($consecWeeks >= 2){ 
		$medal = "Bronze";
		$weekstogo = 4-$consecWeeks;
		$nextmedal = "Silver";
	}
	else
	{
		$medal = "";
		$weekstogo = 2-$consecWeeks;
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
		echo "You have achieved Your " . $medal . " Medal by doing 150 minutes of exercise or more all week for " . $consecWeeks;
		echo " week". $s . " in a row.</p>"; 
	}
	else echo "<p>So far you have done 150 minutes of exercise or more for ". $consecWeeks . " week". $s ." in a row.</p>";
	
	if ($nextmedal != "")
	{ 
		echo "<p>Just "; 
		if ($weekstogo != 1) $s = "s";
		else $s = "";
		echo $weekstogo . " more week". $s ." before you reach the " . $nextmedal . " medal! Keep up the good work!</p>";
	} 
	echo "<p>You can do it!</p>";
?>