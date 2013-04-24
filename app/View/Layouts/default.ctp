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
		<?php echo $title_for_layout . " | "; ?>
		<?php echo $cakeDescription ?>
	</title>
	<?php
		//echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('1053');
		echo $this->Html->script('http://code.jquery.com/jquery-latest.min.js');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.7/jquery-ui.min.js');
		echo $this->Html->script('/js/colorbox-master/jquery.colorbox.js'); // JQuery for Lightboxes
		echo $this->Html->script('/js/qTip2-master/dist/jquery.qtip.js'); // Used for Calendar Pop Ups
		echo $this->Html->script('fontsize.js');
		echo $this->Html->script('platform.js');
		echo $this->Html->css('/js/colorbox-master/example1/colorbox');
		echo $this->Html->css('/js/qTip2-master/dist/jquery.qtip');

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
				<div class="why">
				<?php 
				/* Currently hardcoded to display the motivation module widget. In the future, this space should be
				 * editable from within the admin control panel.
				 */
				$widget = $this->requestAction('/motivation_module/motivation/dashboard_widget');
				echo $widget;
				?>
				</div>
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
	
</body>
</html>
