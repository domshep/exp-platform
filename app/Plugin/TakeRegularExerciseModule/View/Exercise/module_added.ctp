<?php $this->extend('/Modules/module_template');?>

<h3>The 'Take Regular Exercise' module has now been added to your dashboard.</h3>
<p>From there, you'll be able to track and record your progress, and access information
and resources to help you achieve your 150 minutes each week.</p>
<p>Good luck!</p>
<p><?php echo $this->Html->link('Return to my dashboard', array('controller' => 'users', 'action' => 'dashboard', 'full_base' => true, 'plugin' => false), array('class' => 'button action', 'target' => '_self')); ?></p>