<?php
App::uses('TestScreener', 'TestModule.Model');

/**
 * TestScreener Test Case
 *
*/
class TestScreenerTest extends CakeTestCase {

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array(
			'plugin.test_module.test_screener',
			'plugin.test_module.user',
			'plugin.test_module.profile',
			'plugin.test_module.module',
			'plugin.test_module.modules_user'
	);

	/**
	 * setUp method
	 *
	 * @return void
	*/
	public function setUp() {
		parent::setUp();
		$this->TestScreener = ClassRegistry::init('TestModule.TestScreener');
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->TestScreener);

		parent::tearDown();
	}

	/**
	 * testCalculateScore method
	 *
	 * @return void
	 */
	public function testCalculateScoreHealthy() {
		$this->TestScreener->create();
		$this->TestScreener->set('healthy','Y');

		$result = $this->TestScreener->calculateScore();

		$this->assertEquals(100, $result);
	}

	/**
	 * testCalculateScore method
	 *
	 * @return void
	 */
	public function testCalculateScoreUnhealthy() {
		$this->TestScreener->create();
		$this->TestScreener->set('healthy','N');

		$result = $this->TestScreener->calculateScore();

		$this->assertEquals(99, $result);
	}

}
