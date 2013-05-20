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
		$this->Auth->allow('index','view','news_widget');
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
			$this->redirect($this->Auth->redirect('/admin/news'));
		}
	}
	
	 public function news_widget() {
	 	$news = $this->News->find('all', array('order' => 'News.created DESC', 'limit' => 3));
        $this->set('news', $news);
		$this->render();
	}
	
	public function admin_index() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		} else {
			$this->News->recursive = 0;
			$this->set('news', $this->paginate());
			$this->set('title_for_layout', 'News Admin'); 
		}
	}
	
	public function admin_view($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		}
		
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Invalid news'));
		}
		
		$news =  $this->News->findById($id);
		$this->set('news', $news);
		$title = $news['News']['headline'];
		$this->set('title_for_layout', 'News Admin: ' . $title);
	}
	/**
	 * add method
	 *
	 * @return void
	 */
	public function admin_add() {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		}
		
		if ($this->request->is('post')) {
			$this->News->create();
			if ($this->News->save($this->request->data)) {
				$this->Session->setFlash(__('The news has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The news could not be saved. Please, try again.'));
			}
		}
		$this->set('title_for_layout', 'News Admin: Add News');
	}
	
	public function admin_edit($id = null) {
		if ($this->Auth->user('role') != 'admin' and $this->Auth->user('role') != 'super-admin' ) { // if not admin
				$this->redirect($this->Auth->redirect('users/dashboard'));
		}
		
		if (!$this->News->exists($id)) {
			throw new NotFoundException(__('Invalid news'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			// Was cancel clicked?
			if (isset($this->request->data['cancel'])) {
				$this->redirect(array('action' => 'view',$id));
			}
			
			if ($this->News->save($this->request->data)) {
				$this->Session->setFlash(__('The news has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The news could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->News->findById($id);
		}
		$this->set('title_for_layout', 'News Admin: Edit News');
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
			
			$this->set('title_for_layout', 'News Admin: Delete News');
		}
	}
}
?>