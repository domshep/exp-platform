<?php $this->extend('/Modules/module_template');?>

<p class="lead">The 5-a-day healthy eating module has now been added to your dashboard.</p>
<p>From there, you'll be able to track and record your progress, and access information
and resources to help you achieve your 5-a-day more regularly.</p>
<p>Good luck!</p>
<p><?php
echo $this->Html->link('<span class="glyphicon glyphicon-th-large"></span> Return to my dashboard', array('controller' => 'users', 'action' => 'dashboard', 'full_base' => true, 'plugin' => false), array('class' => 'btn btn-success btn-md bot-buffer pull-right', 'target' => '_self', 'escape' => false));
?></p>
