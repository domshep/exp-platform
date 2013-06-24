<div class="users form">
<h1>Register your details</h1>
<h3>You can save time (and have one less password to remember!) by signing in to this site with one of your existing social media accounts.</h3>
<p>Click a button below to sign in using your social media details, or enter your email address and a password in the fields to the left.</p>
<ul class="social-media-list">
	<li><?php
		echo $this->Html->image('/img/google_128.png', array('alt' => "Sign in with Google", 'escape' => false, 'class'=> 'icon', 'url' => '/users/openid_login/google', 'style'=>'vertical-align:middle;',));
		echo $this->Html->link('Register via Google', '/users/openid_login/google')
	?></li>
	<li><?php
		echo $this->Html->image('/img/yahoo_128.png', array('alt' => "Sign in with Yahoo", 'escape' => false, 'class'=> 'icon', 'url' => '/users/openid_login/yahoo', 'style'=>'vertical-align:middle;',));
		echo $this->Html->link('Register via Yahoo', '/users/openid_login/yahoo')
	?></li>
	<li><?php
		echo $this->Html->image('/img/twitter_128.png', array('alt' => "Sign in with Twitter", 'escape' => false, 'class'=> 'icon', 'url' => '#', 'style'=>'vertical-align:middle;',));
		echo $this->Html->link('Register via Twitter (coming soon!)', '#')
	?></li>
	<li><?php
		echo $this->Html->image('/img/facebook_128.png', array('alt' => "Sign in with Facebook", 'escape' => false, 'class'=> 'icon', 'url' => '#', 'style'=>'vertical-align:middle;',));
		echo $this->Html->link('Register via Facebook (coming soon!)', '#')
	?></li>
</ul>
</div>
<div class="actions register-form">
	<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<p>If you'd rather not login via your social media profile, then please enter an email address and password that can be used to access your account in the future.</p>
	<?php
		echo $this->Form->input('email');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Sign me up!')); ?>
</div>