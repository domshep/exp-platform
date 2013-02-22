<?php
class User extends AppModel {
	public $hasOne = 'Profile';
	
	public $validate = array(
			'email' => array(
					'email',
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'An email address is required'
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
							'message' => 'Please enter a valid role',
							'allowEmpty' => false
					)
			)
	);
}
?>