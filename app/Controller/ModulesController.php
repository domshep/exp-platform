<?php
App::uses('AppController', 'Controller');
/**
 * Modules Controller
 *
 * @property Module $Module
 */
class ModulesController extends AppController {
    public $helpers = array('Calendar');
	
	/**
 	* beforeFilter method
 	* Which functions should be accessible by all users
	* @return void
 	*/
	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('list_all_explorable_modules'); // Let anyone see the list of all explorable modules.
	}
	
	/**
	 * index method
	 * Redirect to the admin index if admin, else redirect to user dashboard.
	 * @return void	
 	*/
	public function index() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->redirect($this->Auth->redirect('admin/modules/index'));
		}
	}
	
	/**
 	* Admin Index method
 	* If admin, load modules list, else redirect to User Dashboard.
	* @return void.
 	*/
	public function admin_index() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->Module->recursive = 0;
			$this->set('modules', $this->paginate());
			$this->set('title_for_layout', 'Module Admin'); 
		}
	}
	
	/**
 	* Admin Health Data method
 	* If admin, load list of modules with health data links, else redirect to user dashboard.
	* @return void.
 	*/
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
	* view module method
 	* Redirects to admin view if admin, else redirects to user dashboard
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
	}
	
	/**
	* admin view module method
 	* If admin, loads module information or module list, else redirects to user dashboard.
	* @param string $id
 	* @return void
	*/
	public function admin_view($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if ($id == null) $this->redirect($this->Auth->redirect('admin/modules/index'));
			else 
			{
				$options = array('conditions' => array('Module.' . $this->Module->primaryKey => $id));
				$this->set('module', $this->Module->find('first', $options));
				$this->set('title_for_layout', 'View Module'); 
			}
		}
	}
	
	/**
	 * add new module method
	 * if admin, creates new module data, else redirects to user dashboard.
	 * module files must exist and paths specified must be correct.
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
	
	
	/**
	* add module redirection script
 	* Redirects users accidentally omitting the "admin" folder. If not admin, redirects to user dashboard.
 	* @return void
	*/
	public function add() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->redirect($this->Auth->redirect('admin/modules/add'));
		}
	}

	/**
	 * admin edit method
	 * Edit an existing module. Redirects if not Admin.
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
	
	/**
	 * edit module redirect method
	 * Redirects to admin_edit or user dashboard.
	 * @param string $id
	 * @return void
	 */
	public function edit($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
			$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if ($id == null) $this->redirect($this->Auth->redirect('admin/modules/index'));
			else $this->redirect($this->Auth->redirect('admin/modules/edit/'.$id));
		}
	}

	/**
	 * delete redirect method
	 * Redirects to admin_delete, or redirects to user dashboard
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
	}
	
	/**
	 * admin delete method
	 * Delete a module, if admin.
	 * @throws NotFoundException
	 * @throws MethodNotAllowedException
	 * @param string $id
	 * @return void
	 */
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
	* list all explorable modules method
	* Public method used by explore menu and home page.
	* @throws ForbiddenException
	* @throws MethodNotAllowedException
	* @return array $modules
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
