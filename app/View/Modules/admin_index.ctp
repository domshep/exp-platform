<div class="module-title">
	<h1><?php echo $this->Html->image('/img/Actions-view-list-icons-icon.png', array('alt' => "Admin Panel - Modules icon", 'escape' => false, 'class'=> 'icon'));?>
Admin Panel - Modules</h1>
</div>
<div class="modules index">
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('version'); ?></th>
			<th><?php echo $this->Paginator->sort('type'); ?></th>
			<th><?php echo $this->Paginator->sort('active'); ?></th>
			<th><?php echo __('No. of users'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($modules as $module): ?>
	<tr>
		<td><?php echo h($module['Module']['id']); ?>&nbsp;</td>
		<td><?php echo $module['Module']['name']; ?>&nbsp;</td>
		<td><?php echo h($module['Module']['version']); ?>&nbsp;</td>
		<td><?php echo h($module['Module']['type']); ?>&nbsp;</td>
		<td><?php if($module['Module']['active']) {
				echo 'Y';
		}else {
				echo 'N';
		}?>&nbsp;</td>
		<td>
			<?php if ($module['Module']['type']!="dashboard") {
				echo "N/A";
			} else {
				echo count($module['ModuleUser']); 
			}?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Health data'), '/admin_panel/health_data/'. $module['Module']['id']); ?>
			<?php
			if($module['Module']['active']) {
				echo $this->Form->postLink(__('De-activate'), array('action' => 'activate', $module['Module']['id'], 0), null, __('Are you sure you want to de-activate module # %s?', $module['Module']['id']));
			} else {
				echo $this->Html->link(__('Activate'), array('action' => 'activate', $module['Module']['id'], 1));
			}?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $module['Module']['id']), null, __('Are you sure you want to delete # %s?', $module['Module']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Module'), array('action' => 'add')); ?></li>
	</ul>
</div>
