<?php
/**
 * SimpleHealthTestScreener Test Case
 *
*/
class SimpleHealthTestScreenerTest extends CakeTestCase {

	/**
	 * Fixtures
	 *
	 * @var array
	 */
	public $fixtures = array(
			'plugin.example_module.simple_health_test_screener',
			'user',
			'profile',
			'module',
			'module_user'
	);

	/**
	 * setUp method
	 *
	 * @return void
	*/
	public function setUp() {
		parent::setUp();
		$this->SimpleHealthTestScreener = ClassRegistry::init('ExampleModule.SimpleHealthTestScreener');
	}

	/**
	 * tearDown method
	 *
	 * @return void
	 */
	public function tearDown() {
		unset($this->SimpleHealthTestScreener);

		parent::tearDown();
	}

	/**
	 * testCalculateScore method
	 *
	 * @return void
	 */
	public function testCalculateScoreHealthy() {
		$this->SimpleHealthTestScreener->create();
		$this->SimpleHealthTestScreener->set('healthy','Y');

		$result = $this->SimpleHealthTestScreener->calculateScore();

		$this->assertEquals(100, $result);
	}

	/**
	 * testCalculateScore method
	 *
	 * @return void
	 */
	public function testCalculateScoreUnhealthy() {
		$this->SimpleHealthTestScreener->create();
		$this->SimpleHealthTestScreener->set('healthy','N');

		$result = $this->SimpleHealthTestScreener->calculateScore();

		$this->assertEquals(99, $result);
	}

}
