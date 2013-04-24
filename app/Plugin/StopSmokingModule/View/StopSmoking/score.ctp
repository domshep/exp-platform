<?php $this->extend('/Modules/module_template');?>
    <h2>Based on your responses your nicotine dependency level is <?php echo $score; ?></h2>
    <?php 
    	if($score < 2) { ?>
		<h3>This indicates you have a very low dependence on nicotine</h3>
		<?php } elseif ($score < 8) { ?>
		<h3>This indicates you have a medium dependence on nicotine</h3>
    	<?php } else {?>
		<h3>This indicates you have a very high dependence on nicotine</h3>
		<?php }
   	 	
    echo $this->Form->create('StopSmokingScreener', array(
    'inputDefaults' => array(
        'label' => false
    )));
    
    echo $this->Form->hidden('StopSmokingScreener.smoker', array('value'=>$smokes));
    	echo $this->Form->hidden('StopSmokingScreener.score', array('value'=>$score));
    	echo $this->Form->hidden('StopSmokingScreener.how_many');
    	echo $this->Form->hidden('StopSmokingScreener.first_cig');
    	echo $this->Form->hidden('StopSmokingScreener.diff_non_smoking');
    	echo $this->Form->hidden('StopSmokingScreener.most_hate');
    	echo $this->Form->hidden('StopSmokingScreener.more_morning');
    	echo $this->Form->hidden('StopSmokingScreener.smoke_in_bed');
	?>
	<h3>Did you know that different interventions are available to help you quit smoking?</h3>
	<p> You can try with just your own will-power; combine will-power with using self-help materials, or seek advice from your local physician. You can also use nicotine replacement therapy or attend smoking support clinics (or a combination of both) to help you quit and stay quit.</p>
	<p><a href="http://www.championsforhealth.wales.nhs.uk/nicotine-addiction">To find out more visit the nicotine addiction page</a>.</p>
	<p>Different combinations of interventions can help you successfully give-up smoking depending on your nicotine dependency.</p>
	<ul>
		<li>If you have a low dependency on nicotine then interventions used individually may be successful, but if you have a high dependency, then you may find combining therapies more effective.</li>
		<li>Giving up smoking can be very hard due to the addictive nature of nicotine. You may find yourself craving cigarettes when tired, stressed or hungry. Very few people give-up smoking by relying on will-power alone. You are almost seven times more likely to give-up for good if you have professional help from Stop Smoking Wales through smoking clinics and combination therapy</li>
	</ul>
	<p><a href="http://www.championsforhealth.wales.nhs.uk/getting-support-to-quit" target="smokingsupport">Find out more about the stop smoking support services available in Wales</a>.</p>
	<p>You can add the Stop Smoking module to your personal dashboard to monitor and track your smoke-free days to help you make and maintain more changes.</p>
	
	<?php
    
	$options = array(
	    'label' => 'Add the module to my dashboard'
	);
	/*}*/

	echo $this->Form->end($options);
?>