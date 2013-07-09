<h1>My profile</h1>
<div class="users view">
	<dl>
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
		<dt><?php echo __('Home Post Code'); ?></dt>
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
	<p style="margin-top:1em;">
		<?php if($user['Profile']['allow_research']) {
			echo "My information MAY be used for research into improving health";
		} else {
			echo "My information MAY NOT be used for research into improving health";
		}
		?>
	</p>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('My Dashboard'), array('plugin' => false,'controller' => 'users', 'action' => 'dashboard')); ?> </li>
		<li><?php echo $this->Html->link(__('Edit Profile'), array('action' => 'editProfile')); ?> </li>
	</ul>
</div>