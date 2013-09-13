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
?>
	<div class="pull-right">
		<?php
			echo $this->Html->image(
				'Apps-system-users-icon.png', 
				array('alt' => 'Profile icon',
    				'url' => array('controller' => 'users', 'action' => 'viewProfile'),
					'style' => 'width:64px;margin-right:0.5em;'
					)
				);
			
			echo $this->Html->link(
				__d('cake_dev', ' My Profile >>'),
				array('plugin' => 'standard_profile_module', 'controller' => 'profile', 'action' => 'index'),
				array('class'=>'pad')
			);
		?>
	</div>
	<h1>My Challenge Dashboard</h1>
	
	
	<?php
		$mainnewswidget = $this->requestAction('/news/news_widget/limit:3');
		if ($mainnewswidget != "") { ?>
		<div class="news">
		<h3>
			<?php 
				echo $this->Html->link(__('News and Updates'), '/news/index', array('target' => '_self')); 
			?>
		</h3>
		<?php
			echo $mainnewswidget;
		?>
		</div>
		<?php } ?>
	
	<div class="row">
		<!--<div class="news">
			<h3><?php echo __('My Module News and Updates'); ?></h3>
			<?php 
				if (count($user['Module']) == 0) echo "<p>You currently have no news</p>";
				foreach ($user['Module'] as $module): 
					$newswidget = $this->requestAction($module['base_url'].'/dashboard_news'); 
					if ($newswidget != "") echo $newswidget;
				endforeach;
			?>
		</div>-->
		<?php 
			if (empty($userModules)) {?>
				<p>You don't currently have any health modules added to your dashboard. Why not explore some of the available modules listed below, and see if any of them are of interest...</p>
				<table class="module-list">
					<?php
					$modules = $this->requestAction('modules/list_all_explorable_modules');
					foreach ($modules as $module): ?>
						<tr>
							<td style="width:15em;height:40px;vertical-align:middle;">
								<?php
								echo $this->Html->link(__('Explore this module'), '/' . $module['Module']['base_url'] . '/explore_module', array('class' => 'button action', 'target' => '_self'));			
								?>
							</td>
							<td style="height:40px;vertical-align:middle;">
							<?php
							echo $this->Html->image($module['Module']['icon_url'], array('alt' => "&lsquo;".$module['Module']['name']."&rsquo; icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;', 'url'=> '/' . $module['Module']['base_url'] . '/explore_module'));
							echo $this->Html->link($module['Module']['name'], '/' . $module['Module']['base_url'] . '/explore_module', array('target' => '_self', 'escape' => false));
							
							?>&nbsp;</td>
						</tr>
					<?php endforeach; ?>
				</table>
			<?php
			} else {
				foreach ($userModules as $module):
					$widget = $this->requestAction($module['Modules']['base_url'].'/dashboard_widget'); 
					?>
					<div class="col-md-6">
					<div class='panel panel-primary' id="<?php echo $module['Modules']['name']; ?>">
						<div class="panel-heading">
   							<h3 class="panel-title">
   								<?php
   									echo $this->Html->image($module['Modules']['icon_url'], array('alt' => "&lsquo;".$module['Modules']['name']."&rsquo; icon", 'escape' => false, 'class'=> 'img-thumbnail', 'url' => '/'.$module['Modules']['base_url'].'/module_dashboard'));
									echo $this->Html->link($module['Modules']['name'], '/'.$module['Modules']['base_url'].'/module_dashboard',array('target' => '_self','escape' => false));
								?></h3>
						</div>
						<div class="panel-body">
						<?php 
							echo $widget; 
							echo $this->Html->link(__('My \'' . $module['Modules']['name'] . '\' dashboard'), '/'.$module['Modules']['base_url'].'/module_dashboard',array('class' => 'button action', 'target' => '_self', 'escape' => false)); 
						?>
						</div>
					</div>
					</div>
				<?php endforeach;
			}?>
	</div>
<p style="clear:both;">&nbsp;</p>