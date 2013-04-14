<?php $this->extend('/Modules/module_template');?>
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
	<p>For each day this week click on the images to state whether your smoked or not? <br/>
	TO DO: Smoke / Smoke Free Clickables - For now enter 1 for Smoke Free, 0 for Smokey
			<a href="#help" class="info" title="Help?">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'Help?',
						'class' => 'info')
				);
			?>
			</a></p>
<?php echo $this->Form->create('ExampleModule.StopSmokingWeekly', array(
    'inputDefaults' => array(
        'label' => false
    ))) ?>
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
			<td><?php 
				if (!empty($this->request->data)){
					$monday = $this->request->data["StopSmokingWeekly"]["monday"];
					$tuesday = $this->request->data["StopSmokingWeekly"]["tuesday"];
					$wednesday = $this->request->data["StopSmokingWeekly"]["wednesday"];
					$thursday = $this->request->data["StopSmokingWeekly"]["thursday"];
					$friday = $this->request->data["StopSmokingWeekly"]["friday"];
					$saturday = $this->request->data["StopSmokingWeekly"]["saturday"];
					$sunday = $this->request->data["StopSmokingWeekly"]["sunday"];
				}
				else
				{
					$monday = 0;
					$tuesday = 0;
					$wednesday = 0;
					$thursday = 0;
					$friday = 0;
					$saturday = 0;
					$sunday = 0;
				} ?>
				<div class="nosmoke mon<?php if ($monday == 1) echo " nosmokeup"; ?>"><img src="/stop_smoking_module/img/no-smoking.png" alt="I did not Smoke"/><br/>
					Did not Smoke</div>
				<div class="smoke mon<?php if ($monday != 1) echo " smokeup"; ?>"><img src="/stop_smoking_module/img/smoking.png" alt="I smoked"/><br/>
					Smoked</div>
				<?php echo $this->Form->hidden('StopSmokingWeekly.monday',array('label'=>false)); ?></td>
			<td>
				<div class="nosmoke tue<?php if ($tuesday == 1) echo " nosmokeup"; ?>"><img src="/stop_smoking_module/img/no-smoking.png" alt="I did not Smoke"/><br/>
					Did not Smoke</div>
				<div class="smoke tue<?php if ($tuesday != 1) echo " smokeup"; ?>"><img src="/stop_smoking_module/img/smoking.png" alt="I smoked"/><br/>
					Smoked</div>
				<?php echo $this->Form->hidden('StopSmokingWeekly.tuesday',array('label'=>false)); ?>
			</td>
			<td>
				<div class="nosmoke wed<?php if ($wednesday == 1) echo " nosmokeup"; ?>"><img src="/stop_smoking_module/img/no-smoking.png" alt="I did not Smoke"/><br/>
					Did not Smoke</div>
				<div class="smoke wed<?php if ($wednesday != 1 ) echo " smokeup"; ?>"><img src="/stop_smoking_module/img/smoking.png" alt="I smoked"/><br/>
					Smoked</div>
				<?php echo $this->Form->hidden('StopSmokingWeekly.wednesday',array('label'=>false)); ?>
			</td>
			<td>
				<div class="nosmoke thu<?php if ($thursday == 1) echo " nosmokeup"; ?>"><img src="/stop_smoking_module/img/no-smoking.png" alt="I did not Smoke"/><br/>
					Did not Smoke</div>
				<div class="smoke thu<?php if ($thursday != 1) echo " smokeup"; ?>"><img src="/stop_smoking_module/img/smoking.png" alt="I smoked"/><br/>
					Smoked</div>
				<?php echo $this->Form->hidden('StopSmokingWeekly.thursday',array('label'=>false)); ?>
			</td>
			<td>
				<div class="nosmoke fri<?php if ($friday == 1) echo " nosmokeup"; ?>"><img src="/stop_smoking_module/img/no-smoking.png" alt="I did not Smoke"/><br/>
					Did not Smoke</div>
				<div class="smoke fri<?php if ($friday != 1) echo " smokeup"; ?>"><img src="/stop_smoking_module/img/smoking.png" alt="I smoked"/><br/>
					Smoked</div>
				<?php echo $this->Form->hidden('StopSmokingWeekly.friday',array('label'=>false)); ?>
			</td>
			<td>
				<div class="nosmoke sat<?php if ($saturday == 1) echo " nosmokeup"; ?>"><img src="/stop_smoking_module/img/no-smoking.png" alt="I did not Smoke"/><br/>
					Did not Smoke</div>
				<div class="smoke sat<?php if ($saturday != 1) echo " smokeup"; ?>"><img src="/stop_smoking_module/img/smoking.png" alt="I smoked"/><br/>
					Smoked</div>
				<?php echo $this->Form->hidden('StopSmokingWeekly.saturday',array('label'=>false)); ?>
			</td>
			<td>
				<div class="nosmoke mon<?php if ($sunday == 1) echo " nosmokeup"; ?>"><img src="/stop_smoking_module/img/no-smoking.png" alt="I did not Smoke"/><br/>
					Did not Smoke</div>
				<div class="smoke mon<?php if ($sunday != 1) echo " smokeup"; ?>"><img src="/stop_smoking_module/img/smoking.png" alt="I smoked"/><br/>
					Smoked</div>
				<?php echo $this->Form->hidden('StopSmokingWeekly.sunday',array('label'=>false)); ?>
			</td>
			<td><?php 
				echo $this->Form->input('StopSmokingWeekly.total',array('readonly'=>true,'label'=>false)); 
				echo $this->Form->hidden('StopSmokingWeekly.week_beginning',array('value'=>date('Y-m-d',$weekBeginning)));
				echo $this->Form->hidden('StopSmokingWeekly.id');
			?></td>
		</tr>
		<tr>
			<td colspan="8"><label for="StopSmokingWeeklyWhat_Worked">What worked for me this week?
			<a href="#whatworked" class="info" title="What is this?">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'What is this?',
						'class' => 'info')
				);
			?>
			</a></label>
			<?php echo $this->Form->textarea('StopSmokingWeekly.what_worked',array('label'=>'false', 'cols'=>'35', 'rows'=>'5')); ?></td>
		</tr>
	</table>
