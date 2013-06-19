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
			<a href="#units" class="info" title="Click for more information on what counts as a unit of alcohol">
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
			<td colspan="8"><label for="DrinkingWeeklyWhat_Worked">What worked for me this week?
			<a href="#whatworked" class="info" title="Click for more information on the 'What worked for me?' box">
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
	<div class="submit">
         <?php echo $this->Form->submit(__('Submit', true), array('name' => 'ok', 'div' => false, 'id' =>'submit')); ?>
         <?php echo $this->Form->submit(__('Cancel (without saving changes)', true), array('name' => 'cancel','div' => false, 'id' =>'cancel')); ?>
	</div>
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
	<div id='units' class='popup'>
		<h3>How many units are in your drinks?</h3>
		<p><strong>Have you ever thought....&ldquo;I only have a couple of drinks a night &ndash; what&rsquo;s the big deal&rdquo;?</strong></p>
		<p>Understanding what a unit of alcohol is can be confusing, working out how many are in your drink can be even worse. Take a look at this chart to help give an idea of how many units you are drinking, and use the tools below to get a more exact figure.</p> 
		<p><img height="336" alt="" width="572" src="/drink_safely_module/img/drinkschart.png" style="width:572px;margin-left:auto;margin-right:auto;display:block;"/></p>
		<p>Find out how many units you had the last time you had a drink using the <a title="click to go to the drinks checker on the Change4Life Wales website [external website - opens in new window]" href="http://change4lifewales.org.uk/adults/alcohol/drinks-checker/?lang=en" target="_blank"><strong>Change4Life Wales drinks checker.&nbsp;</strong></a></p>
		<p>Find out whether you are <a title="click to use the alcohol calculator on the NHS Choices website [external website - opens in new window]" href="http://www.nhs.uk/Tools/Pages/Alcoholcalculator.aspx" target="_blank"><strong>drinking within the sensible levels by using this assessment </strong></a>from NHS Choices.&nbsp;</p>
    </div>
</div>
<?php echo $this->element('what_worked'); ?>