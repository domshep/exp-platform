<?php
App::uses('AppModel', 'Model');
/**
 * ExerciseAchievement Model
 *
 */
class DrinkingAchievement extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'user_id';
	public $useTable = 'drinking_achievements';
	
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
			'DrinkingWeekly' => array(
					'className' => 'DrinkSafelyModule.DrinkingWeekly',
					'foreignKey' => 'user_id'
			)
	);
	
	/**
	 * Variable to indicate what a 'healthy day' score should be. Any daily score over this number
	 * counts as a 'healthy day' for this example module.
	 */
	private function healthyScore($gender){
		if ($gender == "F") return 3;
		else return 4;
	}
	private function bingeScore($gender){
		if ($gender == "F") return 6;
		else return 8;
	}
	private function healthyWeekScore($gender){
		if ($gender == "F") return 15;
		else return 20;
	}
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
	public function updateAchievements($user_id,$gender) {
		$helper = new ModuleHelperFunctions();
		
		$totalSensibleDays = $this->totalSensibleDays($user_id,$gender);
		$totalExcessDays = $this->totalExcessDays($user_id,$gender);
		$totalBingeDays = $this->totalBingeDays($user_id,$gender);
		$totalConsecWeeks = $this->totalWeeksNoBingeConsec($user_id,$gender);
		
		$this->set('user_id', $user_id);
		$this->set('total_sensible_days', $totalSensibleDays);
		$this->set('total_excess_days', $totalExcessDays);
		$this->set('total_binge_days', $totalBingeDays);
		$this->set('consec_healthy_weeks', $totalConsecWeeks);
	}
	
	/**
	 * Returns the total number of consecutive weekly records for the given user and model which have a
	 * 'total' score of greater than or equal to $healthyScore. This routine works backwards from the last 'week beginning
	 * Monday' of the current date.
	 *  
	 * @param string $user_id
	 * @param number $healthyScore
	 * @return number
	 */
	private function totalWeeksNoBingeConsec($user_id = null, $gender = null) {
		$helper = new ModuleHelperFunctions();
		
		$currentDate = date('Y-m-d',$helper->_getWeekBeginningDate(date('Y-m-d')));
		$expectedWeek = $currentDate; //date('Y-m-d',strtotime("last week " . $currentDate));
		
		$healthyWeeks = $this->query("SELECT * FROM `drinking_weekly` WHERE user_id = " . $user_id
				. " AND "
				. " monday < " . $this->bingeScore($gender)
				. " AND tuesday < " . $this->bingeScore($gender)
				. " AND wednesday < " . $this->bingeScore($gender)
				. " AND thursday < " . $this->bingeScore($gender)
				. " AND friday < " . $this->bingeScore($gender)
				. " AND saturday < " . $this->bingeScore($gender)
				. " AND sunday < " . $this->bingeScore($gender)
				. " AND total <= " . $this->healthyWeekScore($gender) . " ORDER BY week_beginning DESC"
		);
		$total = 0;
		
		foreach($healthyWeeks as $week)
		{
			$weekBeginning = $week['drinking_weekly']['week_beginning'];
			
			// Is there a gap between entries?
			if ($expectedWeek != $weekBeginning) return $total; // the weeks are not consecutive - so return the total.
			
			$expectedWeek = date('Y-m-d',strtotime("last week " . $weekBeginning));
			$total++;
		}
		return $total; // number of consecutive healthy weeks
	}
	
	/**
	 * Returns the total number of days where the given user has drunk a sensible number of units.
	 * 
	 * @param int $user_id, @param varchar $gender (M or F)
	 * @return number
	 */
	private function totalSensibleDays($user_id,$gender) {
		$containHealthyDays = $this->query("SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM `drinking_weekly` WHERE user_id = " . $user_id
				. " AND ("
				. " monday <= " . $this->healthyScore($gender)
				. " OR tuesday <= " . $this->healthyScore($gender)
				. " OR wednesday <= " . $this->healthyScore($gender)
				. " OR thursday <= " . $this->healthyScore($gender)
				. " OR friday <= " . $this->healthyScore($gender)
				. " OR saturday <= " . $this->healthyScore($gender)
				. " OR sunday <= " . $this->healthyScore($gender)
				. ");"
				);
		
		if(empty($containHealthyDays)) return 0;
		
		$total = 0;
		foreach($containHealthyDays as $week) {
			foreach($week['drinking_weekly'] as $day) {
				if ($day <= $this->healthyScore($gender)) {
					$total++;
				}
			}
		}
		return $total;
	}
	
	/**
	 * Returns the total number of days where the given user has drunk in excess of a sensible number of units.
	 * but less than that which would be considered binge drinking
	 * @param int $user_id, @param varchar $gender (M or F)
	 * @return number
	 */
	private function totalExcessDays($user_id,$gender) {
		$containExcessDays = $this->query("SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM `drinking_weekly` WHERE user_id = " . $user_id
				. " AND ("
				. " (monday > " . $this->healthyScore($gender) . " AND monday < " . $this->bingeScore($gender) . ")" 
				. " OR (tuesday <= " . $this->healthyScore($gender) . " AND tuesday < " . $this->bingeScore($gender) . ")"
				. " OR (wednesday <= " . $this->healthyScore($gender) . " AND wednesday < " . $this->bingeScore($gender) . ")"
				. " OR (thursday <= " . $this->healthyScore($gender) . " AND thursday < " . $this->bingeScore($gender) . ")"
				. " OR (friday <= " . $this->healthyScore($gender) . " AND friday < " . $this->bingeScore($gender) . ")"
				. " OR (saturday <= " . $this->healthyScore($gender) . " AND saturday < " . $this->bingeScore($gender) . ")"
				. " OR (sunday <= " . $this->healthyScore($gender) . " AND sunday < " . $this->bingeScore($gender) . ")"
				. ");"
				);
		
		if(empty($containExcessDays)) return 0;
		
		$total = 0;
		foreach($containExcessDays as $week) {
			foreach($week['drinking_weekly'] as $day) {
				if ($day > $this->healthyScore($gender) and $day < $this->bingeScore($gender)) {
					$total++;
				}
			}
		}
		return $total;
	}
	
	/**
	 * Returns the total number of days where the given user has been binge drinking.
	 * 
	 * @param int $user_id, @param varchar $gender (M or F)
	 * @return number
	 */
	private function totalBingeDays($user_id,$gender) {
		$containBingeDays = $this->query("SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM `drinking_weekly` WHERE user_id = " . $user_id
				. " AND ("
				. " monday >= " . $this->bingeScore($gender)
				. " OR tuesday >= " . $this->bingeScore($gender)
				. " OR wednesday >= " . $this->bingeScore($gender)
				. " OR thursday >= " . $this->bingeScore($gender)
				. " OR friday >= " . $this->bingeScore($gender)
				. " OR saturday >= " . $this->bingeScore($gender)
				. " OR sunday >= " . $this->bingeScore($gender)
				. ");"
				);
		
		if(empty($containBingeDays)) return 0;
		
		$total = 0;
		foreach($containBingeDays as $week) {
			foreach($week['drinking_weekly'] as $day) {
				if ($day >= $this->bingeScore($gender)) {
					$total++;
				}
			}
		}
		return $total;
	}

	public function getMedal() {
		$consecHealthyWeeks = $this->data['DrinkingAchievement']['consec_healthy_weeks'];
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