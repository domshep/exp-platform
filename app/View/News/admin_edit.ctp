<div class="module-title">
	<h1><?php echo $this->Html->image('/img/Mimetypes-message-news-icon.png', array('alt' => "Admin Panel news icon", 'escape' => false, 'class'=> 'icon'));?>
Admin Panel - Edit News</h1>
</div>
<div class="newsadmin form">
<?php echo $this->Form->create('News'); ?>
	<fieldset>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('headline');
		echo $this->Form->textarea('article', array('cols' => '25', 'rows' => '5'));
	?>
	</fieldset>
<div class="submit">
         <?php echo $this->Form->submit(__('Cancel (without saving changes)', true), array('name' => 'cancel','div' => false, 'id' =>'cancel')); ?>
         <?php echo $this->Form->submit(__('Submit', true), array('name' => 'ok', 'div' => false, 'id' =>'submit')); ?>
</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete news'), array('action' => 'delete', $this->Form->value('News.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('News.id'))); ?></li>
		<li><?php echo $this->Html->link(__('News list'), '/admin/news'); ?></li>
		<li><?php echo $this->Html->link(__('Admin panel'), '/admin_panel'); ?></li>
	</ul>
</div>
