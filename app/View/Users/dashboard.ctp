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
 * @package       app.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
 $cakeDescription = __d('cake_dev', 'Champions for Health');
?>
<div class="modulesgrid">
	<p class="profilelink">
		<?php
			echo $this->Html->image(
				'heart-man-logo.gif', 
				array('alt' => 'Heart Logo',
    				'url' => array('controller' => 'users', 'action' => 'viewProfile')
					)
				);
			
			echo $this->Html->link(
				__d('cake_dev', ' My Profile >>'),
				array('controller' => 'users', 'action' => 'viewProfile'),
				array('class'=>'pad')
			);
		?>
	</p>
	<h2 class="bigred">My Challenge Dashboard</h2>
	<p>Intro text</p>
	<div class="modules">
		<h2><?php echo __('My modules'); ?></h2>
		<div class="news">
			<h3><?php echo __('My Module News and Updates'); ?></h3>
			<?php 
				if (count($user_modules) == 0) echo "<p>You currently have no news</p>";
				foreach ($user_modules as $module): 
					$modulename = strtolower($module['name']);
					$url = $modulename.'_module/'.$modulename.'s/dashboard_news';
					$newswidget = $this->requestAction($url); 
					if ($newswidget != "") echo $newswidget;
				endforeach; 
			?>
		</div>
		<?php 
			if (count($user_modules) == 0) echo "<p>You currently have no modules</p>"; 
			foreach ($user_modules as $module):
			$modulename = strtolower($module['name']);
			$url = $modulename.'_module/'.$modulename.'s/dashboard_widget';
			$widget = $this->requestAction($url); 
		?>
		<div class='module' id="<?php echo $modulename; ?>">
			<h3><?php echo h($module['name']); ?>&nbsp;</h3>
			<?php 
				echo $widget; 
				echo $this->Form->postLink(__('Explore module'), '/' . $modulename . '_module/'. $modulename .'s/explore_module'); 
			?>
		</div>
		<?php endforeach; ?>
	</div>
	<div class="modules">
		<h2><?php echo __('All available modules'); ?></h2>
		<div class="news">
			<h3><?php echo __('All News and Updates'); ?></h3>
			<?php 
				if (count($modules) == 0) echo "<p>There is not any news for modules</p>";
				foreach ($modules as $module):
					$modulename = strtolower($module['Module']['name']);
					$url = $modulename.'_module/'.$modulename.'s/dashboard_news';
					$newswidget = $this->requestAction($url); 
					if ($newswidget != "") echo $newswidget;
				endforeach; 
			?>
		</div>
		<?php 
			foreach ($modules as $module):
				$modulename = strtolower($module['Module']['name']);
				$url = $modulename.'_module/'.$modulename.'s/dashboard_widget';
				$widget = $this->requestAction($url); 
				?>
				<div class='module' id="<?php echo $modulename; ?>">
					<h3><?php echo h($module['Module']['name']); ?>&nbsp;</h3>
					<?php 
						echo $widget; 
						echo $this->Form->postLink(__('Explore module'), '/' . $modulename . '_module/'. $modulename .'s/explore_module'); 
					?>
				</div>
			<?php endforeach; 
		?>
		<p>&nbsp;</p>
	</div>
	</div>
<p style="clear:both;">&nbsp;</p>