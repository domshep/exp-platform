<div class="newspage view">
	<h1>News</h1>
	<h2><?php echo h($news['News']['headline']); ?></h2>
	<div class="newsarticle">
		<p class="small">Updated: <?php echo h($news['News']['modified']); ?></p>
		<?php echo h($news['News']['article']); ?>
	</div>			
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('All News'), array('action' => 'index')); ?> </li>
	</ul>
</div>
