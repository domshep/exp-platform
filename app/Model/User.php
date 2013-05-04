<?php
App::uses('AuthComponent', 'Controller/Component');
App::uses('CakeEmail', 'Network/Email');

class User extends AppModel {
	public $hasOne = 'Profile';
	public $hasMany = array('ModuleUser');
	
	public $validate = array(
			'email' => array(
					'email',
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'An email address is required'
					),
					'isUnique' => array(
							'rule'    => 'isUnique',
							'message' => 'This email address is already registered'
					)
			),
			'password' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'A password is required'
					)
			),
			'role' => array(
					'valid' => array(
							'rule' => array('inList', array('super-admin', 'admin', 'user')),
							'message' => 'Please select a valid user-role',
							'allowEmpty' => false
					)
			)
	);
	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}
	
	/**
	 * The module identified by $moduleID is added to the user's dashboard, at the next available dashboard position.
	 * If the module is already on the user's dashboard, then nothing is updated and false is returned.
	 * @param int $id the user id
	 * @param int $moduleId the module id
	 * @param int $position the dashboard position (or next available position, if left null)
	 * @return boolean true if successful, false otherwise
	 */
	public function addModule($id, $moduleId, $position = null) {
		if($this->ModuleUser->alreadyOnDashboard($id, $moduleId)) {
			return false;
		}
		
		if(is_null($position)) {
			$position = $this->ModuleUser->getNextPosition($id);
		}
		$this->ModuleUser->save(array(
			'user_id' => $id,
			'module_id'=> $moduleId,
			'position' => $position
		));
		return true;
	}
	
	
	/**
	 * Returns the total number of users registered on the website (including admin)
	 * 
	 * @param int $user_id
	 */
	public function totalUsers() {
		$total = $this->find('all');
		return sizeof($total);
	}
	
	/**
	 * Returns the total number of admin users registered on the website (including super admin)
	 * 
	 * @param int $user_id
	 */
	public function totalAdminUsers() {
		$total = $this->find('all', array('conditions'=>array('OR'=>array('role'=>array('super-admin','admin')))));
		return sizeof($total);
	}
	
	/**
	 * Generate and Set New Random Password. 
	 * Returns new password
	 * 
	 * @param varchar $email
	 */
	public function setRandomPassword() 
	{
		$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789@&*^%!?";
    	$pass = array(); //remember to declare $pass as an array
    	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    	
		for ($i = 0; $i < 8; $i++) {
        	$n = rand(0, $alphaLength);
       		$pass[] = $alphabet[$n];
   		}
   		
		$newpassword = implode($pass); //turn the array into a string
		$this->set(array('password' => $newpassword));			
		$this->save();
		return $newpassword;
	}
	
	/**
	 * Send Password by email. 
	 * 
	 * @param varchar $email
	 */
	public function sendPasswordEmail($toEmail,$toName,$fromEmail,$fromName,$sitename,$password) 
	{
		$Email = new CakeEmail('default');
		$Email->emailFormat('html')
			->to(array($toEmail => $toName))
			->subject($sitename . ': Your New Password')
			->send('<html><body><p>Dear '.$toName.'</p><p>You recently requested that we send you a password because you had forgotten it.<p>Your new password is: <strong>'.$password.'</strong></p><p>If you didn\'t request this password, please respond to this email as soon as possible.</p><p>Sincerely,</p><p>The '.$sitename.' Team</p></body>');
		
		return "true";
	}
}
?>