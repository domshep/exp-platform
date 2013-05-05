<?php
class StopSmokingController extends StopSmokingModuleAppController implements ModulePlugin {
	public $helpers = array('Calendar', 'Cache');
	public $components = array('RequestHandler');

	public $module_name = 'Stop Smoking';
	public $base_url = 'stop_smoking_module/stop_smoking';
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('explore_module'); // Let anyone explore the module, whether they're logged in or not.
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
		// Don't allow this method to be called directly from a URL
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
		$this->render();
	}
	
	public function dashboard_news() {
		$this->loadModel('StopSmokingModule.StopSmokingAchievement');
		
		// Don't allow this method to be called directly from a URL
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
  		
		// Get the current achievements
		$this->StopSmokingAchievement->create();
		$this->StopSmokingAchievement->set($this->StopSmokingAchievement->findByUserId($this->Auth->user('id')));

		$this->set('medal', $this->StopSmokingAchievement->getMedal());
		$this->set('consecutive_weeks', $this->StopSmokingAchievement->data['StopSmokingAchievement']['consec_healthy_weeks']);
		$this->render();
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
  		return '/stop_smoking_module/img/icon.png';
  	}
  	
  	/**
  	 * Initial landing screen for finding out what the module is about. This is the first
  	 * page that a non-logged in user will see when they arrive in the module.
  	 */
 	public function explore_module() {
 		$this->loadModel('ModuleUser');
 		$this->loadModel('Module');
 		
		$addedToDashboard = $this->ModuleUser->alreadyOnDashboard(
			$this->Auth->user('id'),
			$this->Module->getModuleID($this->_module_name()));
		$this->set('added_to_dashboard', $addedToDashboard);
		
  		$this->set('message', "This is the Stop Smoking module.");
		$this->set('title_for_layout', 'Explore the `' . $this->_module_name() . '` Module');
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
  		$this->loadModel('StopSmokingModule.StopSmokingScreener');
  		$this->loadModel('User');
  		$this->loadModel('Module');
	  	
	  	if ($this->request->is('post')) 
		{
	  		// Get hold of the posted data
			$this->StopSmokingScreener->create();
			$this->StopSmokingScreener->set($this->request->data);
			
			if ($this->StopSmokingScreener->validates()) 
			{
				// Validation passed
				if(isset($this->request->data['StopSmokingScreener']['smoker'])) 
				{
					// The submitted data contained a 'score' so they must have already completed
					// the test and have now asked for the module to be added to their dashboard.
					
					// Get the current user
					$this->User->create();
					$this->User->set($this->User->findById($this->Auth->user('id')));
					
					// Re-calculate the score, and apply the user id (don't just rely on submitted form)
					// and then save the screener data.
					$score = $this->StopSmokingScreener->calculateScore();
					$this->StopSmokingScreener->set('score', $score);
					$this->StopSmokingScreener->set('user_id', $this->User->data['User']['id']);
					$this->StopSmokingScreener->save();
					
					// And then add the module to the user's dashboard
					$success = $this->User->addModule(
							$this->User->data['User']['id'],
							$this->Module->getModuleID($this->_module_name())
					);
					if($success) return $this->redirect('module_added');
					else {
						$this->Session->setFlash(__('The Stop Smoking module could not be added to your dashboard - Is it already on there?'));
						$this->set('title_for_layout', 'The `' . $this->_module_name() . '` could not be added.');
					}
					
				} 
				else 
				{
					// No score yet, so the user has only just submitted the original form.
					// Calculate the score, and then redirect the user to the final page.
					$score = $this->StopSmokingScreener->calculateScore();
					$smokes = $this->data['StopSmokingScreener']['smokes'];
					$this->set('score', $score);
					$this->set('smokes', $smokes);
					$this->StopSmokingScreener->set('score', $score);
					$this->set($this->StopSmokingScreener->data);
					$this->set('title_for_layout', 'My `' . $this->_module_name() . '` Score');
					$this->render('score');
				}
			} else {
				// Validation failed
				$this->Session->setFlash(__('Your score could not be calculated - Did you miss some questions? Please see the error messages below, and try again.'));
				$this->set('title_for_layout', 'Your `' . $this->_module_name() . '` score could not be calculated');
			}
		}
		else $this->set('title_for_layout', 'Calculate my `' . $this->_module_name() . '` Score');
  	}
  	
  	/**
  	 * Landing page when the module has been added to the user's dashboard.
  	 */
	public function module_added() {
  		$this->set('title_for_layout', 'The `' . $this->_module_name() . '` module has been added');
  	}
	
  	/**
  	 * 'Home page' for the module, when accessed by a logged-in user from their dashboard.
  	 *
  	 * Will usually contain feedback / charts on their achievements so far, along with the
  	 * ability to quickly make a new data entry.
  	 */
	public function module_dashboard($year = null,$month = null) {
  		$helper = new ModuleHelperFunctions();
  		$this->loadModel('StopSmokingModule.StopSmokingWeekly');
		$this->loadModel('StopSmokingModule.StopSmokingAchievement');
  		$this->loadModel('User');
  		
  		// Use today's date if no date given.
  		if(is_null($month)) $month = gmdate("F");
  		if(is_null($year)) $year = gmdate("Y");
  		$this->set('month', $month);
  		$this->set('year', $year);

  		// Get the current user
  		$userId = $this->Auth->user('id');

  		// Calendar Related Items:
  		$monthlyRecords = $helper->getMonthlyCalendarEntries($this->StopSmokingWeekly, $userId, $year, $month);
  		$this->set('records', $monthlyRecords);
		$this->set('title_for_layout', 'My `' . $this->_module_name() . '` Dashboard');
  	}
  	
  	public function dashboard_achievements() {
  		$this->loadModel('StopSmokingModule.StopSmokingAchievement');
  		
  		// Don't allow this method to be called directly from a URL
  		if (empty($this->request->params['requested'])) {
  			throw new ForbiddenException();
  		}
  		
  		$achievements = $this->StopSmokingAchievement->findByUserId($this->Auth->user('id'));
  		$this->set('achievements', $achievements);
  		$this->render();
  	}

  	/**
  	 * 'View Records' shows any entries that have been made in the module this month, when accessed by a logged-in user from their dashboard.
  	 */
  	public function view_records($year = null,$month = null) {
  		$helper = new ModuleHelperFunctions();
  		$this->loadModel('StopSmokingModule.StopSmokingWeekly');
  		
  		// Use today's date if no date given.
  		if(is_null($month)) $month = gmdate("F");
  		if(is_null($year)) $year = gmdate("Y");
  		$this->set('month', $month);
  		$this->set('year', $year);
  		
  		// Get the current user
  		$userId = $this->Auth->user('id');
  		
		// Calendar Related Items:
  		$monthlyRecords = $helper->getMonthlyCalendarEntries($this->StopSmokingWeekly, $userId, $year, $month);
  		$this->set('records', $monthlyRecords);
		$this->set('title_for_layout', 'My `' . $this->_module_name() . '` records for ' . ucwords($month) . ' ' . $year);
  	}
  	 
  	/**
  	 * Handles the weekly data entry form for this module.
  	 * 
  	 * @param string $date the date for which this entry relates. If null, today's date will be used.
  	 */
	public function data_entry($date = null) {
		$this->loadModel('StopSmokingModule.StopSmokingWeekly');
		$this->loadModel('StopSmokingModule.StopSmokingAchievement');
		$this->loadModel('User');
		
		// Use today's date if no date given.
		if(is_null($date)) $date = date("Ymd");

		// What is the week beginning (Monday) for the given date?
		$helper = new ModuleHelperFunctions();
		$weekBeginning = $helper->_getWeekBeginningDate($date);
		$this->set('weekBeginning', $weekBeginning);
		
		$previousWeek = strtotime('-1 week', $weekBeginning);
		$this->set('previousWeek', $previousWeek);
		$nextWeek = strtotime('+1 week', $weekBeginning);
		
		if(time() > $nextWeek){
			$this->set('nextWeek', $nextWeek);
		}
		
		// Get the current user
		$this->User->create();
		$this->User->set($this->User->findById($this->Auth->user('id')));
		$this->set('userID', $this->User->data['User']['id']);
		
		if ($this->request->is('post') || $this->request->is('put')) 
		{
			// Was cancel clicked?
			if (isset($this->request->data['cancel'])) return $this->redirect('module_dashboard');
			
			// The form has been submitted, so validate and then save.
			
			// Re-calculate the total, and apply the user id (don't just rely on submitted form).
			$this->StopSmokingWeekly->create();
			$this->StopSmokingWeekly->set($this->request->data);
			$total = $this->StopSmokingWeekly->calculateTotal();
			$this->StopSmokingWeekly->set('total', $total);
			$this->StopSmokingWeekly->set('user_id', $this->User->data['User']['id']);

			if ($this->StopSmokingWeekly->validates()) 
			{
				$success = $this->StopSmokingWeekly->save();
				
				if($success) 
				{
					//Re-calculate the achievement stats
					$this->StopSmokingAchievement->create();
					$this->StopSmokingAchievement->updateAchievements($this->User->data['User']['id']);
					$this->StopSmokingAchievement->save();

					Cache::clear();
					
					$this->Session->setFlash(__('Your weekly record for week beginning ' . date('d-m-Y',$weekBeginning) . ' has been stored.'));
					return $this->redirect('module_dashboard');
				} 
				else 
				{
					$this->Session->setFlash(__('Your weekly record for week beginning ' . date('d-m-Y',$weekBeginning) . ' could not be recorded. Please try again.'));
					$this->set('title_for_layout', 'My `' . $this->_module_name() . '` record for: ' . date('d-m-Y',$weekBeginning));
				}
			} else {
				// Validation failed
				$this->Session->setFlash(__('Your weekly record could not be saved. Please see the error messages below and try again.'));
				$this->set('title_for_layout', 'My `' . $this->_module_name() . '` record for: ' . date('d-m-Y',$weekBeginning));
			}
		} else {
			// This is a new request for this form - display a blank or previous record
			
			// Is there a previous record for this date and user?
			$this->StopSmokingWeekly->create();
			$previousEntry = $this->StopSmokingWeekly->findByUserIdAndWeekBeginning(
					$this->User->data['User']['id'],
					date("Y-m-d",$weekBeginning));
			
			// If so, edit this entry instead of creating a new one...
			if(!empty($previousEntry)){ 
				$this->request->data = $previousEntry;
				$this->set('title_for_layout', 'Edit my `' . $this->_module_name() . '` record for: ' . date('d-m-Y',$weekBeginning));
			}
			else $this->set('title_for_layout', 'Add my `' . $this->_module_name() . '` record for: ' . date('d-m-Y',$weekBeginning));
		}
  	}
  
  	/**
  	 * Returns the .png graphic for the run-chart that is displayed on the module dashboard.
  	 */
  	public function minigraph() {
  		$this->loadModel('StopSmokingModule.StopSmokingWeekly');
  		$this->layout = 'ajax';
  		$this->RequestHandler->respondAs('png');
  		$this->disableCache();
  		
  		// Retrieve all the weekly entries between the start week and the last day of the month
  		$lastThreeMonthEntries = $this->StopSmokingWeekly->find('all',array(
  				'conditions' => array(
  						'user_id' => $this->Auth->user('id'),
  						'week_beginning >=' => date("Y-m-d", strtotime("-3 months")),
  						'week_beginning <=' => date("Y-m-d",time())
  				),
  				'order' => array('week_beginning' => 'asc')
  		));

  		// Need at least three weeks of entries to display a chart...
  		if(count($lastThreeMonthEntries) < 3) {
  			$this->response->file('/webroot/img/not-enough-data-chart.png');
  			return $this->response;
  		}
  		
  		$ydata = array();
  		$dates = array();
  		
  		// Iterate through the entries and reformat them into separate arrays for the graph function.
  		foreach($lastThreeMonthEntries as $key => $weeklyEntry) {
  			$ydata[] = $weeklyEntry['StopSmokingWeekly']['total'];
  			$dates[] = strtotime($weeklyEntry['StopSmokingWeekly']['week_beginning']);
  		}
  		
  		$this->set("graphData", $ydata);
  		$this->set("dates",$dates);
  	}
  	
  	/**
  	 * Returns the total number of weekly data records that have been recorded by this module.
  	 * 
  	 * @throws ForbiddenException
  	 * @return number
  	 */
  	public function total_data_records() {
  		$this->loadModel('StopSmokingModule.StopSmokingWeekly');
  		
  		// Don't allow this method to be called directly from a URL
  		if (empty($this->request->params['requested'])) {
  			throw new ForbiddenException();
  		}
  		
  		return $this->StopSmokingWeekly->find('count');
  	}
}
?>