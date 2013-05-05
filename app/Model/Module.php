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
	
	/**
	 * Returns the total number of weekly entries for all active modules
	 * 
	 * @param int $user_id
	 */
	public function totalWeeklyEntries() {
		$conditions = array('conditions'=>array('active'=>'1','type'=>'dashboard'));
		$modules = $this->find('all',$conditions);
		$numModules = sizeof($modules);
		$total = 0;
		
		foreach($modules as $module){
			// get the module prefix
			$prefix = $module['Module']['table_prefix'];
			$weeklytable = $prefix . "_weekly";
			if(sizeof($this->query("SHOW TABLES LIKE '".$weeklytable."'"))==1)
			{
				// load the number of weekly entries
				$weekly = $this->query("SELECT * FROM `".$weeklytable."`");
				$totalWeekly = sizeof($weekly);
				// add to total
				$total = $total + $totalWeekly;
			} // else the table does not exist.
		}
		return $total;
	}
}
