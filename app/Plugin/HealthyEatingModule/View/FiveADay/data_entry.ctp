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
	<p>How many portions of different fruit and vegetables did you eat this week? Enter 0 if you haven't eaten any portions of fruit or vegetables that day.</p>
<?php echo $this->Form->create('HealthyEating.FiveADayWeekly', array(
    'inputDefaults' => array(
        'label' => false
    ))) ?>
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
			<td><?php echo $this->Form->input('FiveADayWeekly.monday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('FiveADayWeekly.tuesday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('FiveADayWeekly.wednesday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('FiveADayWeekly.thursday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('FiveADayWeekly.friday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('FiveADayWeekly.saturday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('FiveADayWeekly.sunday',array('label'=>false)); ?></td>
			<td><?php 
				echo $this->Form->input('FiveADayWeekly.total',array('readonly'=>true,'label'=>false)); 
				echo $this->Form->hidden('FiveADayWeekly.week_beginning',array('value'=>date('Y-m-d',$weekBeginning)));
				echo $this->Form->hidden('FiveADayWeekly.id');
			?></td>
		</tr>
	</table>
<p><?php echo $this->Form->end(__('Submit')); ?></p>
</div>
<script type="text/javascript">
jQuery(".weekly-total input").bind("keyup", function() {
    var $tr = $(this).closest("tr");
    var monday = parseFloat($tr.find("#FiveADayWeeklyMonday").val());
    var tuesday = parseFloat($tr.find("#FiveADayWeeklyTuesday").val());
    var wednesday = parseFloat($tr.find("#FiveADayWeeklyWednesday").val());
    var thursday = parseFloat($tr.find("#FiveADayWeeklyThursday").val());
    var friday = parseFloat($tr.find("#FiveADayWeeklyFriday").val());
    var saturday = parseFloat($tr.find("#FiveADayWeeklySaturday").val());
    var sunday = parseFloat($tr.find("#FiveADayWeeklySunday").val());
    if(isNaN(monday)) monday = 0;
    if(isNaN(tuesday)) tuesday = 0;
    if(isNaN(wednesday)) wednesday = 0;
    if(isNaN(thursday)) thursday = 0;
    if(isNaN(friday)) friday = 0;
    if(isNaN(saturday)) saturday = 0;
    if(isNaN(sunday)) sunday = 0;
    $tr.find("#FiveADayWeeklyTotal").val(monday + tuesday + wednesday + thursday + friday + saturday + sunday);
});
</script>