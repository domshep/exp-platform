<div class="users form">
	<h1>Forgot My Password</h1>
	<?php echo $this->Session->flash('auth'); ?>
	<?php echo $this->Form->create('UserPass'); ?>
    <fieldset>
        <legend><?php echo __('Please enter your email address'); ?></legend>
        <?php echo $this->Form->input('email'); ?>
    </fieldset>
<?php echo $this->Form->end(__('Send me a new password')); ?>
<p><?php echo $this->Html->link('Register a new account', '/users/register'); ?> | <?php echo $this->Html->link('Login', '/users/login'); ?></p>
</div>
