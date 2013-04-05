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
	<p>Please enter your average weight for this week.
			<a href="#portion" class="info" title="How much is a portion?">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'How much is a portion?',
						'class' => 'info')
				);
			?>
			</a></p>
<?php echo $this->Form->create('BMI.BMIWeekly') ?>
	<table class="weekly-total">
		<tr>
			<th>Stone / Pounds</th>
			<th>Kilograms</th>
		</tr>
		<tr>
			<td><?php 
				echo $this->Form->input('BmiWeekly.weight_stones', array('label'=>'Stone', 'class'=>'stones')); 
				echo $this->Form->input('BmiWeekly.weight_lbs', array('label'=>'Pounds', 'class'=>'lbs')); 
			?></td>
			<td><?php echo $this->Form->input('BmiWeekly.weight_kg', array('label'=>'Kgs', 'class'=>'kgs')); ?></td>
		</tr>
		<tr>
			<td colspan="8"><label for="BmiWeeklyWhat_Worked">What worked for me this week?
			<a href="#whatworked" class="info" title="What is this?">
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
<p><?php echo $this->Form->end(__('Submit')); ?></p>
</div>
<script type="text/javascript">

jQuery(".stones").bind("blur", function() 
{
    var $tr = $(this).closest("tr");
	var stones = parseFloat($tr.find(".stones").val());
    var lbs = parseFloat($tr.find(".lbs").val());
    
	var kgs = parseFloat($tr.find(".kgs").val());
	
    if(isNaN(stones)) stones = 0;
	if(isNaN(lbs)) lbs = 0;
	
	if (stones > 0 && lbs > 0){
		var newkg = Math.round(((stones * 13) + lbs) * 0.453592,0);
		$tr.find(".kgs").val(newkg);
	}
});

jQuery(".lbs").bind("blur", function() 
{
    var $tr = $(this).closest("tr");
	var stones = parseFloat($tr.find(".stones").val());
    var lbs = parseFloat($tr.find(".lbs").val());
    
	var kgs = parseFloat($tr.find(".kgs").val());
	
    if(isNaN(stones)) stones = 0;
	if(isNaN(lbs)) lbs = 0;
	
	if (stones > -1 && lbs > -1){
		var newkg = Math.round(((stones * 13) + lbs) * 0.453592,0);
		$tr.find(".kgs").val(newkg);
	}
	
	if (lbs >= 13){
		var newstones = ($tr.find(".stones").val()* 1) + 1;
		var newlbs = ($tr.find(".lbs").val()* 1) - 13;
		while (newlbs >= 13)
		{
			var newstones = newstones + 1;
			var newlbs = newlbs - 13;
		}
		$tr.find(".stones").val(newstones);
		$tr.find(".lbs").val(newlbs);
	}
	if (lbs < 0){
		$tr.find(".lbs").val(0);
	}
	
});

jQuery(".kgs").bind("blur", function() {
    
    var $tr = $(this).closest("tr");
	var kgs = parseFloat($tr.find(".kgs").val());
	var stones = parseFloat($tr.find(".stones").val());
    var lbs = parseFloat($tr.find(".lbs").val());
    
    if(isNaN(kgs)) kgs = 0;
	
	if (kgs > 0){
		var newlbs = Math.round((kgs * 2.20462),2);
		var newstones = Math.floor(newlbs / 13);
		newlbs = (newlbs - (newstones*13));
		$tr.find(".lbs").val(newlbs);
		$tr.find(".stones").val(newstones);
	}
});
</script>


<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
	<div id='portion' class='popup'>
		<h3><img src='/bmi_module/img/bmi/5-a-dayportionposter.png' alt="Healthy Eating Poster" style="float:right; margin-left: 10px;" />How much is a portion?</h3>
		<p>INSERT BMI Info</p>
	</div>
</div>
<?php echo $this->element('what_worked'); ?>