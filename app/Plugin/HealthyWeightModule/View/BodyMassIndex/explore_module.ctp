<?php $this->extend('/Modules/module_template');?>

<h2>What is a BMI?</h2>
<p>BMI is used to assess whether you are a healthy weight for your
	height. It takes into account that people come in different shapes and
	sizes, so a range of BMIs is considered healthy for an adult of any
	given height.</p>
<p>
	A BMI above the healthy range indicates you are heavier than is healthy
	for your height, and you at an increased risk of the serious chronic
	health problems such as obesity, type 2 diabetes, heart disease, high
	blood pressure and certain cancers. You can find out more about <a
		href="http://www.nhs.uk/Livewell/loseweight/Pages/BodyMassIndex.aspx">the
		BMI score</a> from the NHS Choices website.
</p>
<p>BMI scores are split into 4 categories. Some adults who have a
	lot of muscle may have a BMI above the healthy range e.g. Professional
	rugby players may have an &lsquo;obese&rsquo; BMI despite having very little body
	fat. However this will not apply to most people.</p>
<table class="infotable" style="width:40%;">
	<tbody>
		<tr>
			<th class="center" width="50%">
				BMI Score
			</th>
			<th class="center" width="50%">
				Classification
			</th>
		</tr>
		<tr>
			<td class="center">
				<strong>Below 18.5</strong>
			</td>
			<td class="center">
				<strong>Underweight</strong>
			</td>
		</tr>
		<tr>
			<td class="center">
				<strong>18.5 - 24.9</strong>
			</td>
			<td class="center">
				<strong>Healthy weight</strong>
			</td>
		</tr>
		<tr>
			<td class="center">
				<strong>25 - 29.9</strong>
			</td>
			<td class="center">
				<strong>Overweight</strong>
			</td>
		</tr>
		<tr>
			<td class="center">
				<strong>30+</strong>
			</td>
			<td class="center">
				<strong>Obese</strong>
			</td>
		</tr>
	</tbody>
</table>
<?php
if($added_to_dashboard) {
	echo "<p>This module is already on your dashboard.</p>";
} else {
	echo $this->Html->link(__('Add this module to your dashboard'), array('action' => 'add_module'), array('class' => 'button action', 'target' => '_self'));
}?>