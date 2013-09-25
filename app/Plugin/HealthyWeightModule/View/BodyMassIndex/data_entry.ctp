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

<p class="lead">Please enter your average weight for this week.</p>

<?php echo $this->Form->create('BMI.BMIWeekly') ?>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<table class="weekly-entry table">
			<thead>
			<tr>
				<th>Kgs</th>
				<th><em>or</em></th>
				<th>Stones / Lbs</th>
			</tr>
			</thead>
			<tbody>
			<tr>
				<td><?php echo $this->Form->input('BmiWeekly.weight_kg', array('label'=>'kgs')); ?></td>
				<td>&nbsp;</td>
				<td><?php 
					echo $this->Form->input('BmiWeekly.weight_stones', array('label'=>'stones')); 
					echo $this->Form->input('BmiWeekly.weight_lbs', array('label'=>'lbs')); 
				?></td>
			</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="col-md-12">
	<div class="form-group">
		<label for="BmiWeeklyWhatWorked">What worked for me this week?
			<a data-toggle="modal" href="#whatworked" class="info" title="Click for more information on the 'What worked for me?' box">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'What is this?',
						'class' => 'info')
				);
			?>
			</a>
		</label>
		<?php 
		echo $this->Form->textarea('BmiWeekly.what_worked',array('rows'=>'5'));
				
		echo $this->Form->hidden('BmiWeekly.week_beginning',array('value'=>date('Y-m-d',$weekBeginning)));
		echo $this->Form->hidden('BmiWeekly.id');
		echo $this->Form->hidden('BmiWeekly.height_cm');
		?>
	</div>
	<div class="submit">
	         <?php echo $this->Form->submit(__('Submit', true), array('name' => 'ok', 'div' => false, 'id' =>'submit', 'class' => 'btn btn-success btn-md bot-buffer pull-right')); ?>
	         <?php echo $this->Form->submit(__('Cancel (without saving changes)', true), array('name' => 'cancel','div' => false, 'id' =>'cancel', 'class' => 'btn btn-default btn-md bot-buffer pull-right')); ?>
	</div>
</div>
<?php echo $this->Form->end(); ?>

<script type="text/javascript">
jQuery("input[id$='Stones']").bind("blur", function() 
{
	getMetricWeight(parseFloat($("input[id$='Stones']").val()), parseFloat($("input[id$='Lbs']").val()));
});

jQuery("input[id$='Lbs']").bind("blur", function() 
{
	getMetricWeight(parseFloat($("input[id$='Stones']").val()), parseFloat($("input[id$='Lbs']").val()));
});

jQuery("input[id$='Kg']").bind("blur", function() {
	getImperialWeight(parseFloat($("input[id$='Kg']").val()));
});

jQuery("body").ready(function() {
    var imperial = getImperialWeight(parseFloat($("input[id$='Kg']").val()));
});
</script>

<!-- This contains the hidden content for inline calls -->
<?php echo $this->element('what_worked'); ?>
