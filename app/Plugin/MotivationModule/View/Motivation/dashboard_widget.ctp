<!--<p><?php 
			/* echo $this->Html->image(
					'/motivation_module/motivation/minigraph', 
					array('alt' => 'Your simple health scores over the last 3 months',
    				'url' => array('action' => 'view_records')
					)
				); */
			?></p>-->
<div class="why">
	<h4><strong>Why am I doing this?</strong></h4>
	[INSERT THE REASON HERE...]
	<?php // echo $this->requestAction(array('action'=> 'dashboard_achievements')); ?>
</div>
<p><?php echo $this->Html->link(__('Edit my reason'), array('action' => 'screener', date("Ymd")),array('class' => 'button')); ?></p>
