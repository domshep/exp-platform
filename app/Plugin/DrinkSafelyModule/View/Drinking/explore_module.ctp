<?php $this->extend('/Modules/module_template');?>
<h2>Cutting down on your drinking improves your health
	<span class="container pull-right">
		<?php echo $this->Html->image('/drink_safely_module/img/drinking/wine-glass.png', array('alt' => "Wine Glass", 'escape' => false));?>
	</span>
</h2>
<p class="lead">There's nothing wrong with enjoying a drink within sensible limits, but regularly drinking more can be bad for your health and the way you feel.</p>
<p>You can benefit from cutting down your drinking because...</p>
<ul>
	<li>You can feel better in the mornings - hangovers can leave you feeling anxious and low</li>
    <li>Your mood will improve, especially if you have been drinking heavily, as this can sometimes be linked to depression</li>
    <li>Your skin condition can improve</li>
    <li>You can lose weight or have better control of your weight by cutting down your drinking, if part of a healthy balanced diet</li>
    <li>Your energy levels will improve and you will feel fitter and faster</li>
    <li>Your immune system will get stronger - heavy drinkers are more susceptible to infectious diseases</li>
    <li>You will be at reduced risk of a variety of serious health problems including mouth and breast cancer</li>
    <li>You will have more time to enjoy other things and save money! </li>
</ul>
<?php
if($added_to_dashboard) {
	echo $this->Html->link(__('<span class="glyphicon glyphicon-th-large"></span> View the module dashboard'), array('action' => 'module_dashboard'), array('class' => 'btn btn-success btn-md bot-buffer pull-right', 'target' => '_self', 'escape' => false));
} else {
	echo $this->Html->link(__('<span class="glyphicon glyphicon-ok-circle"></span> Add this module to your dashboard'), array('action' => 'add_module'), array('class' => 'btn btn-success btn-md bot-buffer pull-right', 'target' => '_self', 'escape' => false));
}?>
