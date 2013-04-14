<?php
$this->extend('/Modules/module_template');
echo $this->Html->css('/take_regular_exercise/css/module.css');
?>
<div class="modulesgrid">
<div class="news">
			<h3>
			<?php 
				echo $this->Html->link(__('News and Updates'), '/news/index', array('target' => '_self')); 
			?></h3>
			<?php 
				$newswidget = $this->requestAction(array('action'=> 'dashboard_news')); 
				if ($newswidget != "") echo $newswidget;
			?>
</div>

<div class="modules">
	<div class="module">
		<h3><?php echo $this->Html->image('/img/Actions-office-chart-pie-icon.png', array('alt' => "Piechart icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;', 'url'=> array('action' => 'view_records')));
						?>&nbsp;<strong><?php echo $this->Html->link(__('My progress over time'), array('action' => 'view_records')); ?></strong>
		</h3>
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
		<p><?php echo $this->Html->link(__('View my monthly records'), array('action' => 'view_records'),array('class' => 'button')); ?></p>
	</div>
	<div class="module">
		<h3><?php echo $this->Html->image('/img/Actions-view-calendar-icon.png', array('alt' => "Calendar icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;', 'url'=> array('action' => 'view_records')));
						?>&nbsp;<strong><?php echo $this->Html->link(__('My month at a glance'), array('action' => 'view_records')); ?></strong>
		</h3>
		<?php echo $this->Calendar->calendar($year,$month,$records,'/take_regular_exercise_module/exercise/module_dashboard','/take_regular_exercise_module/exercise/data_entry','21','green','red'); ?>
		<p>
		<?php echo $this->Html->link(__('Add weekly record'), array('action' => 'data_entry', date("Ymd")),array('class' => 'button', 'style' => 'float:left;')); ?>
		<?php echo $this->Html->link(__('View my monthly records'), array('action' => 'view_records'),array('class' => 'button', 'style' => 'float:right;clear:none;')); ?></p>
	</div>
	<div class="module">
		<h3><?php echo $this->Html->image('/img/Actions-rating-icon.png', array('alt' => "Star icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;', 'url'=> array('action' => 'view_records')));
						?>&nbsp;<strong><?php echo $this->Html->link(__('My Exercise achievements'), array('action' => 'view_records')); ?></strong>
		</h3>
		<?php echo $this->requestAction(array('action'=> 'dashboard_achievements')); ?>
	</div>
	</div>
</div>