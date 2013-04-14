<?php $this->extend('/Modules/module_template');?>

<h2><?php  echo $message; ?></h2>

<p>Good luck!</p>
<p><?php echo $this->Html->link('Return to my dashboard', array('controller' => 'users', 'action' => 'dashboard', 'full_base' => true, 'plugin' => false), array('class' => 'button action', 'target' => '_self')); ?></p>