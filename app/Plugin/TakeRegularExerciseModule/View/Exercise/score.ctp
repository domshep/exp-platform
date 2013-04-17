<?php $this->extend('/Modules/module_template');?>
<h2>Your feedback</h2>
<?php if ($feedback == "HIGH") {?>
<p>Congratulations, based on your responses you exceeded the recommended
	weekly levels of exercise over the last 7 days. Keep up the good work.</p>
<p>By continuing to achieve the recommended guidelines of physical
	activity you can lower the risk of suffering from coronary heart
	disease and strokes by 35%, as well as helping to protect against
	obesity, type 2 diabetes and hypertension.</p>
<p>
	<a href="http://www.championsforhealth.wales.nhs.uk/exercise"
		target="exercisehigh">Find out more about the health benefits
		associated with taking regular exercise</a>
</p>
<?php } elseif ($feedback == "MODERATE") {?>
<p>Your responses indicate you have taken some exercise this week and
	were close to achieving the recommended weekly levels of exercise. This
	classes you in the moderate category of physical activity.</p>
<p>With just a little bit more you can exceed the recommended levels of
	physical activity.</p>
<p>Achieving the recommended levels of physical activity can help you
	maintain a healthy weight, and improve self-esteem and wellbeing.</p>
<p>
	<a href="http://www.championsforhealth.wales.nhs.uk/exercise"
		target="exercisehigh">Find out more about the health benefits
		associated with taking regular exercise</a>
</p>
<?php } else {?>
<p>Your responses indicate that you have not taken much exercise in the
	last 7 days and are classed in the low activity category.</p>
<p>Did you know, this places you at greater risk from a range of
	diseases including coronary heart disease, stroke and type 2 diabetes
	and can make it more difficult to maintain a healthy weight.</p>
<p>
	<a
		href="http://www.championsforhealth.wales.nhs.uk/what-s-the-problem-with-being-inactive-"
		target="exerciseinactive">Find out more about the health problems
		associated with being inactive</a>
</p>
<?php }?>
<p>You can add the Take Regular Exercise module to your personal
	dashboard to monitor and track your exercise levels to help you make
	and maintain more changes.</p>

<?php echo $this->Form->create('ExerciseScreener', array(
		'inputDefaults' => array(
        'label' => false
    )));

echo $this->Form->hidden('vigorous_days');
echo $this->Form->hidden('vigorous_mins');
echo $this->Form->hidden('moderate_days');
echo $this->Form->hidden('moderate_mins');
echo $this->Form->hidden('walking_days');
echo $this->Form->hidden('walking_mins');
echo $this->Form->hidden('sedentary_mins');
echo $this->Form->hidden('ExerciseScreener.score', array('value'=>$score));
echo $this->Form->hidden('ExerciseScreener.feedback', array('value'=>$feedback));

$options = array(
    'label' => 'Add the Take Regular Exercise module to my dashboard'
);

echo $this->Form->end($options);
?>