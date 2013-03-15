<div class="newspage view">
	<h2><?php  echo __('News'); ?></h2>
	<h3><?php echo h($news['News']['headline']); ?></h3>
	<div class="newsarticle">
		<p>Created on: <?php echo h($news['News']['created']); ?>. Last Modified on: <?php echo h($news['News']['modified']); ?></p>
	</div>			
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('List News'), array('action' => 'index')); ?> </li>
	</ul>
</div>
