<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Please enter your email address and password to login'); ?></legend>
        <?php echo $this->Form->input('email');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
<p><?php echo $this->Html->link('Register a new account', '/users/register'); ?> | <?php echo $this->Html->link('Forgot your password?', '/users/password_reminder'); ?></p>
</div>
<div class="actions">
	<h3><?php echo __('Sign in with an existing account'); ?></h3>
	<ul>
		<li><?php echo $this->Html->image('/img/google_128.png', array('alt' => "Google icon", 'escape' => false, 'class'=> 'icon', 'url' => '/users/openid_login/google'));?></li>
		<li><?php echo $this->Html->image('/img/yahoo_128.png', array('alt' => "Yahoo icon", 'escape' => false, 'class'=> 'icon', 'url' => '/users/openid_login/yahoo'));?></li>
	</ul>
</div>
