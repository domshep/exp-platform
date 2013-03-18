<?php
/**
 * SimpleHealthTestAchievementFixture
 *
 */
class SimpleHealthTestAchievementFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'healthy_days_last_week' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'total_days_healthy' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'total_full_weeks_healthy' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'user_id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'user_id' => 1,
			'healthy_days_last_week' => 1,
			'total_days_healthy' => 1,
			'total_full_weeks_healthy' => 1,
			'created' => '2013-03-18 12:09:18',
			'modified' => '2013-03-18 12:09:18'
		),
	);

}
