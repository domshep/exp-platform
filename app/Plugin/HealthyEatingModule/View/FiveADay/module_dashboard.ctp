<?php $this->extend('/Modules/module_template');?>

<h2><?php  echo $message; ?></h2>
<p><?php echo $this->Html->link(__('Add weekly record'), array('action' => 'data_entry'),array('class' => 'button')); ?></p>
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
		<table class="calendar" cellspacing="0">
			<caption>March 2013</caption>
			<tr>
				<th>M</th>
				<th>T</th>
				<th>W</th>
				<th>T</th>
				<th>F</th>
				<th>S</th>
				<th>S</th>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>01</td>
				<td class="red"><?php echo $this->Html->link(__('02'), array('action' => 'view_records' . "/2013-03-02")); ?></td>
				<td>03</td>
			</tr>
			<tr>
				<td>04</td>
				<td class="red"><?php echo $this->Html->link(__('05'), array('action' => 'view_records' . "/2013-03-05")); ?></td>
				<td class="red"><?php echo $this->Html->link(__('06'), array('action' => 'view_records' . "/2013-03-06")); ?></td>
				<td>07</td>
				<td>08</td>
				<td>09</td>
				<td class="red"><?php echo $this->Html->link(__('10'), array('action' => 'view_records' . "/2013-03-10")); ?></td>
			</tr>
			<tr>
				<td class="red"><?php echo $this->Html->link(__('11'), array('action' => 'view_records' . "/2013-03-11")); ?></td>
				<td>12</td>
				<td class="red"><?php echo $this->Html->link(__('13'), array('action' => 'view_records' . "/2013-03-13")); ?></td>
				<td>14</td>
				<td>15</td>
				<td>16</td>
				<td>17</td>
			</tr>
			<tr>
				<td>18</td>
				<td>19</td>
				<td>20</td>
				<td class="red"><?php echo $this->Html->link(__('21'), array('action' => 'view_records' . "/2013-03-21")); ?></td>
				<td class="red"><?php echo $this->Html->link(__('22'), array('action' => 'view_records' . "/2013-03-22")); ?></td>
				<td>23</td>
				<td>24</td>
			</tr>
			<tr>
				<td>25</td>
				<td>26</td>
				<td class="red"><?php echo $this->Html->link(__('27'), array('action' => 'view_records' . "/2013-03-27")); ?></td>
				<td>28</td>
				<td>29</td>
				<td>30</td>
				<td>31</td>
			</tr>
		</table>
		<p><?php echo $this->Html->link(__('View My Weekly Stats'), array('action' => 'view_records'),array('class' => 'button')); ?></p>
	</div>
	<div class="module">
		<h4><strong>News Feed</strong></h4>
		<?php echo $this->requestAction(array('action'=> 'dashboard_news')); ?>					
	</div>
	<div class="module">
		<h4><strong>My Weekly Achievements</strong></h4>
		<?php echo $this->requestAction(array('action'=> 'dashboard_achievements')); ?>
	</div>
</div>