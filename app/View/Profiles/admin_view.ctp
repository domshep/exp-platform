<div class="profiles view">
<h2><?php  echo __('Profile'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($profile['User']['id'], array('controller' => 'users', 'action' => 'view', $profile['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Height Cm'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['height_cm']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post Code'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['post_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile No'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['mobile_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($profile['Profile']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Profile'), array('action' => 'edit', $profile['Profile']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Profile'), array('action' => 'delete', $profile['Profile']['id']), null, __('Are you sure you want to delete # %s?', $profile['Profile']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
