<?php $this->extend('/Modules/module_template');?>

<h2>Eat healthily assessment guidance</h2>
<p>This assessment helps measure how much of your recommended 5 daily portions of different fruit and vegetables you are consuming. This acts as an indicator of a healthy diet during your challenge period.</p>
<p>To help generate the most accurate results possible, please  can you read the guidance below and click &lsquo;Take the test&rsquo; to take the assessment. The questions in the assessment refer to the last <strong>7 days</strong>.</p>
<p>Please can you tell us the following;</p>
<ul>
<li><strong>How often</strong> you ate/drank each foodtype category during the last 7 days; and</li>
<li><strong>How much</strong> of each foodtype category you ate/drank on an average day</li>
</ul>
<br />
<p>If you did not have any of a particular foodtype category in the last 7 days, please select &lsquo;never&rsquo;. Report the amount eaten or drunk by yourself, and not your family or household.</p>
<p>To help you complete the assessment, a worked example is included below.</p>
<p><a href="http://www.championsforhealth.wales.nhs.uk/recommended-fruit-and-vegetable-portion-" target="eatingassessment">Get some help working out what counts as a fruit and vegetable portion</a></p>
<p><img src="/example_module/img/example_form.gif" width="782" height="127"></p>
<p><?php echo $this->Html->link('Take the test >', 'screener', array('class' => 'button action', 'target' => '_self')); ?></p>