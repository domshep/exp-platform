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
		$this->Auth->allow('register'); // Let new users register themselves
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
					$this->redirect($this->Auth->redirect('admin/users/index'));
				}
			} else {
				$this->Session->setFlash(__('Invalid email address or password, try again'));
			}
		}
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
		//$this->User->recursive = 0;
		//$this->set('users', $this->paginate());
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
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

	
	public function admin_view($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if (!$this->User->exists($id)) {
				throw new NotFoundException(__('Invalid user'));
			}
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->set('user', $this->User->find('first', $options));
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
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
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
		}
	}

	public function admin_edit($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if (!$this->User->exists($id)) {
				throw new NotFoundException(__('Invalid user'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->User->save($this->request->data)) {
					$this->Session->setFlash(__('The user has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
				$this->request->data = $this->User->find('first', $options);
			}
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
		}
	}
	
	public function dashboard() {
		$this->loadModel('Module');
		
		// Get list of modules selected by the user
		$currentUser = $this->User->getUser($this->Auth->user('id'));
		
		$userModules = array();
		
		foreach($currentUser['ModuleUser'] as $module) {
			$userModules[] = $this->Module->find('first', array(
					'conditions' => array('Module.id' => $module['module_id'])
			));
		}
		$this->set('userModules', $userModules);
	}
	
	public function viewProfile() {
		$this->set('user', $this->User->getUser($this->Auth->user('id')));
	}
	
	public function addProfile() {
		// Does the user already have a profile stored? If so, send them to edit it instead...
		$currentUser = $this->User->getUser($this->Auth->user('id'));
		
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
	}
	
	public function editProfile() {
		if ($this->request->is('post') || $this->request->is('put')) {
			// Get user id from current user session, rather than from form
			$currentUser = $this->User->getUser($this->Auth->user('id'));
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
			$this->request->data = $this->User->getUser($this->Auth->user('id'));
		}
	}
	
	
}
