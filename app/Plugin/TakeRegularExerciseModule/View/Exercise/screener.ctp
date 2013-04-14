<?php $this->extend('/Modules/module_template'); ?>
<h2>Complete this screening tool to get some feedback on your current exercise</h2>
<br />
<?php echo $this->Form->create('ExerciseScreener', array(
    'inputDefaults' => array(
        'label' => false
    )))?>
<table class="quiztable">
	<tr>
		<th class="colblue col1">Type of Exercise</th>
		<th class="colgreen col2">On how many days in the last week have you undertaken this exercise?</th>
		<th class="colpeach col3">When you did this exercise, how many minutes did you do on an average day?</th>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>Vigorous physical activities</strong> 
			like heavy lifting, digging, aerobics or running?
		</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('vigorous_days', array(
    				'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 
					6 => '6 days', 7 => '7 days'), 'empty' => '(choose one)'
				));?>
		</td>
		<td class="colpeach col3"><?php echo $this->Form->input('vigorous_mins',array('label'=>false, 'style'=>'width:30px;')); ?></td>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>Moderate physical activites</strong>
 			like carrying light loads, bicycling at a regular pace, or doubles tennis
		</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('moderate_days', array(
    				'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 
					6 => '6 days', 7 => '7 days'), 'empty' => '(choose one)'
				));
			?>
		</td>
		<td class="colpeach col3"><?php echo $this->Form->input('moderate_mins',array('label'=>false, 'style'=>'width:30px;')); ?></td>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>Walking activities:</strong>
 			including any walking related to recreation, sport, exercise or leisure. 		
		</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('walking_days', array(
    				'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 
					6 => '6 days', 7 => '7 days'), 'empty' => '(choose one)'
				));
			?>
		</td>
		<td class="colpeach col3"><?php echo $this->Form->input('walking_mins',array('label'=>false, 'style'=>'width:30px;')); ?></td>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>Sedentary activities:</strong>
 			How much time did you spend sitting on a weekday? 
		</td>
		<td class="colgreen col2">&nbsp;</td>
		<td class="colpeach col3"><?php echo $this->Form->input('sedentary_mins',array('label'=>false, 'style'=>'width:30px;')); ?></td>
	</tr>
</table>
<?php 
	$options = array(
    	'label' => 'Calculate my score'
	);
	echo $this->Form->end($options);
?>