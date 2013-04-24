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
		echo $this->Form->input('Profile.post_code');
		echo $this->Form->input('Profile.mobile_no');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<script type="text/javascript">

jQuery(".feet").bind("blur", function() 
{
	getMetricHeight();
});

jQuery(".inches").bind("blur", function() 
{
    getMetricHeight();
});

jQuery(".cms").bind("blur", function() {
    getImperialHeight();
});

jQuery("body").ready(function() {
    getImperialHeight();
});

function getImperialHeight()
{
	var cms = parseFloat($(".cms").val());
	var feet = parseFloat($(".feet").val());
    var inches = parseFloat($(".inches").val());
    
    if(isNaN(cms)) cms = 0;
	
	if (cms > 0){
		var newinches = Math.round((cms * 0.393701),2);
		var newfeet = Math.floor(newinches / 12);
		newinches = (newinches - (newfeet*12));
		$(".feet").val(newfeet);
		$(".inches").val(newinches);
	}
}

function getMetricHeight()
{
	var feet = parseFloat($(".feet").val());
    var inches = parseFloat($(".inches").val());
    
	var cms = parseFloat($(".cms").val());
	
    if(isNaN(feet)) feet = 0;
	if(isNaN(inches)) inches = 0;
	
	if (feet > -1 && inches > -1){
		var newcm = Math.round(((feet * 12) + inches) * 2.54,0);
		$(".cms").val(newcm);
	}
	
	if (inches >= 12){
		var newfeet = ($(".feet").val()* 1) + 1;
		var newinches = ($(".inches").val()* 1) - 12;
		while (newinches >= 12)
		{
			var newfeet = newfeet + 1;
			var newinches = newinches - 12;
		}
		$(".feet").val(newfeet);
		$(".inches").val(newinches);
	}
	if (inches < 0){
		$(".inches").val(0);
	}
	
}

</script>