<?php
/**
 * ModuleFixture
 *
 */
class ModuleFixture extends CakeTestFixture {

/**
 * Import
 *
 * @var array
 */
	public $import = array('model' => 'Module');

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'name' => 'Healthy Eating &ndash; &lsquo;5-a-day&rsquo;',
			'version' => '1',
			'type' => 'daily',
			'parent_id' => '0',
			'base_url' => 'healthy_eating_module/five_a_day',
			'icon_url' => 'healthy_eating_module/img/five_a_day/icon.png',
			'created' => '2013-03-11 00:00:00',
			'modified' => '2013-03-11 00:00:00'
		),
		array(
			'id' => '2',
			'name' => 'Dave&apos;s module',
			'version' => '1',
			'type' => 'daily',
			'parent_id' => '0',
			'base_url' => 'dave_module/daves',
			'icon_url' => 'dave_module/img/icon.png',
			'created' => '2013-03-08 10:01:31',
			'modified' => '2013-03-08 10:01:34'
		),
		array(
			'id' => '3',
			'name' => 'Test module',
			'version' => '1',
			'type' => 'weekly',
			'parent_id' => '0',
			'base_url' => 'test_module/tests',
			'icon_url' => 'test_module/img/icon.png',
			'created' => '2013-02-22 23:38:26',
			'modified' => '2013-02-22 23:38:26'
		),
	);

}
