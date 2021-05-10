<?php

App::uses('AppController', 'Controller');

/**
 * Adminusers Controller
 *
 * @property Adminuser $Adminuser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class AdminusersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Adminuser', 'Emailcontent', 'Deliveryboy', 'Product', 'Productcategory', 'User', 'Order');
    public $layout = 'admin';

    public function admin_login() {
        $this->layout = 'login';
        $this->set('pagename', 'Login');
        $this->admin_logincheck();
        if ($this->request->is('post')) {
            $check = $this->Adminuser->find('first', array('conditions' => array('email' => $this->request->data['Adminuser']['email'], 'status' => 'Active')));
            if (!empty($check)) {
                if ($check['Adminuser']['password'] == md5($this->request->data['Adminuser']['password'])) {
                    if ($check['Adminuser']['status'] == 'Active') {
                        $this->Session->write($check);
                        $this->redirect(array('controller' => 'adminusers', 'action' => 'dashboard'));
                    } else {
                        $this->Session->setFlash('Your account has been deactivated! Please contact admin !', '', array(''), 'loginerror');
                    }
                } else {
                    $this->Session->setFlash('Email and password mismatch.', '', array(''), 'loginerror');
                }
            } else {
                $this->Session->setFlash('Email and password mismatch.', '', array(''), 'loginerror');
            }
        }
    }

    public function admin_forgotpassword() {
        $this->layout = 'login';
        $this->set('pagename', 'Forgot Password');
        $this->admin_logincheck();
        if (!empty($this->request->data)) {
            $check = $this->Adminuser->find('first', array('conditions' => array('email' => $this->request->data['Adminuser']['email'], 'status' => 'Active')));
            if (!empty($check)) {
                $pass = $this->str_rand();
                $emailcontent = $this->Emailcontent->find('first', array('conditions' => array('emailcontent_id' => '4')));
                $message = str_replace(array('{name}', '{password}'), array($check['Adminuser']['adminname'], $pass), $emailcontent['Emailcontent']['emailcontent']);
                //$this->mailsend($emailcontent['Emailcontent']['fromname'], $emailcontent['Emailcontent']['fromemail'], $check['Adminuser']['email'], $emailcontent['Emailcontent']['subject'], $message);
                $check['Adminuser']['password'] = md5($pass);
                $check['Adminuser']['modified_date'] = date('Y-m-d H:i:s');
                $this->Adminuser->save($check);
                $this->Session->setFlash('Your password details sent to your email address.', '', array(''), 'loginsuccess');
                $this->redirect(array('controller' => 'adminusers', 'action' => 'login'));
            } else {
                $this->Session->setFlash('Invalid email address.', '', array(''), 'loginerror');
            }
        }
    }

    public function admin_profile() {
        $sessionadmin = $this->checkadmin();
        $this->set('title', 'My Profile');
        $this->set('pagename', 'My Profile');
        if ($this->request->is('post') || $this->request->is('put')) {
            $checkemail = $this->Adminuser->find('first', array('conditions' => array('email' => $this->request->data['Adminuser']['email'], 'admin_id !=' => $sessionadmin['Adminuser']['admin_id'], 'status !=' => 'Trash')));
            if (empty($checkemail)) {
                if ($this->request->data['Adminuser']['profile']['name'] != '') {
                    $ext = $this->getFileExtension($this->request->data['Adminuser']['profile']['name']);
                    $profile = uniqid() . '.' . $ext;
                    move_uploaded_file($this->request->data['Adminuser']['profile']['tmp_name'], 'files/admin/' . $profile);
                } else {
                    $profile = $sessionadmin['Adminuser']['profile'];
                }
                $this->request->data['Adminuser']['profile'] = $profile;
                $this->request->data['Adminuser']['admin_id'] = $sessionadmin['Adminuser']['admin_id'];
                $this->Adminuser->save($this->request->data);
                $this->Session->setFlash('Profile updated successfully.', '', array(''), 'adminsuccess');
                $this->redirect(array('action' => 'profile'));
            } else {
                $this->Session->setFlash('Email already exists.', '', array(''), 'adminerror');
            }
        }
    }

    public function admin_changepassword() {
        $sessionadmin = $this->checkadmin();
        $this->set('pagename', 'Change Password');
        if ($this->request->is('post') || $this->request->is('put')) {
            $checkpass = $this->Adminuser->find('first', array('conditions' => array('password' => md5($this->request->data['Adminuser']['oldpassword']), 'admin_id' => $sessionadmin['Adminuser']['admin_id'])));
            if (!empty($checkpass)) {
                $this->request->data['Adminuser']['password'] = md5($this->request->data['Adminuser']['password']);
                $this->request->data['Adminuser']['admin_id'] = $sessionadmin['Adminuser']['admin_id'];
                $this->Adminuser->save($this->request->data['Adminuser']);
                $this->Session->setFlash('The admin password has been updated successfully.', '', array(''), 'adminsuccess');
                $this->redirect(array('action' => 'profile'));
            } else {
                $this->Session->setFlash('Old Password is incorrect.', '', array(''), 'adminerror');
                $this->redirect(array('action' => 'profile'));
            }
        }
    }

    public function admin_dashboard() {
        $sessionadmin = $this->checkadmin();
        $data['deliveryboy'] = $this->Deliveryboy->find('count', array('conditions' => array('status !=' => 'Trash')));
        $data['products'] = $this->Product->find('count', array('conditions' => array('status !=' => 'Trash')));
        $data['customers'] = $this->User->find('count', array('conditions' => array('status' => 'Active')));
        $data['categories'] = $this->Productcategory->find('count', array('conditions' => array('status !=' => 'Trash')));
        $data['orders'] = $this->Order->find('count', array('conditions' => array()));
        $data['lowstock'] = $this->Product->find('count', array('conditions' => array('inventory_value <='=>'Product.lowstock_value','inventory_value >'=>0,'status !=' => 'Trash')));
        $data['outofstock'] = $this->Product->find('count', array('conditions' => array('inventory_value <='=>0,'status !=' => 'Trash')));
        $data['inventory'] = $this->Product->find('count', array('conditions' => array('inventory_value >'=>0,'status !=' => 'Trash')));
        $this->set('data', $data);
    }

    public function orders() {
        $this->layout = 'admin';
        $admin = $this->checkadmin();
        $conditions = array();
        if (isset($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
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
                    'table' => 'tbl_vendors',
                    'alias' => 'Vendor',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Vendor.vendor_id = Order.vendor_id'
                    )
                ), array(
                    'table' => 'tbl_deliveryboys',
                    'alias' => 'Deliveryboy',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Deliveryboy.deliveryboy_id = Order.deliveryboy_id'
                    )
                )
            ), 'fields' => array('Vendor.*', 'User.*', 'Order.*', 'Deliveryboy.*'), 'conditions' => $conditions, 'order' => 'Order.order_id DESC', 'limit' => '50');
        $this->set('orders', $this->Paginator->paginate('Order'));
    }

    public function vieworder($order_id = NULL) {
        $this->layout = 'admin';
        $admin = $this->checkadmin();
        $order = $this->Order->find('first', array('joins' => array(
                array(
                    'table' => 'tbl_users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.user_id = Order.user_id'
                    ),
                ), array(
                    'table' => 'tbl_vendors',
                    'alias' => 'Vendor',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Vendor.vendor_id = Order.vendor_id'
                    ),
                ), array(
                    'table' => 'tbl_deliveryboys',
                    'alias' => 'Deliveryboy',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Deliveryboy.deliveryboy_id = Order.deliveryboy_id'
                    ),
                )
            ), 'fields' => array('User.*', 'Order.*', 'Deliveryboy.*'), 'conditions' => array('Order.order_id' => $order_id)));
        $this->set('order', $order);

        $address = $this->Deliveryaddress->find('first', array('conditions' => array('address_id' => $order['Order']['address_id'])));
        $this->set('address', $address);

        $orderdetails = $this->Orderdetail->find('all', array('joins' => array(
                array(
                    'table' => 'tbl_productvariations',
                    'alias' => 'Productvariation',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Productvariation.variation_id = Orderdetail.variation_id'
                    ),
                ), array(
                    'table' => 'tbl_products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Product.product_id = Orderdetail.product_id'
                    ),
                )
            ), 'fields' => array('Vendor.*', 'Productvariation.*', 'Orderdetail.*', 'Product.*'), 'conditions' => array('Orderdetail.order_id' => $order['Order']['order_id'])));
        $this->set('orderdetails', $orderdetails);
    }

    public function subscriptions() {
        $this->layout = 'admin';
        $admin = $this->checkadmin();
        $conditions = array();
        if (isset($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $conditions['OR'] = array('Subscription.subscriptionid LIKE' => $s, 'User.name LIKE' => "%$s%", 'User.email LIKE' => "%$s%", 'User.mobile LIKE' => "%$s%");
        }
        $this->paginate = array('joins' => array(
                array(
                    'table' => 'tbl_users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.user_id = Subscriptiondetail.user_id'
                    )
                ), array(
                    'table' => 'tbl_vendors',
                    'alias' => 'Vendor',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Vendor.vendor_id = Subscriptiondetail.vendor_id'
                    )
                ), array(
                    'table' => 'tbl_products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Product.product_id = Subscriptiondetail.product_id'
                    )
                ), array(
                    'table' => 'tbl_subscriptions',
                    'alias' => 'Subscription',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Subscription.subscription_id = Subscriptiondetail.subscription_id'
                    )
                )
            ), 'fields' => array('Vendor.*', 'User.*', 'Subscriptiondetail.*', 'Product.*', 'Subscription.*'), 'conditions' => $conditions, 'order' => 'Subscriptiondetail.subdetail_id DESC', 'limit' => '50');
        $this->set('subscriptions', $this->Paginator->paginate('Subscriptiondetail'));
    }

    public function viewsubscription($id = NULL) {
        $this->layout = 'admin';
        $admin = $this->checkadmin();
        $subscription = $this->Subscriptiondetail->find('first', array('joins' => array(
                array(
                    'table' => 'tbl_users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.user_id = Subscriptiondetail.user_id'
                    ),
                ), array(
                    'table' => 'tbl_vendors',
                    'alias' => 'Vendor',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Vendor.vendor_id = Subscriptiondetail.vendor_id'
                    ),
                ), array(
                    'table' => 'tbl_products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Product.product_id = Subscriptiondetail.product_id'
                    ),
                ), array(
                    'table' => 'tbl_subscriptions',
                    'alias' => 'Subscription',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Subscription.subscription_id = Subscriptiondetail.subscription_id'
                    )
                )
            ), 'fields' => array('Vendor.*', 'User.*', 'Subscriptiondetail.*', 'Product.*', 'Subscription.*'), 'conditions' => array('Subscriptiondetail.subdetail_id' => $id)));
        $this->set('subscription', $subscription);

        $address = $this->Deliveryaddress->find('first', array('conditions' => array('address_id' => $subscription['Subscription']['subscription_id'])));
        $this->set('address', $address);
    }

    public function admin_index() {
        $this->checkadmin();
        $this->Adminuser->recursive = 0;
        $conditions = array('roll !=' => 'Admin', 'status !=' => 'Trash');
        if (isset($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $conditions['OR'] = array('adminname LIKE' => '%' . $s . '%');
        }
        $this->paginate = array('conditions' => $conditions, 'order' => 'admin_id DESC', 'limit' => '20');
        $this->set('adminusers', $this->Paginator->paginate('Adminuser'));
    }

    public function admin_add() {
        $admin = $this->checkadmin();
        if ($this->request->is('post') || $this->request->is('put')) {
            $checkemail = $this->Adminuser->find('first', array('conditions' => array('email' => $this->request->data['Adminuser']['email'], 'status' => 'Active')));
            if (empty($checkemail)) {
                $checkmobile = $this->Adminuser->find('first', array('conditions' => array('mobile' => $this->request->data['Adminuser']['mobile'], 'status' => 'Active')));
                if (empty($checkmobile)) {
                    $pass = $this->str_rand();
                    $this->request->data['Adminuser']['password'] = md5($pass);
                    $this->request->data['Adminuser']['password_text'] = $pass;
                    $this->request->data['Adminuser']['username'] = $this->request->data['Adminuser']['adminname'];
                    $this->Adminuser->save($this->request->data);
                    $lid = $this->Adminuser->getLastInsertID();
                    $this->Staffprivilege->deleteAll(array('staff_id' => $id), false, false);
                    $userprivileges = $this->request->data['Staffprivilege'];
                    if (isset($this->request->data['Staffprivilege']['priv_id']) && !empty($this->request->data['Staffprivilege']['priv_id'])) {
                        $prv = $this->request->data['Staffprivilege']['priv_id'];
                        foreach ($prv as $key => $userprivilege) {
                            $staffprivils = $this->Privilege->find('first', array('conditions' => array('priv_id' => $userprivilege)));
                            $this->request->data['Staffprivilege']['priv_id'] = $userprivilege;
                            $this->request->data['Staffprivilege']['staff_id'] = $lid;
                            $this->request->data['Staffprivilege']['controller'] = $staffprivils['Privilege']['controller'];
                            $this->request->data['Staffprivilege']['action'] = $staffprivils['Privilege']['action'];
                            $this->Staffprivilege->saveAll($this->request->data['Staffprivilege']);
                        }
                    }

                    $emailcontent = $this->Emailcontent->find('first', array('conditions' => array('emailcontent_id' => '13')));
                    $url = BASE_URL . 'staffs/login';
                    $name = $this->request->data['Adminuser']['adminname'];
                    $useremail = $this->request->data['Adminuser']['email'];
                    $mobile = $this->request->data['Adminuser']['mobile'];
                    $message = str_replace(array('{name}', '{password}', '{email}', '{mobile}', '{url}'), array($name, $pass, $useremail, $mobile, $url), $emailcontent['Emailcontent']['emailcontent']);
                    //$this->mailsend($emailcontent['Emailcontent']['fromname'], $emailcontent['Emailcontent']['fromemail'], $useremail, $emailcontent['Emailcontent']['subject'], $message);
                    $this->Session->setFlash('Staff details added successfully!.', '', array(''), 'adminsuccess');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Mobile No already exist!', '', array(''), 'adminerror');
                }
            } else {
                $this->Session->setFlash('Email Id already exist!', '', array(''), 'adminerror');
            }
        }
    }

    public function admin_edit($id = NULL) {
        $this->checkadmin();
        $adminuser = $this->Adminuser->find('first', array('conditions' => array('admin_id' => $id)));
        if ($this->request->is('post') || $this->request->is('put')) {
            $checkemail = $this->Adminuser->find('first', array('conditions' => array('email' => $this->request->data['Adminuser']['email'], 'admin_id !=' => $adminuser['Adminuser']['admin_id'], 'status !=' => 'Trash')));
            if (empty($checkemail)) {
                $checkmobile = $this->Adminuser->find('first', array('conditions' => array('mobile' => $this->request->data['Adminuser']['mobile'], 'admin_id !=' => $adminuser['Adminuser']['admin_id'], 'status !=' => 'Trash')));
                if (empty($checkmobile)) {
                    $this->request->data['Adminuser']['username'] = $this->request->data['Adminuser']['adminname'];
                    $this->request->data['Adminuser']['email'] = $this->request->data['Adminuser']['email'];
                    $this->request->data['Adminuser']['mobile'] = $this->request->data['Adminuser']['mobile'];
                    $this->request->data['Adminuser']['admin_id'] = $id;
                    $this->Adminuser->save($this->request->data);
                    $this->Staffprivilege->deleteAll(array('staff_id' => $id), false, false);
                    $userprivileges = $this->request->data['Staffprivilege'];
                    if (isset($this->request->data['Staffprivilege']['priv_id']) && !empty($this->request->data['Staffprivilege']['priv_id'])) {
                        $prv = $this->request->data['Staffprivilege']['priv_id'];
                        foreach ($prv as $key => $userprivilege) {
                            $this->request->data['Staffprivilege']['priv_id'] = $userprivilege;
                            $this->request->data['Staffprivilege']['staff_id'] = $id;
                            $this->request->data['Staffprivilege']['controller'] = $userprivileges['controller'][$key];
                            $this->request->data['Staffprivilege']['action'] = $userprivileges['action'][$key];
                            $this->Staffprivilege->saveAll($this->request->data['Staffprivilege']);
                        }
                    }
                    $this->Session->setFlash('Staff details updated successfully!.', '', array(''), 'adminsuccess');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Mobile No already exist!', '', array(''), 'adminerror');
                    $this->redirect($this->referer());
                }
            } else {
                $this->Session->setFlash('Email Id already exist!', '', array(''), 'adminerror');
                $this->redirect($this->referer());
            }
        }
        $this->set('adminuser', $adminuser);
    }

    public function staffstatus($id = null) {
        $this->layout = 'admin';
        $this->checkadmin();
        $this->request->data['Adminuser']['admin_id'] = $this->request->data['Adminuser']['admin_id'];
        $this->request->data['Adminuser']['status'] = $this->request->data['Adminuser']['status'];
        $this->Adminuser->save($this->request->data['Adminuser']);
        $this->Session->setFlash('Staff status updated successfully', '', array(''), 'success');
        $this->redirect($this->referer());
    }

    public function staffpassword() {
        $this->layout = 'admin';
        $this->checkadmin();
        $this->request->data['Adminuser']['admin_id'] = $this->request->data['Adminuser']['admin_id'];
        $pass = $this->request->data['Adminuser']['password'];
        $this->request->data['Adminuser']['password_text'] = $this->request->data['Adminuser']['password'];
        $this->request->data['Adminuser']['password'] = md5($this->request->data['Adminuser']['password']);
        $this->Adminuser->save($this->request->data['Adminuser']);

        $emailcontent = $this->Emailcontent->find('first', array('conditions' => array('emailcontent_id' => '14')));
        $check = $this->Adminuser->find('first', array('conditions' => array('admin_id' => $this->request->data['Adminuser']['admin_id'])));
        $name = $check['Adminuser']['adminname'];
        $useremail = $check['Adminuser']['email'];
        $mobile = $check['Adminuser']['mobile'];
        $message = str_replace(array('{name}', '{password}', '{email}', '{mobile}'), array($name, $pass, $useremail, $mobile), $emailcontent['Emailcontent']['emailcontent']);
        $this->mailsend($emailcontent['Emailcontent']['fromname'], $emailcontent['Emailcontent']['fromemail'], $useremail, $emailcontent['Emailcontent']['subject'], $message);

        $this->Session->setFlash('Staff password updated successfully', '', array(''), 'success');
        $this->redirect($this->referer());
    }

    public function admin_delete($id = null) {
        $this->autorender = false;
        if (!$this->Adminuser->exists($id)) {
            throw new NotFoundException(__('Adminuser Not Found'));
        }
        $this->request->data['Adminuser']['admin_id'] = $id;
        $this->request->data['Adminuser']['status'] = 'Trash';
        $this->Adminuser->save($this->request->data['Adminuser']);
        $this->Session->setFlash('Staff deleted successfully!', '', array(''), 'success');
        $this->redirect($this->referer());
    }

}
