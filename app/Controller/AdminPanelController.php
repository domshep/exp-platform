<?php
App::uses('AppController', 'Controller');
/**
 * Admin Panel Controller
 */
class AdminPanelController extends AppController {
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		}
		
		$this->loadModel('User');
		$this->loadModel('News');
		$this->loadModel('Module');
		$this->loadModel('ModuleUser');
		
		// Load the numbers of users
		$totalUsers = $this->User->totalUsers();
		$totalAdminUsers = $this->User->totalAdminUsers();
		$this->set('totalUsers', $totalUsers);
		$this->set('totalAdminUsers', $totalAdminUsers);
	
		// Retrieve the list of active modules
		$activeModules = $this->Module->findAllByTypeAndActive('dashboard',1);
		$totalModuleInstances = $this->ModuleUser->find('count');
		$this->set('activeModules', $activeModules);
		$this->set('totalModuleInstances', $totalModuleInstances);
		
		// Load the total number of active Modules
		$totalWeeklyEntries = $this->Module->totalWeeklyEntries();
		$this->set('totalWeeklyEntries', $totalWeeklyEntries);
		
		// Load News Information
		$totalNews = $this->News->totalNewsArticles();
		$latestNews = $this->News->getLatestNews();
		$this->set('totalNews', $totalNews);
		$this->set('latestNews', $latestNews);
		
		$this->set('title_for_layout', 'Admin Panel'); 
	}	
}
?>