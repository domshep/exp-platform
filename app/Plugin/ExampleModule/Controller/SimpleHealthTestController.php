<?php
class SimpleHealthTestController extends ExampleModuleAppController implements ModulePlugin {
	public $helpers = array('Calendar');
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('explore_module'); // Let anyone explore the module, whether they're logged in or not.
	}
	
	public function beforeRender() {
		$this->loadModel('ModuleUser');
		$this->loadModel('Module');
		
		$this->set('module_name', $this->_module_name());
		$this->set('module_icon_url', $this->_module_icon_url());
		
		$addedToDashboard = $this->ModuleUser->alreadyOnDashboard(
			$this->Auth->user('id'),
			$this->Module->getModuleID($this->_module_name()));
		$this->set('added_to_dashboard', $addedToDashboard);
	}
	
	public function dashboard_widget() {
		// Don't allow this method to be called directly from a URL
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
		$this->render();
	}
	
	public function dashboard_news() {
		// Don't allow this method to be called directly from a URL
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
		$this->set('message', "News from the " . $this->_module_name());
		$this->render();
	}

	/**
	 * Returns the public name of the module.
	 * 
	 * @return string
	 */
 	public function _module_name() {
  		return 'Example module &ndash; simple health test';
  	}

  	/**
  	 * Returns the path to the icon for this module.
  	 *
  	 * @return string
  	 */
  	public function _module_icon_url() {
  		return '/example_module/img/icon.png';
  	}
  	
  	/**
  	 * Initial landing screen for finding out what the module is about. This is the first
  	 * page that a non-logged in user will see when they arrive in the module.
  	 */
 	public function explore_module() {
  		$this->set('message', "This is just an example module, while we work on the module interface");
 	}

 	/**
 	 * Initial landing screen for the process of a logged-in user adding the module to their
 	 * dashboard.
 	 */
 	public function add_module() {
  		// Nothing to do here - just go straight to the view
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
  		$this->loadModel('ExampleModule.SimpleHealthTestScreener');
  		$this->loadModel('ExampleModule.SimpleHealthTestAchievement');
  		$this->loadModel('User');
  		$this->loadModel('Module');
	  	
	  	if ($this->request->is('post')) {
	  		// Get hold of the posted data
			$this->SimpleHealthTestScreener->create();
			$this->SimpleHealthTestScreener->set($this->request->data);
			
			if ($this->SimpleHealthTestScreener->validates()) {
				// Validation passed
				if(isset($this->request->data['SimpleHealthTestScreener']['score'])) {
					// The submitted data contained a 'score' so they must have already completed
					// the test and have now asked for the module to be added to their dashboard.
					
					// Get the current user
					$this->User->create();
					$this->User->set($this->User->findById($this->Auth->user('id')));
					
					// Re-calculate the score, and apply the user id (don't just rely on submitted form)
					// and then save the screener data.
					$score = $this->SimpleHealthTestScreener->calculateScore();
					$this->SimpleHealthTestScreener->set('score', $score);
					$this->SimpleHealthTestScreener->set('user_id', $this->User->data['User']['id']);
					$this->SimpleHealthTestScreener->save();
					
					// Calculate / initialise the achievement stats
					$this->SimpleHealthTestAchievement->create();
					$this->SimpleHealthTestAchievement->updateAchievements($this->User->data['User']['id']);
					$this->SimpleHealthTestAchievement->save();
					
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
					$score = $this->SimpleHealthTestScreener->calculateScore();
					$this->set('score', $score);
					$this->SimpleHealthTestScreener->set('score', $score);
					$this->set($this->SimpleHealthTestScreener->data);
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
  		$this->set('message', "The test module has now been added to your dashboard.");
  	}
	
  	/**
  	 * 'Home page' for the module, when accessed by a logged-in user from their dashboard.
  	 *
  	 * Will usually contain feedback / charts on their achievements so far, along with the
  	 * ability to quickly make a new data entry.
  	 */
	public function module_dashboard($year = null,$month = null) {
  		$this->loadModel('ExampleModule.SimpleHealthTestWeekly');
		$this->loadModel('ExampleModule.SimpleHealthTestAchievement');
  		$this->loadModel('User');

  		// Get the current user
  		$userId = $this->Auth->user('id');
  		
		// Calendar Related Items:
  		$monthlyRecords = $this->getMonthlyCalendarEntries($userId, $year, $month);
		$this->set('records', $monthlyRecords);
  	}
  	
  	public function dashboard_achievements() {
  		$this->loadModel('ExampleModule.SimpleHealthTestAchievement');
  		
  		// Don't allow this method to be called directly from a URL
  		if (empty($this->request->params['requested'])) {
  			throw new ForbiddenException();
  		}
  		
  		$achievements = $this->SimpleHealthTestAchievement->findByUserId($this->Auth->user('id'));
  		$this->set('achievements', $achievements);
  		$this->set('message', "Achievements from the " . $this->_module_name());
  		$this->render();
  	}

  	/**
  	 * 'View Records' shows any entries that have been made in the module this month, when accessed by a logged-in user from their dashboard.
  	 */
  	public function view_records($year = null,$month = null) {
  		$this->loadModel('ExampleModule.SimpleHealthTestWeekly');
  		
  		// Get the current user
  		$userId = $this->Auth->user('id');
  		
		// Calendar Related Items:
  		$monthlyRecords = $this->getMonthlyCalendarEntries($userId, $year, $month);
  		$this->set('records', $monthlyRecords);
  	}
  	 
  	/**
  	 * Handles the weekly data entry form for this module.
  	 * 
  	 * @param string $date the date for which this entry relates. If null, today's date will be used.
  	 */
	public function data_entry($date = null) {
		$this->loadModel('ExampleModule.SimpleHealthTestWeekly');
		$this->loadModel('ExampleModule.SimpleHealthTestAchievement');
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
		
		if ($this->request->is('post') || $this->request->is('put')) {
			// The form has been submitted, so validate and then save.
			
			// Re-calculate the total, and apply the user id (don't just rely on submitted form).
			$this->SimpleHealthTestWeekly->create();
			$this->SimpleHealthTestWeekly->set($this->request->data);
			$total = $this->SimpleHealthTestWeekly->calculateTotal();
			$this->SimpleHealthTestWeekly->set('total', $total);
			$this->SimpleHealthTestWeekly->set('user_id', $this->User->data['User']['id']);

			if ($this->SimpleHealthTestWeekly->validates()) {
				$success = $this->SimpleHealthTestWeekly->save();
				
				if($success) {
					//Re-calculate the achievement stats
					$this->SimpleHealthTestAchievement->create();
					$this->SimpleHealthTestAchievement->updateAchievements($this->User->data['User']['id']);
					$this->SimpleHealthTestAchievement->save();
					
					//TODO - redraw graphs?
					
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
			$this->SimpleHealthTestWeekly->create();
			$previousEntry = $this->SimpleHealthTestWeekly->findByUserIdAndWeekBeginning(
					$this->User->data['User']['id'],
					date("Y-m-d",$weekBeginning));
			
			// If so, edit this entry instead of creating a new one...
			if(!empty($previousEntry)) $this->request->data = $previousEntry;
		}
  	}
  
  	public function review_progress() {
  		return "This page will allow the logged-in user to review their progress against the module";
  	}
  	
  	/**
  	 * Returns the set of monthly calendar entries for the given year and month, in a format ready to
  	 * pass to the CalendarHelper class.
  	 * 
  	 * @param string $year
  	 * @param string $month
  	 * @return array
  	 */
  	private function getMonthlyCalendarEntries($userId = null, $year = null, $month = null) {
  		$helper = new ModuleHelperFunctions();
  		
  		// Use today's date if no date given.
  		if(is_null($month)) $month = gmdate("F");
  		if(is_null($year)) $year = gmdate("Y");
  		$this->set('month', $month);
  		$this->set('year', $year);
  		
  		// Calculate the month number and week-beginning date for the first of the month
  		$monthnum = gmdate('n', strtotime("2:00 1 ".$month. " ".$year));
  		$monthStartDate = gmmktime(2,0,0,$monthnum,1,$year);
  		$monthWeekBeginning = $helper->_getWeekBeginningDate(gmdate("Ymd",$monthStartDate));
  		
  		// Retrieve all the weekly entries between the start week and the last day of the month
  		$allEntries = $this->SimpleHealthTestWeekly->find('all',array(
  				'conditions' => array(
  						'user_id' => $userId,
  						'week_beginning >=' => gmdate("Y-m-d",$monthWeekBeginning),
  						'week_beginning <=' => gmdate("Y-m-t",$monthStartDate)
  				)
  		));
  		
  		$records = array();
  		$weekdayList = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
  		
  		// Iterate through the entries and reformat them as, e.g., array( 1 => '10', 2 => '5', 14 => '2'... 31 => '12')
  		foreach($allEntries as $key => $weeklyEntry) {
  			foreach($weekdayList as $weekDayNo => $weekday) {
  				$weekDayDate = strtotime("2:00 " . $weeklyEntry['SimpleHealthTestWeekly']['week_beginning']
  						. " +" . $weekDayNo . " day");
  				if(date('n Y', $weekDayDate) == $monthnum . " " . $year) {
  					$records[date('j', $weekDayDate)] = $weeklyEntry['SimpleHealthTestWeekly'][$weekday];
  				}
  			}
  		}
  		
  		return $records;
  	}
}
?>