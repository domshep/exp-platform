<div class="module-title">
	<h1><?php echo $this->Html->image('/img/Actions-office-chart-pie-icon.png', array('alt' => "Admin Panel - Health Data icon", 'escape' => false, 'class'=> 'icon'));?>
Admin Panel - Module Data - <?php echo $module['Module']['name'];?></h1>
</div>
<?php
	echo $this->requestAction('/admin/'.$module['Module']['base_url'].'/module_data');
?>