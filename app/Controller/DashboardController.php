<?php

App::uses('AppController', 'Controller');

/**
 * Adminusers Controller
 *
 * @property Adminuser $Adminuser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class DashboardController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Adminuser', 'Deliveryboy', 'Product', 'User', 'Category', Order);
    public $layout = 'front';

    /**
     * Admin_Index
     *
     * @return void
     */
    public function admin_index() {
        $sessionadmin = $this->checkadmin();
        $this->layout = 'admin';
        $data['deliveryboys'] = $this->Deliveryboy->find('count', array('conditions' => array('status !=' => 'Trash')));
        $data['products'] = $this->Product->find('count', array('conditions' => array('status !=' => 'Trash')));
        $data['customers'] = $this->Customer->find('count', array('conditions' => array('status !=' => 'Trash')));
        $data['categories'] = $this->Category->find('count', array('conditions' => array('status !=' => 'Trash')));
        $data['orders'] = $this->Order->find('count', array('conditions' => array('status !=' => 'Trash')));
        $this->set('data', $data);
    }

}
