<?php
App::uses('AppController', 'Controller');
/**
 * News Controller
 *
 * @property News $News
 */
class NewsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index','view','news_widget'); // Let new users register themselves
	}
	
	/**
	 * index method
	 *
	 * @return void
	 */
	 public function index() {
		$this->News->recursive = 0;
		$this->set('news', $this->paginate());
		//$this->redirect($this->Auth->redirect('users/dashboard'));
	}
	
	 public function news_widget() {
	 	$news = $this->News->find('all', array('order' => 'News.created DESC', 'limit' => 3));
        $this->set('news', $news);
		$this->render();
		//$this->redirect($this->Auth->redirect('users/dashboard'));
	}
	
	public function admin_index() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->News->recursive = 0;
			$this->set('news', $this->paginate());
			//$this->redirect($this->Auth->redirect('users/dashboard'));
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
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Invalid news'));
		}
		//$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('news', $this->News->find('first'));
	}

	public function admin_view($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if (!$this->News->exists($id)) {
				throw new NotFoundException(__('Invalid news'));
			}
			//$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->set('news', $this->News->find('first'));
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
				$this->News->create();
				if ($this->News->save($this->request->data)) {
					$this->Session->setFlash(__('The news has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The news could not be saved. Please, try again.'));
				}
			}
		}
	}
	
	public function admin_edit($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			if (!$this->News->exists($id)) {
				throw new NotFoundException(__('Invalid news'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
				if ($this->News->save($this->request->data)) {
					$this->Session->setFlash(__('The news has been saved'));
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The news could not be saved. Please, try again.'));
				}
			} else {
				//$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
				$this->request->data = $this->News->find('first');
			}
		}
	}

	public function admin_delete($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->News->id = $id;
			if (!$this->News->exists()) {
				throw new NotFoundException(__('Invalid news'));
			}
			//$this->request->onlyAllow('post', 'delete');
			if ($this->News->delete()) {
				$this->Session->setFlash(__('News deleted'));
				$this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('The News was not deleted'));
			$this->redirect(array('action' => 'index'));
		}
	}
}
?>