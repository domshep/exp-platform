<div class="module-title">
	<h1><?php echo $this->Html->image('/img/Actions-view-list-icons-icon.png', array('alt' => "Admin Panel - Modules icon", 'escape' => false, 'class'=> 'icon'));?>
Admin Panel - Add Module</h1>
</div>
<div class="modules form">
<?php 
if(empty($healthModuleList)) { ?>
	<h2>No health module plugins were found on this server that could be added to the website.</h2>
	<p>First install the new health module into the Plugin directory and then try again.</p>
<?php } else {?>
	<table class="module-list">
		<?php
		foreach ($healthModuleList as $module): ?>
			<tr>
				<td style="width:15em;height:40px;vertical-align:middle;">
					<?php
					echo $this->Html->link(__('Add this module'),
						array('action' => 'install',$module['plugin'],$module['controllerName']),
						array('class' => 'button action', 'target' => '_self')
					);			
					?>
				</td>
				<td style="height:40px;vertical-align:middle;">
					<?php
					echo $this->Html->link(
						Inflector::humanize(Inflector::underscore($module['plugin'])." - ".Inflector::underscore($module['controllerName'])),
						array('action' => 'install',$module['plugin'],$module['controllerName']),
						array('target' => '_self', 'escape' => false)
					);
					?>&nbsp;
				</td>
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
