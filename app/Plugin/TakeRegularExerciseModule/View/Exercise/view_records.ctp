<?php
$this->extend('/Modules/module_template');
echo $this->Html->css('/take_regular_exercise_module/css/module.css');
?>

<h2>Your monthly records</h2>
<p>Use this screen to quickly review your records on a month-by-month basis.
<div class="calendar-holder">
<?php 
	echo $this->Calendar->calendar($year,$month,$records,'/take_regular_exercise_module/exercise/view_records','/take_regular_exercise_module/exercise/data_entry','21','green-exercise','red-exercise','1','amber-exercise'); 
?>
</div>
<div class="calendar-key">
<h3><?php echo $this->Html->image('/img/Status-dialog-password-icon.png', array('alt' => "Key", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;'));?>
&nbsp;Key to icons</h3>
<?php echo $this->Html->image('/img/Actions-window-new-icon.png', array('alt' => "New data record icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;float:left;clear:both;'));?>
<p style="float:left;width:85%;margin-left:1em;">No entry recorded for this day (click on the icon to add a record)</p>
<?php echo $this->Html->image('/take_regular_exercise_module/img/Emotes-face-smile-big-icon.png', array('alt' => "Big Smiley face icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;float:left;clear:both;'));?>
<p style="float:left;width:85%;margin-left:1em;">You've reached at least 21 minutes of exercise on this day, which will help you towards your target of 150 for the week! If you hover your mouse over the icon, you'll see exactly how many minutes you recorded.</p>
<?php echo $this->Html->image('/take_regular_exercise_module/img/Emotes-face-smile-icon.png', array('alt' => "Smiley face icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;float:left;clear:both;'));?>
<p style="float:left;width:85%;margin-left:1em;">You've done some exercise today but not the 21 minutes of exercise on this day you need to help you reach your target of 150 for the week! If you hover your mouse over the icon, you'll see exactly how many minutes you recorded.</p>
<?php echo $this->Html->image('/take_regular_exercise_module/img/Emotes-face-sad-icon.png', array('alt' => "Sad face icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;float:left;clear:both'));?>
<p style="float:left;width:85%;margin-left:1em;">You've recorded an entry for this day, but you didn't hit the target of at least 21 minutes.</p>
<p>Any calendar dates which don't have an icon are days in the future (so you can't record anything for those days, yet!)
</div>
<?php echo $this->Html->link(__('Return to the module dashboard >'), array('action' => 'module_dashboard'),array('class' => 'button', 'style' => 'float:right;clear:none;margin-top:1em;')); ?>