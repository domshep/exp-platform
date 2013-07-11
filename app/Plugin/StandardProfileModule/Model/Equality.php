<?php
App::uses('StandardProfileModuleAppModel', 'StandardProfileModule.Model');
/**
 * Equality Model
 *
 * @property User $User
 */
class Equality extends StandardProfileModuleAppModel {

	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $useTable = 'profile_equal_opps';
	
	

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
