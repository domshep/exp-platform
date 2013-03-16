<?php
App::uses('User', 'Model');

/**
 * User Test Case
 *
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.profile',
		'app.module',
		'app.module_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

/**
 * testFindById method
 *
 * @return void
 */
	public function testFindFirstUser() {
		$result = $this->User->findById(1);
		$this->assertEquals(1, $result['User']['id']);
		$this->assertEquals('andy@itsallnice-digital.co.uk', $result['User']['email']);
		$this->assertEquals('1974-03-01', $result['Profile']['date_of_birth']);
		$this->assertEquals('1', $result['ModuleUser'][0]['position']);
	}
	
	/**
	 * testFindById method
	 *
	 * @return void
	 */
	public function testFindLastUser() {
		$result = $this->User->findById(4);
		$this->assertEquals(4, $result['User']['id']);
		$this->assertEquals('test-user@example.com', $result['User']['email']);
		$this->assertNull($result['Profile']['date_of_birth']);
		$this->assertEquals('1', $result['ModuleUser'][0]['position']);
	}
	
	/**
	 * testFindById method
	 *
	 * @return void
	 */
	public function testGetInvalidUser() {
		$result = $this->User->findById(5);
		
		$this->assertEmpty($result);
	}
	
	public function testAddModule() {
		$result = $this->User->addModule(1,3);
		$this->assertTrue($result);
	}
	
	public function testAddModuleAlreadyOnDashboard() {
		$result = $this->User->addModule(1,2);
		$this->assertFalse($result);
	}

}
