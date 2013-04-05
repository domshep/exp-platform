<?php
App::uses('BmiModuleAppModel', 'BmiModule.Model');
/**
 * BMIAchievement Model
 *
 */
class BmiAchievement extends BmiModuleAppModel {

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
	
	/**
	 * Variable to indicate what a 'healthy day' score should be. Any daily score over this number
	 * counts as a 'healthy day' for this example module.
	 */
	private $healthyScore = 0;
	private $healthyWeekScore = 0;

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
	public function updateAchievements($user_id,$latestBMI) {
		//$healthyDaysLastWeek = $this->healthyDaysLastWeek($user_id);
		//$totalDaysHealthy = $this->totalDaysHealthy($user_id);
		//$healthyWeeks = $this->totalHealthyWeeks($user_id);
		//$totalConsecWeeks = $this->totalWeeksHealthyConsec($user_id);
		$changeSinceStart = $this->changeSinceStart($user_id);
		
		$this->set('user_id', $user_id);
		$this->set('latest_bmi', $latestBMI);
		$this->set('change_since_start', $changeSinceStart);
	}
	
	/**
	 * Returns the total number of healthy weeks recorded, where the given user has recorded a 'feeling healthy' score
	 * every single day.
	 * 
	 * @param int $user_id
	 */
	private function totalHealthyWeeks($user_id) {
		/*$total = $this->query("SELECT COUNT(*) AS `total` FROM `bmi_weekly` WHERE user_id = " . $user_id
				. " AND ("
				. " total >= " . $this->healthyWeekScore . ");"
				);
		return $total[0][0]['total']; */
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
	 * Returns the total number of days  where the given user has recorded a 'feeling healthy' score.
	 * 
	 * @param int $user_id
	 * @return number
	 */
	private function totalDaysHealthy($user_id) {
	/*
		$containHealthyDays = $this->query("SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM `bmi_weekly` WHERE user_id = " . $user_id
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
			foreach($week['bmi_weekly'] as $day) {
				if ($day >= $this->healthyScore) {
					$total++;
				}
			}
		}
		return $total; */
	}
	
	
	/**
	 * Returns the number of consecutively healthy weeks.
	 * If the run is interrupted the total resets to 0.
	 * @param int $user_id
	 * @return number
	 */
	private function totalWeeksHealthyConsec($user_id) {
		/* $healthyWeeks = $this->query("SELECT `total` FROM `bmi_weekly` WHERE user_id = " . $user_id . " ORDER BY `week_beginning`");
		
		if(empty($healthyWeeks)) return 0;
	
		$total = 0;
		foreach($healthyWeeks as $week) {
			$thisweek = $week['bmi_weekly'];
			if ($thisweek['total'] >= ($this->healthyScore * 7)) $total++;
			else $total = 0;
		}
		return $total; // number of consecutive healthy weeks */
	}
	
	/**
	 * Returns the total number of days in the last calendar week where the given user has recorded a 'feeling healthy' score.
	 *
	 * @param int $user_id
	 * @return number
	 */
	private function healthyDaysLastWeek($user_id) {
	/*
		$lastWeek = $this->query("SELECT monday, tuesday, wednesday, thursday, friday, saturday, sunday FROM `bmi_weekly` WHERE user_id = " . $user_id
				. " AND (week_beginning >= DATE_SUB(curdate(),INTERVAL 13 DAY)"
				. " AND week_beginning < DATE_SUB(curdate(),INTERVAL 6 DAY));"
		);
		
		if(empty($lastWeek)) return 0;
		
		$total = 0;
		foreach($lastWeek[0]['bmi_weekly'] as $day) {
			if ($day >= $this->healthyScore) {
				$total++;
			}
		}
		return $total; */
	}
}
?>