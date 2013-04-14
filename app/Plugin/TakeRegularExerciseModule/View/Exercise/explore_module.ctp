<?php $this->extend('/Modules/module_template');?>
<h2>How doing 150 minutes exercise a week can improve your health</h2>
<p>[TO DO: Add explore module text...]</p>
<?php
	if($added_to_dashboard) {
		echo "<p>This module is already on your dashboard.</p>";
	} else {
		echo $this->Html->link(__('Add this module to your dashboard'), array('action' => 'add_module'), array('class' => 'button action', 	'target' => '_self'));
	}
?>