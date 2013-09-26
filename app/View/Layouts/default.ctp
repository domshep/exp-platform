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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
		//echo $this->Html->meta('icon');

		echo $this->Html->css('http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css');
		echo $this->Html->css('http://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-theme.min.css');
	
		//echo $this->Html->css('cake.generic');
		//echo $this->Html->css('1053');

		echo $this->Html->css('platform');
		echo $this->Html->script('http://code.jquery.com/jquery-latest.min.js');
		echo $this->Html->script('http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js');
		echo $this->Html->script('https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js');
		echo $this->Html->script('platform.js');
		echo $this->Html->css('http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div class="container wrapper" id="top">
		<div id="banner" class="row">
			<div class="col-xs-12 col-sm-12 col-md-8">
				<?php
					echo $this->Html->link(
    					$this->Html->image("/img/new-logo2.png", array("alt" => $cakeDescription, "class" => "img-responsive")),
    					"/",
    					array('escape' => false)
					);
				?>
			</div>
  			<div id="why" class="col-md-4 hidden-xs hidden-sm"><?php 
			/* Currently hardcoded to display the motivation module widget. In the future, this space should be
			 * editable from within the admin control panel.
			 */
			$widget = $this->requestAction('/motivation_module/motivation/dashboard_widget');
			echo $widget;
			?></div>
		</div>
		<nav class="navbar navbar-default" role="navigation">
  			<div class="navbar-header">
	    		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
	      		<span class="sr-only">Toggle navigation</span>
	      		<span class="icon-bar"></span>
	      		<span class="icon-bar"></span>
	      		<span class="icon-bar"></span>
	    		</button>
	    		<a class="navbar-brand visible-xs" href="#">Main menu</a>
  			</div>
			<div class="collapse navbar-collapse navbar-ex1-collapse">
			<?php 
        			echo $this->MenuBuilder->build('main-menu', array('class' => 'nav navbar-nav'));
        			echo $this->MenuBuilder->build('right-main-menu', array('class' => 'nav navbar-nav navbar-right'));
    			?>
    		</div>
		</nav>
		<div class="container">
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
		</div>
		<nav class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
	    		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex2-collapse">
	      		<span class="sr-only">Toggle navigation</span>
	      		<span class="icon-bar"></span>
	      		<span class="icon-bar"></span>
	      		<span class="icon-bar"></span>
	    		</button>
	    		<a class="navbar-brand visible-xs" href="#">Footer menu</a>
  			</div>
			<div class="navbar-collapse collapse navbar-ex2-collapse">
				<?php 
        			echo $this->MenuBuilder->build('footer-menu', array('class' => 'nav nav-justified'));
    			?>
    		</div>
    	</nav>
	</div>
	<?php //echo $this->element('sql_dump'); ?>
	
</body>
</html>