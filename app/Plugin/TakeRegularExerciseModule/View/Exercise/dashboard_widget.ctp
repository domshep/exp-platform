<h4 class="graph-caption">My Exercise over recent weeks</h4>
		<p><?php 
				echo $this->Html->image(
					'/take_regular_exercise_module/exercise/minigraph', 
					array(
						'alt' => 'My Exercise over recent weeks',
	    				'url' => array('action' => 'view_records'),
						'class' => 'mini-graph'
					)
				);
			?>
		</p>
<div class="achievements">
	<h4><strong>My weekly achievements</strong></h4>
	<?php echo $this->requestAction(array('action'=> 'dashboard_achievements')); ?>
</div>
<p><?php echo $this->Html->link(__('Add weekly record'), array('action' => 'data_entry', date("Ymd")),array('class' => 'button')); ?></p>
