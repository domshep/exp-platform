<?php $this->extend('/Modules/module_template');?>

<h2><?php  echo $message; ?></h2>
<p><?php echo $this->Html->link(__('Add weekly record'), array('action' => 'data_entry', date("Ymd")),array('class' => 'button')); ?></p>

<div class="modulesgrid">
<div class="news">
			<h3>News and updates</h3>
			<?php 
				$newswidget = $this->requestAction(array('action'=> 'dashboard_news')); 
				if ($newswidget != "") echo $newswidget;
			?>
</div>
<div class="modules">
	<div class="module" style="text-align:center;">
		<h4><strong>Your Progress to Date</strong></h4>
		<p>&nbsp;<br/>
			<?php 
				echo $this->Html->image(
					'graph-dummy.jpg', 
					array('alt' => '5 A Day Dummy Graph',
    				'url' => array('action' => 'view_records')
					)
				);
			?>
		</p>
		<p><?php echo $this->Html->link(__('View My Records'), array('action' => 'view_records'),array('class' => 'button')); ?></p>
	</div>
	<div class="module">
		<h4><strong>So far this month:</strong></h4>
		<?php echo $this->Calendar->calendar($year,$month,$records, '/healthy_eating_module/five_a_day/module_dashboard','/healthy_eating_module/five_a_day/data_entry','5'); ?>
		<p><?php echo $this->Html->link(__('View My Weekly Stats'), array('action' => 'view_records'),array('class' => 'button')); ?></p>
	</div>
	<div class="module">
		<h4><strong>My Weekly Achievements</strong></h4>
		<?php echo $this->requestAction(array('action'=> 'dashboard_achievements')); ?>
	</div>
	</div>
</div>