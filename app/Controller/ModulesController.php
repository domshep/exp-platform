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
		$this->redirectIfNotAdmin();
		
		$this->redirect($this->Auth->redirect('admin/modules/index'));
	}
	
	/**
 	* Admin Index method
 	* If admin, load modules list, else redirect to User Dashboard.
	* @return void.
 	*/
	public function admin_index() {
		$this->redirectIfNotAdmin();

		$this->Module->recursive = 1;
		$this->set('modules', $this->paginate());
		$this->set('title_for_layout', 'Admin Panel - Modules');
	}
	
	/**
	* admin view module method
 	* If admin, loads module information or module list, else redirects to user dashboard.
	* @param string $id
 	* @return void
	*/
	public function admin_view($id = null) {
		$this->redirectIfNotAdmin();
		
		if ($id == null) {
			$this->redirect($this->Auth->redirect('admin/modules/index'));
		} else {
			$options = array('conditions' => array('Module.' . $this->Module->primaryKey => $id));
			$this->set('module', $this->Module->find('first', $options));
			$this->set('title_for_layout', 'View Module'); 
		}
	}
	
	/**
	 * add new module method
	 * if admin, creates new module data, else redirects to user dashboard.
	 * module files must exist and paths specified must be correct.
	 * @return void
	 */
 	public function admin_add() {
		$this->redirectIfNotAdmin();
		
		$healthModuleList = $this->get_uninstalled_module_list();
		
		$this->set('healthModuleList', $healthModuleList);
		$this->set('title_for_layout', 'Add New Module');
	}
	
	/**
	 * install new module method
	 * if admin, installs the module specified, else redirects to user dashboard.
	 * @return void
	 */
	public function admin_install($plugin, $controllerName) {
		$this->redirectIfNotAdmin();
		
		// Check that the given plugin/controller is able to be installed
		$helper = new ModuleHelperFunctions();
		$healthModuleList = $this->get_uninstalled_module_list();
		
		if(!($helper->search($healthModuleList, 'plugin', $plugin) && $helper->search($healthModuleList, 'controllerName', $controllerName))) {
			throw new NotFoundException("The specified health module plugin was not found");
			$this->set('title_for_layout', 'Health Module Plugin Not Found');
		}
		
		// Retrieve any SQL code required to set up the health module tables
		$sqlCode = $this->requestAction(
				"/admin/".Inflector::underscore($plugin)."/".Inflector::underscore($controllerName)."/install_sql");
		
		foreach($sqlCode as $installSQL) {
			$this->Module->query($installSQL);
		}
		
		// Finally, install the module data into the module table
		$this->Module->create();
		$this->Module->set(array(
				'name'=> $this->requestAction(Inflector::underscore($plugin)."/".Inflector::underscore($controllerName)."/module_name"),
				'base_url'=> $this->requestAction(Inflector::underscore($plugin)."/".Inflector::underscore($controllerName)."/module_base_url"),
				'icon_url'=> $this->requestAction(Inflector::underscore($plugin)."/".Inflector::underscore($controllerName)."/module_icon_url"),
				'type'=> $this->requestAction(Inflector::underscore($plugin)."/".Inflector::underscore($controllerName)."/module_type"),
				'module_name'=> $plugin.".".$controllerName,
				'active' => false,
				));
		if($this->Module->save()) {
			$this->Session->setFlash(__('Module installed successfully'));
		} else {
			$this->Session->setFlash(__('There was a problem installing the module. Please try again.'));
		}

		$this->redirect(array('action' => 'index', 'admin' => 'true'));
	}
	
	/**
	 * admin edit method
	 * Edit an existing module. Redirects if not Admin.
	 * @throws NotFoundException
	 * @param string $id
	 * @return void
	 */
	public function admin_edit($id = null) {
		$this->redirectIfNotAdmin();
		
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
	
	/**
	 * admin delete method
	 * Delete a module, if admin.
	 * @throws NotFoundException
	 * @throws MethodNotAllowedException
	 * @param string $id
	 * @return void
	 */
	public function admin_delete($moduleId = null) {
		$this->redirectIfNotAdmin();
		
		$this->loadModel('Module');
		$module = $this->Module->findById($moduleId);
		
		if(empty($module)) {
			throw new NotFoundException("The module with id ".$moduleId." was not found");
			$this->set('title_for_layout', 'Module Not Found');
		}
		
		// Delete the module-user links
		$this->loadModel('ModuleUser');
		$this->ModuleUser->deleteAll(array('ModuleUser.module_id' => $module['Module']['id']), false);
		
		// Delete the associated health data
		$this->requestAction('/admin/'.$module['Module']['base_url'].'/delete_module');
		
		// Delete the module data itself
		$this->Module->id = $module['Module']['id'];
		if ($this->Module->delete()) {
			$this->Session->setFlash(__('Module deleted'));
			$this->redirect(array('action' => 'index', 'admin' => 'true'));
		}
		$this->Session->setFlash(__('Module was not deleted'));
		$this->redirect(array('action' => 'index', 'admin' => 'true'));
	}
	
	/**
	 * admin activate method
	 * Activate or deactivate a module, if admin.
	 * @throws NotFoundException
	 * @throws MethodNotAllowedException
	 * @param string $id
	 * @return void
	 */
	public function admin_activate($id = null, $active = true) {
		$this->redirectIfNotAdmin();

		$this->Module->id = $id;
		if (!$this->Module->exists()) {
			throw new NotFoundException(__('Invalid module'));
			$this->set('title_for_layout', 'Module Not Found');
		}
		$this->Module->set('active', $active);
		if ($this->Module->save()) {
			if($active) {
				$this->Session->setFlash(__('Module activated'));
			} else {
				$this->Session->setFlash(__('Module de-activated'));
			}
			$this->redirect(array('action' => 'index', 'admin' => 'true'));
		}
		$this->Session->setFlash(__('Module was not updated'));
		$this->redirect(array('action' => 'index', 'admin' => 'true'));
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
	
	/**
	 * Returns an array of health modules that are installed as plugins, but not yet added to the platform database.
	 */
	private function get_uninstalled_module_list() {
		$pluginList = CakePlugin::loaded();
		
		$helper = new ModuleHelperFunctions();
		$moduleList = $this->Module->find('all');
		$healthModuleList = array();
		
		// Add module list to data
		foreach($pluginList as $plugin) {
			$controllerList = App::objects($plugin.'.Controller');
			foreach($controllerList as $controller) {
				$controllerName = str_replace ( "Controller" , "" , $controller );
				App::import('Controller', $plugin.'.'.$controllerName);
				if(in_array( "ModulePlugin", class_implements($controller)) && !$helper->search($moduleList, 'module_name', $plugin.'.'.$controllerName)) {
					$healthModuleList[] = array(
							"plugin" => $plugin,
							"controller" => $controller,
							"controllerName" => $controllerName
					);
				}
			}
		}
		
		return $healthModuleList;
	}
}
?>
