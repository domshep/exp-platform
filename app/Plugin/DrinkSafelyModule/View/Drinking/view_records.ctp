<?php
$this->extend('/Modules/module_template');
echo $this->Html->css('/drink_safely_module/css/module.css', array('inline'=> false));
?>

<h2>Your monthly records</h2>
<p class="lead">Use this screen to quickly review your records on a month-by-month basis.</p>
<div class="calendar-holder col-md-8">
<?php 
	if ($gender == "F"){ 
		$safelimit = 3; // over which is considered excess drinking
		$excesslimit = 6; // over which is considered binge drinking
	}
	else {
		$safelimit = 4; // over which is considered excess drinking
		$excesslimit = 8; // over which is considered binge drinking
	}
	
	echo $this->Calendar->calendar($year,$month,$records,'/drink_safely_module/drinking/view_records','/drink_safely_module/drinking/data_entry',$excesslimit,'badbeer','goodbeer',$safelimit,'excessbeer'); 
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
					<?php echo $this->Html->image('/drink_safely_module/img/drinking/beer-good-icon.png', array('alt' => "Good Beer", 'escape' => false, 'class'=> 'small-icon'));?>
					You've consumed within the safe limit of <?php echo $safelimit ?> units on this day!  If you hover your mouse over the icon, you'll see exactly how many units of alcohol you recorded.
				</li>
				<li class="list-group-item">
					<?php echo $this->Html->image('/drink_safely_module/img/drinking/beer-icon.png', array('alt' => "Excess Beer", 'escape' => false, 'class'=> 'small-icon'));?>
					You've consumed more than the safe limit of <?php echo $safelimit ?> units but not what would be considered binge drinking (<?php echo $excesslimit; ?> units) on this day!  If you hover your mouse over the icon, you'll see exactly how many units of alcohol you recorded.
				</li>
				<li class="list-group-item">
					<?php echo $this->Html->image('/drink_safely_module/img/drinking/beer-battered.png', array('alt' => "Bad Beer", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;float:left;clear:both'));?>
					You've recorded an entry for this day, but you consumed more than the binge drinking limit of <?php echo $excesslimit; ?> units.
				</li>
			</ul>
			<p>Any calendar dates which don't have an icon are days in the future (so you can't record anything for those days, yet!)
		</div>
	</div>
	<?php echo $this->Html->link(__('Return to the module dashboard >'), array('action' => 'module_dashboard'),array('class' => 'btn btn-success btn-md pull-right bot-buffer')); ?>
</div>
