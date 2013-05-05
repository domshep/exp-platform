<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('register','password_reminder'); // Let new users register themselves
	}
	
	public function admin_login() {
		return $this->redirect($this->Auth->redirect('users/login'));
		$this->set('title_for_layout', 'Admin: Log In'); 
	}
	
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
					$this->redirect($this->Auth->redirect(array('action'=>'dashboard')));
				} else {
					$this->redirect($this->Auth->redirect('admin_panel'));
				}
			} else {
				$this->Session->setFlash(__('Invalid email address or password, try again'));
			}
		}
		$this->set('title_for_layout', 'Log In'); 
	}
	
	/**
	 * Allows the visitor to request a new password, by entering their email address.
	 */
	public function password_reminder() {
		if ($this->request->is('post')) 
		{
			if ($this->request->data['UserPass']['email'] != null) { // if email has been entered
				
				$email = $this->request->data['UserPass']['email'];
				$user = $this->User->find('first',array('conditions'=>array('email' => $email)));
				
				if (count($user) == 0) {
        			$this->Session->setFlash(__('The email address entered was not recognised.'));
    			}
				else 
				{
					$userID = $user['User']['id'];
					$userName = $user['Profile']['name'];
					
					$newpassword = $this->User->setRandomPassword();
					
					$Email = new CakeEmail('default');
					$Email->template('forgotPassword', 'default')
					->emailFormat('both')
					->to($email)
					->subject($this->siteName.' : Your New Password');
					
					$Email->viewVars(array('userName' => $userName, 'password' => $newpassword, 'siteName' => $this->siteName));
					
					$Email->send();
					
					$this->Session->setFlash(__('Your password has been reset. You have been sent the new password by email.'));
					$this->redirect($this->Auth->redirect('admin/users/login'));
				} 
			}
			else 
			{
				$this->Session->setFlash(__('Please enter an email address'));
			}
		}
		$this->set('title_for_layout', 'Forgot My Password'); 
	}
	
	public function logout() {
		$this->redirect($this->Auth->logout());
	}	
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->redirect($this->Auth->redirect('users/dashboard'));
	}

/**
 * admin index method
 *
 * @return void
 */
	public function admin_index() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->User->recursive = 1;
			$this->set('users', $this->paginate());
			$this->set('title_for_layout', 'Admin'); 
		}
	}

	/**
	 * Allows an administrator to view the user profile for the given user.
	 * 
	 * @param string $id the user id to view
	 * @throws NotFoundException If no matching user is found
	 */
	public function admin_view($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$viewuser = $this->User->findById($id);
				
			if (empty($viewuser)) {
				throw new NotFoundException(__('Invalid user'));
			}
			
			$helper = new ModuleHelperFunctions();
			$this->loadModel('Module');
			
			$moduleList = $this->Module->findAllByType('dashboard');
			$userModules = array();
				
			// Add module list to data
			foreach($moduleList as $module) {
				if($helper->search($viewuser['ModuleUser'], 'module_id', $module['Module']['id'])) {
					$userModules[] = $module['Module']['name'];
				}
			}
			
			$this->set('viewuser', $this->User->findById($id));
			$this->set('userModules', $userModules);
			
			$this->set('title_for_layout', 'Admin: View User Details'); 
		}
	}
	
