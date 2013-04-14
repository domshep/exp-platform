<?php $this->extend('/Modules/module_template');?>

<h3>Complete this screening tool to get some feedback on your current health</h3>
<br>
<?php echo $this->Form->create('StopSmokingScreener')?>
    
    <?php echo $this->Form->input('smokes', array(
    'options' => array('Y'=> 'Y','N'=>'N'),
    'empty' => '(choose one)',
    'label' => 'Do you smoke, or have you had a cigarette in the past 4 weeks?'
));?>
<?php 
$options = array(
    'label' => 'Am I a smoker?'
);

echo $this->Form->end($options);
?>