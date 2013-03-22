<?php $this->extend('/Modules/module_template');?>

<h2><?php echo $message; ?></h2>
<p><?php echo $this->Html->link(__('Add weekly record'), array('action' => 'data_entry', date("Ymd")),array('class' => 'button')); ?></p>
<?php 
	echo $this->Calendar->calendar($year,$month,$records, 		 '/healthy_eating_module/five_a_day/view_records','/healthy_eating_module/five_a_day/data_entry','5','green5','red5'); 
?>
		<p><?php echo $this->Html->link(__('Module Dashboard'), array('action' => 'module_dashboard'),array('class' => 'button')); ?></p>
</div>