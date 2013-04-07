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
<table style="width:40%;border:1px solid gray;margin-left:auto;margin-right:auto;">
	<tbody>
		<tr>
			<td width="50%" bgcolor="#bf1e2e">
				<p align="center">
					<font color="#ffffff"><strong>BMI Score</strong></font>
				</p>
			</td>
			<td width="50%" bgcolor="#bf1e2e">
				<p align="center">
					<font color="#ffffff"><strong>Classification</strong></font>
				</p>
			</td>
		</tr>
		<tr>
			<td width="50%" bgcolor="#f3d6d9">
				<p align="center">
					<strong>Below 18.5</strong>
				</p>
			</td>
			<td width="50%" bgcolor="#f3d6d9">
				<p align="center">
					<strong>Underweight</strong>
				</p>
			</td>
		</tr>
		<tr>
			<td width="50%" bgcolor="#fcf5f6">
				<p align="center">
					<strong>18.5 - 24.9</strong>
				</p>
			</td>
			<td width="50%" bgcolor="#fcf5f6">
				<p align="center">
					<strong>Healthy weight</strong>
				</p>
			</td>
		</tr>
		<tr>
			<td width="50%" bgcolor="#f3d6d9">
				<p align="center">
					<strong>25 - 29.9</strong>
				</p>
			</td>
			<td width="50%" bgcolor="#f3d6d9">
				<p align="center">
					<strong>Overweight</strong>
				</p>
			</td>
		</tr>
		<tr>
			<td width="50%" bgcolor="#fcf5f6">
				<p align="center">
					<strong>30+</strong>
				</p>
			</td>
			<td width="50%" bgcolor="#fcf5f6">
				<p align="center">
					<strong>Obese</strong>
				</p>
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