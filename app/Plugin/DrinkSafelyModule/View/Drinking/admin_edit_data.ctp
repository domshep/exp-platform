<?php $this->extend('/Modules/module_template'); ?>
<h2><?php echo $message; ?></h2>
<div class="exercise form">
	<h3><?php echo __('Week Commencing '); ?></h3>
	<p><?php echo __('How many units of alcohol did you do this week? Enter 0 if you didn\'t drink any that day.'); ?></p>
	<?php 
	echo $this->Form->create('DrinkingWeekly') ?>
	<table cellspacing="0" id="drinkingweekly">
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
			<td><?php echo $this->Form->input('monday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('tuesday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('wednesday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('thursday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('friday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('saturday',array('label'=>false)); ?></td>
			<td><?php echo $this->Form->input('sunday',array('label'=>false)); ?></td>
			<td><?php 
				echo $this->Form->input('total',array('readonly'=>true,'label'=>false)); 
				echo $this->Form->hidden('user_id'); 
				echo $this->Form->hidden('id');
				echo $this->Form->hidden('date'); 
			?></td>
		</tr>
	</table>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type="text/javascript">
	jQuery("#DrinkingWeeklyMonday, #DrinkingWeeklyTuesday, #DrinkingWeeklyWednesday, #DrinkingWeeklyThursday, #DrinkingWeeklyFriday, #DrinkingWeeklySaturday, #DrinkingWeeklySunday").bind("keyup", function() {
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
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('My Dashboard'), array('controller' => 'users', 'action' => 'dashboard', 'plugin' => null)); ?> </li>
		<li><?php echo $this->Html->link(__('Module Dashboard'), array('action' => 'module_dashboard')); ?></li>
	</ul>
</div>