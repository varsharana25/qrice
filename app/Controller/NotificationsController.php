<?php
App::uses('AppController', 'Controller');
/**
 * Contects Controller
 *
 * @property Contect $Contect
 * @property PaginatorComponent $Paginator
 */
class NotificationsController extends AppController {
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Adminuser', 'Notification', 'Emailcontent', 'Sitesetting');
    public $layout = 'admin';
    
    /**
     * admin_index method
     *
     * @return void
     */
    public function admin_index() {
        $this->checkadmin();
        $this->Notification->recursive = 0;
        $conditions = array();
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $conditions['OR'] = array('text LIKE' => "%$s%");
        }
        $this->paginate = array('conditions' => $conditions, 'order' => 'id DESC');
        $this->set('notifications', $this->Paginator->paginate('Notification'));
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
        if (!$this->Notification->exists($id)) {
            throw new NotFoundException(__('Notification Not Found'));
        }
        $this->request->data['Notification']['id'] = $id;
        if ($this->Notification->delete($id)) {
            $this->Session->setFlash('Notification deleted successfully!', '', array(''), 'success');
        } else {
            $this->Session->setFlash('Notification could not be deleted! Please try again later!', '', array(''), 'danger');
        }
        $this->redirect(array('action' => 'index'));
    }

    public function admin_send($id = null) {
        $this->autorender = false;
        $this->checkadmin();
        if ($this->request->is('post')) {
            
            $this->request->data['Notification']['expiry_date'] = date('Y-m-d',strtotime( $this->request->data['Notification']['expiry_date']));
            $this->request->data['Notification']['customers'] = implode(',',$this->request->data['Notification']['customers']);
            $this->request->data['Notification']['deliveryboys'] = implode(',',$this->request->data['Notification']['deliveryboys']);
            $this->request->data['Notification']['created_date'] = date('Y-m-d H:i:s');
            $this->Notification->save($this->request->data['Notification']);
            $this->Session->setFlash('Notification Sent successfully!', '', array(''), 'adminsuccess');
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
        $notification=$this->Notification->find('first',array('conditions'=>array('id'=>$id)));
        $this->set('notification',$notification);

        $customers=$this->User->find('all',array('conditions'=>array('status'=>'Active')));
        $this->set('customers',$customers);

        $deliveryboys=$this->Deliveryboy->find('all',array('conditions'=>array('status'=>'Active')));
        $this->set('deliveryboys',$deliveryboys);
    }
}
