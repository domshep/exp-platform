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
				if (count($user['Module']) == 0) echo "<p>You currently have no news</p>";
				foreach ($user['Module'] as $module): 
					$newswidget = $this->requestAction($module['base_url'].'/dashboard_news'); 
					if ($newswidget != "") echo $newswidget;
				endforeach;
			?>
		</div>
		<?php 
			if (count($user['Module']) == 0) echo "<p>You currently have no modules</p>"; 
			foreach ($user['Module'] as $module):
				$widget = $this->requestAction($module['base_url'].'/dashboard_widget'); 
		?>
		<div class='module' id="<?php echo $module['name']; ?>">
			<h3><?php echo $module['name']; ?>&nbsp;</h3>
			<?php 
				echo $widget; 
				echo $this->Form->postLink(__('Explore module'), '/'.$module['base_url'].'/explore_module'); 
			?>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<p style="clear:both;">&nbsp;</p>