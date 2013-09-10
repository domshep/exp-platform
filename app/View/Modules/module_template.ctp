<h1 class="module-title"><?php echo $this->Html->image($module_icon_url, array('alt' => "&lsquo;".$module_name."&rsquo; icon", 'escape' => false, 'class'=> 'img-thumbnail'));?>
<?php echo $module_name; ?></h1>
<?php echo $this->fetch('content'); ?>