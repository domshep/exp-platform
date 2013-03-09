<?php
class DavesController extends DaveModuleAppController implements ModulePlugin {
/**
 * test_view method
 *
 * @throws NotFoundException
 * @return void
 */

	public function beforeRender() {
		$this->set('module_name', $this->_module_name());
	}
	
	public function dashboard_widget() {
		// Don't allow this method to be called directly from a URL
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
		$this->set('message', "Hello from the " . $this->_module_name());
		$this->render();
	}
	
	public function dashboard_news() {
		$this->set('message', "News from the " . $this->_module_name());
		$this->render();
  		return '<p>this is my news</p>';
	}
	
  public function _module_name() {
  	return 'Dave&apos;s module';
  }
  
  public function explore_module() {
  	$this->set('message', "This is just a test module, while we work on the module interface");
  }
  
  public function add_module() {
  	$this->set('message', "This page will allow the user to add the module to their dashboard - perhaps asking them to complete an initial survey first...");
  }
  
  public function module_dashboard() {
  	$this->set('message', "This is the 'home page' for the module, and will display feedback on module progress, and links to data entry screens");
  }
  
  public function data_entry() {
  	$this->set('message', "This is the data entry page, allowing capture of daily, weekly or one-off achievements");
  }
  
  public function review_progress() {
  	return "This page will allow the logged-in user to review their progress against the module";
  }
}
?>