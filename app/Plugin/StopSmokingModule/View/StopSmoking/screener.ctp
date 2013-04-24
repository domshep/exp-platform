<?php $this->extend('/Modules/module_template');?>
<h3>Complete this screening tool to get some feedback on your current health</h3>
<br/>
<?php 
	echo $this->Form->create('StopSmokingScreener');
	
	echo $this->Form->input('smokes', array(
    	'options' => array('empty' => '(choose one)',
			'Y'=> 'Yes','N'=>'No'),
    	'label' => 'Do you smoke, or have you had a cigarette in the past 4 weeks?',
    	'class' => 'smoke'
	));
	$options = array(
   	 'label' => 'Am I a smoker?'
	);
?>
	<div id="welldone">
		<p>Congratulations and well done. You have not smoked within the last 4 weeks and are classed as smoke-free</p>
		<p><a href="/users/dashboard">Click here to return to your dashboard</a> and select another health topic</p>
	</div>
	<div id="smoker">
		<p>You indicated you have smoked within the last 4 weeks. Were you aware that smokers spend over &pound;2,000 per year smoking 20 cigarettes a day?</p>
		<p><strong>Each cigarette causes an estimated 11 minutes reduction in your life expectancy!!</strong></p>
		<table>
			<tr>
				<th>Question</th>
				<th>Select your answer</th>
			</tr>
			<tr>
				<td>How many cigarettes per day do you usually smoke?</td>
				<td><?php
		echo $this->Form->input('how_many', array(
    		'options' => array('0'=> '10 or Under','1'=>'11-20','2'=>'21-30','3'=>'Over 30'),
    		'empty' => '(choose one)',
    						'label' => false
						)); ?>
 				</td>
			</tr>
			<tr>
				<td>How soon after you wake up do you smoke your first cigarette?</td>
				<td><?php
		echo $this->Form->input('first_cig', array(
    		'options' => array('3'=> 'Within 5 minutes','2'=>'Within 6 to 30 minutes','1'=>'After 31 or more minutes'),
    		'empty' => '(choose one)',
    					'label' => false
					)); ?></td>
			</tr>
			<tr>
				<td>Do you find it difficult to stop smoking in non-smoking areas?</td>
				<td><?php
		echo $this->Form->input('diff_non_smoking', array(
    		'options' => array('1'=> 'Yes','0'=>'No'),
    		'empty' => '(choose one)',
    		'label' => false
		)); ?>
		</td>
			</tr>
			<tr>
				<td>Which cigarette would you most hate to give up?</td>
				<td><?php
		echo $this->Form->input('most_hate', array(
    		'options' => array('1'=> 'The first one in the morning','0'=>'Other'),
    		'empty' => '(choose one)',
    		'label' => false
		)); ?>
		</td>
			</tr>
			<tr>
				<td>Do you smoke more frequently in the first hours after waking than during the rest of the day?</td>
				<td><?php
		echo $this->Form->input('more_morning', array(
    		'options' => array('1'=> 'Yes','0'=>'No'),
    		'empty' => '(choose one)',
    		'label' => false
		)); ?>
		</td>
			</tr>
			<tr>
				<td>Do you smoke if you are so ill that you are in bed most of the day?</td>
				<td><?php
		echo $this->Form->input('smoke_in_bed', array(
    		'options' => array('1'=> 'Yes','0'=>'No'),
    'empty' => '(choose one)',
    		'label' => false
		)); ?></td>
		</tr><?php 
$options = array(
   			 'label' => 'Calculate my nicotine dependency score'
);
	?>
	</table>
	</div>
	<?php echo $this->Form->end($options); ?>
<script type="text/javascript">
	<!--
	jQuery('body').ready(function()
	{
		$('#welldone').hide();
		$('#smoker').hide();
		$('input[type=submit]').hide();
	});

	jQuery('.smoke').bind("change", function() 
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