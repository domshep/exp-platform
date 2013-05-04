<?php
class MotivationController extends MotivationModuleAppController implements ModulePlugin {
	public $components = array('RequestHandler');

	public $module_name = 'Why am I doing this?';
	public $base_url = 'motivation_module/motivation';
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('explore_module', 'dashboard_widget'); // Let anyone explore the module, whether they're logged in or not.
	}
	
	public function beforeRender() {
		parent::beforeRender();
		$this->set('module_name', $this->_module_name());
		$this->set('module_icon_url', $this->_module_icon_url());
	}

	/**
	 * Default index function for the module. If the module is on the user's dashboard, then they are
	 * automatically redirected to the module dashboard. Otherwise, they're redirected to the 'explore_module' view.
	 */
	public function index() {
		$this->loadModel('ModuleUser');
		$this->loadModel('Module');
			
		$addedToDashboard = $this->ModuleUser->alreadyOnDashboard(
				$this->Auth->user('id'),
				$this->Module->getModuleID($this->_module_name()));
	
		if($addedToDashboard) {
			return $this->redirect('module_dashboard');
		} else {
			return $this->redirect('explore_module');
		}
	}
	
	public function dashboard_widget() {
		$this->loadModel('MotivationModule.MotivationScreener');
		 
		// Don't allow this method to be called directly from a URL
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
		
		$motivation = $this->MotivationScreener->findByUserId($this->Auth->user('id'));
		$this->set('motivation', $motivation);
		$this->render();
	}
	
	public function dashboard_news() {
		// Don't allow this method to be called directly from a URL
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
	}

	/**
	 * Returns the public name of the module.
	 * 
	 * @return string
	 */
 	public function _module_name() {
  		return $this->module_name;
  	}
  	
  	/**
  	 * Returns the base URL for this module.
  	 *
  	 * @return string
  	 */
  	public function _module_base_url() {
  		return $this->base_url;
  	}

  	/**
  	 * Returns the path to the icon for this module.
  	 *
  	 * @return string
  	 */
  	public function _module_icon_url() {
  		return '/motivation_module/img/icon.png';
  	}
  	
  	/**
  	 * Initial landing screen for finding out what the module is about. This is the first
  	 * page that a non-logged in user will see when they arrive in the module.
  	 */
 	public function explore_module() {
 		return $this->redirect('screener');
 	}

 	/**
 	 * Initial landing screen for the process of a logged-in user adding the module to their
 	 * dashboard.
 	 */
 	public function add_module() {
 		return $this->redirect('screener');
 	}
  
	/**
	 * Handles the submission, validation of the screener page. Initial post (which will not
	 * contain a score) redirects the user to the 'score' view. (The original form-entered data
	 * is hidden on the score page).
	 * 
	 * If the user then submits the 'score' form (by choosing to add the module to their dashboard)
	 * then the post will contain a score, and the screener submission will be saved to the
	 * database.
	 */
	public function screener() 
	{
  		$this->loadModel('MotivationModule.MotivationScreener');
  		$this->loadModel('User');
  		$this->loadModel('Module');
		
		$this->set('title_for_layout', $this->_module_name());
		
	  	if ($this->request->is('post') || $this->request->is('put')) 
		{
	  		$this->MotivationScreener->create();
	  		$this->MotivationScreener->set($this->request->data);
	  		
			// Get user id from current user session, rather than from form
			$currentUser = $this->User->findById($this->Auth->user('id'));
			$this->MotivationScreener->set('user_id', $currentUser['User']['id']);
			
			if ($this->MotivationScreener->save($this->request->data)) 
			{
				$this->Session->setFlash(__('Your reason has been updated'));
				$this->redirect(array('controller' => 'Users', 'action' => 'dashboard', 'full_base' => true, 'plugin' => false));
			} 
			else 
			{
				$this->Session->setFlash(__('Sorry, something went wrong and we could not save your reason. Please try again.'));
			}
		} 
		else 
		{
			// It hasn't been posted so we are either adding a new entry or editing the form:
			$this->MotivationScreener->create();
			$previousEntry = $this->MotivationScreener->find('first',array('user_id'=>'$userId'));
			
			// If so, edit this entry instead of creating a new one...
			if(!empty($previousEntry)) $this->request->data = $previousEntry;
		}
  	}
  	
  	/**
  	 * 'Home page' for the module, when accessed by a logged-in user from their dashboard.
  	 *
  	 * Will usually contain feedback / charts on their achievements so far, along with the
  	 * ability to quickly make a new data entry.
  	 */
	public function module_dashboard($year = null,$month = null) {
  		$this->redirect('screener');
  	}
  	
  	/**
  	 * Handles the weekly data entry form for this module.
  	 * 
  	 * @param string $date the date for which this entry relates. If null, today's date will be used.
  	 */
	public function data_entry($date = null) {
  		$this->redirect('screener');
  	}
}
?>