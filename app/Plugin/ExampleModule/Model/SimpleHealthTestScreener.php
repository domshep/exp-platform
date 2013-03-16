<?php
App::uses('AppModel', 'Model');
/**
 * SimpleHealthTestScreener Model
 *
 * @property User $User
 */
class SimpleHealthTestScreener extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'simple_health_test_screeners';


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
			'healthy' => array(
         		'allowedChoice' => array(
             		'rule'    => array('inList', array('Y', 'N')),
             		'message' => 'Please select either Y or N.'
         		)
     		)
	);
	
	public function calculateScore() {
		if($this->data['SimpleHealthTestScreener']['healthy']=='Y') {
			$score = 100;
		} else {
			$score = 99;
		}
		return $score;
	}
}
