<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<h1>Login</h1>
<h3>Sign in to this site with one of your existing social media accounts.</h3>
<p>Click a button below to sign in using your social media details, or enter your email address and password in the fields to the left.</p>
<ul class="social-media-list">
	<li><?php
		echo $this->Html->image('/img/google_128.png', array('alt' => "Login with Google", 'escape' => false, 'class'=> 'icon', 'url' => '/users/openid_login/google', 'style'=>'vertical-align:middle;',));
		echo $this->Html->link('Login via Google', '/users/openid_login/google')
	?></li>
	<li><?php
		echo $this->Html->image('/img/yahoo_128.png', array('alt' => "Login with Yahoo", 'escape' => false, 'class'=> 'icon', 'url' => '/users/openid_login/yahoo', 'style'=>'vertical-align:middle;',));
		echo $this->Html->link('Login via Yahoo', '/users/openid_login/yahoo')
	?></li>
	<li><?php
		echo $this->Html->image('/img/twitter_128.png', array('alt' => "Login with Twitter", 'escape' => false, 'class'=> 'icon', 'url' => '#', 'style'=>'vertical-align:middle;',));
		echo $this->Html->link('Login via Twitter (coming soon!)', '#')
	?></li>
	<li><?php
		echo $this->Html->image('/img/facebook_128.png', array('alt' => "Login with Facebook", 'escape' => false, 'class'=> 'icon', 'url' => '#', 'style'=>'vertical-align:middle;',));
		echo $this->Html->link('Login via Facebook (coming soon!)', '#')
	?></li>
</ul>
</div>
<div class="actions register-form">
	<?php echo $this->Form->create('User'); ?>
    <fieldset>
    	<p>If you'd rather not login via your social media profile, then please enter the email address and password that you used to register.</p>
        <?php
        echo $this->Form->input('email');
        echo $this->Form->input('password');
    	?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
<p style="clear:both;margin:4em 0 2em;"><?php echo $this->Html->link('Register a new account', '/users/register'); ?></p>
<p><?php echo $this->Html->link('Forgot your password?', '/users/password_reminder'); ?></p>
</div>
