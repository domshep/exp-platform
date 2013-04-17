<?php $this->extend('/Modules/module_template'); ?>
<h2>Complete this screening tool to get some feedback on your current exercise</h2>
<p>This assessment helps measure how much physical activity you have been undertaking over the last <em style="font-weight:bold;font-style:italic;">7 days</em> in comparison to recommended levels</p>
<p>Please complete the assessment for each type of exercise. If you <em style="font-weight:bold;font-style:italic;">have not</em> achieved any of a particular type of exercise within the last 7 days, select &lsquo;none&rsquo; and move down to the next exercise category.</p>
<p>If you <em style="font-weight:bold;font-style:italic;">have</em> achieved some exercise within a particular exercise category, please select on how many days within the last week, and how many minutes on an average day.</p>
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
    				'options' => array(0 => 'None', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 
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
    				'options' => array(0 => 'None', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 
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
    				'options' => array(0 => 'None', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 
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

<script type="text/javascript">
$(document).ready(function() {
	$('#ExerciseScreenerVigorousDays').change(function() {
		if(this.value == 0) {
			$('#ExerciseScreenerVigorousMins').val("0").hide();
		} else {
			$('#ExerciseScreenerVigorousMins').show();
		}
	});
	$('#ExerciseScreenerModerateDays').change(function() {
		if(this.value == 0) {
			$('#ExerciseScreenerModerateMins').val("0").hide();
		} else {
			$('#ExerciseScreenerModerateMins').show();
		}
	});
	$('#ExerciseScreenerWalkingDays').change(function() {
		if(this.value == 0) {
			$('#ExerciseScreenerWalkingMins').val("0").hide();
		} else {
			$('#ExerciseScreenerWalkingMins').show();
		}
	});
});
</script>