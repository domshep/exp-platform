<?php $this->extend('/Modules/module_template'); ?>
<h2>Complete this screening tool to get your current BMI</h2>
<p>This screening tool provides a final BMI assessment. Please could you complete your weight information in (either in imperial or metric measure)</p>
<p><a href="/healthy_weight_module/body_mass_index/explore_module">Find out more about BMI and healthy weight</a>.</p>
<?php echo $this->Form->create('BmiScreener', array(
    'inputDefaults' => array(
        'label' => false
    )))?>
<table class="quiztable">
	<tr>
		<th class="colgreen col1">&nbsp;</th>
		<th class="colpeach col2">Kgs</th>
		<th class="colpeach col2" style="width:2em;font-style:italic;">or</th>
		<th class="colpeach col2">Stones / Lbs</th>
	</tr>
	<tr>
		<td class="colblue col1">Please enter your current weight:</td>
		<td class="colpeach col3">
			<?php echo $this->Form->input('BmiScreener.weight_kg', array('label'=>'kg', 'class'=>'kgs')); ?>
		</td>
		<td>&nbsp;</td>
		<td class="colgreen col2">
			<?php echo $this->Form->input('BmiScreener.weight_stones', Array('label'=>'stones', 'class'=>'stones')); ?>
			<?php echo $this->Form->input('BmiScreener.weight_lbs', Array('label'=>'lbs', 'class'=>'lbs')); ?>
		</td>
	</tr>
</table>
<?php 
	$options = array(
    	'label' => 'Calculate my BMI'
	);
	echo $this->Form->end($options);
?>
<script type="text/javascript">
jQuery(".quiztable #BmiScreenerWeightStones").bind("blur", function() 
{
	getMetricWeight(parseFloat($(".stones").val()), parseFloat($(".lbs").val()));
});

jQuery(".quiztable #BmiScreenerWeightLbs").bind("blur", function() 
{
	getMetricWeight(parseFloat($(".stones").val()), parseFloat($(".lbs").val()));
});

jQuery(".quiztable #BmiScreenerWeightKg").bind("blur", function() {
	getImperialWeight(parseFloat($(".kgs").val()));
});

jQuery("body").ready(function() {
    var imperial = getImperialWeight(parseFloat($(".kgs").val()));
});
</script>