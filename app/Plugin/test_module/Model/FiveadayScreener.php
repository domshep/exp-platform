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
							'rule' => array('range', -1, 8),
							'message' => 'Please select how often you\'ve eaten this food type during the past 7 days',
					)
			),
			'veg_no' => array(
					'valid' => array(
						'rule'    => array('range', 0, 6),
						'message' => 'Please select how many portions of this food type you normally eat/drink in a sitting',
					)
			),
			'salad_often' => array(
					'valid' => array(
							'rule' => array('range', -1, 8),
							'message' => 'Please select how often you\'ve eaten this food type during the past 7 days',
					)
			),
			'salad_no' => array(
					'valid' => array(
						'rule'    => array('range', 0, 6),
						'message' => 'Please select how many portions of this food type you normally eat/drink in a sitting',
					)
			),
			'whole_fruit_often' => array(
					'valid' => array(
							'rule' => array('range', -1, 8),
							'message' => 'Please select how often you\'ve eaten this food type during the past 7 days',
					)
			),
			'whole_fruit_no' => array(
					'valid' => array(
						'rule'    => array('range', 0, 6),
						'message' => 'Please select how many portions of this food type you normally eat/drink in a sitting',
					)
			),
			'medium_fruit_often' => array(
					'valid' => array(
							'rule' => array('range', -1, 8),
							'message' => 'Please select how often you\'ve eaten this food type during the past 7 days',
					)
			),
			'medium_fruit_no' => array(
					'valid' => array(
						'rule'    => array('range', 0, 6),
						'message' => 'Please select how many portions of this food type you normally eat/drink in a sitting',
					)
			),
			'small_fruit_often' => array(
					'valid' => array(
							'rule' => array('range', -1, 8),
							'message' => 'Please select how often you\'ve eaten this food type during the past 7 days',
					)
			),
			'small_fruit_no' => array(
					'valid' => array(
						'rule'    => array('range', 0, 6),
						'message' => 'Please select how many portions of this food type you normally eat/drink in a sitting',
					)
			),
			'tinned_fruit_often' => array(
					'valid' => array(
							'rule' => array('range', -1, 8),
							'message' => 'Please select how often you\'ve eaten this food type during the past 7 days',
					)
			),
			'tinned_fruit_no' => array(
					'valid' => array(
						'rule'    => array('range', 0, 6),
						'message' => 'Please select how many portions of this food type you normally eat/drink in a sitting',
					)
			),
			'dried_fruit_often' => array(
					'valid' => array(
							'rule' => array('range', -1, 8),
							'message' => 'Please select how often you\'ve eaten this food type during the past 7 days',
					)
			),
			'dried_fruit_no' => array(
					'valid' => array(
						'rule'    => array('range', 0, 6),
						'message' => 'Please select how many portions of this food type you normally eat/drink in a sitting',
					)
			),
			'fruit_juice_often' => array(
					'valid' => array(
							'rule' => array('range', -1, 8),
							'message' => 'Please select how often you\'ve eaten this food type during the past 7 days',
					)
			),
			'fruit_juice_no' => array(
					'valid' => array(
						'rule'    => array('range', 0, 6),
						'message' => 'Please select how many portions of this food type you normally eat/drink in a sitting',
					)
			),
			
	);
	
	public function calculateScore() {
		$score = ($this->data['FiveadayScreener']['veg_often'] * $this->data['FiveadayScreener']['veg_no'])
				+ ($this->data['FiveadayScreener']['salad_often'] * $this->data['FiveadayScreener']['salad_no'])
				+ ($this->data['FiveadayScreener']['whole_fruit_often'] * $this->data['FiveadayScreener']['whole_fruit_no'])
				+ ($this->data['FiveadayScreener']['medium_fruit_often'] * $this->data['FiveadayScreener']['medium_fruit_no'])
				+ ($this->data['FiveadayScreener']['small_fruit_often'] * $this->data['FiveadayScreener']['small_fruit_no'])
				+ ($this->data['FiveadayScreener']['tinned_fruit_often'] * $this->data['FiveadayScreener']['tinned_fruit_no'])
				+ ($this->data['FiveadayScreener']['dried_fruit_often'] * $this->data['FiveadayScreener']['dried_fruit_no'])
				+ ($this->data['FiveadayScreener']['fruit_juice_often'] * $this->data['FiveadayScreener']['fruit_juice_no']);

		return $score;
	}
}
