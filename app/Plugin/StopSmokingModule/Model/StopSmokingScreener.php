<?php 
App::uses('AppModel', 'Model');
/**
 * StopSmokingScreener Model
 *
 * @property User $User
 */
class StopSmokingScreener extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'stop_smoking_screeners';


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
			'smokes' => array(
         		'allowedChoice' => array(
             		'rule'    => array('inList', array('Y', 'N')),
             		'message' => 'Please select either Y or N.'
         		)
     		),
			'how_many' => array(
         		'allowedChoice' => array(
             		'rule'    => array('inList', array('0', '1', '2', '3')),
             		'message' => 'Please select one of the options.'
         		)
     		),
			'first_cig' => array(
         		'allowedChoice' => array(
             		'rule'    => array('inList', array('1', '2', '3')),
             		'message' => 'Please select one of the options.'
         		)
     		),
			'diff_non_smoking' => array(
         		'allowedChoice' => array(
             		'rule'    => array('inList', array('0', '1')),
             		'message' => 'Please select one of the options.'
         		)
     		),
			'most_hate' => array(
         		'allowedChoice' => array(
             		'rule'    => array('inList', array('0', '1')),
             		'message' => 'Please select one of the options.'
         		)
     		),
			'more_morning' => array(
         		'allowedChoice' => array(
             		'rule'    => array('inList', array('0', '1')),
             		'message' => 'Please select one of the options.'
         		)
     		),
			'smoke_in_bed' => array(
         		'allowedChoice' => array(
             		'rule'    => array('inList', array('0', '1')),
             		'message' => 'Please select one of the options.'
         		)
     		)
	);
	
	public function calculateScore() 
	{
		$smokes = $this->data['StopSmokingScreener']['smokes'];
		$how_many = $this->data['StopSmokingScreener']['how_many'];
		$first_cig = $this->data['StopSmokingScreener']['first_cig'];
		$diff_not_smoking = $this->data['StopSmokingScreener']['diff_non_smoking'];
		$most_hate = $this->data['StopSmokingScreener']['most_hate'];
		$more_morning = $this->data['StopSmokingScreener']['more_morning'];
		$smoke_in_bed = $this->data['StopSmokingScreener']['smoke_in_bed'];
		$score = $how_many + $first_cig + $diff_not_smoking + $most_hate + $more_morning + $smoke_in_bed;
		
		return $score;
	}
}

?>