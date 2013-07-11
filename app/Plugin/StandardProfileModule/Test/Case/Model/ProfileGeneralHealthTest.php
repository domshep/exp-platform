<?php
App::uses('ProfileGeneralHealth', 'StandardProfileModule.Model');

/**
 * ProfileGeneralHealth Test Case
 *
 */
class ProfileGeneralHealthTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.standard_profile_module.profile_general_health',
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
		$this->ProfileGeneralHealth = ClassRegistry::init('StandardProfileModule.ProfileGeneralHealth');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProfileGeneralHealth);

		parent::tearDown();
	}

}
