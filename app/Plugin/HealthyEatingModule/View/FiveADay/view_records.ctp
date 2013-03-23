<?php
$this->extend('/Modules/module_template');
echo $this->Html->css('/HealthyEatingModule/css/module.css');
?>

<h2>Your monthly records</h2>
<p>Use this screen to quickly review your records on a month-by-month basis.
<div class="calendar-holder">
<?php 
	echo $this->Calendar->calendar($year,$month,$records, '/healthy_eating_module/five_a_day/view_records','/healthy_eating_module/five_a_day/data_entry','5','green5','red5'); 
?>
</div>
<div class="calendar-key">
<h3><?php echo $this->Html->image('/img/Status-dialog-password-icon.png', array('alt' => "Key", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;'));?>
&nbsp;Key to icons</h3>
<?php echo $this->Html->image('/img/Actions-window-new-icon.png', array('alt' => "New data record icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;float:left;clear:both;'));?>
<p style="float:left;width:85%;margin-left:1em;">No entry recorded for this day (click on the icon to add a record)</p>
<?php echo $this->Html->image('/healthy_eating_module/img/five_a_day/apple-full.png', array('alt' => "Apple icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;float:left;clear:both;'));?>
<p style="float:left;width:85%;margin-left:1em;">You've reached the target of 5-a-day on this day! The number inside the apple records exactly how many pieces of fruit and veg you recorded.</p>
<?php echo $this->Html->image('/healthy_eating_module/img/five_a_day/apple-core.png', array('alt' => "Apple core icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;float:left;clear:both'));?>
<p style="float:left;width:85%;margin-left:1em;">You've recorded an entry for this day, but you didn't hit the target of 5-a-day.</p>
<p>Any calendar dates which don't have an icon are days in the future (so you can't record anything for those days, yet!)
</div>
<?php echo $this->Html->link(__('Return to the module dashboard >'), array('action' => 'module_dashboard'),array('class' => 'button', 'style' => 'float:right;clear:none;margin-top:1em;')); ?>