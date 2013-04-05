<?php $this->extend('/Modules/module_template');?>

<h2>What is a BMI?</h2>
<h3>Your Body Mass Index</h3>
<p>TO DO: Insert BMI info</p>
<?php
if($added_to_dashboard) {
	echo "<p>This module is already on your dashboard.</p>";
} else {
	echo $this->Html->link(__('Add this module to your dashboard'), array('action' => 'add_module'), array('class' => 'button action', 'target' => '_self'));
}?>