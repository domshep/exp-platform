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
	<p>How many units of alcohol did you manage this week? Enter 0 if you didn't drink any that day.
			<a href="#portion" class="info" title="How much is as a Unit of Alcohol?">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'How much is a unit of alcohol?',
						'class' => 'info')
				);
			?>
			</a></p>
<?php echo $this->Form->create('DrinkSafelyModule.DrinkingWeekly') ?>
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
			<td><?php echo $this->Form->input('DrinkingWeekly.monday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('DrinkingWeekly.tuesday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('DrinkingWeekly.wednesday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('DrinkingWeekly.thursday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('DrinkingWeekly.friday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('DrinkingWeekly.saturday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('DrinkingWeekly.sunday',array('label'=>false)); ?></td>
			<td><?php 
				echo $this->Form->input('DrinkingWeekly.total',array('readonly'=>true,'label'=>false)); 
				echo $this->Form->hidden('DrinkingWeekly.week_beginning',array('value'=>date('Y-m-d',$weekBeginning)));
				echo $this->Form->hidden('DrinkingWeekly.id');
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
			</a></label><?php echo $this->Form->textarea('DrinkingWeekly.what_worked',array('label'=>'false', 'cols'=>'35', 'rows'=>'5')); ?></td>
		</tr>
	</table>
<p><?php echo $this->Form->end(__('Submit')); ?></p>
</div>
<script type="text/javascript">
jQuery(".weekly-total input").bind("keyup", function() {
    var $tr = $(this).closest("tr");
    var monday = parseFloat($tr.find("#DrinkingWeeklyMonday").val());
    var tuesday = parseFloat($tr.find("#DrinkingWeeklyTuesday").val());
    var wednesday = parseFloat($tr.find("#DrinkingWeeklyWednesday").val());
    var thursday = parseFloat($tr.find("#DrinkingWeeklyThursday").val());
    var friday = parseFloat($tr.find("#DrinkingWeeklyFriday").val());
    var saturday = parseFloat($tr.find("#DrinkingWeeklySaturday").val());
    var sunday = parseFloat($tr.find("#DrinkingWeeklySunday").val());
    if(isNaN(monday)) monday = 0;
    if(isNaN(tuesday)) tuesday = 0;
    if(isNaN(wednesday)) wednesday = 0;
    if(isNaN(thursday)) thursday = 0;
    if(isNaN(friday)) friday = 0;
    if(isNaN(saturday)) saturday = 0;
    if(isNaN(sunday)) sunday = 0;
    $tr.find("#DrinkingWeeklyTotal").val(monday + tuesday + wednesday + thursday + friday + saturday + sunday);
});
</script>


<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
	<div id='portion' class='popup'>
		<h3>How much is a unit of Alcohol?</h3>
		<p>TO DO: How much is a unit of alcohol</p>
	</div>
</div>
<?php echo $this->element('what_worked'); ?>