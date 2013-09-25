<?php
$this->extend('/Modules/module_template');
echo $this->Html->css('/HealthyEatingModule/css/module.css', array('inline'=> false));
?>

<h2>Your monthly records</h2>
<p class="lead">Use this screen to quickly review your records on a month-by-month basis.
<div class="calendar-holder col-md-8">
<?php 
	echo $this->Calendar->calendar($year,$month,$records,'/healthy_eating_module/five_a_day/view_records','/healthy_eating_module/five_a_day/data_entry','5','green5','red5'); 
?>
</div>
<div class="calendar-key col-md-4">
	<div class='panel panel-primary'>
		<div class="panel-heading">
			<h3 class="panel-title"><?php echo $this->Html->image('/img/Status-dialog-password-icon.png', array('alt' => "Key", 'escape' => false, 'class'=> 'img-thumbnail', 'style'=>'vertical-align:middle;'));?>
&nbsp;Key to icons
			</h3>
		</div>
		<div class="panel-body">
			<ul class="list-group">
			<li class="list-group-item">
				<?php echo $this->Html->image('/img/Actions-window-new-icon.png', array('alt' => "New data record icon", 'escape' => false, 'class'=> 'small-icon'));?>
				No entry recorded for this day (click on the icon to add a record)
			</li>
			<li class="list-group-item">
				<?php echo $this->Html->image('/healthy_eating_module/img/five_a_day/apple-full.png', array('alt' => "Apple icon", 'escape' => false, 'class'=> 'small-icon'));?>
				You've reached the target of 5-a-day on this day! The number inside the apple records exactly how many pieces of fruit and veg you recorded.
			</li>
			<li class="list-group-item">
				<?php echo $this->Html->image('/healthy_eating_module/img/five_a_day/apple-core.png', array('alt' => "Apple core icon", 'escape' => false, 'class'=> 'small-icon'));?>
				You've recorded an entry for this day, but you didn't hit the target of 5-a-day.
			</li>
			</ul>
			<p>Any calendar dates which don't have an icon are days in the future (so you can't record anything for those days, yet!)
		</div>
	</div>
	<?php echo $this->Html->link(__('Return to the module dashboard >'), array('action' => 'module_dashboard'),array('class' => 'btn btn-success btn-md pull-right')); ?>
</div>