/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if ($this->request->is('post')) {
				$this->User->create();
				if ($this->User->saveAssociated($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				} 
			}

			$this->set('title_for_layout', 'Admin: Add New User');
		}
	}
	
	/**
	 * Register method for self-registration.
	 *
	 * @return void
	 */
	public function register() {
		if ($this->request->is('post')) {
			$this->User->create();
			$this->User->set('role','user');
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('Welcome! Your login details have been recorded.'));
				$this->Auth->login();
				$this->redirect(array('action'=>'addProfile'));
			} else {
				$this->Session->setFlash(__('There was a problem with your registration. Please, try again.'));
			}
			$this->set('title_for_layout', 'Registration'); 
		}
	}

	public function admin_edit($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if ($this->request->is('post') || $this->request->is('put')) {
				// Was cancel clicked?
				if (isset($this->request->data['cancel'])) {
					$this->redirect(array('action' => 'view',$id));
				}
				
				// Get user id from the URL, rather than from form
				$this->request->data['User']['id'] = $id;
				$this->request->data['Profile']['user_id'] = $id;
				$this->request->data['Profile']['id'] = $id;
				
				// Has password changed?
				if (!empty($this->request->data['User']['new_password'])) {
					if($this->request->data['User']['new_password'] != $this->request->data['User']['repeat_password']) {
						$this->Session->setFlash(__('Your passwords did not match. Please, try again.'));
						return;
					} else {
						$this->request->data['User']['password'] = $this->request->data['User']['new_password'];
					}
				}
					
				if ($this->User->saveAssociated($this->request->data)) {
					$this->Session->setFlash(__('The user&rsquo;s profile has been updated.'));
					$this->redirect(array('action' => 'view',$id));
				} else {
					$this->Session->setFlash(__('The user&rsquo;s profile could not be saved. Please, try again.'));
				}
			} else {
				$this->request->data = $this->User->findById($id);
			}
			$this->set('title_for_layout', 'Admin: Edit User Profile'); 
		}
	}

	public function admin_delete($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->User->id = $id;
			if (!$this->User->exists()) {
				throw new NotFoundException(__('Invalid user'));
			}
			//$this->request->onlyAllow('user', 'delete');
			if ($this->User->delete($id)) {
				$this->Session->setFlash(__('User deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('User was not deleted'));
			$this->redirect(array('action' => 'index'));
			$this->set('title_for_layout', 'Admin: Delete User'); 
		}
	}
	
	public function dashboard() {
		$this->loadModel('Module');
		
		// Get list of modules selected by the user
		$currentUser = $this->User->findById($this->Auth->user('id'));
		
		$userModules = array();
		
		foreach($currentUser['ModuleUser'] as $module) {
			$userModules[] = $this->Module->find('first', array(
					'conditions' => array('Module.id' => $module['module_id'])
			));
		}
		$this->set('userModules', $userModules);
		$this->set('title_for_layout', 'My Challenge Dashboard'); 
	}
	
	public function viewProfile() {
		$this->set('user', $this->User->findById($this->Auth->user('id')));
		$this->set('title_for_layout', 'My Profile'); 
	}
	
	public function addProfile() {
		// Does the user already have a profile stored? If so, send them to edit it instead...
		$currentUser = $this->User->findById($this->Auth->user('id'));
		
		if(!is_null($currentUser['Profile']['id'])) {
			return $this->redirect(array('action' => 'editProfile'));
		}
		
		
		if ($this->request->is('post') || $this->request->is('put')) {
			// Get user id from current user session, rather than from form
			$this->request->data['User']['id'] = $currentUser['User']['id'];
			$this->request->data['Profile']['user_id'] = $currentUser['User']['id'];
			
			if ($this->User->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('Your profile has now been set up - you&rsquo;re ready to go!'));
				$this->redirect(array('action' => 'dashboard'));
			} else {
				$this->Session->setFlash(__('Your profile could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $currentUser;
		}
		$this->set('title_for_layout', 'Set Up My Profile'); 
	}
	
	public function editProfile() {
		if ($this->request->is('post') || $this->request->is('put')) {
			// Get user id from current user session, rather than from form
			$currentUser = $this->User->findById($this->Auth->user('id'));
			$this->request->data['User']['id'] = $currentUser['User']['id'];
			$this->request->data['Profile']['user_id'] = $currentUser['User']['id'];
			$this->request->data['Profile']['id'] = $currentUser['Profile']['id'];
			
			// Has password changed?
			if (!empty($this->request->data['User']['new_password'])) {
				if($this->request->data['User']['new_password'] != $this->request->data['User']['repeat_password']) {
					$this->Session->setFlash(__('Your passwords did not match. Please, try again.'));
					return;
				} else {
					$this->request->data['User']['password'] = $this->request->data['User']['new_password'];
				}
			}
			
			if ($this->User->saveAssociated($this->request->data)) {
				$this->Session->setFlash(__('Your profile has been updated'));
				$this->redirect(array('action' => 'viewProfile'));
			} else {
				$this->Session->setFlash(__('Your profile could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->findById($this->Auth->user('id'));
		}
		
		$this->set('title_for_layout', 'Edit My Profile'); 
	}
	
	/**
	 * Exports a full set of user data, including profile information and modules that have been added to the
	 * user's dashboard.
	 */
	public function admin_full_export() {
		$this->loadModel('Module');
		
		ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
		$this->layout = 'ajax';
		
		//create a file
		$filename = "user_export_".date("Y.m.d").".csv";
		$csv_file = fopen('php://output', 'w');
		
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		
		$results = $this->User->find('all', array());
		
		// The column headings of your .csv file
		$header_row = array("User ID", "Email", "Role", "Name", "Gender", "Date of birth", "Height (CM)", "Post code", "Mobile no", "Registered");
		
		$moduleList = $this->Module->findAllByType('dashboard');
		
		// Add module list to header
		foreach($moduleList as $module) {
			$header_row[] = $module['Module']['name'];
		}
		
		fputcsv($csv_file,$header_row,',','"');
		
		// Each iteration of this while loop will be a row in your .csv file where each field corresponds to the heading of the column
		foreach($results as $result)
		{
			// Array indexes correspond to the field names in your db table(s)
			$row = array(
					$result['User']['id'],
					$result['User']['email'],
					$result['User']['role'],
					$result['Profile']['name'],
					$result['Profile']['gender'],
					$result['Profile']['date_of_birth'],
					$result['Profile']['height_cm'],
					$result['Profile']['post_code'],
					$result['Profile']['mobile_no'],
					$result['User']['created']
			);
			
			$helper = new ModuleHelperFunctions();
			
			// Add module list to data
			foreach($moduleList as $module) {
				if($helper->search($result['ModuleUser'], 'module_id', $module['Module']['id'])) {
					$row[] = 'Y';
				} else {
					$row[] = 'N';
				}
			}
		
			fputcsv($csv_file,$row,',','"');
		}
		
		fclose($csv_file);
		$this->render('export');
	}
	
	/**
	 * Exports a set of user data, containing just the essentials for sending an email or SMS message.
	 */
	public function admin_comms_export() {
		$this->loadModel('Module');
	
		ini_set('max_execution_time', 600); //increase max_execution_time to 10 min if data set is very large
		$this->layout = 'ajax';
	
		//create a file
		$filename = "comms_export_".date("Y.m.d").".csv";
		$csv_file = fopen('php://output', 'w');
	
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
	
		$results = $this->User->find('all', array());
	
		// The column headings of your .csv file
		$header_row = array("User ID", "Name", "Email", "Mobile no");
	
		$moduleList = $this->Module->findAllByType('dashboard');
	
		// Add module list to header
		foreach($moduleList as $module) {
			$header_row[] = $module['Module']['name'];
		}
	
		fputcsv($csv_file,$header_row,',','"');
	
		// Each iteration of this while loop will be a row in your .csv file where each field corresponds to the heading of the column
		foreach($results as $result)
		{
			// Array indexes correspond to the field names in your db table(s)
			$row = array(
					$result['User']['id'],
					$result['Profile']['name'],
					$result['User']['email'],
					$result['Profile']['mobile_no'],
			);
				
			$helper = new ModuleHelperFunctions();
				
			// Add module list to data
			foreach($moduleList as $module) {
				if($helper->search($result['ModuleUser'], 'module_id', $module['Module']['id'])) {
					$row[] = 'Y';
				} else {
					$row[] = 'N';
				}
			}
	
			fputcsv($csv_file,$row,',','"');
		}
	
		fclose($csv_file);
		$this->render('export');
	}
}
?>