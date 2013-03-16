<?php
App::uses('SimpleHealthTestWeekly', 'ExampleModule.Model');

/**
 * SimpleHealthTestWeekly Test Case
 *
 */
class SimpleHealthTestWeeklyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.example_module.simple_health_test_weekly',
		'plugin.example_module.user',
		'plugin.example_module.profile',
		'plugin.example_module.module_user',
		'plugin.example_module.module'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SimpleHealthTestWeekly = ClassRegistry::init('ExampleModule.SimpleHealthTestWeekly');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SimpleHealthTestWeekly);

		parent::tearDown();
	}

}
