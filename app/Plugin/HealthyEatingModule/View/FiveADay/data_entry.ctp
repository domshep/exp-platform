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
	<p>How many portions of different fruit and vegetables did you eat this week? Enter 0 if you haven't eaten any portions of fruit or vegetables that day.
			<a href="#portion" class="info" title="How much is a portion?">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'How much is a portion?',
						'class' => 'info')
				);
			?>
			</a></p>
<?php echo $this->Form->create('HealthyEating.FiveADayWeekly') ?>
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
		<tr>
			<td colspan="8"><label for="FiveADayWeeklyWhat_Worked">What worked for me this week?
			<a href="#whatworked" class="info" title="What is this?">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'What is this?',
						'class' => 'info')
				);
			?>
			</a></label><?php echo $this->Form->textarea('FiveADayWeekly.what_worked',array('label'=>'false', 'cols'=>'35', 'rows'=>'5')); ?></td>
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


<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
	<div id='portion' class='popup'>
		<h3><img src='/healthy_eating_module/img/five_a_day/5-a-dayportionposter.png' alt="Healthy Eating Poster" style="float:right; margin-left: 10px;" />How much is a portion?</h3>
		<p>Did you know that the World Health Organization recommends eating a minimum of 400g of fruit and vegetables every day to lower risk of serious health problems? This is equal to 5 portions of 80g.</p>
		<p>But how do we measure what 80g is? Have a look at the poster on the right to see how your portion sizes match up.</p>
		<p>A larger version of the poster, which is produced by the <a href='http://www.wcrf-uk.org/'>World Cancer Research Fund</a>, can be <a href='http://www.wcrf-uk.org/PDFs/5adayposter.pdf'>downloaded from their website</a>.
You can also download information on <a href='http://www.wcrf-uk.org/PDFs/Portion-Size-finding-the-balance.pdf'>portion sizes for a balanced diet</a> by the World Cancer Research Fund.</p>
	</div>
</div>
<?php echo $this->element('what_worked'); ?>