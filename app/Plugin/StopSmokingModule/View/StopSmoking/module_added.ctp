<?php $this->extend('/Modules/module_template');?>

<h2>The Stop Smoking module has now been added to your dashboard.</h2>
<p>From there, you'll be able to track and record your smoke-free days, and access information
and resources to help you to stop smoking.</p>
<p><?php echo $this->Html->link('Return to my dashboard', array('controller' => 'users', 'action' => 'dashboard', 'full_base' => true, 'plugin' => false), array('class' => 'button action', 'target' => '_self')); ?></p>