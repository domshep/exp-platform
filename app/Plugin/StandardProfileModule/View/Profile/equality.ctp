<div class="users form">
<?php echo $this->Form->create('Equality'); ?>
	<fieldset>
		<legend><?php echo __('Equality Profile'); ?></legend>
	<?php
		echo $this->Form->hidden('id');
		echo $this->Form->input('Equality.disability', array(
				'label' => 'Do you consider yourself to have a disability?',
				'options' => array('Yes'  => 'Yes', 
						'No' => 'No', 
						'Prefer not to say' => 'Prefer not to say'),
	    		'empty' => '(choose one)'
		));
		echo $this->Form->input('Equality.sexual_orientation', array(
				'label' => 'Which of the following options best describes how you think of yourself?',
				'options' => array(
						'Heterosexual/straight' => 'Heterosexual/straight',
						'Gay/lesbian' => 'Gay/lesbian', 
						'Bisexual' => 'Bisexual', 
						'Transgender' => 'Transgender', 
						'Prefer not to say' => 'Prefer not to say'),
	    		'empty' => '(choose one)'
		));
		echo $this->Form->input('Equality.ethnicity', array(
				'label' => 'To which of these ethnic groups do you consider to belong?',
				'options' => array(
						'White or Caucasian' => 'White or Caucasian', 
						'Middle Eastern' => 'Middle Eastern', 
						'Asian or Asian British' => 'Asian or Asian British', 
						'Black or African or African British' => 'Black or African or African British', 
						'Chinese or British Chinese' => 'Chinese or British Chinese', 
						'Other ethnic group' => 'Other ethnic group', 
						'Mixed ethnic background' => 'Mixed ethnic background', 
						'Prefer not to say' => 'Prefer not to say'),
	    		'empty' => '(choose one)'
		));
		echo $this->Form->input('Equality.religion', array(
				'label' => 'What is your religion?',
				'options' => array(
						'No religion' => 'No religion', 
						'Christian' => 'Christian', 
						'Buddhist' => 'Buddhist', 
						'Hindu' => 'Hindu', 
						'Jewish' => 'Jewish', 
						'Muslim' => 'Muslim', 
						'Sikh' => 'Sikh', 
						'Any other religion' => 'Any other religion', 
						'Prefer not to say' => 'Prefer not to say'),
	    		'empty' => '(choose one)'
		));
		echo $this->Form->input('Equality.marital_status', array(
				'label' => 'What is your marital status?',
				'options' => array(
						'Single or unmarried' => 'Single or unmarried', 
						'Separated or divorced' => 'Separated or divorced', 
						'Widowed' => 'Widowed', 
						'Living with a partner' => 'Living with a partner', 
						'Heterosexual marriage' => 'Heterosexual marriage', 
						'Civil partnership or Gay/Lesbian marriage' => 'Civil partnership or Gay/Lesbian marriage', 
						'Prefer not to say' => 'Prefer not to say'),
	    		'empty' => '(choose one)'
		));
	?>
	</fieldset>
	<div class="submit">
         <?php echo $this->Form->submit(__('Submit', true), array('name' => 'ok', 'div' => false, 'id' =>'submit')); ?>
         <?php echo $this->Form->submit(__('Cancel (without saving changes)', true), array('name' => 'cancel','div' => false, 'id' =>'cancel')); ?>
	</div>
</div>