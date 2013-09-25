<?php
$this->extend('/Modules/module_template');
echo $this->Html->css('/stop_smoking_module/css/module.css', array('inline'=> false));
?>

<h2>Your monthly records</h2>
<p class="lead">Use this screen to quickly review your records on a month-by-month basis.
<div class="calendar-holder col-md-8">
<?php 
	echo $this->Calendar->calendar($year,$month,$records,'/stop_smoking_module/stop_smoking/view_records','/stop_smoking_module/stop_smoking/data_entry','1','green-simple','red-simple'); 
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
				<?php echo $this->Html->image('/stop_smoking_module/img/smiley-face.png', array('alt' => "Smiley face icon", 'escape' => false, 'class'=> 'small-icon'));?>
				You were smoke free on this day! Click on the icon to see your records for the week.
			</li>
			<li class="list-group-item">
				<?php echo $this->Html->image('/stop_smoking_module/img/smoking-face.png', array('alt' => "Smoking face icon", 'escape' => false, 'class'=> 'small-icon'));?>
				You've recorded an entry for this day, but you weren't smoke free.
			</li>
			</ul>
			<p>Any calendar dates which don't have an icon are days in the future (so you can't record anything for those days, yet!)
		</div>
	</div>
	<?php echo $this->Html->link(__('Return to the module dashboard >'), array('action' => 'module_dashboard'),array('class' => 'btn btn-success btn-md pull-right')); ?>
</div>
