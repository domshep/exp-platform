<?php
$this->extend('/Modules/module_template');
echo $this->Html->css('/ExampleModule/css/module.css', array('inline'=> false));
?>

<h2>Your monthly records</h2>
<p class="lead">Use this screen to quickly review your records on a month-by-month basis.
<div class="calendar-holder col-md-8">
<?php 
	echo $this->Calendar->calendar($year,$month,$records,'/example_module/simple_health_test/view_records','/example_module/simple_health_test/data_entry','7','green-simple','red-simple'); 
?>
</div>
<div class="calendar-key col-md-4">
	<div class='panel panel-primary'>
		<div class="panel-heading">
			<h3 class="panel-title">
			<?php echo $this->Html->image('/img/Status-dialog-password-icon.png', array('alt' => "Key", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;'));?>
&nbsp;Key to icons
			</h3>
		</div>
		<div class="panel-body">
			<ul class="list-group">
			<li class="list-group-item"><?php echo $this->Html->image('/img/Actions-window-new-icon.png', array('alt' => "New data record icon", 'escape' => false, 'class'=> 'small-icon'));?>
			No entry recorded for this day (click on the icon to add a record)</li>
			<li class="list-group-item"><?php echo $this->Html->image('/example_module/img/Emotes-face-smile-big-icon.png', array('alt' => "Smiley face icon", 'escape' => false, 'class'=> 'small-icon'));?>
			You scored your health as 7/10 or higher on this day! Click on the icon to see your records for the week.</li>
			<li class="list-group-item"><?php echo $this->Html->image('/example_module/img/Emotes-face-sad-icon.png', array('alt' => "Sad face icon", 'escape' => false, 'class'=> 'small-icon'));?>
			You've recorded an entry for this day, but you didn't hit the target of at least 7/10 for your health score.</li>
			</ul>
			<p>Any calendar dates which don't have an icon are days in the future (so you can't record anything for those days, yet!)
		</div>
	</div>
	<?php echo $this->Html->link(__('Return to the module dashboard >'), array('action' => 'module_dashboard'),array('class' => 'btn btn-success btn-md pull-right')); ?>
</div>