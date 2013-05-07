<?php
App::uses('AppController', 'Controller');
/**
 * Modules Controller
 *
 * @property Module $Module
 */
class ModulesController extends AppController {
    public $helpers = array('Calendar');

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('list_all_explorable_modules'); // Let anyone see the list of all explorable modules.
	}
	
/**
 * index method
 *
 * @return void
 */
	public function index() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->redirect($this->Auth->redirect('admin/modules/index'));
		}
	}

	public function admin_index() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->Module->recursive = 0;
			$this->set('modules', $this->paginate());
			$this->set('title_for_layout', 'Module Admin'); 
		}
	}
	

	public function admin_health_data() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->Module->recursive = 1;
			$this->set('modules', $this->paginate());
			$this->set('title_for_layout', 'Admin Panel - Health Data');
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
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if ($id == null) $this->redirect($this->Auth->redirect('admin/modules/index'));
			else $this->redirect($this->Auth->redirect('admin/modules/view/'.$id));
		}
		/*
		if (!$this->Module->exists($id)) {
			throw new NotFoundException(__('Invalid module'));
		}
		$options = array('conditions' => array('Module.' . $this->Module->primaryKey => $id));
		$this->set('module', $this->Module->find('first', $options)); */
	}

	public function admin_view($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if ($id == null) $this->redirect($this->Auth->redirect('admin/modules/index'));
			else 
			{
				/*if (!$this->Module->exists($id)) {
				throw new NotFoundException(__('Invalid module'));
				}*/
			$options = array('conditions' => array('Module.' . $this->Module->primaryKey => $id));
			$this->set('module', $this->Module->find('first', $options));
				$this->set('title_for_layout', 'View Module'); 
			}
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
			$this->set('title_for_layout', 'Add New Module'); 
			if ($this->request->is('post')) {
				$this->Module->create();
				if ($this->Module->save($this->request->data)) {
					$this->Session->setFlash(__('The module has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The module could not be saved. Please, try again.'));
				}
			}
		}
	}
	
	public function add() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->redirect($this->Auth->redirect('admin/modules/add'));
		}
		/*if ($this->request->is('post')) {
			$this->Module->create();
			if ($this->Module->save($this->request->data)) {
				$this->Session->setFlash(__('The module has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The module could not be saved. Please, try again.'));
			}
		}*/
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if (!$this->Module->exists($id)) {
				throw new NotFoundException(__('Invalid module'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->Module->save($this->request->data)) {
					$this->Session->setFlash(__('The module has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The module could not be saved. Please, try again.'));
				}
			} else {
				$options = array('conditions' => array('Module.' . $this->Module->primaryKey => $id));
				$this->request->data = $this->Module->find('first', $options);
			}
			$this->set('title_for_layout', 'Edit Module'); 
		}
	}
	
	public function edit($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if ($id == null) $this->redirect($this->Auth->redirect('admin/modules/index'));
			else $this->redirect($this->Auth->redirect('admin/modules/edit/'.$id));
		}
		/*if (!$this->Module->exists($id)) {
			throw new NotFoundException(__('Invalid module'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Module->save($this->request->data)) {
				$this->Session->setFlash(__('The module has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The module could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Module.' . $this->Module->primaryKey => $id));
			$this->request->data = $this->Module->find('first', $options);
		}*/
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
			if ($id == null) $this->redirect($this->Auth->redirect('admin/modules/index'));
			else $this->redirect($this->Auth->redirect('admin/modules/delete/'.$id));
		}
		/*
		$this->Module->id = $id;
		if (!$this->Module->exists()) {
			throw new NotFoundException(__('Invalid module'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Module->delete()) {
			$this->Session->setFlash(__('Module deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Module was not deleted'));
		$this->redirect(array('action' => 'index'));*/
	}
	
	public function admin_delete($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->Module->id = $id;
			if (!$this->Module->exists()) {
				throw new NotFoundException(__('Invalid module'));
				$this->set('title_for_layout', 'Module Not Found');
			}
			//$this->request->onlyAllow('module', 'delete');
			if ($this->Module->delete()) {
				$this->Session->setFlash(__('Module deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Module was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
	
	/**
	 * Get a list of all available modules.
	 * 
	 */
	public function list_all_explorable_modules() {
		// Don't allow this method to be called directly from a URL
		if (empty($this->request->params['requested'])) {
			throw new ForbiddenException();
		}
		
		$this->Module->recursive = 0;
		return $this->Module->findAllByTypeAndActive('dashboard','1');
	}
	
}
?>
