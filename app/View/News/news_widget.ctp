<?php
	$i = 0; 
	foreach ($news as $article): ?>
		<h4><?php echo $this->Html->link(h($article['News']['headline']), array('action' => 'view', $article['News']['id'])); ?></h4>
		<p class="small">Created: <?php echo h($article['News']['created']); ?>. Last Edited: <?php echo h($article['News']['modified']); ?>&nbsp;</p>
		<p><?php echo $article['News']['article']; ?></p>
		<p><?php echo $this->Html->link(__('Read More...'), array('action' => 'view', $article['News']['id'])); ?></p>
	<?php endforeach; ?>
<p><?php echo $this->Html->link(__('More News...'), array('action' => '/news/index'), array('class' => 'button')); ?></p>
<p style="clear:both; margin:0px; padding:0px; line-height:0px;">&nbsp;</p>