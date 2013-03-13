<?php $this->extend('/Modules/module_template');?>
<h3>Complete this screening tool to get some feedback on your current diet</h3>
<br />
<?php echo $this->Form->create('FiveADayScreener', array(
    'inputDefaults' => array(
        'label' => false
    )))?>
<table class="quiztable" cellspacing="0">
	<tr>
		<th class="colblue col1">Food Type</th>
		<th class="colgreen col2">On average, <em>how often</em> did you eat each food type during the past 7 days</th>
		<th class="colpeach col3">On an average day when you ate/drank this, <em>how many portions</em> of this food group did you have?</th>
		<th class="colpeach col4">Portion scale</th>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>Vegetables</strong> 
			e.g. cauliflower, cabbage, peas, carrots, mushrooms, tomatoes, leeks, swede, courgettes, broccoli, runner beans 
			<strong>Do not include potatoes</strong>
		</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('veg_often', array(
    				'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 
					6 => '6 days', 7 => '7 days'), 'empty' => '(choose one)'
));?>
</td>
		<td class="colpeach col3">
<?php echo $this->Form->input('veg_no', array(
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'),
    'empty' => '(choose one)'
));?>
</td>
		<td class="colpeach col4">Three heaped tablespoons</td>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>Salad</strong>
			e.g. mixed greens, lettuce, cucumber, onion, peppers</font>
		</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('salad_often', array(
    				'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 
					6 => '6 days', 7 => '7 days'), 'empty' => '(choose one)'
				));
			?>
		</td>
		<td class="colpeach col3">
			<?php 
				echo $this->Form->input('salad_no', array('options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'),
    'empty' => '(choose one)'
				));
			?>
		</td>
		<td class="colpeach col4">One dessert bowl</td>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>Whole fresh fruits</strong>
			e.g. apple, pear, orange, banana, peach
		</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('whole_fruit_often', array(
    				'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 
					6 => '6 days', 7 => '7 days'), 'empty' => '(choose one)'
				));
			?>
		</td>
		<td class="colpeach col3">
			<?php 
				echo $this->Form->input('whole_fruit_no', array(
    				'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'), 'empty' => '(choose one)'
				));
			?>
		</td>
		<td class="colpeach col4">One fruit</td>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>Medium fruits</strong>
			e.g. satsumas, plums, apricots
		</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('medium_fruit_often', array(
    				'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 
					6 => '6 days', 7 => '7 days'), 'empty' => '(choose one)'
				));
			?>
</td>
		<td class="colpeach col3">
			<?php 
				echo $this->Form->input('medium_fruit_no', array('options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'),
    'empty' => '(choose one)'
				));
			?>
</td>
		<td class="colpeach col4">Two fruits</td>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>Small fruits</strong>
			e.g. grapes, berries, cherries, lychees, cherry tomatoes
</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('small_fruit_often', array(
    				'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 
					6 => '6 days', 7 => '7 days'), 'empty' => '(choose one)'
				));
			?>
</td>
		<td class="colpeach col3">
			<?php 
				echo $this->Form->input('small_fruit_no', array(
    				'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'), 'empty' => '(choose one)'
				));
			?>
</td>
		<td class="colpeach col4">One handful</td>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>Tinned fruit, fruit in natural juice</strong>
			e.g. peaches, pineapple, pears 
			<strong> or stewed fruit</strong>
			e.g. apple, rhubarb, cherries
</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('tinned_fruit_often', array(
    				'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 
					6 => '6 days', 7 => '7 days'), 'empty' => '(choose one)'
				));
			?>
</td>
		<td class="colpeach col3">
			<?php 
				echo $this->Form->input('tinned_fruit_no', array(
    				'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'), 'empty' => '(choose one)'
				));
			?>
</td>
		<td class="colpeach col4">Three heaped tablespoons</td>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>Dried fruit</strong> e.g. raisins
</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('dried_fruit_often', array(
    				'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 
					6 => '6 days', 7 => '7 days'), 'empty' => '(choose one)'
				));
			?>
</td>
		<td class="colpeach col3">
			<?php 
				echo $this->Form->input('dried_fruit_no', array(
					'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'), 'empty' => '(choose one)'
				));
			?>
</td>
		<td class="colpeach col4">One heaped tablespoon</td>
	</tr>
	<tr>
		<td class="colblue col1">
			<strong>Fruit juice</strong>
			e.g. fresh or carton fruit juice (150ml)
</td>
		<td class="colgreen col2">
			<?php 
				echo $this->Form->input('fruit_juice_often', array(
    				'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 
					6 => '6 days', 7 => '7 days'), 'empty' => '(choose one)'
				));
			?>
</td>
		<td class="colpeach col3">
			<?php 
				echo $this->Form->input('fruit_juice_no', array(
					'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'), 'empty' => '(choose one)'
				));
			?>
</td>
		<td class="colpeach col4">One small glass/carton</td>
	</tr>
</table>
<?php 
$options = array(
    'label' => 'Calculate my score'
);
echo $this->Form->end($options);
?>