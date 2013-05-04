<?php
App::uses('AppModel', 'Model');
/**
 * BMI Screener Model
 *
 * @property User $User
 */
class BmiScreener extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'bmi_screeners';


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
			'height_cm' => array(
					'valid' => array(
							'rule' => array('range', 99, 201),
							'message' => 'Please enter your height. This should be between 100cm (39 inches) and 200cm (79 inches)',
					)
			),
			'weight_kg' => array(
					'valid' => array(
						'rule'    => array('range', 29, 131),
						'message' => 'Please enter your current weight. This should be between 30kg (70lbs) and 130kg (290lbs)',
					)
			)
	);
}
?>