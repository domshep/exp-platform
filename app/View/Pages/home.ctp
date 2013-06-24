<h1>Experimental Platform for Health Promotion - version 0.5</h1>
<p>This web-tool is an under-development 'experimental platform',
	intended to provide a platform for the preliminary development and
	testing of interactive health topic modules.</p>
<p>
	<strong>Please note that this version has been classed as a 'beta'
		release. This release is intended primarily for feedback on the
		website, and any data you record may be deleted by future releases.</strong>
</p>
<p>
	The initial platform has been based on the website developed for NHS
	Wales' <a href="http://www.championsforhealth.wales.nhs.uk">Champions
		for Health</a> campaign.
</p>
<p>It is expected that further health topic modules will be developed in
	the future, but the ones that are currently available via this test
	deployment are listed below.</p>
<hr />
<h2>Available health modules</h2>
<table class="module-list">
	<?php $modules = $this->requestAction('modules/list_all_explorable_modules'); ?>
	<?php foreach ($modules as $module): ?>
	<tr>
		<td style="width: 15em; height: 40px; vertical-align: middle;"><?php
		echo $this->Html->link(__('Explore this module'), '/' . $module['Module']['base_url'] . '/explore_module', array('class' => 'button action', 'target' => '_self'));
		?>
		</td>
		<td style="height: 40px; vertical-align: middle;"><?php
		echo $this->Html->image($module['Module']['icon_url'], array('alt' => "&lsquo;".$module['Module']['name']."&rsquo; icon", 'escape' => false, 'class'=> 'small-icon', 'style'=>'vertical-align:middle;', 'url'=> '/' . $module['Module']['base_url'] . '/explore_module'));
		echo $this->Html->link($module['Module']['name'], '/' . $module['Module']['base_url'] . '/explore_module', array('target' => '_self', 'escape' => false));
		?>&nbsp;</td>
	</tr>
	<?php endforeach; ?>
</table>
