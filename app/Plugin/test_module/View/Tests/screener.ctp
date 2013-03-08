<h2 class="bigred"><?php  echo $module_name; ?> - Add Module</h2>
<div class="view">
<b><font size="4" face="Tahoma">Complete this screening tool to get some feedback on your </font></b><b><font size="4" face="Tahoma">current diet</font></b><br>
<br>
<?php echo $this->Form->create('FiveadayScreener', array(
    'inputDefaults' => array(
        'label' => false
    )))?>
<table border="1">
<tr valign="top"><td class="colblue" width="251" bgcolor="#0099CC"><div align="center"><b><font color="#FFFFFF" face="Tahoma">Food Type</font></b></div></td>
<td class="colgreen" width="355"><div align="center"><font face="Tahoma">On average, </font><b><font face="Tahoma">how often</font></b><font face="Tahoma"> did you eat each food type during the past 7 days</font></div></td>
<td class="colpeach" width="298"><div align="center"><font face="Tahoma">On an average day when you ate/drank this, </font><b><font face="Tahoma">how many</font></b><font face="Tahoma"> portions of this food group did you have?</font></div></td>
<td class="colpeach" width="76"><div align="center"><font face="Tahoma">Portion scale</font></div></td>
</tr>

<tr valign="top"><td class="colblue" width="251" bgcolor="#0099CC"><b><font color="#FFFFFF" face="Tahoma"><br>Vegetables</font></b><font color="#FFFFFF" face="Tahoma"> e.g. cauliflower, cabbage, peas, carrots, mushrooms, tomatoes, leeks, swede, courgettes, broccoli, runner beans </font><b><font color="#FFFFFF" face="Tahoma">Do not include potatoes</font></b><br>
<u><font color="#FFFFFF" face="Tahoma"><br></font></u></td>
<td class="colgreen" width="44">
<?php echo $this->Form->input('veg_often', array(
    'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 6 => '6 days', 7 => '7 days'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="44">
<?php echo $this->Form->input('veg_no', array(
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="76"><div align="center"><font face="Tahoma">Three heaped tablespoons</font></div></td></tr>

<tr valign="top"><td class="colblue" width="251" bgcolor="#0099CC"><b><font color="#FFFFFF" face="Tahoma"><br>Salad</font></b><font color="#FFFFFF" face="Tahoma"> e.g. mixed greens, lettuce, cucumber, onion, peppers</font><br>
<font color="#FFFFFF" face="Tahoma"><br></font></td>
<td class="colgreen" width="44">
<?php echo $this->Form->input('salad_often', array(
    'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 6 => '6 days', 7 => '7 days'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="44">
<?php echo $this->Form->input('salad_no', array(
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="76"><div align="center"><font face="Tahoma">One dessert bowl</font></div></td></tr>

<tr valign="top"><td class="colblue" width="251" bgcolor="#0099CC"><b><font color="#FFFFFF" face="Tahoma"><br>Whole fresh fruits</font></b><font color="#FFFFFF" face="Tahoma"> e.g. apple, pear, orange, banana, peach</font><br>
<font color="#FFFFFF" face="Tahoma"><br></font></td>
<td class="colgreen" width="44">
<?php echo $this->Form->input('whole_fruit_often', array(
    'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 6 => '6 days', 7 => '7 days'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="44">
<?php echo $this->Form->input('whole_fruit_no', array(
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="76"><div align="center"><font face="Tahoma">One fruit</font></div></td></tr>

<tr valign="top"><td class="colblue" width="251" bgcolor="#0099CC"><b><font color="#FFFFFF" face="Tahoma"><br>Medium fruits</font></b><font color="#FFFFFF" face="Tahoma"> e.g. satsumas, plums, apricots</font><br>
<font color="#FFFFFF" face="Tahoma"><br></font></td>
<td class="colgreen" width="44">
<?php echo $this->Form->input('medium_fruit_often', array(
    'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 6 => '6 days', 7 => '7 days'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="44">
<?php echo $this->Form->input('medium_fruit_no', array(
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="76"><div align="center"><font face="Tahoma">Two fruits</font></div></td></tr>

<tr valign="top"><td class="colblue" width="251" bgcolor="#0099CC"><b><font color="#FFFFFF" face="Tahoma"><br>Small fruits</font></b><font color="#FFFFFF" face="Tahoma"> e.g. grapes, berries, cherries, lychees, cherry tomatoes</font><br>
<font color="#FFFFFF" face="Tahoma"><br></font></td>
<td class="colgreen" width="44">
<?php echo $this->Form->input('small_fruit_often', array(
    'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 6 => '6 days', 7 => '7 days'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="44">
<?php echo $this->Form->input('small_fruit_no', array(
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="76"><div align="center"><font face="Tahoma">One handful</font></div></td></tr>

<tr valign="top"><td class="colblue" width="251" bgcolor="#0099CC"><b><font color="#FFFFFF" face="Tahoma"><br>Tinned fruit, fruit in natural juice</font></b><font color="#FFFFFF" face="Tahoma"> e.g. peaches, pineapple, pears) </font><b><font color="#FFFFFF" face="Tahoma">or</font></b><b><font color="#FFFFFF" face="Tahoma"> stewed fruit</font></b><font color="#FFFFFF" face="Tahoma"> e.g. apple, rhubarb, cherries</font><br>
<font color="#FFFFFF" face="Tahoma"><br></font></td>
<td class="colgreen" width="44">
<?php echo $this->Form->input('tinned_fruit_often', array(
    'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 6 => '6 days', 7 => '7 days'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="44">
<?php echo $this->Form->input('tinned_fruit_no', array(
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="76"><div align="center"><font face="Tahoma">Three heaped tablespoons</font></div></td></tr>

<tr valign="top"><td class="colblue" width="251" bgcolor="#0099CC"><b><font color="#FFFFFF" face="Tahoma"><br>Dried fruit</font></b><font color="#FFFFFF" face="Tahoma"> e.g. raisins</font><br>
<font color="#FFFFFF" face="Tahoma"><br></font></td>
<td class="colgreen" width="44">
<?php echo $this->Form->input('dried_fruit_often', array(
    'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 6 => '6 days', 7 => '7 days'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="44">
<?php echo $this->Form->input('dried_fruit_no', array(
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="76"><div align="center"><font face="Tahoma">One heaped tablespoon</font></div></td></tr>

<tr valign="top"><td class="colblue" width="251" bgcolor="#0099CC"><b><font color="#FFFFFF" face="Tahoma"><br>Fruit juice</font></b><font color="#FFFFFF" face="Tahoma"> e.g. fresh or carton fruit juice (150ml)</font><br>
<font color="#FFFFFF" face="Tahoma"><br></font></td>
<td class="colgreen" width="44">
<?php echo $this->Form->input('fruit_juice_often', array(
    'options' => array(0 => 'Never', 1 => '1 day', 2 => '2 days', 3 => '3 days', 4 => '4 days', 5 => '5 days', 6 => '6 days', 7 => '7 days'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="44">
<?php echo $this->Form->input('fruit_juice_no', array(
    'options' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => '5 or more'),
    'empty' => '(choose one)'
));?>
</td>
<td class="colpeach" width="76"><div align="center"><font face="Tahoma">One small glass/carton</font></div></td></tr>
</table>
<?php 
$options = array(
    'label' => 'Calculate my score'
);

echo $this->Form->end($options);
?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('My Dashboard'), array('controller' => 'users', 'action' => 'dashboard', 'plugin' => null)); ?> </li>
		<li><?php echo $this->Html->link(__('Explore Module'), array('action' => 'explore_module')); ?></li>
	</ul>
</div>
