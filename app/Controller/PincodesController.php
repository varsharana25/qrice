<?php

App::uses('AppController', 'Controller');

/**
 * Adminusers Controller
 *
 * @property Adminuser $Adminuser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class PincodesController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Adminuser', 'Sitesetting','Pincode');
    public $layout = 'admin';

    /**
     * AdminIndex
     *
     * @return void
     */
    public function admin_add() {
        $this->checkadmin();
        $this->set('title', 'Pincodes');
        if ($this->request->is('post')) {
            $setting = $this->Pincode->find('first',array('conditions'=>array('pincode'=>$this->request->data['Pincode']['pincode'])));
            if(empty($setting)){
            $this->request->data['Pincode']['pincode'] = $this->request->data['Pincode']['pincode'];
            $this->Pincode->save($this->request->data);
            $this->Session->setFlash('Pincode Saved successfully!', '', array(''), 'adminsuccess');
            $this->redirect(array("controller" => "pincodes", "action" => "index"));
            }else{
                $this->Session->setFlash('Pincode Already Exsit!', '', array(''), 'admindanger');
            }
        }
    }
    
    public function admin_delete($id = null) {
        $this->autorender = false;
        $this->checkadmin();
        if (!$this->Pincode->exists($id)) {
            throw new NotFoundException(__('Pincode Not Found'));
        }
        $this->request->data['Pincode']['pin_id'] = $id;
        if ($this->Pincode->delete($id)) {
            $this->Session->setFlash('Pincode deleted successfully!', '', array(''), 'adminsuccess');
        } else {
            $this->Session->setFlash('Pincode could not be deleted! Please try again later!', '', array(''), 'admindanger');
        }
        $this->redirect(array('action' => 'index'));
    }
    
    public function admin_index() {
        $this->checkadmin();
        $this->set('title', 'Pincodes');
        $result = $this->Pincode->find('all');
        $this->set('result', $result);
    }

}
