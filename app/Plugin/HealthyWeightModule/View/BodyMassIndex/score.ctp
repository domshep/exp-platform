<?php $this->extend('/Modules/module_template');?>

    <h2>Your score is <?php echo $bmi;?></h2>
    <?php if ($bmi < 18.5) {?>
    <p>Underweight: Your BMI suggests that you might be Underweight.</p>
	<?php } elseif ($bmi >= 18.5 and $bmi < 25) {?>
    <p>Normal Range: Your BMI falls within the 'normal' range.</p>
	<?php } elseif ($bmi >= 25 and $bmi < 30) {?>
    <p>Overweight: Your BMI suggests that you might be Overweight. Don't worry though, you're in the right place.</p>
	<?php } elseif ($bmi >= 30) {?>
    <p>Obese: Your BMI suggests that you might be Obese. Don't worry though, you've come to the right place.</p>
	<?php }?>
    

    <?php echo $this->Form->create('BmiScreener', array(
    'inputDefaults' => array(
        'label' => false
    )));
    
    echo $this->Form->hidden('start_weight_kg',array('value'=>$weight_kg));
    echo $this->Form->hidden('height_cm',array('value'=>$height_cm));
    echo $this->Form->hidden('bmi', array('value'=>$bmi));
    echo $this->Form->hidden('BmiScreener.start_bmi', array('value'=>$bmi));
    
    
    
$options = array(
    'label' => 'Add the BMI module to my dashboard'
);

echo $this->Form->end($options);
?>