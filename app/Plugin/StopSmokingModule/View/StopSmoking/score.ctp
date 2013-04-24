<?php $this->extend('/Modules/module_template');?>
    <h1>You scored: <?php echo $score; ?></h1>
    <?php 
    	if($score < 2) { ?>
		<h3>Your score indicates that your nicotine dependence is 'low'</h3>
		<?php } elseif ($score < 8) { ?>
		<h3>Your score indicates that your nicotine dependence is 'medium'</h3>
    <?php } else {?>
		<h3>Your score indicates that your nicotine dependence is 'very high'</h3>
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
	<h3>Did you know that there are different intervention techniques that can help a smoker become smoke-free?</h3>
	<ul>
		<li>For smokers with very low dependencies on nicotine, interventions used individually may be successful</li>
		<li>For smokers with very high dependencies on nicotine, complementary therapy may be effective, mixing two or more techniques.</li>
	</ul>
	<p>The success rates of each intervention technique is shown in the table below:</p>
	<table>
		<tr>
			<th>Intervention / support method</th>
			<th>% of smokers successfully become smoke-free</th>
		</tr>
		<tr>
			<td>Willpower alone</td>
			<td>3%</td>
		</tr>
		<tr>
			<td>Willpower plus self-help materials</td>
			<td>4%</td>
		</tr>
		<tr>
			<td>Brief advice from physician</td>
			<td>5%</td>
		</tr>
		<tr>
			<td>Nicotine Replacement therapy</td>
			<td>6%</td>
		</tr>
		<tr>
			<td>Smokers' clinic</td>
			<td>10%</td>
		</tr>
		<tr>
			<td>Smokers' clinic plus Nicotine Replacement Therapy</td>
			<td>20%</td>
		</tr>
	</table>
	<p><a href="" target="_blank">Click here for more information on smoking and nicotine addiction</a></p>
	<?php
    
	$options = array(
	    'label' => 'Add the module to my dashboard'
	);
	/*}*/

	echo $this->Form->end($options);
?>