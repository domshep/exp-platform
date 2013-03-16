<?php $this->extend('/Modules/module_template');?>

    <h1>Your score is <?php echo $score;?></h1>
    <?php 
    if($score==100) {?>
    <p>Congratulations - you are a healthy specimen. Keep it up!</p>
    <?php } else {?>
    <p>Oh, so close. Go and lie down.</p>
    <?php }

    echo $this->Form->create('SimpleHealthTestScreener', array(
    'inputDefaults' => array(
        'label' => false
    )));
    
    echo $this->Form->hidden('healthy');
    echo $this->Form->hidden('SimpleHealthTestScreener.score', array('value'=>$score));
    
    
    
$options = array(
    'label' => 'Add the module to my dashboard'
);

echo $this->Form->end($options);
?>