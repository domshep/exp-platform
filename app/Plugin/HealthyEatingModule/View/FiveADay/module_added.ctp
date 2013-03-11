<?php $this->extend('/Modules/module_template');?>

<h3>The 5-a-day healthy eating module has now been added to your dashboard.</h3>
<p>From there, you'll be able to track and record your progress, and access information
and resources to help you achieve your 5-a-day more regularly.</p>
<p>Good luck!</p>
<p><?php echo $this->Html->link('Return to my dashboard', array('controller' => 'users', 'action' => 'dashboard', 'full_base' => true, 'plugin' => false), array('class' => 'button action', 'target' => '_self')); ?></p>