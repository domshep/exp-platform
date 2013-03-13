<?php
/**
 * ProfileFixture
 *
 */
class ProfileFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'profile';

/**
 * Import
 *
 * @var array
 */
	public $import = array('model' => 'Profile');

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '1',
			'user_id' => '1',
			'name' => 'Andy',
			'gender' => 'M',
			'date_of_birth' => '1974-03-01',
			'height_cm' => '170',
			'post_code' => 'CF14 9XX',
			'mobile_no' => '0747999999',
			'created' => '2013-03-02 09:45:04',
			'modified' => '2013-03-07 15:26:41'
		),
		array(
			'id' => '2',
			'user_id' => '2',
			'name' => 'Dave Burton',
			'gender' => 'M',
			'date_of_birth' => '1980-03-08',
			'height_cm' => '170',
			'post_code' => 'CF14 9XX',
			'mobile_no' => null,
			'created' => '2013-03-08 11:26:53',
			'modified' => '2013-03-08 11:26:55'
		),
	);

}
