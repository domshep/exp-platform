<h1>Forgot My Password</h1>
<?php echo $this->Session->flash('auth'); ?>
<p class="lead">Please enter your email address so that we can send you a new password.</p>
<div class="row">
<?php echo $this->Form->create('UserPass', array('class' => 'col-md-6')); ?>
    <fieldset>
        <?php echo $this->Form->input('email',
        		array(
					'class' => 'form-control',
					'div' => 'form-group'));?>
    </fieldset>
<?php
$options = array(
		'label' => 'Send me a new password',
		'class' => 'btn btn-success btn-md bot-buffer pull-right'
);
echo $this->Form->end($options);
?>
</div>
<div class="row container">
	<p class="clearfix"><?php echo $this->Html->link('Register a new account', '/users/register'); ?></p>
	<p><?php echo $this->Html->link('Login', '/users/login'); ?></p>
</div>