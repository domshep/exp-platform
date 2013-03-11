<?php $this->extend('/Modules/module_template');?>

<h3><?php  echo $message; ?></h3>
<ul>
	<li><?php echo $this->Html->link(__('Add To Dashboard'), array('action' => 'add_module')); ?></li>
</ul>