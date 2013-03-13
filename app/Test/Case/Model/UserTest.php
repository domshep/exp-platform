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
		'app.modules_user'
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
 * testGetUser method
 *
 * @return void
 */
	public function testGetFirstUser() {
		$result = $this->User->getUser(1);
		
		$this->assertEquals(1, $result['User']['id']);
		$this->assertEquals('andy@itsallnice-digital.co.uk', $result['User']['email']);
		$this->assertEquals('1974-03-01', $result['Profile']['date_of_birth']);
		$this->assertEquals('Healthy Eating &ndash; &lsquo;5-a-day&rsquo;', $result['Module'][0]['name']);
		$this->assertEquals('1', $result['Module'][0]['ModulesUser']['position']);
	}
	
	/**
	 * testGetUser method
	 *
	 * @return void
	 */
	public function testGetLastUser() {
		$result = $this->User->getUser(4);
		$this->assertEquals(4, $result['User']['id']);
		$this->assertEquals('test-user@example.com', $result['User']['email']);
		$this->assertNull($result['Profile']['date_of_birth']);
		$this->assertEquals('Healthy Eating &ndash; &lsquo;5-a-day&rsquo;', $result['Module'][0]['name']);
		$this->assertEquals('1', $result['Module'][0]['ModulesUser']['position']);
	}
	
	/**
	 * testGetUser method
	 *
	 * @return void
	 */
	public function testGetInvalidUser() {
		$result = $this->User->getUser(5);
		
		$this->assertEmpty($result);
	}

}
