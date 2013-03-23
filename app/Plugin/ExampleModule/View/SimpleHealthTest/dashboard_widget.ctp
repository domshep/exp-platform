<p><?php 
				echo $this->Html->image(
					'/example_module/simple_health_test/minigraph', 
					array('alt' => 'Your simple health scores over the last 3 months',
    				'url' => array('action' => 'view_records')
					)
				);
			?></p>
<div class="achievements">
	<h4><strong>Your weekly achievements</strong></h4>
	<?php echo $this->requestAction(array('action'=> 'dashboard_achievements')); ?>
</div>
<p><?php echo $this->Html->link(__('Add weekly record'), array('action' => 'data_entry', date("Ymd")),array('class' => 'button')); ?></p>
