<div class="module-title">
	<h1><?php echo $this->Html->image('/img/Actions-view-list-icons-icon.png', array('alt' => "Admin Panel - Modules icon", 'escape' => false, 'class'=> 'icon'));?>
Admin Panel - Add Module</h1>
</div>
<div class="modules form">
<?php 
if(empty($healthModuleList)) { ?>
	<h2>There are no health module plugins installed on this server that can be added to the site.</h2>
	<p>Please extract the new health module into the /app/Plugin directory and then try again.</p>
<?php } else {?>

	<table class="module-list">
					<?php
					foreach ($healthModuleList as $module): ?>
						<tr>
							<td style="width:15em;height:40px;vertical-align:middle;">
								<?php
								echo $this->Html->link(__('Add this module'), array('plugin' => Inflector::underscore($module['plugin']), 'controller' => Inflector::underscore($module['controllerName']), 'action' => 'explore_module', 'admin' => false), array('class' => 'button action', 'target' => '_self'));			
								?>
							</td>
							<td style="height:40px;vertical-align:middle;">
							<?php
							echo $this->Html->link(Inflector::humanize(Inflector::underscore($module['controllerName'])), array('plugin' => Inflector::underscore($module['plugin']), 'controller' => Inflector::underscore($module['controllerName']), 'action' => 'explore_module', 'admin' => false), array('target' => '_self', 'escape' => false));
							
							?>&nbsp;</td>
						</tr>
					<?php endforeach; ?>
				</table>
<?php }?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Modules'), array('action' => 'index')); ?></li>
	</ul>
</div>
