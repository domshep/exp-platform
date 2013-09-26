<?php $this->extend('/Modules/module_template');?>
<h2>The right amount of exercise equals better health</h2>
<p class="lead">Being active is great for your health. Here are some ways you can
	improve your health if you increase your activity levels.</p>
<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<table class="table table-striped">
		<thead>
			<tr>
				<th>Increasing
						exercise can help improve your physical health by...</th>
				<th>Increasing exercise can
						help improve your mental health &amp; wellbeing by...
				</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>Reducing the risk of coronary heart disease and strokes by up to
					35%</td>
				<td>Lowering your risk of suffering anxiety</td>
			</tr>
			<tr>
				<td>Reducing the risk of colon cancer by up to 50%</td>
				<td>Reducing the risk of dementia by up to 30%</td>
			</tr>
			<tr>
				<td>Reducing the risk of breast cancer by up to 20%</td>
				<td>Improving your self-confidence and self-esteem</td>
			</tr>
			<tr>
				<td>Reducing the risk of early death by up to 30%</td>
				<td>&nbsp;</td>
			</tr>
		</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<p>Exercise is medically proven to help protect against the chronic
			health conditions of;</p>
		<ul>
			<li>Obesity</li>
			<li>Type 2 diabetes</li>
			<li>Hypertension (high blood pressure)</li>
		</ul>
		<p>Increasing exercise can also help manage these other health and
			wellbeing conditions;</p>
		<ul>
			<li>Back pain</li>
			<li>Stress</li>
			<li>Weight and medical conditions</li>
		</ul>
		<p>Active people report less illness and faster recovery times if they
			do become ill.</p>
		<p>
			Read more detailed information about the <a
				title="click to read about the health benefits of exercise from the NHS Choices website [external website - opens in new window]"
				target="_blank"
				href="http://www.nhs.uk/Livewell/fitness/Pages/whybeactive.aspx "><strong>health
					benefits of exercise</strong> </a> from the NHS Choices website.
		</p>
	</div>
</div>
<?php
if($added_to_dashboard) {
	echo $this->Html->link(__('<span class="glyphicon glyphicon-th-large"></span> View the module dashboard'), array('action' => 'module_dashboard'), array('class' => 'btn btn-success btn-md bot-buffer pull-right', 'target' => '_self', 'escape' => false));
} else {
	echo $this->Html->link(__('<span class="glyphicon glyphicon-ok-circle"></span> Add this module to your dashboard'), array('action' => 'add_module'), array('class' => 'btn btn-success btn-md bot-buffer pull-right', 'target' => '_self', 'escape' => false));
}?>
