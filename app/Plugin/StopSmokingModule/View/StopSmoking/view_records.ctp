<?php
$this->extend('/Modules/module_template');
echo $this->Html->css('/stop_smoking_module/css/module.css');
?>

<h2>Your monthly records</h2>
<p>Use this screen to quickly review your records on a month-by-month basis.
<div class="calendar-holder">
<?php 
	echo $this->Calendar->calendar($year,$month,$records,'/stop_smoking_module/stop_smoking/view_records','/stop_smoking_module/stop_smoking/data_entry','1','green-simple','red-simple'); 
?>
</div>
<div class="calendar-key">
<h3><?php echo $this->Html->image('/img/Status-dialog-password-icon.png', array('alt' => "Key", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;'));?>
&nbsp;Key to icons</h3>
<?php echo $this->Html->image('/img/Actions-window-new-icon.png', array('alt' => "New data record icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;float:left;clear:both;'));?>
<p style="float:left;width:85%;margin-left:1em;">No entry recorded for this day (click on the icon to add a record)</p>
<?php echo $this->Html->image('/example_module/img/Emotes-face-smile-big-icon.png', array('alt' => "Smiley face icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;float:left;clear:both;'));?>
<p style="float:left;width:85%;margin-left:1em;">You were smoke free on this day! Click on the icon to see your records for the week.</p>
<?php echo $this->Html->image('/example_module/img/Emotes-face-sad-icon.png', array('alt' => "Sad face icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;float:left;clear:both'));?>
<p style="float:left;width:85%;margin-left:1em;">You've recorded an entry for this day, but you weren't smoke free.</p>
<p>Any calendar dates which don't have an icon are days in the future (so you can't record anything for those days, yet!)
</div>
<?php echo $this->Html->link(__('Return to the module dashboard >'), array('action' => 'module_dashboard'),array('class' => 'button', 'style' => 'float:right;clear:none;margin-top:1em;')); ?>