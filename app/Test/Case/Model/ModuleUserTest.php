<?php
App::uses('ModuleUser', 'Model');

/**
 * ModuleUser Test Case
 *
 */
class ModuleUserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.module_user',
		'app.user',
		'app.profile',
		'app.module'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ModuleUser = ClassRegistry::init('ModuleUser');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ModuleUser);

		parent::tearDown();
	}

/**
 * testGetModuleList method
 *
 * @return void
 */
	public function testGetModuleList() {
		$result = $this->ModuleUser->getModuleList(1);
		$this->assertEquals(2, count($result));
		$this->assertEquals(1, $result[0]['ModuleUser']['module_id']);
		$this->assertEquals(1, $result[0]['ModuleUser']['position']);
		$this->assertEquals('healthy_eating_module/five_a_day', $result[0]['Module']['base_url']);
	}

/**
 * testGetNextPosition method
 *
 * @return void
 */
	public function testGetNextPosition() {
		$result = $this->ModuleUser->getNextPosition(1);
		$this->assertEquals(3, $result);
		
		$result = $this->ModuleUser->getNextPosition(4);
		$this->assertEquals(2, $result);
	}

/**
 * testAlreadyOnDashboard method
 *
 * @return void
 */
	public function testAlreadyOnDashboard() {
		$result = $this->ModuleUser->alreadyOnDashboard(1,1);
		$this->assertEquals(true, $result);
		
		$result = $this->ModuleUser->alreadyOnDashboard(1,99);
		$this->assertEquals(false, $result);
		
		$result = $this->ModuleUser->alreadyOnDashboard(1,3);
		$this->assertEquals(false, $result);
	}

}
