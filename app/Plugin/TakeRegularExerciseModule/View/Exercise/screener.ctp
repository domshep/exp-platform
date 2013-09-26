<?php $this->extend('/Modules/module_template'); ?>
<h2>Complete this screening tool to get some feedback on your current
	exercise levels</h2>
<p class="lead">
	This assessment helps measure how much physical activity you have been
	undertaking over the last <em><strong>7 days</strong></em> in
	comparison to recommended levels
</p>
<p>
	Please complete the assessment for each type of exercise. If you <em><strong>have not</strong></em> achieved
	any of a particular type of exercise within the last 7 days, select
	&lsquo;none&rsquo; and move down to the next exercise category.
</p>
<p>
	If you <em><strong>have</strong></em>
	achieved some exercise within a particular exercise category, please
	select on how many days within the last week, and how many minutes on
	an average day.
</p>
<div class="col-md-10 col-md-offset-1">
	<?php echo $this->Form->create('ExerciseScreener', array(
			'inputDefaults' => array(
	        'label' => false
	    )))?>
	<table class="table table-hover">
		<thead>
		<tr>
			<th>Type of Exercise</th>
			<th>On how many days in the last week have you
				undertaken this exercise?</th>
			<th class="col-md-2">When you did this exercise, how many minutes
				did you do on an average day?</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td><strong>Vigorous physical activities<a
					id="vigorous" class="infohover"
					title="Activities that take hard physical effort and make you breathe much harder than normal (10 minute or more periods)">
						<?php 
						echo $this->Html->image(
						'info-icon.png',
						array('alt' => 'info',
							'class' => 'info')
					);
				?>
				</a>
			</strong> like heavy lifting, digging, aerobics or running?</td>
			<td><?php 
			echo $this->Form->input('vigorous_days', array(
	    				'options' => array(0 => 'None', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days',
						6 => '6 days', 7 => '7 days'), 'empty' => '(choose one)'
					));?>
			</td>
			<td><?php echo $this->Form->input('vigorous_mins',array('label'=>false, 'style'=>'width:4em;')); ?>
			</td>
		</tr>
		<tr>
			<td><strong>Moderate physical activites<a
					id="moderate" class="infohover"
					title="Activities that take moderate physical effort and make you breathe somewhat harder than normal (10 minute or more periods)">
						<?php 
						echo $this->Html->image(
						'info-icon.png',
						array('alt' => 'info',
							'class' => 'info')
					);
				?>
				</a>
			</strong> like carrying light loads, bicycling at a regular pace, or
				doubles tennis</td>
			<td><?php 
			echo $this->Form->input('moderate_days', array(
	    				'options' => array(0 => 'None', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days',
						6 => '6 days', 7 => '7 days'), 'empty' => '(choose one)'
					));
				?>
			</td>
			<td><?php echo $this->Form->input('moderate_mins',array('label'=>false, 'style'=>'width:4em;')); ?>
			</td>
		</tr>
		<tr>
			<td><strong>Walking activities<a id="walking"
					class="infohover"
					title="Activities including travelling to / from work and home, any other walking related to recreation, sport, exercise or leisure">
						<?php 
						echo $this->Html->image(
						'info-icon.png',
						array('alt' => 'info',
							'class' => 'info')
					);
				?>
				</a>:
			</strong> including any walking related to recreation, sport, exercise
				or leisure.</td>
			<td><?php 
			echo $this->Form->input('walking_days', array(
	    				'options' => array(0 => 'None', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days',
						6 => '6 days', 7 => '7 days'), 'empty' => '(choose one)'
					));
				?>
			</td>
			<td><?php echo $this->Form->input('walking_mins',array('label'=>false, 'style'=>'width:4em;')); ?>
			</td>
		</tr>
		<tr>
			<td><strong>Sedentary activities<a id="sedentary"
					class="infohover"
					title="Activities involving time spent sitting at work, home, studying or leisure time, including sitting at desks, visiting friends, reading, sitting / lying watching tv">
						<?php 
						echo $this->Html->image(
						'info-icon.png',
						array('alt' => 'info',
							'class' => 'info')
					);
				?>
				</a>:
			</strong> How much time did you spend sitting on a weekday?</td>
			<td>&nbsp;</td>
			<td><?php echo $this->Form->input('sedentary_mins',array('label'=>false, 'style'=>'width:4em;')); ?>
			</td>
		</tr>
		</tbody>
	</table>
	<?php 
	$options = array(
    	'label' => 'Calculate my score',
		'class' => 'btn btn-success btn-md bot-buffer pull-right'
	);
	echo $this->Form->end($options);
	?>
</div>

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
