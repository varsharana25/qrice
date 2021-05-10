<?php
App::uses('AppController', 'Controller');
/**
 * Contects Controller
 *
 * @property Contect $Contect
 * @property PaginatorComponent $Paginator
 */
class ContactsController extends AppController {
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Adminuser', 'Contact', 'Emailcontent', 'Sitesetting');
    public $layout = 'admin';
    
    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->checkadmin();
        $this->Contact->recursive = 0;
        $conditions = array();
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $conditions['OR'] = array('email LIKE' => "%$s%", 'name LIKE' => "%$s%", 'phone LIKE' => "%$s%", 'subject LIKE' => "%$s%");
        }
        $this->paginate = array('conditions' => $conditions, 'order' => 'contact_id DESC');
        $this->set('results', $this->Paginator->paginate('Contact'));
    }
    /**
     * admin_delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->autorender = false;
        $this->checkadmin();
        if (!$this->Contact->exists($id)) {
            throw new NotFoundException(__('Contact Not Found'));
        }
        $this->request->data['Contact']['contact_id'] = $id;
        if ($this->Contact->delete($id)) {
            $this->Session->setFlash('Contact deleted successfully!', '', array(''), 'success');
        } else {
            $this->Session->setFlash('Contact could not be deleted! Please try again later!', '', array(''), 'danger');
        }
        $this->redirect(array('action' => 'index'));
    }
}
