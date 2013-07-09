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
		$this->Auth->allow('register','password_reminder', 'openid_login'); // Let new users register themselves
	}
	
	public function admin_login() {
		return $this->redirect($this->Auth->redirect('users/login'));
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
	
	public function openid_login($service = null) {
		$realm = 'http://' . $_SERVER['HTTP_HOST'];
		$returnTo = $realm . '/users/openid_login';
	
		if (!$this->Openid->isOpenIDResponse()) {
			if($service == "google") {
				$openidurl = "https://www.google.com/accounts/o8/id";
			} elseif($service == "yahoo") {
				$openidurl = "https://me.yahoo.com";
			} else {
				throw new NotFoundException(__('Invalid OpenID service'));
			}
            $this->makeOpenIDRequest($openidurl, $returnTo, $realm);
        } elseif ($this->Openid->isOpenIDResponse()) {
            $this->handleOpenIDResponse($returnTo);
        }
	}
	
	private function makeOpenIDRequest($openid, $returnTo, $realm) {
		// used by Google, Yahoo
		$axSchema = 'axschema.org';
		$attributes[] = Auth_OpenID_AX_AttrInfo::make('http://'.$axSchema.'/contact/email', 1, true, 'ax_email');
		
		// used by MyOpenID (Google supports this schema for /contact/email only)
		$openidSchema = 'schema.openid.net';
		$attributes[] = Auth_OpenID_AX_AttrInfo::make('http://'.$openidSchema.'/contact/email', 1, true, 'email');
		
		$this->Openid->authenticate($openid, $returnTo, 'http://'.$_SERVER['SERVER_NAME'], array('ax' => $attributes,
				'sreg_required' => array('email'),
				'sreg_optional' => array()));
	}
	
	private function handleOpenIDResponse($returnTo) {
		$response = $this->Openid->getResponse($returnTo);

        if ($response->status == Auth_OpenID_CANCEL) {
        	$this->Session->setFlash(__('OpenID verification cancelled'));
        	$this->redirect('login');
        } elseif ($response->status == Auth_OpenID_FAILURE) {
        	$this->Session->setFlash(__('OpenID verification failed: '.$response->message));
        	$this->redirect('login');
        } elseif ($response->status == Auth_OpenID_SUCCESS) {
            $openid = $response->identity_url;

            $sregResponse = Auth_OpenID_SRegResponse::fromSuccessResponse($response);
            $sreg = $sregResponse->contents();

            $axResponse = Auth_OpenID_AX_FetchResponse::fromSuccessResponse($response);

            $email = array();
            if ($axResponse) {
            	$email = $axResponse->get('http://axschema.org/contact/email');
            	
            	// If the email couldn't be retrieved from the axschema, try the openid.net schema instead...
            	if(empty($email)) {
            		$email = $axResponse->get('http://schema.openid.net/contact/email');
            	}
            }
            
            if(empty($email)) {
            	$this->Session->setFlash(__('Unable to retrieve your login details from the OpenID provider'));
            	$this->redirect('login');
            }
            
            $registeredUser = $this->User->findByEmail($email[0]);
            
            if(!empty($registeredUser)) {
            	$this->Auth->login($registeredUser['User']);
            	$this->redirect($this->Auth->redirect(array('action'=>'dashboard')));
            }
            
            // If we get this far, we must be an authenticated, but new user.
        	$this->User->create();
        	$this->User->set('email',$email[0]);
			$this->User->set('role','user');
			
			if ($this->User->save()) {
				$this->Session->setFlash(__('Welcome! Your OpenID account has been linked to this website.'));
				
				$registeredUser = $this->User->findByEmail($email[0]);
				$this->Auth->login($registeredUser['User']);
				$this->redirect(array('plugin' => 'standard_profile_module', 'controller' => 'profile', 'action'=>'addProfile'));
			} else {
				$this->Session->setFlash(__('There was a problem with your registration. Please, try again.'));
			}
        }
	}
	
	/**
	 * Allows the visitor to request a new password, by entering their email address.
	 */
	public function password_reminder() {
		if ($this->request->is('post')) 
		{
			if ($this->request->data['UserPass']['email'] != null) { // if email has been entered
				
				$emailAddress = $this->request->data['UserPass']['email'];
				$user = $this->User->find('first',array('conditions'=>array('email' => $emailAddress)));
				
				if (count($user) == 0) {
        			$this->Session->setFlash(__('The email address entered was not recognised.'));
    			}
				else 
				{
					$userID = $user['User']['id'];
					$userName = $user['Profile']['name'];
					
					$this->User->set('id', $userID);
					$newpassword = $this->User->setRandomPassword();
					
					$Email = new CakeEmail('default');
					$Email->template('forgotPassword', 'default')
					->emailFormat('both')
					->to($emailAddress)
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
		$this->redirectIfNotAdmin();
	
		$this->User->recursive = 1;
		$this->set('users', $this->paginate());
		$this->set('title_for_layout', 'Admin'); 
	}

	/**
	 * Allows an administrator to view the user profile for the given user.
	 * 
	 * @param string $id the user id to view
	 * @throws NotFoundException If no matching user is found
	 */
	public function admin_view($id = null) {
		$this->redirectIfNotAdmin();
		
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
	
/**
 * add method
 *
 * @return void
 */
	public function admin_add() {
		$this->redirectIfNotAdmin();
		
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
				
				$this->redirect(array('plugin' => 'standard_profile_module', 'controller' => 'profile', 'action'=>'addProfile'));
			} else {
				$this->Session->setFlash(__('There was a problem with your registration. Please, try again.'));
			}
			$this->set('title_for_layout', 'Registration'); 
		}
	}

	public function admin_edit($id = null) {
		$this->redirectIfNotAdmin();
		
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

	public function admin_delete($id = null) {
		$this->redirectIfNotAdmin();

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
	
	public function dashboard() {
		$this->loadModel('Module');
		$this->loadModel('ModuleUsers');
		
		// Get list of active modules selected by the user
		$options['joins'] = array(
				array('table' => 'module_users',
						'alias' => 'ModuleUsers',
						'type' => 'INNER',
						'conditions' => array(
								'ModuleUsers.module_id = Modules.id'
						)
				)
		);
		$options['conditions'] = array(
				'ModuleUsers.user_id'=>$this->Auth->user('id'),
				'Modules.active' => true
				);
		$userModules = $this->Modules->find('all', $options);
		
		$this->set('userModules', $userModules);
		$this->set('title_for_layout', 'My Challenge Dashboard'); 
	}
	
	/**
	 * Exports a full set of user data, including profile information and modules that have been added to the
	 * user's dashboard.
	 */
	public function admin_full_export() {
		$this->redirectIfNotAdmin();
		
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
		$header_row = array("User ID", "Email", "Role", "Name", "Gender", "Date of birth", "Height (CM)", "Post code", "Mobile no", "Registered", "Allow research");
		
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
					$result['User']['created'],
					$result['Profile']['allow_research']
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
		$this->render('/AdminPanel/export');
	}
	
	/**
	 * Exports a set of user data, containing just the essentials for sending an email or SMS message.
	 */
	public function admin_comms_export() {
		$this->redirectIfNotAdmin();
		
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
		$this->render('/AdminPanel/export');
	}
}
?>