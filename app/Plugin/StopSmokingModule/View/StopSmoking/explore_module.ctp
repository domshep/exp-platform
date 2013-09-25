<?php $this->extend('/Modules/module_template');?>
<h2>How you will improve your health by quitting smoking...
	<span class="container pull-right">
	<?php echo $this->Html->image('/stop_smoking_module/img/chainedtocigarettes.png', array('alt' => "Chained to Cigarettes", 'escape' => false));?>
	</span>
</h2>
<p class="lead">Quitting smoking equals better health</p>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<table class="table">
			<caption>Your immediate health benefits:</caption>
			<thead>
			<tr>
				<th>Duration</th>
				<th>Affect</th>
			</tr>
			</thead>
			<tbody>
			<tr>              
				<td>After&nbsp;8 hours:</td>
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
			</tbody>   
		</table>
	</div>
</div>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<table class="table">
			<caption>Your longer-term health benefits:</caption>
			<thead>
			<tr>
				<th>Duration</th>
				<th>Affect</th>
			</tr>
			</thead>
			<tbody>
			<tr>              
				<td>After 2-12 weeks:</td>              
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
			</tbody>
		</table>
	</div>
</div>
<p>You can find out more about the <a title="click here to go to the NHS Choices webpage about the health benefits of giving up smoking [external website - opens in new window]" target="_blank" href="http://www.nhs.uk/Livewell/smoking/Pages/Betterlives.aspx ">health benefits</a>&nbsp;of giving up smoking from the <a title="Click here to go to the NHS Choices homepage [external website - opens in a new window]" target="_blank" href="http://www.nhs.uk/Pages/HomePage.aspx">NHS Choices</a> website.&nbsp;</p>
<?php
if($added_to_dashboard) {
	echo $this->Html->link(__('<span class="glyphicon glyphicon-th-large"></span> View the module dashboard'), array('action' => 'module_dashboard'), array('class' => 'btn btn-success btn-md bot-buffer pull-right', 'target' => '_self', 'escape' => false));
} else {
	echo $this->Html->link(__('<span class="glyphicon glyphicon-ok-circle"></span> Add this module to your dashboard'), array('action' => 'add_module'), array('class' => 'btn btn-success btn-md bot-buffer pull-right', 'target' => '_self', 'escape' => false));
}?>
