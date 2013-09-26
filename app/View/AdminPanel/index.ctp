<h1 class="module-title"><?php echo $this->Html->image('/img/Categories-applications-system-icon.png', array('alt' => "Admin Panel icon", 'escape' => false, 'class'=> 'img-thumbnail'));?>
Admin Panel</h1>
<div class="row">
	<div class="col-md-6">
		<div class='panel panel-primary achievements'>
		<div class="panel-heading">
			<h3 class="panel-title"><?php 
				echo $this->Html->image('/img/Apps-system-users-icon.png', array('alt' => "Users icon", 'escape' => false, 'class'=> 'img-thumbnail', 'url' => '/admin/users'));
				echo $this->Html->link("Users", '/admin/users',array('target' => '_self','escape' => false)); ?>
			</h3>
		</div>
		<div class="panel-body">
			<ul class="list-group">
  				<li class="list-group-item">
					Number of registered users:
					<span class="label label-primary pull-right"><?php echo $totalUsers; ?></span>
				</li>
				<li class="list-group-item">
					Number of admin users:
					<span class="label label-primary pull-right"><?php echo $totalAdminUsers; ?></span>
				</li>
			</ul>
			<?php
				echo $this->Html->link(__('Add new user <span class="glyphicon glyphicon-plus"></span>'), '/admin/users/add',array('class' => 'btn btn-success btn-md pull-right', 'target' => '_self', 'escape' => false)); 
			?>
		</div>
		<div class="panel-footer">
			<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-user"></span> View and export user list'), '/admin/users',array('escape' => false)); ?>
		</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class='panel panel-primary achievements'>
		<div class="panel-heading">
			<h3 class="panel-title"><?php 
				echo $this->Html->image('/img/Actions-view-list-icons-icon.png', array('alt' => "Modules icon", 'escape' => false, 'class'=> 'img-thumbnail', 'url' => '/admin/modules'));
				echo $this->Html->link("Modules", '/admin/modules',array('target' => '_self','escape' => false)); ?>
			</h3>
		</div>
		<div class="panel-body">
			<ul class="list-group">
  				<li class="list-group-item">
					Number of active dashboard modules:
					<span class="label label-primary pull-right"><?php echo count($activeModules); ?></span>
				</li>
				<li class="list-group-item">
					Number of modules added to user dashboards:
					<span class="label label-primary pull-right"><?php echo $totalModuleInstances; ?></span>
				</li>
				<li class="list-group-item">
					Number of health data records submitted:
					<span class="label label-primary pull-right"><?php echo $totalDataRecords; ?></span>
				</li>
			</ul>
			<?php 
				echo $this->Html->link(__('Activate module <span class="glyphicon glyphicon-plus"></span>'), '/admin/modules/add',array('class' => 'btn btn-success btn-md pull-right', 'target' => '_self', 'escape' => false)); 
			?>
		</div>
		<div class="panel-footer">
			<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-th-large"></span> View module list'), '/admin/modules',array('escape' => false)); ?>
		</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class='panel panel-primary achievements'>
		<div class="panel-heading">
			<h3 class="panel-title"><?php 
				echo $this->Html->image('/img/Mimetypes-message-news-icon.png', array('alt' => "News icon", 'escape' => false, 'class'=> 'img-thumbnail', 'url' => '/admin/news/index'));
				echo $this->Html->link("News", '/admin/news',array('target' => '_self','escape' => false)); ?>
			</h3>
		</div>
		<div class="panel-body">
			<ul class="list-group">
  				<li class="list-group-item">
  					Number of news articles:
					<span class="label label-primary pull-right"><?php echo $totalNews; ?></span>
				</li>
			</ul>
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
			?>
		</div>
		<div class="panel-footer">
			<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span> View news list'), '/admin/news',array('escape' => false)); ?>
		</div>
		</div>
	</div>
</div>
			