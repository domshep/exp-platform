<?php $this->extend('/Modules/module_template');?>

    <h2>Your score is <?php echo $score;?></h2>
    <p>TODO: NEED SCORE CALCULATIONS AND MESSAGES FOR THIS MODULE</p>
    <?php if($score < 35) {?>
	<p>[TO DO: Failure Message ]</p>
    <?php } else {?>
	<p>[TO DO: Pass Message ]</p>
    <?php }?>
    
    <?php echo $this->Form->create('FiveADayScreener', array(
    'inputDefaults' => array(
        'label' => false
    )));
    
    echo $this->Form->hidden('vigorous_never');
    echo $this->Form->hidden('vigorous_days');
    echo $this->Form->hidden('vigourous_mins');
    echo $this->Form->hidden('moderate_never');
    echo $this->Form->hidden('moderate_days');
    echo $this->Form->hidden('moderate_mins');
    echo $this->Form->hidden('walking_never');
    echo $this->Form->hidden('walking_days');
    echo $this->Form->hidden('walking_mins');
    echo $this->Form->hidden('sedentary_mins');
    echo $this->Form->hidden('ExerciseScreener.score', array('value'=>$score));
    
    
    
$options = array(
    'label' => 'Add the exercise module to my dashboard'
);

echo $this->Form->end($options);
?>