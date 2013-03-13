<?php
/**
 * UserFixture
 *
 */
class UserFixture extends CakeTestFixture {

/**
 * Import
 *
 * @var array
 */
	public $import = array('model' => 'User');

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'email' => 'andy@itsallnice-digital.co.uk',
			'password' => '27bf973165c423667ae19848570a56a28f9c4567',
			'role' => 'super-admin',
			'created' => '2013-02-22 22:46:20',
			'modified' => '2013-03-07 15:26:41'
		),
		array(
			'id' => '2',
			'email' => 'david.burton@doivedesigns.co.uk',
			'password' => '679f61ec0a883203ec173b54fd66275fefa0df71',
			'role' => 'super-admin',
			'created' => '2013-02-22 22:55:25',
			'modified' => '2013-02-22 22:55:25'
		),
		array(
			'id' => '3',
			'email' => 'test-admin@example.com',
			'password' => '27bf973165c423667ae19848570a56a28f9c4567',
			'role' => 'admin',
			'created' => '2013-02-22 22:57:01',
			'modified' => '2013-02-22 22:57:01'
		),
		array(
			'id' => '4',
			'email' => 'test-user@example.com',
			'password' => '27bf973165c423667ae19848570a56a28f9c4567',
			'role' => 'user',
			'created' => '2013-02-22 22:57:18',
			'modified' => '2013-02-22 22:57:18'
		),
	);

}