<p><?php echo $this->Form->end(__('Submit')); ?></p>
</div>
<script type="text/javascript">
<!--
	jQuery(".weekly-total img").bind("click", function() 
	{
    	var $tr = $(this).closest("tr");
		var value = 0;
		var id = "";
		if ($(this).parent("div").hasClass('smoke')){
			value = 0;
			$(this).parent().addClass('smokeup');
			$(this).parent().siblings('.nosmoke').removeClass('nosmokeup');
		} else {
			value = 1;
			$(this).parent().addClass('nosmokeup');
			$(this).parent().siblings('.smoke').removeClass('smokeup');
		}
		$(this).parent().siblings("input").val(value);
    	var monday = parseFloat($tr.find("#StopSmokingWeeklyMonday").val());
    	var tuesday = parseFloat($tr.find("#StopSmokingWeeklyTuesday").val());
    	var wednesday = parseFloat($tr.find("#StopSmokingWeeklyWednesday").val());
    	var thursday = parseFloat($tr.find("#StopSmokingWeeklyThursday").val());
    	var friday = parseFloat($tr.find("#StopSmokingWeeklyFriday").val());
    	var saturday = parseFloat($tr.find("#StopSmokingWeeklySaturday").val());
    	var sunday = parseFloat($tr.find("#StopSmokingWeeklySunday").val());
    	if(isNaN(monday)) monday = 0;
    	if(isNaN(tuesday)) tuesday = 0;
    	if(isNaN(wednesday)) wednesday = 0;
    	if(isNaN(thursday)) thursday = 0;
    	if(isNaN(friday)) friday = 0;
    	if(isNaN(saturday)) saturday = 0;
    	if(isNaN(sunday)) sunday = 0;
    	$tr.find("#StopSmokingWeeklyTotal").val(monday + tuesday + wednesday + thursday + friday + saturday + sunday);
	});
//-->

</script>
<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
	<div id='help' class='popup'>
		<h3>Help for the Stop Smoking Module</h3>
		<p>This is where you can display extra information and suggestions for this data entry page.</p>
	</div>
</div>
<?php echo $this->element('what_worked'); ?>