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
	<h2 class="bigred">Home</h2>
	<p>[Insert Page Intro Here...]</p>
	<table cellpadding="0" cellspacing="0">
	<?php $modules = $this->requestAction('modules/list_all_explorable_modules'); ?>
	<?php foreach ($modules as $module): ?>
	<tr>
		<td><?php echo h($module['Module']['name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Form->postLink(__('About this module'), '/' . $module['Module']['name'] . '_module/tests/explore_module'); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
<div class="widgetbox">
	<p class="profilelink">
		<?php
			echo $this->Html->link(
				__d('cake_dev', ' Sign Up >>'),
				'/users/register',
				array('class'=>'pad')
			);
			
			echo $this->Html->link(
				__d('cake_dev', ' Log In >>'),
				'/users/login',
				array('class'=>'pad')
			);
		?>
	</p>
	<div class="widget">
		<p>[Insert More Info here...]</p>
	</div>
</div>