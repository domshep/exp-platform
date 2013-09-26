<h1 class="module-title"><?php echo $this->Html->image('/img/Apps-system-users-icon.png', array('alt' => "Admin Panel icon", 'escape' => false, 'class'=> 'img-thumbnail'));?>
Admin Panel - Users</h1>
<div class="row">
<div class="col-md-9 col-md-push-3">
	<table class="table">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('role'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th>No. of modules</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $viewuser): ?>
	<tr>
		<td><?php echo h($viewuser['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($viewuser['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($viewuser['User']['role']); ?>&nbsp;</td>
		<td><?php echo h($viewuser['User']['created']); ?>&nbsp;</td>
		<td><?php echo h(count($viewuser['ModuleUser'])); ?>&nbsp;</td>
		<td>
			<span class="btn-group btn-group-justified">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $viewuser['User']['id']), array('class' => 'btn btn-default')); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $viewuser['User']['id']), array('class' => 'btn btn-default')); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $viewuser['User']['id']), array('class' => 'btn btn-default'), __('Are you sure you want to delete user #%s?', $viewuser['User']['id'])); ?>
			</span>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<ul class="pagination">
	<?php
		echo $this->Paginator->prev(' < ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</ul>
</div>
<div class="col-md-3 col-md-pull-9">
	<div class="list-group">
		<?php echo $this->Html->link(__('New user'), array('action' => 'add'), array('class' => 'list-group-item')); ?>
		<?php echo $this->Html->link(__('Comms export'), array('action' => 'comms_export'), array('class' => 'list-group-item')); ?>
		<?php echo $this->Html->link(__('Full export'), array('action' => 'full_export'), array('class' => 'list-group-item')); ?>
		<?php echo $this->Html->link(__('Admin panel'), '/admin_panel', array('class' => 'list-group-item')); ?>
	</div>
</div>
</div>
