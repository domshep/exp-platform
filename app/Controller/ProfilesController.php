<?php
App::uses('AppController', 'Controller');
/**
 * Profiles Controller
 *
 * @property Profile $Profile
 */
class ProfilesController extends AppController {

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->redirect($this->Auth->redirect('users/viewProfile'));
	}

	public function admin_index() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->Profile->recursive = 0;
			$this->set('profiles', $this->paginate());
		}
		$this->set('title_for_layout', 'User Admin: Profiles');
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->redirect($this->Auth->redirect('users/viewProfile'));
	}

	public function admin_view($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if (!$this->Profile->exists($id)) {
				throw new NotFoundException(__('Invalid profile'));
			}
			$options = array('conditions' => array('Profile.' . $this->Profile->primaryKey => $id));
			$this->set('profile', $this->Profile->find('first', $options));
			
			$profile =  $this->Profile->find('first',$options);
			$title = $profile['Profile']['name'];
			$this->set('title_for_layout', 'User Admin: View Profile: ' . $title);
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
				$this->Profile->create();
				if ($this->Profile->save($this->request->data)) {
					$this->Session->setFlash(__('The profile has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The profile could not be saved. Please, try again.'));
				}
			}
			$users = $this->Profile->User->find('list');
			$this->set(compact('users'));
			
			$this->set('title_for_layout', 'User Admin: Add New Profile ');
		}
	}
	
	public function add() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
			} else {
			$this->redirect($this->Auth->redirect('admin/profiles/add'));
			}
		}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) 
	{
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
			} else {
				if ($id == null) {
					$this->redirect($this->Auth->redirect('admin/profiles/index'));
				} else {
					$this->redirect($this->Auth->redirect('admin/profiles/edit/'.$id));
				}
			}
		}

	public function admin_edit($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if (!$this->Profile->exists($id)) {
				throw new NotFoundException(__('Invalid profile'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Profile->save($this->request->data)) {
					$this->Session->setFlash(__('The profile has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The profile could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Profile.' . $this->Profile->primaryKey => $id));
				$this->request->data = $this->Profile->find('first', $options);
			}
			$users = $this->Profile->User->find('list');
			$this->set(compact('users'));
			
			$this->set('title_for_layout', 'User Admin: Edit Profile');
			
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if ($id == null) {
				$this->redirect($this->Auth->redirect('admin/profiles/index'));
			} else {
				$this->redirect($this->Auth->redirect('admin/profiles/delete/'.$id));
			}
		}
	}
	
	public function admin_delete($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->Profile->id = $id;
			if (!$this->Profile->exists()) {
				throw new NotFoundException(__('Invalid profile'));
			}
			$this->request->onlyAllow('post', 'delete');
			if ($this->Profile->delete()) {
				$this->Session->setFlash(__('Profile deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Profile was not deleted'));
			$this->redirect(array('action' => 'index'));
			
			$this->set('title_for_layout', 'User Admin: Delete Profile');
		}
	}
}
?>