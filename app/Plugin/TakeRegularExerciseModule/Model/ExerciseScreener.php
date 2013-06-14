<?php
App::uses('AppModel', 'Model');
/**
 * fiveadayScreener Model
 *
 * @property User $User
 */
class ExerciseScreener extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'exercise_screeners';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

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
	
	public $validate = array(
			'vigorous_days' => array(
					'valid' => array(
							'rule' => array('range', -1, 8),
							'message' => 'Please select a number between 0 and 7 days',
					)
			),
			'vigorous_mins' => array(
					'valid' => array(
						'rule'    => array('range', -1, 301),
						'message' => 'Please enter a number between 0 and 300 minutes',
					)
			)
			,'moderate_days' => array(
					'valid' => array(
							'rule' => array('range', -1, 8),
							'message' => 'Please select a number between 0 and 7 days',
					)
			),
			'moderate_mins' => array(
					'valid' => array(
						'rule'    => array('range', -1, 301),
						'message' => 'Please enter a number between 0 and 300 minutes',
					)
			)
			,'walking_days' => array(
					'valid' => array(
							'rule' => array('range', -1, 8),
							'message' => 'Please select a number between 0 and 7 days',
					)
			),
			'walking_mins' => array(
					'valid' => array(
						'rule'    => array('range', -1, 301),
						'message' => 'Please enter a number between 0 and 300 minutes',
					)
			),
			'sedentary_mins' => array(
					'valid' => array(
						'rule'    => array('range', -1, 3001),
						'message' => 'Please enter a number between 0 and 3000 minutes',
					)
			)
	);
	
	private function calculateVigorousMET() {
		return 8 * ($this->data['ExerciseScreener']['vigorous_days'] * $this->data['ExerciseScreener']['vigorous_mins']);
	}
	
	private function calculateModerateMET() {
		return 4 * ($this->data['ExerciseScreener']['moderate_days'] * $this->data['ExerciseScreener']['moderate_mins']);
	}

	private function calculateWalkingMET() {
		return 3.3 * ($this->data['ExerciseScreener']['walking_days'] * $this->data['ExerciseScreener']['walking_mins']);
	}
	
	/**
	 * Calculates the MET score for the data held by this object.
	 * 
	 * Equation is (8 * vigorous_days * vigorous_mins) + (4 * moderate_days * moderate_mins) + (3.3 * walking_days * walking_mins)
	 * 
	 * @return number
	 */
	public function calculateMETScore() {
		return $this->calculateVigorousMET() + $this->calculateModerateMET() + $this->calculateWalkingMET();
	}
	
	/**
	 * Returns a string describing the exercise level of the data held by this object against recommended targets.
	 * 
	 * @return string Will return either "HIGH", "MODERATE" or "LOW"
	 */
	public function getFeedbackLevel() {
		$vigorous_met = $this->calculateVigorousMET();
		$moderate_met = $this->calculateModerateMET();
		$walking_met = $this->calculateWalkingMET();
		$total_days = $this->data['ExerciseScreener']['vigorous_days'] + $this->data['ExerciseScreener']['moderate_days'] + $this->data['ExerciseScreener']['walking_days'];
		$total_met = $vigorous_met + $moderate_met + $walking_met;
		
		if(($this->data['ExerciseScreener']['vigorous_days'] >= 3) && ($vigorous_met >= 1500)) {
			return "HIGH";
		} elseif (($total_days > 7) && ($total_met >= 3000)) {
			return "HIGH";
		} elseif (($this->data['ExerciseScreener']['vigorous_days'] >= 3) && ($this->data['ExerciseScreener']['vigorous_mins'] >= 20)) {
			return "MODERATE";
		} elseif ((($this->data['ExerciseScreener']['moderate_days'] + $this->data['ExerciseScreener']['walking_days']) >= 5)
				&& (($this->data['ExerciseScreener']['moderate_mins'] + $this->data['ExerciseScreener']['walking_mins']) >= 30)) {
			return "MODERATE";
		} elseif (($total_days >= 5) && ($total_met >= 600)) {
			return "MODERATE";
		}
		
		return "LOW";
		
	}
}
