<?php $this->extend('/Modules/module_template');?>

<h2>What is a BMI?</h2>
<p class="lead">BMI is used to assess whether you are a healthy weight for your
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
	<div class="col-md-6 col-md-offset-3">
	<table class="table">
		<thead>
			<tr>
				<th>
					BMI Score
				</th>
				<th>
					Classification
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					Below 18.5
				</td>
				<td>
					Underweight
				</td>
			</tr>
			<tr>
				<td>
					18.5 - 24.9
				</td>
				<td>
					Healthy weight
				</td>
			</tr>
			<tr>
				<td>
					25 - 29.9
				</td>
				<td>
					Overweight
				</td>
			</tr>
			<tr>
				<td>
					30+
				</td>
				<td>
					Obese
				</td>
			</tr>
		</tbody>
	</table>
</div>
<div class="row col-md-12">
<?php
if($added_to_dashboard) {
	echo $this->Html->link(__('<span class="glyphicon glyphicon-th-large"></span> View the module dashboard'), array('action' => 'module_dashboard'), array('class' => 'btn btn-success btn-md bot-buffer pull-right', 'target' => '_self', 'escape' => false));
} else {
	echo $this->Html->link(__('<span class="glyphicon glyphicon-ok-circle"></span> Add this module to your dashboard'), array('action' => 'add_module'), array('class' => 'btn btn-success btn-md bot-buffer pull-right', 'target' => '_self', 'escape' => false));
}?>
</div>

