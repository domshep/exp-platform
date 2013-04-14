<?php $this->extend('/Modules/module_template'); ?>
<div>
	<h2><?php 
	
	?>Week Commencing: <?php
	echo $this->Html->image(
			'Actions-go-previous-view-icon.png',
			array('alt' => 'Previous week',
				  'url' => 'data_entry/' . date('Ymd',$previousWeek),
				  'class' => 'previous',
				  'title' => 'Go to previous week'
			)
	);
	echo date('d-m-Y',$weekBeginning);
	
	if(isset($nextWeek)) {
		echo $this->Html->image(
				'Actions-go-next-view-icon.png',
				array('alt' => 'Next week',
					  'url' => 'data_entry/' . date('Ymd',$nextWeek),
					  'class' => 'next',
					  'title' => 'Go to next week'
				)
		);
	}?></h2>
	<p>How many minutes of exercise did you manage this week? Enter 0 if you didn't do any on that day.
			<a href="#portion" class="info" title="What counts as Exercise?">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'What counts as Exercise?',
						'class' => 'info')
				);
			?>
			</a></p>
<?php echo $this->Form->create('TakeRegularExercise.ExerciseWeekly') ?>
	<table class="weekly-total">
		<tr>
			<th>Monday</th>
			<th>Tuesday</th>
			<th>Wednesday</th>
			<th>Thursday</th>
			<th>Friday</th>
			<th>Saturday</th>
			<th>Sunday</th>
			<th>TOTAL</th>
		</tr>
		<tr>
			<td><?php echo $this->Form->input('ExerciseWeekly.monday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('ExerciseWeekly.tuesday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('ExerciseWeekly.wednesday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('ExerciseWeekly.thursday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('ExerciseWeekly.friday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('ExerciseWeekly.saturday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('ExerciseWeekly.sunday',array('label'=>false)); ?></td>
			<td><?php 
				echo $this->Form->input('ExerciseWeekly.total',array('readonly'=>true,'label'=>false)); 
				echo $this->Form->hidden('ExerciseWeekly.week_beginning',array('value'=>date('Y-m-d',$weekBeginning)));
				echo $this->Form->hidden('ExerciseWeekly.id');
			?></td>
		</tr>
		<tr>
			<td colspan="8"><label for="ExerciseWeeklyWhat_Worked">What worked for me this week?
			<a href="#whatworked" class="info" title="What is this?">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'What is this?',
						'class' => 'info')
				);
			?>
			</a></label><?php echo $this->Form->textarea('ExerciseWeekly.what_worked',array('label'=>'false', 'cols'=>'35', 'rows'=>'5')); ?></td>
		</tr>
	</table>
<p><?php echo $this->Form->end(__('Submit')); ?></p>
</div>
<script type="text/javascript">
jQuery(".weekly-total input").bind("keyup", function() {
    var $tr = $(this).closest("tr");
    var monday = parseFloat($tr.find("#ExerciseWeeklyMonday").val());
    var tuesday = parseFloat($tr.find("#ExerciseWeeklyTuesday").val());
    var wednesday = parseFloat($tr.find("#ExerciseWeeklyWednesday").val());
    var thursday = parseFloat($tr.find("#ExerciseWeeklyThursday").val());
    var friday = parseFloat($tr.find("#ExerciseWeeklyFriday").val());
    var saturday = parseFloat($tr.find("#ExerciseWeeklySaturday").val());
    var sunday = parseFloat($tr.find("#ExerciseWeeklySunday").val());
    if(isNaN(monday)) monday = 0;
    if(isNaN(tuesday)) tuesday = 0;
    if(isNaN(wednesday)) wednesday = 0;
    if(isNaN(thursday)) thursday = 0;
    if(isNaN(friday)) friday = 0;
    if(isNaN(saturday)) saturday = 0;
    if(isNaN(sunday)) sunday = 0;
    $tr.find("#ExerciseWeeklyTotal").val(monday + tuesday + wednesday + thursday + friday + saturday + sunday);
});
</script>


<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
	<div id='portion' class='popup'>
		<h3>What Counts As Exercise?</h3>
		<p>TO DO: What Counts as Exercise Text</p>
	</div>
</div>
<?php echo $this->element('what_worked'); ?>