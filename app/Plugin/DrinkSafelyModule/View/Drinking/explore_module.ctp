<?php $this->extend('/Modules/module_template');?>
<h2>Drinking Safely</h2>
<p>[TO DO: Add explore module text...]</p>
<?php
	if($added_to_dashboard) {
		echo "<p>This module is already on your dashboard.</p>";
	} else {
		echo $this->Html->link(__('Add this module to your dashboard'), array('action' => 'add_module'), array('class' => 'button action', 	'target' => '_self'));
	}
?>