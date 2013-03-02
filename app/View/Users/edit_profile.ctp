<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Edit Profile'); ?></legend>
	<?php
		echo $this->Form->input('User.email');
		echo $this->Form->input('Profile.name');
		echo $this->Form->input('Profile.gender', array(
				'options' => array('M' => 'Male', 'F' => 'Female')
		));
		echo $this->Form->input('Profile.date_of_birth', array(
				'label' => 'Date of birth',
				'dateFormat' => 'DMY',
				'minYear' => date('Y') - 90,
				'maxYear' => date('Y') - 18,
		));
		echo $this->Form->input('Profile.height_cm', array(
				'label' => 'Height (cm)'
		));
		echo $this->Form->input('Profile.post_code');
		echo $this->Form->input('Profile.mobile_no');
		
		echo $this->Form->input('new_password', array('type' => 'password'));
		echo $this->Form->input('repeat_password', array('type' => 'password'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('My Dashboard'), array('action' => 'dashboard')); ?> </li>
	</ul>
</div>
