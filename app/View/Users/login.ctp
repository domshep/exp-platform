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
