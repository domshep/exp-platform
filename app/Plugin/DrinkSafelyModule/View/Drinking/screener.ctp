<?php $this->extend('/Modules/module_template'); ?>
<h2>Complete this screening tool to get some feedback on your drinking habits</h2>
<br />
<?php echo $this->Form->create('DrinkingScreener', array(
    'inputDefaults' => array(
        'label' => false
    )))?>
<table class="quiztable">
	<tr>
		<th class="colblue col1">Questions</th>
		<th class="colgreen col2">Answers</th>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>How often do you have a drink containing alcohol?</strong> 
		</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('how_often', array(
    				'options' => array(0 => 'Never', 1 => 'Monthly or Less', 2 => '2-4 times a month', 3 => '2-3 times a week', 4 => '4+ times a week'), 'empty' => '(choose one)','style'=>'width: 200px;'
				));?>
		</td>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>How many units of alcohol if any, do you drink on a typical day when you are drinking?</strong>
			<a href="#units" class="info" title="Click for information about how many units are in your drinks"><?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'What is this?',
						'class' => 'info')
				);
			?>
			</a>
		</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('how_many', array(
    				'options' => array(0 => '0 - 2 units', 1 => '3 - 4 units', 2 => '5 - 6 units', 3 => '7 - 9 units', 4 => '10 or more units'), 'empty' => '(choose one)','style'=>'width: 200px;'
				));
			?>
		</td>
	</tr>
	<tr>
		<td class="colblue col1">
			<?php echo $this->Form->hidden('gender',array('value'=>$gender)); ?>
			<strong>How often have you had 
			<?php 
				if ($gender == "F") echo " 6 ";
				else echo " 8 ";
			?> 
			or more units on a single occasion during the last 8 weeks?</strong>
			<a href="#units" class="info" title="Click for information about how many units are in your drinks"><?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'What is this?',
						'class' => 'info')
				);
			?>
			</a>
		</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('binge', array(
    				'options' => array(0 => 'Never', 1 => 'Less than monthly', 2 => 'Monthly', 3 => 'Weekly', 4 => 'Daily or Almost Daily'), 'empty' => '(choose one)','style'=>'width: 200px;'
				));
			?>
		</td>
	</tr>
</table>
<?php 
	$options = array(
    	'label' => 'Calculate my score'
	);
	echo $this->Form->end($options);
?>

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