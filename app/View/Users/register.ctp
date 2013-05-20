<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Register your details'); ?></legend>
		<p>Please enter an email address and password that can be used to access your account in the future.</p>
	<?php
		echo $this->Form->input('email');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Sign me up!')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Sign in with an existing account'); ?></h3>
	<ul>
		<li><?php echo $this->Html->image('/img/google_128.png', array('alt' => "Google icon", 'escape' => false, 'class'=> 'icon', 'url' => '/users/openid_login/google'));?></li>
		<li><?php echo $this->Html->image('/img/yahoo_128.png', array('alt' => "Yahoo icon", 'escape' => false, 'class'=> 'icon', 'url' => '/users/openid_login/yahoo'));?></li>
	</ul>
</div>