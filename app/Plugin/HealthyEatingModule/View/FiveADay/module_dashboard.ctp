<?php
$this->extend('/Modules/module_template');
echo $this->Html->css('/HealthyEatingModule/css/module.css');
?>
<div class="modulesgrid">
<div class="news">
			<h3>News and updates</h3>
			<?php 
				$newswidget = $this->requestAction(array('action'=> 'dashboard_news')); 
				if ($newswidget != "") echo $newswidget;
			?>
</div>

<div class="modules">
	<div class="module">
		<h3><?php echo $this->Html->image('/img/Actions-office-chart-pie-icon.png', array('alt' => "Piechart icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;'));
						?>&nbsp;<strong>Your progress over time</strong>
		<a href="#graph" class="info" title="More Information">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'Information')
				);
			?>
		</a>
		</h3>
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
		<h3><?php echo $this->Html->image('/img/Actions-view-calendar-icon.png', array('alt' => "Calendar icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;'));
						?>&nbsp;<strong>Your month at a glance:</strong>
		<a href="#cal" class="info" title="About the Calendar">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'Information')
				);
			?>
		</a></h3>
		<?php echo $this->Calendar->calendar($year,$month,$records, '/healthy_eating_module/five_a_day/module_dashboard','/healthy_eating_module/five_a_day/data_entry','5','green5','red5'); ?>
		<p>
		<?php echo $this->Html->link(__('Add weekly record'), array('action' => 'data_entry', date("Ymd")),array('class' => 'button', 'style' => 'float:left;')); ?>
		<?php echo $this->Html->link(__('View your monthly records'), array('action' => 'view_records'),array('class' => 'button', 'style' => 'float:right;clear:none;')); ?></p>
	</div>
	<div class="module">
		<h3><?php echo $this->Html->image('/img/Actions-rating-icon.png', array('alt' => "Star icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;'));
						?>&nbsp;<strong>Your 5-a-day achievements</strong>
		<a href="#achieve" class="info" title="Your Achievements">
			<?php 
				echo $this->Html->image(
					'info-icon.png', 
					array('alt' => 'Information')
				);
			?>
		</a></h3>
		<?php echo $this->requestAction(array('action'=> 'dashboard_achievements')); ?>
	</div>
	</div>
</div>

<script type="text/javascript">
	<!--
		$(document).ready(function(){
			//Examples of how to assign the ColorBox event to in-line elements
			$(".info").colorbox({inline:true, width:"50%"});
		});
	-->
</script>

<!-- This contains the hidden content for inline calls -->
<div style='display:none'>
	<div id='graph' style='padding:10px; background:#fff;'>
		<h3>Information:</h3>
		<p>This graph is just a dummy at this stage, but it will chart your progress as you proceed.</p>
	</div>
	<div id='cal' style='padding:10px; background:#fff;'>
		<h3>Information:</h3>
		<p>To update your information simply click on the add buttons. Successful entries are marked with a full red apples and those days where you didn't quite meet the mark show an apple core.</p>
	</div>
	<div id='achieve' style='padding:10px; background:#fff;'>
		<h3>Information:</h3>
		<p>All stats are based on the last full week you completed. This week's entries won't show until next Monday.</p>
	</div>
</div>