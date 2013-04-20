	<?php 
	$this->extend('/Modules/module_template');?>
    <h2>Your score is: <?php echo $score;?></h2>
    <?php if($score <= 4) {?>
	<h3>Congratulations: You are a sensible drinker</h3>
	<table>
		<tr>
			<th>Category</th>
			<th>Men</th>
			<th>Women</th>
		</tr>
		<tr>
			<td>Sensible Drinking (recommended limit)</td>
			<td>Not more than 3-4 units per day</td>
			<td>Not more than 2-3 units per day</td>
		</tr>
	</table>
	<p><q>Sensible drinking is drinking in a way that is unlikely to cause yourself or others significant risk of harm”</q>
	<em>Department of health (2007)</em></p>
    <?php } elseif ($score <= 7) {?>
	<h3>You may be classed a hazardous drinker</h3>
	<table>
		<tr>
			<th>Category</th>
			<th>Men</th>
			<th>Women</th>
		</tr>
		<tr>
			<td>Hazardous Drinking</td>
			<td>22-50 units per week</td>
			<td>13-35 units per week</td>
		</tr>
	</table>
	<p><q>Hazardous drinking is defined as a pattern of drinking that increases the risk of harm to the user</q>
	<em>World Health Organisation (2008)</em><br/>
	<q>It may also be seen as regularly exceeding daily and weekly limits</q>
	<em>NHS (2010)</em></p>
    <?php } elseif ($score <= 9) {?>
	<h3>You may be classed a Harmful Drinker</h3>
	<table>
		<tr>
			<th>Category</th>
			<th>Men</th>
			<th>Women</th>
		</tr>
		<tr>
			<td>Harmful Drinking</td>
			<td>Above 50 units per week</td>
			<td>Above 35 units per week</td>
		</tr>
	</table>
	<p><q>Harmful drinking is a pattern of substance use that is causing damage to health. The damage may be physical or mental</q>
	<em>World Health Organisation (2008)</em></p>
    <?php } else {?>
	<h3>You should contact your GP</h3>
	<p>This is the highest band possible. We suggest that you have a chat with your GP about how much you are drinking but you can still follow the tips, advice and information pages to help you cut down...</p>
    <?php }
	
	echo $this->Form->create('DrinkingScreener', array(
    	'inputDefaults' => array(
        'label' => false
    )));
    
    echo $this->Form->hidden('how_often');
    echo $this->Form->hidden('how_much',array('value'=>'$how_many'));
    echo $this->Form->hidden('binge');
    echo $this->Form->hidden('gender');
    echo $this->Form->hidden('DrinkingScreener.score', array('value'=>$score));
    
	$options = array(
    	'label' => 'Add the Drink Safely module to my dashboard'
	);
	
	echo $this->Form->end($options);
?>