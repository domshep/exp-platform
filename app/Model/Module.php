<?php
App::uses('AppModel', 'Model');
/**
 * Module Model
 *
 */
class Module extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
	public $hasMany = array('ModuleUser');

	/**
	 * Returns the id of the module in the database, according to the given module Name.
	 * @param unknown $moduleName the name of the module
	 */
	public function getModuleID($moduleName) {
		$options = array('conditions' => array('name' => $moduleName));
		$module = $this->find('first', $options);
		if(empty($module)) {
			return 0;
		}
		return $module['Module']['id'];
	}
}
