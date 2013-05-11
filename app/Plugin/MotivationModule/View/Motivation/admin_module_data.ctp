<div class="modules view">
	<dl>
		<dt><?php echo __('Module name'); ?></dt>
		<dd>
			<?php echo $module['Module']['name']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($module['Module']['type']); ?>
			&nbsp;
		</dd>
		<!--<dt><?php echo __('No. of users'); ?></dt>
		<dd>
			<?php echo count($module['ModuleUser']); ?>
			&nbsp;
		</dd>-->
		<dt><?php echo __('No. of records'); ?></dt>
		<dd>
			<?php echo $screeners; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Export screeners'), array('action' => 'export_screeners')); ?> </li>
		<li><?php echo $this->Html->link(__('Admin panel'), '/admin_panel'); ?></li>
	</ul>
</div>
