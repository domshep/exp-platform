<?php $this->extend('/Modules/module_template');?>

<h2>Information about the test module</h2>
<p class="lead">Information goes here...</p>
<p><?php echo $this->Html->link('Take the test <span class="glyphicon glyphicon-chevron-right"></span>', 'screener', array('class' => 'btn btn-success btn-md bot-buffer pull-right', 'target' => '_self', 'escape' => false)); ?></p>