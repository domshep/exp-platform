<?php $this->extend('/Modules/module_template');?>

<h2>The Healthy Weight module has now been added to your dashboard.</h2>
<p>From there, you'll be able to track and record your weight, and access information
and resources to help you achieve a healthy Body Mass Index (BMI).</p>
<p>Good luck!</p>
<p><?php echo $this->Html->link('Return to my dashboard', array('controller' => 'users', 'action' => 'dashboard', 'full_base' => true, 'plugin' => false), array('class' => 'button action', 'target' => '_self')); ?></p>