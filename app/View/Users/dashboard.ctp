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
<?php 
	if (empty($userModules)) {?>
		<div class="col-md-12">
			<p class="lead">You don't currently have any health modules added to your dashboard. Why not explore some of the available modules listed below, and see if any of them are of interest...</p>
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<table class="table table-striped module-list">
						<tbody>
						<?php $modules = $this->requestAction('modules/list_all_explorable_modules'); ?>
						<?php foreach ($modules as $module): ?>
						<tr>
							<td class="icon"><?php
								echo $this->Html->image($module['Module']['icon_url'], array('alt' => "&lsquo;".$module['Module']['name']."&rsquo; icon", 'escape' => false, 'class'=> 'img-thumbnail', 'url'=> '/' . $module['Module']['base_url'] . '/explore_module'));
								?>
							</td>
							<td>
								<h4>
								<?php
								echo $this->Html->link($module['Module']['name'], '/' . $module['Module']['base_url'] . '/explore_module', array('target' => '_self', 'escape' => false));
								?>&nbsp;</h4>
							</td>
							<td class="explore">
								<?php
								echo $this->Html->link(
									'Explore this module',
									'/' . $module['Module']['base_url'] . '/explore_module',
									array('class' => 'btn btn-success btn-md')
								);
								?>
							</td>
						</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	<?php
	} else {
		foreach ($userModules as $module):
			$widget = $this->requestAction($module['Modules']['base_url'].'/dashboard_widget'); 
			?>
			<div class="col-md-6">
				<div class='panel panel-primary' id="<?php echo Inflector::slug($module['Modules']['name']); ?>">
					<div class="panel-heading">
   						<h3 class="panel-title">
   						<?php
   							echo $this->Html->image($module['Modules']['icon_url'], array('alt' => "&lsquo;".$module['Modules']['name']."&rsquo; icon", 'escape' => false, 'class'=> 'img-thumbnail', 'url' => '/'.$module['Modules']['base_url'].'/module_dashboard'));
							echo $this->Html->link($module['Modules']['name'], '/'.$module['Modules']['base_url'].'/module_dashboard',array('target' => '_self','escape' => false));
						?>
						</h3>
					</div>
					<div class="panel-body">
					<?php 
						echo $widget; 
					?>
					</div>
					<div class="panel-footer">
					<?php 
						echo $this->Html->link(__('<span class="glyphicon glyphicon-th-large"></span> Go to my \'' . $module['Modules']['name'] . '\' dashboard'), '/'.$module['Modules']['base_url'].'/module_dashboard',array('target' => '_self', 'escape' => false)); 
					?>
					</div>
				</div>
			</div>
		<?php endforeach;
	}
?>
</div>
