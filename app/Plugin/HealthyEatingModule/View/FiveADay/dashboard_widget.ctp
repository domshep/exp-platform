<p><?php  echo $message; ?></p>
<div class="achievements">
	<h4><strong>My Weekly Achievements</strong></h4>
	<?php echo $this->requestAction(array('action'=> 'dashboard_achievements')); ?>
</div>