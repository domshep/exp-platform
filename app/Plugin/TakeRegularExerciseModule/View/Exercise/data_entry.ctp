<?php $this->extend('/Modules/module_template'); ?>
<div>
	<h2>
		<?php 

		?>
		Week Commencing:
		<?php
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
		}?>
	</h2>
	<p>
		How many minutes of moderate to vigorous activity did you achieve this
		week?<br /> Enter 0 if you haven't taken any moderate to vigorous
		activity that day. <a href="#portion" class="info"
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
		<tr>
			<td colspan="8"><label for="ExerciseWeeklyWhat_Worked">What worked
					for me this week? <a href="#whatworked" class="info"
					title="Click for more information on the 'What worked for me?' box">
						<?php 
						echo $this->Html->image(
					'info-icon.png',
					array('alt' => 'What is this?',
						'class' => 'info')
				);
			?>
				</a>
			</label> <?php echo $this->Form->textarea('ExerciseWeekly.what_worked',array('label'=>'false', 'cols'=>'35', 'rows'=>'5')); ?>
			</td>
		</tr>
	</table>
	<div class="submit">
         <?php echo $this->Form->submit(__('Submit', true), array('name' => 'ok', 'div' => false, 'id' =>'submit')); ?>
         <?php echo $this->Form->submit(__('Cancel (without saving changes)', true), array('name' => 'cancel','div' => false, 'id' =>'cancel')); ?>
	</div>
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
<div style='display: none'>
	<div id='portion' class='popup'>
		<h3>How much exercise?</h3>
		<p>
			You should be aiming to achieve at least <strong>150 minutes</strong>
			of moderate to vigorous activity each week. You should also aim to
			achieve muscle strengthening activities on at least <strong>2 days</strong>
			each week.
		</p>
		<p>The table below helps gives examples of the types of activities
			which fall under each category to help you measure how much of each
			category you are doing.</p>
		<table class="infotable" style="width:80%;">
			<tbody>
				<tr>
					<th class="center" style="width:33%;">Moderate intensity activities</th>
					<th class="center" style="width:33%;">Vigorous intensity activities</th>
					<th class="center" style="width:33%;">Muscle strengthening activities</th>
				</tr>
				<tr>
					<td class="center"><strong>Brisk walking </strong>
					</td>
					<td class="center"><strong>Fast swimming</strong>
					</td>
					<td class="center"><strong>Heavy gardening </strong>
					</td>
				</tr>
				<tr>
					<td class="center"><strong>Hiking</strong>
					</td>
					<td class="center"><strong>Singles tennis</strong>
					</td>
					<td class="center"><strong>Weights exercises </strong>
					</td>
				</tr>
				<tr>
					<td class="center"><strong>Pushing lawn mower </strong>
					</td>
					<td class="center"><strong>Running</strong>
					</td>
					<td class="center"><strong>Push-ups </strong>
					</td>
				</tr>
				<tr>
					<td class="center"><strong>Volleyball </strong>
					</td>
					<td class="center"><strong>Martial arts</strong>
					</td>
					<td class="center"><strong>Using&nbsp;resistance bands</strong>
					</td>
				</tr>
				<tr>
					<td class="center"><strong>Steady cycling on even ground</strong>
					</td>
					<td class="center"><strong>Rugby</strong>
					</td>
					<td class="center"><strong>Yoga</strong>
					</td>
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
	<?php echo $this->element('what_worked'); ?>
</div>
