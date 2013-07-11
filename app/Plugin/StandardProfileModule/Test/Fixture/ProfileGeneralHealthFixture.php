<?php
/**
 * ProfileGeneralHealthFixture
 *
 */
class ProfileGeneralHealthFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'profile_general_health';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'general_health' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1),
		'nervous' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1),
		'worrying' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1),
		'little_interest' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1),
		'feeling_down' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1),
		'supervisor' => array('type' => 'boolean', 'null' => true, 'default' => null),
		'occupation' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 50, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'sickness_absence' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1),
		'sickness_absence_spells' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1),
		'work_performance' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 1),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
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
			'id' => 1,
			'user_id' => 1,
			'general_health' => 1,
			'nervous' => 1,
			'worrying' => 1,
			'little_interest' => 1,
			'feeling_down' => 1,
			'supervisor' => 1,
			'occupation' => 'Lorem ipsum dolor sit amet',
			'sickness_absence' => 1,
			'sickness_absence_spells' => 1,
			'work_performance' => 1,
			'created' => '2013-07-10 12:29:06',
			'modified' => '2013-07-10 12:29:06'
		),
	);

}
