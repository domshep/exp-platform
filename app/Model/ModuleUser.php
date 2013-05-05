<?php
class ModuleUser extends AppModel
{
	public $belongsTo = array(
			'User', 'Module'
	);
	
	/**
	 * Returns a list of all the modules associated with the given user.
	 * @param int $userId
	 */
	public function getModuleList($userId) {
		$options = array('conditions' => array('user_id' => $userId));
		return $this->find('all', $options);
	}
	
	/**
	 * Returns the next available position on the dashboard.
	 * @param int $userId
	 */
	public function getNextPosition($userId) {
		$options = array('conditions' => array('user_id' => $userId), 'order' => array('position' => 'desc'));
		$last = $this->find('first', $options);
		
		if(empty($last)) return 1;
		
		return $last['ModuleUser']['position'] + 1;
	}
	
	/**
	 * Returns true if the given module id is already linked to the given user's dashboard.
	 * @param unknown $userID
	 * @param unknown $moduleID
	 */
	public function alreadyOnDashboard($userId, $moduleId) {
		$options = array('conditions' => array('user_id' => $userId, 'module_id' => $moduleId));
		$moduleexists = $this->find('first', $options);
		return !empty($moduleexists);
	}
}