<?php

App::uses('AppController', 'Controller');

/**
 * Sociallinks Controller
 *
 * @property Sociallink $Sociallink
 * @property PaginatorComponent $Paginator
 */
class WebservicesController extends AppController {
    /*
     * Components
     *
     * @var array
     */

    public $components = array('Paginator', 'Session', 'Image');
    public $uses = array('Vendor','Emailcontent','Adminuser', 'Product', 'Productvariation','Applog','Ordernotification', 'Productcategory', 'Staticpage', 'Sitesetting', 'Vendor', 'Cart', 'Cartsubscription', 'Deliveryaddress', 'Order', 'Orderdetail', 'Subscriptiondetail', 'Subscription', 'Category', 'Courierservice', 'Referal', 'Sitesetting', 'Slider', 'Rejectedorder', 'Brand', 'Notification', 'Wishlist', 'Review', 'Offer', 'Faq', 'Promocode');

    public function home() {
        $this->autoRender = false;
        $this->response->type('json');
        $token = $this->request->header('user-id');
        try {
            $sliderdata = array();
            $categorydata = array();
            $branddata = array();
            $productdata = array();
            $shopsliders = $this->Slider->find('all');
            $user = $this->User->find('first', array('conditions' => array('user_id' => $token)));
            foreach ($shopsliders as $homescreen) {
                $sliderdata[] = array(
                    'thumb' => BASE_URL . 'files/sliders/' . $homescreen['Slider']['image'],
                    'id' => $homescreen['Slider']['slider_id'],
                );
            }
            $categories = $this->Productcategory->find('all', array('conditions' => array('status' => 'Active'), 'order' => array('procategory_id DESC')));
            foreach ($categories as $category) {
                $categorydata[] = array(
                    'category_id' => $category['Productcategory']['procategory_id'],
                    'name' => $category['Productcategory']['name'],
                    'image' => !empty($category['Productcategory']['image']) ? BASE_URL.'files/category/'.$category['Productcategory']['image'] : "",
                );
            }
            $brands = $this->Brand->find('all', array('conditions' => array('status' => 'Active'), 'order' => array('brand_id DESC')));
            foreach ($brands as $brand) {
                $branddata[] = array(
                    'brand_id' => $brand['Brand']['brand_id'],
                    'name' => $brand['Brand']['name'],
                    'image' => !empty($brand['Brand']['image']) ? BASE_URL.'files/brands/'.$brand['Brand']['image'] : "",
                );
            }
            $products = $this->Product->find('all', array('conditions' => array('status' => 'Active','inventory_value >'=>0), 'order' => array('product_id DESC')));
            foreach ($products as $product) {
                $checkwishlist = $this->Wishlist->find('first', array('conditions' => array('product_id' => $product['Product']['product_id'], 'user_id' => $user['User']['user_id'])));
                $checkcart = $this->Cart->find('first', array('conditions' => array('product_id' => $product['Product']['product_id'], 'user_id' => $user['User']['user_id'],'buy_now'=>0)));
                $sales_price = !empty($product['Product']['discount_price']) ? $product['Product']['discount_price'] : $product['Product']['our_price'];
                $productdata[] = array(
                    'product_id' => $product['Product']['product_id'],
                    'product_name' => $product['Product']['name'],
                    'mrp' => $product['Product']['mrp'],
                    'our_price' => $product['Product']['our_price'],
                    'discount' => $product['Product']['discount'],
                    'discount_price' => $sales_price,
                    'weight' => $product['Product']['weight'],
                    'stock_value'=>$product['Product']['inventory_value'],
                    'image' => BASE_URL . 'files/products/' . $product['Product']['image'],
                    'description' => $product['Product']['description'],
                    'wishlist' => (!empty($checkwishlist)) ? $checkwishlist['Wishlist']['id'] : '0',
                    'cart_id' => (!empty($checkcart)) ? $checkcart['Cart']['cart_id'] : "0"
                );
            }
            $result = array("sliders" => $sliderdata, 'categories' => $categorydata,'branddata' => $branddata,'products'=>$productdata, "code" => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function productcategories() {
        $this->autoRender = false;
        $this->response->type('json');
        try {
            $conditions = array('status' => 'Active');
            if (!empty($_REQUEST['s'])) {
                $s = $_REQUEST['s'];
                $conditions['name LIKE'] = "%$s%";
            }
            $categories = ClassRegistry::init('Productcategory')->find('all', array('conditions' => $conditions));
            foreach ($categories as $category) {
                $data[] = array(
                    'procategory_id' => $category['Productcategory']['procategory_id'],
                    'name' => $category['Productcategory']['name'],
                );
            }
            $result = array('code' => '200', 'data' => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function user_register() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        try {
            $checkuser = $this->User->find('first', array('conditions' => array('email' => $params['email'], 'status !=' => 'Trash')));
            if (empty($checkuser)) {
                $checkmobile = $this->User->find('first', array('conditions' => array('mobile' => $params['mobile'], 'status !=' => 'Trash')));
                if (empty($checkmobile)) {
                    $otp = $this->str_rand(6, 'numeric');
                    $this->request->data['User'] = $params;
                    $this->request->data['User']['otp'] = $otp;
                    $this->request->data['User']['status'] = "Pending";
                    $this->request->data['User']['password'] = md5($this->request->data['User']['password']);
                    $this->request->data['User']['datetime'] = date('Y-m-d H:i:s');
                    $this->User->save($this->request->data['User']);
                    $User_id = $this->User->getLastInsertID();
                   // $sendsms = $this->sendSMS($params['mobile'], 'Welcome to Qrice. Your OTP is ' . $otp);
                    $result = array("message" => "Success!", "otp" => $otp, "code" => 200, 'user_id' => $User_id, 'newuser' => '1');
                } else {
                    $result = array("code" => 0, "message" => 'Mobile already exists!');
                }
            } else {
                $result = array("code" => 0, "message" => 'Email already exists!');
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function sendotp() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($token);
            $checkmobile = $this->User->find('first', array('conditions' => array('mobile' => $params['mobile'])));
            if (!empty($checkmobile)) {
                $otp = $this->str_rand(6, 'numeric');
                $this->request->data['User']['user_id'] = $user['User']['user_id'];
                $this->request->data['User']['otp'] = $otp;
                $this->User->save($this->request->data['User']);
                $sendsms = $this->sendSMS($params['mobile'], 'Welcome to Qrice. Your OTP is ' . $otp);
                $result = array("message" => "Success!", "otp" => $otp, "code" => 200);
            } else {
                $result = array("code" => 0, "message" => 'Mobile not found!');
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function verifyotp() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($token);
            $checkmobile = $this->User->find('first', array('conditions' => array('mobile' => $params['mobile'], 'otp' => $params['otp'])));
            if (!empty($checkmobile)) {
                $this->request->data['User']['user_id'] = $checkmobile['User']['user_id'];
                $this->request->data['User']['status'] = "Active";
                $this->User->save($this->request->data['User']);
                $result = array("message" => "Success!", "user_id" => $checkmobile['User']['user_id'], "code" => 200);
            } else {
                $result = array("code" => 0, "message" => 'OTP Mismatched');
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function user_login() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        try {
            $checkuser = $this->User->find('first', array('conditions' => array('mobile' => $params['mobile'], 'status !=' => 'Trash')));
            if (!empty($checkuser)) {
                if ($checkuser['User']['password'] == md5($params['password'])) {
                    if ($checkuser['User']['status'] == 'Active') {
                        $result = array("message" => "Success!",'otp_verification'=>0, 'user_id' => $checkuser['User']['user_id'], "code" => 200);
                    } else if ($checkuser['User']['status'] == 'Pending') {
                        $result = array("code" => 0, "message" => 'Please verify your mobile number','otp_verification'=>1,'user_id'=>$checkuser['User']['user_id']);
                    }else{
                        $result = array("code" => 0, "message" => 'Account has been deactivated ! Please contact admin!','otp_verification'=>0);
                    }
                } else {
                    $result = array("code" => 0, "message" => 'Mobile Number password mismatch!');
                }
            } else {
                $result = array("code" => 0, "message" => 'Account not found!');
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function update_userlocation() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($token);
            $user['User']['latitude'] = $params['latitude'];
            $user['User']['longitude'] = $params['longitude'];
            $this->User->save($user['User']);
            $result = array("code" => 200, "message" => 'Done');
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function user_getProfile() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $data = array(
                'user_id' => $user['User']['user_id'],
                'name' => $user['User']['name'],
                'email' => !empty($user['User']['email']) ? $user['User']['email'] : "",
                'mobile' => !empty($user['User']['mobile']) ? $user['User']['mobile'] : "",
                'notification_count' => (!empty($user['User']['notification_count'])) ? $user['User']['notification_count'] : "0",
                'profile' => (!empty($user['User']['profile']) ? BASE_URL . 'files/users/' . $user['User']['profile'] : ""),
            );
            $result = array("data" => $data, "code" => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function user_updateProfile() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($token);
            $checkuser = $this->User->find('first', array('conditions' => array('OR' => array('email' => $params['email'], 'mobile' => $params['mobile']), "user_id !=" => $user['User']['user_id'], 'status !=' => 'Trash')));
        
            if (empty($checkuser)) {
                $user['User']['profile'] = (!empty($params['profile'])) ? $this->base64_toimage($params['profile'], 'files/users/') : $user['User']['profile'];
                $user['User']['email'] = $params['email'];
                $user['User']['name'] = $params['name'];
                $user['User']['mobile'] = $params['mobile'];
                $this->User->save($user['User']);
                $result = array("message" => "Updated", "code" => 200);
            } else {
                $result = array("message" => "Email / Mobile Already exists!", "code" => 0);
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function terms() {
        $this->autoRender = false;
        $this->response->type('json');
        try {
            $page = $this->Sitesetting->find('first');
            $data = array();
            $data['page_title'] = "Terms and Conditions";
            $data['image'] = "";
            $data['page_content'] = $page['Sitesetting']['terms_conditions'];
            $result = array('data' => $data, 'code' => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function privacypolicy() {
        $this->autoRender = false;
        $this->response->type('json');
        try {
            $page = $this->Sitesetting->find('first');
            $data = array();
            $data['page_title'] = "Privacy policy";
            $data['image'] = "";
            $data['page_content'] = $page['Sitesetting']['privacy_policy'];
            $result = array('data' => $data, 'code' => 200);
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
        return json_encode($result);
        exit;
    }

    public function aboutus() {
        $this->autoRender = false;
        $this->response->type('json');
        try {
            $page = $this->Sitesetting->find('first');
            $data = array();
            $data['page_title'] = "About Us";
            $data['image'] = "";
            $data['page_content'] = $page['Sitesetting']['appinfo'];
            $data['appversion'] = $page['Sitesetting']['appversion'];
            $result = array('data' => $data, 'code' => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function contactus() {
        $this->autoRender = false;
        $this->response->type('json');
        extract($_REQUEST);
        try {
            $page = $this->Sitesetting->find('first', array('conditions' => array('id' => '1')));
            $data = array();
            $data['phone'] = $page['Sitesetting']['phone'];
            $data['email'] = $page['Sitesetting']['email'];
            $data['address'] = $page['Sitesetting']['address'];
            $result = array('data' => $data, 'code' => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function products() {
        $this->autoRender = false;
        $this->response->type('json');
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            if (isset($page_id) && $page_id && isset($limit)) {
                $offset = ($page_id - 1) * $limit;
            } else {
                $offset = 0;
                $limit = 10;
            }
            $conditions = array('status' => 'Active','inventory_value >'=> 0,'FIND_IN_SET(\'' . $_GET['pincode'] . '\',pincode)');
            if (!empty($_REQUEST['category_id'])) {
                $conditions['category_id'] = $_REQUEST['category_id'];
            }
            if (!empty($_REQUEST['brand_id'])) {
                $conditions['brand_id'] = $_REQUEST['brand_id'];
            }
            if (!empty($_REQUEST['s'])) {
                $s = $_REQUEST['s'];
                $conditions['name LIKE'] = "%$s%";
            }
            $products = $this->Product->find('all', array('conditions' => $conditions, 'limit' => $limit, 'offset' => $offset));
            $products_cnt = $this->Product->find('count', array('conditions' => $conditions));
            $data = array();
            foreach ($products as $product) {
                $checkwishlist = $this->Wishlist->find('first', array('conditions' => array('product_id' => $product['Product']['product_id'], 'user_id' => $user['User']['user_id'])));
                $checkcart = $this->Cart->find('first', array('conditions' => array('product_id' => $product['Product']['product_id'], 'user_id' => $user['User']['user_id'],'buy_now'=>0)));
                $sales_price = !empty($product['Product']['discount_price']) ? $product['Product']['discount_price'] : $product['Product']['our_price'];
                $data[] = array(
                    'product_id' => $product['Product']['product_id'],
                    'product_name' => $product['Product']['name'],
                    'mrp' => $product['Product']['mrp'],
                    'our_price' => $product['Product']['our_price'],
                    'discount' => $product['Product']['discount'],
                    'discount_price' => $sales_price,
                    'weight' => $product['Product']['weight'],
                    'stock_value' => $product['Product']['inventory_value'],
                    'image' => BASE_URL . 'files/products/' . $product['Product']['image'],
                    'description' => $product['Product']['description'],
                    'wishlist' => (!empty($checkwishlist)) ? $checkwishlist['Wishlist']['id'] : '0',
                    'cart_id' => (!empty($checkcart)) ? $checkcart['Cart']['cart_id'] : "0"
                );
            }
            $result = array("data" => $data, "code" => 200,'count'=>$products_cnt);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function productdetail($product_id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $product = $this->Product->find('first', array('conditions' => array('product_id' => $product_id)));
            $data = array();
            $cart = $this->Cart->find('first', array('conditions' => array('product_id' => $product_id,'user_id'=>$user['User']['user_id'])));
            $checkwishlist = $this->Wishlist->find('first', array('conditions' => array('product_id' => $product['Product']['product_id'], 'user_id' => $user['User']['user_id'])));
            $sales_price = !empty($product['Product']['discount_price']) ? $product['Product']['discount_price'] : $product['Product']['our_price'];
            $data = array(
                'product_id' => $product['Product']['product_id'],
                'product_name' => $product['Product']['name'],
                'mrp' => $product['Product']['mrp'],
                'our_price' => $product['Product']['our_price'],
                'discount' => $product['Product']['discount'],
                'discount_price' => $sales_price,
                'weight' => $product['Product']['weight'],
                'stock_value' => $product['Product']['inventory_value'],
                'image' => BASE_URL . 'files/products/' . $product['Product']['image'],
                'description' => $product['Product']['description'],
                'features' => $product['Product']['features'],
                'wishlist' => (!empty($checkwishlist)) ? $checkwishlist['Wishlist']['id'] : '0',
                'cart' => (!empty($cart)) ? '1' : '0'
            );
            $data['variants']=array();
            $variants = $this->Product->find('all', array('conditions' => array('name LIKE' => '%' . $product['Product']['name'] . '%')));
            foreach($variants as $variant){
                $data['variants'][]=array(
                'product_id' => $variant['Product']['product_id'],
                'product_name' => $variant['Product']['name'],
                'weight' => $variant['Product']['weight'],
                'mrp' => $variant['Product']['mrp'],
                'discount_price' => $variant['Product']['discount_price'],
                );
            }
            $result = array("data" => $data, "code" => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function addtocart() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $product = $this->Product->find('first', array('conditions' => array('product_id' => $params['product_id'])));
            $check = $this->Cart->find('first', array('conditions' => array('product_id' => $params['product_id'], 'user_id' => $user['User']['user_id'])));
            if (!empty($check)) {
                if ($params['qty'] > 0) {
                    if($params['qty'] <= $product['Product']['inventory_value']){
                    $this->request->data['Cart']['cart_id'] = $check['Cart']['cart_id'];
                    $this->request->data['Cart']['qty'] = $params['qty'];
                    $this->request->data['Cart']['buy_now'] = 0;
                    $this->Cart->save($this->request->data['Cart']);
                    $cart_count = $this->Cart->find('count', array('conditions' => array('user_id' => $user['User']['user_id'],'buy_now'=>0)));
                    $result = array("message" => "success", "code" => 200 ,"cart_count"=>$cart_count,'cart_id'=>$check['Cart']['cart_id']);
                    }else{
                     $cart_count = $this->Cart->find('count', array('conditions' => array('user_id' => $user['User']['user_id'],'buy_now'=>0)));
                     $result = array("message" => "You are adding the quantity more than stock!", "code" => 0 ,"cart_count"=>$cart_count);
                    }
                } else {
                    $this->Cart->deleteAll(array("Cart.product_id" => $params['product_id'], "Cart.user_id" => $user['User']['user_id']), false);
                    $cart_count = $this->Cart->find('count', array('conditions' => array('user_id' => $user['User']['user_id'],'buy_now'=>0)));
                    $result = array("message" => "Removed from cart", "code" => 200,"cart_count"=>$cart_count);
                }
            } else {
                if($params['qty'] <= $product['Product']['inventory_value']){
                $this->request->data['Cart']['user_id'] = $user['User']['user_id'];
                $this->request->data['Cart']['product_id'] = $params['product_id'];
                $this->request->data['Cart']['qty'] = $params['qty'];
                $this->request->data['Cart']['buy_now'] = 0;
                $this->Cart->save($this->request->data['Cart']);
                $crt_id = $this->Cart->getLastInsertID();
                $cart_count = $this->Cart->find('count', array('conditions' => array('user_id' => $user['User']['user_id'],'buy_now'=>0)));
                $result = array("message" => "success", "code" => 200,"cart_count"=>$cart_count,'cart_id'=>$crt_id);
                }else{
                     $cart_count = $this->Cart->find('count', array('conditions' => array('user_id' => $user['User']['user_id'],'buy_now'=>0)));
                     $result = array("message" => "You are adding the quantity more than stock!", "code" => 0 ,"cart_count"=>$cart_count);
                }
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }
    public function buynow() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $product = $this->Product->find('first', array('conditions' => array('product_id' => $params['product_id'])));
            $check = $this->Cart->find('first', array('conditions' => array('product_id' => $params['product_id'], 'user_id' => $user['User']['user_id'])));
            $this->Cart->deleteAll(array("Cart.product_id" => $params['product_id'], "Cart.user_id" => $user['User']['user_id']), false);
            $this->Cart->deleteAll(array("Cart.buy_now" => 1, "Cart.user_id" => $user['User']['user_id']), false);
            $this->request->data['Cart']['user_id'] = $user['User']['user_id'];
            $this->request->data['Cart']['product_id'] = $params['product_id'];
            $this->request->data['Cart']['buy_now'] = 1;
            $this->request->data['Cart']['qty'] = $params['qty'];
            $this->Cart->save($this->request->data['Cart']);
            $cart_count = $this->Cart->find('count', array('conditions' => array('user_id' => $user['User']['user_id'],'buy_now'=>0)));
            $result = array("message" => "success", "code" => 200);
            
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function clearcart() {
        $this->autoRender = false;
        $this->response->type('json');
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $this->Cart->deleteAll(array("Cart.user_id" => $user['User']['user_id']), false);
            $result = array("code" => 200, "message" => 'success');
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function cartpage() {
        $this->autoRender = false;
        $this->response->type('json');
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $cartitems = $this->Cart->find('all', array('joins' => array(
                    array(
                        'table' => 'tbl_products',
                        'alias' => 'Product',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Product.product_id = Cart.product_id'
                        )
                    )
                ), 'fields' => array('Cart.*', 'Product.*'), 'conditions' => array('Cart.user_id' => $user['User']['user_id'],'Cart.buy_now' => 0)));
            $itemtotal = 0;
            $products = array();
            foreach ($cartitems as $cartitem) {
                $brand = $this->Brand->find('first', array('conditions' => array('brand_id' => $cartitem['Product']['brand_id'])));
                $sales_price = !empty($cartitem['Product']['discount_price']) ? $cartitem['Product']['discount_price'] : $cartitem['Product']['our_price'];
                $products[] = array(
                    'cart_id' => $cartitem['Cart']['cart_id'],
                    'product_id' => $cartitem['Product']['product_id'],
                    'product_name' => $cartitem['Product']['name'],
                    'stock_value' => $cartitem['Product']['inventory_value'],
                    'description' => $cartitem['Product']['description'],
                    'weight' => $cartitem['Product']['weight'],
                    'image' => BASE_URL . 'files/products/' . $cartitem['Product']['image'],
                    'qty' => $cartitem['Cart']['qty'],
                    'price' => $sales_price,
                    'total' => $sales_price * $cartitem['Cart']['qty'],
                );
                $itemtotal += ($sales_price * $cartitem['Cart']['qty']);
            }
            $result = array("code" => 200, 'products' => $products, "itemtotal" => $itemtotal, "deliveryfee" => '100');
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function checkoutpage() {
        $this->autoRender = false;
        $this->response->type('json');
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $cartitems = $this->Cart->find('all', array('joins' => array(
                    array(
                        'table' => 'tbl_products',
                        'alias' => 'Product',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Product.product_id = Cart.product_id'
                        )
                    )
                ), 'fields' => array('Cart.*', 'Product.*'), 'conditions' => array('Cart.user_id' => $user['User']['user_id'],'Cart.buy_now' => $_REQUEST['buy_now'])));
            $cartitems_count = $this->Cart->find('count', array('conditions' => array('user_id' => $user['User']['user_id'],'buy_now'=>$_REQUEST['buy_now'])));
            $itemtotal = 0;
            $products = array();
            foreach ($cartitems as $cartitem) {
                $brand = $this->Brand->find('first', array('conditions' => array('brand_id' => $cartitem['Product']['brand_id'])));
                $sales_price = !empty($cartitem['Product']['discount_price']) ? $cartitem['Product']['discount_price'] : $cartitem['Product']['our_price'];
                $products[] = array(
                    'product_id' => $cartitem['Product']['product_id'],
                    'product_name' => $cartitem['Product']['name'],
                    'description' => $cartitem['Product']['description'],
                    'weight' => $cartitem['Product']['weight'],
                    'image' => BASE_URL . 'files/products/' . $cartitem['Product']['image'],
                    'qty' => $cartitem['Cart']['qty'],
                    'price' => $sales_price,
                    'total' => $sales_price * $cartitem['Cart']['qty'],
                );
                $itemtotal += ($sales_price * $cartitem['Cart']['qty']);
            }
            $setting = $this->Sitesetting->find('first');
            $checkpromocodes = $this->Promocode->find('all', array('conditions' => array('DATE(expiry_date) >=' => date('Y-m-d'))));
            $promo = !empty($checkpromocodes) ? 1 : "0";
            // $km = $this->distance($user['User']['latitude'], $user['User']['longitude'], $setting['Sitesetting']['latitude'], $setting['Sitesetting']['longitude'], 'K');
            // $delivery_charge = $km * $setting['Sitesetting']['delivery_charge'];
            $result = array("code" => 200, 'products' => $products, "itemtotal" => $itemtotal, "total_items" => $cartitems_count, "deliveryfee" =>$setting['Sitesetting']['delivery_charge'] , 'sampe_rice_charge' => $setting['Sitesetting']['sample_rice_charge'], "payable" => $itemtotal + $setting['Sitesetting']['delivery_charge'] + $setting['Sitesetting']['sample_rice_charge'],'promocode'=>$promo);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function applypromocode() {
        $this->autoRender = false;
        $this->response->type('json');
        $user_id = $this->request->header('user-id');
        $params = json_decode($this->request->input(), true);
        try {
            $user = $this->checkappuser($user_id);
            $data = array();
            $products=array();
            if(!empty($user)){
                $checkpromocode = $this->Promocode->find('first', array('conditions' => array('code' => $params['code'], 'DATE(expiry_date) >=' => date('Y-m-d'))));
            if (!empty($checkpromocode)) {
                 $carts = $this->Cart->find('all', array('conditions' => array('user_id'=>$user['User']['user_id'],'buy_now'=>$_GET['buy_now'])));
                 $total_amount = 0;
                 $j=1;
                 foreach($carts as $cart){
                     $product = $this->Product->find('first', array('conditions' => array('product_id'=>$cart['Cart']['product_id'])));
                     $s_price = !empty($product['Product']['discount_price']) ? $product['Product']['discount_price'] : $product['Product']['our_price'];
                     $total_amount = $total_amount + ($s_price*$cart['Cart']['qty']);
                     $products[]=array(
                    'product_id' => $cart['Cart']['product_id'],
                    'product_name' => $product['Product']['name'],
                    'description' => $product['Product']['description'],
                    'weight' => $product['Product']['weight'],
                    'image' => BASE_URL . 'files/products/' . $product['Product']['image'],
                    'qty' => $cart['Cart']['qty'],
                    'price' => $s_price,
                    'total' => $s_price * $cart['Cart']['qty'],
                );
                $j++;
                }
                $setting = $this->Sitesetting->find('first');
                $payable = $total_amount + $setting['Sitesetting']['delivery_charge'] + $setting['Sitesetting']['sample_rice_charge'];
                if($checkpromocode['Promocode']['type']=="Fixed Value"){
                    $discount = round($checkpromocode['Promocode']['value']); 
                }else{
                    $discount = $payable * $checkpromocode['Promocode']['value'] / 100;
                }
                $cartitems_count = $this->Cart->find('count', array('conditions' => array('user_id' => $user['User']['user_id'],'buy_now'=>0)));
                $data = array(
                    'id' => $checkpromocode['Promocode']['id'],
                    'type' => $checkpromocode['Promocode']['type'],
                    'code' => $checkpromocode['Promocode']['code'],
                    'value' => $checkpromocode['Promocode']['value'],
                    'itemtotal'=>$total_amount,
                    'total_items'=>$cartitems_count,
                    "deliveryfee" =>$setting['Sitesetting']['delivery_charge'],
                    'sampe_rice_charge' => $setting['Sitesetting']['sample_rice_charge'],
                    'payable' => round($payable),
                    'code_discount'=>round($discount),
                    'net_payable' => round($payable - $discount)
                );
                $result = array("code" => 200, "data" => $data,"products"=> $products);
            } else {
                $result = array("code" => 0, "message" => 'Invalid promocode');
            }
         }else{
             $result = array("code" => 0, "message" => 'Invalid User');
         }
            
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }
    
    public function promocode_list() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        try {
            $checkpromocodes = $this->Promocode->find('all', array('conditions' => array('DATE(expiry_date) >=' => date('Y-m-d'))));
            $data=array();
            if(!empty($checkpromocodes)){
            foreach($checkpromocodes as $checkpromocode){
               $data[] = array(
                    'id' => $checkpromocode['Promocode']['id'],
                    'type' => $checkpromocode['Promocode']['type'],
                    'code' => $checkpromocode['Promocode']['code'],
                    'value' => $checkpromocode['Promocode']['value'],
                ); 
            }
            }
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function addaddress() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $this->request->data['Deliveryaddress'] = $params;
            $this->request->data['Deliveryaddress']['type'] = 'Home';
            $this->request->data['Deliveryaddress']['user_id'] = $user['User']['user_id'];
            $this->Deliveryaddress->save($this->request->data['Deliveryaddress']);
            $address_id = $this->Deliveryaddress->getLastInsertID();
            $result = array("code" => 200, "address_id" => $address_id);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }
    
    public function primary_address($id) {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $addresses = $this->Deliveryaddress->find('all', array('conditions' => array('user_id' => $user['User']['user_id'],'status'=>"Active")));
            foreach($addresses as $address){
            $address['Deliveryaddress']['primary_address'] = 0;
            $this->Deliveryaddress->saveAll($address['Deliveryaddress']);
            }
            $this->request->data['Deliveryaddress']['primary_address'] = 1;
            $this->request->data['Deliveryaddress']['address_id'] = $id;
            $this->Deliveryaddress->save($this->request->data['Deliveryaddress']);
            $result = array("code" => 200, "address_id" => $id);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function updateaddress($id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $this->request->data['Deliveryaddress'] = $params;
            $this->request->data['Deliveryaddress']['address_id'] = $id;
            $this->request->data['Deliveryaddress']['user_id'] = $user['User']['user_id'];
            $this->Deliveryaddress->save($this->request->data['Deliveryaddress']);
            $result = array("code" => 200, "address_id" => $id);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function getaddress($id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $address = $this->Deliveryaddress->find('first', array('conditions' => array('address_id' => $id)));
            unset($address['Deliveryaddress']['type']);
            unset($address['Deliveryaddress']['locality']);
            unset($address['Deliveryaddress']['alt_mobile']);
            unset($address['Deliveryaddress']['status']);
            $result = array("code" => 200, "data" => $address['Deliveryaddress']);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function alladdress() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $alladdress = $this->Deliveryaddress->find('all', array('conditions' => array('user_id' => $user['User']['user_id'], 'status !=' => 'Trash')));
            $data = array();
            foreach ($alladdress as $address) {
                unset($address['Deliveryaddress']['type']);
                unset($address['Deliveryaddress']['locality']);
                unset($address['Deliveryaddress']['alt_mobile']);
                unset($address['Deliveryaddress']['status']);
                $data[] = $address['Deliveryaddress'];
            }
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function deleteaddress($id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $this->Deliveryaddress->updateAll(
                    array('Deliveryaddress.status' => "'Trash'"), array('Deliveryaddress.address_id' => $id)
            );
            $result = array("code" => 200, "message" => "Done");
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function placeorder() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $setting = $this->Sitesetting->find('first');
            $cartitems = $this->Cart->find('all', array('conditions' => array('user_id' => $user['User']['user_id'],'buy_now'=>$_GET['buy_now'])));
            if(!empty($cartitems)){
            $this->request->data['Order'] = $params;
            $this->request->data['Order']['total_products'] = count($cartitems);
            $this->request->data['Order']['user_id'] = $user['User']['user_id'];
            $this->request->data['Order']['sample_rice_charge'] =  $setting['Sitesetting']['sample_rice_charge'];
            //$this->request->data['Order']['grand_total'] =  $setting['Sitesetting']['sample_rice_charge'] + $params['delivery_charge'] + $params['total_amount'];
            $this->request->data['Order']['datetime'] = date('Y-m-d H:i:s');
            $this->Order->save($this->request->data['Order']);
            $order_id = $this->Order->getLastInsertID();
            $this->Order->updateAll(
                    array('Order.orderid' => "'ORDER" . ($order_id + 10000) . "'"), array('Order.order_id' => $order_id)
            );

            foreach ($cartitems as $cartitem) {
                $product = $this->Product->find('first', array('conditions' => array('product_id' => $cartitem['Cart']['product_id'])));
                $s_price = !empty($product['Product']['discount_price']) ? $product['Product']['discount_price'] : $product['Product']['our_price'];
                $this->request->data['Orderdetail'] = array();
                $this->request->data['Orderdetail']['order_id'] = $order_id;
                $this->request->data['Orderdetail']['product_id'] = $cartitem['Cart']['product_id'];
                $this->request->data['Orderdetail']['price'] = $s_price;
                $this->request->data['Orderdetail']['qty'] = $cartitem['Cart']['qty'];
                $this->request->data['Orderdetail']['total_amount'] = $s_price * $cartitem['Cart']['qty'];
                $this->Orderdetail->saveAll($this->request->data['Orderdetail']);
            }
            $bookingdetail = $this->get_orderdetails($order_id);
            $last = $this->Order->find('first', array('conditions' => array('order_id' => $order_id)));
            $orderdetails = $this->Orderdetail->find('all', array('conditions' => array('order_id' => $order_id)));
            foreach($orderdetails as $orderdetail){
                $product = $this->Product->find('first', array('conditions' => array('product_id' => $orderdetail['Orderdetail']['product_id'])));
                if($product['Product']['inventory_value'] >= 0){
                    $remain = $product['Product']['inventory_value'] - $orderdetail['Orderdetail']['qty'];
                    if($remain >=0){
                       $product['Product']['inventory_value'] = $remain;
                       $this->Product->saveAll($product['Product']);
                    }
                }
             }
            
            $content = "New Order Placed for you!. Order Id : ".$last['Order']['orderid'];
            $admin = $this->Adminuser->find('first');
            if (!empty($admin['Adminuser']['email'])) {
                $emailcontent = $this->Emailcontent->find('first', array('conditions' => array('emailcontent_id' => '16')));
                $emailmessage = str_replace(array('{name}', '{content}', '{detail}'), array("Admin", $content, $bookingdetail), $emailcontent['Emailcontent']['emailcontent']);
                $this->mailsend($emailcontent['Emailcontent']['fromname'], $emailcontent['Emailcontent']['fromemail'], $admin['Adminuser']['email'], $emailcontent['Emailcontent']['subject'], $emailmessage);
            }
            $this->Cart->deleteAll(array("Cart.user_id" => $user['User']['user_id'],'buy_now'=>$_GET['buy_now']), false);
            $result = array("code" => 200, "order_id" => $order_id);
            }else{
               $result = array("code" => 0, "order_id" => ""); 
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }
    
    public function repeat_order($id) {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $order = $this->Order->find('first', array('conditions' => array('order_id' => $id)));
            $orderdetails = $this->Orderdetail->find('all', array('conditions' => array('order_id' => $id)));
            foreach ($orderdetails as $orderdetail) {
                $already = $this->Cart->find('first', array('conditions' => array('user_id' => $order['Order']['user_id'],'product_id'=>$orderdetail['Orderdetail']['product_id'])));
                if(empty($already)){
                $this->request->data['Cart']['user_id'] = $order['Order']['user_id'];
                $this->request->data['Cart']['product_id'] = $orderdetail['Orderdetail']['product_id'];
                $this->request->data['Cart']['qty'] = $orderdetail['Orderdetail']['qty'];
                $this->request->data['Cart']['buy_now'] = 0;
                $this->Cart->saveAll($this->request->data['Cart']); 
                }else{
                $already['Cart']['qty'] = $orderdetail['Orderdetail']['qty'] + $already['Cart']['qty'];
                $already['Cart']['buy_now'] = 0;
                $already['Cart']['cart_id'] = $already['Cart']['cart_id'];
                $this->Cart->saveAll($already['Cart']);  
                }
                
            }
            $cart_count = $this->Cart->find('count', array('conditions' => array('user_id' => $order['Order']['user_id'],'buy_now'=>0)));
            $result = array("code" => 200, "message"=>"Added to your cart successfully!","cart_count"=>$cart_count);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function user_orders() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $conditions = array('user_id' => $user_id);
            if (!empty($_REQUEST['status']) && $_REQUEST['status'] == 'past') {
                $conditions['order_status'] = 'Delivered';
            } else {
                $conditions['order_status !='] = 'Delivered';
            }
            $orders = $this->Order->find('all', array('conditions' => $conditions, 'order' => 'order_id DESC'));
            $data = array();
            foreach ($orders as $order) {
                $orderdetails = $this->Orderdetail->find('all', array('conditions' => array('order_id' => $order['Order']['order_id'])));
                $users = $this->User->find('first', array('conditions' => array('user_id' => $order['Order']['user_id'])));
                if($order['Order']['order_status']=="Re-assign"){
                    $status="Assigned";
                }else{
                    $status=$order['Order']['order_status'];
                }
                
                if($order['Order']['order_status']=="Delivered"){
                    $reviews = $this->Review->find('first', array('conditions' => array('order_id' => $order['Order']['order_id'])));
                    if(empty($reviews)){
                       $rbnt=1; 
                    }else{
                       $rbnt=0; 
                    }
                }else{
                   $rbnt=0;
                }
                $date=date('Y-m-d', strtotime($order['Order']['datetime']));
                $data[] = array(
                    'order_id' => $order['Order']['order_id'],
                    'orderid' => $order['Order']['orderid'],
                    'total_products' => count($orderdetails),
                    'grand_total' => $order['Order']['total_amount'],
                    'user_name' => $users['User']['name'],
                    'status' => $status,
                    'order_date' => $date,
                    'delivery_schedule' => date('d M Y', strtotime('+2 day', strtotime($order['Order']['datetime']))),
                    'review_btn'=>$rbnt
                );
            }
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function orderdetail($order_id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $order = $this->Order->find('first', array('conditions' => array('order_id' => $order_id)));
            $deliveryboy = $this->Deliveryboy->find('first', array('conditions' => array('deliveryboy_id' => $order['Order']['deliveryboy_id'])));
            $address = $this->Deliveryaddress->find('first', array('conditions' => array('address_id' => $order['Order']['address_id'])));
            $review = $this->Review->find('first', array('conditions' => array('order_id' => $order['Order']['order_id'])));
            $orderdetails = $this->Orderdetail->find('all', array('joins' => array(
                    array(
                        'table' => 'tbl_products',
                        'alias' => 'Product',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Product.product_id = Orderdetail.product_id'
                        )
                    ),
                ), 'fields' => array('Orderdetail.*', 'Product.*'), 'conditions' => array('Orderdetail.order_id' => $order['Order']['order_id'])));
            $order_products = array();
            foreach ($orderdetails as $orderdetail) {
                $order_products[] = array(
                    'product_id' => $orderdetail['Orderdetail']['product_id'],
                    'product_name' => $orderdetail['Product']['name'],
                    'image' => BASE_URL . 'files/products/' . $orderdetail['Product']['image'],
                    'description' => $orderdetail['Product']['description'],
                    'weight' => $orderdetail['Product']['weight'],
                    'qty' => $orderdetail['Orderdetail']['qty'],
                    'mrp' => $orderdetail['Product']['mrp'],
                    'our_price' => $orderdetail['Product']['our_price'],
                    'price' => $orderdetail['Product']['discount_price'],
                    'total_amount' => $orderdetail['Orderdetail']['total_amount'],
                );
            }
            unset($address['Deliveryaddress']['type']);
            unset($address['Deliveryaddress']['locality']);
            unset($address['Deliveryaddress']['alt_mobile']);
            unset($address['Deliveryaddress']['status']);
            if($order['Order']['order_status']=="Re-assign"){
                $status="Assigned";
            }else{
                $status=$order['Order']['order_status']; 
            }
            if($order['Order']['order_status']=="Delivered"){
                $reviews = $this->Review->find('first', array('conditions' => array('order_id' => $order['Order']['order_id'])));
                if(empty($reviews)){
                    $rbnt=1; 
                }else{
                    $rbnt=0; 
                }
            }else{
                $rbnt=0;
            }
            $date = date('d-m-y', strtotime($order['Order']['datetime']));
            $data = array(
                'type' => 'Order',
                'order_id' => $order['Order']['order_id'],
                'orderid' => $order['Order']['orderid'],
                'order_date' => $date,
                'deliver_date' => date('d M Y', strtotime('+2 day', strtotime($order['Order']['datetime']))),
                'delivery_address' => $address['Deliveryaddress'],
                'total_items' => $order['Order']['total_products'],
                'item_total' => $order['Order']['total_amount'],
                'delivery_charge' => $order['Order']['delivery_charge'],
                'discount_amount' => $order['Order']['discount_amount'],
                'grand_total' => $order['Order']['grand_total'],
                'sample_rice_charge' =>$order['Order']['sample_rice_charge'],
                'status' => $status,
                'products' => $order_products,
                'payment_method' => $order['Order']['payment_method'],
                'review_btn'=>$rbnt
            );
            $data['review'] = array();
            if (!empty($review)) {
                $data['review'][] = array(
                    'review_id' => $review['Review']['review_id'],
                    'rating' => $review['Review']['rating'],
                    'review' => $review['Review']['review'],
                );
            }
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function updatereview() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $this->request->data["Review"]['user_id'] = $user_id;
            $this->request->data["Review"]['order_id'] = $params['order_id'];
            $this->request->data["Review"]['review'] = $params['review'];
            $this->request->data["Review"]['rating'] = $params['rating'];
            $this->request->data["Review"]['created_date'] = date('Y-m-d H:i:s');
            $this->Review->save($this->request->data["Review"]);
            $result = array("code" => 200, "message" => 'Success');
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function deliveryboy_login() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        try {
            $checkemail = $this->Deliveryboy->find('first', array('conditions' => array('mobile' => $params['mobile'])));
            if (!empty($checkemail)) {
                if ($checkemail['Deliveryboy']['password'] == md5($params['password'])) {
                    if ($checkemail['Deliveryboy']['status'] == "Active") {
                        $result = array("deliveryboy_id" => $checkemail['Deliveryboy']['deliveryboy_id'], "code" => 200);
                    } else {
                        $result = array("message" => "Please wait for admin approval!", "code" => 0);
                    }
                } else {
                    $result = array("message" => "Mobile password mismatch!", "code" => 0);
                }
            } else {
                $result = array("message" => "Account not found!", "code" => 0);
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }
    
    public function deliveryboy_forgotpassword() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        try {
            $checkemail = $this->Deliveryboy->find('first', array('conditions' => array('mobile' => $params['mobile'],'status'=>"Active")));
            if (!empty($checkemail)) {
                $otp = $this->str_rand(6, 'numeric');
                // $emailcontent = $this->Emailcontent->find('first', array('conditions' => array('emailcontent_id' => '2')));
                // $message = str_replace(array('{name}', '{password}', '{email}'), array($checkemail['Deliveryboy']['name'], $password, $checkemail['Deliveryboy']['email']), $emailcontent['Emailcontent']['emailcontent']);
                // $this->mailsend($emailcontent['Emailcontent']['fromname'], $emailcontent['Emailcontent']['fromemail'], $checkemail['Deliveryboy']['email'], $emailcontent['Emailcontent']['subject'], $message);
                $this->request->data['Deliveryboy']['otp'] = $otp;
                $this->request->data['Deliveryboy']['deliveryboy_id'] = $checkemail['Deliveryboy']['deliveryboy_id'];
                $this->Deliveryboy->save($this->request->data['Deliveryboy']);
                $sendsms = $this->sendSMS($params['mobile'], 'Please use this OTP for change your password ' . $otp);
                $result = array("message" => "OTP sent your mobile number!", "otp" => $otp, "code" => 200, "deliveryboy_id" => $checkemail['Deliveryboy']['deliveryboy_id']);
            } else {
                $result = array("message" => "Account not found!", "code" => 0);
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }
    
    public function deliveryboy_verifyotp() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $dboy_id = $this->request->header('deliveryboy-id');
        try {
            $deliveryboy = $this->checkappdeliveryboy($dboy_id);
            $checkmobile = $this->Deliveryboy->find('first', array('conditions' => array('mobile' => $params['mobile'], 'otp' => $params['otp'], 'status' => 'Active')));
            if (!empty($checkmobile)) {
                $result = array("message" => "Success!", "deliveryboy_id" => $checkmobile['Deliveryboy']['deliveryboy_id'], "code" => 200);
            } else {
                $result = array("code" => 0, "message" => 'OTP Mismatched');
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }
    
    public function deliveryboy_forgot_resetpassword() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $dboy_id = $this->request->header('deliveryboy-id');
        try {
            $checkmobile = $this->Deliveryboy->find('first', array('conditions' => array('mobile' => $params['mobile'], 'status' => 'Active')));
            if (!empty($checkmobile)) {
                $this->request->data['Deliveryboy']['password'] = md5($params['password']);
                $this->request->data['Deliveryboy']['deliveryboy_id'] = $checkmobile['Deliveryboy']['deliveryboy_id'];
                $this->Deliveryboy->save($this->request->data['Deliveryboy']);
                $result = array("message" => "Success!, your password has been updated!", "deliveryboy_id" => $checkmobile['Deliveryboy']['deliveryboy_id'], "code" => 200);
            } else {
                $result = array("code" => 0, "message" => 'Mobile No Mismatched');
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function deliveryboy_profile() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $dboy_id = $this->request->header('deliveryboy-id');
        try {
            $deliveryboy = $this->Deliveryboy->find('first', array('conditions' => array('deliveryboy_id' => $dboy_id)));
            $data = array(
                'id' => $deliveryboy['Deliveryboy']['deliveryboyid'],
                'name' => $deliveryboy['Deliveryboy']['name'],
                'email' => $deliveryboy['Deliveryboy']['email'],
                'mobile' => $deliveryboy['Deliveryboy']['mobile'],
                'profile' => (!empty($deliveryboy['Deliveryboy']['profile'])) ? BASE_URL . 'files/deliveryboys/' . $deliveryboy['Deliveryboy']['profile'] : "",
                'address' => $deliveryboy['Deliveryboy']['address']
            );
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function deliveryboy_dashboard() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $dboy_id = $this->request->header('deliveryboy-id');
        try {
            $status1 = array("Cancelled","Re-assign");
            $pendingorders = $this->Order->find('count', array('conditions' => array('order_status' => "Assigned", 'deliveryboy_id' => $dboy_id)));
            $deliveredorders = $this->Order->find('count', array('conditions' => array('order_status' => 'Delivered', 'deliveryboy_id' => $dboy_id)));
            $cancelledorders = $this->Order->find('count', array('conditions' => array('order_status' => $status1, 'deliveryboy_id' => $dboy_id)));
            $data = array(
                'pendingorders' => $pendingorders,
                'deliveredorders' => $deliveredorders,
                'cancelledorders' => $cancelledorders
            );
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function deliveryboy_orders() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $dboy_id = $this->request->header('deliveryboy-id');
        try {
            $deliveryboy = $this->checkappdeliveryboy($dboy_id);
            $conditions = array('deliveryboy_id' => $dboy_id);
            if (!empty($_GET['status']) && $_GET['status'] == 'pending') {
              //  $sts="Out for Delivery";
                 $sts="Assigned";

                $conditions['order_status'] = $sts;
            } elseif (!empty($_GET['status']) && $_GET['status'] == 'delivered') {
                $conditions['order_status'] = 'Delivered';
            } else if (!empty($_GET['status']) && $_GET['status'] == 'cancelled') {
                $sts1 = array("Cancelled","Re-assign");
                $conditions['order_status'] = $sts1;
            }else{
                $sts="Assigned";
                $conditions['order_status'] = $sts;
            }
            if (isset($page_id) && $page_id && isset($limit)) {
                $offset = ($page_id - 1) * $limit;
            } else {
                $offset = 0;
                $limit = 10;
            }
            $orders = $this->Order->find('all', array('conditions' => $conditions, 'limit' => $limit, 'offset' => $offset,'order'=>'order_id desc'));
            $data = array();
            foreach ($orders as $order) {
                if($order['Order']['order_status']=="Out for Delivery"){
                    $dbtn=1;
                }else{
                    $dbtn=0;
                }
                
                if(($order['Order']['order_status']=="Confirmed") || ($order['Order']['order_status']=="Assigned") || (($order['Order']['order_status']=="Out for Delivery"))){
                    $status="pending";
                }else if($order['Order']['order_status']=="Re-assign"){
                    $status = "Cancelled";
                }else{
                    $status = $order['Order']['order_status'];
                }
                $orderdetails = $this->Orderdetail->find('all', array('conditions' => array('order_id' => $order['Order']['order_id'])));
                $users = $this->User->find('first', array('conditions' => array('user_id' => $order['Order']['user_id'])));
                $data[] = array(
                    'order_id' => $order['Order']['order_id'],
                    'orderid' => $order['Order']['orderid'],
                    'total_products' => count($orderdetails),
                    'grand_total' => $order['Order']['total_amount'],
                    'user_name' => $users['User']['name'],
                    'status' => $status,
                    'payment_method' => $order['Order']['payment_method'],
                    'order_date' => date('Y-m-d', strtotime($order['Order']['datetime'])),
                    'delivery_schedule' => date('d M Y', strtotime('+2 day', strtotime($order['Order']['datetime']))),
                    'status_updated_date' => date('Y-m-d', strtotime($order['Order']['updated_date'])),
                    'user_latitude' => !empty($users['User']['latitude']) ? $users['User']['latitude'] : "",
                    'user_longitude' => !empty($users['User']['longitude']) ? $users['User']['longitude'] : "",
                    'delivery_btn'=>$dbtn
                );
            }
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function deliveryboy_orderdetail($order_id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $dboy_id = $this->request->header('deliveryboy-id');
        try {
            $order = $this->Order->find('first', array('conditions' => array('order_id' => $order_id)));
            $deliveryboy = $this->Deliveryboy->find('first', array('conditions' => array('deliveryboy_id' => $order['Order']['deliveryboy_id'])));
            $address = $this->Deliveryaddress->find('first', array('conditions' => array('address_id' => $order['Order']['address_id'])));
            $review = $this->Review->find('first', array('conditions' => array('order_id' => $order['Order']['order_id'])));
            $orderdetails = $this->Orderdetail->find('all', array('joins' => array(
                    array(
                        'table' => 'tbl_products',
                        'alias' => 'Product',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Product.product_id = Orderdetail.product_id'
                        )
                    ),
                ), 'fields' => array('Orderdetail.*', 'Product.*'), 'conditions' => array('Orderdetail.order_id' => $order['Order']['order_id'])));
            $order_products = array();
            foreach ($orderdetails as $orderdetail) {
                $order_products[] = array(
                    'product_id' => $orderdetail['Orderdetail']['product_id'],
                    'product_name' => $orderdetail['Product']['name'],
                    'image' => BASE_URL . 'files/products/' . $orderdetail['Product']['image'],
                    'description' => $orderdetail['Product']['description'],
                    'weight' => $orderdetail['Product']['weight'],
                    'qty' => $orderdetail['Orderdetail']['qty'],
                    'mrp' => $orderdetail['Product']['mrp'],
                    'our_price' => $orderdetail['Product']['our_price'],
                    'price' => $orderdetail['Product']['discount_price'],
                    'total_amount' => $orderdetail['Orderdetail']['total_amount'],
                );
            }
            unset($address['Deliveryaddress']['type']);
            unset($address['Deliveryaddress']['latitude']);
            unset($address['Deliveryaddress']['latitude']);
            unset($address['Deliveryaddress']['longitude']);
            unset($address['Deliveryaddress']['alt_mobile']);
            unset($address['Deliveryaddress']['status']);
            if(($order['Order']['order_status']=="Confirmed") || ($order['Order']['order_status']=="Assigned") || (($order['Order']['order_status']=="Out for Delivery"))){
                $status="pending";
            }else if($order['Order']['order_status']=="Re-assign"){
                $status = "Cancelled";
            }else{
                $status = $order['Order']['order_status'];
            }
            if($order['Order']['order_status']=="Out for Delivery"){
                $dbtn=1;
            }else{
                $dbtn=0;
            }
            $user = $this->User->find('first', array('conditions' => array('user_id' => $order['Order']['user_id'])));
            $data = array(
                'type' => 'Order',
                'order_id' => $order['Order']['order_id'],
                'orderid' => $order['Order']['orderid'],
                'order_date' => date('d-m-y', strtotime($order['Order']['datetime'])),
                'deliver_date' => date('d M Y', strtotime('+2 day', strtotime($order['Order']['datetime']))),
                'delivery_address' => $address['Deliveryaddress'],
                'latitude'=>$user['User']['latitude'],
                'longitude'=>$user['User']['longitude'],
                'total_items' => $order['Order']['total_products'],
                'item_total' => $order['Order']['total_amount'],
                'delivery_charge' => $order['Order']['delivery_charge'],
                'discount_amount' => $order['Order']['discount_amount'],
                'grand_total' => $order['Order']['grand_total'],
                'status' => $status,
                'products' => $order_products,
                'payment_method' => $order['Order']['payment_method'],
                'delivery_btn'=>$dbtn
            );
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function deliveryboy_updateorderstatus($id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $dboy_id = $this->request->header('deliveryboy-id');
        try {
            $order = $this->Order->find('first', array('conditions' => array('order_id' => $id)));
            if($params['status']=="Cancelled"){
                $order['Order']['order_status'] = "Re-assign";
            }else{
               $order['Order']['order_status'] = $params['status']; 
            }
            $this->Order->save($order['Order']);
            $bookingdetail = $this->get_orderdetails($id);
            $last = $this->Order->find('first', array('conditions' => array('order_id' => $id)));
            $content = "Delivery boy update the order status to ".$last['Order']['order_status']." and Order Id : ".$last['Order']['orderid'];
            $admin = $this->Adminuser->find('first');
            if (!empty($admin['Adminuser']['email'])) {
                $emailcontent = $this->Emailcontent->find('first', array('conditions' => array('emailcontent_id' => '8')));
                $emailmessage = str_replace(array('{name}', '{status}', '{content}'), array("Admin", $content, $bookingdetail), $emailcontent['Emailcontent']['emailcontent']);
                $this->mailsend($emailcontent['Emailcontent']['fromname'], $emailcontent['Emailcontent']['fromemail'], $admin['Adminuser']['email'], $emailcontent['Emailcontent']['subject'], $emailmessage);
            }
            if($params['status']=="Cancelled"){
            $orderdetails = $this->Orderdetail->find('all', array('conditions' => array('order_id' => $id)));
            foreach($orderdetails as $orderdetail){
                $product = $this->Product->find('first', array('conditions' => array('product_id' => $orderdetail['Orderdetail']['product_id'])));
                if($product['Product']['inventory_value'] >= 0){
                    $remain = $product['Product']['inventory_value'] + $orderdetail['Orderdetail']['qty'];
                    if($remain >=0){
                       $product['Product']['inventory_value'] = $remain;
                       $this->Product->saveAll($product['Product']);
                    }
                }
              }
            }
            
            $user = $this->User->find('first', array('conditions' => array('user_id' => $last['Order']['user_id'])));
            if((!empty($user['User']['fcmid'])) && ($params['status']!="Cancelled")){
            $fcmid[] = $user['User']['fcmid'];
            $message = array("notifydata" => array('to' => 'User', 'to_id' => $user['User']['user_id'], 'message' => "Your order status updated to ".$last['Order']['order_status']."!. Order Id - " . ($last['Order']['orderid']), 'notify_from' => 'order', 'id' => $id));
            $this->send_push_notification($fcmid, $message);
            }
            $result = array("code" => 200, "message" => 'Done');
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function update_deliveryboylocation() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $dboy_id = $this->request->header('deliveryboy-id');
        try {
            $deliveryboy = $this->checkappdeliveryboy($dboy_id);
            $deliveryboy['Deliveryboy']['latitude'] = $params['latitude'];
            $deliveryboy['Deliveryboy']['longitude'] = $params['longitude'];
            $this->Deliveryboy->save($deliveryboy['Deliveryboy']);
            $result = array("code" => 200, "message" => 'Done');
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function assgindeliveryboy() {
        $this->autoRender = false;
        $orders = $this->Order->find('all', array('conditions' => array('Order.deliveryboy_status !=' => 'Accepted', 'TIMESTAMPDIFF(MINUTE,Order.deliveryboy_assgintime,NOW()) >=' => '1')));
        foreach ($orders as $order) {
            $vendor = $this->Vendor->find('first', array('conditions' => array('vendor_id' => $order['Order']['vendor_id'])));
            $user = $this->User->find('first', array('conditions' => array('user_id' => $order['Order']['user_id'])));
            $fields = array('*');
            $fields[] = "(3959 * acos(cos(radians('" . $vendor['Vendor']['latitude'] . "')) * cos(radians(latitude)) * cos( radians(longitude) - radians('" . $vendor['Vendor']['longitude'] . "')) + sin(radians('" . $vendor['Vendor']['latitude'] . "')) * sin(radians(latitude)))) AS `distance`";
            $deliveryboy = $this->Deliveryboy->find('first', array('fields' => $fields, 'conditions' => array('Deliveryboy.status' => 'Active', 'Deliveryboy.onlinestatus' => 'Online'), 'order' => 'distance ASC'));
            $order['Order']['deliveryboy_id'] = $deliveryboy['Deliveryboy']['deliveryboy_id'];
            $order['Order']['deliveryboy_status'] = 'Pending';
            $this->Order->save($order['Order']);
        }
        echo 'success';
        exit;
    }

    public function deliveryboy_updateprofile() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $dboy_id = $this->request->header('deliveryboy-id');
        try {
            $deliveryboy = $this->checkappdeliveryboy($dboy_id);
            $checkemail = $this->Deliveryboy->find('first', array('conditions' => array('deliveryboy_id !=' => $dboy_id, 'email'=>$params['email'],'status'=>"Active")));
            if(empty($checkemail)) {
            $checkmobile = $this->Deliveryboy->find('first', array('conditions' => array('deliveryboy_id !=' => $dboy_id, 'mobile'=>$params['mobile'],'status'=>"Active")));
            if(empty($checkmobile)){
            $this->request->data['Deliveryboy']['profile'] = (!empty($params['profile'])) ? $this->base64_toimage($params['profile'], 'files/deliveryboys/') : $deliveryboy['Deliveryboy']['profile'];
            $this->request->data['Deliveryboy']['name'] = !empty($params['name']) ? $params['name'] : $deliveryboy['Deliveryboy']['name'];
            $this->request->data['Deliveryboy']['email'] = !empty($params['email']) ? $params['email'] : $deliveryboy['Deliveryboy']['email'];
            $this->request->data['Deliveryboy']['mobile'] = !empty($params['mobile']) ? $params['mobile'] : $deliveryboy['Deliveryboy']['mobile'];
            $this->request->data['Deliveryboy']['address'] = !empty($params['address']) ? $params['address'] : $deliveryboy['Deliveryboy']['address'];
            $this->request->data['Deliveryboy']['deliveryboy_id'] = $deliveryboy['Deliveryboy']['deliveryboy_id'];
            $this->Deliveryboy->save($this->request->data['Deliveryboy']);
             $result = array("message" => "Updated Successfully!", "code" => 200);
            }else{
             $result = array("message" => "Mobile number already exist", "code" => 0);  
            }
            }else{
             $result = array("message" => "Email id already exist", "code" => 0);    
            }
            
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function notifications() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $notifications = $this->Notification->find('all', array('conditions' => array('OR'=>array('FIND_IN_SET(\'' . $user_id . '\',Notification.customers)','FIND_IN_SET(\'0\',Notification.customers)'), 'DATE(expiry_date) >= ' => "'" . date('Y-m-d') . "'"),'order'=>'id DESC'));
        
            $data = array();
            foreach ($notifications as $notification) {
                $data[] = array(
                    'id' => $notification['Notification']['id'],
                    'notification' => $notification['Notification']['text'],
                    'expiry_date' => $notification['Notification']['expiry_date'],
                    'created_date' => !empty($notification['Notification']['created_date']) ? $notification['Notification']['created_date'] : "",
                );
            }
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function offers() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $offers = $this->Offer->find('all', array('conditions' => array('OR'=>array('FIND_IN_SET(\'' . $user_id . '\',Offer.customers)','FIND_IN_SET(\'0\',Offer.customers)'), 'DATE(expiry_date) >= ' => "'" . date('Y-m-d') . "'"),'order'=>'id DESC'));
            $data = array();
            foreach ($offers as $offer) {
                $data[] = array(
                    'id' => $offer['Offer']['id'],
                    'offer' => $offer['Offer']['text'],
                    'expiry_date' => $offer['Offer']['expiry_date'],
                    'created_date' => !empty($offer['Offer']['created_date']) ? date('d-m-y',strtotime($offer['Offer']['created_date'])) : "",
                );
            }
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function addtowishlist($id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $product = $this->Product->find('first', array('conditions' => array('product_id' => $id)));
            if (!empty($product)) {
                $check = $this->Wishlist->find('first', array('conditions' => array('product_id' => $id, 'user_id' => $user['User']['user_id'])));
                if (empty($check)) {
                    $this->request->data['Wishlist']['product_id'] = $id;
                    $this->request->data['Wishlist']['user_id'] = $user['User']['user_id'];
                    $this->Wishlist->save($this->request->data['Wishlist']);
                    $result = array("message" => "success", "code" => 200);
                } else {
                    $result = array("message" => "Already in wishlist", "code" => 0);
                }
            } else {
                $result = array("message" => "Product not found", "code" => 0);
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }
    
    public function wishlist_checkput() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            //$wishlists = $this->Wishlist->find('all',array('conditions'=>array('user_id'=>$user_id)));
            $wishlists = $params['products'];
            foreach($wishlists as $wishlist){
            $product = $this->Product->find('first', array('conditions' => array('product_id' => $wishlist['product_id'])));
            $check = $this->Cart->find('first', array('conditions' => array('product_id' => $wishlist['product_id'], 'user_id' => $user['User']['user_id'])));
            if (!empty($check)) {
                    $this->request->data['Cart']['cart_id'] = $check['Cart']['cart_id'];
                    $this->request->data['Cart']['qty'] = $wishlist['qty'];
                    $this->Cart->saveAll($this->request->data['Cart']);
            } else {
                $this->request->data['Cart']['user_id'] = $user['User']['user_id'];
                $this->request->data['Cart']['product_id'] = $wishlist['product_id'];
                $this->request->data['Cart']['qty'] = $wishlist['qty'];
                $this->Cart->saveAll($this->request->data['Cart']);
            }
            }
            $cart_count = $this->Cart->find('count', array('conditions' => array('user_id' => $user['User']['user_id'],'buy_now'=>0)));
            $result = array("message" => "success", "code" => 200,"cart_count"=>$cart_count);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function wishlists() {
        $this->autoRender = false;
        $this->response->type('json');
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $products = $this->Wishlist->find('all', array('joins' => array(
                    array(
                        'table' => 'tbl_products',
                        'alias' => 'Product',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Product.product_id = Wishlist.product_id'
                        )
                    )
                ), 'fields' => array('Wishlist.*', 'Product.*'), 'conditions' => array('user_id' => $user_id)));
            $data = array();
            $i=0;
            foreach ($products as $product) {
                $checkcart = $this->Cart->find('first', array('conditions' => array('user_id' => $user['User']['user_id'],'product_id'=>$product['Product']['product_id'])));
                $data[] = array(
                    'id' => $product['Wishlist']['id'],
                    'product_id' => $product['Product']['product_id'],
                    'product_name' => $product['Product']['name'],
                    'mrp' => $product['Product']['mrp'],
                    'our_price' => $product['Product']['our_price'],
                    'stock_value'=>$product['Product']['inventory_value'],
                    'discount' => $product['Product']['discount'],
                    'discount_price' => $product['Product']['discount_price'],
                    'weight' => $product['Product']['weight'],
                    'image' => BASE_URL . 'files/products/' . $product['Product']['image'],
                    'description' => $product['Product']['description'],
                    'cart_id' => (!empty($checkcart)) ? $checkcart['Cart']['cart_id'] : "0"
                );
                $i++;
            }
            $result = array("data" => $data, "code" => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function removewishlist($id) {
        $this->autoRender = false;
        $this->response->type('json');
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $this->Wishlist->deleteAll(array("Wishlist.id" => $id), false);
            $result = array("message" => "Removed from wishlist", "code" => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function forgotpassword() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        try {
            $checkemail = $this->User->find('first', array('conditions' => array('mobile' => $params['mobile'])));
            if (!empty($checkemail)) {
                $otp = $this->str_rand(6, 'numeric');
                // $emailcontent = $this->Emailcontent->find('first', array('conditions' => array('emailcontent_id' => '2')));
                // $message = str_replace(array('{name}', '{password}', '{email}'), array($checkemail['User']['name'], $password, $checkemail['User']['email']), $emailcontent['Emailcontent']['emailcontent']);
                // $this->mailsend($emailcontent['Emailcontent']['fromname'], $emailcontent['Emailcontent']['fromemail'], $checkemail['User']['email'], $emailcontent['Emailcontent']['subject'], $message);
                $this->request->data['User']['otp'] = $otp;
                $this->request->data['User']['user_id'] = $checkemail['User']['user_id'];
                $this->User->save($this->request->data['User']);
                $sendsms = $this->sendSMS($params['mobile'], 'Please use this OTP for change your password ' . $otp);
                $result = array("message" => "OTP sent your mobile number!", "otp" => $otp, "code" => 200, "user_id" => $checkemail['User']['user_id']);
            } else {
                $result = array("message" => "Account not found!", "code" => 0);
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function forgot_resetpassword() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $token = $this->request->header('user-id');
        try {
            $checkmobile = $this->User->find('first', array('conditions' => array('mobile' => $params['mobile'], 'status' => 'Active', 'user_id' => $token)));
            if (!empty($checkmobile)) {
                $this->request->data['User']['password'] = md5($params['password']);
                $this->request->data['User']['user_id'] = $checkmobile['User']['user_id'];
                $this->User->save($this->request->data['User']);
                $result = array("message" => "Success!, your password has been updated!", "user_id" => $checkmobile['User']['user_id'], "code" => 200);
            } else {
                $result = array("code" => 0, "message" => 'Mobile No Mismatched');
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function changepassword() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $checkpass = $this->User->find('first', array('conditions' => array('password' => md5($params['oldpassword']), 'user_id' => $user['User']['user_id'])));
            if (!empty($checkpass)) {
                $this->request->data['User']['password'] = md5($params['password']);
                $this->request->data['User']['user_id'] = $user['User']['user_id'];
                $this->User->save($this->request->data['User']);
                $result = array("message" => "Updated", "code" => 200);
            } else {
                $result = array("message" => "Old Password is incorrect.", "code" => 0);
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function faqs() {
        $this->autoRender = false;
        $this->response->type('json');
        try {
            $faqs = $this->Faq->find('all');
            $result = array("faqs" => $faqs, "code" => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function removecart($cart_id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($user_id);
            $this->Cart->deleteAll(array("Cart.cart_id" => $cart_id), false);
            $cart_count = $this->Cart->find('count', array('conditions' => array('user_id' => $user['User']['user_id'],'buy_now'=>0)));
            $result = array("code" => 200, "message" => 'Success','cart_count'=>$cart_count);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function deliveryboy_changepassword() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $dboy_id = $this->request->header('deliveryboy-id');
        try {
            $deliveryboy = $this->checkappdeliveryboy($dboy_id);
            $checkpass = $this->Deliveryboy->find('first', array('conditions' => array('password' => md5($params['oldpassword']), 'deliveryboy_id' => $deliveryboy['Deliveryboy']['deliveryboy_id'])));
            if (!empty($checkpass)) {
                $this->request->data['Deliveryboy']['password'] = md5($params['password']);
                $this->request->data['Deliveryboy']['deliveryboy_id'] = $deliveryboy['Deliveryboy']['deliveryboy_id'];
                $this->Deliveryboy->save($this->request->data['Deliveryboy']);
                $result = array("message" => "Updated", "code" => 200);
            } else {
                $result = array("message" => "Old Password is incorrect.", "code" => 0);
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }
    
    public function deliveryboy_notifications() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $dboy_id = $this->request->header('deliveryboy-id');
        try {
            $deliveryboy = $this->checkappdeliveryboy($dboy_id);
            // $notifications = $this->Notification->find('all', array('conditions' => array('OR'=>array('FIND_IN_SET(\'' . $dboy_id . '\',Notification.deliveryboys)','FIND_IN_SET(\'0\',Notification.deliveryboys)'), 'DATE(expiry_date) >= ' => "'" . date('Y-m-d') . "'"),'order'=>'id DESC'));
            // $data = array();
            // $orders = array();
            // foreach ($notifications as $notification) {
            //     $data[] = array(
            //         'id' => $notification['Notification']['id'],
            //         'notification' => $notification['Notification']['text'],
            //         'expiry_date' => $notification['Notification']['expiry_date'],
            //         'created_date' =>!empty($notification['Notification']['created_date']) ? date('d-m-y',strtotime($notification['Notification']['created_date'])) : "",
            //     );
            // }
           // $orders_notifications = $this->Ordernotification->find('all', array('conditions' => array('to'=>'Dboy','to_id'=>$dboy_id),'order'=>'notify_id DESC'));
            $orders_notifications = $this->Ordernotification->find('all', array('conditions' => array('to_id'=>$dboy_id,'to'=>"Dboy"),'order'=>'notify_id DESC'));

           // print_r($orders_notifications); die;
            foreach($orders_notifications as $orders_notification){
                $orders[]=array(
                    'id' => $orders_notification['Ordernotification']['notify_id'],
                    'notify_from' => $orders_notification['Ordernotification']['notify_from'],
                    'order_id' => $orders_notification['Ordernotification']['id'],
                    'notification' => $orders_notification['Ordernotification']['msg'],
                    'created_date' => date('d-m-y',strtotime($orders_notification['Ordernotification']['created_date'])),
                );
            }
            $result = array("code" => 200, "data" => $orders);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }
    
    public function deliveryboy_token() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $token = $this->request->header('deliveryboy-id');
        try {
            $user = $this->checkappdeliveryboy($token);
            if(!empty($params['token'])){
                $user['Deliveryboy']['fcmid'] = $params['token'];
                $this->Deliveryboy->save($user['Deliveryboy']);
                $result = array("code" => 200, "message" => 'Done');
            }else{
                $result = array("code" => 0, "message" => 'Invalid param');
            }
            
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }
    
    public function user_token() {
        $this->autoRender = false;
        $this->response->type('json');
        $params = json_decode($this->request->input(), true);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkappuser($token);
            if(!empty($params['token'])){
                $user['User']['fcmid'] = $params['token'];
                $this->User->save($user['User']);
                $result = array("code" => 200, "message" => 'Done');
            }else{
                $result = array("code" => 0, "message" => 'Invalid param');
            }
            
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }
    
    public function get_orderdetails($orderid = null) {
        //$this->autoRender = false;
        $order = $this->Order->find('first', array('conditions' => array('order_id' => $orderid)));
        $setting = $this->Sitesetting->find('first');
        $orderdetails = $this->Orderdetail->find('all', array('joins' => array(
                    array(
                        'table' => 'tbl_products',
                        'alias' => 'Product',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Product.product_id = Orderdetail.product_id'
                        )
                    ),
                ), 'fields' => array('Orderdetail.*', 'Product.*'), 'conditions' => array('Orderdetail.order_id' => $order['Order']['order_id'])));
        $book_detail = '<h5>Order Details</h5>';
        $book_detail .= ' <table class="mailtable" style="border-collapse: collapse;" border="1">';
        $book_detail .= ' <thead>';
        $book_detail .= ' <tr>';
        $book_detail .= ' <th align="left" style="padding:8px;">S.No</th>';
        $book_detail .= ' <th align="left" style="padding:8px;">Product Name</th>';
        $book_detail .= ' <th align="left" style="padding:8px;">Image</th>';
        $book_detail .= ' <th align="left" style="padding:8px;">Weight</th>';
        $book_detail .= ' <th align="left" style="padding:8px;">Order Qty</th>';
       // $book_detail .= ' <th align="left" style="padding:8px;">Price</th>';
       // $book_detail .= ' <th align="right" style="padding:8px;">Total</th>';
        $book_detail .= ' </tr>';
        $book_detail .= ' </thead>';
        $book_detail .= ' <tbody>';
        $i = 1;
        foreach ($orderdetails as $orderdetail) {
            $title = $orderdetail['Product']['name'];
            $image = BASE_URL . 'files/products/' . $orderdetail['Product']['image'];
            $wi8 = $orderdetail['Product']['weight'];
            $qty = $orderdetail['Orderdetail']['qty'];
            $price = $orderdetail['Orderdetail']['price'];
            $total_amnt = $orderdetail['Orderdetail']['total_amount'];
            $book_detail .= ' <tr>';
            $book_detail .= ' <td style="padding:8px;">' . $i . '</td>';
            $book_detail .= ' <td  style="padding:8px;">' . $title . '</td>';
            $book_detail .= ' <td style="padding:8px;"><img src="' . $image . '" style="width: 50px;height: 50px"/></td>';
            $book_detail .= ' <td style="padding:8px;">' . $wi8 . '</td>';
            $book_detail .= ' <td style="padding:8px;">' . $qty . '</td>';
          //  $book_detail .= ' <td style="padding:8px;">Rs. ' . $price . '</td>';
           // $book_detail .= ' <td style="padding:8px;text-align:right;">Rs ' . round($total_amnt) . '</td>';
            $book_detail .= ' </tr>';
            $i++;
        }
        $book_detail .= ' <tr>';
        $book_detail .= ' <td  colspan="6" style="padding:8px;">Billed Amount</td>';
        $book_detail .= ' <td style="padding:8px;"> Rs. ' . round($order['Order']['grand_total']) . '</td>';
        $book_detail .= ' </tr>';
        
        $book_detail .= ' <tr>';
        $book_detail .= ' <td  colspan="6" style="padding:8px;">Delivery Charge</td>';
        $book_detail .= ' <td style="padding:8px;"> Rs. ' . round($order['Order']['delivery_charge']) . '</td>';
        $book_detail .= ' </tr>';
        $book_detail .= ' <tr>';
        $book_detail .= ' <td  colspan="6" style="padding:8px;">Sample Rice charge</td>';
        $book_detail .= ' <td style="padding:8px;"> Rs. ' . $setting['Sitesetting']['sample_rice_charge'] . '</td>';
        $book_detail .= ' </tr>';
        $book_detail .= ' <tr>';
        $discount = !empty($order['Order']['discount_code']) ? $order['Order']['discount_amount'] : "";
        if (!empty($discount)) {
            $book_detail .= ' <tr>';
            $book_detail .= ' <td  colspan="6" style="padding:8px;">Coupon Amount ( Code : '.$order['Order']['discount_code'].')</td>';
            $book_detail .= ' <td  style="padding:8px;"> Rs. ' . $discount . '</td>';
            $book_detail .= ' </tr>';
        }
        $book_detail .= ' <td  colspan="6" style="padding:8px;">Net Payable Amount</td>';
        $book_detail .= ' <td style="padding:8px;"> Rs. ' . round($order['Order']['total_amount']) . '</td>';
        $book_detail .= ' </tr>';
        $book_detail .= ' </tr>';
        $book_detail .= ' </tbody>';
        $book_detail .= ' </table>';
        $book_detail .= '<br></br>';
        return $book_detail;
    }

}
