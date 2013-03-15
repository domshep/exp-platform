<h2 class="bigred"><?php  echo $module_name; ?> - Data Entry</h2>
<div class="view">
<h2><?php echo $message; ?></h2>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('My Dashboard'), array('controller' => 'users', 'action' => 'dashboard', 'plugin' => null)); ?> </li>
		<li><?php echo $this->Html->link(__('Module Dashboard'), array('action' => 'module_dashboard')); ?></li>
	</ul>
</div>
<div class="main">
	<h3><?php echo __('Week {X}:') . gmdate("d/m/Y"); ?></h3>
	<p><?php echo __('How many portions of different fruit and vegetables did you eat this week? Enter 0 if you haven&pos;t eaten any portions of fruit or vegetables that day.');</p>
	
</div>
