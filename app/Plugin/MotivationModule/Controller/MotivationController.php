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
		$this->set('module_name', $this->module_name());
		$this->set('module_icon_url', $this->module_icon_url());
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
				$this->Module->getModuleID($this->module_name()));
	
		if($addedToDashboard) {
			return $this->redirect('module_dashboard');
		} else {
			return $this->redirect('explore_module');
		}
	}
	
	public function dashboard_widget() { 
		$this->loadModel('Module');
		
		// Don't allow this method to be called directly from a URL
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
		
		// Check this module is installed and activated - if not, just return a blank
		$module = $this->Module->findByName($this->module_name);
		$active = false;
		$motivation = null;
		if(!empty($module)) {
			$active = $module['Module']['active'];
			if($active) {
				$this->loadModel('MotivationModule.MotivationScreener');
				$motivation = $this->MotivationScreener->findByUserId($this->Auth->user('id'));
			}
		}
		
		$this->set('motivation', $motivation);
		$this->set('activated', $active);
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
 	public function module_name() {
  		return $this->module_name;
  	}

  	/**
  	 * Returns the type of module (e.g. dashboard, widget, survey).
  	 *
  	 * @return string
  	 */
  	public function module_type() {
  		return 'widget';
  	}
  	
  	/**
  	 * Returns the base URL for this module.
  	 *
  	 * @return string
  	 */
  	public function module_base_url() {
  		return $this->base_url;
  	}

  	/**
  	 * Returns the path to the icon for this module.
  	 *
  	 * @return string
  	 */
  	public function module_icon_url() {
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
		
		$this->set('title_for_layout', $this->module_name());
		
		// Get user id from current user session, rather than from form
		$currentUser = $this->User->findById($this->Auth->user('id'));
		
	  	if ($this->request->is('post') || $this->request->is('put')) 
		{
	  		$this->MotivationScreener->create();
	  		$this->MotivationScreener->set($this->request->data);
	  		
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
			$previousEntry = $this->MotivationScreener->findByUserId($this->Auth->user('id'));

			// If so, edit this entry instead of creating a new one...
			if(!empty($previousEntry)){
				$this->request->data = $previousEntry;
			} else {
				$this->request->data = $this->MotivationScreener->data;
			}
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
  	
  	/**
  	 * Returns the total number of screener data records that have been recorded by this module.
  	 * 
  	 * @throws ForbiddenException
  	 * @return number
  	 */
  	public function total_data_records() {
  		$this->loadModel('MotivationModule.MotivationScreener');
  		
  		// Don't allow this method to be called directly from a URL
  		if (empty($this->request->params['requested'])) {
  			throw new ForbiddenException();
  		}
  		
  		return $this->MotivationScreener->find('count');
  	}
	
	
  	/**
  	 * Admin panel view.
  	 */
  	public function admin_module_data() {
  		$this->redirectIfNotAdmin();
  		
  		$this->loadModel('Module');
  		$this->loadModel('MotivationModule.MotivationScreener');
  		
  		// Don't allow this method to be called directly from a URL
  		if (empty($this->request->params['requested'])) {
  			throw new ForbiddenException();
  		}
  		$module = $this->Module->findByName($this->module_name);

  		if(empty($module)) {
  			throw new NotFoundException("The " . $this->module_name . " could not be found in the database");
  		}
  		
  		$this->set('module',$module);
  		
  		$screeners = $this->MotivationScreener->find('count');
  		$this->set('screeners',$screeners);
  		
  		$this->render();
  	}
  	
  	/**
  	 * Exports a full set of screener data.
  	 */
  	public function admin_export_reasons() {
  		$this->redirectIfNotAdmin();
  		
  		$this->loadModel('MotivationModule.MotivationScreener');
  		
  		$filename = "motivation_reasons_export_".date("Y.m.d").".csv";
  		
  		$headerRow = array("User ID",
				"Reason",
  				"Created",
  				"Modified");
  		
  		$dataFields = array("user_id",
  				"reason",
  				"created",
  				"modified");
  		
  		$this->exportCSVFile($this->MotivationScreener, $filename, $headerRow, $dataFields);
  	}
  	
  	/**
  	 * Tidies up database in preparation for the module to be deleted from the website.
  	 */
  	public function admin_delete_module() {
  		$this->redirectIfNotAdmin();
  		
  		$this->loadModel('MotivationModule.MotivationScreener');
  		
  		$this->MotivationScreener->query("DROP TABLE `motivation_screeners`");
  	}
  	
  	/**
  	 * Returns the SQL necessary to create and set up the module for use.
  	 * 
  	 * @return array of SQL commands to execute
  	 */
  	public function admin_install_sql() {
  		$this->redirectIfNotAdmin();
  		
  		$installSQL[] = "
  			DROP TABLE IF EXISTS `motivation_screeners`;
			CREATE TABLE IF NOT EXISTS `motivation_screeners` (
			  `id` int(11) NOT NULL auto_increment,
			  `user_id` int(11) NOT NULL,
			  `reason` text NOT NULL,
			  `created` datetime NOT NULL,
			  `modified` datetime NOT NULL,
			  PRIMARY KEY  (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
  		
  		return $installSQL;
  	}
}
?>