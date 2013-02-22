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
}
