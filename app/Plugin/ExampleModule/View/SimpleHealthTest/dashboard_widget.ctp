<h4 class="graph-caption">My &lsquo;simple health&rsquo; scores over recent weeks</h4>
		<p><?php 
				echo $this->Html->image(
					'/example_module/simple_health_test/minigraph', 
					array(
						'alt' => 'My &lsquo;simple health&rsquo; scores over recent weeks',
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
