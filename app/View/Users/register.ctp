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