<div class="module-title">
	<h1><?php echo $this->Html->image('/img/Apps-system-users-icon.png', array('alt' => "Admin Panel icon", 'escape' => false, 'class'=> 'icon'));?>
Admin Panel - View User</h1>
</div>
<div class="users view">
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($viewuser['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($viewuser['Profile']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($viewuser['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($viewuser['Profile']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date of Birth'); ?></dt>
		<dd>
			<?php echo h($viewuser['Profile']['date_of_birth']); ?>
			&nbsp;
		</dd>
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
