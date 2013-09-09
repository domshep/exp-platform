<?php
App::uses('AppModel', 'Model');
/**
 * SimpleHealthTestAchievement Model
 *
 */
class SimpleHealthTestAchievement extends AppModel {

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
			'SimpleHealthTestWeekly' => array(
					'className' => 'ExampleModule.SimpleHealthTestWeekly',
					'foreignKey' => 'user_id'
			)
	);
	
	/**
	 * Variable to indicate what a 'healthy day' score should be. Any daily score over this number
	 * counts as a 'healthy day' for this example module.
	 */
	private $healthyScore = 7;
	private $healthyWeekScore = 49;

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
		$totalConsecWeeks = $helper->totalWeeksHealthyConsec($this->SimpleHealthTestWeekly, $user_id, $this->healthyWeekScore);
		
		$this->set('user_id', $user_id);
		$this->set('healthy_days_last_week', $healthyDaysLastWeek);
		$this->set('total_days_healthy', $totalDaysHealthy);
		$this->set('total_full_weeks_healthy', $healthyWeeks);
		$this->set('consec_healthy_weeks', $totalConsecWeeks);
	}
	
	/**
	 * Returns the total number of healthy weeks recorded, where the given user has recorded a 'feeling healthy' score
	 * every single day.
	 * 
	 * @param int $user_id
	 */
	private function totalHealthyWeeks($user_id) {
		$total = $this->SimpleHealthTestWeekly->find('count', array(
							'conditions' => array(
									'user_id' => $user_id,
									'monday >=' => $this->healthyScore,
									'tuesday >=' => $this->healthyScore,
									'wednesday >=' => $this->healthyScore,
									'thursday >=' => $this->healthyScore,
									'friday >=' => $this->healthyScore,
									'saturday >=' => $this->healthyScore,
									'sunday >=' => $this->healthyScore
									)));
		return $total;
	}
	
	/**
	 * Returns the number of consecutively healthy weeks.
	 * If the run is interrupted the total resets to 0.
	 * @param int $user_id
	 * @return number
	 */
	private function totalWeeksHealthyConsec($user_id) {
		$healthyWeeks = $this->query("SELECT `total`,`week_beginning`  FROM `simple_health_test_weekly` WHERE user_id = " . $user_id . " ORDER BY `week_beginning`");
		
		if(empty($healthyWeeks)) return 0;
	
		$total = 0;
		$previousWeek = "";

		foreach($healthyWeeks as $week) 
		{
			// Is there a gap between entries?
			$weekBeginning = $week['week_beginning'];
			if ($previousWeek != "")
			{
				$date = new DateTime($previousWeek);
				$date->add(new DateInterval('P7D'));
				if ($date != $weekBeginning) $total = 0; // the weeks are not consecutive - so reset the total.
			}
			
			$thisweek = $week['simple_health_test_weekly'];
			if ($thisweek['total'] >= ($this->healthyScore * 7)) $total++;
			else $total = 0;
			
			$previousWeek = $thisweek;
		}
		return $total; // number of consecutive healthy weeks
	}
	
	/**
	 * Returns the total number of days  where the given user has recorded a 'feeling healthy' score.
	 * 
	 * @param int $user_id
	 * @return number
	 */
	private function totalDaysHealthy($user_id) {
		$containHealthyDays = $this->query("SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM `simple_health_test_weekly` WHERE user_id = " . $user_id
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
			foreach($week['simple_health_test_weekly'] as $day) {
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
		$lastWeek = $this->query("SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM `simple_health_test_weekly` WHERE user_id = " . $user_id
				. " AND (week_beginning >= DATE_SUB(curdate(),INTERVAL 13 DAY)"
				. " AND week_beginning < DATE_SUB(curdate(),INTERVAL 6 DAY));"
		);
		
		if(empty($lastWeek)) return 0;
		
		$total = 0;
		foreach($lastWeek[0]['simple_health_test_weekly'] as $day) {
			if ($day >= $this->healthyScore) {
				$total++;
			}
		}
		return $total;
	}
	

	public function getMedal() {
		$consecHealthyWeeks = $this->data['SimpleHealthTestAchievement']['consec_healthy_weeks'];
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
