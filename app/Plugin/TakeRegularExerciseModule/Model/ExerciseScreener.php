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
							'message' => 'Please enter how many days you have done vigorous physical exercise during the past 7 days. Or click the "No exercise activity" box',
					)
			),
			'vigorous_mins' => array(
					'valid' => array(
						'rule'    => array('range', -1, 300),
						'message' => 'Please enter how many minutes of exercise of vigorous physical exercise you have done each day this week on average.',
					)
			)
			,'moderate_days' => array(
					'valid' => array(
							'rule' => array('range', -1, 8),
							'message' => 'Please enter how many days you have done moderate physical exercise during the past 7 days. Or click the "No exercise activity" box',
					)
			),
			'moderate_mins' => array(
					'valid' => array(
						'rule'    => array('range', -1, 300),
						'message' => 'Please enter how many minutes of moderate physical exercise you have done each day this week on average.',
					)
			)
			,'walking_days' => array(
					'valid' => array(
							'rule' => array('range', -1, 8),
							'message' => 'Please enter how many days you have done walking activities during the past 7 days. Or click the "No exercise activity" box',
					)
			),
			'walking_mins' => array(
					'valid' => array(
						'rule'    => array('range', -1, 300),
						'message' => 'Please enter how many minutes of walking activities you have done each day this week on average.',
					)
			),
			'sedentary_mins' => array(
					'valid' => array(
						'rule'    => array('range', -1, 300),
						'message' => 'Please enter how many minutes of sedentary exercise have done each day this week on average.',
					)
			)
	);
	
	public function calculateScore() {
		$score = ($this->data['ExerciseScreener']['vigorous_days'] * $this->data['ExerciseScreener']['vigorous_mins'])
				+ ($this->data['ExerciseScreener']['moderate_days'] * $this->data['ExerciseScreener']['moderate_mins'])
				+ ($this->data['ExerciseScreener']['walking_days'] * $this->data['ExerciseScreener']['walking_mins']);
		return $score;
	}
}
