<?php
App::uses('AppModel', 'Model');
/**
 * fiveadayScreener Model
 *
 * @property User $User
 */
class ExerciseWeekly extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'exercise_weekly';


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
			'week_beginning' => array(
					'date' => array(
							'rule' => array('date','ymd'),
							//'message' => 'Your custom message here',
							//'allowEmpty' => true,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'user_id' => array(
					'numeric' => array(
							'rule' => array('numeric'),
							//'message' => 'Your custom message here',
							//'allowEmpty' => true,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'monday' => array(
					'valid' => array(
							'rule' => array('range', -1, 301),
							'message' => 'Please enter a number between 0 and 300 for the minutes you spent exercising on Monday',
							'allowEmpty' => true,
					)
			),
			'tuesday' => array(
					'valid' => array(
							'rule' => array('range', -1, 301),
							'message' => 'Please enter a number between 0 and 300 for the minutes you spent exercising on Tuesday',
							'allowEmpty' => true,
					)
			),
			'wednesday' => array(
					'valid' => array(
							'rule' => array('range', -1, 301),
							'message' => 'Please enter a number between 0 and 300 for the minutes you spent exercising on Wednesday',
							'allowEmpty' => true,
					)
			),
			'thursday' => array(
					'valid' => array(
							'rule' => array('range', -1, 301),
							'message' => 'Please enter a number between 0 and 300 for the minutes you spent exercising on Thursday',
							'allowEmpty' => true,
					)
			),
			'friday' => array(
					'valid' => array(
							'rule' => array('range', -1, 301),
							'message' => 'Please enter a number between 0 and 300 for the minutes spent exercising on Friday',
							'allowEmpty' => true,
					)
			)
			,'saturday' => array(
					'valid' => array(
							'rule' => array('range', -1, 301),
							'message' => 'Please enter a number between 0 and 300 for the minutes spent exercising on Saturday',
							'allowEmpty' => true,
					)
			)
			,'sunday' => array(
					'valid' => array(
							'rule' => array('range', -1, 301),
							'message' => 'Please enter a number between 0 and 300 for the minutes spent exercising on Sunday',
							'allowEmpty' => true,
					)
			)
			,'total' => array(
					'valid' => array(
							'rule' => array('range', -1, 2101),
							'message' => 'Something has gone wrong. The total is not a valid figure',
					)
			)
		);

	public function calculateTotal() {
		$total = $this->data['ExerciseWeekly']['monday']
		+ $this->data['ExerciseWeekly']['tuesday']
		+ $this->data['ExerciseWeekly']['wednesday']
		+ $this->data['ExerciseWeekly']['thursday']
		+ $this->data['ExerciseWeekly']['friday']
		+ $this->data['ExerciseWeekly']['saturday']
		+ $this->data['ExerciseWeekly']['sunday'];
	
		if(!is_numeric($total)) $total = 0;
	
		return $total;
	}
}
?>