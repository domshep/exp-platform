<?php
App::uses('Module', 'Model');

/**
 * Module Test Case
 *
 */
class ModuleTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.module'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Module = ClassRegistry::init('Module');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Module);

		parent::tearDown();
	}

}
