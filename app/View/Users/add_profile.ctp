<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Your Profile'); ?></legend>
		<p>Please enter some general details about yourself below. The information that you enter here will be made available to any health
		modules that you add to your personal dashboard, and will save you from having to re-enter general information
		each time you explore a new module.</p>
		<p>All data is held confidentially and securely.</p>
	<?php
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
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>