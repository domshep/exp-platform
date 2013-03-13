<?php
/**
 * TestScreenerFixture
 *
 */
class TestScreenerFixture extends CakeTestFixture {

/**
 * Import
 *
 * @var array
 */
	public $import = array('table' => 'test_screeners');

	/**
	 * Records
	 *
	 * @var array
	 */
	public $records = array(
			array(
					'id' => '1',
					'user_id' => '1',
					'healthy' => 'Y',
					'score' => '100',
					'created' => '2013-02-22 22:46:20',
					'modified' => '2013-03-07 15:26:41'
			),
			array(
					'id' => '2',
					'user_id' => '2',
					'healthy' => 'N',
					'score' => '99',
					'created' => '2013-02-22 22:46:20',
					'modified' => '2013-03-07 15:26:41'
			),
	);
}
