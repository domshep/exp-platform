<?php $this->extend('/Modules/module_template');?>

<h2><?php  echo $message; ?></h2>

<p>Good luck!</p>

<p><?php
echo $this->Html->link('<span class="glyphicon glyphicon-th-large"></span> Return to my dashboard', array('controller' => 'users', 'action' => 'dashboard', 'full_base' => true, 'plugin' => false), array('class' => 'btn btn-success btn-md bot-buffer pull-right', 'target' => '_self', 'escape' => false));
?></p>