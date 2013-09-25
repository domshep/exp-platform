<?php
$this->extend('/Modules/module_template');
echo $this->Html->css('/healthy_weight_module/css/module.css', array('inline'=> false));
?>

<h2>Your monthly records</h2>
<p class="lead">Use this screen to quickly review your records on a month-by-month basis.
<div class="calendar-holder col-md-8">
<?php 
	echo $this->Calendar->calendar($year,$month,$records,'/healthy_weight_module/body_mass_index/view_records','/healthy_weight_module/body_mass_index/data_entry','$pass-rate','bmi','bmi'); 
?>
</div>
<div class="calendar-key col-md-4">
	<div class='panel panel-primary'>
		<div class="panel-heading">
			<h3 class="panel-title"><?php echo $this->Html->image('/img/Status-dialog-password-icon.png', array('alt' => "Key", 'escape' => false, 'class'=> 'img-thumbnail'));?>
&nbsp;Key to icons
			</h3>
		</div>
		<div class="panel-body">
			<ul class="list-group">
			<li class="list-group-item">
				<?php echo $this->Html->image('/img/Actions-window-new-icon.png', array('alt' => "New data record icon", 'escape' => false, 'class'=> 'small-icon'));?>
				No entry recorded for this day / week (click on the icon to add a record)
			</li>
			<li class="list-group-item">
				<?php echo $this->Html->image('/img/Actions-view-close-icon.png', array('alt' => "Recorded data", 'escape' => false, 'class'=> 'small-icon'));?>
				You've recorded an entry for this day / week - the figure in the box is your BMI calculation for that week.
			</li>
			</ul>
		<p>Any calendar dates which don't have an icon are days in the future (so you can't record anything for those days, yet!)
		</div>
	</div>
	<?php echo $this->Html->link(__('Return to the module dashboard >'), array('action' => 'module_dashboard'),array('class' => 'btn btn-success btn-md pull-right')); ?>
</div>
