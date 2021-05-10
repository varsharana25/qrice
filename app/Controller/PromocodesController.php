<?php
App::uses('AppController', 'Controller');
/**
 * Contects Controller
 *
 * @property Contect $Contect
 * @property PaginatorComponent $Paginator
 */
class PromocodesController extends AppController {
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Adminuser', 'Promocode', 'Emailcontent', 'Sitesetting');
    public $layout = 'admin';
    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->checkadmin();
        $this->Promocode->recursive = 0;
        $conditions = array();
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $conditions['OR'] = array('code LIKE' => "%$s%");
        }
        $this->paginate = array('conditions' => $conditions, 'order' => 'id DESC');
        $this->set('promocodes', $this->Paginator->paginate('Promocode'));
    }
    
    public function admin_delete($id = null) {
        $this->autorender = false;
        $this->checkadmin();
        if (!$this->Promocode->exists($id)) {
            throw new NotFoundException(__('Promocode Not Found'));
        }
        $this->request->data['Promocode']['id'] = $id;
        if ($this->Promocode->delete($id)) {
            $this->Session->setFlash('Promocode deleted successfully!', '', array(''), 'success');
        } else {
            $this->Session->setFlash('Promocode could not be deleted! Please try again later!', '', array(''), 'danger');
        }
        $this->redirect(array('action' => 'index'));
    }
    public function admin_add($id = null) {
        $this->autorender = false;
        $this->checkadmin();
        if ($this->request->is('post')) {
            $this->request->data['Promocode']['expiry_date'] = date('Y-m-d', strtotime($this->request->data['Promocode']['expiry_date']));
            $this->Promocode->save($this->request->data['Promocode']);
            $this->Session->setFlash('Promocode Sent successfully!', '', array(''), 'adminsuccess');
            $this->redirect(array("action" => "index"));
        }
    }
}
