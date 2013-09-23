<?php $this->extend('/Modules/module_template');?>
<h3 class="week-commencing"><?php 

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
}?></h3>
<p class="lead">How healthy have you felt each day this week? Give yourself a score out of 10...
		<a data-toggle="modal" href="#help" class="info" title="Click for more information">
		<?php 
			echo $this->Html->image(
				'info-icon.png', 
				array('alt' => 'Click for more information',
					'class' => 'info')
			);
		?>
		</a></p>
<?php echo $this->Form->create('ExampleModule.SimpleHealthTestWeekly', array(
    'inputDefaults' => array(
        'label' => false
    ))) ?>
<table class="table weekly-entry">
	<thead>
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
	</thead>
	<tbody>
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
	</tbody>
	</table>
	<div class="form-group">
		<label for="SimpleHealthTestWeeklyWhatWorked">What worked for me this week?
		<a data-toggle="modal" href="#whatworked" class="info" title="Click for more information on the 'What worked for me?' box">
		<?php 
			echo $this->Html->image(
				'info-icon.png', 
				array('alt' => 'What is this?',
					'class' => 'info')
			);
		?>
		</a></label>
		<?php echo $this->Form->textarea('SimpleHealthTestWeekly.what_worked',array('rows'=>'5')); ?>
	</div>
	<div class="submit">
         <?php echo $this->Form->submit(__('Submit', true), array('name' => 'ok', 'div' => false, 'id' =>'submit', 'class' => 'btn btn-success btn-md bot-buffer pull-right')); ?>
         <?php echo $this->Form->submit(__('Cancel (without saving changes)', true), array('name' => 'cancel','div' => false, 'id' =>'cancel', 'class' => 'btn btn-default btn-md bot-buffer pull-right')); ?>
	</div>
	<?php echo $this->Form->end(); ?>
<script type="text/javascript">
<!--
	jQuery(".weekly-entry input").bind("keyup", function() {
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
<!-- This contains the hidden content for inline calls -->
<div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          	<h4 class="modal-title" id="helpModalLabel">Help for the Example Module</h4>
        </div>
        <div class="modal-body">
			<p>This is where you can display extra information and suggestions for this data entry page.</p>
		</div>
	  </div>
	</div>
</div>
<?php echo $this->element('what_worked'); ?>