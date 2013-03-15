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
		return $last['ModuleUser']['position'] + 1;
	}
}