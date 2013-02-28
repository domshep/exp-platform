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
	<h2 class="bigred">My Challenge Dashboard</h2>
	<p>[Insert Modules Grid Here...]</p>
</div>
<div class="widgetbox">
	<p class="profilelink">
		<?php
			echo $this->Html->image(
				'heart-man-logo.gif', 
				array('alt' => 'Heart Logo',
    				'url' => '/users'
					)
				);
			
			echo $this->Html->link(
				__d('cake_dev', ' My Profile >>'),
				'/users',
				array('class'=>'pad')
			);
		?>
	</p>
	<div class="widget">
		<p>[Insert Weekly Widgets Here...]</p>
	</div>
</div>