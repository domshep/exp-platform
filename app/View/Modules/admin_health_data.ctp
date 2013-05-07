<div class="module-title">
	<h1><?php echo $this->Html->image('/img/Categories-applications-system-icon.png', array('alt' => "Admin Panel - Health Data icon", 'escape' => false, 'class'=> 'icon'));?>
Admin Panel - Health Data</h1>
	</div>
<div class="modules index">
	<h2><?php echo __('Modules'); ?></h2>
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo __('No. of users'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($modules as $module): ?>
	<tr>
		<td><?php echo h($module['Module']['id']); ?>&nbsp;</td>
		<td><?php echo $module['Module']['name']; ?>&nbsp;</td>
		<td><?php echo h($module['Module']['type']); ?>&nbsp;</td>
		<td>
			<?php if ($module['Module']['type']!="dashboard") {
				echo "N/A";
			} else {
				echo count($module['ModuleUser']); 
			}?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View module data'), '/admin_panel/module_data/'. $module['Module']['id']); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Admin panel'), '/admin_panel'); ?></li>
	</ul>
</div>
