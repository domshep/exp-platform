<?php
	foreach ($news as $article): ?>
		<h4><?php echo $this->Html->link(h($article['News']['headline']), array('action' => 'view', $article['News']['id'])); ?></h4>
		<p><?php echo $article['News']['article']; ?></p>
		<p class="small" style="float:right;"><?php echo h($article['News']['modified']); ?></p>
		<p><?php echo $this->Html->link(__('Read More...'), array('action' => 'view', $article['News']['id'])); ?></p>
	<?php endforeach; ?>