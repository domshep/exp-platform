<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'Experimental Platform for Health Promotion');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		//echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('1053');
		echo $this->Html->script('http://code.jquery.com/jquery-latest.min.js');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js');
		echo $this->Html->script('/js/colorbox-master/jquery.colorbox.js'); // JQuery for Lightboxes
		echo $this->Html->script('/js/qTip2-master/dist/jquery.qtip.js'); // Used for Calendar Pop Ups
		echo $this->Html->css('/js/colorbox-master/example1/colorbox');
		echo $this->Html->css('/js/qTip2-master/dist/jquery.qtip');
		echo $this->Html->script('fontsize');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="wrapper">
		<div id="maincolwrap">
			<div id="banner" class="header">
				<div id="fontsize">&nbsp;</div>
				<div class="latesttweets">This area could be used for displaying a Twitter feed, or the "Why am I doing this?" module...</div>
				<h1><?php echo $this->Html->link($cakeDescription, '/'); ?></h1>
			</div>
			<div id="navsearch">
				<?php 
        			echo $this->MenuBuilder->build('main-menu');
    			?>
			</div>
			<div id="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
			<div id="footer">
				<?php 
        			echo $this->MenuBuilder->build('footer-menu');
    			?>
			</div>
		</div>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
	<script type="text/javascript">
		$(document).ready(function()
		{
			// Match all #calendar <A/> links with a title tag and use it as the content (default).
			$('#calendar a[title]').qtip();
		
			//Examples of how to assign the ColorBox event to in-line elements
			$(".info").colorbox({inline:true, width:"50%"});
		});
	</script>
	
<!-- This contains the hidden content for Common inline calls - One day will be controlled via admin -->
<div style='display:none'>
	<div id='whatworked' class='popup'>
		<h3>Information: The &apos;What worked for me this Week&apos; Tool</h3>
		<p>&apos;The what worked for me this week&apos; tool can help you identify which actions or activities have been effective at helping you achieve your goals. You can use it to make a note of the things that you are doing to change your lifestyle and then see if these changes are having an effect via your health run-chart.</p>
		<p>To help you get started, some examples of how you can use this tool are given below:</p>
		<ul>
			<li>Record any great ideas or tips that you have found helpful or encouraging e.g. &apos;found great recipe for a bean salad&apos;, or &apos;got idea from John to go for a swim in my lunch break &ndash; started Monday and loved it!&apos; Or &apos;went to a Stop Smoking Wales group session and found it helpful &ndash; really motivated to quit now&apos;</li>
    		<li>Note down something that you plan to work on the following week e.g. &apos;plan to remove the naughty snack food from the house and see if this improves my weight&apos;, or &apos;plan to get up at 06:00 and go for a run before work&apos;.</li>
    		<li>Record when you make changes to see how effective they are e.g. note when you started cycling to work instead of taking the car, or when you started taking fruit to work for snacks instead of crisps.</li>
    		<li>Record when you have exceeded your recommended limits so you know the reasons why e.g. when you went to a birthday party and drank a little more than usual, or when you went out for a meal</li>
		</ul>
	</div>
</div>
</body>
</html>
