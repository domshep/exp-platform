<?php
App::uses('AppModel', 'Model');
/**
 * Module Model
 *
 */
class News extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'headline';

	/**
	 * Returns the total number of admin users registered on the website (including super admin)
	 * 
	 * @param int $user_id
	 */
	public function totalNewsArticles() {
		$total = $this->find('all');
		return sizeof($total);
}
	
	/**
	 * Returns the total number of admin users registered on the website (including super admin)
	 * 
	 * @param int $user_id
	 */
	public function getLatestNews() {
		$latest = $this->find('first');
		return $latest;
	}
	
}

?>