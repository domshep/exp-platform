<h2 class="bigred">My profile</h2>
<div class="users view">
<h2><?php  echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Profile Id'); ?></dt>
		<dd>
			<?php echo h($user['Profile']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($user['Profile']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($user['Profile']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date of Birth'); ?></dt>
		<dd>
			<?php echo h($user['Profile']['date_of_birth']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Height (cm)'); ?></dt>
		<dd>
			<?php echo h($user['Profile']['height_cm']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post Code'); ?></dt>
		<dd>
			<?php echo h($user['Profile']['post_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mobile No'); ?></dt>
		<dd>
			<?php echo h($user['Profile']['mobile_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Registered'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('My Dashboard'), array('action' => 'dashboard')); ?> </li>
		<li><?php echo $this->Html->link(__('Edit Profile'), array('action' => 'editProfile')); ?> </li>
	</ul>
</div>
