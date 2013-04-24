<?php
class DrinkingController extends DrinkSafelyModuleAppController implements ModulePlugin {
    public $helpers = array('Calendar', 'Cache');
	public $components = array('RequestHandler');
	
	public $module_name = 'Drink Safely';
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('explore_module'); // Let anyone explore the module, whether they're logged in or not.
	}
	
	public function beforeRender() {
		parent::beforeRender();
		$this->set('module_name', $this->_module_name());
		$this->set('module_icon_url', $this->_module_icon_url());
	}
	
	public function dashboard_widget() {
		// Don't allow this method to be called directly from a URL
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
		$this->render();
	}
	
	public function dashboard_news() {
		$this->loadModel('DrinkSafelyModule.DrinkingAchievement');
		// Don't allow this method to be called directly from a URL
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
  		
		// Get the current achievements
		$this->DrinkingAchievement->create();
		$this->DrinkingAchievement->set($this->DrinkingAchievement->findByUserId($this->Auth->user('id')));

		$this->set('medal', $this->DrinkingAchievement->getMedal());
		$this->set('consecutive_weeks', $this->DrinkingAchievement->data['DrinkingAchievement']['consec_healthy_weeks']);
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
  	 * Returns the path to the icon for this module.
  	 * 
  	 * @return string
  	 */
  	public function _module_icon_url() {
  		return '/drink_safely_module/img/drinking/icon.png';
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
 	}

 	/**
 	 * Initial landing screen for the process of a logged-in user adding the module to their
 	 * dashboard.
 	 */
 	public function add_module() {
  		$this->loadModel('ModuleUser');
		$this->loadModel('Module');
		
		$addedToDashboard = $this->ModuleUser->alreadyOnDashboard(
			$this->Auth->user('id'),
			$this->Module->getModuleID($this->_module_name()));
		$this->set('added_to_dashboard', $addedToDashboard);
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
	public function screener() {
  		$this->loadModel('DrinkSafelyModule.DrinkingScreener');
  		$this->loadModel('Profile');
  		$this->loadModel('User');
  		$this->loadModel('Module');
	
		$this->Profile->create();
		$this->Profile->set($this->Profile->findByUserId($this->Auth->user('id')));
		$gender = $this->Profile->data['Profile']['gender']; // required for calculations
			
  		$this->set('gender', $gender);
	  	
	  	if ($this->request->is('post')) {
	  		// Get hold of the posted data
			$this->DrinkingScreener->create();
			$this->DrinkingScreener->set($this->request->data);
			
			if ($this->DrinkingScreener->validates()) {
				// Validation passed
				if(isset($this->request->data['DrinkingScreener']['score'])) {
					// The submitted data contained a 'score' so they must have already completed
					// the test and have now asked for the module to be added to their dashboard.
					
					// Get the current user
					$this->User->create();
					$this->User->set($this->User->findById($this->Auth->user('id')));
					
					// Re-calculate the score, and apply the user id (don't just rely on submitted form)
					// and then save the screener data.
					$score = $this->DrinkingScreener->calculateScore();
					$this->DrinkingScreener->set('score', $score);
					$this->DrinkingScreener->set('user_id', $this->User->data['User']['id']);
					$this->DrinkingScreener->save();
					
					// And then add the module to the user's dashboard
					$success = $this->User->addModule(
							$this->User->data['User']['id'],
							$this->Module->getModuleID($this->_module_name())
					);
					if($success) {
						return $this->redirect('module_added');
					} else {
						$this->Session->setFlash(__('The module could not be added to your dashboard - Is it already on there?'));
					}
					
				} else {
					// No score yet, so the user has only just submitted the original form.
					// Calculate the score, and then redirect the user to the final page.
					$score = $this->DrinkingScreener->calculateScore();
					$this->set('score', $score);
					$binge = $this->DrinkingScreener->data['DrinkingScreener']['binge'];
					
					// Does the number consumed indicate contradict the "binge" figure selected?
					$how_many = $this->DrinkingScreener->data['DrinkingScreener']['how_many'];
					if ($gender == "F") $limit = 6;
					else $limit = 8;
					if ($how_many >= 8) $binge = $how_many;
					
					$this->set('binge', $binge);
					$this->set('how_many', $how_many);
					$this->DrinkingScreener->set('score', "".$score);
					$this->set($this->DrinkingScreener->data);
					$this->render('score');
				}
			} else {
				// Validation failed
				$this->Session->setFlash(__('Your score could not be calculated - Did you miss some questions? Please see the error messages below, and try again.'));
			}
		}
  	}
  	
  	/**
  	 * Landing page when the module has been added to the user's dashboard.
  	 */
	public function module_added() {
  		$this->set('message', "The 'Drink Safely' module has now been added to your dashboard.");
  	}
	
  	/**
  	 * 'Home page' for the module, when accessed by a logged-in user from their dashboard.
  	 *
  	 * Will usually contain feedback / charts on their achievements so far, along with the
  	 * ability to quickly make a new data entry.
  	 */
	public function module_dashboard($year = null,$month = null) {
  		$helper = new ModuleHelperFunctions();
  		$this->loadModel('DrinkSafelyModule.DrinkingWeekly');
		$this->loadModel('DrinkSafelyModule.DrinkingAchievement');
  		$this->loadModel('User');
 		$this->loadModel('Profile');

  		// Use today's date if no date given.
  		if(is_null($month)) $month = gmdate("F");
  		if(is_null($year)) $year = gmdate("Y");
  		$this->set('month', $month);
  		$this->set('year', $year);
  		
  		// Get the current user
  		$userId = $this->Auth->user('id');
		
		// Get the gender
		$this->Profile->create();
		$this->Profile->set($this->Profile->findByUserId($this->Auth->user('id')));
		$gender = $this->Profile->data['Profile']['gender']; // required for calculations
			
  		$this->set('gender', $gender);

  		// Calendar Related Items:
  		$monthlyRecords = $helper->getMonthlyCalendarEntries($this->DrinkingWeekly, $userId, $year, $month);
  		$this->set('records', $monthlyRecords);
  	}
  	
  	public function dashboard_achievements() {
  		$this->loadModel('DrinkSafelyModule.DrinkingAchievement');
  	
  		// Don't allow this method to be called directly from a URL
  		if (empty($this->request->params['requested'])) {
  			throw new ForbiddenException();
  		}
		
  		$achievements = $this->DrinkingAchievement->findByUserId($this->Auth->user('id'));
  		$this->set('achievements', $achievements);
  		$this->set('message', "Achievements from the " . $this->_module_name());
  		$this->render();
  	}

  	/**
  	 * 'View Records' shows any entries that have been made in the module this month, when accessed by a logged-in user from their dashboard.
  	 */
	public function view_records($year = null,$month = null) {
		$this->loadModel('Profile');
		
		$this->Profile->create();
		$this->Profile->set($this->Profile->findByUserId($this->Auth->user('id')));
		$gender = $this->Profile->data['Profile']['gender']; // required for calculations
			
  		$this->set('gender', $gender);
		
  		$helper = new ModuleHelperFunctions();
  		$this->loadModel('DrinkSafelyModule.DrinkingWeekly');

  		// Use today's date if no date given.
  		if(is_null($month)) $month = gmdate("F");
  		if(is_null($year)) $year = gmdate("Y");
  		$this->set('month', $month);
  		$this->set('year', $year);
  		
  		// Get the current user
  		$userId = $this->Auth->user('id');

  		// Calendar Related Items:
  		$monthlyRecords = $helper->getMonthlyCalendarEntries($this->DrinkingWeekly, $userId, $year, $month);
  		$this->set('records', $monthlyRecords);
  	}
  	
  	/**
  	 * Handles the weekly data entry form for this module.
  	 *
  	 * @param string $date the date for which this entry relates. If null, today's date will be used.
  	 */
  	public function data_entry($date = null) {
  		$this->loadModel('DrinkSafelyModule.DrinkingWeekly');
		$this->loadModel('DrinkSafelyModule.DrinkingAchievement');
  		$this->loadModel('User');
 		$this->loadModel('Profile');
  	 	
  		// Use today's date if no date given.
  		if(is_null($date)) $date = gmdate("Ymd");
  	
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
		
		// Get the gender
		$this->Profile->create();
		$this->Profile->set($this->Profile->findByUserId($this->Auth->user('id')));
		$gender = $this->Profile->data['Profile']['gender']; // required for calculations
			
  		$this->set('gender', $gender);
  	
  		if ($this->request->is('post') || $this->request->is('put')) {
  			// The form has been submitted, so validate and then save.
  				
  			// Re-calculate the total, and apply the user id (don't just rely on submitted form).
  			$this->DrinkingWeekly->create();
  			$this->DrinkingWeekly->set($this->request->data);
  			$total = $this->DrinkingWeekly->calculateTotal();
  			$this->DrinkingWeekly->set('total', $total);
  			$this->DrinkingWeekly->set('user_id', $this->User->data['User']['id']);
  	
  			if ($this->DrinkingWeekly->validates()) {
  				$success = $this->DrinkingWeekly->save();
  	
  				if($success) {
					//Re-calculate the achievement stats
					$this->DrinkingAchievement->create();
					$this->DrinkingAchievement->updateAchievements($this->User->data['User']['id'],$gender);
					$this->DrinkingAchievement->save();

					Cache::clear();
						
  					$this->Session->setFlash(__('Your weekly record for week beginning ' . date('d-m-Y',$weekBeginning) . ' has been stored.'));
  					return $this->redirect('module_dashboard');
  				} else {
  					$this->Session->setFlash(__('Your weekly record for week beginning ' . date('d-m-Y',$weekBeginning) . ' could not be recorded. Please try again.'));
  				}
  			} else {
  				// Validation failed
  				$this->Session->setFlash(__('Your weekly record could not be saved. Please see the error messages below and try again.'));
  			}
  		} else {
  			// This is a new request for this form - display a blank or previous record
  				
  			// Is there a previous record for this date and user?
  			$this->DrinkingWeekly->create();
  			$previousEntry = $this->DrinkingWeekly->findByUserIdAndWeekBeginning(
  					$this->User->data['User']['id'],
  					date("Y-m-d",$weekBeginning));
  				
  			// If so, edit this entry instead of creating a new one...
  			if(!empty($previousEntry)) $this->request->data = $previousEntry;
  		}
  	}
	
  	/**
  	 * Returns the .png graphic for the run-chart that is displayed on the module dashboard.
  	 */
  	public function minigraph() {
  		$this->loadModel('DrinkSafelyModule.DrinkingWeekly');
  		$this->layout = 'ajax';
  		$this->RequestHandler->respondAs('png');
  	
  		// Retrieve all the weekly entries between the start week and the last day of the month
  		$lastThreeMonthEntries = $this->DrinkingWeekly->find('all',array(
  				'conditions' => array(
  						'user_id' => $this->Auth->user('id'),
  						'week_beginning >=' => date("Y-m-d", strtotime("-3 months")),
  						'week_beginning <=' => date("Y-m-d",time())
  				),
  				'order' => array('week_beginning' => 'asc')
  		));
  		
  		// Need at least three weeks of entries to display a chart...
  		if(count($lastThreeMonthEntries) < 3) {
  			return $this->redirect('/img/not-enough-data-chart.png');
  		}
  	
  		$ydata = array();
  		$dates = array();
  	
  		// Iterate through the entries and reformat them into separate arrays for the graph function.
  		foreach($lastThreeMonthEntries as $key => $weeklyEntry) {
  			$ydata[] = $weeklyEntry['DrinkingWeekly']['total'];
  			$dates[] = strtotime($weeklyEntry['DrinkingWeekly']['week_beginning']);
  		}
  	
  		$this->set("graphData", $ydata);
  		$this->set("dates",$dates);
  	}
}
?>