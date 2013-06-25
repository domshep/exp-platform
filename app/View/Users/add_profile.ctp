<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Your Profile'); ?></legend>
		<p>Please enter some general details about yourself below. The information that you enter here will be made available to any health
		modules that you add to your personal dashboard, and will save you from having to re-enter general information
		each time you explore a new module.</p>
		<p><strong>All your data will be treated in the strictest confidence and held in a highly secure database. This website allows you modify or remove your profile at a later stage should you wish to do so.</strong></p>
	<?php
		echo $this->Form->input('Profile.name');
		echo $this->Form->input('User.email', array('disabled' => true));
		echo $this->Form->input('Profile.gender', array(
				'options' => array('M' => 'Male', 'F' => 'Female')
		));
		echo $this->Form->input('Profile.date_of_birth', array(
				'label' => 'Date of birth',
				'dateFormat' => 'DMY',
				'minYear' => date('Y') - 90,
				'maxYear' => date('Y') - 18,
		));?>
		<table>
			<tr>
				<td style="border:0px; padding:0px;"><?php
		echo $this->Form->input('Profile.height_cm', array(
				'label' => 'Height in cm', 'class'=>'cms', 'style'=>'width:100px;'
		));
		?></td>
		<td style="border:0px; padding:0px;"><div> OR </div></td>
		<td style="border:0px; padding:0px;"><?php 
		echo $this->Form->input('height_feet', array('label'=>'Height in feet &amp; inches', 'class'=>'feet', 'style'=>'width:100px;'));
		?></td><td style="border:0px; padding:0px;"><?php 
		echo $this->Form->input('height_inches', array('label'=>'&nbsp;', 'class'=>'inches', 'style'=>'width:100px;'));
		?></td></tr></table><?php
		echo $this->Form->input('Profile.post_code', array('label' => 'Home post code (UK)'));
		echo $this->Form->input('Profile.mobile_no', array('label' => 'Mobile number'));
		echo $this->Form->input('Profile.allow_research', array('label' => 'My information can be used for research into improving health', 'after' => '<br />(Researchers will not have access to your personal details)', 'checked' => true));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type="text/javascript">

jQuery(".feet").bind("blur", function() 
{
	getMetricHeight(parseFloat($(".feet").val()), parseFloat($(".inches").val()));
});

jQuery(".inches").bind("blur", function() 
{
	getMetricHeight(parseFloat($(".feet").val()), parseFloat($(".inches").val()));
});

jQuery(".cms").bind("blur", function() {
    getImperialHeight(parseFloat($(".cms").val()));
});

jQuery("body").ready(function() {
    getImperialHeight(parseFloat($(".cms").val()));
});
</script>