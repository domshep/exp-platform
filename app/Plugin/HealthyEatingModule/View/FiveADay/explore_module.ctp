<?php $this->extend('/Modules/module_template');?>

<h2>
	How eating 5-a-day can improve your health
	<?php echo $this->Html->image('/healthy_eating_module/img/five_a_day/fruitnveg.png', array('alt' => "Fruit and veg in the shape of a heart", 'escape' => false, 'class'=> 'right'));?>
</h2>
<h3>
	Fruit and vegetables are good for you because...
</h3>
<ul>
	<li>Different fruit and vegetables contain many combinations of fibre,
		vitamins, minerals and nutrients.</li>
	<li>Fruit and vegetables are low in fat and calories (providing
		you&rsquo;re not frying or roasting them in lots of oil).</li>
	<li>They provide a good source of vitamins and minerals including
		folate, vitamin C, and potassium.</li>
	<li>They provide an excellent source of dietary fibre which helps
		maintain a healthy gut and can prevent constipation.</li>
</ul>
<h3>
	Fruit and vegetable improve your health because...
</h3>
<ul>
	<li>Making sure you eat your 5-a-day can reduce the risk of serious
		lifestyle health issues such as <strong>obesity</strong>, <strong>type
			2 diabetes</strong>, <strong>heart disease</strong>, <strong>stroke</strong>
		and <strong>some cancers</strong>.
	</li>
	<li>The high fibre content in your diet from fruit and vegetables can
		reduce the risk of bowel cancer</li>
	<li>Your 5-a-day fruit and vegetables contribute to a healthy and
		balanced diet and can help you maintain a healthy weight and keep your
		heart healthy.</li>
</ul>
<p>
It is important to remember that eating the recommended levels of
	fruit and vegetables is a positive step forward and forms part of a
	healthy balanced diet.</p>
<p>
	For more information about how to achieve a balanced diet visit the <a
		title="click here to find out about balanced diets from the Change4Life website [external website - opens in a new window]"
		target="_blank" href="http://change4lifewales.org.uk/adults/?lang=en"><strong>Change4Life
			Wales</strong> </a> website.
</p>
<?php
if($added_to_dashboard) {
	echo "<p>This module is already on your dashboard.</p>";
} else {
	echo $this->Html->link(__('Add this module to your dashboard'), array('action' => 'add_module'), array('class' => 'button action', 'target' => '_self'));
}?>