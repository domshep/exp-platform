<?php
App::uses('AppController', 'Controller');
/**
 * Admin Panel Controller
 */
class AdminPanelController extends AppController {
	
	/**
 	* index method. Load information required for the admin panel.
 	*
 	* @return void
 	*/
	public function index() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		}
		
		// Load the required Models
		$this->loadModel('User');
		$this->loadModel('News');
		$this->loadModel('Module');
		$this->loadModel('ModuleUser');
		
		// Load the numbers of users
		$totalUsers = $this->User->find('count');
		$totalAdminUsers = $this->User->totalAdminUsers();
		$this->set('totalUsers', $totalUsers);
		$this->set('totalAdminUsers', $totalAdminUsers);
	
		// Retrieve the list of active modules
		$activeModules = $this->Module->findAllByTypeAndActive('dashboard',1);
		$totalModuleInstances = $this->ModuleUser->find('count');
		$this->set('activeModules', $activeModules);
		$this->set('totalModuleInstances', $totalModuleInstances);
		
		// Retrieve the total number of data records
		$totalDataRecords = 0;
		foreach ($activeModules as $module) {
			$totalDataRecords = $totalDataRecords + $this->requestAction($module['Module']['base_url'].'/total_data_records');
		}
		$this->set('totalDataRecords', $totalDataRecords);
		
		// Load News Information
		$totalNews = $this->News->find('count');
		$latestNews = $this->News->getLatestNews();
		$this->set('totalNews', $totalNews);
		$this->set('latestNews', $latestNews);
		
		$this->set('title_for_layout', 'Admin Panel'); 
	}
	
	/**
 	* module data. Finds the "admin_module_data" function from the module and displays it
 	* @param unknown $moduleId
 	* @return void
	* If module not found throws not found exception.
 	*/
	public function module_data($moduleId = null) {
		// redirect to module dashboard if not admin.
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		}
		
		// Load the Module
		$this->loadModel('Module');
		$module = $this->Module->findById($moduleId);
		
		if(empty($module)) {
			throw new NotFoundException("The module with id ".$moduleId." was not found");
		}
		$this->set('module', $module);
	}
}
?>