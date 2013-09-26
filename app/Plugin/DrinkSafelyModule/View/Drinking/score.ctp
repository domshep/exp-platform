	<?php 
	$this->extend('/Modules/module_template');?>
    <?php if($score <= 4) {?>
    <h2>You scored between 0 - 4</h2>
	<p class="lead">Well done! This is within the sensible drinking range.</p>
	<table class="table table-striped">
		<thead>
		<tr>
			<th>Category</th>
			<th>Men</th>
			<th>Women</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>Sensible Drinking<br />(recommended limit)</td>
			<td>Not more than 3-4 units per day</td>
			<td>Not more than 2-3 units per day</td>
		</tr>
		</tbody>
	</table>
	<p>According to the Department of Health, sensible drinking is drinking in a way that is unlikely to cause yourself or others significant risk of harm.</p>
    <p>
	<a href="http://www.championsforhealth.wales.nhs.uk/drink-safely" target="alcohollow">Find out how you are benefiting your health by drinking sensibly</a>.
	</p>
    <?php } elseif ($score <= 7) {?>
    <h2>You scored between 5 - 7</h2>
	<p class="lead">You may be classed a hazardous drinker.</p>
	<table class="table table-striped">
		<thead>
		<tr>
			<th>Category</th>
			<th>Men</th>
			<th>Women</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>Hazardous Drinking</td>
			<td>22-50 units per week</td>
			<td>13-35 units per week</td>
		</tr>
		</tbody>
	</table>
	<p>According to the World Health Organisation, hazardous drinking is defined as a pattern of drinking that increases the risk of harm to the user.</p>
	<p>According to the NHS, it may also be seen as regularly exceeding daily and weekly limits.</p>
	<p>
	<a href="http://www.championsforhealth.wales.nhs.uk/drink-safely" target="alcohollow">Find out how cutting down your drinking can improve your health</a>.
	</p>
    <?php } elseif ($score <= 10) {?>
    <h2>You scored between 8 - 10</h2>
	<p class="lead">You may be classed a Harmful Drinker.</p>
	<table class="table table-striped">
		<thead>
		<tr>
			<th>Category</th>
			<th>Men</th>
			<th>Women</th>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td>Harmful Drinking</td>
			<td>Above 50 units per week</td>
			<td>Above 35 units per week</td>
		</tr>
		</tbody>
	</table>
	<p>According to the World Health Organisation, harmful drinking is a pattern of substance use that is causing damage to health. The damage may be physical or mental.</p>
	<p>
	<a href="http://www.championsforhealth.wales.nhs.uk/drink-safely" target="alcohollow">Find out how cutting down your drinking can improve your health</a>.
	</p>
    <?php } else {?>
    <h2>You scored between 11 - 12</h2>
	<p class="lead">This is the highest band possible. We suggest that you have a chat with your GP about how much you are drinking but you can still follow the tips, advice and information pages to help you cut down...</p>
	<?php } ?>
    
    <p>Take a look at the chart below to understand how your score relates to the classification scale used by the NHS.</p>
    <p><img height="324" alt="" width="911" src="/drink_safely_module/img/alcohol-screening-score.png" class="img-responsive" style="margin:0 auto; display:block;"/></p>
	<p>You can add the &lsquo;Drink Safely&rsquo; module
    to your personal dashboard to monitor and track your alcohol consumption to help
    you make and maintain more changes.</p>
    
	<?php 
	echo $this->Form->create('DrinkingScreener', array(
    	'inputDefaults' => array(
        'label' => false
    )));
    
    echo $this->Form->hidden('how_often');
    echo $this->Form->hidden('how_many');
    echo $this->Form->hidden('binge');
    echo $this->Form->hidden('gender');
    echo $this->Form->hidden('DrinkingScreener.score', array('value'=>$score));

    $options = array(
    		'label' => 'Add the &lsquo;Drink Safely&rsquo; module to my dashboard',
    		'escape' => false,
    		'class' => 'btn btn-success btn-md bot-buffer pull-right'
    );
    
    echo $this->Form->end($options);
?>
