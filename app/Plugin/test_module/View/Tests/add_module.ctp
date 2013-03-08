<h2 class="bigred"><?php  echo $module_name; ?> - Add Module</h2>
<div class="view">
<span id=screener><br>
<br>
<b><font size="5" color="#BF1C2D" face="Tahoma">Eat healthily assessment guid</font></b><b><font size="5" color="#BF1C2D" face="Tahoma">ance</font></b><br>
<br>
<font size="4" face="Verdana">This assessment helps measure how much of your recommended 5 daily portions of different fruit and vegetables you are consuming. This acts as an indicator of a healthy diet during your challenge period.</font><br>
<br>
<font size="4" face="Verdana">To help generate the most accurate results possible, please  can you read the guidance below and click ‘next’ to take the assessment. The questions in the assessment refer to the last </font><b><u><font size="4" face="Verdana">7 days</font></u></b><font size="4" face="Verdana">. Please can you tell us the following;</font><br>
<br>
<b><font size="4" face="Verdana">How often</font></b><font size="4" face="Verdana"> you ate/drank each foodtype category during the last 7 days; and</font><br>
<b><font size="4" face="Verdana">How much</font></b><font size="4" face="Verdana"> of each foodtype category you ate/drank on an average day</font><br>
<br>
<font size="4" face="Verdana">If you did not have any of a particular foodtype category in the last 7 days, please select ‘never’. Report the amount eaten or drunk by yourself, and not your family or household.</font><br>
<br>
<font size="4" face="Verdana">To help you complete the assessment, a worked example is included below </font><font size="4" face="Verdana"> </font><br>
<a href="http://nww.championsforhealth.wales.nhs.uk/recommended-fruit-and-vegetable-portion-" target="eatingassessment"><u><font size="4" face="Verdana">Get some help working out what counts as a fruit and vegetable portion</font></u></a><br>
<br>
<img src="/test_module/img/example_form.gif" width="782" height="127"><br>
<br>
<?php echo $this->Html->link('Take the test', 'screener', array('class' => 'button', 'target' => '_self')); ?>
</span><!-- end of screener -->
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('My Dashboard'), array('controller' => 'users', 'action' => 'dashboard', 'plugin' => null)); ?> </li>
		<li><?php echo $this->Html->link(__('Explore Module'), array('action' => 'explore_module')); ?></li>
	</ul>
</div>
