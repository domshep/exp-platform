<?php $this->extend('/Modules/module_template'); ?>
<div>
	<h2>Week Commencing: <?php
	echo $this->Html->image(
			'Actions-go-previous-view-icon.png',
			array('alt' => 'Previous week',
				  'url' => 'data_entry/' . date('Ymd',$previousWeek),
				  'class' => 'previous',
				  'title' => 'Go to previous week'
			)
	);
	echo date('d-m-Y',$weekBeginning);
	
	if(isset($nextWeek)) 
	{
		echo $this->Html->image(
				'Actions-go-next-view-icon.png',
				array('alt' => 'Next week',
					  'url' => 'data_entry/' . date('Ymd',$nextWeek),
					  'class' => 'next',
					  'title' => 'Go to next week'
				)
		);
	}?></h2>
	<p>Please enter your average weight for this week.</p>
<?php echo $this->Form->create('BMI.BMIWeekly') ?>
	<table class="weekly-total">
		<tr>
			<th>Kilograms</th>
			<th style="width:2em;font-style:italic;">or</th>
			<th>Stone / Pounds</th>
		</tr>
		<tr>
			<td><?php echo $this->Form->input('BmiWeekly.weight_kg', array('label'=>'Kgs', 'class'=>'kgs')); ?></td>
			<td>&nbsp;</td>
			<td><?php 
				echo $this->Form->input('BmiWeekly.weight_stones', array('label'=>'Stone', 'class'=>'stones')); 
				echo $this->Form->input('BmiWeekly.weight_lbs', array('label'=>'Pounds', 'class'=>'lbs')); 
			?></td>
		</tr>
		<tr>
			<td colspan="8"><label for="BmiWeeklyWhat_Worked">What worked for me this week?
			<a href="#whatworked" class="info" title="Click for more information on the 'What worked for me?' box">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'What is this?',
						'class' => 'info')
				);
			?>
			</a></label><?php 
			echo $this->Form->hidden('BmiWeekly.week_beginning',array('value'=>date('Y-m-d',$weekBeginning)));
			echo $this->Form->hidden('BmiWeekly.id');
			echo $this->Form->hidden('BmiWeekly.height_cm');
			echo $this->Form->textarea('BmiWeekly.what_worked',array('label'=>'false', 'cols'=>'35', 'rows'=>'5')); ?></td>
		</tr>
	</table>
	<div class="submit">
         <?php echo $this->Form->submit(__('Cancel (without saving changes)', true), array('name' => 'cancel','div' => false, 'id' =>'cancel')); ?>
         <?php echo $this->Form->submit(__('Submit', true), array('name' => 'ok', 'div' => false, 'id' =>'submit')); ?>
	</div>
</div>
<script type="text/javascript">
jQuery(".stones").bind("blur", function() 
{
	getMetricWeight(parseFloat($(".stones").val()), parseFloat($(".lbs").val()));
});

jQuery(".lbs").bind("blur", function() 
{
	getMetricWeight(parseFloat($(".stones").val()), parseFloat($(".lbs").val()));
});

jQuery(".kgs").bind("blur", function() {
	getImperialWeight(parseFloat($(".kgs").val()));
});

jQuery("body").ready(function() {
    var imperial = getImperialWeight(parseFloat($(".kgs").val()));
});
</script>


<!-- This contains the hidden content for inline calls -->
<?php echo $this->element('what_worked'); ?>