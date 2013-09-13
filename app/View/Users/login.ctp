<?php echo $this->Session->flash('auth'); ?>
<h1>Login</h1>
<div class="row">
<div class="col-md-8">
<h2>Sign in to this site with one of your existing social media accounts.</h2>
<p class="lead">Click a button below to sign in using your social media details, or enter your email address and password in the panel.</p>
<ul class="list-inline">
	<li class="col-md-6"><?php
		echo $this->Html->image('/img/google_128.png', array('alt' => "Login with Google", 'escape' => false, 'class'=> 'icon', 'url' => '/users/openid_login/google', 'style'=>'vertical-align:middle;',));
		echo $this->Html->link('Login via Google', '/users/openid_login/google')
	?></li>
	<li class="col-md-6"><?php
		echo $this->Html->image('/img/yahoo_128.png', array('alt' => "Login with Yahoo", 'escape' => false, 'class'=> 'icon', 'url' => '/users/openid_login/yahoo', 'style'=>'vertical-align:middle;',));
		echo $this->Html->link('Login via Yahoo', '/users/openid_login/yahoo')
	?></li>
	<li class="col-md-6"><?php
		echo $this->Html->image('/img/twitter_128.png', array('alt' => "Login with Twitter", 'escape' => false, 'class'=> 'icon', 'url' => '#', 'style'=>'vertical-align:middle;',));
		echo $this->Html->link('Login via Twitter (coming soon!)', '#')
	?></li>
	<li class="col-md-6"><?php
		echo $this->Html->image('/img/facebook_128.png', array('alt' => "Login with Facebook", 'escape' => false, 'class'=> 'icon', 'url' => '#', 'style'=>'vertical-align:middle;',));
		echo $this->Html->link('Login via Facebook (coming soon!)', '#')
	?></li>
</ul>
</div>
<div class="col-md-3 col-md-offset-1 well">
	<?php echo $this->Form->create('User', array('class' => 'clearfix')); ?>
    <fieldset>
    	<p>If you'd rather not login via your social media profile, then please enter the email address and password that you used to register.</p>
        <?php
        echo $this->Form->input('email');
        echo $this->Form->input('password');
    	?>
    </fieldset>
    <?php
		$options = array(
    				'label' => 'Login',
					'class' => 'btn btn-success btn-md bot-buffer pull-right'
				);
		echo $this->Form->end($options);
	?>
<p class="clearfix"><?php echo $this->Html->link('Register a new account', '/users/register'); ?></p>
<p><?php echo $this->Html->link('Forgot your password?', '/users/password_reminder'); ?></p>
</div>
</div>