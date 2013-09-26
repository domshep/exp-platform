<?php $this->extend('/Modules/module_template'); ?>
<h2>Complete this screening tool to get some feedback on your drinking habits</h2>
<p class="lead">Click the information icon for help to work out how many units are in your drinks.
	<a data-toggle="modal" href="#help" class="info" title="Click for information about how many units are in your drinks">
	<?php 
		echo $this->Html->image(
			'info-icon.png', 
			array('alt' => 'What is this?',
				'class' => 'info')
		);
	?>
	</a>
</p>
<div class="col-md-12">
<?php 
	echo $this->Form->create('DrinkingScreener', array(
			'class' => 'form-horizontal'));
?>
<div class="row">
	<div class="col-md-12">
	<?php 
		echo $this->Form->input('how_often', array(
			'options' => array(0 => 'Never', 1 => 'Monthly or Less', 2 => '2-4 times a month', 3 => '2-3 times a week', 4 => '4+ times a week'),
			'empty' => '(choose one)',
			'label' => array('text' => 'How often do you have a drink containing alcohol?'),
			'horiz' => true
		));

		echo $this->Form->input('how_many', array(
			'options' => array(0 => '0 - 2 units', 1 => '3 - 4 units', 2 => '5 - 6 units', 3 => '7 - 9 units', 4 => '10 or more units'),
			'empty' => '(choose one)',
			'label' => array('text' => 'How many units of alcohol if any, do you drink on a typical day when you are drinking?'),
			'horiz' => true
		));

		echo $this->Form->hidden('gender',array('value'=>$gender));
		
		if ($gender == "F") $recunits = " 6 ";
		else $recunits = " 8 ";
	
		echo $this->Form->input('binge', array(
			'options' => array(0 => 'Never', 1 => 'Less than monthly', 2 => 'Monthly', 3 => 'Weekly', 4 => 'Daily or Almost Daily'),
			'empty' => '(choose one)',
			'label' => array('text' => 'How often have you had ' . $recunits . 'or more units on a single occasion during the last 8 weeks?'),
			'horiz' => true
		));
	?>
	</div>
</div>
	<?php
	$options = array(
			'label' => 'Calculate my score',
			'class' => 'btn btn-success btn-md bot-buffer pull-right'
	);
	echo $this->Form->end($options); ?>
</div>

<!-- This contains the hidden content for inline calls -->
<div class="modal fade" id="help" tabindex="-1" role="dialog" aria-labelledby="helpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          	<h4 class="modal-title" id="helpModalLabel">How many units are in your drinks?</h4>
        </div>
        <div class="modal-body">
			<p><strong>Have you ever thought....&ldquo;I only have a couple of drinks a night &ndash; what&rsquo;s the big deal&rdquo;?</strong></p>
			<p>Understanding what a unit of alcohol is can be confusing, working out how many are in your drink can be even worse. Take a look at this chart to help give an idea of how many units you are drinking, and use the tools below to get a more exact figure.</p> 
			<p><img height="336" alt="" width="572" src="/drink_safely_module/img/drinkschart.png" class="img-responsive"/></p>
			<p>Find out how many units you had the last time you had a drink using the <a title="click to go to the drinks checker on the Change4Life Wales website [external website - opens in new window]" href="http://change4lifewales.org.uk/adults/alcohol/drinks-checker/?lang=en" target="_blank"><strong>Change4Life Wales drinks checker.&nbsp;</strong></a></p>
			<p>Find out whether you are <a title="click to use the alcohol calculator on the NHS Choices website [external website - opens in new window]" href="http://www.nhs.uk/Tools/Pages/Alcoholcalculator.aspx" target="_blank"><strong>drinking within the sensible levels by using this assessment </strong></a>from NHS Choices.&nbsp;</p>
	    </div>
	  </div>
	</div>
</div>
