<?php
App::uses('AppModel', 'Model');
/**
 * fiveadayScreener Model
 *
 * @property User $User
 */
class FiveadayScreener extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'fiveaday_screeners';


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
			'veg_often' => array(
					'valid' => array(
							'rule' => array('range', 0, 7),
							'message' => 'Please select how often you&rsquo;ve eaten this food type during the past 7 days',
							'allowEmpty' => false
					)
			),
			'veg_no' => array(
					'rule'    => array('range', 1, 5),
					'message' => 'Please select how many portions of this food type you normally eat/drink in a sitting',
					'allowEmpty' => false
			),
			
	);
}
