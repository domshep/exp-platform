<div class="profiles form">
<?php echo $this->Form->create('Profile'); ?>
	<fieldset>
		<legend><?php echo __('Edit Profile'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('name');
		echo $this->Form->input('gender');
		echo $this->Form->input('height_cm', array('label'=>'Height (cms)', 'class'=>'cms'));
		echo $this->Form->input('height_feet', array('label'=>'Height (foot)', 'class'=>'feet'));
		echo $this->Form->input('height_inches', array('label'=>'Height (inches)', 'class'=>'inches'));
		echo $this->Form->input('post_code');
		echo $this->Form->input('mobile_no');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Profile.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Profile.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
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