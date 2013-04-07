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
		<th class="colpeach col2">Stones / Lbs</th>
		<th class="colpeach col2">Kgs</th>
	</tr>
	<tr>
		<td class="colblue col1">Please enter your current weight:</td>
		<td class="colgreen col2">
			<?php echo $this->Form->input('BmiScreener.weight_stones', Array('label'=>'Stones')); ?>
			<?php echo $this->Form->input('BmiScreener.weight_lbs', Array('label'=>'lbs')); ?>
		<td class="colpeach col3">
			<?php echo $this->Form->input('BmiScreener.weight_kg', array('label'=>'kg')); ?>
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
    var $tr = $(this).closest("tr");
	var stones = parseFloat($tr.find("#BmiScreenerWeightStones").val());
    var lbs = parseFloat($tr.find("#BmiScreenerWeightLbs").val());
    
	var kgs = parseFloat($tr.find("#BmiScreenerWeightKg").val());
	
    if(isNaN(stones)) stones = 0;
	if(isNaN(lbs)) lbs = 0;
	
	if (stones > 0 && lbs > 0){
		var newkg = Math.round(((stones * 13) + lbs) * 0.453592,0);
		$tr.find("#BmiScreenerWeightKg").val(newkg);
	}
});

jQuery(".quiztable #BmiScreenerWeightLbs").bind("blur", function() 
{
    var $tr = $(this).closest("tr");
	var stones = parseFloat($tr.find("#BmiScreenerWeightStones").val());
    var lbs = parseFloat($tr.find("#BmiScreenerWeightLbs").val());
    
	var kgs = parseFloat($tr.find("#BmiScreenerWeightKg").val());
	
    if(isNaN(stones)) stones = 0;
	if(isNaN(lbs)) lbs = 0;
	
	if (stones > -1 && lbs > -1){
		var newkg = Math.round(((stones * 13) + lbs) * 0.453592,0);
		$tr.find("#BmiScreenerWeightKg").val(newkg);
	}
	
	if (lbs >= 13){
		var newstones = ($tr.find("#BmiScreenerWeightStones").val()* 1) + 1;
		var newlbs = ($tr.find("#BmiScreenerWeightLbs").val()* 1) - 13;
		while (newlbs >= 13)
		{
			var newstones = newstones + 1;
			var newlbs = newlbs - 13;
		}
		$tr.find("#BmiScreenerWeightStones").val(newstones);
		$tr.find("#BmiScreenerWeightLbs").val(newlbs);
	}
	if (lbs < 0){
		$tr.find("#BmiScreenerWeightLbs").val(0);
	}
	
});

jQuery(".quiztable #BmiScreenerWeightKg").bind("blur", function() {
    
    var $tr = $(this).closest("tr");
	var kgs = parseFloat($tr.find("#BmiScreenerWeightKg").val());
	var stones = parseFloat($tr.find("#BmiScreenerWeightStones").val());
    var lbs = parseFloat($tr.find("#BmiScreenerweightLbs").val());
    
    if(isNaN(kgs)) kgs = 0;
	
	if (kgs > 0){
		var newlbs = Math.round((kgs * 2.20462),2);
		var newstones = Math.floor(newlbs / 13);
		newlbs = (newlbs - (newstones*13));
		$tr.find("#BmiScreenerWeightLbs").val(newlbs);
		$tr.find("#BmiScreenerWeightStones").val(newstones);
	}
});
</script>