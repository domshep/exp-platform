<?php
class TestsController extends TestModuleAppController implements ModulePlugin {
/**
 * test_view method
 *
 * @throws NotFoundException
 * @return void
 */
	public function test_view() {
		$this->set('message', "Hello from the " . $this->module_name());
	}
	
  public function module_name() {
  	return 'test module';
  }
  
  public function module_snapshot() {
  	return "Doing well - 8/10!";
  }
  
  public function explore_module() {
  	return "This is just a test module, while we work on the module interface";
  }
  
  public function add_module() {
  	return "This page will allow the user to add the module to their dashboard";
  }
  
  public function module_dashboard() {
  	return "This is the 'home page' for the module, and will display feedback on module progress, and links to data entry screens";
  }
  
  public function data_entry() {
  	return "This is the data entry page, allowing capture of daily, weekly or one-off achievements";
  }
  
  public function review_progress() {
  	return "This page will allow the logged-in user to review their progress against the module";
  }
}
?>