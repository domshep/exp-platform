<?php
App::uses('AppModel', 'Model');
/**
 * fiveadayScreener Model
 *
 * @property User $User
 */
class DrinkingScreener extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'drinking_screeners';


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
			'sensible_days' => array(
					'valid' => array(
							'rule' => array('range', -1, 1001),
							'message' => 'Please enter how many days you had less than the recommended number of units.',
					)
			),
			'excess_mins' => array(
					'valid' => array(
						'rule'    => array('range', -1, 1001),
						'message' => 'Please enter how many days you had more than the recommended number of units.',
					)
			)
			,'binge_days' => array(
					'valid' => array(
							'rule' => array('range', -1, 1001),
							'message' => 'Please enter how many days you had more than 6 or 8 units.',
					)
			)
	);
	
	public function calculateScore() 
	{
		$howoften = $this->data['DrinkingScreener']['how_often'];
		$howmany = $this->data['DrinkingScreener']['how_many'];
		$binge = $this->data['DrinkingScreener']['binge'];
		$score = $howoften + $howmany + $binge; 
		
		return $score;
	}
}
?>