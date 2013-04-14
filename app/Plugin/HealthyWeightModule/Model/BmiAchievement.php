<?php
App::uses('BmiModuleAppModel', 'HealthyWeightModule.Model');
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
	public function updateAchievements($user_id,$latestBMI) 
	{
		// Don't rely on the latest BMI - load it from the Weekly
		$query = "SELECT `bmi` FROM `bmi_weekly` WHERE user_id = " . $user_id . " ORDER BY `week_beginning` DESC LIMIT 1";
		$latest_bmi = $this->query($query);
		$latestBMI = $latest_bmi[0]['bmi_weekly']['bmi'];
		
		$changeSinceStart = $this->changeSinceStart($user_id);
		
		$this->set('user_id', $user_id);
		$this->set('latest_bmi', $latestBMI);
		$this->set('change_since_start', $changeSinceStart);
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
	
}
?>