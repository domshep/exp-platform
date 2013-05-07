<div class="modulesgrid">
	<div class="module-title">
	<h1><?php echo $this->Html->image('/img/Categories-applications-system-icon.png', array('alt' => "Admin Panel icon", 'escape' => false, 'class'=> 'icon'));?>
Admin Panel - Module Data - <?php echo $module['Module']['name'];?></h1>
	</div>
	<?php
	echo $this->requestAction('/admin/'.$module['Module']['base_url'].'/module_data');
	?>
</div>
<p style="clear:both;">&nbsp;</p>