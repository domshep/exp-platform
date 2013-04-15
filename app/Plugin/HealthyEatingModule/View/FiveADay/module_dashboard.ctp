<?php
$this->extend('/Modules/module_template');
echo $this->Html->css('/HealthyEatingModule/css/module.css');
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
		<h4 class="graph-caption">My 5-a-day over recent weeks</h4>
		<p><?php 
				echo $this->Html->image(
					'/healthy_eating_module/five_a_day/minigraph', 
					array(
						'alt' => 'My 5-a-day over recent weeks',
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
		<?php echo $this->Calendar->calendar($year,$month,$records,'/healthy_eating_module/five_a_day/module_dashboard','/healthy_eating_module/five_a_day/data_entry','5','green5','red5'); ?>
		<p>
		<?php echo $this->Html->link(__('Add weekly record'), array('action' => 'data_entry', date("Ymd")),array('class' => 'button', 'style' => 'float:left;')); ?>
		<?php echo $this->Html->link(__('View my monthly records'), array('action' => 'view_records'),array('class' => 'button', 'style' => 'float:right;clear:none;')); ?></p>
	</div>
	<div class="module">
		<h3><?php echo $this->Html->image('/img/Actions-rating-icon.png', array('alt' => "Star icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;', 'url'=> array('action' => 'view_records')));
						?>&nbsp;<strong><?php echo $this->Html->link(__('My 5-a-day achievements'), array('action' => 'view_records')); ?></strong>
		</h3>
		<?php echo $this->requestAction(array('action'=> 'dashboard_achievements')); ?>
	</div>
	</div>
</div>