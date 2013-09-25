<?php $this->extend('/Modules/module_template');?>

<h2>Your body mass index (BMI) is <?php echo $bmi;?></h2>
<?php if ($bmi < 18.5) {?>
<p>This result suggests you are underweight for your height. This can affect your health and it is recommended you speak to your GP who can help you find out more and achieve a healthy weight.</p>
<p><a href="/healthy_weight_module/body_mass_index/explore_module">Find out more about the health benefits of a healthy weight</a>.</p>
<?php } elseif ($bmi >= 18.5 and $bmi < 25) {?>
<p>Well done, this result suggests you are a healthy weight for your height. Maintaining a healthy weight decreases the risks of a range problems and can help you feel better and more confident.</p>
<p><a href="/healthy_weight_module/body_mass_index/explore_module">Find out more about the health benefits of a healthy weight</a>.</p>
<?php } elseif ($bmi >= 25 and $bmi < 30) {?>
<p>This result suggests your BMI is above the healthy range and you may be overweight for your height. Excess weight puts you at increased risk of serious health conditions such as heart disease, high blood pressure, stroke and type 2 diabetes. Losing weight is likely to make health improvements.</p>
<p><a href="http://www.championsforhealth.wales.nhs.uk/is-being-overweight-that-bad-">Find out more about the health risks associated with being overweight</a>.</p>
<?php } elseif ($bmi >= 30) {?>
<p>This result suggests your BMI is above 30, indicating you are obese. Being obese puts you at high risk of serious health conditions such as heart disease, high blood pressure, stroke and type 2 diabetes. Losing weight is likely to make significant physical and wellbeing health improvements. It is recommended you speak to your GP who can help you find out more and achieve a healthy weight.</p>
<p><a href="http://www.championsforhealth.wales.nhs.uk/is-being-overweight-that-bad-">Find out more about the health risks associated with being overweight</a>.</p>
<?php }?>
	
<p>A healthy BMI range is 18.5 &#8211; 24.9</p>
<p><img src="/healthy_weight_module/img/Bmi/bmi-range.gif" width="461" height="354" alt="BMI range graph" class="img-responsive" style="margin:0 auto; display:block;"></p>
<p>You can add the BMI module to your personal dashboard to monitor and track your BMI to help you make and maintain more changes.</p>

    <?php echo $this->Form->create('BmiScreener', array(
    'inputDefaults' => array(
        'label' => false
    )));
    
    echo $this->Form->hidden('start_weight_kg',array('value'=>$weight_kg));
    echo $this->Form->hidden('height_cm',array('value'=>$height_cm));
    echo $this->Form->hidden('bmi', array('value'=>$bmi));
    echo $this->Form->hidden('BmiScreener.start_bmi', array('value'=>$bmi));
    
    
    
$options = array(
    'label' => 'Add the BMI module to my dashboard',
	'class' => 'btn btn-success btn-md bot-buffer pull-right'
);

echo $this->Form->end($options);
?>