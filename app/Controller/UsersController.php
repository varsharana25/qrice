<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class UsersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('User', 'Order');
    public $layout = 'admin';

    public function admin_index() {
        $this->checkadmin();
        $this->layout = 'admin';
        $conditions = array();
        $order = 'user_id DESC';
        $status=array("Active","Inactive");
        $conditions['status']=$status;
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $conditions['OR'] = array('name LIKE' => "%".$s."%", 'email LIKE' => "%".$s."%", 'mobile LIKE' => "%".$s."%");
        }
        $this->paginate = array('conditions' => $conditions, 'order' => $order);
        $this->set('users', $this->Paginator->paginate('User'));
    }

    public function admin_view($id = NULL) {
        $this->checkadmin();
        $this->layout = 'admin';
        $user = $this->User->find('first', array('conditions' => array('user_id' => $id)));
        $this->set('user', $user);
        $orders = $this->Order->find('all', array('joins' => array(
                array(
                    'table' => 'tbl_users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.user_id = Order.user_id'
                    )
                )
            ),'fields'=>array('Order.*','User.*'), 'conditions' => array('Order.user_id' => $id)));
        $this->set('orders', $orders);
    }
    
    public function admin_delete($id = NULL) {
        $this->autoRender = false;
        $this->User->updateAll(
                array('User.status' => "'Trash'"), array('User.user_id' => $id)
        );
        $this->Session->setFlash('User Deleted', '', array(''), 'adminsuccess');
        $this->redirect(array('action' => 'index'));
    }
    
    public function admin_updatestatus($product_id = NULL, $status = NULL) {
        $this->User->updateAll(
                array('User.status' => "'" . $status . "'"), array('User.user_id' => $product_id)
        );
        $this->Session->setFlash('User status updated', '', array(''), 'adminsuccess');
        $this->redirect(array('action' => 'index'));
    }

}
