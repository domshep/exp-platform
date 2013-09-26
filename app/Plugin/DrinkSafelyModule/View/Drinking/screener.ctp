<?php $this->extend('/Modules/module_template'); ?>
<h2>Complete this screening tool to get some feedback on your drinking habits</h2>
<p class="lead">Click the information icon for help to work out how many units are in your drinks.
	<a data-toggle="modal" href="#help" class="info" title="Click for information about how many units are in your drinks">
	<?php 
		echo $this->Html->image(
			'info-icon.png', 
			array('alt' => 'What is this?',
				'class' => 'info')
		);
	?>
	</a>
</p>
<div class="col-md-12">
<?php 
	echo $this->Form->create('DrinkingScreener', array(
			'class' => 'form-horizontal'));
?>
<div class="row">
	<div class="col-md-12">
	<?php 
		echo $this->Form->input('how_often', array(
			'options' => array(0 => 'Never', 1 => 'Monthly or Less', 2 => '2-4 times a month', 3 => '2-3 times a week', 4 => '4+ times a week'),
			'empty' => '(choose one)',
			'label' => array('text' => 'How often do you have a drink containing alcohol?'),
			'horiz' => true
		));

		echo $this->Form->input('how_many', array(
			'options' => array(0 => '0 - 2 units', 1 => '3 - 4 units', 2 => '5 - 6 units', 3 => '7 - 9 units', 4 => '10 or more units'),
			'empty' => '(choose one)',
			'label' => array('text' => 'How many units of alcohol if any, do you drink on a typical day when you are drinking?'),
			'horiz' => true
		));

		echo $this->Form->hidden('gender',array('value'=>$gender));
		
		if ($gender == "F") $recunits = " 6 ";
		else $recunits = " 8 ";
	
		echo $this->Form->input('binge', array(
			'options' => array(0 => 'Never', 1 => 'Less than monthly', 2 => 'Monthly', 3 => 'Weekly', 4 => 'Daily or Almost Daily'),
			'empty' => '(choose one)',
			'label' => array('text' => 'How often have you had ' . $recunits . 'or more units on a single occasion during the last 8 weeks?'),
			'horiz' => true
		));
	?>
	</div>
</div>
	<?php
	$options = array(
			'label' => 'Calculate my score',
			'class' => 'btn btn-success btn-md bot-buffer pull-right'
	);
	echo $this->Form->end($options); ?>
</div>

<?php echo $this->element('unit_information'); ?>
