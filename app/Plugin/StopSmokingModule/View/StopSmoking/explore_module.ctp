<?php $this->extend('/Modules/module_template');?>

<h2><?php  echo $message; ?></h2>
<br />
<?php echo $this->Html->link(__('Add this module to your dashboard'), array('action' => 'add_module'), array('class' => 'button action', 'target' => '_self')); ?>