<?php $this->extend('/Modules/module_template');?>
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
	<p>How healthy have you felt each day this week? Give yourself a score out of 10...
			<a href="#help" class="info" title="Help?">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'Help?')
				);
			?>
			</a></p>
<?php echo $this->Form->create('ExampleModule.SimpleHealthTestWeekly', array(
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
			<td><?php echo $this->Form->input('SimpleHealthTestWeekly.monday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('SimpleHealthTestWeekly.tuesday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('SimpleHealthTestWeekly.wednesday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('SimpleHealthTestWeekly.thursday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('SimpleHealthTestWeekly.friday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('SimpleHealthTestWeekly.saturday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('SimpleHealthTestWeekly.sunday',array('label'=>false)); ?></td>
			<td><?php 
				echo $this->Form->input('SimpleHealthTestWeekly.total',array('readonly'=>true,'label'=>false)); 
				echo $this->Form->hidden('SimpleHealthTestWeekly.week_beginning',array('value'=>date('Y-m-d',$weekBeginning)));
				echo $this->Form->hidden('SimpleHealthTestWeekly.id');
			?></td>
		</tr>
		<tr>
			<td colspan="8"><label for="SimpleHealthTestWeeklyWhat_Worked">What worked for you this week?
			<a href="#whatworked" class="info" title="What is this?">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'What is this?')
				);
			?>
			</a></label>
			<?php echo $this->Form->textarea('SimpleHealthTestWeekly.what_worked',array('label'=>'false', 'cols'=>'35', 'rows'=>'5')); ?></td>
		</tr>
	</table>
<p><?php echo $this->Form->end(__('Submit')); ?></p>
</div>
<script type="text/javascript">
<!--
	jQuery(".weekly-total input").bind("keyup", function() {
    var $tr = $(this).closest("tr");
    var monday = parseFloat($tr.find("#SimpleHealthTestWeeklyMonday").val());
    var tuesday = parseFloat($tr.find("#SimpleHealthTestWeeklyTuesday").val());
    var wednesday = parseFloat($tr.find("#SimpleHealthTestWeeklyWednesday").val());
    var thursday = parseFloat($tr.find("#SimpleHealthTestWeeklyThursday").val());
    var friday = parseFloat($tr.find("#SimpleHealthTestWeeklyFriday").val());
    var saturday = parseFloat($tr.find("#SimpleHealthTestWeeklySaturday").val());
    var sunday = parseFloat($tr.find("#SimpleHealthTestWeeklySunday").val());
    if(isNaN(monday)) monday = 0;
    if(isNaN(tuesday)) tuesday = 0;
    if(isNaN(wednesday)) wednesday = 0;
    if(isNaN(thursday)) thursday = 0;
    if(isNaN(friday)) friday = 0;
    if(isNaN(saturday)) saturday = 0;
    if(isNaN(sunday)) sunday = 0;
    $tr.find("#SimpleHealthTestWeeklyTotal").val(monday + tuesday + wednesday + thursday + friday + saturday + sunday);
});
//-->

</script>
<!-- This contains the hidden content for inline calls * More Common PopUps are provided in default.ctp * -->
<div style='display:none'>
	<div id='help' class='popup'>
		<h3>Information: Help for the Example Module</h3>
		<p>This is where you will display the information about this data entry page.</p>
	</div>
</div>