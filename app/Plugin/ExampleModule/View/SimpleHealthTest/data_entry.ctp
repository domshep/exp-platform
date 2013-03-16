<?php $this->extend('/Modules/module_template'); ?>
<h2><?php echo $message; ?></h2>
<div class="users form">
	<h3><?php 
		$dayoftheweek = gmdate('w')-1;
		if ($dayoftheweek == -1) $dayoftheweek = 6; // our week starts on Monday.
		$weekstartdate = gmmktime(0,0,0,gmdate("m"),gmdate("d")-$dayoftheweek,gmdate("Y"));
		
		echo __('Week 1: Week Commencing ') . gmdate("d/m/Y",$weekstartdate); ?></h3>
	<p><?php echo __('How many portions of different fruit and vegetables did you eat this week? Enter 0 if you haven\'t eaten any portions of fruit or vegetables that day.'); ?></p>
<?php echo $this->Form->create('FiveADayWeekly', array(
    'inputDefaults' => array(
        'label' => false
    ))) ?>
	<table cellspacing="0" id="fiveadayweekly">
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
			<td><?php echo $this->Form->input('monday',array('label'=>false,'value'=>'0')); ?></td>
			<td><?php echo $this->Form->input('tuesday',array('label'=>false,'value'=>'0')); ?></td>
			<td><?php echo $this->Form->input('wednesday',array('label'=>false,'value'=>'0')); ?></td>
			<td><?php echo $this->Form->input('thursday',array('label'=>false,'value'=>'0')); ?></td>
			<td><?php echo $this->Form->input('friday',array('label'=>false,'value'=>'0')); ?></td>
			<td><?php echo $this->Form->input('saturday',array('label'=>false,'value'=>'0')); ?></td>
			<td><?php echo $this->Form->input('sunday',array('label'=>false,'value'=>'0')); ?></td>
			<td><?php 
				echo $this->Form->input('total',array('readonly'=>true,'value'=>'0','label'=>false)); 
				echo $this->Form->hidden('user_id',array('value'=>$userID));
				$weekstartdate = gmdate("Y-m-d 00:00:00",$weekstartdate);
				echo $this->Form->hidden('date',array('value'=>$weekstartdate)); 
			?></td>
		</tr>
	</table>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type="text/javascript">
	jQuery("#FiveADayWeeklyMonday, #FiveADayWeeklyTuesday, #FiveADayWeeklyWednesday, #FiveADayWeeklyThursday, #FiveADayWeeklyFriday, #FiveADayWeeklySaturday, #FiveADayWeeklySunday").bind("keyup", function() {
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