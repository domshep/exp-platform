<div class="module-title">
	<h1><?php echo $this->Html->image('/img/Apps-system-users-icon.png', array('alt' => "Admin Panel icon", 'escape' => false, 'class'=> 'icon'));?>
Admin Panel - Users</h1>
	</div>
<div class="users index">
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('role'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th>No. of modules</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($users as $viewuser): ?>
	<tr>
		<td><?php echo h($viewuser['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($viewuser['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($viewuser['User']['role']); ?>&nbsp;</td>
		<td><?php echo h($viewuser['User']['created']); ?>&nbsp;</td>
		<td><?php echo h(count($viewuser['ModuleUser'])); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $viewuser['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $viewuser['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $viewuser['User']['id']), null, __('Are you sure you want to delete user #%s?', $viewuser['User']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New user'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Admin panel'), '/admin_panel'); ?></li>
	</ul>
</div>
