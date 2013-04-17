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
		if ($howoften == 0) $frequency = 0; // never
		elseif ($howoften == 1) $frequency = 1; // once a month
		elseif ($howoften == 2) $frequency = 6; // 2-4 times a month
		elseif ($howoften == 3) $frequency = 12; // 2-3 times a week
		else $frequency = 18; // 4+ times a week
		
		$howmany = $this->data['DrinkingScreener']['how_many'];
		$score = $frequency * $howmany; // how many per month on average
		
		//$binge = $this->data['DrinkingScreener']['binge'];
		//$score = $units * ($binge+1);
		
		return $score; // how many in a month...
	}
}
?>