<?php $this->extend('/Modules/module_template');?>
<h2><?php  echo $message; ?></h2>
<?php
if($added_to_dashboard) {
	echo $this->Html->link(__('<span class="glyphicon glyphicon-th-large"></span> View the module dashboard'), array('action' => 'module_dashboard'), array('class' => 'btn btn-success btn-md bot-buffer pull-right', 'target' => '_self', 'escape' => false));
} else {
	echo $this->Html->link(__('<span class="glyphicon glyphicon-ok-circle"></span> Add this module to your dashboard'), array('action' => 'add_module'), array('class' => 'btn btn-success btn-md bot-buffer pull-right', 'target' => '_self', 'escape' => false));
}?>