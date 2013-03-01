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

$cakeDescription = __d('cake_dev', 'Champions for Health');
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
				<div class="latesttweets">Insert Top Module Here</div>
				<h1><?php echo $this->Html->link($cakeDescription, '/'); ?></span></h1>
			</div>
			<div id="navsearch">
				<p id="navigation"><span>Get the latest Champions for Health News</span>
				<?php 
					if ($is_logged_in) {
						echo $this->Html->link("Log Out", '/users/logout');
					}?></p>
			</div>
			<div id="content">
				<?php echo $this->Session->flash(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
			<div id="footer">
				<ul>
					<li><?php 
							echo $this->Html->link("Accessibility",
								'#'
							);
						?> |&nbsp;
					</li>
                    <li><?php 
							echo $this->Html->link("Terms of Use",
								'#'
							);
						?> |&nbsp;</li>
					<li><?php 
							echo $this->Html->link("Back to top",
								'#top'
							);
						?> |&nbsp;</li>	
					<li><?php 
							echo $this->Html->link("Privacy Statement",
								'#'
							);
						?> </li><!-- |&nbsp;
					<li>Designed by 
						<?php 
							echo $this->Html->link("It's All Good - Digital",
								'http://www.itsallgooddigital.co.uk',
								array('target' => '_blank', 'escape' => false)
							);
						?> for NHS Wales</li>-->
            	</ul>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
