<?php
class BodyMassIndexController extends HealthyWeightModuleAppController implements ModulePlugin {
    public $helpers = array('Calendar', 'Cache');
	public $components = array('RequestHandler');
	
	public $module_name = 'Healthy Weight &ndash; Body Mass Index (BMI)';
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('explore_module'); // Let anyone explore the module, whether they're logged in or not.
	}
	
	public function beforeRender() {
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
		$this->loadModel('HealthyWeightModule.BmiAchievement');
		
		// Don't allow this method to be called directly from a URL
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
  		
		// Get the current achievements
		$this->BmiAchievement->create();
		$this->BmiAchievement->set($this->BmiAchievement->findByUserId($this->Auth->user('id')));

		$this->set('medal', $this->BmiAchievement->getMedal());
		$this->set('consecutive_weeks', $this->BmiAchievement->data['BmiAchievement']['consec_healthy_weeks']);
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
  		return '/healthy_weight_module/img/Bmi/icon.png';
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
	public function screener() {
  		$this->loadModel('HealthyWeightModule.BmiScreener');
  		$this->loadModel('HealthyWeightModule.BmiAchievement');
  		$this->loadModel('User');
  		$this->loadModel('Profile');
  		$this->loadModel('Module');
	  	
	  	if ($this->request->is('post')) {
	  		// Get hold of the posted data
			$this->BmiScreener->create();
			$this->BmiScreener->set($this->request->data);
			
			if ($this->BmiScreener->validates()) {
				// Validation passed
				if(isset($this->request->data['BmiScreener']['bmi'])) {
					// The submitted data contained a 'score' so they must have already completed
					// the test and have now asked for the module to be added to their dashboard.
					
					// Get the current user
					$this->User->create();
					$this->User->set($this->User->findById($this->Auth->user('id')));
					
					// Height is loaded from the "profile" into the form - but may be worth re-loading it. 
					// Weight is entered into the form
					$this->Profile->create();
					$this->Profile->set($this->Profile->findByUserId($this->Auth->user('id')));
					$height_cm = $this->Profile->data['Profile']['height_cm'];
					$gender = $this->Profile->data['Profile']['gender'];
					$weight_kg = $this->request->data['BmiScreener']['start_weight_kg'];
					
					// Re-calculate the score, and apply the user id (don't just rely on submitted form)
					// and then save the screener data.
					$bmi = $this->calculateBMI($height_cm,$weight_kg);
					$this->BmiScreener->set('start_bmi', $bmi);
					$this->BmiScreener->set('user_id', $this->User->data['User']['id']);
					$this->BmiScreener->save();
					
					// Calculate / initialise the achievement stats
					$this->BmiAchievement->create();
					$this->BmiAchievement->updateAchievements($this->User->data['User']['id']);
					$this->BmiAchievement->save();
					
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
					
					// Height is loaded from the "profile" into the form - but may be worth re-loading it. 
					// Weight is entered into the form
					$this->Profile->create();
					$this->Profile->set($this->Profile->findByUserId($this->Auth->user('id')));
					$height_cm = $this->Profile->data['Profile']['height_cm'];
					$gender = $this->Profile->data['Profile']['gender'];
					$weight_kg = $this->request->data['BmiScreener']['weight_kg'];
					
					// Calculate the score, and then redirect the user to the final page.
					$bmi = $this->calculateBMI($height_cm,$weight_kg);
					$this->set('bmi', $bmi);
					$this->BmiScreener->set('bmi', $bmi);
					$this->set('weight_kg', $weight_kg);
					$this->set('height_cm', $height_cm);
					$this->set($this->BmiScreener->data);
					$this->render('score');
				}
			} else {
				// Validation failed
				$this->Session->setFlash(__('Your BMI could not be calculated - Did you miss some questions? Please see the error messages below, and try again.'));
			}
		}
  	}
  	
  	/**
  	 * Landing page when the module has been added to the user's dashboard.
  	 */
	public function module_added() {
  		$this->set('message', "The BMI module has now been added to your dashboard.");
  	}
	
  	/**
  	 * 'Home page' for the module, when accessed by a logged-in user from their dashboard.
  	 *
  	 * Will usually contain feedback / charts on their achievements so far, along with the
  	 * ability to quickly make a new data entry.
  	 */
	public function module_dashboard($year = null,$month = null) {
  		$helper = new ModuleHelperFunctions();
  		$this->loadModel('HealthyWeightModule.BmiWeekly');
		$this->loadModel('HealthyWeightModule.BmiAchievement');
		$this->loadModel('HealthyWeightModule.BmiScreener');
  		$this->loadModel('User');

  		// Use today's date if no date given.
  		if(is_null($month)) $month = gmdate("F");
  		if(is_null($year)) $year = gmdate("Y");
  		$this->set('month', $month);
  		$this->set('year', $year);
		
		$model = $this->BmiWeekly;
		
		$monthnum = gmdate('n', strtotime("2:00 1 ".$month. " ".$year));
		$monthStartDate = gmmktime(2,0,0,$monthnum,1,$year);
		$monthWeekBeginning = $helper->_getWeekBeginningDate(gmdate("Ymd",$monthStartDate));
		
  		// Get the current user
  		$userId = $this->Auth->user('id');
		
  		// Calendar Related Items:
		$allEntries = $model->find('all',array(
				'conditions' => array(
						'user_id' => $userId,
						'week_beginning >=' => gmdate("Y-m-d",$monthWeekBeginning),
						'week_beginning <=' => gmdate("Y-m-t",$monthStartDate)
				),
				'order' => array('week_beginning' => 'asc')
		));
		
		$records = array();
		$weekdayList = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
		
		/* This one has just one entry per week, so we can't use the calendar helper */
		foreach($allEntries as $key => $weeklyEntry) 
		{
			foreach($weekdayList as $weekDayNo => $weekday) {
				$weekDayDate = strtotime("2:00 " . $weeklyEntry[get_class($model)]['week_beginning']
						. " +" . $weekDayNo . " day");
				if(date('n Y', $weekDayDate) == $monthnum . " " . $year) {
					$comment = "Weekly entry: ".$weeklyEntry[get_class($model)]['bmi'];
					if(!empty($weeklyEntry[get_class($model)]['what_worked'])) {
						$comment .= "<br />What worked for me this week: ".$weeklyEntry[get_class($model)]['what_worked'];
					}
					$records[date('j', $weekDayDate)] = array(
							'entry' => $weeklyEntry[get_class($model)]['bmi'],
							'comment' => $comment
					);
				}
			}
		}
	
  		$this->set('records', $records);
  	}
  	
  	public function dashboard_achievements() {
  		$this->loadModel('HealthyWeightModule.BmiAchievement');
  	
  		// Don't allow this method to be called directly from a URL
  		if (empty($this->request->params['requested'])) {
  			throw new ForbiddenException();
  		}
  	
  		$achievements = $this->BmiAchievement->findByUserId($this->Auth->user('id'));
  		$this->set('achievements', $achievements);
  		$this->set('message', "Achievements from the " . $this->_module_name());
  		$this->render();
  	}

  	/**
  	 * 'View Records' shows any entries that have been made in the module this month, when accessed by a logged-in user from their dashboard.
  	 */
	public function view_records($year = null,$month = null) {
  		$helper = new ModuleHelperFunctions();
  		$this->loadModel('HealthyWeightModule.BmiWeekly');

  		// Use today's date if no date given.
  		if(is_null($month)) $month = gmdate("F");
  		if(is_null($year)) $year = gmdate("Y");
  		$this->set('month', $month);
  		$this->set('year', $year);
  		
  		$model = $this->BmiWeekly;
		
		$monthnum = gmdate('n', strtotime("2:00 1 ".$month. " ".$year));
		$monthStartDate = gmmktime(2,0,0,$monthnum,1,$year);
		$monthWeekBeginning = $helper->_getWeekBeginningDate(gmdate("Ymd",$monthStartDate));
		
  		// Get the current user
  		$userId = $this->Auth->user('id');
		
  		// Calendar Related Items:
		$allEntries = $model->find('all',array(
				'conditions' => array(
						'user_id' => $userId,
						'week_beginning >=' => gmdate("Y-m-d",$monthWeekBeginning),
						'week_beginning <=' => gmdate("Y-m-t",$monthStartDate)
				),
				'order' => array('week_beginning' => 'asc')
		));
		
		$records = array();
		$weekdayList = array('monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday');
		
		/* This one has just one entry per week, so we can't use the calendar helper */
		foreach($allEntries as $key => $weeklyEntry) 
		{
			foreach($weekdayList as $weekDayNo => $weekday) {
				$weekDayDate = strtotime("2:00 " . $weeklyEntry[get_class($model)]['week_beginning']
						. " +" . $weekDayNo . " day");
				if(date('n Y', $weekDayDate) == $monthnum . " " . $year) {
					$comment = "Weekly entry: ".$weeklyEntry[get_class($model)]['bmi'];
					if(!empty($weeklyEntry[get_class($model)]['what_worked'])) {
						$comment .= "<br />What worked for me this week: ".$weeklyEntry[get_class($model)]['what_worked'];
					}
					$records[date('j', $weekDayDate)] = array(
							'entry' => $weeklyEntry[get_class($model)]['bmi'],
							'comment' => $comment
					);
				}
			}
		}
	
  		$this->set('records', $records);
  	}
  	
  	/**
  	 * Handles the weekly data entry form for this module.
  	 *
  	 * @param string $date the date for which this entry relates. If null, today's date will be used.
  	 */
  	public function data_entry($date = null) {
  		$this->loadModel('HealthyWeightModule.BmiWeekly');
		$this->loadModel('HealthyWeightModule.BmiAchievement');
  		$this->loadModel('User');
		$this->loadModel('Profile');
		
		// Height is loaded from the "profile" into the form - but may be worth re-loading it. 
		// Weight is entered into the form
		$this->Profile->create();
		$this->Profile->set($this->Profile->findByUserId($this->Auth->user('id')));
		$height_cm = $this->Profile->data['Profile']['height_cm'];
		$gender = $this->Profile->data['Profile']['gender'];
  	
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
  	
  		if ($this->request->is('post') || $this->request->is('put')) {
  			// The form has been submitted, so validate and then save.
			$weight_kg = $this->request->data['BmiWeekly']['weight_kg'];
  				
  			// Re-calculate the total, and apply the user id (don't just rely on submitted form).
  			$this->BmiWeekly->create();
  			$this->BmiWeekly->set($this->request->data);
  			$bmi = $this->calculateBMI($height_cm, $weight_kg) ;
  			$this->BmiWeekly->set('bmi', $bmi);
  			$this->BmiWeekly->set('weight_kg', $weight_kg);
  			$this->BmiWeekly->set('height_cm', $height_cm);
  			$this->BmiWeekly->set('user_id', $this->User->data['User']['id']);
  	
  			if ($this->BmiWeekly->validates()) {
  				$success = $this->BmiWeekly->save();
  	
  				if($success) {
					//Re-calculate the achievement stats
					$this->BmiAchievement->create();
					$this->BmiAchievement->updateAchievements($this->User->data['User']['id']);
					$this->BmiAchievement->save();

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
  			$this->BmiWeekly->create();
  			$previousEntry = $this->BmiWeekly->findByUserIdAndWeekBeginning(
  					$this->User->data['User']['id'],
  					date("Y-m-d",$weekBeginning));
  			
  			// If so, edit this entry instead of creating a new one...
  			if(!empty($previousEntry)){
				$this->request->data = $previousEntry;
				// Get weight:
				$kgs = $previousEntry['BmiWeekly']['weight_kg'];
				$lbs = round($kgs * 2.20462,0);
				$stones = 0;
				while ($lbs >= 13)
				{
					$stones = $stones + 1;
					$lbs = $lbs - 13;
				}

				$this->request->data['BmiWeekly']['weight_stones'] = $stones;
				$this->request->data['BmiWeekly']['weight_lbs'] = $lbs;
  			}
		}
  	}
	
  	/**
  	 * Returns the .png graphic for the run-chart that is displayed on the module dashboard.
  	 */
  	public function minigraph() {
  		$this->loadModel('HealthyWeightModule.BmiWeekly');
  		$this->layout = 'ajax';
  		$this->RequestHandler->respondAs('png');
  	
  		// Retrieve all the weekly entries between the start week and the last day of the month
  		$lastThreeMonthEntries = $this->BmiWeekly->find('all',array(
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
  			$ydata[] = $weeklyEntry['BmiWeekly']['bmi'];
  			$dates[] = strtotime($weeklyEntry['BmiWeekly']['week_beginning']);
  		}
  	
  		$this->set("graphData", $ydata);
  		$this->set("dates",$dates);
  	}
  	
  	/**
  	 * Calculates the BMI for the given height and weight.
  	 * 
  	 * @param string $height_cm
  	 * @param string $weight_kg
  	 * @return number
  	 */
  	private function calculateBMI($height_cm=null, $weight_kg=null)
  	{
  		if(is_null($height_cm) || is_null($weight_kg)) {
  			return 0;
  		}
  		
  		// Calculate BMI
  		$height_m = $height_cm / 100;
  	
  		if ($height_m == 0) $height_m = 1;
  	
  		$bmi = round($weight_kg / ($height_m * $height_m), 2);
  	
  		return $bmi;
  	}
}
?>