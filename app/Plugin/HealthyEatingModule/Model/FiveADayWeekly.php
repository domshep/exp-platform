<?php
App::uses('AppModel', 'Model');
/**
 * fiveadayScreener Model
 *
 * @property User $User
 */
class FiveADayWeekly extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'fiveaday_weekly';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'user_id',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $validate = array(
			'monday' => array(
					'valid' => array(
							'rule' => array('range', -1, 11),
							'message' => 'Please enter a number between 0 and 10 for the fruit or veg eaten on Monday',
					)
			),
			'tuesday' => array(
					'valid' => array(
							'rule' => array('range', -1, 11),
							'message' => 'Please enter a number between 0 and 10 for the fruit or veg eaten on Tuesday',
					)
			),
			'wednesday' => array(
					'valid' => array(
							'rule' => array('range', -1, 11),
							'message' => 'Please enter a number between 0 and 10 for the fruit or veg eaten on Wednesday',
					)
			),
			'thursday' => array(
					'valid' => array(
							'rule' => array('range', -1, 11),
							'message' => 'Please enter a number between 0 and 10 for the fruit or veg eaten on Thursday',
					)
			),
			'friday' => array(
					'valid' => array(
							'rule' => array('range', -1, 11),
							'message' => 'Please enter a number between 0 and 10 for the fruit or veg eaten on Friday',
					)
			)
			,'saturday' => array(
					'valid' => array(
							'rule' => array('range', -1, 11),
							'message' => 'Please enter a number between 0 and 10 for the fruit or veg eaten on Saturday',
					)
			)
			,'sunday' => array(
					'valid' => array(
							'rule' => array('range', -1, 11),
							'message' => 'Please enter a number between 0 and 10 for the fruit or veg eaten on Sunday',
					)
			)
			,'total' => array(
					'valid' => array(
							'rule' => array('range', -1, 71),
							'message' => 'Something has gone wrong. The total is not a valid figure',
					)
			)
		);
	}
?>