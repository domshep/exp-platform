<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	var $helpers = array('MenuBuilder.MenuBuilder' => array('authField' => 'role'));
	
	var $siteName = "Experimental Platform for Health Promotion";
	
	public $components = array(
			'Session',
			'Auth' => array(
					'loginRedirect' => array('controller' => 'users', 'action' => 'dashboard'),
					'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
					'authError' => 'You&rsquo;ll need to login or register to continue',
					'authenticate' => array(
							'Form' => array(
									'fields' => array('username'=>'email')))
			)
	);
	
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->Auth->allow('index', 'view', 'register', 'logout');
		
		$user = $this->Auth->user();
		
		// Workaround, because menu-builder doesn't seem to like the automatic structure of our User model
		// Could be that we're doing the authentication bit wrong, but this temporary fix can stand for now...
		$user['User']['role'] = $user['role'];
		$this->set(compact('user'));
		
		$role = $this->Auth->user('role');
		
		// Define your menu
		$menu = array(
				'main-menu' => array(
						array(
								'title' => 'Home',
								'url' => '/',
						),
						'explore-menu' => array(
								'title' => 'Explore Modules',
								'url' => '#'
						),
						'dashboard-menu' => array(
								'title' => 'My Dashboard',
								'url' => '/users/dashboard',
								'permissions' => array('user','admin','super-admin'),
						),
						array(
								'title' => 'Admin Panel',
								'url' => '/admin_panel',
                    			'permissions' => array('admin','super-admin'),
						),
						array(
								'title' => 'Log Out',
								'url' => '/users/logout',
                    			'permissions' => array('user','admin','super-admin'),
						),
						// Only non-logged in users can see this
               		 	array(
                    			'title' => 'Login',
                    			'url' => array('plugin' => false, 'controller' => 'users', 'action' => 'login'),
                    			'permissions' => array(''),
                		),
						array(
								'title' => 'Register',
								'url' => array('plugin' => false, 'controller' => 'users', 'action' => 'register'),
								'permissions' => array(''),
						),
				),
				'footer-menu' => array(
						array(
								'title' => 'Accessibility',
								'url' => '#',
						),
						array(
								'title' => 'Terms of Use',
								'url' => '#',
						),
						array(
								'title' => 'Back to Top',
								'url' => '#',
						),
						array(
								'title' => 'Privacy Statement',
								'url' => '#',
						),
				),
		);
		
		// Populate the Explore Modules menu
		$this->loadModel('Modules');
		$modules = $this->Modules->findAllByTypeAndActive('dashboard','1');
		$children = array();
		foreach ($modules as $module):
			$children[] = array('title'=>$module['Modules']['name'],'url'=>'/' . $module['Modules']['base_url'] . '/explore_module');
		endforeach;
		
		if (count($children) != 0){ 
			$menu['main-menu']['explore-menu']['children'] = $children;
		}
		
		// For default settings name must be menu
		$this->set(compact('menu'));
	}
	
	public function isAuthorized($user) {
		// Admin can access every action
		if (isset($user['role']) && $user['role'] === 'super-admin') {
			return true;
		}
	
		// Default deny
		return false;
	}
	

	/**
	 * Helper function for exporting data from the database as a CSV file.
	 * @param unknown $model
	 * @param unknown $userId
	 * @param unknown $year
	 * @param unknown $month
	 */
	protected function exportCSVFile($model = null, $filename = null, $headerRow = null, $dataFields = null) {
		ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
		$this->layout = 'ajax';
	
		//create a file
		$csv_file = fopen('php://output', 'w');
	
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
	
		$results = $model->find('all', array());

		fputcsv($csv_file,$headerRow,',','"');
	
		// Each iteration of this while loop will be a row in your .csv file where each field corresponds to the heading of the column
		foreach($results as $result)
		{
			// Array indexes correspond to the field names in your db table(s)
			$row = array();
			
			foreach($dataFields as $dataField) {
				$row[] = $result[get_class($model)][$dataField];
			}

			fputcsv($csv_file,$row,',','"');
		}
	
		fclose($csv_file);
		$this->render('/AdminPanel/export');
	}
}
?>