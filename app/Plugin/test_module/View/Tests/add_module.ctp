<?php $this->extend('/Modules/module_template');?>

<h3>Information about the test module</h3>
<p>Information goes here...</p>
<?php echo $this->Html->link('Take the test >', 'screener', array('class' => 'button action', 'target' => '_self')); ?>