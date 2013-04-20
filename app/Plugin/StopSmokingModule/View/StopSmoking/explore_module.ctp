<?php $this->extend('/Modules/module_template');?>
<h2><?php  echo $message; ?></h2>
<h3><img alt="Chained to Cigarettes" src="/stop_smoking_module/img/chainedtocigarettes.png" align="right" height="119" width="166"/>Quitting smoking equals better health&nbsp;</h3>
<p>How you will improve your health by quitting smoking....</p>  
<table class="infotable" style="width:90%;">
	<caption>Your immediate health benefits:</caption>
	<tr>
		<th>Duration</th>
		<th>Affect</th>
	<tr>              
		<td width="20%">After&nbsp;8 hours:</td>
		<td>Nicotine and carbon monoxide levels in your blood reduce by half. Oxygen levels return to normal.</td>
	</tr>          
	<tr>
		<td>After 24 hours:</td>
		<td>Carbon monoxide eliminated from your body. Lungs start to clear out mucus and other smoking debris.</td>          
	</tr>
	<tr>
		<td>After 48 hours:</td>              
		<td>There is no nicotine left in your body and your ability to taste and smell is greatly improved.</td>          
	</tr>          
	<tr>              
		<td>After 72 hours:</td>              
		<td>Your breathing becomes easier. Bronchial tubes begin to relax and energy levels increase.</td>          
	</tr>      
</table>
<p>&nbsp;</p>
<table class="infotable" style="width:90%;">
	<caption>Your longer-term health benefits:</caption>
	<tr>
		<th>Duration</th>
		<th>Affect</th>
	</tr>
	<tr>              
		<td width="20%">After 2-12 weeks:</td>              
		<td>Your blood circulation improves.</td>          
	</tr>          
	<tr>              
		<td>After 3-9 months:</td>              
		<td>Coughs, wheezing and breathing problems improve as your lung function is increased by up to 10%.</td>          
	</tr>          
	<tr>              
		<td>After 1 year:</td>              
		<td>Your risk of a heart attack falls to about half that of a smoker.</td>          
	</tr>          
	<tr>              
		<td>After 10 years:</td>              
		<td>Your risk of lung cancer falls to about half that of a smoker.</td>          
	</tr>          
	<tr>
		<td>After 15 years:</td>              
		<td>Your risk of a heart attack falls to the same level as someone who has never smoked.</td>          
	</tr>
</table>
<p>You can find out more about the <a title="click here to go to the NHS Choices webpage about the health benefits of giving up smoking [external website - opens in new window]" target="_blank" href="http://www.nhs.uk/Livewell/smoking/Pages/Betterlives.aspx ">health benefits</a>&nbsp;of giving up smoking from the <a title="Click here to go to the NHS Choices homepage [external website - opens in a new window]" target="_blank" href="http://www.nhs.uk/Pages/HomePage.aspx">NHS Choices</a> website.&nbsp;</p>
<?php echo $this->Html->link(__('Add this module to your dashboard'), array('action' => 'add_module'), array('class' => 'button action', 'target' => '_self')); ?>