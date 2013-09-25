<?php $this->extend('/Modules/module_template'); ?>
<h2>Complete this screening tool to get your current BMI</h2>
<p class="lead">This screening tool provides a final BMI assessment. Please could you complete your weight information in (either in imperial or metric measure)</p>
<p><a href="/healthy_weight_module/body_mass_index/explore_module">Find out more about BMI and healthy weight</a>.</p>
<div class="row col-md-6 col-md-offset-3">
<?php echo $this->Form->create('BmiScreener', array(
    'inputDefaults' => array(
        'label' => false
    )))?>
<table class="table weight-table">
	<thead>
	<tr>
		<th class="colgreen col1">&nbsp;</th>
		<th class="colpeach col2">Kgs</th>
		<th class="colpeach col2"><em>or</em></th>
		<th class="colpeach col2">Stones / Lbs</th>
	</tr>
	</thead>
	<tr>
		<td class="colblue col1">Please enter your current weight:</td>
		<td class="colpeach col3">
			<?php echo $this->Form->input('BmiScreener.weight_kg', array('label'=>'kg')); ?>
		</td>
		<td>&nbsp;</td>
		<td class="colgreen col2">
			<?php echo $this->Form->input('BmiScreener.weight_stones', Array('label'=>'stones')); ?>
			<?php echo $this->Form->input('BmiScreener.weight_lbs', Array('label'=>'lbs')); ?>
		</td>
	</tr>
</table>
<?php 
	$options = array(
    	'label' => 'Calculate my BMI',
		'class' => 'btn btn-success btn-md bot-buffer pull-right'
	);
	echo $this->Form->end($options);
?>
</div>
<script type="text/javascript">
jQuery(".weight-table input[id$='Stones']").bind("blur", function() 
{
	getMetricWeight(parseFloat($("input[id$='Stones']").val()), parseFloat($("input[id$='Lbs']").val()));
});

jQuery(".weight-table input[id$='Lbs']").bind("blur", function() 
{
	getMetricWeight(parseFloat($("input[id$='Stones']").val()), parseFloat($("input[id$='Lbs']").val()));
});

jQuery(".weight-table input[id$='Kg']").bind("blur", function() {
	getImperialWeight(parseFloat($("input[id$='Kg']").val()));
});

jQuery("body").ready(function() {
    var imperial = getImperialWeight(parseFloat($("input[id$='Kg']").val()));
});
</script>