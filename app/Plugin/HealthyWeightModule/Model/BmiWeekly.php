<?php
App::uses('AppModel', 'Model');
/**
 * fiveadayScreener Model
 *
 * @property User $User
 */
class BmiWeekly extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'bmi_weekly';


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
			'weight_kg' => array(
					'valid' => array(
							'rule' => array('range', 29, 131),
							'message' => 'Please enter a number between 30kg (70lbs) and 130kg (290lbs) for your current weight.',
							'allowEmpty' => true,
					)
			),
			'height_cms' => array(
					'valid' => array(
							'rule' => array('range', 99, 201),
							'message' => 'Please enter a number between 100cm (39 inches) and 200cm (79 inches) for your current height',
							'allowEmpty' => true,
					)
			)
		);
}
?>