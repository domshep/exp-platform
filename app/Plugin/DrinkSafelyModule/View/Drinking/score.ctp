<?php $this->extend('/Modules/module_template');?>
	<?php 
		if ($gender == "F"){ 
			$genderString = "women";
			$passrate = 15 * 4; // month
			$numforgender = 6;
		}
		else {
			$genderString = "men";
			$passrate = 20 * 4; // month
			$numforgender = 8;
		}
	?>
    <h2>Your score is: <?php echo $score;?></h2>
    <p>TODO: NEED SCORE CALCULATIONS AND MESSAGES FOR THIS MODULE</p>
    <?php if($score > $passrate) {?>
	<p>[TO DO: Failure Message ]</p>
    <?php } else {?>
	<p>[TO DO: Pass Message ]
    <?php }
	
	if ($binge > 0){
		?><p><strong>Warning</strong>: For <?php echo $genderString; ?>, consuming more than <?php echo $numforgender; ?> units on any one occassion is classified as binge drinking and is harmful to your health.</p><?php
	}
    
	echo $this->Form->create('DrinkingScreener', array(
    	'inputDefaults' => array(
        'label' => false
    )));
    
    echo $this->Form->hidden('how_often');
    echo $this->Form->hidden('how_much',array('value'=>'$how_many'));
    echo $this->Form->hidden('binge');
    echo $this->Form->hidden('gender');
    echo $this->Form->hidden('DrinkingScreener.score', array('value'=>$score));
    
	$options = array(
    	'label' => 'Add the Drink Safely module to my dashboard'
	);
	
	echo $this->Form->end($options);
?>