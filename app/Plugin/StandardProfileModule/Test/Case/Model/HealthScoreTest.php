<?php
App::uses('HealthScore', 'StandardProfileModule.Model');

/**
 * HealthScore Test Case
 *
 */
class HealthScoreTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.standard_profile_module.health_score',
		'plugin.standard_profile_module.user',
		'plugin.standard_profile_module.profile',
		'plugin.standard_profile_module.module_user',
		'plugin.standard_profile_module.module'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->HealthScore = ClassRegistry::init('StandardProfileModule.HealthScore');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->HealthScore);

		parent::tearDown();
	}

}
