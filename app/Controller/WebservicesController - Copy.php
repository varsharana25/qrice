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
    public $uses = array('Applog', 'User', 'Vendor', 'Product', 'Category', 'Contact', 'Productimage', 'Staticpage', 'Sitesetting', 'Product', 'Brand', 'Productreview', 'Notification', 'Order', 'Orderdetail', 'Cart', 'Emailcontent', 'Sitesettings', 'Shoppingslider', 'Dealslider', 'Deliveryaddress', 'Couponcode', 'Shippingaddress', 'Productvariation', 'Productcategory', 'Applog', 'Cartsubscription', 'Subscription', 'Slider');

    public function vendor_register() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        try {
            $checkmobile = $this->Vendor->find('first', array('conditions' => array('mobile' => $params['mobile'])));
            if (empty($checkmobile)) {
                $checkemail = $this->Vendor->find('first', array('conditions' => array('email' => $params['email'])));
                if (empty($checkemail)) {
                    $tokens = $this->str_rand(8, 'alphanum');
                    if (!empty($params['shop_logo'])) {
                        $shop_logo = $params['shop_logo'];
                        unset($params['shop_logo']);
                    }
                    $this->request->data['Vendor'] = $params;
                    $this->request->data['Vendor']['created_date'] = date('Y-m-d H:i:s');
                    $this->request->data['Vendor']['status'] = 'Pending';
                    $this->Vendor->save($this->request->data['Vendor']);
                    $vendor_id = $this->Vendor->getLastInsertID();
                    $vendor_path = $this->vendor_path($vendor_id);
                    if (!empty($shop_logo)) {
                        $this->request->data['Vendor']['shop_logo'] = $this->base64_toimage($shop_logo, $vendor_path);
                    }
                    $this->request->data['Vendor']['vendor_path'] = $vendor_path;
                    $this->request->data['Vendor']['vendor_id'] = $vendor_id;
                    $this->Vendor->save($this->request->data['Vendor']);
                    $result = array("message" => "Registered Successfully! please wait for admin approval!", "code" => 200);
                } else {
                    $result = array("message" => "Email Id already exist!", "code" => 0);
                }
            } else {
                $result = array("message" => "Mobile Number already exist!", "code" => 0);
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function businesscategories() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        try {
            $conditions = array('status' => 'Active');
            $categories = ClassRegistry::init('Category')->find('all', array('conditions' => $conditions, 'order' => 'catorder ASC'));
            foreach ($categories as $category) {
                $data[] = array(
                    'category_id' => $category['Category']['category_id'],
                    'name' => $category['Category']['name'],
                    'image' => BASE_URL . 'files/categoryimages/' . $category['Category']['image'],
                    'status' => $category['Category']['status']
                );
            }
            $result = array('code' => '200', 'data' => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function vendor_login() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $checkmobile = $this->Vendor->find('first', array('conditions' => array('mobile' => $params['mobile'])));
            if (!empty($checkmobile)) {
                if ($checkmobile['Vendor']['status'] == "Active") {
                    //$otp = $this->str_rand('4', 'numeric');
                    $otp = '1234';
                    $checkmobile['Vendor']['otp'] = $otp;
                    $this->Vendor->save($checkmobile['Vendor']);
                    $sendsms = $this->sendSMS($params['mobile'], 'Your OTP is ' . $otp);
                    $result = array("message" => "otp sent successfully!", "otp" => $otp, "code" => 200);
                } else {
                    $result = array("message" => "Please wait for admin approval!", "code" => 0);
                }
            } else {
                $result = array("message" => "Invalid Mobile No", "code" => 0);
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function vendor_verifyotp() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $checkmobile = $this->Vendor->find('first', array('conditions' => array('mobile' => $params['mobile'])));
            if (!empty($checkmobile)) {
                if ($checkmobile['Vendor']['otp'] == $params['otp']) {
                    $checkmobile['Vendor']['otp'] = '';
                    $this->Vendor->save($checkmobile['Vendor']);
                    $result = array("message" => "Logged In successfully!", "code" => 200, "vendor_id" => $checkmobile['Vendor']['vendor_id']);
                } else {
                    $result = array("message" => "Invalid OTP", "code" => 0);
                }
            } else {
                $result = array("message" => "Invalid Mobile No", "code" => 0);
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function vendor_addproduct() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        $vendor_id = $this->request->header('vendor-id');
        extract($_REQUEST);
        try {
            $vendor = $this->checktoken($vendor_id);
            $this->request->data['Product'] = $params;
            $this->request->data['Product']['vendor_id'] = $vendor['Vendor']['vendor_id'];
            $this->request->data['Product']['datetime'] = date('Y-m-d H:i:s');
            $this->request->data['Product']['image'] = (!empty($params['image'])) ? $this->base64_toimage($params['image'], $vendor['Vendor']['vendor_path']) : '';
            $this->Product->save($this->request->data['Product']);
            $product_id = $this->Product->getLastInsertID();
            if (!empty($params['variations'])) {
                foreach ($params['variations'] as $variation) {
                    $productvariation['Productvariation'] = array();
                    $productvariation['Productvariation'] = $variation;
                    $productvariation['Productvariation']['product_id'] = $product_id;
                    $productvariation['Productvariation']['price'] = ($variation['salesprice'] != '' && $variation['salesprice'] >= 0) ? $variation['salesprice'] : $variation['mrp'];
                    $this->Productvariation->saveAll($productvariation['Productvariation']);
                }
            }
            $result = array("message" => "Created Successfully!", "code" => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function vendor_editproduct($product_id) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        $vendor_id = $this->request->header('vendor-id');
        extract($_REQUEST);
        try {
            $vendor = $this->checktoken($vendor_id);
            $this->Applog->save(array('params' => json_encode($params), 'datetime' => date('Y-m-d H:i:s'), 'funcation_name' => 'Vendor Add Product'));
            $product = $this->Product->find('first', array('conditions' => array('product_id' => $product_id)));
            $this->request->data['Product'] = $params;
            $this->request->data['Product']['product_id'] = $product_id;
            $this->request->data['Product']['vendor_id'] = $vendor['Vendor']['vendor_id'];
            $this->request->data['Product']['datetime'] = date('Y-m-d H:i:s');
            $this->request->data['Product']['image'] = (!empty($params['image'])) ? $this->base64_toimage($params['image'], $vendor['Vendor']['vendor_path']) : $product['Product']['image'];
            $this->Product->save($this->request->data['Product']);
            if (!empty($params['variations'])) {
                foreach ($params['variations'] as $variation) {
                    $productvariation['Productvariation'] = array();
                    $productvariation['Productvariation'] = $variation;
                    $productvariation['Productvariation']['product_id'] = $product_id;
                    $productvariation['Productvariation']['price'] = ($variation['salesprice'] != '' && $variation['salesprice'] >= 0) ? $variation['salesprice'] : $variation['mrp'];
                    $productvariation['Productvariation']['variation_id'] = (!empty($variation['variation_id'])) ? $variation['variation_id'] : NULL;
                    $this->Productvariation->saveAll($productvariation['Productvariation']);
                    $ids[] = (!empty($variation['variation_id'])) ? $variation['variation_id'] : $this->Productvariation->getLastInsertID();
                }

                $this->Productvariation->deleteAll(array("Productvariation.product_id" => $product_id, "NOT" => array("Productvariation.variation_id" => $ids)), false);
            } else {
                $this->Productvariation->deleteAll(array("Productvariation.product_id" => $product_id), false);
            }
            $result = array("message" => "Updated", "code" => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function vendor_deleteproduct($id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        $vendor_id = $this->request->header('vendor-id');
        extract($_REQUEST);
        try {
            $vendor = $this->checktoken($vendor_id);
            $checkproduct = $this->Product->find('first', array('conditions' => array('product_id' => $id, 'vendor_id' => $vendor['Vendor']['vendor_id'])));
            if (!empty($checkproduct)) {
                $this->Product->updateAll(
                        array('Product.status' => "'Trash'"), array('Product.product_id' => $id)
                );
                $result = array("message" => "Product Deleted Successfully!", "code" => 200);
            } else {
                $result = array("message" => "Invalid Product!", "code" => 0);
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function productcategories() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        try {
            $conditions = array('status' => 'Active');
            if (!empty($_REQUEST['parent_id'])) {
                $conditions['parent_id'] = $_REQUEST['parent_id'];
            } else {
                $conditions['parent_id'] = 0;
            }
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

    public function vendor_categories($vendor_id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        try {
            $vendor = $this->checktoken($vendor_id);
            $categories = $this->Product->find('list', array('fields' => array('Product.category_id'), 'conditions' => array('status' => 'Active', 'vendor_id' => $vendor['Vendor']['vendor_id']), 'group' => array('category_id')));
            $categories = $this->Productcategory->find('all', array('conditions' => array('procategory_id' => $categories)));
            foreach ($categories as $category) {
                $cats[] = array(
                    'procategory_id' => $category['Productcategory']['procategory_id'],
                    'name' => $category['Productcategory']['name'],
                );
            }
            $result = array('categories' => $cats, "code" => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function vendor_products() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $vendor_id = $this->request->header('vendor-id');
        try {
            $vendor = $this->checktoken($vendor_id);
            if (isset($page_id) && $page_id && isset($limit)) {
                $offset = ($page_id - 1) * $limit;
            } else {
                $offset = 0;
                $limit = 10;
            }
            $conditions = array('status' => 'Active', 'vendor_id' => $vendor_id);
            if (!empty($_REQUEST['category_id'])) {
                $conditions['category_id'] = $_REQUEST['category_id'];
            }
            if (!empty($_REQUEST['s'])) {
                $s = $_REQUEST['s'];
                $conditions['name LIKE'] = "%$s%";
            }
            $products = $this->Product->find('all', array('conditions' => $conditions, 'limit' => $limit, 'offset' => $offset, 'order' => 'Product.subcategory_id ASC'));
            $data = array();
            foreach ($products as $product) {
                $variations = $this->Productvariation->find('all', array('conditions' => array('product_id' => $product['Product']['product_id'])));
                $subcategory = $this->Productcategory->find('first', array('conditions' => array('procategory_id' => $product['Product']['subcategory_id'])));
                $variation_data = array();
                foreach ($variations as $variation) {
                    $variation_data[] = array(
                        'variation_id' => $variation['Productvariation']['variation_id'],
                        'variation' => $variation['Productvariation']['variation'],
                        'mrp' => $variation['Productvariation']['mrp'],
                        'salesprice' => $variation['Productvariation']['salesprice'],
                        'price' => $variation['Productvariation']['price'],
                        'availability' => $variation['Productvariation']['availability']
                    );
                }
                $data[] = array(
                    'product_id' => $product['Product']['product_id'],
                    'name' => $product['Product']['name'],
                    'image' => BASE_URL . $vendor['Vendor']['vendor_path'] . $product['Product']['image'],
                    'description' => $product['Product']['description'],
                    'variation_type' => $product['Product']['variation_type'],
                    'variations' => $variation_data,
                    'subcategory' => $subcategory['Productcategory']['name']
                );
            }
            $result = array("data" => $data, "code" => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }
    
     

    /* ----------------------NEW WEBSERVICE--------------------- */

    /* user */

    public function user_fb_login() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        $this->request->data['Applog']['funcation_name'] = "user_fb_login";
        $this->request->data['Applog']['params'] = $this->request->input();
        $this->Applog->save($this->request->data['Applog']);
        extract($_REQUEST);
        try {
            $check = $this->User->find('first', array('conditions' => array('facebook_id' => $params['facebook_id'], 'status !=' => 'Trash')));
            if (empty($check)) {
                $checkemail = $this->User->find('first', array('conditions' => array('email' => $params['email'])));
                if (!empty($checkemail)) {
                    $checkemail['User']['facebook_id'] = (!empty($params['facebook_id'])) ? $params['facebook_id'] : "";
                    $checkemail['User']['mobile'] = (!empty($params['mobile'])) ? $params['mobile'] : "";
                    $this->User->save($checkemail['User']);
                    $result = array("message" => "Registered Successfully!", "code" => 200, 'user_id' => $checkemail['User']['user_id'], 'access_token' => $checkemail['User']['access_token']);
                    return json_encode($result);
                    exit;
                } else {
                    $this->request->data['User']['email'] = (!empty($params['email'])) ? $params['email'] : "";
                    $this->request->data['User']['facebook_id'] = (!empty($params['facebook_id'])) ? $params['facebook_id'] : "";
                    $this->request->data['User']['full_name'] = (!empty($params['full_name'])) ? $params['full_name'] : "";
                    $token = $this->str_rand(15, 'alphanum');
                    $this->request->data['User']['access_token'] = $token;
                    $this->request->data['User']['create_date'] = date('Y-m-d H:i:s');
                    $this->request->data['User']['profile'] = (!empty($params['profile'])) ? $this->base64_toimage($params['profile'], 'files/users/') : "";
                    $this->User->save($this->request->data['User']);
                    $user_id = $this->User->getLastInsertID();
                    $result = array("message" => "Registered Successfully!", "code" => 200, 'user_id' => $user_id, 'access_token' => $token);
                    return json_encode($result);
                    exit;
                }
            } else {
                $result = array("message" => "Login Successfully!", "code" => 200, 'user_id' => $check['User']['user_id'], 'access_token' => $check['User']['access_token']);
                return json_encode($result);
                exit;
            }
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function user_google_login() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        try {
            $checkemail = $this->User->find('first', array('conditions' => array('email' => $params['email'])));
            if (empty($checkemail)) {
                $this->request->data['User']['email'] = $params['email'];
                $this->request->data['User']['full_name'] = $params['full_name'];
                $token = $this->str_rand(15, 'alphanum');
                $this->request->data['User']['access_token'] = $token;
                $this->request->data['User']['create_date'] = date('Y-m-d H:i:s');
                $this->request->data['User']['profile'] = (!empty($params['profile'])) ? $this->base64_toimage($params['profile'], 'files/users/') : "";
                $this->User->save($this->request->data['User']);
                $user_id = $this->User->getLastInsertID();
                $result = array("message" => "Registered Successfully!", "code" => 200, 'user_id' => $user_id, 'access_token' => $token);
            } else {
                $token = $checkemail['User']['access_token'];
                $user_id = $checkemail['User']['user_id'];
                $result = array("message" => "Login Successfully!", "code" => 200, 'user_id' => $user_id, 'access_token' => $token);
            }
            return json_encode($result);
            exit;
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function home() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($token);
            $sitesetting = $this->Sitesetting->find('first');

            $homescreen_categories = explode(',', $sitesetting['Sitesetting']['homescreen_shop_categories']);

            $data = array();
            $i = 0;
            if (!empty($homescreen_categories)) {
                foreach ($homescreen_categories as $homescreen_categories) {
                    $category = $this->Category->find('first', array('conditions' => array('category_id' => $homescreen_categories)));
                    $data[$i]['category_id'] = $category['Category']['category_id'];
                    $data[$i]['category_title'] = $category['Category']['name'];
                    $data[$i]['category_thumb'] = BASE_URL . 'files/categories/' . $category['Category']['image'];
                    $i++;
                }
            }
            $sliderdata = array();
            $shopsliders = $this->Slider->find('all');
            foreach ($shopsliders as $homescreen) {
                $sliderdata[] = array(
                    'thumb' => BASE_URL . 'files/sliders/' . $homescreen['Slider']['image'],
                    'id' => $homescreen['Slider']['slider_id'],
                );
            }

            $result = array("sliders" => $sliderdata, "categories" => $data, "code" => 200);
            return json_encode($result);
            exit;
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    /* ===Vendors=== */

   

    public function vendor_dashboard() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $vendor = $this->checktoken($token);
            $data['New'] = $this->Order->find('count', array('conditions' => array('vendor_id' => $vendor['Vendor']['vendor_id'], 'order_status' => 'Ordered')));
            $data['Processing'] = $this->Order->find('count', array('conditions' => array('vendor_id' => $vendor['Vendor']['vendor_id'], 'order_status' => 'Processing')));
            $data['Delivered'] = $this->Order->find('count', array('conditions' => array('vendor_id' => $vendor['Vendor']['vendor_id'], 'order_status' => 'Delivered')));
            $data['Cancelled'] = $this->Order->find('count', array('conditions' => array('vendor_id' => $vendor['Vendor']['vendor_id'], 'order_status' => 'Cancelled')));
            $data['product'] = $this->Product->find('count', array('conditions' => array('vendor_id' => $vendor['Vendor']['vendor_id'], 'status' => 'Active')));
            $order = ClassRegistry::init('Order')->find('all', array('fields' => array('SUM(total_amount) as total_amount'), 'conditions' => array('vendor_id' => $vendor['Vendor']['vendor_id'])));
            $data['netsale'] = !empty($order[0][0]['total_amount']) ? (double) $order[0][0]['total_amount'] : 0;

            return json_encode(array('data' => $data, 'code' => 200));
            exit;
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function units() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $units = $this->Unit->find('all', array('conditions' => array('status' => 'Active')));
            foreach ($units as $unit) {
                $data[] = array(
                    'unit_id' => $unit['Unit']['unit_id'],
                    'unit_name' => $unit['Unit']['unit_name'],
                    'unit_short_name' => $unit['Unit']['unit_short_name'],
                );
            }

            return json_encode(array('data' => $data, 'code' => 200));
            exit;
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function search_product($id = NULL, $search = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        $token = $this->request->header('user-id');
        extract($_REQUEST);
        try {
            $data['products'] = array();
            $vendor = $this->checktoken($token);
            if (!empty($_GET['search'])) {
                $products = $this->Product->find('all', array('conditions' => array('status' => 'Active', 'vendor_id' => $vendor['Vendor']['vendor_id'], 'stock_status' => 'Available', 'category_id' => $_GET['id'], 'name LIKE' => '%' . $_GET['search'] . '%'), 'order' => 'product_id desc'));
            }
            foreach ($products as $product) {
                $data['products'][] = array(
                    'product_id' => $product['Product']['product_id'],
                    'name' => $product['Product']['name'],
                );
            }
            $result = array("data" => $data, "code" => 200);
            return json_encode($result);
            exit;
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function vendor_myproducts($id = NULL, $search = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        $token = $this->request->header('user-id');
        extract($_REQUEST);
        try {
            $vendor = $this->checktoken($token);
            $data = $this->getVendor($vendor['Vendor']['vendor_id']);
            $data['products'] = array();
            if (!empty($_GET['search'])) {
                $products = $this->Product->find('all', array('conditions' => array('status' => 'Active', 'vendor_id' => $vendor['Vendor']['vendor_id'], 'stock_status' => 'Available', 'subcategory_id' => $_GET['id'], 'name LIKE' => '%' . $_GET['search'] . '%'), 'order' => 'product_id desc'));
            } else {
                $products = $this->Product->find('all', array('conditions' => array('status' => 'Active', 'vendor_id' => $vendor['Vendor']['vendor_id'], 'stock_status' => 'Available', 'subcategory_id' => $_GET['id']), 'order' => 'product_id desc'));
            }
            $vendor_path = $this->vendor_path($vendor['Vendor']['vendor_id']);
            foreach ($products as $product) {
                $unit = $this->Unit->find('first', array('conditions' => array('unit_id' => $product['Product']['unit_id'])));
                $short_name = !empty($unit['Unit']['unit_short_name']) ? $unit['Unit']['unit_short_name'] : "";
                $productimages = $this->Productimage->find('first', array('conditions' => array('product_id' => $product['Product']['product_id'])));
                $data['products'][] = array(
                    'product_id' => $product['Product']['product_id'],
                    'name' => $product['Product']['name'],
                    'price' => $product['Product']['sales_price'],
                    'unit' => $short_name,
                    'discription' => $product['Product']['description'],
                    'weight' => $product['Product']['weight'],
                    'image' => !empty($productimages['Productimage']['image']) ? BASE_URL . $vendor_path . $productimages['Productimage']['image'] : "",
                );
            }
            $result = array("data" => $data, "code" => 200);
            return json_encode($result);
            exit;
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

//    public function vendor_editProduct($id = NULL) {
//        $this->autoRender = false;
//        $this->response->type('json');
//        $this->response->header('Access-Control-Allow-Origin', '*');
//        $this->response->header('Access-Control-Allow-Headers', 'user-id');
//        $params = json_decode($this->request->input(), true);
//        $token = $this->request->header('user-id');
//        extract($_REQUEST);
//        try {
//            $vendor = $this->checktoken($token);
//            if (!empty($vendor)) {
//                $vendor_path = $this->vendor_path($vendor['Vendor']['vendor_id']);
//                $this->request->data['Product'] = $params;
//                $this->request->data['Product']['product_id'] = $id;
//                $this->request->data['Product']['vendor_id'] = $vendor['Vendor']['vendor_id'];
//                $this->request->data['Product']['orig_price'] = (!empty($params['sales_price'])) ? $params['sales_price'] : $params['regular_price'];
//                $this->request->data['Product']['created_date'] = date('Y-m-d H:i:s');
//                $this->Product->save($this->request->data['Product']);
//                if (!empty($params['old_images'])) {
//                    $this->Productimage->deleteAll(array("Productimage.product_id" => $id, "NOT" => array("Productimage.image" => $params['old_images'])), false);
//                } else {
//                    $this->Productimage->deleteAll(array("Productimage.product_id" => $id), false);
//                }
//                if (!empty($params['images'])) {
//                    foreach ($params['images'] as $image) {
//                        $this->request->data['Productimage']['product_id'] = $id;
//                        $this->request->data['Productimage']['image'] = $this->base64_toimage($image, $vendor_path);
//                        $this->Productimage->saveAll($this->request->data['Productimage']);
//                    }
//                }
//                $result = array("message" => "Updated Successfully!", "code" => 200);
//            } else {
//                $result = array("message" => "Invalid Vendor", "code" => 0);
//            }
//            return json_encode($result);
//            exit;
//        } catch (Exception $e) {
//            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
//            exit;
//        }
//    }

    public function vendor_mycategories() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $vendor = $this->checktoken($token);
            $cat = explode(',', $vendor['Vendor']['product_category']);
            foreach ($cat as $cate) {
                $categories = $this->Category->find('all', array('conditions' => array('parent' => $cate)));
                foreach ($categories as $category) {
                    $data[] = array(
                        'subcategory_id' => $category['Category']['category_id'],
                        'subcategory_name' => $category['Category']['name'],
                    );
                }
            }
            return json_encode(array('data' => $data, 'code' => 200));
            exit;
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function getcategories() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        $token = $this->request->header('user-id');
        extract($_REQUEST);
        try {
            $vendors = $this->checktoken($token);
            $sitesetting = $this->Sitesetting->find('first');
            $homescreen_categories = explode(',', $sitesetting['Sitesetting']['homescreen_shop_categories']);
            $data = array();
            foreach ($homescreen_categories as $category) {
                $categories = $this->Category->find('first', array('conditions' => array('category_id' => $category)));
                $data[] = array(
                    'category_id' => $categories['Category']['category_id'],
                    'category' => $categories['Category']['name'],
                    'image' => BASE_URL . 'files/categoryimages/' . $categories['Category']['image'],
                );
            }


            $result = array("data" => $data, "code" => 200);
            return json_encode($result);
            exit;
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function getsubcategories($parent = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'access-token');
        $params = json_decode($this->request->input(), true);
        $token = $this->request->header('access_token');
        extract($_REQUEST);
        try {
            $categories = $this->Category->find('all', array('conditions' => array('status' => 'Active', 'parent' => $parent)));
            $data = array();
            foreach ($categories as $category) {
                $data[] = array(
                    'category_id' => $category['Category']['category_id'],
                    'category' => $category['Category']['name']
                );
            }
            $result = array("data" => $data, "code" => 200);
            return json_encode($result);
            exit;
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

//==============================    Mohana =====================================//







    public function vendor_fcmid() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $vendor_id = $this->request->header('vendor-id');
        try {
            $vendor = $this->Vendor->find('first', array('conditions' => array('vendor_id' => $params['vendor_id'])));
            if (!empty($vendor)) {
                $vendor['Vendor']['fcmid'] = $params['fcmid'];
                $this->Vendor->save($vendor['Vendor']);
                $result = array("message" => "Updated", "code" => 200);
            } else {
                $result = array("message" => "Vendor not found", "code" => 0);
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function vendor_getProduct($id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $vendor_id = $this->request->header('vendor-id');
        try {
            $vendor = $this->checktoken($vendor_id);
            $product = $this->Product->find('first', array('conditions' => array('product_id' => $id)));
            $variations = $this->Productvariation->find('all', array('conditions' => array('product_id' => $product['Product']['product_id'])));
            foreach ($variations as $variation) {
                $variation_data[] = array(
                    'variation_id' => $variation['Productvariation']['variation_id'],
                    'variation' => $variation['Productvariation']['variation'],
                    'mrp' => $variation['Productvariation']['mrp'],
                    'salesprice' => $variation['Productvariation']['salesprice'],
                    'price' => $variation['Productvariation']['price'],
                    'availability' => $variation['Productvariation']['availability']
                );
            }
            $data = array(
                'product_id' => $product['Product']['product_id'],
                'name' => $product['Product']['name'],
                'discription' => $product['Product']['description'],
                'category_id' => $product['Product']['category_id'],
                'subcategory_id' => $product['Product']['subcategory_id'],
                'subscription' => $product['Product']['subscription'],
                'variation_type' => $product['Product']['variation_type'],
                'image' => !empty($product['Product']['image']) ? BASE_URL . $vendor['Vendor']['vendor_path'] . $product['Product']['image'] : "",
                'variations' => $variation_data
            );
            $result = array("result" => $data, "code" => 200);
            return json_encode($result);
            exit;
        } catch (Exception $e) {
            return json_encode(array("code" => 0, "message" => 'Error:' . $e->getMessage()));
            exit;
        }
    }

    public function user_login() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        try {
            $checkuser = $this->User->find('first', array('conditions' => array('mobile' => $params['mobile'], 'status' => 'Active')));
            if (!empty($checkuser)) {
                $otp = $this->str_rand('4', 'numeric');
                $checkuser['User']['otp'] = $otp;
                $this->User->save($checkuser['User']);
                $sendsms = $this->sendSMS($params['mobile'], 'Welcome to Dunzo. Your OTP is ' . $otp);
                $result = array("message" => "OTP sent Successfully!", 'user_id' => $checkuser['User']['user_id'], "otp" => $otp, "code" => 200, 'newuser' => '1');
            } else {
                $otp = $this->str_rand('4', 'numeric');
                $this->request->data['User']['mobile'] = $params['mobile'];
                $this->request->data['User']['otp'] = $otp;
                $this->request->data['User']['created_date'] = date('Y-m-d H:i:s');
                $this->User->save($this->request->data['User']);
                $user_id = $this->User->getLastInsertID();
                $sendsms = $this->sendSMS($params['mobile'], 'Welcome to Dunzo. Your OTP is ' . $otp);
                $result = array("message" => "OTP sent Successfully!", 'user_id' => $user_id, "otp" => $otp, "code" => 200, 'newuser' => '1');
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function user_verifyotp() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $checkuser = $this->User->find('first', array('conditions' => array('mobile' => $params['mobile'], 'status' => 'Active')));
            if (!empty($checkuser)) {
                if ($checkuser['User']['otp'] == $params['otp']) {
                    $result = array("message" => "OTP Verified Successfully!", 'user_id' => $checkuser['User']['user_id'], "code" => 200,);
                } else {
                    $result = array("message" => "Invalid OTP", "code" => 0);
                }
            } else {
                $result = array("message" => "Invalid Mobile No", "code" => 0);
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function storelists() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($user_id);
            $category = $this->Category->find('first', array('conditions' => array('category_id' => $_REQUEST['category_id'])));
            $fields = array('*');
            $distance = (!empty($_REQUEST['withinkm'])) ? round($_REQUEST['withinkm']) : '3';
            $conditions = array('status' => 'Active');
            if ($category['Category']['name'] != 'Daily Needs') {
                $conditions['business_category'] = $category['Category']['category_id'];
            } else {
                $conditions['dailyneeds'] = '1';
            }
            $group = array();
            if (!empty($user['User']['latitude']) && $user['User']['longitude']) {
                $fields[] = "(3959 * acos(cos(radians('" . $user['User']['latitude'] . "')) * cos(radians(latitude)) * cos( radians(longitude) - radians('" . $user['User']['longitude'] . "')) + sin(radians('" . $user['User']['latitude'] . "')) * sin(radians(latitude)))) AS `distance`";
                $group['Having distance <='] = $distance;
            }
            if (!empty($_REQUEST['s'])) {
                $s = $_REQUEST['s'];
                $conditions['shop_name LIKE'] = "%$s%";
            }
            if (isset($page_id) && $page_id && isset($limit)) {
                $offset = ($page_id - 1) * $limit;
            } else {
                $offset = 0;
                $limit = 10;
            }
            $order = 'vendor_id ASC';
            $data = array();
            $vendors = $this->Vendor->find('all', array('fields' => $fields, 'conditions' => $conditions, 'order' => $order, 'limit' => $limit, 'offset' => $offset, 'group' => $group));
            foreach ($vendors as $vendor) {
                $data[] = array(
                    'vendor_id' => $vendor['Vendor']['vendor_id'],
                    'thumb' => BASE_URL . $vendor['Vendor']['vendor_path'] . $vendor['Vendor']['shop_logo'],
                    'shop_name' => $vendor['Vendor']['shop_name'],
                    'location' => $vendor['Vendor']['location'],
                    'mobile' => $vendor['Vendor']['mobile'],
                    'distance' => $this->distance($user['User']['latitude'], $user['User']['longitude'], $vendor['Vendor']['latitude'], $vendor['Vendor']['longitude'], 'K') . 'KM',
                    'coupon' => ''
                );
            }
            $result = array("stores" => $data, "code" => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function storedetail($vendor_id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($user_id);
            $vendor = $this->Vendor->find('first', array('conditions' => array('vendor_id' => $vendor_id)));
            $data = array(
                'vendor_id' => $vendor['Vendor']['vendor_id'],
                'thumb' => BASE_URL . $vendor['Vendor']['vendor_path'] . $vendor['Vendor']['shop_logo'],
                'shop_name' => $vendor['Vendor']['shop_name'],
                'location' => $vendor['Vendor']['location'],
                'mobile' => $vendor['Vendor']['mobile'],
                'distance' => $this->distance($user['User']['latitude'], $user['User']['longitude'], $vendor['Vendor']['latitude'], $vendor['Vendor']['longitude'], 'K') . 'KM',
                'coupon' => ''
            );
            $conditions = array('status' => 'Active', 'vendor_id' => $vendor['Vendor']['vendor_id']);
            if (!empty($_REQUEST['subscription']) && $_REQUEST['subscription'] == '1') {
                $conditions['subscription'] = '1';
            }
            $categories = $this->Product->find('list', array('fields' => array('Product.category_id'), 'conditions' => $conditions, 'group' => array('category_id')));
            $categories = $this->Productcategory->find('all', array('conditions' => array('procategory_id' => $categories)));
            foreach ($categories as $category) {
                $cats[] = array(
                    'procategory_id' => $category['Productcategory']['procategory_id'],
                    'name' => $category['Productcategory']['name'],
                );
            }
            $cart = $this->Cart->find('count', array('conditions' => array('user_id' => $user['User']['user_id'])));
            $cart_total = $this->Cart->find('all', array('joins' => array(
                    array(
                        'table' => 'tbl_productvariations',
                        'alias' => 'Productvariation',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Productvariation.variation_id = Cart.variation_id'
                        )
                    )
                ), 'fields' => array('SUM(Cart.qty * Productvariation.price) as total'), 'conditions' => array('user_id' => $user['User']['user_id'])));
            $result = array("data" => $data, 'categories' => $cats, 'cartproducts' => (!empty($cart)) ? $cart : "0", 'carttotal' => (!empty($cart_total)) ? $cart_total[0][0]['total'] : "0", "code" => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function storeproducts($vendor_id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($user_id);
            $vendor = $this->Vendor->find('first', array('conditions' => array('vendor_id' => $vendor_id)));
            if (isset($page_id) && $page_id && isset($limit)) {
                $offset = ($page_id - 1) * $limit;
            } else {
                $offset = 0;
                $limit = 10;
            }
            $conditions = array('status' => 'Active', 'vendor_id' => $vendor_id);
            if (!empty($_REQUEST['category_id'])) {
                $conditions['category_id'] = $_REQUEST['category_id'];
            }
            if (!empty($_REQUEST['s'])) {
                $s = $_REQUEST['s'];
                $conditions['name LIKE'] = "%$s%";
            }
            $products = $this->Product->find('all', array('conditions' => $conditions, 'limit' => $limit, 'offset' => $offset, 'order' => 'Product.subcategory_id ASC'));
            $data = array();
            foreach ($products as $product) {
                $variations = $this->Productvariation->find('all', array('conditions' => array('product_id' => $product['Product']['product_id'])));
                $subcategory = $this->Productcategory->find('first', array('conditions' => array('procategory_id' => $product['Product']['subcategory_id'])));
                $variation_data = array();
                $total_qty = 0;
                $addedtocart = false;
                foreach ($variations as $variation) {
                    $checkcart = $this->Cart->find('first', array('conditions' => array('user_id' => $user['User']['user_id'], 'product_id' > $params['product_id'], 'variation_id' => $params['varation_id'])));
                    if (!empty($checkcart)) {
                        $cartdetails = array(
                            'cart_id' => $checkcart['Cart']['cart_id'],
                            'qty' => $checkcart['Cart']['qty'],
                        );
                        $total_qty+=$checkcart['Cart']['qty'];
                        $addedtocart = true;
                    } else {
                        $cartdetails = array();
                    }
                    $variation_data[] = array(
                        'variation_id' => $variation['Productvariation']['variation_id'],
                        'variation' => $variation['Productvariation']['variation'],
                        'mrp' => $variation['Productvariation']['mrp'],
                        'salesprice' => $variation['Productvariation']['salesprice'],
                        'price' => $variation['Productvariation']['price'],
                        'availability' => $variation['Productvariation']['availability'],
                        'addedtocart' => (!empty($checkcart)) ? "1" : "0",
                        'cart_detail' => $cartdetails
                    );
                }
                $data[] = array(
                    'product_id' => $product['Product']['product_id'],
                    'name' => $product['Product']['name'],
                    'image' => BASE_URL . $vendor['Vendor']['vendor_path'] . $product['Product']['image'],
                    'description' => $product['Product']['description'],
                    'variation_type' => $product['Product']['variation_type'],
                    'variations' => $variation_data,
                    'subcategory' => $subcategory['Productcategory']['name'],
                    'addedtocart' => $addedtocart,
                    'total_qty' => $total_qty
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
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($user_id);
            $product = $this->Product->find('first', array('conditions' => array('product_id' => $params['product_id'])));
            $checkvendor = $this->Cart->find('first', array('conditions' => array('vendor_id !=' => $product['Product']['vendor_id'], 'user_id' => $user['User']['user_id'])));
            if (empty($checkvendor)) {
                $check = $this->Cart->find('first', array('conditions' => array('product_id' => $params['product_id'], 'variation_id' => $params['variation_id'], 'user_id' => $user['User']['user_id'])));
                if (!empty($check)) {
                    if ($params['qty'] > 0) {
                        $this->request->data['Cart']['vendor_id'] = $product['Product']['vendor_id'];
                        $this->request->data['Cart']['cart_id'] = $check['Cart']['cart_id'];
                        $this->request->data['Cart']['qty'] = $params['qty'];
                        $this->Cart->save($this->request->data['Cart']);
                        $result = array("message" => "success", "code" => 200);
                    } else {
                        $this->Cart->deleteAll(array("Cart.product_id" => $params['product_id'], "Cart.variation_id" => $params['variation_id'], "Cart.user_id" => $user['User']['user_id']), false);
                    }
                } else {
                    $this->request->data['Cart']['vendor_id'] = $product['Product']['vendor_id'];
                    $this->request->data['Cart']['user_id'] = $user['User']['user_id'];
                    $this->request->data['Cart']['product_id'] = $params['product_id'];
                    $this->request->data['Cart']['variation_id'] = $params['variation_id'];
                    $this->request->data['Cart']['qty'] = $params['qty'];
                    $this->Cart->save($this->request->data['Cart']);
                    $result = array("message" => "success", "code" => 200);
                }
            } else {
                $vendor = $this->Vendor->find('first', array('conditions' => array('vendor_id' => $checkvendor['Cart']['vendor_id'])));
                $provendor = $this->Vendor->find('first', array('conditions' => array('vendor_id' => $product['Product']['vendor_id'])));
                $result = array("message" => "Your cart contains items from " . $vendor['Vendor']['shop_name'] . " do you want to clear cart and add items from " . $provendor['Vendor']['shop_name'] . "?", "code" => 0);
            }
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function clearcart() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($user_id);
            $this->Cart->deleteAll(array("Cart.user_id" => $user['User']['user_id']), false);
            $result = array("code" => 200, "message" => 'success');
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function checkout() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($user_id);
            $cartitems = $this->Cart->find('all', array('joins' => array(
                    array(
                        'table' => 'tbl_productvariations',
                        'alias' => 'Productvariation',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Productvariation.variation_id = Cart.variation_id'
                        )
                    ), array(
                        'table' => 'tbl_products',
                        'alias' => 'Product',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Product.product_id = Cart.product_id'
                        )
                    )
                ), 'fields' => array('Cart.*', 'Product.*', 'Productvariation.*'), 'conditions' => array('user_id' => $user['User']['user_id'])));
            $itemtotal = 0;
            $products = array();
            foreach ($cartitems as $cartitem) {
                $vendor = $this->Vendor->find('first', array('conditions' => array('vendor_id' => $cartitem['Product']['vendor_id'])));
                $products[] = array(
                    'product_id' => $cartitem['Product']['product_id'],
                    'variation_id' => $cartitem['Cart']['variation_id'],
                    'name' => $cartitem['Product']['name'],
                    'description' => $product['Product']['description'],
                    'image' => BASE_URL . $vendor['Vendor']['vendor_path'] . $product['Product']['image'],
                    'variation' => $cartitem['Productvariation']['variation'],
                    'qty' => $cartitem['Cart']['qty'],
                    'price' => $cartitem['Productvariation']['price'],
                    'total' => $cartitem['Productvariation']['price'] * $cartitem['Cart']['qty'],
                );
                $itemtotal+=($cartitem['Productvariation']['price'] * $cartitem['Cart']['qty']);
            }
            $deliveryfee = $this->deliveryfee($user_id, $vendor['Vendor']['vendor_id']);
            $discount = '0';
            $to_pay = $itemtotal + $deliveryfee - $discount;
            $result = array("code" => 200, 'products' => $products, "itemtotal" => $itemtotal, "deliveryfee" => $deliveryfee, "offer_discount" => $discount, 'to_pay' => $to_pay);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function alladdress() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($user_id);
            $alladdress = $this->Deliveryaddress->find('all', array('conditions' => array('user_id' => $user['User']['user_id'])));
            $data = array();
            foreach ($alladdress as $address) {
                $data[] = $address['Deliveryaddress'];
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
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($user_id);
            $this->request->data['Deliveryaddress'] = $params;
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

    public function updateaddress($id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($user_id);
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
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($user_id);
            $address = $this->Deliveryaddress->find('first', array('conditions' => array('address_id' => $id)));
            $result = array("code" => 200, "data" => $address['Deliveryaddress']);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function placeorder() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($user_id);
            $cartitems = $this->Cart->find('all', array('conditions' => array('user_id' => $user['User']['user_id'])));
            $this->request->data['Order'] = $params;
            $this->request->data['Order']['total_products'] = count($cartitems);
            $this->request->data['Order']['user_id'] = $user['User']['user_id'];
            $this->request->data['Order']['datetime'] = date('Y-m-d H:i:s');
            $this->Order->save($this->request->data['Order']);
            $order_id = $this->Order->getLastInsertID();

            foreach ($cartitems as $cartitem) {
                $variation = $this->Productvariation->find('first', array('conditions' => array('variation_id' => $cartitem['Cart']['variation_id'])));
                $this->request->data['Orderdetail'] = array();
                $this->request->data['Orderdetail']['order_id'] = $order_id;
                $this->request->data['Orderdetail']['vendor_id'] = $this->request->data['Order']['vendor_id'];
                $this->request->data['Orderdetail']['product_id'] = $cartitem['Cart']['product_id'];
                $this->request->data['Orderdetail']['variation_id'] = $cartitem['Cart']['variation_id'];
                $this->request->data['Orderdetail']['variation'] = $variation['Productvariation']['variation'];
                $this->request->data['Orderdetail']['price'] = $variation['Productvariation']['price'];
                $this->request->data['Orderdetail']['qty'] = $cartitem['Cart']['qty'];
                $this->request->data['Orderdetail']['total_amount'] = $variation['Productvariation']['price'] * $cartitem['Cart']['qty'];
                $this->Orderdetail->saveAll($this->request->data['Orderdetail']);
            }
            $this->Cart->deleteAll(array("Cart.user_id" => $user['User']['user_id']), false);
            $result = array("code" => 200, "order_id" => $order_id);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function user_orders() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $orders = $this->Order->find('all', array('joins' => array(
                    array(
                        'table' => 'tbl_vendors',
                        'alias' => 'Vendor',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Vendor.vendor_id = Order.vendor_id'
                        )
                    ),
                    array(
                        'table' => 'tbl_categories',
                        'alias' => 'Category',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Category.category_id = Vendor.business_category'
                        )
                    ),
                    array(
                        'table' => 'tbl_deliveryaddresses',
                        'alias' => 'Deliveryaddress',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Deliveryaddress.address_id = Order.address_id'
                        )
                    )
                ), 'fields' => array('Category.*', 'Vendor.*', 'Order.*', 'Deliveryaddress.*'), 'conditions' => array('Order.user_id' => $user_id)));
            $data = array();
            $items = array();
            foreach ($orders as $order) {
                $orderitems = $this->Orderdetail->find('all', array('conditions' => array('order_id' => $order['Order']['order_id'])));
                foreach ($orderitems as $orderitem) {
                    $product = $this->Product->find('first', array('conditions' => array('product_id' => $orderitem['Orderdetail']['product_id'])));
                    $items[] = array(
                        'name' => $product['Product']['name'],
                        'qty' => $orderitem['Orderdetail']['qty']
                    );
                }
                $data[] = array(
                    'order_id' => $order['Order']['order_id'],
                    'category' => $order['Category']['name'],
                    'address' => $order['Deliveryaddress'],
                    'total' => $order['Order']['total_amount'],
                    'items' => $items,
                    'order_status' => $order['Order']['order_status']
                );
            }
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function orderdetail($id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $order = $this->Order->find('first', array('joins' => array(
                    array(
                        'table' => 'tbl_vendors',
                        'alias' => 'Vendor',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Vendor.vendor_id = Order.vendor_id'
                        )
                    ),
                    array(
                        'table' => 'tbl_categories',
                        'alias' => 'Category',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Category.category_id = Vendor.business_category'
                        )
                    ),
                    array(
                        'table' => 'tbl_deliveryaddresses',
                        'alias' => 'Deliveryaddress',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Deliveryaddress.address_id = Order.address_id'
                        )
                    )
                ), 'fields' => array('Category.*', 'Vendor.*', 'Order.*', 'Deliveryaddress.*'), 'conditions' => array('Order.user_id' => $user_id)));
            $orderitems = $this->Orderdetail->find('all', array('conditions' => array('order_id' => $order['Order']['order_id'])));
            foreach ($orderitems as $orderitem) {
                $product = $this->Product->find('first', array('conditions' => array('product_id' => $orderitem['Orderdetail']['product_id'])));
                $items[] = array(
                    'name' => $product['Product']['name'],
                    'qty' => $orderitem['Orderdetail']['qty'],
                    'total_amount' => $orderitem['Orderdetail']['total_amount']
                );
            }
            $data = array(
                'category' => $order['Category']['name'],
                'address' => $order['Deliveryaddress'],
                'total' => $order['Order']['total_amount'],
                'delivery_charge' => $order['Order']['delivery_charge'],
                'discount_amount' => $order['Order']['discount_amount'],
                'grand_total' => $order['Order']['grand_total'],
                'items' => $items,
                'order_status' => $order['Order']['order_status']
            );
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
                return ($miles * 1.609344);
            } else if ($unit == "N") {
                return ($miles * 0.8684);
            } else {
                return $miles;
            }
        }
    }

    public function deliveryfee($user_id = NULL, $vendor_id = NULL) {
        $user = $this->User->find('first', array('conditions' => array('user_id' => $user_id)));
        $vendor = $this->Vendor->find('first', array('joins' => array(
                array(
                    'table' => 'tbl_categories',
                    'alias' => 'Category',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Category.category_id = Vendor.business_category'
                    )
                )
            ), 'fields' => array('Category.*', 'Vendor.*'), 'conditions' => array('vendor_id' => $vendor_id)));
        $distance = $this->distance($user['User']['latitude'], $user['User']['longitude'], $vendor['Vendor']['latitude'], $vendor['Vendor']['longitude'], 'K');
        $amount = $distance * $vendor['Category']['delivery_charge'];
        return $amount;
    }

    public function user_getProfile() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($token);
            $data = array(
                'user_id' => $user['User']['user_id'],
                'name' => $user['User']['name'],
                'email' => !empty($user['User']['email']) ? $user['User']['email'] : "",
                'mobile' => !empty($user['User']['mobile']) ? $user['User']['mobile'] : "",
                'notification_count' => !empty($user['User']['notification_count']) ? $user['User']['notification_count'] : 0,
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
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($token);
            $checkuser = $this->User->find('first', array('conditions' => array('OR' => array('email' => $params['email'], 'mobile' => $params['mobile']), "user_id !=" => $user['User']['user_id'])));
            if (empty($checkuser)) {
                $user['User']['profile'] = (!empty($params['profile'])) ? $this->base64_toimage($params['profile'], 'files/users/') : $user['User']['profile'];
                $user['User']['email'] = !empty($params['email']) ? $params['email'] : $user['User']['email'];
                $user['User']['name'] = !empty($params['name']) ? $params['name'] : $user['User']['name'];
                $user['User']['mobile'] = !empty($params['mobile']) ? $params['mobile'] : $user['User']['mobile'];
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
        $this->response->header('Access-Control-Allow-Origin', '*');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $page = $this->Staticpage->find('first', array('conditions' => array('page_id' => '2')));
            $data = array();
            $data['page_title'] = $page['Staticpage']['page_title'];
            $data['short_content'] = $page['Staticpage']['short_content'];
            $data['image'] = BASE_URL . 'files/statics/' . $page['Staticpage']['image'];
            $data['page_content'] = $page['Staticpage']['page_content'];
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
        $this->response->header('Access-Control-Allow-Origin', '*');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $page = $this->Staticpage->find('first', array('conditions' => array('page_id' => '4')));
            $data = array();
            $data['page_title'] = $page['Staticpage']['page_title'];
            $data['short_content'] = $page['Staticpage']['short_content'];
            $data['image'] = BASE_URL . 'files/statics/' . $page['Staticpage']['image'];
            $data['page_content'] = $page['Staticpage']['page_content'];
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
        $this->response->header('Access-Control-Allow-Origin', '*');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $page = $this->Staticpage->find('first', array('conditions' => array('page_id' => '1')));
            $data = array();
            $data['page_title'] = $page['Staticpage']['page_title'];
            $data['short_content'] = $page['Staticpage']['short_content'];
            $data['image'] = BASE_URL . 'files/statics/' . $page['Staticpage']['image'];
            $data['page_content'] = $page['Staticpage']['page_content'];
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
        $this->response->header('Access-Control-Allow-Origin', '*');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $page = $this->Sitesetting->find('first', array('conditions' => array('id' => '1')));
            $data = array();
            $data['company_name'] = $page['Sitesetting']['site_title'];
            $data['phone'] = $page['Sitesetting']['phone'];
            $data['email'] = $page['Sitesetting']['email'];
            $data['website'] = $page['Sitesetting']['websiteurl'];
            $data['mapurl'] = $page['Sitesetting']['mapurl'];
            $result = array('data' => $data, 'code' => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function update_userlocation() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($token);
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

    public function dailyneedproducts($vendor_id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($user_id);
            $vendor = $this->Vendor->find('first', array('conditions' => array('vendor_id' => $vendor_id)));
            if (isset($page_id) && $page_id && isset($limit)) {
                $offset = ($page_id - 1) * $limit;
            } else {
                $offset = 0;
                $limit = 10;
            }
            $conditions = array('Product.status' => 'Active', 'Product.vendor_id' => $vendor_id, 'Product.subscription' => '1');
            if (!empty($_REQUEST['category_id'])) {
                $conditions['Product.category_id'] = $_REQUEST['category_id'];
            }
            if (!empty($_REQUEST['s'])) {
                $s = $_REQUEST['s'];
                $conditions['Product.name LIKE'] = "%$s%";
            }
            $products = $this->Productvariation->find('all', array('joins' => array(
                    array(
                        'table' => 'tbl_products',
                        'alias' => 'Product',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Product.product_id = Productvariation.product_id'
                        )
                    )
                ), 'fields' => array('Product.*', 'Productvariation.*'), 'conditions' => $conditions, 'limit' => $limit, 'offset' => $offset, 'order' => 'Product.product_id ASC'));
            $data = array();
            foreach ($products as $product) {
                $subcategory = $this->Productcategory->find('first', array('conditions' => array('procategory_id' => $product['Product']['subcategory_id'])));
                $checksubscription = $this->Cartsubscription->find('first', array('conditions' => array('product_id' => $product['Product']['product_id'], 'variation_id' => $product['Productvariation']['variation_id'], 'user_id' => $user['User']['user_id'])));
                $data[] = array(
                    'product_id' => $product['Product']['product_id'],
                    'name' => $product['Product']['name'],
                    'image' => BASE_URL . $vendor['Vendor']['vendor_path'] . $product['Product']['image'],
                    'description' => $product['Product']['description'],
                    'variation_type' => $product['Product']['variation_type'],
                    'variation_id' => $product['Productvariation']['variation_id'],
                    'mrp' => $product['Productvariation']['mrp'],
                    'salesprice' => $product['Productvariation']['salesprice'],
                    'price' => $product['Productvariation']['price'],
                    'availability' => $product['Productvariation']['availability'],
                    'subcategory' => $subcategory['Productcategory']['name'],
                    'subscribed' => (!empty($checksubscription)) ? '1' : "0"
                );
            }
            $result = array("data" => $data, "code" => 200);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function getSubscriptiondetail($product_id = NULL, $variation_id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $this->response->header('Access-Control-Allow-Headers', 'user-id');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $user_id = $this->request->header('user-id');
        try {
            $subscription = $this->Cartsubscription->find('first', array('joins' => array(
                    array(
                        'table' => 'tbl_products',
                        'alias' => 'Product',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Product.product_id = Cartsubscription.product_id'
                        )
                    ), array(
                        'table' => 'tbl_productvariations',
                        'alias' => 'Productvariation',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Productvariation.variation_id = Cartsubscription.variation_id'
                        )
                    )
                ), 'fields' => array('Cartsubscription.*', 'Productvariation.*', 'Product.*'), 'conditions' => array('Cartsubscription.product_id' => $product_id, 'Cartsubscription.variation_id' => $variation_id, 'Cartsubscription.user_id' => $user['User']['user_id'])));
            $data = array(
                'vendor_id' => $subscription['Cartsubscription']['vendor_id'],
                'product_id' => $subscription['Cartsubscription']['product_id'],
                'variation_id' => $subscription['Cartsubscription']['variation_id'],
                'qty' => $subscription['Cartsubscription']['qty'],
                'repeat' => $subscription['Cartsubscription']['repeat'],
                'days' => explode(',', $subscription['Cartsubscription']['days']),
                'total_deliveries' => $subscription['Cartsubscription']['total_deliveries'],
                'total_amount' => $subscription['Cartsubscription']['total_amount'],
            );
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function productsubscription() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($token);
            $check = $this->Cartsubscription->find('first', array('conditions' => array('user_id' => $user['User']['user_id'], 'variation_id' => $params['variation_id'], 'product_id' => $params['product_id'])));
            $productvariation = $this->Productvariation->find('first', array('conditions' => array('variation_id' => $params['variation_id'])));
            if (empty($check)) {
                $this->request->data['Cartsubscription']['product_id'] = $params['product_id'];
                $this->request->data['Cartsubscription']['variation_id'] = $params['variation_id'];
                $this->request->data['Cartsubscription']['qty'] = $params['qty'];
                $this->request->data['Cartsubscription']['repeat'] = $params['repeat'];
                $this->request->data['Cartsubscription']['days'] = implode(',', $params['days']);
                $this->request->data['Cartsubscription']['total_deliveries'] = $params['total_deliveries'];
                $this->request->data['Cartsubscription']['start_date'] = date('Y-m-d');
                $this->request->data['Cartsubscription']['user_id'] = $user['User']['user_id'];
                $this->request->data['Cartsubscription']['vendor_id'] = $params['vendor_id'];
                $this->request->data['Cartsubscription']['total_amount'] = $params['qty'] * $productvariation['Productvariation']['price'] * $params['total_deliveries'];
                $this->Cartsubscription->save($this->request->data['Cartsubscription']);
            } else {
                $this->request->data['Cartsubscription']['id'] = $check['Cartsubscription']['id'];
                $this->request->data['Cartsubscription']['product_id'] = $params['product_id'];
                $this->request->data['Cartsubscription']['variation_id'] = $params['variation_id'];
                $this->request->data['Cartsubscription']['qty'] = $params['qty'];
                $this->request->data['Cartsubscription']['repeat'] = $params['repeat'];
                $this->request->data['Cartsubscription']['days'] = implode(',', $params['days']);
                $this->request->data['Cartsubscription']['total_deliveries'] = $params['total_deliveries'];
                $this->request->data['Cartsubscription']['start_date'] = date('Y-m-d');
                $this->request->data['Cartsubscription']['user_id'] = $user['User']['user_id'];
                $this->request->data['Cartsubscription']['vendor_id'] = $params['vendor_id'];
                $this->request->data['Cartsubscription']['total_amount'] = $params['qty'] * $productvariation['Productvariation']['price'] * $params['total_deliveries'];
                $this->Cartsubscription->save($this->request->data['Cartsubscription']);
            }
            $result = array("code" => 200, "message" => 'Done');
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function subscriptioncart() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($token);
            $subscriptions = $this->Cartsubscription->find('all', array('joins' => array(
                    array(
                        'table' => 'tbl_products',
                        'alias' => 'Product',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Product.product_id = Cartsubscription.product_id'
                        )
                    ), array(
                        'table' => 'tbl_productvariations',
                        'alias' => 'Productvariation',
                        'type' => 'INNER',
                        'conditions' => array(
                            'Productvariation.variation_id = Cartsubscription.variation_id'
                        )
                    )
                ), 'fields' => array('Cartsubscription.*', 'Productvariation.*', 'Product.*'), 'conditions' => array('user_id' => $user['User']['user_id'])));
            $data = array();
            foreach ($subscriptions as $subscription) {
                $vendor = $this->Vendor->find('first', array('conditions' => array('vendor_id' => $subscription['Cartsubscription']['vendor_id'])));
                $data[] = array(
                    'id' => $subscription['Cartsubscription']['id'],
                    'product_name' => $subscription['Product']['name'],
                    'product_image' => BASE_URL . $vendor['Vendor']['vendor_path'] . $subscription['Product']['image'],
                    'variation_id' => $subscription['Productvariation']['variation_id'],
                    'variation' => $subscription['Productvariation']['variation'],
                    'price' => $subscription['Productvariation']['price'],
                    'qty' => $subscription['Cartsubscription']['qty'],
                    'repeat' => $subscription['Cartsubscription']['repeat'],
                    'days' => explode(',', $subscription['Cartsubscription']['days']),
                    'total_deliveries' => $subscription['Cartsubscription']['total_deliveries'],
                    'total_amount' => $subscription['Cartsubscription']['total_amount']
                );
            }
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function removesubscription($id = NULL) {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($token);
            $this->Cartsubscription->deleteAll(array("Cartsubscription.id" => $id), false);
            $result = array("code" => 200, "message" => 'Done');
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function confirmsubscription() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($token);
            $carts = $this->Cartsubscription->find('all', array('conditions' => array('user_id' => $user['User']['user_id'])));
            foreach ($carts as $cart) {
                $this->request->data['Subscription'] = array();
                $this->request->data['Subscription']['user_id'] = $user['User']['user_id'];
                $this->request->data['Subscription']['vendor_id'] = $cart['Cartsubscription']['vendor_id'];
                $this->request->data['Subscription']['product_id'] = $cart['Cartsubscription']['product_id'];
                $this->request->data['Subscription']['variation_id'] = $cart['Cartsubscription']['variation_id'];
                $this->request->data['Subscription']['qty'] = $cart['Cartsubscription']['qty'];
                $this->request->data['Subscription']['repeat'] = $cart['Cartsubscription']['repeat'];
                $this->request->data['Subscription']['days'] = $cart['Cartsubscription']['days'];
                $this->request->data['Subscription']['total_deliveries'] = $cart['Cartsubscription']['total_deliveries'];
                $this->request->data['Subscription']['total_amount'] = $cart['Cartsubscription']['total_amount'];
                $this->request->data['Subscription']['start_date'] = date('Y-m-d', strtotime($cart['Cartsubscription']['start_date']));
                $this->request->data['Subscription']['datetime'] = date('Y-m-d H:i:s');
                $this->request->data['Subscription']['payment_id'] = $params['payment_id'];
                $this->Subscription->saveAll($this->request->data['Subscription']);
            }
            $result = array("code" => 200, "message" => 'Done');
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function user_subscriptions() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($token);
            $subscriptions = $this->Subscription->find('all', array('conditions' => array('user_id' => $user['User']['user_id'])));
            foreach ($subscriptions as $subscription) {
                $product = $this->Product->find('first', array('conditions' => array('product_id' => $subscription['Subscription']['product_id'])));
                $productvariation = $this->Productvariation->find('first', array('conditions' => array('variation_id' => $subscription['Subscription']['variation_id'])));
                $data[] = array(
                    'subscription_id' => $subscription['Subscription']['subscription_id'],
                    'product_id' => $product['Product']['product_id'],
                    'product_name' => $product['Product']['name'],
                    'product_image' => BASE_URL . $vendor['Vendor']['vendor_path'] . $product['Product']['image'],
                    'variation_id' => $subscription['Subscription']['variation_id'],
                    'variation' => $productvariation['Productvariation']['variation'],
                    'price' => $productvariation['Productvariation']['price'],
                    'qty' => $subscription['Subscription']['qty'],
                    'total_deliveries' => $subscription['Subscription']['total_deliveries'],
                    'start_date' => date('Y-m-d', strtotime($subscription['Subscription']['start_date'])),
                    'total_amount' => $subscription['Subscription']['total_amount'],
                    'repeat' => $subscription['Subscription']['repeat'],
                    'days' => $subscription['Subscription']['days'],
                );
            }
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

    public function user_calendarsubscriptions() {
        $this->autoRender = false;
        $this->response->type('json');
        $this->response->header('Access-Control-Allow-Origin', '*');
        $params = json_decode($this->request->input(), true);
        extract($_REQUEST);
        $token = $this->request->header('user-id');
        try {
            $user = $this->checkusertoken($token);
            while (strtotime($start_date) <= strtotime($end_date)) {
                $subscriptions = $this->Subscription->find('all', array('conditions' => array('user_id' => $user['User']['user_id'])));
                foreach ($subscriptions as $subscription) {
                    $product = $this->Product->find('first', array('conditions' => array('product_id' => $subscription['Subscription']['product_id'])));
                    $productvariation = $this->Productvariation->find('first', array('conditions' => array('variation_id' => $subscription['Subscription']['variation_id'])));
                    $data[] = array(
                        'subscription_id' => $subscription['Subscription']['subscription_id'],
                        'product_id' => $product['Product']['product_id'],
                        'product_name' => $product['Product']['name'],
                        'product_image' => BASE_URL . $vendor['Vendor']['vendor_path'] . $product['Product']['image'],
                        'variation_id' => $subscription['Subscription']['variation_id'],
                        'variation' => $productvariation['Productvariation']['variation'],
                        'price' => $productvariation['Productvariation']['price'],
                        'qty' => $subscription['Subscription']['qty'],
                        'total_deliveries' => $subscription['Subscription']['total_deliveries'],
                        'start_date' => date('Y-m-d', strtotime($subscription['Subscription']['start_date'])),
                        'total_amount' => $subscription['Subscription']['total_amount'],
                        'repeat' => $subscription['Subscription']['repeat'],
                        'days' => $subscription['Subscription']['days'],
                    );
                }
                $start_date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
            }
            $result = array("code" => 200, "data" => $data);
        } catch (Exception $e) {
            $result = array("code" => 0, "message" => 'Error:' . $e->getMessage());
        }
        return json_encode($result);
        exit;
    }

}
