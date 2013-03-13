<?php
/**
 * ModulesUserFixture
 *
 */
class ModulesUserFixture extends CakeTestFixture {
	
	/**
	 * Import
	 *
	 * @var array
	 */
	public $import = array('table' => 'modules_users');
	
/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'user_id' => '1',
			'module_id' => '1',
			'position' => '1',
			'created' => '2013-03-01 00:00:00',
			'modified' => '2013-03-01 00:00:00'
		),
		array(
			'id' => '2',
			'user_id' => '2',
			'module_id' => '1',
			'position' => '1',
			'created' => '2013-03-01 00:00:00',
			'modified' => '2013-03-01 00:00:00'
		),
		array(
			'id' => '3',
			'user_id' => '4',
			'module_id' => '1',
			'position' => '1',
			'created' => '2013-03-01 00:00:00',
			'modified' => '2013-03-01 00:00:00'
		),
		array(
			'id' => '4',
			'user_id' => '1',
			'module_id' => '2',
			'position' => '2',
			'created' => '2013-03-08 10:54:04',
			'modified' => '2013-03-08 10:54:07'
		),
		array(
			'id' => '5',
			'user_id' => '2',
			'module_id' => '2',
			'position' => '2',
			'created' => '2013-03-08 11:25:35',
			'modified' => '2013-03-08 11:25:37'
		),
	);

}
