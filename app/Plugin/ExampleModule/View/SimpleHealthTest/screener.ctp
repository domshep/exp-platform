<?php $this->extend('/Modules/module_template');?>

<h2>Complete this screening tool to get some feedback on your current health</h2>
<div class="col-md-6 clearfix">
<?php echo $this->Form->create('SimpleHealthTestScreener')?>
    <?php echo $this->Form->input('healthy', array(
    'options' => array('Y'=> 'Yes','N'=>'No'),
    'empty' => '(choose one)',
    'label' => 'Are you healthy?'
));?>
<?php 
$options = array(
    	'label' => 'Calculate my score',
		'class' => 'btn btn-success btn-md bot-buffer pull-right'
	);
	echo $this->Form->end($options);
?>
</div>