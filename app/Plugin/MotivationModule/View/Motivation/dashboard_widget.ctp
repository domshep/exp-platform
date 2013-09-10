<?php
if(is_null($user['User']['role']) || !$activated) {
	// User not logged in or the module is not active, so display nothing
} else {
?>
<h2>Why am I doing this?</h2>
<?php
	if(empty($motivation)) {?>
		<p class="reason">Click the pencil to record a personal reason for taking on your challenges</p>
		<p class="byline"><?php
		echo $this->Html->image("pencil.gif", array(
				"alt" => "Pencil",
				"title" => "Record a reason",
				'url' => array('action' => 'screener')
		));
	} else {?>
		<p class="reason">&ldquo;<?php echo $motivation['MotivationScreener']['reason'];?>&rdquo;</p>
		<p class="byline">My words - <?php echo date('d M Y',strtotime($motivation['MotivationScreener']['modified']));?> <?php
		echo $this->Html->image("pencil.gif", array(
				"alt" => "Pencil",
				"title" => "Edit my reason",
				'url' => array('action' => 'screener')
		));
	}
	?>
	</p>
	<?php
}?>