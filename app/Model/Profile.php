<?php
App::uses('AppModel', 'Model');
/**
 * Profile Model
 *
 * @property User $User
 */
class Profile extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'profile';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


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
					'rule' => 'numeric',
					'message' => 'Please enter your height in cm'
			),
			'mobile_no' => array(
					'rule' => array('phone','/^([0-9]{1}[0-9]{9})$/'),
					'message' => 'Please enter a valid mobile number (no spaces), or leave blank',
					'allowEmpty' => true
			),
			'date_of_birth' => array(
					'rule' => 'date',
					'message' => 'Please enter your date of birth'
			),
			'gender' => array(
					'valid' => array(
							'rule' => array('inList', array('M', 'F')),
							'message' => 'Please select your gender',
							'allowEmpty' => false
					)
			)
	);
}
