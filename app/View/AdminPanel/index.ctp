<div class="modulesgrid">
	<div class="module-title">
	<h1><?php echo $this->Html->image('/img/Categories-applications-system-icon.png', array('alt' => "Admin Panel icon", 'escape' => false, 'class'=> 'icon'));?>
Admin Panel</h1>
	</div>
	<div class="module-content">
	<div class="modulesgrid">
	<div class="modules">
		<div class='module' id="users">
			<h3><?php 
				echo $this->Html->image('/img/Apps-system-users-icon.png', array('alt' => "Users icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;', 'url' => '/admin/users'));
				?> <strong><?php echo $this->Html->link("Users", '/admin/users',array('target' => '_self','escape' => false)); ?></strong>&nbsp;</h3>
				<p><strong>Number of registered users:</strong> <?php echo $totalUsers; ?></p>
				<p><strong>Number of admin users:</strong> <?php echo $totalAdminUsers; ?></p>
				<?php 
					echo $this->Html->link(__('Add new user'), '/admin/users/add',array('class' => 'button action', 'target' => '_self', 'escape' => false)); 
					echo $this->Html->link(__('View and export user list'), '/admin/users',array('class' => 'button action', 'target' => '_self', 'escape' => false)); 
				?>
		</div>
		
		<div class='module' id="mods">
			<h3><?php 
				echo $this->Html->image('/img/test-tube.png', array('alt' => "Users icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;', 'url' => '/admin/modules'));
				?> <strong><?php echo $this->Html->link("Modules", '/admin/modules',array('target' => '_self','escape' => false)); ?></strong>&nbsp;</h3>
				<p><strong>Number of active dashboard modules:</strong> <?php echo count($activeModules); ?></p>
				<p><strong>Number of modules added to user dashboards:</strong> <?php echo $totalModuleInstances; ?></p>
				<?php 
					echo $this->Html->link(__('Activate Module'), '/admin/modules/add',array('class' => 'button action', 'target' => '_self', 'escape' => false)); 
					echo $this->Html->link(__('View Module List'), '/admin/modules/index',array('class' => 'button action', 'target' => '_self', 'escape' => false)); 
				?>
		</div>
		
		<div class='module' id="progress">
			<h3><?php 
				echo $this->Html->image('/img/test-tube.png', array('alt' => "Progress icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;', 'url' => '/admin/modules/progress'));
				?> <strong><?php echo $this->Html->link("Progress", '/admin/modules/progress',array('target' => '_self','escape' => false)); ?></strong>&nbsp;</h3>
				<p>Number of Weekly Records Created: <?php echo $totalWeeklyEntries; ?></p>
				<?php 
					// echo $this->Html->link(__('View and Access Progress Data'), '/admin/modules/progress_list',array('class' => 'button action', 'target' => '_self', 'escape' => false)); 
				?>
		</div>
		
		<div class='module' id="news">
			<h3><?php 
				echo $this->Html->image('/img/test-tube.png', array('alt' => "News icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;', 'url' => '/admin/news/index'));
				?> <strong><?php echo $this->Html->link("News", '/admin/news/index',array('target' => '_self','escape' => false)); ?></strong>&nbsp;</h3>
				<p>Number of News Articles: <?php echo $totalNews; ?></p>
				<?php 
				if ($totalNews > 0) 
				{
					$viewNewsURL = "/news/view/" . $latestNews['News']['id'];
					
					echo "<p>Latest News Article:"; 
					echo $this->Html->link($latestNews['News']['headline'],$viewNewsURL,array('target' => '_self','escape' => false)); 
					echo "</p>"; 
				} 
				echo $this->Html->link(__('News Admin'), '/admin/news/index',array('class' => 'button action', 'target' => '_self', 'escape' => false)); 
				?>
		</div>
	</div>
	</div>
	</div>
</div>
<p style="clear:both;">&nbsp;</p>