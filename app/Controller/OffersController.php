<?php
App::uses('AppController', 'Controller');
/**
 * Contects Controller
 *
 * @property Contect $Contect
 * @property PaginatorComponent $Paginator
 */
class OffersController extends AppController {
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Adminuser', 'Offer', 'Emailcontent', 'Sitesetting');
    public $layout = 'admin';
    
    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->checkadmin();
        $this->Offer->recursive = 0;
        $conditions = array();
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $conditions['OR'] = array('text LIKE' => "%$s%");
        }
        $this->paginate = array('conditions' => $conditions, 'order' => 'id DESC');
        $this->set('offers', $this->Paginator->paginate('Offer'));
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
        if (!$this->Offer->exists($id)) {
            throw new NotFoundException(__('Offer Not Found'));
        }
        $this->request->data['Offer']['id'] = $id;
        if ($this->Offer->delete($id)) {
            $this->Session->setFlash('Offer deleted successfully!', '', array(''), 'success');
        } else {
            $this->Session->setFlash('Offer could not be deleted! Please try again later!', '', array(''), 'danger');
        }
        $this->redirect(array('action' => 'index'));
    }

    public function admin_send($id = null) {
        $this->autorender = false;
        $this->checkadmin();
        if ($this->request->is('post')) {
            
            $this->request->data['Offer']['customers'] = implode(',',$this->request->data['Offer']['customers']);
            $this->request->data['Offer']['created_date'] = date('Y-m-d H:i:s');
            $this->Offer->save($this->request->data['Offer']);
            $this->Session->setFlash('Offer Sent successfully!', '', array(''), 'adminsuccess');
            $this->redirect(array("action" => "index"));
        }
        $customers=$this->User->find('all',array('conditions'=>array('status'=>'Active')));
        $this->set('customers',$customers);

        $deliveryboys=$this->Deliveryboy->find('all',array('conditions'=>array('status'=>'Active')));
        $this->set('deliveryboys',$deliveryboys);
    }

    public function admin_view($id = null) {
        $this->autorender = false;
        $this->checkadmin();
        $offer=$this->Offer->find('first',array('conditions'=>array('id'=>$id)));
        $this->set('offer',$offer);

        $customers=$this->User->find('all',array('conditions'=>array('status'=>'Active')));
        $this->set('customers',$customers);

        $deliveryboys=$this->Deliveryboy->find('all',array('conditions'=>array('status'=>'Active')));
        $this->set('deliveryboys',$deliveryboys);
    }
}
