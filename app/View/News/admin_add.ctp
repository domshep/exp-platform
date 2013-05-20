<div class="module-title">
	<h1><?php echo $this->Html->image('/img/Mimetypes-message-news-icon.png', array('alt' => "Admin Panel News icon", 'escape' => false, 'class'=> 'icon'));?>
Admin Panel - New News</h1>
</div>
<div class="newsadmin form">
<?php echo $this->Form->create('News'); ?>
	<fieldset>
		<?php
			echo $this->Form->input('headline');
			echo $this->Form->textarea('article', array('rows' => '5', 'cols' => '20', 'label' => 'true'));
		?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('News list'), '/admin/news'); ?></li>
		<li><?php echo $this->Html->link(__('Admin panel'), '/admin_panel'); ?></li>
	</ul>
</div>
