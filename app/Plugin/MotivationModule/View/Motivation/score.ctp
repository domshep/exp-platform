<?php 
	$this->extend('/Modules/module_template');?>
    <h1>Your reason has been submitted</h1>
    <?php 
    
    echo $this->Form->create('MotivationScreener', array(
    'inputDefaults' => array(
        'label' => false
    )));
    
    echo $this->Form->hidden('reason', array('value'=>$reason);
    echo $this->Form->hidden('created_date');
    echo $this->Form->hidden('module_id', array('value'=>'3')); // Need to get the 'Module Number automatically!
    
	$options = array(
    	'label' => 'Save my Reason and Add the module to my dashboard'
	);

	echo $this->Form->end($options);
?>