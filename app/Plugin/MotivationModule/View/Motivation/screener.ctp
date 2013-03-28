<?php $this->extend('/Modules/module_template');?>

<h3>Fill in the following information to motivate yourself</h3>
<p>Write your personal reason for taking up the &apos;Champions for Health&apos; challenge in the box below.</p>
<p>Maybe you want to:</p>
<ul>
<li>improve your health and be more active?</li>
<li>get rid of that annoying cough every morning?</li>
<li>save money?</li>
<li>get ready for a holiday?</li>
<li>take up a new sport?</li>
</ul>
<?php echo $this->Form->create('MotivationScreener')?>
	<h3><label for="MotivationScreenerReason">Why are you doing this?</label></h3>
    <p><?php echo $this->Form->textarea('reason',array('label'=>'false', 'cols'=>'35', 'rows'=>'5')); ?></p>
<p><?php 
    echo $this->Form->hidden('created_date');
    echo $this->Form->hidden('id');
	$options = array(
    	'label' => 'Submit my Reason...'
	);
	echo $this->Form->end($options);
?></p>