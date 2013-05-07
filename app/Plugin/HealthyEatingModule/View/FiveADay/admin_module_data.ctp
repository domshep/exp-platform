<?php $this->extend('/Modules/module_template'); ?>
<h2>Module data view / export</h2>
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
		<dt><?php echo __('No. of users'); ?></dt>
		<dd>
			<?php echo count($module['ModuleUser']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('No. of screener records'); ?></dt>
		<dd>
			<?php echo $screeners; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('No. of weekly records'); ?></dt>
		<dd>
			<?php echo $weeklyRecords; ?>
			&nbsp;
		</dd>
		<hr />
		<dt><?php echo __('Height (cm)'); ?></dt>
		<dd>
			<?php echo h($viewuser['Profile']['height_cm']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post Code'); ?></dt>
		<dd>
			<?php echo h($viewuser['Profile']['post_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile No'); ?></dt>
		<dd>
			<?php echo h($viewuser['Profile']['mobile_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Registered'); ?></dt>
		<dd>
			<?php echo h($viewuser['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modules'); ?></dt>
		<dd>
			<?php foreach($userModules as $module) {
				echo h($module)."<br />";
			}?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit user'), array('action' => 'edit', $viewuser['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete user'), array('action' => 'delete', $viewuser['User']['id']), null, __('Are you sure you want to delete user #%s?', $viewuser['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Admin panel'), '/admin_panel'); ?></li>
	</ul>
</div>
