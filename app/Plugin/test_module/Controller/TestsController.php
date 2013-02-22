<?php
class TestsController extends TestModuleAppController {
/**
 * test_view method
 *
 * @throws NotFoundException
 * @return void
 */
	public function test_view() {
		$this->set('message', "Hello from the test module");
	}
}
?>