<?php
App::uses('StandardProfileModuleAppModel', 'StandardProfileModule.Model');
/**
 * HealthScore Model
 *
 * @property User $User
 */
class HealthScore extends StandardProfileModuleAppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'health_scores';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'score' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'You must record a health score',
				'allowEmpty' => false,
				'required' => true
			),
			'range' => array(
				'rule' => array('range', -1, 101),
				'message' => 'Please record a health score between 0 and 100'
			),
		),
	);

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
}
