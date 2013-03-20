<?php
class FiveADayController extends HealthyEatingModuleAppController implements ModulePlugin {
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
		$this->set('message', "Hello from the " . $this->_module_name());
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
  	
  	public function dashboard_achievements() {
  		$this->loadModel('HealthyEatingModule.FiveADayAchievement');
  		
  		// Don't allow this method to be called directly from a URL
  		if (empty($this->request->params['requested'])) {
  			throw new ForbiddenException();
  		}
  		
  		$achievements = $this->FiveADayAchievement->findByUserId($this->Auth->user('id'));
  		$this->set('achievements', $achievements);
  		$this->set('message', "Achievements from the " . $this->_module_name());
  		$this->render();
  	}

	/**
	 * Returns the public name of the module.
	 * 
	 * @return string
	 */
 	public function _module_name() {
  		return 'Healthy Eating &ndash; &lsquo;5-a-day&rsquo;';
  	}
  	
  	/**
  	 * Returns the path to the icon for this module.
  	 * 
  	 * @return string
  	 */
  	public function _module_icon_url() {
  		return '/healthy_eating_module/img/five_a_day/icon.png';
  	}

  	/**
  	 * Initial landing screen for finding out what the module is about. This is the first
  	 * page that a non-logged in user will see when they arrive in the module.
  	 */
 	public function explore_module() {
  		$this->set('message', "This is just a test module, while we work on the module interface");
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
  		$this->loadModel('HealthyEatingModule.FiveADayScreener');
  		$this->loadModel('User');
  		$this->loadModel('Module');
	  	
	  	if ($this->request->is('post')) {
	  		// Get hold of the posted data
			$this->FiveADayScreener->create();
			$this->FiveADayScreener->set($this->request->data);
			
			if ($this->FiveADayScreener->validates()) {
				// Validation passed
				if(isset($this->request->data['FiveADayScreener']['score'])) {
					// The submitted data contained a 'score' so they must have already completed
					// the test and have now asked for the module to be added to their dashboard.
					
					// Get the current user
					$this->User->create();
					$this->User->set($this->User->findById($this->Auth->user('id')));
					
					// Re-calculate the score, and apply the user id (don't just rely on submitted form)
					// and then save the screener data.
					$score = $this->FiveADayScreener->calculateScore();
					$this->FiveADayScreener->set('user_id', $this->User->data['User']['id']);
					$this->FiveADayScreener->save();
					
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
					$score = $this->FiveADayScreener->calculateScore();
					$this->set('score', $score);
					$this->FiveADayScreener->set('score', "".$score);
					$this->set($this->FiveADayScreener->data);
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
  		$this->set('message', "The healthy eating module has now been added to your dashboard.");
  	}
	
  	/**
  	 * 'Home page' for the module, when accessed by a logged-in user from their dashboard.
  	 *
  	 * Will usually contain feedback / charts on their achievements so far, along with the
  	 * ability to quickly make a new data entry.
  	 */
	public function module_dashboard($year = null,$month = null) {
  		$this->loadModel('HealthyEatingModule.FiveADayWeekly');
		$this->loadModel('HealthyEatingModule.FiveADayAchievement');
  		$this->loadModel('User');
		
		$month_list = array('january', 'febuary', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december');
		
		// Use today's date if no date given.
		if(is_null($month)) $month = gmdate("F");
		if(is_null($year)) $year = gmdate("Y");
		$this->set('month', $month);
		$this->set('year', $year);
		
		for($i = 0; $i < 12; $i++)
		{
			if(strtolower($month) == $month_list[$i])
			{
				if(intval($year) != 0)
				{
					$flag = 1;
					$monthnum = $i + 1;
					break;
				}
			}
		}
		
		$date = gmmktime(0,0,0,$monthnum,1,$year);
  		$this->set('message', "This is the 'home page' for the module, and will display feedback on module progress, and links to data entry screens");
		
		$helper = new ModuleHelperFunctions();
  		$weekBeginning = $helper->_getWeekBeginningDate(gmdate("Ymd",$date));
	
  		// Get the current user
  		$this->User->create();
  		$this->User->set($this->User->findById($this->Auth->user('id')));
  		$this->set('userID', $this->User->data['User']['id']);
  		
		$month = $monthnum;
		$recordsarray = "";
		$i = 0;
		$j = 1;
		
		// What day of the week does the month start on?
		$first_day_in_month = gmdate('D', gmmktime(0,0,0, $monthnum, 1, $year)); 
		if ($first_day_in_month == "Mon") $startday = 0;
		if ($first_day_in_month == "Tues") $startday = 1;
		if ($first_day_in_month == "Wed") $startday = 2;
		if ($first_day_in_month == "Thu") $startday = 3;
		if ($first_day_in_month == "Fri") $startday = 4;
		if ($first_day_in_month == "Sat") $startday = 5;
		if ($first_day_in_month == "Sun") $startday = 6;
		$week = 1;
		
		// Load the relevant Records:
		while ($month == $monthnum and $i < 6)
		{
  			$this->FiveADayWeekly->create();
  			$this->FiveADayWeekly->set($this->request->data);
			
  			$previousEntry = $this->FiveADayWeekly->findByUserIdAndWeekBeginning(
  				$this->User->data['User']['id'],
  				gmdate("Y-m-d",$weekBeginning));
		
  			// If so, edit this entry instead of creating a new one...
  			//if(!empty($previousEntry)){ 
			$this->request->data = $previousEntry;
			if ($j > 0)  $recordsarray .= ",";
			if ($startday == 0 or $week > 1) $recordsarray .= $this->request->data('FiveADayWeekly.monday') .",";
			if ($startday <= 1 or $week > 1) $recordsarray .= $this->request->data('FiveADayWeekly.tuesday') . ",";
			if ($startday <= 2 or $week > 1) $recordsarray .= $this->request->data('FiveADayWeekly.wednesday') .",";
			if ($startday <= 3 or $week > 1) $recordsarray .= $this->request->data('FiveADayWeekly.thursday') .",";
			if ($startday <= 4 or $week > 1) $recordsarray .= $this->request->data('FiveADayWeekly.friday') .",";
			if ($startday <= 5 or $week > 1) $recordsarray .= $this->request->data('FiveADayWeekly.saturday') .",";
			$recordsarray .= $this->request->data('FiveADayWeekly.sunday');
			//}
			$weekBeginning = gmmktime(0,0,0,gmdate("m",$weekBeginning),gmdate("d",$weekBeginning)+7,gmdate("Y",$weekBeginning));
			$month = gmdate("m",$weekBeginning);
			$i++;
			$j=$j+7;
			$week++;
		}
		$records = explode(",",$recordsarray);
		$this->set('records', $records);
  	}
  	
  	/**
  	 * Handles the weekly data entry form for this module.
  	 *
  	 * @param string $date the date for which this entry relates. If null, today's date will be used.
  	 */
  	public function data_entry($date = null) {
  		$this->loadModel('HealthyEatingModule.FiveADayWeekly');
		$this->loadModel('HealthyEatingModule.FiveADayAchievement');
  		$this->loadModel('User');
  	
  		// Use today's date if no date given.
  		if(is_null($date)) $date = gmdate("Ymd");
  	
  		// What is the week beginning (Monday) for the given date?
  		$helper = new ModuleHelperFunctions();
  		$weekBeginning = $helper->_getWeekBeginningDate($date);
  		$this->set('weekBeginning', $weekBeginning);
  		
  		$previousWeek = strtotime('-1 week', $weekBeginning);
  		$this->set('previousWeek', $previousWeek);
  		$nextWeek = strtotime('+1 week', $weekBeginning);
  		
  		if(mktime() > $nextWeek){
  			$this->set('nextWeek', $nextWeek);
  		}
  	
  		// Get the current user
  		$this->User->create();
  		$this->User->set($this->User->findById($this->Auth->user('id')));
  		$this->set('userID', $this->User->data['User']['id']);
  	
  		if ($this->request->is('post') || $this->request->is('put')) {
  			// The form has been submitted, so validate and then save.
  				
  			// Re-calculate the total, and apply the user id (don't just rely on submitted form).
  			$this->FiveADayWeekly->create();
  			$this->FiveADayWeekly->set($this->request->data);
  			$total = $this->FiveADayWeekly->calculateTotal();
  			$this->FiveADayWeekly->set('total', $total);
  			$this->FiveADayWeekly->set('user_id', $this->User->data['User']['id']);
  	
  			if ($this->FiveADayWeekly->validates()) {
  				$success = $this->FiveADayWeekly->save();
  	
  				if($success) {
					//Re-calculate the achievement stats
					$this->FiveADayAchievement->create();
					$this->FiveADayAchievement->updateAchievements($this->User->data['User']['id']);
					$this->FiveADayAchievement->save();
					
  					//TODO - redraw graphs? update milestones?
  						
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
  			$this->FiveADayWeekly->create();
  			$previousEntry = $this->FiveADayWeekly->findByUserIdAndWeekBeginning(
  					$this->User->data['User']['id'],
  					date("Y-m-d",$weekBeginning));
  				
  			// If so, edit this entry instead of creating a new one...
  			if(!empty($previousEntry)) $this->request->data = $previousEntry;
  		}
  	}
	
	/*
	public function admin_edit($id=null) {
		// Load the User ID
		$this->set('userID', $this->Auth->user('id'));
		// Set the welcome message
  		$this->set('message', "This is where you edit the data you have entered. In some modules you may wish to limit this. Data will only be editable for this module for a set period of time.");
		// Load the FiveADay Weekly Model
  		$this->loadModel('HealthyEatingModule.FiveADayWeekly');
		// If the ID exists
		if (!$this->FiveADayWeekly->exists($id)) {
			throw new NotFoundException(__('Invalid record'));
		}
		// If the page has been posted.
		if ($this->request->is('post')) {
			$this->FiveADayWeekly->create();
			$this->FiveADayWeekly->set($this->request->data);
			if ($this->FiveADayWeekly->validates()) {
				$this->FiveADayWeekly->save();
			} else {
				// Validation failed
				$this->Session->setFlash(__('Your entry could not be saved? See the error messages below. Please, try again.'));
				$this->render();
			}
		}
		else // if not...
		{
			//$options = array('conditions' => array('HealthyEatingModule.FiveADayWeekly.id' => $id));
			//$this->request->data = $this->FiveADayWeekly->id = $id;//'first', $options);
    		$this->set('FiveADayWeekly', $this->FiveADayWeekly->id = $id);
		}	
  	}*/
  
  	public function review_progress() {
  		return "This page will allow the logged-in user to review their progress against the module";
  	}
}
?>