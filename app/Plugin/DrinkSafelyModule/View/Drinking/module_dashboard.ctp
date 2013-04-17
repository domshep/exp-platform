<?php
$this->extend('/Modules/module_template');
echo $this->Html->css('/drink_safely_module/css/module.css');
?>
<div class="modulesgrid">

<?php
// News and updates widget - only display if there is news or updates!
$newswidget = $this->requestAction(array('action'=> 'dashboard_news')); 
if ($newswidget != "") echo $newswidget;
?>

<div class="modules">
	<div class="module">
		<h3><?php echo $this->Html->image('/img/Actions-office-chart-pie-icon.png', array('alt' => "Piechart icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;', 'url'=> array('action' => 'view_records')));
						?>&nbsp;<strong><?php echo $this->Html->link(__('My progress over time'), array('action' => 'view_records')); ?></strong>
		</h3>
		<h4 class="graph-caption">My Units over recent weeks</h4>
		<p><?php 
				echo $this->Html->image(
					'/take_regular_exercise_module/exercise/minigraph', 
					array(
						'alt' => 'My Units over recent weeks',
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
		<?php 
			if ($gender == "F") $safelimit = 4;
			else $safelimit = 5; 
			echo $this->Calendar->calendar($year,$month,$records,'/drink_safely_module/drinking/module_dashboard','/drink_safely_module/drinking/data_entry',$safelimit,'red','green'); ?>
		<p>
		<?php echo $this->Html->link(__('Add weekly record'), array('action' => 'data_entry', date("Ymd")),array('class' => 'button', 'style' => 'float:left;')); ?>
		<?php echo $this->Html->link(__('View my monthly records'), array('action' => 'view_records'),array('class' => 'button', 'style' => 'float:right;clear:none;')); ?></p>
	</div>
	<div class="module">
		<h3><?php echo $this->Html->image('/img/Actions-rating-icon.png', array('alt' => "Star icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;', 'url'=> array('action' => 'view_records')));
						?>&nbsp;<strong><?php echo $this->Html->link(__('My Safe Drinking achievements'), array('action' => 'view_records')); ?></strong>
		</h3>
		<?php echo $this->requestAction(array('action'=> 'dashboard_achievements')); ?>
	</div>
	</div>
</div>