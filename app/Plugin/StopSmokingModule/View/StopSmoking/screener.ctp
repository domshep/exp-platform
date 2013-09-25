<?php $this->extend('/Modules/module_template');?>
<h2>This assessment helps assess the nicotine dependence of current smokers</h2>

<div class="col-md-12">
<?php 
	echo $this->Form->create('StopSmokingScreener', array(
			'class' => 'form-horizontal'));
?>
<div class="row">
	<div class="col-md-12">
<?php
	echo $this->Form->input('smokes', array(
    	'options' => array('empty' => '(choose one)',
			'Y'=> 'Yes','N'=>'No'),
    	'label' => array('text' => 'Do you smoke, or have you had a cigarette in the past 4 weeks?'),
    	'horiz' => true
	));
	$options = array(
   	 'label' => 'Am I a smoker?'
	);
?>
	</div>
</div>
<div class="row">
	<div id="welldone" class="col-md-12">
		<p>Congratulations and well done. You have not smoked within the last 4 weeks and are classed as smoke-free.</p>
		<p><a href="/users/dashboard">Click here to return to your dashboard</a> and select another health topic.</p>
	</div>
</div>
<div class="row">
	<div id="smoker" class="col-md-12">
		<p>You indicated you have smoked within the last 4 weeks. Were you aware that smokers spend over &pound;2,000 per year smoking 20 cigarettes a day?</p>
		<p><strong>Each cigarette causes an estimated 11 minutes reduction in your life expectancy!!</strong></p>
		<p>Please answer the following questions to assess your current nicotine dependence.</p>
		<?php
		echo $this->Form->input('how_many', array(
    		'options' => array('0'=> '10 or Under','1'=>'11-20','2'=>'21-30','3'=>'Over 30'),
    		'empty' => '(choose one)',
    		'label' => array('text' => 'How many cigarettes per day do you usually smoke?'),
    		'horiz' => true
		));

		echo $this->Form->input('first_cig', array(
			'options' => array('3'=> 'Within 5 minutes','2'=>'Within 6 to 30 minutes','1'=>'After 31 or more minutes'),
			'empty' => '(choose one)',
			'label' => array('text' => 'How soon after you wake up do you smoke your first cigarette?'),
			'horiz' => true
		));

		echo $this->Form->input('diff_non_smoking', array(
			'options' => array('0'=>'No','1'=> 'Yes'),
			'empty' => '(choose one)',
			'label' => array('text' => 'Do you find it difficult to stop smoking in non-smoking areas?'),
			'horiz' => true
		));

		echo $this->Form->input('most_hate', array(
			'options' => array('1'=> 'The first one in the morning','0'=>'Other'),
			'empty' => '(choose one)',
			'label' => array('text' => 'Which cigarette would you most hate to give up?'),
			'horiz' => true
		));

		echo $this->Form->input('more_morning', array(
			'options' => array('0'=>'No', '1'=> 'Yes'),
			'empty' => '(choose one)',
			'label' => array('text' => 'Do you smoke more frequently in the first hours after waking than during the rest of the day?'),
			'horiz' => true
		));

		echo $this->Form->input('smoke_in_bed', array(
			'options' => array('0'=>'No', '1'=> 'Yes'),
			'empty' => '(choose one)',
			'label' => array('text' => 'If you are in bed all day due to illness, do you smoke?'),
			'horiz' => true
		));
		?>
	</div>
</div>
	<?php
	$options = array(
			'label' => 'Calculate my nicotine dependency score',
			'class' => 'btn btn-success btn-md bot-buffer pull-right'
	);
	echo $this->Form->end($options); ?>
</div>
<script type="text/javascript">
	<!--
	jQuery('body').ready(function()
	{
		if ($('#StopSmokingScreenerSmokes').val() == "Y")
		{
			$('#smoker').show();
			$('input[type=submit]').show();
			$('#welldone').hide();
		} else {
			$('#welldone').hide();
			$('#smoker').hide();
			$('input[type=submit]').hide();
		}
	});

	jQuery('#StopSmokingScreenerSmokes').bind("change", function() 
	{
    	if ($(this).val() == "Y")
		{
			$('#smoker').fadeIn('slow');
			$('input[type=submit]').fadeIn('slow');
			$('#welldone').hide();
		} 
		else 
		{ 
			if ($(this).val() == "N")
			{
				$('#welldone').fadeIn('slow');
				$('#smoker').hide();
				$('input[type=submit]').hide();
			}
			else
			{
				$('#welldone').hide();
				$('#smoker').hide();
				$('input[type=submit]').hide();
			}
		}
	});
//-->
</script>