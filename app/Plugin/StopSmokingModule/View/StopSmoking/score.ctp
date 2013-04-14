<?php $this->extend('/Modules/module_template');?>
    <h1>Your have indicated that you are <?php if ($smokes == 0) echo "not" ?> a smoker</h1>
    <?php 
    if($smokes==0) {?>
    <p>Congratulations - you are smoke free!</p>
    <?php } else {?>
    <p>Sorry, You aren't smoke free</p>
    <?php }

    echo $this->Form->create('StopSmokingScreener', array(
    'inputDefaults' => array(
        'label' => false
    )));
    
    echo $this->Form->hidden('StopSmokingScreener.smoker', array('value'=>$smokes));
    
    
	$options = array(
	    'label' => 'Add the module to my dashboard'
	);

	echo $this->Form->end($options);
?>