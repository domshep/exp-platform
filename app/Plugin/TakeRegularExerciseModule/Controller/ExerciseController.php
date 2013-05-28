<?php
class ExerciseController extends TakeRegularExerciseModuleAppController implements ModulePlugin {
    public $helpers = array('Calendar', 'Cache');
	public $components = array('RequestHandler');
	
	public $module_name = 'Take Regular Exercise';
	public $base_url = 'take_regular_exercise_module/exercise';
	
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('explore_module'); // Let anyone explore the module, whether they're logged in or not.
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
		// Don't allow this method to be called directly from a URL
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
		$this->render();
	}
	
	public function dashboard_news() {
		$this->loadModel('TakeRegularExerciseModule.ExerciseAchievement');
		// Don't allow this method to be called directly from a URL
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
  		
		// Get the current achievements
		$this->ExerciseAchievement->create();
		$this->ExerciseAchievement->set($this->ExerciseAchievement->findByUserId($this->Auth->user('id')));

		$this->set('medal', $this->ExerciseAchievement->getMedal());
		$this->set('consecutive_weeks', $this->ExerciseAchievement->data['ExerciseAchievement']['consec_healthy_weeks']);
		$this->render();
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
  		return 'dashboard';
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
  		return '/take_regular_exercise_module/img/icon.png';
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
			$this->Module->getModuleID($this->module_name()));
		$this->set('added_to_dashboard', $addedToDashboard);
		$this->set('title_for_layout', 'Explore the `' . $this->module_name() . '` Module');
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
  		$this->loadModel('TakeRegularExerciseModule.ExerciseScreener');
  		$this->loadModel('User');
  		$this->loadModel('Module');
	  	
	  	if ($this->request->is('post')) 
		{
	  		// Get hold of the posted data
			$this->ExerciseScreener->create();
			$this->ExerciseScreener->set($this->request->data);

			if ($this->ExerciseScreener->validates()) 
			{
				// Validation passed
				if(isset($this->request->data['ExerciseScreener']['score'])) 
				{
					// The submitted data contained a 'score' so they must have already completed
					// the test and have now asked for the module to be added to their dashboard.
					
					// Get the current user
					$this->User->create();
					$this->User->set($this->User->findById($this->Auth->user('id')));
					
					// Re-calculate the score, and apply the user id (don't just rely on submitted form)
					// and then save the screener data.
					$score = $this->ExerciseScreener->calculateMETScore();
					$this->ExerciseScreener->set('score', $score);
					$this->ExerciseScreener->set('user_id', $this->User->data['User']['id']);
					$this->ExerciseScreener->save();
					
					// And then add the module to the user's dashboard
					$success = $this->User->addModule(
							$this->User->data['User']['id'],
							$this->Module->getModuleID($this->module_name())
					);
					if($success) return $this->redirect('module_added');
					else {
						$this->Session->setFlash(__('The module could not be added to your dashboard - Is it already on there?'));
						$this->set('title_for_layout', 'The `' . $this->module_name() . '` Module could not be added');
					}
					
				} 
				else 
				{
					// No score yet, so the user has only just submitted the original form.
					// Calculate the score and feedback, and then redirect the user to the final page.
					$score = $this->ExerciseScreener->calculateMETScore();
					$this->set('score', $score);
					$this->ExerciseScreener->set('score', "".$score);
					$feedback = $this->ExerciseScreener->getFeedbackLevel();
					$this->set('feedback', $feedback);
					$this->ExerciseScreener->set('feedback', $feedback);
					$this->set($this->ExerciseScreener->data);
					$this->set('title_for_layout', 'My `' . $this->module_name() . '` Feedback');
					$this->render('score');
				}
			} 
			else 
			{
				// Validation failed
				$this->Session->setFlash(__('Your score could not be calculated - Did you miss some questions? Please see the error messages below, and try again.'));
				$this->set('title_for_layout', 'The `' . $this->module_name() . '` Test');
			}
		}
		else $this->set('title_for_layout', 'The `' . $this->module_name() . '` Test');
  	}
  	
  	/**
  	 * Landing page when the module has been added to the user's dashboard.
  	 */
	public function module_added() {
		$this->set('title_for_layout', 'The `' . $this->module_name() . '` Module has been added');
  	}
	
  	/**
  	 * 'Home page' for the module, when accessed by a logged-in user from their dashboard.
  	 *
  	 * Will usually contain feedback / charts on their achievements so far, along with the
  	 * ability to quickly make a new data entry.
  	 */
	public function module_dashboard($year = null,$month = null) {
  		$helper = new ModuleHelperFunctions();
  		$this->loadModel('TakeRegularExerciseModule.ExerciseWeekly');
		$this->loadModel('TakeRegularExerciseModule.ExerciseAchievement');
  		$this->loadModel('User');

  		// Use today's date if no date given.
  		if(is_null($month)) $month = gmdate("F");
  		if(is_null($year)) $year = gmdate("Y");
  		$this->set('month', $month);
  		$this->set('year', $year);
  		
  		// Get the current user
  		$userId = $this->Auth->user('id');

  		// Calendar Related Items:
  		$monthlyRecords = $helper->getMonthlyCalendarEntries($this->ExerciseWeekly, $userId, $year, $month);
  		$this->set('records', $monthlyRecords);
		$this->set('title_for_layout', 'My `' . $this->module_name() . '` Dashboard');
  	}
  	
  	public function dashboard_achievements() {
  		$this->loadModel('TakeRegularExerciseModule.ExerciseAchievement');
  	
  		// Don't allow this method to be called directly from a URL
  		if (empty($this->request->params['requested'])) {
  			throw new ForbiddenException();
  		}
  	
  		$achievements = $this->ExerciseAchievement->findByUserId($this->Auth->user('id'));
  		$this->set('achievements', $achievements);
  		$this->set('message', "Achievements from the " . $this->module_name());
  		$this->render();
  	}

  	/**
  	 * 'View Records' shows any entries that have been made in the module this month, when accessed by a logged-in user from their dashboard.
  	 */
	public function view_records($year = null,$month = null) {
  		$helper = new ModuleHelperFunctions();
  		$this->loadModel('TakeRegularExerciseModule.ExerciseWeekly');

  		// Use today's date if no date given.
  		if(is_null($month)) $month = gmdate("F");
  		if(is_null($year)) $year = gmdate("Y");
  		$this->set('month', $month);
  		$this->set('year', $year);
  		
  		// Get the current user
  		$userId = $this->Auth->user('id');

  		// Calendar Related Items:
  		$monthlyRecords = $helper->getMonthlyCalendarEntries($this->ExerciseWeekly, $userId, $year, $month);
  		$this->set('records', $monthlyRecords);
		$this->set('title_for_layout', 'My `' . $this->module_name() . '` records for '. $month . ' ' . $year);
  	}
  	
  	/**
  	 * Handles the weekly data entry form for this module.
  	 *
  	 * @param string $date the date for which this entry relates. If null, today's date will be used.
  	 */
  	public function data_entry($date = null) {
  		$this->loadModel('TakeRegularExerciseModule.ExerciseWeekly');
		$this->loadModel('TakeRegularExerciseModule.ExerciseAchievement');
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
  			if (isset($this->request->data['cancel'])) {
  				return $this->redirect('module_dashboard');
  			}
  			
  			// The form has been submitted, so validate and then save.
  				
  			// Re-calculate the total, and apply the user id (don't just rely on submitted form).
  			$this->ExerciseWeekly->create();
  			$this->ExerciseWeekly->set($this->request->data);
  			$total = $this->ExerciseWeekly->calculateTotal();
  			$this->ExerciseWeekly->set('total', $total);
  			$this->ExerciseWeekly->set('user_id', $this->User->data['User']['id']);
  	
  			if ($this->ExerciseWeekly->validates()) 
			{
  				$success = $this->ExerciseWeekly->save();
  	
  				if($success) 
				{
					//Re-calculate the achievement stats
					$this->ExerciseAchievement->create();
					$this->ExerciseAchievement->updateAchievements($this->User->data['User']['id']);
					$this->ExerciseAchievement->save();

					Cache::clear();
						
  					$this->Session->setFlash(__('Your weekly record for week beginning ' . date('d-m-Y',$weekBeginning) . ' has been stored.'));
  					return $this->redirect('module_dashboard');
  				} 
				else 
				{
  					$this->Session->setFlash(__('Your weekly record for week beginning ' . date('d-m-Y',$weekBeginning) . ' could not be recorded. Please try again.'));
					$this->set('title_for_layout', 'My `' . $this->module_name() . '` record for '. date('d-m-Y',$weekBeginning));
  				}
  			} else {
  				// Validation failed
  				$this->Session->setFlash(__('Your weekly record could not be saved. Please see the error messages below and try again.'));
				$this->set('title_for_layout', 'My `' . $this->module_name() . '` record for: '. date('d-m-Y',$weekBeginning));
  			}
  		} else {
  			// This is a new request for this form - display a blank or previous record
  				
  			// Is there a previous record for this date and user?
  			$this->ExerciseWeekly->create();
  			$previousEntry = $this->ExerciseWeekly->findByUserIdAndWeekBeginning(
  					$this->User->data['User']['id'],
  					date("Y-m-d",$weekBeginning));
  				
  			// If so, edit this entry instead of creating a new one...
  			if(!empty($previousEntry))
			{ 
				$this->request->data = $previousEntry;
				$this->set('title_for_layout', 'Edit my `' . $this->module_name() . '` record for: '. date('d-m-Y',$weekBeginning));
			}
			else $this->set('title_for_layout', 'Add my `' . $this->module_name() . '` record for: '. date('d-m-Y',$weekBeginning));
  		}
  	}
	
  	/**
  	 * Returns the .png graphic for the run-chart that is displayed on the module dashboard.
  	 */
  	public function minigraph() {
  		$this->loadModel('TakeRegularExerciseModule.ExerciseWeekly');
  		$this->layout = 'ajax';
  		$this->RequestHandler->respondAs('png');
  		$this->disableCache();
  	
  		// Retrieve all the weekly entries between the start week and the last day of the month
  		$lastThreeMonthEntries = $this->ExerciseWeekly->find('all',array(
  				'conditions' => array(
  						'user_id' => $this->Auth->user('id'),
  						'week_beginning >=' => date("Y-m-d", strtotime("-3 months")),
  						'week_beginning <=' => date("Y-m-d",time())
  				),
  				'order' => array('week_beginning' => 'asc')
  		));
  		
  		// Need at least three weeks of entries to display a chart...
  		if(count($lastThreeMonthEntries) < 3) 
		{
  			$this->response->file('/webroot/img/not-enough-data-chart.png');
  			return $this->response;
  		}
  	
  		$ydata = array();
  		$dates = array();
  	
  		// Iterate through the entries and reformat them into separate arrays for the graph function.
  		foreach($lastThreeMonthEntries as $key => $weeklyEntry) {
  			$ydata[] = $weeklyEntry['ExerciseWeekly']['total'];
  			$dates[] = strtotime($weeklyEntry['ExerciseWeekly']['week_beginning']);
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
  		$this->loadModel('TakeRegularExerciseModule.ExerciseWeekly');
  		
  		// Don't allow this method to be called directly from a URL
  		if (empty($this->request->params['requested'])) {
  			throw new ForbiddenException();
  		}
  		
  		return $this->ExerciseWeekly->find('count');
  	}
	
	
  	/**
  	 * Admin panel view.
  	 */
  	public function admin_module_data() {
  		$this->redirectIfNotAdmin();
  		
  		$this->loadModel('Module');
  		$this->loadModel('TakeRegularExerciseModule.ExerciseScreener');
  		$this->loadModel('TakeRegularExerciseModule.ExerciseWeekly');
  		
  		// Don't allow this method to be called directly from a URL
  		if (empty($this->request->params['requested'])) {
  			throw new ForbiddenException();
  		}
  		$module = $this->Module->findByName($this->module_name);

  		if(empty($module)) {
  			throw new NotFoundException("The " . $this->module_name . " could not be found in the database");
  		}
  		
  		$this->set('module',$module);
  		
  		$screeners = $this->ExerciseScreener->find('count');
  		$this->set('screeners',$screeners);
  		
  		$weeklyRecords = $this->ExerciseWeekly->find('count');
  		$this->set('weeklyRecords',$weeklyRecords);
  		
  		$this->render();
  	}
  	
  	/**
  	 * Exports a full set of screener data.
  	 */
  	public function admin_export_screeners() {
  		$this->redirectIfNotAdmin();
  		
  		$this->loadModel('TakeRegularExerciseModule.ExerciseScreener');
  		
  		$filename = "exercise_screener_export_".date("Y.m.d").".csv";
  		
  		$headerRow = array("User ID",
  				"Vigorous Days", "Vigourous Minutes",
  				"Moderate Days", "Moderate Minutes",
  				"Walking Days", "Walking Minutes",
  				"Sedentary Minutes",
				"Score",
  				"Feedback",
  				"Created",
  				"Modified");
  		
  		$dataFields = array("user_id",
  				"vigorous_days", "vigorous_mins",
  				"moderate_days", "moderate_mins",
  				"walking_days", "walking_mins",
  				"sedentary_mins",
				"score",
				"feedback",
  				"created",
  				"modified");
  		
  		$this->exportCSVFile($this->ExerciseScreener, $filename, $headerRow, $dataFields);
  	}
  	
  	/**
  	 * Exports a full set of weekly data.
  	 */
  	public function admin_export_weekly() {
  		$this->redirectIfNotAdmin();
  		
  		$this->loadModel('TakeRegularExerciseModule.ExerciseWeekly');
  		
  		$filename = "exercise_weekly_export_".date("Y.m.d").".csv";
  		
  		$headerRow = array("Week beginning",
  				"User ID",
  				"Monday",
  				"Tuesday",
  				"Wednesday",
  				"Thursday",
  				"Friday",
  				"Saturday",
  				"Sunday",
  				"Total",
  				"What worked");
  		
  		$dataFields = array("week_beginning",
  				"user_id",
  				"monday",
  				"tuesday",
  				"wednesday",
  				"thursday",
  				"friday",
  				"saturday",
  				"sunday",
  				"total",
  				"what_worked");

  		$this->exportCSVFile($this->ExerciseWeekly, $filename, $headerRow, $dataFields);
  	}
  	
  	/**
  	 * Tidies up database in preparation for the module to be deleted from the website.
  	 */
  	public function admin_delete_module() {
  		$this->redirectIfNotAdmin();
  		
  		$this->loadModel('TakeRegularExerciseModule.ExerciseScreener');
  		$this->loadModel('TakeRegularExerciseModule.ExerciseWeekly');
  		$this->loadModel('TakeRegularExerciseModule.ExerciseAchievement');
  		
  		$this->ExerciseScreener->query("DROP TABLE `exercise_screeners`");
  		$this->ExerciseWeekly->query("DROP TABLE `exercise_weekly`");
  		$this->ExerciseAchievement->query("DROP TABLE `exercise_achievements`");
  	}
  	
  	/**
  	 * Returns the SQL necessary to create and set up the module for use.
  	 * 
  	 * @return array of SQL commands to execute
  	 */
  	public function admin_install_sql() {
  		$this->redirectIfNotAdmin();
  		
  		$installSQL[] = "
  			DROP TABLE IF EXISTS `exercise_achievements`;
			CREATE TABLE IF NOT EXISTS `exercise_achievements` (
			  `user_id` int(11) NOT NULL,
			  `best_week_so_far` datetime NOT NULL,
			  `total_minutes` int(11) NOT NULL default '0',
			  `total_full_weeks_healthy` int(11) NOT NULL default '0',
			  `consec_healthy_weeks` int(10) NOT NULL default '0',
			  `created` datetime NOT NULL,
			  `modified` datetime NOT NULL,
			  PRIMARY KEY  (`user_id`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
  		
  		$installSQL[] = "
  			DROP TABLE IF EXISTS `exercise_screeners`;
			CREATE TABLE IF NOT EXISTS `exercise_screeners` (
			  `id` int(11) NOT NULL auto_increment,
			  `user_id` int(11) NOT NULL,
			  `vigorous_days` int(11) NOT NULL default '0',
			  `vigorous_mins` int(11) NOT NULL default '0',
			  `moderate_days` int(11) NOT NULL default '0',
			  `moderate_mins` int(11) NOT NULL default '0',
			  `walking_days` int(11) NOT NULL default '0',
			  `walking_mins` int(11) NOT NULL default '0',
			  `sedentary_mins` int(11) NOT NULL default '0',
			  `score` int(11) NOT NULL,
			  `feedback` varchar(10) NOT NULL,
			  `created` datetime NOT NULL,
			  `modified` datetime NOT NULL,
			  PRIMARY KEY  (`id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
  		
  		$installSQL[] = "
  			DROP TABLE IF EXISTS `exercise_weekly`;
			CREATE TABLE IF NOT EXISTS `exercise_weekly` (
			  `id` int(11) unsigned NOT NULL auto_increment,
			  `week_beginning` date NOT NULL,
			  `user_id` int(11) NOT NULL,
			  `monday` int(11) default NULL,
			  `tuesday` int(11) default NULL,
			  `wednesday` int(11) default NULL,
			  `thursday` int(11) default NULL,
			  `friday` int(11) default NULL,
			  `saturday` int(11) default NULL,
			  `sunday` int(11) default NULL,
			  `total` int(11) NOT NULL,
			  `created` datetime NOT NULL,
			  `modified` datetime NOT NULL,
			  `what_worked` text,
			  PRIMARY KEY  (`id`),
			  UNIQUE KEY `uc_weekUserID` (`week_beginning`,`user_id`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
  		
  		return $installSQL;
  	}
}
?>