<?php $this->extend('/Modules/module_template'); ?>
<h2>Complete this screening tool to get some feedback on your drinking habits</h2>
<br />
<?php echo $this->Form->create('DrinkingScreener', array(
    'inputDefaults' => array(
        'label' => false
    )))?>
<table class="quiztable">
	<tr>
		<th class="colblue col1">Questions</th>
		<th class="colgreen col2">Answers</th>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>How often do you have a drink containing alcohol?</strong> 
		</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('how_often', array(
    				'options' => array(0 => 'Never', 1 => 'Monthly or Less', 2 => '2-4 times a month', 3 => '2-3 times a week', 4 => '4+ times a week', 'empty' => '(choose one)'),'style'=>'width: 200px;'
				));?>
		</td>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>How many units of alcohol if any, do you drink on a typical day when you are drinking?</strong>
		</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('how_many', array(
    				'options' => array(0 => '0 - 2 units', 1 => '3 - 4 units', 2 => '5 - 6 units', 3 => '7 - 9 units', 4 => '10 or more units', 'empty' => '(choose one)'),'style'=>'width: 200px;'
				));
			?>
		</td>
	</tr>
	<tr>
		<td class="colblue col1">
			<?php echo $this->Form->hidden('gender',array('value'=>$gender)); ?>
			<strong>How often have you had 
			<?php 
				if ($gender == "F") echo " 6 ";
				else echo " 8 ";
			?> 
			or more units on a single occasion during the last 8 weeks?</strong>
		</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('binge', array(
    				'options' => array(0 => 'Never', 1 => 'Less than monthly', 2 => 'Monthly', 3 => 'Weekly', 4 => 'Daily or Almost Daily', 'empty' => '(choose one)'),'style'=>'width: 200px;'
				));
			?>
		</td>
	</tr>
</table>
<?php 
	$options = array(
    	'label' => 'Calculate my score'
	);
	echo $this->Form->end($options);
?>