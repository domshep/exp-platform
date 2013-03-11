<h2 class="bigred"><?php echo $module_name; ?> - Add Module</h2>
<div>
    <h3>Your score is <?php echo $score;?></h3>
    <?php if($score < 35) {?>
    <p>Were you aware that this score indicates that you have eaten less than half (40%) of your recommended 5-a-day fruit and vegetable  intake?</p>

<p>This makes it more difficult to maintain a healthy weight and places you are greater risk from a range of diseases including coronary heart disease, stroke and type 2 diabetes.</p>

<p>It is important to remember that eating recommended levels of fruit and vegetables only forms part of a healthy balanced diet.</p>

    <?php } else {?>
    <p>Congratulations and well done. This score indicates you have eaten the equivalent of your recommended 5-a-day fruit and vegetable intake over the last month. Keep up the good work.</p>

<p>It is important to remember that eating recommended levels of fruit and vegetables only forms part of a healthy balanced diet.</p>

    <?php }?>
    
    <p><a href="http://www.nhs.uk/Livewell/Goodfood/Pages/Healthyeating.aspx ">Click here for more information on what makes a balanced diet</a></p>
    

    <?php echo $this->Form->create('FiveadayScreener', array(
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
    echo $this->Form->hidden('FiveadayScreener.score', array('value'=>$score));
    
    
    
$options = array(
    'label' => 'Add the healthy eating module to my dashboard'
);

echo $this->Form->end($options);
?>
</div>