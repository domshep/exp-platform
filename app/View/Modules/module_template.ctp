<div class="module-title">
<h1><?php echo $this->Html->image($module_icon_url, array('alt' => "&lsquo;".$module_name."&rsquo; icon", 'escape' => false, 'class'=> 'icon'));?>
<?php echo $module_name; ?></h1>
</div>
<div class="module-content">
<?php echo $this->fetch('content'); ?>
</div>