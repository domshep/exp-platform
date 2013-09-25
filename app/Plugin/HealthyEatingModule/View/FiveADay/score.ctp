<?php $this->extend('/Modules/module_template');?>
<h2>Your feedback</h2>
<p class="lead">
	Your score is
	<?php echo $score;?>
</p>
<?php if($score < 35) {?>
<p>
	Did you know that your score indicates that you have eaten
	<?php echo round(($score/35)*100,0) ?>% of your recommended 5 daily portions of fruit and vegetable over the
	past 7 days?
</p>

<?php } else {?>
<p>Congratulations and well done. This score indicates you have eaten
	the equivalent of your recommended 5-a-day fruit and vegetable intake
	over the last month. Keep up the good work.</p>

<?php }?>

<p>By eating your recommended daily portions of fruit and vegetables you
	can reduce the risk of a range of diseases including coronary heart
	disease and stroke, and can make it easier to maintain a healthy
	weight.</p>

<p>It is important to remember that eating the recommended levels of
	fruit and vegetables is a positive step forward and forms part of a
	healthy balanced diet.</p>

<p>
	<a href="http://www.nhs.uk/Livewell/Goodfood/Pages/Healthyeating.aspx" target="eathealthily">Find
		out more about healthy balanced diets here</a>.
</p>

<p>You can add the &lsquo;Healthy Eating &ndash; 5-a-day&rsquo; module
	to your personal dashboard to monitor and track your 5-a-day to help
	you make and maintain more changes.</p>

<?php echo $this->Form->create('FiveADayScreener', array(
		'inputDefaults' => array(
        'label' => false
    )));

echo $this->Form->hidden('veg_often');
echo $this->Form->hidden('veg_no');
echo $this->Form->hidden('salad_often');
echo $this->Form->hidden('salad_no');
echo $this->Form->hidden('whole_fruit_often');
echo $this->Form->hidden('whole_fruit_no');
echo $this->Form->hidden('medium_fruit_often');
echo $this->Form->hidden('medium_fruit_no');
echo $this->Form->hidden('small_fruit_often');
echo $this->Form->hidden('small_fruit_no');
echo $this->Form->hidden('tinned_fruit_often');
echo $this->Form->hidden('tinned_fruit_no');
echo $this->Form->hidden('dried_fruit_often');
echo $this->Form->hidden('dried_fruit_no');
echo $this->Form->hidden('fruit_juice_often');
echo $this->Form->hidden('fruit_juice_no');
echo $this->Form->hidden('FiveADayScreener.score', array('value'=>$score));



$options = array(
    'label' => 'Add the &lsquo;Healthy Eating - 5-a-day&rsquo; module to my dashboard',
	'escape' => false,
	'class' => 'btn btn-success btn-md bot-buffer pull-right'
);

echo $this->Form->end($options);
?>