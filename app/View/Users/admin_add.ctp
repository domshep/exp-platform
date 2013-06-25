<div class="module-title">
	<h1><?php echo $this->Html->image('/img/Apps-system-users-icon.png', array('alt' => "Admin Panel User icon", 'escape' => false, 'class'=> 'icon'));?>
Admin Panel - New User</h1>
</div>
<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('email');
		echo $this->Form->input('password');
		echo $this->Form->input('role', array(
			'options' => array('super-admin' => 'Super-Admin', 'admin' => 'Admin', 'user' => 'User')
		));
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
		?>
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
				echo $this->Form->input('Profile.post_code');
				echo $this->Form->input('Profile.mobile_no');
				echo $this->Form->input('Profile.allow_research', array('label' => 'This user&rsquo;s information can be used for research into improving health', 'after' => '<br />(Researchers will not have access to their personal details)', 'checked' => true));
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
			    var imperial = getImperialHeight(parseFloat($(".cms").val()));
			    
			});
		</script>