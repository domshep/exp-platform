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

<p class="lead">How many minutes of moderate to vigorous activity did you achieve this
		week?</p>
<p> Enter 0 if you haven't taken any moderate to vigorous
		activity that day. <a data-toggle="modal" href="#help" class="info"
			title="Click for more information on what are &lsquo;moderate to vigorous activities&rsquo;">
			<?php 
			echo $this->Html->image(
					'info-icon.png',
					array('alt' => 'What counts as Exercise?',
						'class' => 'info')
				);
			?>
		</a>
</p>
<?php echo $this->Form->create('TakeRegularExercise.ExerciseWeekly') ?>
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
		<td><?php echo $this->Form->input('ExerciseWeekly.monday',array('label'=>false)); ?>
		</td>
		<td><?php echo $this->Form->input('ExerciseWeekly.tuesday',array('label'=>false)); ?>
		</td>
		<td><?php echo $this->Form->input('ExerciseWeekly.wednesday',array('label'=>false)); ?>
		</td>
		<td><?php echo $this->Form->input('ExerciseWeekly.thursday',array('label'=>false)); ?>
		</td>
		<td><?php echo $this->Form->input('ExerciseWeekly.friday',array('label'=>false)); ?>
		</td>
		<td><?php echo $this->Form->input('ExerciseWeekly.saturday',array('label'=>false)); ?>
		</td>
		<td><?php echo $this->Form->input('ExerciseWeekly.sunday',array('label'=>false)); ?>
		</td>
		<td><?php 
		echo $this->Form->input('ExerciseWeekly.total',array('readonly'=>true,'label'=>false));
		echo $this->Form->hidden('ExerciseWeekly.week_beginning',array('value'=>date('Y-m-d',$weekBeginning)));
		echo $this->Form->hidden('ExerciseWeekly.id');
		?>
		</td>
	</tr>
	</tbody>
</table>
<div class="form-group">
	<label for="ExerciseWeeklyWhatWorked">What worked for me this week?
		<a data-toggle="modal" href="#whatworked" class="info" title="Click for more information on the 'What worked for me?' box">
		<?php 
			echo $this->Html->image(
				'info-icon.png', 
				array('alt' => 'What is this?',
					'class' => 'info')
			);
		?>
		</a></label>
	<?php echo $this->Form->textarea('ExerciseWeekly.what_worked',array('rows'=>'5')); ?>
</div>
<div class="submit">
         <?php echo $this->Form->submit(__('Submit', true), array('name' => 'ok', 'div' => false, 'id' =>'submit', 'class' => 'btn btn-success btn-md bot-buffer pull-right')); ?>
         <?php echo $this->Form->submit(__('Cancel (without saving changes)', true), array('name' => 'cancel','div' => false, 'id' =>'cancel', 'class' => 'btn btn-default btn-md bot-buffer pull-right')); ?>
</div>
<?php echo $this->Form->end(); ?>

<script type="text/javascript">
jQuery(".weekly-entry input").bind("keyup", function() {
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
<!-- This contains the hidden content for inline calls -->
<div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          	<h4 class="modal-title" id="helpModalLabel">How much exercise?</h4>
        </div>
        <div class="modal-body">
			<p>
				You should be aiming to achieve at least <strong>150 minutes</strong>
				of moderate to vigorous activity each week. You should also aim to
				achieve muscle strengthening activities on at least <strong>2 days</strong>
				each week.
			</p>
			<p>The table below helps gives examples of the types of activities
				which fall under each category to help you measure how much of each
				category you are doing.</p>
			<table class="table">
				<thead>
					<tr>
						<th>Moderate intensity activities</th>
						<th>Vigorous intensity activities</th>
						<th>Muscle strengthening activities</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Brisk walking</td>
						<td>Fast swimming</td>
						<td>Heavy gardening</td>
					</tr>
					<tr>
						<td>Hiking</td>
						<td>Singles tennis</td>
						<td>Weights exercises</td>
					</tr>
					<tr>
						<td>Pushing lawn mower</td>
						<td>Running</td>
						<td>Push-ups</td>
					</tr>
					<tr>
						<td>Volleyball</td>
						<td>Martial arts</td>
						<td>Using resistance bands</td>
					</tr>
					<tr>
						<td>Steady cycling on even ground</td>
						<td>Rugby</td>
						<td>Yoga</td>
					</tr>
				</tbody>
			</table>
			<p>
				More information on <a
					title="Click for more information on physical acyvity guidelines from the NHS Choices website [external website - opens in new window]"
					target="_blank"
					href="http://www.nhs.uk/Livewell/fitness/Pages/physical-activity-guidelines-for-adults.aspx "><strong>physical
						activity guidelines for adults</strong> </a> is available from the
				NHS Choices website.
			</p>
	</div>
	  </div>
	</div>
</div>
<?php echo $this->element('what_worked'); ?>
