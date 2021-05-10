<?php

App::uses('AppController', 'Controller');

/**
 * Adminusers Controller
 *
 * @property Adminuser $Adminuser
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class VendorsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Session');
    public $uses = array('Adminuser', 'Vendor', 'Product', 'Productcategory', 'Productvariation', 'Order', 'Orderdetail', 'Deliveryaddress', 'Subscription', 'Withdrawrequest', 'Subscriptiondetail','Productsubcategory');
    public $layout = 'admin';

    /**
     * AdminIndex
     *
     * @return void
     */
    public function admin_index() {
        $this->checkadmin();
        $conditions = array('Vendor.status !=' => 'Trash');
        if (!empty($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $conditions['OR'] = array('Vendor.full_name LIKE' => "%$s%", 'Vendor.shop_name LIKE' => "%$s%", 'Vendor.email LIKE' => "%$s%", 'Vendor.mobile LIKE' => "%$s%", 'Vendor.location LIKE' => "%$s%", 'Vendor.district LIKE' => "%$s%", 'Vendor.state LIKE' => "%$s%");
        }
        if (!empty($_REQUEST['category_id'])) {
            $conditions['Vendor.business_category'] = $_REQUEST['category_id'];
        }
        $this->paginate = array('joins' => array(
                array(
                    'table' => 'tbl_categories',
                    'alias' => 'Category',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Category.category_id = Vendor.business_category'
                    )
                )
            ), 'fields' => array('Vendor.*', 'Category.*'), 'conditions' => $conditions, 'order' => 'Vendor.vendor_id DESC');
        $this->set('vendors', $this->Paginator->paginate('Vendor'));

        $approved = $this->Vendor->find('count', array('conditions' => array('status' => 'Approved')));
        $this->set('approved', $approved);
        $rejected = $this->Vendor->find('count', array('conditions' => array('status' => 'Rejected')));
        $this->set('rejected', $rejected);
        $pending = $this->Vendor->find('count', array('conditions' => array('status' => 'Pending')));
        $this->set('pending', $pending);
    }

    public function admin_view($id = NULL) {
        $sessionadmin = $this->checkadmin();
        $vendor = $this->Vendor->find('first', array('joins' => array(
                array(
                    'table' => 'tbl_categories',
                    'alias' => 'Category',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Category.category_id = Vendor.business_category'
                    )
                )
            ), 'fields' => array('Vendor.*', 'Category.*'), 'conditions' => array('Vendor.vendor_id' => $id)));
        $this->set('vendor', $vendor);
    }

    public function admin_updatestatus($id = null) {
        $this->layout = 'admin';
        $this->checkadmin();
        $vendor = $this->Vendor->find('first', array('conditions' => array('vendor_id' => $this->request->data['Vendor']['vendor_id'])));
        $this->request->data['Vendor']['vendor_id'] = $this->request->data['Vendor']['vendor_id'];
        $this->request->data['Vendor']['status'] = $this->request->data['Vendor']['status'];
        $this->Vendor->save($this->request->data['Vendor']);
        if ($this->request->data['Vendor']['status'] == "Active") {
            $link = BASE_URL . '/vendors/login';
            $emailcontent = $this->Emailcontent->find('first', array('conditions' => array('emailcontent_id' => '9')));
            //$message = str_replace(array('{name}', '{email}', '{mobile}', '{password}', '{link}'), array($vendor['Vendor']['full_name'], $vendor['Vendor']['email'], $vendor['Vendor']['mobile'], $vendor['Vendor']['password_text'], $link), $emailcontent['Emailcontent']['emailcontent']);
            // $this->mailsend($emailcontent['Emailcontent']['fromname'], $emailcontent['Emailcontent']['fromemail'], $vendor['Vendor']['email'], $emailcontent['Emailcontent']['subject'], $message);
        } else if ($this->request->data['Vendor']['status'] == "Rejected") {
            $link = BASE_URL . '/vendors/login';
            $emailcontent = $this->Emailcontent->find('first', array('conditions' => array('emailcontent_id' => '10')));
            //$message = str_replace(array('{name}', '{email}', '{mobile}'), array($vendor['Vendor']['full_name'], $vendor['Vendor']['email'], $vendor['Vendor']['mobile']), $emailcontent['Emailcontent']['emailcontent']);
            //  $this->mailsend($emailcontent['Emailcontent']['fromname'], $emailcontent['Emailcontent']['fromemail'], $vendor['Vendor']['email'], $emailcontent['Emailcontent']['subject'], $message);
        }
        $this->Session->setFlash('Status updated!', '', array(''), 'success');
        $this->redirect(array('action' => 'index'));
    }

    public function admin_delete($id = null) {
        $this->autorender = false;
        if (!$this->Vendor->exists($id)) {
            throw new NotFoundException(__('Vendor Not Found'));
        }
        $this->request->data['Vendor']['vendor_id'] = $id;
        $this->request->data['Vendor']['status'] = 'Trash';
        if ($this->Vendor->save($this->request->data['Vendor'])) {
            $this->Session->setFlash('Vendor deleted successfully!', '', array(''), 'success');
        } else {
            $this->Session->setFlash('Vendor could not be deleted! Please try again later!', '', array(''), 'danger');
        }
        $this->redirect(array('action' => 'index'));
    }

    public function login() {
        $this->layout = 'login';
        if ($this->request->is('post')) {
            $checkemail = $this->Vendor->find('first', array('conditions' => array('mobile' => $this->request->data['Vendor']['mobile'])));
            if (!empty($checkemail)) {
                if ($checkemail['Vendor']['status'] == "Approved") {
                    if ($checkemail['Vendor']['otp'] == $this->request->data['Vendor']['otp']) {
                        $this->Session->write($checkemail);
                        $this->redirect(array('controller' => 'vendors', 'action' => 'dashboard'));
                    } else {
                        $this->Session->setFlash('OTP mismatch', '', array(''), 'loginerror');
                        $this->redirect($this->referer());
                    }
                } else if ($checkemail['Vendor']['status'] == "Trash") {
                    $this->Session->setFlash('Your account is deleted, please contact admin!', '', array(''), 'loginerror');
                    $this->redirect($this->referer());
                } else {
                    $this->Session->setFlash('Your account is Inactive, please contact admin', '', array(''), 'loginerror');
                    $this->redirect($this->referer());
                }
            } else {
                $this->Session->setFlash('Email/Mobile does not exists!', '', array(''), 'loginerror');
                $this->redirect($this->referer());
            }
        }
    }

    public function dashboard() {
        $this->layout = 'vendor';
        $sessionvendor = $this->checkvendor();
    }

    public function profile() {
        $this->layout = 'vendor';
        $vendor = $this->checkvendor();

        if ($this->request->is('post') || $this->request->is('put')) {
            $check = $this->Vendor->find('first', array('conditions' => array('email' => $this->request->data['Vendor']['email'], 'mobile' => $this->request->data['Vendor']['mobile'], 'vendor_id !=' => $vendor['Vendor']['vendor_id'], 'status !=' => 'Trash')));
            if (empty($check)) {
                $vendor_path = $this->vendor_path($vendor['Vendor']['vendor_id']);
                if (!empty($this->request->data['Vendor']['shop_logo']['name'])) {
                    $this->request->data['Vendor']['shop_logo'] = $this->web_to_server($this->request->data['Vendor']['shop_logo'], $vendor_path);
                } else {
                    $this->request->data['Vendor']['shop_logo'] = $vendor['Vendor']['shop_logo'];
                }
                $this->request->data['Vendor']['vendor_id'] = $vendor['Vendor']['vendor_id'];
                $this->Vendor->save($this->request->data['Vendor']);
                $this->Session->setFlash('Profile Updated!', '', array(''), 'vendorsuccess');
                $this->redirect(array('action' => 'profile'));
            } else {
                $this->Session->setFlash('Email/Phone number already exists.', '', array(''), 'vendorerror');
            }
        }
    }

    public function sendotp() {
        $this->autoRender = false;
        $check = $this->Vendor->find('first', array('conditions' => array('mobile' => $_REQUEST['phone'])));
        if (!empty($check) && $check['Vendor']['status'] == 'Approved') {
            //$otp = $this->str_rand(4, 'numeric');
            $otp = '1234';
            $this->sendSMS($_POST['phone'], 'OTP is' . $otp);
            $check['Vendor']['otp'] = $otp;
            $this->Vendor->save($check['Vendor']);
            $result = array('code' => '200', 'message' => 'OTP sent successfully!');
        } elseif ($check['Vendor']['status'] == 'Trash') {
            $result = array('code' => '0', 'message' => 'Mobile Number not registered');
        } else {
            $result = array('code' => '0', 'message' => 'Account is in inactive status! Please contact admin');
        }
        echo json_encode($result);
        exit;
    }

    public function products() {
        $this->layout = 'vendor';
        $vendor = $this->checkvendor();
        $conditions = array('Product.status !=' => 'Trash', 'Product.vendor_id' => $vendor['Vendor']['vendor_id']);
        if (isset($_REQUEST['s'])) {
            $s = $_REQUEST['s'];
            $conditions['OR'] = array('Product.name LIKE' => "%$s%", 'Productcategory.name LIKE' => "%$s%");
        }
        if (!empty($_REQUEST['category_id'])) {
            $conditions['category_id'] = $_REQUEST['category_id'];
        }
        if (!empty($_REQUEST['subcategory_id'])) {
            $conditions['subcategory_id'] = $_REQUEST['subcategory_id'];
        }
        $this->paginate = array('joins' => array(
                array(
                    'table' => 'tbl_productcategories',
                    'alias' => 'Productcategory',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Productcategory.procategory_id = Product.category_id'
                    )
                )
            ), 'fields' => array('Product.*', 'Productcategory.*'), 'conditions' => $conditions, 'order' => 'Product.product_id DESC', 'limit' => '50');
        $this->set('products', $this->Paginator->paginate('Product'));

        $categories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => '0')));
        $this->set('categories', $categories);
        if (!empty($_REQUEST['category_id'])) {
            $subcategories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => $_REQUEST['category_id'])));
            $this->set('subcategories', $subcategories);
        }
    }

    public function addproduct() {
        $this->layout = 'vendor';
        $vendor = $this->checkvendor();
        if ($this->request->is('post')) {
            $this->request->data['Product']['created_date'] = date('Y-m-d H:i:s');
            $this->request->data['Product']['vendor_id'] = $vendor['Vendor']['vendor_id'];
            if (!empty($this->request->data['Product']['image']['name'])) {
                $logo = rand(0, 9999) . $this->request->data['Product']['image']['name'];
                move_uploaded_file($this->request->data['Product']['image']['tmp_name'], $vendor['Vendor']['vendor_path'] . $logo);
                $this->request->data['Product']['image'] = $logo;
            } else {
                $this->request->data['Product']['image'] = '';
            }
            $this->Product->save($this->request->data['Product']);
            $product_id = $this->Product->getLastInsertID();
            foreach ($this->request->data['Productvariation']['variation'] as $key => $variation) {
                $Productvariation['Productvariation'] = array();
                $Productvariation['Productvariation']['product_id'] = $product_id;
                $Productvariation['Productvariation']['variation'] = $variation;
                $Productvariation['Productvariation']['mrp'] = $this->request->data['Productvariation']['mrp'][$key];
                $Productvariation['Productvariation']['salesprice'] = (!empty($this->request->data['Productvariation']['salesprice'][$key])) ? $this->request->data['Productvariation']['salesprice'][$key] : "";
                $Productvariation['Productvariation']['price'] = (!empty($this->request->data['Productvariation']['salesprice'][$key])) ? $this->request->data['Productvariation']['salesprice'][$key] : $this->request->data['Productvariation']['mrp'][$key];
                $Productvariation['Productvariation']['availability'] = $this->request->data['Productvariation']['availability'][$key];
                $this->Productvariation->saveAll($Productvariation['Productvariation']);
            }
            $this->Session->setFlash('Product Added successfully!', '', array(''), 'success');
            $this->redirect(array('action' => 'products'));
        }
        $categories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => '0')));
        $this->set('categories', $categories);
    }

    public function ajaxSubcategory($id = NULL) {
        $this->autoRender = false;
        $subcategories = $this->Productsubcategory->find('all', array('conditions' => array('parent_id' => $id)));
        $data = '';
        foreach ($subcategories as $subcategory) {
            $data.='<option value="' . $subcategory['Productsubcategory']['prosubcategory_id'] . '">' . $subcategory['Productsubcategory']['name'] . '</option>';
        }
        echo $data;
        exit; 
    }

    public function promo_code($length = 6, $output = 'alphanum') {
        $this->autoRender = false;
        $outputs['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';     
        // Choose seed
        if (isset($outputs[$output])) {
            $output = $outputs[$output];
        }
        // Seed generator
        list($usec, $sec) = explode(' ', microtime());
        $seed = (float) $sec + ((float) $usec * 100000);
        mt_srand($seed);
        // Generate
        $str = '';
        $output_count = strlen($output);
        for ($i = 0; $length > $i; $i++) {
            $str .= $output{mt_rand(0, $output_count - 1)};
        }
        echo $str;
        exit;
    }


    public function editproduct($product_id = NULL) {
        $this->layout = 'vendor';
        $vendor = $this->checkvendor();
        $product = $this->Product->find('first', array('conditions' => array('product_id' => $product_id)));
        if ($this->request->is('post')) {
            $this->request->data['Product']['created_date'] = date('Y-m-d H:i:s');
            $this->request->data['Product']['vendor_id'] = $vendor['Vendor']['vendor_id'];
            if (!empty($this->request->data['Product']['image']['name'])) {
                $logo = rand(0, 9999) . $this->request->data['Product']['image']['name'];
                move_uploaded_file($this->request->data['Product']['image']['tmp_name'], $vendor['Vendor']['vendor_path'] . $logo);
                $this->request->data['Product']['image'] = $logo;
            } else {
                $this->request->data['Product']['image'] = $product['Product']['image'];
            }
            $this->request->data['Product']['product_id'] = $product_id;
            $this->Product->save($this->request->data['Product']);
            $variation_ids = array();
            foreach ($this->request->data['Productvariation']['variation'] as $key => $variation) {
                $Productvariation['Productvariation'] = array();
                $Productvariation['Productvariation']['product_id'] = $product_id;
                $Productvariation['Productvariation']['variation'] = $variation;
                $Productvariation['Productvariation']['variation_id'] = (!empty($this->request->data['Productvariation']['variation_id'][$key])) ? $this->request->data['Productvariation']['variation_id'][$key] : NULL;
                $Productvariation['Productvariation']['mrp'] = $this->request->data['Productvariation']['mrp'][$key];
                $Productvariation['Productvariation']['salesprice'] = (!empty($this->request->data['Productvariation']['salesprice'][$key])) ? $this->request->data['Productvariation']['salesprice'][$key] : "";
                $Productvariation['Productvariation']['price'] = (!empty($this->request->data['Productvariation']['salesprice'][$key])) ? $this->request->data['Productvariation']['salesprice'][$key] : $this->request->data['Productvariation']['mrp'][$key];
                $Productvariation['Productvariation']['availability'] = $this->request->data['Productvariation']['availability'][$key];
                $this->Productvariation->saveAll($Productvariation['Productvariation']);
                if (!empty($this->request->data['Productvariation']['variation_id'][$key])) {
                    $variation_ids[] = $this->request->data['Productvariation']['variation_id'][$key];
                } else {
                    $variation_ids[] = $this->Productvariation->getLastInsertID();
                }
            }
            $this->Productvariation->deleteAll(array('Productvariation.product_id' => $product_id, 'NOT' => array('Productvariation.variation_id' => $variation_ids)), false);
            $this->Session->setFlash('Product Updated successfully!', '', array(''), 'vendorsuccess');
            $this->redirect(array('action' => 'products'));
        }
        $categories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => '0')));
        $this->set('categories', $categories);

        $subcategories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active', 'parent_id' => $product['Product']['category_id'])));
        $this->set('subcategories', $subcategories);

        $variations = $this->Productvariation->find('all', array('conditions' => array('product_id' => $product['Product']['product_id']), 'order' => 'variation_id ASC'));
        $this->set('variations', $variations);

        $this->set('product', $product);
    }

    public function deleteproduct($id = NULL) {
        $this->autoRender = false;
        $this->Product->updateAll(
                array('Product.status' => "'Trash'"), array('Product.product_id' => $id)
        );
        $this->Session->setFlash('Product Deleted', '', array(''), 'vendorsuccess');
        $this->redirect(array('action' => 'products'));
    }

    public function orders() {
        $this->layout = 'vendor';
        $vendor = $this->checkvendor();
        $conditions = array('Order.vendor_id' => $vendor['Vendor']['vendor_id']);
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
                    'table' => 'tbl_deliveryboys',
                    'alias' => 'Deliveryboy',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Deliveryboy.deliveryboy_id = Order.deliveryboy_id'
                    )
                )
            ), 'fields' => array('User.*', 'Order.*', 'Deliveryboy.*'), 'conditions' => $conditions, 'order' => 'Order.order_id DESC', 'limit' => '50');
        $this->set('orders', $this->Paginator->paginate('Order'));
    }

    public function vieworder($order_id = NULL) {
        $this->layout = 'vendor';
        $vendor = $this->checkvendor();
        $order = $this->Order->find('first', array('joins' => array(
                array(
                    'table' => 'tbl_users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.user_id = Order.user_id'
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
            ), 'fields' => array('Productvariation.*', 'Orderdetail.*', 'Product.*'), 'conditions' => array('Orderdetail.order_id' => $order['Order']['order_id'])));
        $this->set('orderdetails', $orderdetails);
    }

    public function subscriptions() {
        $this->layout = 'vendor';
        $vendor = $this->checkvendor();
        $conditions = array('Subscriptiondetail.vendor_id' => $vendor['Vendor']['vendor_id']);
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
            ), 'fields' => array('User.*', 'Subscriptiondetail.*', 'Product.*', 'Subscription.*'), 'conditions' => $conditions, 'order' => 'Subscriptiondetail.subdetail_id DESC', 'limit' => '50');
        $this->set('subscriptions', $this->Paginator->paginate('Subscriptiondetail'));
    }

    public function viewsubscription($id = NULL) {
        $this->layout = 'vendor';
        $vendor = $this->checkvendor();
        $subscription = $this->Subscriptiondetail->find('first', array('joins' => array(
                array(
                    'table' => 'tbl_users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.user_id = Subscriptiondetail.user_id'
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
            ), 'fields' => array('User.*', 'Subscriptiondetail.*', 'Product.*', 'Subscription.*'), 'conditions' => array('Subscriptiondetail.subdetail_id' => $id)));
        $this->set('subscription', $subscription);

        $address = $this->Deliveryaddress->find('first', array('conditions' => array('address_id' => $subscription['Subscription']['subscription_id'])));
        $this->set('address', $address);
    }

    public function wallet($id = NULL) {
        $this->layout = 'vendor';
        $vendor = $this->checkvendor();
        $this->paginate = array('conditions' => array('vendor_id' => $vendor['Vendor']['vendor_id']), 'order' => 'request_id DESC', 'limit' => '50');
        $this->set('requests', $this->Paginator->paginate('Withdrawrequest'));
        if ($this->request->is('post')) {
            if (empty($id)) {
                $check = $this->Withdrawrequest->find('first', array('conditions' => array('vendor_id' => $vendor['Vendor']['vendor_id'], 'status' => 'Pending')));
                if (!empty($check)) {
                    $this->Session->setFlash('Please wait for previous request', '', array(''), 'vendorerror');
                    $this->redirect(array('action' => 'wallet'));
                }
            }
            if ($this->request->data['Withdrawrequest']['requested_amount'] < $vendor['Vendor']['wallet_amount']) {
                $this->request->data['Withdrawrequest']['vendor_id'] = $vendor['Vendor']['vendor_id'];
                $this->request->data['Withdrawrequest']['requested_on'] = date('Y-m-d H:i:s');
                $this->request->data['Withdrawrequest']['request_id'] = (!empty($this->request->data['Withdrawrequest']['request_id'])) ? $this->request->data['Withdrawrequest']['request_id'] : NULL;
                $this->Withdrawrequest->save($this->request->data['Withdrawrequest']);
                if (!empty($this->request->data['Withdrawrequest']['request_id'])) {
                    $id = $this->Withdrawrequest->getLastInsertID();
                    $this->Withdrawrequest->updateAll(
                            array('Withdrawrequest.requestid' => "'WREQ" . ($id + 1000) . "'"), array('Withdrawrequest.request_id' => $id)
                    );
                }
                $this->Session->setFlash('Request sent', '', array(''), 'vendorsuccess');
                $this->redirect(array('action' => 'wallet'));
            } else {
                $this->Session->setFlash('In Sufficiant amount!', '', array(''), 'vendorerror');
                $this->redirect(array('action' => 'wallet'));
            }
        }
        if (!empty($id)) {
            $request = $this->Withdrawrequest->find('first', array('conditions' => array('request_id' => $id)));
            $this->request->data['Withdrawrequest'] = $request['Withdrawrequest'];
        }
    }

    public function admin_withdrawals() {
        $this->layout = 'admin';
        $admin = $this->checkadmin();
        $this->paginate = array('joins' => array(
                array(
                    'table' => 'tbl_vendors',
                    'alias' => 'Vendor',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Vendor.vendor_id = Withdrawrequest.vendor_id'
                    )
                )
            ), 'fields' => array('Vendor.*', 'Withdrawrequest.*'), 'conditions' => array(), 'order' => 'request_id DESC', 'limit' => '50');
        $this->set('requests', $this->Paginator->paginate('Withdrawrequest'));
        if ($this->request->is('post')) {
            $this->request->data['Withdrawrequest']['status'] = 'Paid';
            $this->Withdrawrequest->save($this->request->data['Withdrawrequest']);
            $this->Session->setFlash('Updated', '', array(''), 'adminsuccess');
            $this->redirect(array('action' => 'withdrawals'));
        }
    }

    public function deleterequest($id = NULL) {
        $this->layout = 'admin';
        $vendor = $this->checkvendor();
        $request = $this->Withdrawrequest->find('first', array('conditions' => array('request_id' => $id)));
        if ($request['Withdrawrequest']['status'] == 'Pending') {
            $this->Withdrawrequest->delete($id);
            $this->Session->setFlash('Deleted', '', array(''), 'vendorsuccess');
            $this->redirect(array('action' => 'wallet'));
        } else {
            $this->Session->setFlash('Could not delete', '', array(''), 'vendorerror');
            $this->redirect(array('action' => 'wallet'));
        }
    }

    public function admin_removewithdrawals($id = NULL) {
        $this->layout = 'admin';
        $vendor = $this->checkvendor();
        $request = $this->Withdrawrequest->find('first', array('conditions' => array('request_id' => $id)));
        $request['Withdrawrequest']['status'] = 'Rejected';
        $this->Withdrawrequest->save($request['Withdrawrequest']);
        $this->Session->setFlash('Updated', '', array(''), 'adminsuccess');
        $this->redirect(array('action' => 'withdrawals'));
    }

}
