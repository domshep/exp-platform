<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {
	public $hasOne = 'Profile';
	
	public $hasAndBelongsToMany = array(
			'Module' =>
			array(
					'className'              => 'Module',
					'joinTable'              => 'modules_users',
					'foreignKey'             => 'user_id',
					'associationForeignKey'  => 'module_id',
					'unique'                 => false,
					'conditions'             => '',
					'fields'                 => '',
					'order'                  => '',
					'limit'                  => '',
					'offset'                 => '',
					'finderQuery'            => '',
					'deleteQuery'            => '',
					'insertQuery'            => ''
			)
	);
	
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
	
	public function  getUser($id) {
		$options = array('conditions' => array('User.' . $this->primaryKey => $id));
		return $this->find('first', $options);
	}
}
?>