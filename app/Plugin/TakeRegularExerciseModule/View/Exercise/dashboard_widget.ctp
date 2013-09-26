<div class="thumbnail">
	<div class="caption">
		<h4>My exercise over recent weeks</h4>
	</div>
		<?php 
			echo $this->Html->image(
				'/take_regular_exercise_module/exercise/minigraph', 
				array(
					'alt' => 'My exercise over recent weeks',
    				'url' => array('action' => 'view_records'),
					'class' => 'img-responsive'
				)
			);
		?>
</div>
<div class="achievements">
	<h3>My weekly achievements</h3>
	<?php echo $this->requestAction(array('action'=> 'dashboard_achievements')); ?>
</div>
<?php echo $this->Html->link(__('Add weekly record <span class="glyphicon glyphicon-plus"></span>'), array('action' => 'data_entry', date("Ymd")),array('class' => 'btn btn-success btn-md pull-right', 'escape' => false)); ?>
				