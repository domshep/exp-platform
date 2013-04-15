<?php
App::uses('AppModel', 'Model');
/**
 * StopSmokingAchievement Model
 *
 */
class StopSmokingAchievement extends AppModel {

/**
 * Primary key field
 *
 * @var string
 */
	public $primaryKey = 'user_id';
	
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
			'StopSmokingWeekly' => array(
					'className' => 'StopSmokingModule.StopSmokingWeekly',
					'foreignKey' => 'user_id'
			)
	);
	
	/**
	 * Variable to indicate what a 'healthy day' score should be. Any daily score over this number
	 * counts as a 'healthy day' for this example module.
	 */
	private $healthyScore = 1;
	private $healthyWeekScore = 7;

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
	);
	
	/**
	 * Updates all of the achievement records for the given user (but does not save to database).
	 * NB - calling this function also sets the user_id of this instance of the model.
	 * 
	 * @param int $user_id
	 */
	public function updateAchievements($user_id) {
		$helper = new ModuleHelperFunctions();
		
		$healthyDaysLastWeek = $this->healthyDaysLastWeek($user_id);
		$totalDaysHealthy = $this->totalDaysHealthy($user_id);
		$healthyWeeks = $this->totalHealthyWeeks($user_id);
		$totalConsecWeeks = $helper->totalWeeksHealthyConsec($this->StopSmokingWeekly, $user_id, $this->healthyWeekScore);
		
		$this->set('user_id', $user_id);
		$this->set('healthy_days_last_week', $healthyDaysLastWeek);
		$this->set('total_days_healthy', $totalDaysHealthy);
		$this->set('total_full_weeks_healthy', $healthyWeeks);
		$this->set('consec_healthy_weeks', $totalConsecWeeks);
	}
	
	/**
	 * Returns the total number of smoke free weeks recorded, where the given user has recorded 'smoke free'
	 * every single day.
	 * 
	 * @param int $user_id
	 */
	private function totalHealthyWeeks($user_id) {
		$total = $this->query("SELECT COUNT(*) AS `total` FROM `stop_smoking_weekly` WHERE user_id = " . $user_id
				. " AND ("
				. " monday >= " . $this->healthyScore
				. " AND tuesday >= " . $this->healthyScore
				. " AND wednesday >= " . $this->healthyScore
				. " AND thursday >= " . $this->healthyScore
				. " AND friday >= " . $this->healthyScore
				. " AND saturday >= " . $this->healthyScore
				. " AND sunday >= " . $this->healthyScore
				. ");"
				);
		return $total[0][0]['total'];
	}
	
	/**
	 * Returns the total number of days  where the given user has recorded a 'feeling healthy' score.
	 * 
	 * @param int $user_id
	 * @return number
	 */
	private function totalDaysHealthy($user_id) {
		$containHealthyDays = $this->query("SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM `stop_smoking_weekly` WHERE user_id = " . $user_id
				. " AND ("
				. " monday >= " . $this->healthyScore
				. " OR tuesday >= " . $this->healthyScore
				. " OR wednesday >= " . $this->healthyScore
				. " OR thursday >= " . $this->healthyScore
				. " OR friday >= " . $this->healthyScore
				. " OR saturday >= " . $this->healthyScore
				. " OR sunday >= " . $this->healthyScore
				. ");"
				);
		
		if(empty($containHealthyDays)) return 0;
		
		$total = 0;
		foreach($containHealthyDays as $week) {
			foreach($week['stop_smoking_weekly'] as $day) {
				if ($day >= $this->healthyScore) {
					$total++;
				}
			}
		}
		return $total;
	}
	
	/**
	 * Returns the total number of days in the last calendar week where the given user has recorded a 'feeling healthy' score.
	 *
	 * @param int $user_id
	 * @return number
	 */
	private function healthyDaysLastWeek($user_id) {
		$lastWeek = $this->query("SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM `stop_smoking_weekly` WHERE user_id = " . $user_id
				. " AND (week_beginning >= DATE_SUB(curdate(),INTERVAL 13 DAY)"
				. " AND week_beginning < DATE_SUB(curdate(),INTERVAL 6 DAY));"
		);
		
		if(empty($lastWeek)) return 0;
		
		$total = 0;
		foreach($lastWeek[0]['stop_smoking_weekly'] as $day) {
			if ($day >= $this->healthyScore) {
				$total++;
			}
		}
		return $total;
	}
	

	public function getMedal() {
		$consecHealthyWeeks = $this->data['StopSmokingAchievement']['consec_healthy_weeks'];
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