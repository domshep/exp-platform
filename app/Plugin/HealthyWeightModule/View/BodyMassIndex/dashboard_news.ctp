<?php
	$medal = "";
	/* Needed: Original BMI, Current BMI and 'ideal BMI' */
	
	/* What is the ideal 'pass rate'? */
	$idealBMI = (18.5 + 25) / 2; // ideal BMI
	
	$latestBMI = $achievements['BmiAchievement']['latest_bmi'];
	$startBMI = $screeners['BmiScreener']['start_bmi'];
	
	if ($startBMI > $idealBMI){ // reduce BMI
		$lostgained = "lost";
		$incdec = "decrease";
		$reductionNeeded = $startBMI - $idealBMI;
		$goals = $reductionNeeded / 3; 
		$gold = $idealBMI;
		$silver = $idealBMI + $goals;
		$bronze = $idealBMI + ($goals * 2);
		
		if ($latestBMI <= $gold){ 
			$medal = "Gold";
			$nextmedal = "";
			$changeNeededForNextMedal = 0; 
			if ($latestBMI < $idealBMI) $message = "Your BMI is now under the target!";
			else $message = "Well Done, You have achieved your target BMI exactly!";
			$medialBMI = $gold;
		}
		elseif ($latestBMI <= $silver){
	 		$medal = "Silver";
			$changeNeededForNextMedal = $latestBMI - $gold;
			$nextmedal = "Gold";
			$medalBMI = $silver;
		}
		elseif ($latestBMI <= $bronze){ 
			$medal = "Bronze";
			$changeNeededForNextMedal = $latestBMI - $silver;
			$nextmedal = "Silver";
			$medalBMI = $bronze;
		}
		else
		{
			$medal = "";
			$changeNeededForNextMedal = $latestBMI - $bronze;
			$nextmedal = "Bronze";
		}
	}
	else // increase BMI
	{
		$lostgained = "gained";
		$incdec = "increase";
		$increaseNeeded = $idealBMI - $startBMI;
		$goals = $increaseNeeded / 3; 
		$gold = $idealBMI;
		$silver = $idealBMI - $goals;
		$bronze = $idealBMI - ($goals * 2);
		
		if ($latestBMI >= $gold){ 
		$medal = "Gold";
		$nextmedal = "";
			$changeNeededForNextMedal = 0; 
			if ($latestBMI > $idealBMI) $message = "Your BMI is now over your target!";
			else $message = "Well Done, You have achieved your target BMI exactly!";
			$medalBMI = $gold;
	}
		elseif ($latestBMI >= $silver){
	 	$medal = "Silver";
			$changeNeededForNextMedal = $gold - $latestBMI;
		$nextmedal = "Gold";
			$medalBMI = $silver;
	}
		elseif ($consecWeeks >= $bronze){ 
		$medal = "Bronze";
			$changeNeededForNextMedal = $silver - $latestBMI;
		$nextmedal = "Silver";
			$medalBMI = $bronze;
	}
	else
	{
		$medal = "";
			$changeNeededForNextMedal = $bronze - $latestBMI;
		$nextmedal = "Bronze";
	}
	}
	
	
	if ($medal == "") echo "<h4><strong>Keep it Up</strong></h4>";
	else echo "<h4><strong>Congratulations, You have earned your ". $medal ." medal!</strong></h4>"; 
	
	if ($medal != "")
	{
		echo "<p>";
		echo $this->Html->image(
			'Medal-'. $medal .'-icon.png',
			array('alt' => $medal . ' Medal', 'align' => 'right')
		);
		echo "You have achieved Your " . $medal . " Medal by achieving a BMI of " . round($medalBMI,2);
		echo ".</p>"; 
	}
	else echo "<p>Your current BMI is ". $latestBMI . ".</p>";
	
	if ($nextmedal != "")
	{ 
		echo "<p>Just ". $incdec . " your BMI by another "; 
		echo round($changeNeededForNextMedal,2) . " before you'll reach the " . $nextmedal . " medal! Keep up the good work!</p>";
	} 
	echo "<p>You can do it!</p>";
?>