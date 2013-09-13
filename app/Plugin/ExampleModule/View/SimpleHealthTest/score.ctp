<?php $this->extend('/Modules/module_template');?>
    <h2>Your score is <?php echo $score;?></h2>
    <?php 
    if($score==100) {?>
    <p class="lead">Congratulations - you are a healthy specimen. Keep it up!</p>
    <?php } else {?>
    <p class="lead">Oh, so close. Go and lie down.</p>
    <?php }

    echo $this->Form->create('SimpleHealthTestScreener', array(
    'inputDefaults' => array(
        'label' => false
    )));
    
    echo $this->Form->hidden('healthy');
    echo $this->Form->hidden('SimpleHealthTestScreener.score', array('value'=>$score));
    
$options = array(
    'label' => 'Add the module to my dashboard',
	'class' => 'btn btn-success btn-md bot-buffer pull-right'
);

echo $this->Form->end($options);
?>