<h2 class="bigred"><?php echo $module_name; ?> - Add Module</h2>
<div class="view">
    <h1>Your score is <?php echo $score;?></h1>
    <?php if($score < 35) {?>
    Were you aware that this score indicates that you have eaten less than half (40%) of your recommended 5-a-day fruit and vegetable  intake?

This makes it more difficult to maintain a healthy weight and places you are greater risk from a range of diseases including coronary heart disease, stroke and type 2 diabetes.

It is important to remember that eating recommended levels of fruit and vegetables only forms part of a healthy balanced diet.
Click here for more information on what makes a balanced diet
http://www.nhs.uk/Livewell/Goodfood/Pages/Healthyeating.aspx 
    <?php } else {?>
    Congratulations and well done. This score indicates you have eaten the equivalent of your recommended 5-a-day fruit and vegetable intake over the last month. Keep up the good work.

It is important to remember that eating recommended levels of fruit and vegetables only forms part of a healthy balanced diet.
Click here for more information on what makes a balanced diet
http://www.nhs.uk/Livewell/Goodfood/Pages/Healthyeating.aspx 

    <?php }?>

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
    <?php echo $this->Html->link('Take the test', 'screener', array('class' => 'button', 'target' => '_self')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('My Dashboard'), array('controller' => 'users', 'action' => 'dashboard', 'plugin' => null)); ?> </li>
		<li><?php echo $this->Html->link(__('Explore Module'), array('action' => 'explore_module')); ?></li>
	</ul>
</div>
