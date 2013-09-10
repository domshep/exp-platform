<h1>Available health modules</h1>
<p class="lead">
	The initial platform has been based on the website developed for NHS
	Wales' <a href="http://www.championsforhealth.wales.nhs.uk">Champions
		for Health</a> campaign.
</p>
<p>It is expected that further health topic modules will be developed in
	the future, but the ones that are currently available via this test
	deployment are listed below.</p>
<div class="row top-buffer">
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
		<td><h4>
		<?php
		echo $this->Html->link($module['Module']['name'], '/' . $module['Module']['base_url'] . '/explore_module', array('target' => '_self', 'escape' => false));
		?>&nbsp;</h4></td>
		<td class="explore">
			<?php
			echo $this->Html->link(
				'<button class="btn btn-success btn-md">Explore this module</button>',
				'/' . $module['Module']['base_url'] . '/explore_module',
				array('escape' => FALSE)
			);
			?>
		</td>
	</tr>
	<?php endforeach; ?>
	</tbody>
</table>
</div>
</div>