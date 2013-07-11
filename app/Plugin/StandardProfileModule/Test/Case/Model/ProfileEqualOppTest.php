<?php
App::uses('ProfileEqualOpp', 'StandardProfileModule.Model');

/**
 * ProfileEqualOpp Test Case
 *
 */
class ProfileEqualOppTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.standard_profile_module.profile_equal_opp',
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
		$this->ProfileEqualOpp = ClassRegistry::init('StandardProfileModule.ProfileEqualOpp');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProfileEqualOpp);

		parent::tearDown();
	}

}
