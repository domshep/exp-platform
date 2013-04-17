<?php $this->extend('/Modules/module_template');?>
    <h1>Your have indicated that you are <?php if ($smokes == 0) echo "not" ?> a smoker</h1>
    <?php 
    if($smokes==0) {?>
		<p>Congratulations and well done. You have not smoked within the last 4 weeks and are classed as smoke-free</p>
		<p><a href="/users/dashboard">Click here to return to your dashboard</a> and select another health topic</p>
    <?php } else {?>
		<p>You indicated you have smoked within the last 4 weeks. Were you aware that smokers spend over &pound;2,000 per year smoking 20 cigarettes a day?</p>
		<p>Each cigarette causes an estimated 11 minutes reduction in your life expectancy!!</p>
		<p>Click the next button to take the assessment and gauge your nicotine addiction.</p>
    	<?php 
    echo $this->Form->create('StopSmokingScreener', array(
    'inputDefaults' => array(
        'label' => false
    )));
    
    echo $this->Form->hidden('StopSmokingScreener.smoker', array('value'=>$smokes));
    
	$options = array(
	    'label' => 'Add the module to my dashboard'
	);
		}

	echo $this->Form->end($options);
?>