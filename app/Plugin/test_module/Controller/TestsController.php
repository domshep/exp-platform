<?php
class TestsController extends TestModuleAppController implements ModulePlugin {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('explore_module'); // Let anyone explore the module, whether they're logged in or not.
	}
	
/**
 * test_view method
 *
 * @throws NotFoundException
 * @return void
 */
	public function test_view() {
		$this->set('message', "Hello from the " . $this->module_name());
	}
	
	public function dashboard_widget() {
		$this->set('message', "Hello from the " . $this->module_name());
  		$this->set('module_name', $this->module_name());
	}
	
	public function dashboard_news() {
		$this->set('message', "News from the " . $this->module_name());
		$this->render();
	}
	
  public function module_name() {
  	return 'test module';
  }
  
  public function module_snapshot() {
  	return "Doing well - 8/10!";
  }
  
  public function explore_module() {
  	$this->set('message', "This is just a test module, while we work on the module interface");
  	$this->set('module_name', $this->module_name());
  }
  
  public function add_module() {
  	$this->set('message', "This page will allow the user to add the module to their dashboard - perhaps asking them to complete an initial survey first...");
  	$this->set('module_name', $this->module_name());
  }
  
  public function screener() {
  	$this->loadModel('TestModule.FiveadayScreener');
  	$this->set('module_name', $this->module_name());
  	
  	if ($this->request->is('post')) {
		$this->FiveadayScreener->create();
		$this->FiveadayScreener->set($this->request->data);
		if ($this->FiveadayScreener->validates()) {
			if(isset($this->request->data['FiveadayScreener']['score'])) {
				$score = $this->FiveadayScreener->calculateScore();
				$this->FiveadayScreener->save();
				$this->redirect('module_added');
			} else {
				$score = $this->FiveadayScreener->calculateScore();
				$this->set('score', $score);
				$this->FiveadayScreener->set('score', "".$score);
				$this->set($this->FiveadayScreener->data);
				$this->render('score');
			}
		} else {
			$this->Session->setFlash(__('Your score could not be calculated - see the error messages below. Please, try again.'));
			$this->render('screener');
		}
	}
  }
  
  public function module_added() {
  	$this->set('message', "The healthy eating module has now been added to your dashboard.");
  	$this->set('module_name', $this->module_name());
  }
  
  public function module_dashboard() {
  	$this->set('message', "This is the 'home page' for the module, and will display feedback on module progress, and links to data entry screens");
  	$this->set('module_name', $this->module_name());
  }
  
  public function data_entry() {
  	$this->set('message', "This is the data entry page, allowing capture of daily, weekly or one-off achievements");
  	$this->set('module_name', $this->module_name());
  }
  
  public function review_progress() {
  	return "This page will allow the logged-in user to review their progress against the module";
  }
}
?>