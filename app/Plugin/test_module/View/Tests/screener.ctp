<?php $this->extend('/Modules/module_template');?>

<h3>Complete this screening tool to get some feedback on your current health</h3>
<br>
<?php echo $this->Form->create('TestScreener')?>
    
    <?php echo $this->Form->input('healthy', array(
    'options' => array('Y'=> 'Y','N'=>'N'),
    'empty' => '(choose one)',
    'label' => 'Are you healthy?'
));?>
<?php 
$options = array(
    'label' => 'Calculate my score'
);

echo $this->Form->end($options);
?>