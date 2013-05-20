<?php
	foreach ($news as $article): ?>
		<h4><?php echo $article['News']['headline']; ?></h4>
		<p><?php echo $article['News']['article']; ?></p>
		<p class="small" style="text-align:right;"><?php echo h($article['News']['modified']); ?></p>
<?php endforeach; ?>