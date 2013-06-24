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
			'name' => array(
					'rule' => 'notEmpty',
					'message' => 'Please enter the name you wish to be known by'
			),
			'height_cm' => array(
					'rule' => 'numeric',
					'message' => 'Please enter your height in cm'
			),
			'mobile_no' => array(
					'rule' => array('phone','/^([0-9]{11})$/','gb'),
					'message' => 'Please enter a valid mobile number (eleven digits, no spaces), or leave blank. All UK mobile phones begin with \'07\'. Please omit the international phone code (+44)',
					'allowEmpty' => false
			),
			'post_code' => array(
					'rule' => array('postal',null,'uk'),
					'message' => 'Please enter a valid UK post code.',
					'allowEmpty' => false
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
