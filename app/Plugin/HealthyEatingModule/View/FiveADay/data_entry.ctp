<?php $this->extend('/Modules/module_template');?>

<h2><?php  echo $message; ?></h2>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('My Dashboard'), array('controller' => 'users', 'action' => 'dashboard', 'plugin' => null)); ?> </li>
		<li><?php echo $this->Html->link(__('Module Dashboard'), array('action' => 'module_dashboard')); ?></li>
	</ul>
</div>
