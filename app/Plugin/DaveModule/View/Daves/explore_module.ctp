<h2 class="bigred"><?php  echo $module_name; ?></h2>
<div class="view">
<h2><?php  echo $message; ?></h2>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Add To Dashboard'), array('action' => 'add_module')); ?></li>
	</ul>
</div>