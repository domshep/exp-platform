<?php
App::uses('SimpleHealthTestAchievement', 'ExampleModule.Model');

/**
 * SimpleHealthTestAchievement Test Case
 *
 */
class SimpleHealthTestAchievementTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.example_module.simple_health_test_achievement'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SimpleHealthTestAchievement = ClassRegistry::init('ExampleModule.SimpleHealthTestAchievement');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SimpleHealthTestAchievement);

		parent::tearDown();
	}

}
