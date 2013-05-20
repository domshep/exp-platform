<div class="module-title">
	<h1><?php echo $this->Html->image('/img/Mimetypes-message-news-icon.png', array('alt' => "News icon", 'escape' => false, 'class'=> 'icon'));?>
Admin Panel - News</h1>
</div>
<div class="newsadmin index">
	<table>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('headline'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($news as $article): ?>
	<tr>
		<td><?php echo h($article['News']['id']); ?>&nbsp;</td>
		<td><?php echo h($article['News']['headline']); ?>&nbsp;</td>
		<td><?php echo h($article['News']['created']); ?>&nbsp;</td>
		<td><?php echo h($article['News']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $article['News']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $article['News']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $article['News']['id']), null, __('Are you sure you want to delete # %s?', $article['News']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Add news'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('Admin panel'), '/admin_panel'); ?></li>
	</ul>
</div>
