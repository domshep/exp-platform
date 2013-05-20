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
				echo $this->Html->image('/img/Actions-view-list-icons-icon.png', array('alt' => "Modules icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;', 'url' => '/admin/modules'));
				?> <strong><?php echo $this->Html->link("Modules", '/admin/modules',array('target' => '_self','escape' => false)); ?></strong>&nbsp;</h3>
				<p><strong>Number of active dashboard modules:</strong> <?php echo count($activeModules); ?></p>
				<p><strong>Number of modules added to user dashboards:</strong> <?php echo $totalModuleInstances; ?></p>
				<p><strong>Number of health data records submitted:</strong> <?php echo $totalDataRecords; ?></p>
				<?php 
					echo $this->Html->link(__('Activate module'), '/admin/modules/add',array('class' => 'button action', 'target' => '_self', 'escape' => false)); 
					echo $this->Html->link(__('View module list'), '/admin/modules',array('class' => 'button action', 'target' => '_self', 'escape' => false)); 
				?>
		</div>
		
		<div class='module' id="news">
			<h3><?php 
				echo $this->Html->image('/img/Mimetypes-message-news-icon.png', array('alt' => "News icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;', 'url' => '/admin/news/index'));
				?> <strong><?php echo $this->Html->link("News", '/admin/news',array('target' => '_self','escape' => false)); ?></strong>&nbsp;</h3>
				<p><strong>Number of news articles:</strong> <?php echo $totalNews; ?></p>
				<?php 
				if ($totalNews > 0) 
				{
				?>
					<p><strong>Latest news article:</strong>  
				<?php
					echo $this->Html->link($latestNews['News']['headline'],array('controller' => 'news', 'action' => 'view', 'admin' => 'true', $latestNews['News']['id']),array('target' => '_self','escape' => false)); 
				?>
					</p>
				<?php 
				} 
				echo $this->Html->link(__('View news list'), '/admin/news',array('class' => 'button action', 'target' => '_self', 'escape' => false)); 
				?>
		</div>
	</div>
	</div>
	</div>
</div>
<p style="clear:both;">&nbsp;</p>