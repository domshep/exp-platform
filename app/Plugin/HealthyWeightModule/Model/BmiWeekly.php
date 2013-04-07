<?php
App::uses('AppModel', 'Model');
/**
 * fiveadayScreener Model
 *
 * @property User $User
 */
class BmiWeekly extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'bmi_weekly';


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
			'week_beginning' => array(
					'date' => array(
							'rule' => array('date','ymd'),
							//'message' => 'Your custom message here',
							//'allowEmpty' => true,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'user_id' => array(
					'numeric' => array(
							'rule' => array('numeric'),
							//'message' => 'Your custom message here',
							//'allowEmpty' => true,
							//'required' => false,
							//'last' => false, // Stop validation after this rule
							//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'weight_kg' => array(
					'valid' => array(
							'rule' => array('range', 10, 200),
							'message' => 'Please enter a number between 10kg and 200kg for your current weight.',
							'allowEmpty' => true,
					)
			),
			'height_cms' => array(
					'valid' => array(
							'rule' => array('range', 10, 200),
							'message' => 'Please enter a number between 10cm and 200cm for your current height',
							'allowEmpty' => true,
					)
			)
		);

	public function calculateBMI($height_cm=null, $weight_kg=null) 
	{
		if ($height_cm == 0 or $height_cm == null) $height_cm = 100;
		if ($weight_kg == 0 or $weight_kg == null) $weight_kg = 120;
				
		// Calculate BMI
		$height_m = $height_cm / 100;
		
		$bmi = round((($weight_kg / $height_m) / $height_m),2); 
		
		return $bmi;
	}
}
?>