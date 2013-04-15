<?php
App::uses('AppModel', 'Model');
/**
 * BMIAchievement Model
 *
 */
class BmiAchievement extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'user_id';
	public $useTable = 'bmi_achievements';
	
	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
			'User' => array(
					'className' => 'User',
					'foreignKey' => 'user_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			)
	);
	
	public $hasMany = array(
			'BmiWeekly' => array(
					'className' => 'HealthyWeightModule.BmiWeekly',
					'foreignKey' => 'user_id'
			)
	);
	
	/**
	 * Variable to indicate what a 'healthy day' score should be. Any daily score over this number
	 * counts as a 'healthy day' for this example module.
	 */
	private $lowHealthyScore = 18.5;
	private $highHealthyScore = 24.9;

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'healthy_days_last_week' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'total_days_healthy' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'total_full_weeks_healthy' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'consec_healthy_weeks' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	/**
	 * Updates all of the achievement records for the given user (but does not save to database).
	 * NB - calling this function also sets the user_id of this instance of the model.
	 * 
	 * @param int $user_id
	 */
	public function updateAchievements($user_id) 
	{
		// Don't rely on the latest BMI - load it from the Weekly
		$query = "SELECT `bmi` FROM `bmi_weekly` WHERE user_id = " . $user_id . " ORDER BY `week_beginning` DESC LIMIT 1";
		$latest_bmi = $this->query($query);
		
		if(empty($latest_bmi)) {
			// No weekly records, so use the BMI screener instead.
			$query = "SELECT `start_bmi` FROM `bmi_screeners` WHERE user_id = " . $user_id;
			$latest_bmi = $this->query($query);
			debug($latest_bmi);
			$latestBMI = $latest_bmi[0]['bmi_screeners']['start_bmi'];
		} else {
			// Use the latest weekly record.
			$latestBMI = $latest_bmi[0]['bmi_weekly']['bmi'];
		}
		
		$changeSinceStart = $this->changeSinceStart($user_id);
		$totalConsecWeeks = $this->totalWeeksHealthyConsec($user_id);
		
		$this->set('user_id', $user_id);
		$this->set('latest_bmi', $latestBMI);
		$this->set('change_since_start', $changeSinceStart);
		$this->set('consec_healthy_weeks', $totalConsecWeeks);
	}
	
	/* Returns the total loss or gain in weight since the start */
	private function changeSinceStart($user_id) 
	{
		$difference = 0;
		// Load the start Weight
		$query = "SELECT `start_weight_kg` FROM `bmi_screeners` WHERE user_id = " . $user_id . " ORDER BY `id` DESC LIMIT 1";
		$start_weight = $this->query($query);
		
		// Load the last recorded weight
		$query2 = "SELECT `weight_kg` FROM `bmi_weekly` WHERE user_id = " . $user_id . " ORDER BY `week_beginning` DESC LIMIT 1";
		$latest_weight = $this->query($query2);
		
		if(empty($start_weight) || empty($latest_weight)) return 0;
		
		//echo $query . " - " . $query2 . "<br/>"; 
		//echo $latest_weight . " - " . $start_weight;
		if ($latest_weight[0]['bmi_weekly']['weight_kg'] != null and $start_weight[0]['bmi_screeners']['start_weight_kg'] != null){
			// Assuming start weight is higher and therefore producing a "loss" of weight (negative)
			$difference = ($latest_weight[0]['bmi_weekly']['weight_kg'] * 1) - ($start_weight[0]['bmi_screeners']['start_weight_kg'] * 1);
		}
		else $difference = 0;
		return $difference;
	}
	
	/**
	 * Returns the total number of consecutive weekly records for the given user where there BMI is within the healthy range.
	 * This routine works backwards from the last 'week beginning Monday' of the current date.
	 *
	 * @param string $user_id
	 * @return number
	 */
	private function totalWeeksHealthyConsec($user_id = null) {
		$helper = new ModuleHelperFunctions();
		
		$currentDate = date('Y-m-d',$helper->_getWeekBeginningDate(date('Y-m-d')));
		$expectedWeek = date('Y-m-d',strtotime("last week " . $currentDate));
	
		// Retrieve all the weekly entries between the start week and the last day of the month
		$this->BmiWeekly->create();
		$healthyWeeks = $this->BmiWeekly->find('all',array(
				'conditions' => array(
						'user_id' => $user_id,
						'bmi >=' => $this->lowHealthyScore,
						'bmi <=' => $this->highHealthyScore,
						'week_beginning <=' => $expectedWeek
				),
				'order' => array('week_beginning' => 'desc')
		));
	
		$total = 0;
	
		foreach($healthyWeeks as $week)
		{
			$weekBeginning = $week['BmiWeekly']['week_beginning'];
				
			// Is there a gap between entries?
			if ($expectedWeek != $weekBeginning) return $total; // the weeks are not consecutive - so return the total.
				
			$expectedWeek = date('Y-m-d',strtotime("last week " . $weekBeginning));
			$total++;
		}
		return $total; // number of consecutive healthy weeks
	}
	
	public function getMedal() {
		$consecHealthyWeeks = $this->data['BmiAchievement']['consec_healthy_weeks'];
		if ($consecHealthyWeeks >= 8){
			return "Gold";
		}
		elseif ($consecHealthyWeeks >= 4){
			return "Silver";
		}
		elseif ($consecHealthyWeeks >= 2){
			return "Bronze";
		}
		else
		{
			return;
		}
	}
}
?>