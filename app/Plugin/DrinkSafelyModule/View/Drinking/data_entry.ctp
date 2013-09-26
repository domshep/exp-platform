<?php $this->extend('/Modules/module_template'); ?>
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

<p class="lead">How many units of alcohol did you manage this week? Enter 0 if you didn't drink any that day.
			<a data-toggle="modal" href="#help" class="info" title="Click for more information on what counts as a unit of alcohol">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'How much is a unit of alcohol?',
						'class' => 'info')
				);
			?>
			</a></p>
<p>For further help to calculate your alcohol units, use the unit calculator on <a href="http://www.drinkwisewales.org.uk" target="_blank">Drinkwise Wales</a>.</p>
			
<?php echo $this->Form->create('DrinkSafelyModule.DrinkingWeekly') ?>
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
	</tbody>
</table>
<div class="form-group">
	<label for="DrinkingWeeklyWhatWorked">What worked for me this week?
		<a data-toggle="modal" href="#whatworked" class="info" title="Click for more information on the 'What worked for me?' box">
		<?php 
			echo $this->Html->image(
				'info-icon.png', 
				array('alt' => 'What is this?',
					'class' => 'info')
			);
		?>
		</a></label>
	<?php echo $this->Form->textarea('DrinkingWeekly.what_worked',array('rows'=>'5')); ?>
</div>
<div class="submit">
         <?php echo $this->Form->submit(__('Submit', true), array('name' => 'ok', 'div' => false, 'id' =>'submit', 'class' => 'btn btn-success btn-md bot-buffer pull-right')); ?>
         <?php echo $this->Form->submit(__('Cancel (without saving changes)', true), array('name' => 'cancel','div' => false, 'id' =>'cancel', 'class' => 'btn btn-default btn-md bot-buffer pull-right')); ?>
</div>
<?php echo $this->Form->end(); ?>

<script type="text/javascript">
jQuery(".weekly-entry input").bind("keyup", function() {
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

<?php echo $this->element('unit_information'); ?>
<?php echo $this->element('what_worked'); ?>
