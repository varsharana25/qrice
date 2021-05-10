<?php

App::uses('AppController', 'Controller');

/**
 * Adminusers Controller
 *
 * @property Adminuser $Adminuser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class OrdersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Order', 'Deliveryboy', 'Vendor', 'Orderdetail', 'Subscription', 'Subscriptiondetail', 'User', 'Deliveryaddress', 'Courierservice');
    public $layout = 'admin';

    public function admin_index() {
        $this->layout = 'admin';
        $admin = $this->checkadmin();
        $conditions = array();
        if (isset($_REQUEST['s'])) {
            $s = trim($_REQUEST['s']);
            $conditions['OR'] = array('Order.orderid LIKE' => $s, 'User.name LIKE' => "%$s%", 'User.email LIKE' => "%$s%", 'User.mobile LIKE' => "%$s%");
        }
        if (!empty($_REQUEST['from_date'])) {
            $conditions['DATE(Order.datetime) >='] = date('Y-m-d', strtotime($_REQUEST['from_date']));
        }
        if (!empty($_REQUEST['to_date'])) {
            $conditions['DATE(Order.datetime) <='] = date('Y-m-d', strtotime($_REQUEST['to_date']));
        }
        $this->paginate = array('joins' => array(
                array(
                    'table' => 'tbl_users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.user_id = Order.user_id'
                    )
                ), array(
                    'table' => 'tbl_deliveryboys',
                    'alias' => 'Deliveryboy',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Deliveryboy.deliveryboy_id = Order.deliveryboy_id'
                    )
                )
            ), 'fields' => array('User.*', 'Order.*', 'Deliveryboy.*'), 'conditions' => $conditions, 'order' => 'Order.order_id DESC');
        $this->set('orders', $this->Paginator->paginate('Order'));
    }

    public function admin_vieworder($order_id = NULL) {
        $this->layout = 'admin';
        $admin = $this->checkadmin();
        $orders = ClassRegistry::init('Order')->find('first', array('conditions' => array('order_id' => $order_id)));
        $data = $orders['Order'];
        $this->set('order', $data);
        $orderdetails = $this->Orderdetail->find('all', array('conditions' => array('order_id' => $order_id)));
        foreach ($orderdetails as $orderdetail) {
            $orderdetailss[] = $orderdetail['Orderdetail'];
        }
        $this->set('orderdetails', $orderdetailss);
        $address = $this->Deliveryaddress->find('first', array('conditions' => array('address_id' => $orders['Order']['address_id'])));
        $this->set('address', $address);
        $deliveryboys = ClassRegistry::init('Deliveryboy')->find('all', array('conditions' => array('status' => "Active")));
        $this->set('deliveryboys', $deliveryboys);
    }
    
    public function admin_orderdetail($order_id = NULL) {
        $this->layout = 'admin';
        $admin = $this->checkadmin();
        $orders = ClassRegistry::init('Order')->find('first', array('conditions' => array('order_id' => $order_id)));
        $data = $orders['Order'];
        $this->set('order', $data);
        $orderdetails = $this->Orderdetail->find('all', array('conditions' => array('order_id' => $order_id)));
        foreach ($orderdetails as $orderdetail) {
            $orderdetailss[] = $orderdetail['Orderdetail'];
        }
        $this->set('orderdetails', $orderdetailss);
        $address = $this->Deliveryaddress->find('first', array('conditions' => array('address_id' => $orders['Order']['address_id'])));
        $this->set('address', $address);
        $deliveryboys = ClassRegistry::init('Deliveryboy')->find('all', array('conditions' => array('status' => "Active")));
        $this->set('deliveryboys', $deliveryboys);
    }
    
    public function admin_assign_deliveryboy() {
        $this->layout = '';
        $this->autoRender = false;
        $orders = ClassRegistry::init('Order')->find('first', array('conditions' => array('order_id' => $_GET['orderid'])));
        $orders['Order']['deliveryboy_id'] =  $_GET['dboy'];
        $orders['Order']['order_status'] =  "Assigned";
        $orders['Order']['order_id'] =  $_GET['orderid'];
        $this->Order->save($orders['Order']);
        $user = $this->Deliveryboy->find('first', array('conditions' => array('deliveryboy_id' => $_GET['dboy'])));
       // if(!empty($user['Deliveryboy']['fcmid'])){
            $fcmid[] = $user['Deliveryboy']['fcmid'];
            $message = array("notifydata" => array('to' => 'Dboy', 'to_id' => $user['Deliveryboy']['deliveryboy_id'], 'message' => "New Order Assigned for you!, please check it out!. Order Id - " . ($orders['Order']['orderid']), 'notify_from' => 'order', 'id' => $_GET['orderid']));
            $res=$this->send_push_notification($fcmid, $message);
      //  }
        $this->Session->setFlash('Delivery boy assigned successfully!', '', array(''), 'adminsuccess');
        $this->redirect($this->referer());
    }
    
       public function admin_cancelorder($order_id = NULL) {
           $status="Cancelled";
        $this->Order->updateAll(
                array('Order.order_status' => "'" . $status . "'"), array('Order.order_id' => $order_id)
        );
        $this->Session->setFlash('Order status updated', '', array(''), 'adminsuccess');
        $this->redirect(array('action' => 'index'));
    }
}
