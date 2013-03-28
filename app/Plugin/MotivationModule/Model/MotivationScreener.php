<?php
App::uses('AppModel', 'Model');
/**
 * MotivationScreener Model
 *
 * @property User $User
 */
class MotivationScreener extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'motivation_screeners';


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
		'Reason' => array(
			'valid' => array(
         		'allowEmpty' => 'false'
     		)
		)
	);
	
	public function calculateScore() { /* Not Valid */
		/*if($this->data['SimpleHealthTestScreener']['healthy']=='Y') {
			$score = 100;
		} else {
			$score = 99;
		}*/
		return 100;
	}
}
?>