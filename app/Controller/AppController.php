<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::import('Controller', 'Yahoo'); // mention at top
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

class AppController extends Controller {

    public $components = array('Cookie', 'Session');
    public $helpers = array('Session');

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array('Adminuser', 'Emaillist', 'Emailcontent', 'User', 'Sitesetting', 'Deliveryboy','Ordernotification');
    private $yqlUrl = "http://query.yahooapis.com/v1/public/yql";
    private $options = array("env" => "http://datatables.org/alltables.env", "format" => "json"); // need this env to query yahoo finance);
    private $format;

    protected function str_rand($length = 8, $output = 'alphanum') {
        // Possible seeds
        $outputs['alpha'] = 'abcdefghijklmnopqrstuvwqyz';
        $outputs['numeric'] = '0123456789';
        $outputs['alphanum'] = 'abcdefghijklmnopqrstuvwqyz0123456789';
        $outputs['hexadec'] = '0123456789abcdef';
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
        return $str;
    }   
    public function admin_logincheck() {
        if ($this->Session->read('Adminuser'))
            $this->redirect(array('controller' => 'adminusers', 'action' => 'dashboard'));
    }

    public function checkadmin() {
        if (!$this->Session->read('Adminuser')) {
            $this->redirect(array('controller' => 'adminusers', 'action' => 'login'));
        } else {
            $admindetails = $this->Adminuser->find('first', array('conditions' => array('admin_id' => $this->Session->read('Adminuser.admin_id'), 'status' => 'Active')));
            if (!empty($admindetails)) {
                $this->set('sessionadmin', $admindetails);
                return $admindetails;
            } else {
                $this->redirect(array('action' => 'logout'));
            }
        }
    }

    public function admin_logout() {
        $this->Session->delete('Adminuser');
        $this->redirect(array('controller' => 'adminusers', 'action' => 'login'));
    }

    public function vendor_logincheck() {
        if ($this->Session->read('Vendor'))
            $this->redirect(array('controller' => 'vendors', 'action' => 'dashboard'));
    }

    public function checkvendor() {
        if (!$this->Session->read('Vendor')) {
            $this->redirect(array('controller' => 'vendors', 'action' => 'login'));
        } else {
            $vendordetails = $this->Vendor->find('first', array('conditions' => array('Vendor.vendor_id' => $this->Session->read('Vendor.vendor_id'), 'Vendor.status' => 'Approved')));
            if (!empty($vendordetails)) {
                $this->set('sessionvendor', $vendordetails);
                return $vendordetails;
            } else {
                $this->redirect(array('action' => 'vendor_logout'));
            }
        }
    }

    public function logout() {
        $this->Session->delete('Vendor');
        $this->redirect(array('controller' => 'vendors', 'action' => 'login'));
    }

    protected function mailsend($fromname, $from, $to, $subject, $message, $cc = NULL, $attachment = 0, $attachmentsfiles = '', $template = 'default', $layout = 'default') {
        App::uses('CakeEmail', 'Network/Email');
        $email = new CakeEmail();
        if ($_SERVER['HTTP_HOST'] == 'localhost' || $_SERVER['HTTP_HOST'] == '192.168.1.80') {
            $email->config('smtp');
        }
        $email->emailFormat('html');
        $email->from(array(trim($from) => $fromname));
        if ($attachment == 1) {
            $attach = explode(",", $attachmentsfiles);
            $attachments = array();
            foreach ($attach as $attach) {
                $attachments[] = $attach;
            }
            $email->attachments($attachments);
        }
        $email->template($template, $layout);
        $email->to(trim($to));
        if ($cc != '' || $cc != NULL) {
            $cc = str_replace(' ', '', $cc);
            $email->cc(explode(',', $cc));
        }
        $email->subject($subject);
        $mail = $email->send($message);
        $mail = $email->reset();
        return $mail;
    }

    public function beforeFilter() {
        
    }

    public function getFileExtension($str) {
        $i = strrpos($str, ".");
        if (!$i) {
            return "";
        }
        $l = strlen($str) - $i;
        $ext = substr($str, $i + 1, $l);
        return $ext;
    }

    public function initialize() {
        parent::initialize();
        $this->loadComponent('Flash');
        /* Authentication */
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'fields' => [
                        'username' => 'email',
                        'password' => 'password'
                    ]
                ]
            ],
            'loginRedirect' => [
                'controller' => 'users',
                'action' => 'profile'
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login'
            ]
        ]);
    }

    public function checkappvendor($vendor_id) {
        $check = $this->Vendor->find('first', array('joins' => array(
                array(
                    'table' => 'tbl_categories',
                    'alias' => 'Category',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Category.category_id = Vendor.business_category'
                    )
                )
            ), 'fields' => array('Category.*', 'Vendor.*'), 'conditions' => array('Vendor.vendor_id' => $vendor_id)));
        if (empty($check)) {
            $result = array("message" => "Vendor not found!", "code" => 0);
            echo json_encode($result);
            exit;
        } else {
            return $check;
        }
    }

    public function checkappuser($user_id) {
        $check = $this->User->find('first', array('conditions' => array('user_id' => $user_id)));
        if (empty($check)) {
            $result = array("message" => "User not found!", "code" => 0);
            echo json_encode($result);
            exit;
        } else {
            return $check;
        }
    }

    public function checkappdeliveryboy($dboy_id) {
        $check = $this->Deliveryboy->find('first', array('conditions' => array('deliveryboy_id' => $dboy_id)));
        if (empty($check)) {
            $result = array("message" => "User not found!", "code" => 0);
            echo json_encode($result);
            exit;
        } else {
            return $check;
        }
    }

    function base64_toimage($data, $path) {
        if ($data[0] == '/') {
            $type = "jpeg";
        } else if ($data[0] == 'R') {
            $type = "gif";
        } else if ($data[0] == 'i') {
            $type = "png";
        } else if ($data[0] == '0') {
            $type = "docx";
        } else if ($data[0] == 'J') {
            $type = "pdf";
        } else {
            $type = "jpeg";
        }
        $image = base64_decode($data);
        $imgFile = rand(0, 10000) . time() . "." . $type;
        $ifp = fopen($path . $imgFile, "wb");
        fwrite($ifp, base64_decode($data));
        fclose($ifp);
        return $imgFile;
    }
    
    public function sendSMS($number,$message)
    {
        $senderId="BLJRIC";
        $routeId="1";
        $authKey="172cedc03fd7b35673eeadc6392817c";
        $getData = 'mobileNos='.$number.'&message='.urlencode($message).'&senderId='.$senderId.'&routeId='.$routeId;
        //API URL
        $url="http://msg.msgclub.net/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$authKey."&".$getData;
        // init the resource
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 0,
            CURLOPT_SSL_VERIFYPEER => 0
        ));
        //get response
        $output = curl_exec($ch);
        //Print error if any
        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }
        curl_close($ch);
        return $output;
    }

    // public function sendSMS($number,$message) {
    //     $curl = curl_init();
    //     curl_setopt_array($curl, array(
    //         CURLOPT_PORT => "8080",
    //         CURLOPT_URL => "http://msg.msgclub.net/rest/services/sendSMS/sendGroupSms?AUTH_KEY=172cedc03fd7b35673eeadc6392817c&message=$message&senderId=BLJRIC&routeId=1&mobileNos=$number&smsContentType=english",
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => "",
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 30,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => "GET",
    //         CURLOPT_HTTPHEADER => array(
    //             "Cache-Control: no-cache"
    //         ),
    //     ));
    //     $response = curl_exec($curl);
    //     print_r($response);
    //     exit();
    //     $err = curl_error($curl);
    //     curl_close($curl);
    //     if ($err) {
    //         echo "cURL Error #:" . $err;
    //     } else {
    //         echo $response;
    //     }

    // }

    function vendor_path($vendor_id) {
        $filename = "files/vendors/vendor_" . $vendor_id . "/";
        if (!file_exists($filename)) {
            mkdir($filename, 0755);
        }
        return $filename;
    }

    function vendor_rating($vendor_id) {
        $five = $this->Vendorreview->find('count', array('conditions' => array('vendor_id' => $vendor_id, 'star' => '5')));
        $four = $this->Vendorreview->find('count', array('conditions' => array('vendor_id' => $vendor_id, 'star' => '4')));
        $three = $this->Vendorreview->find('count', array('conditions' => array('vendor_id' => $vendor_id, 'star' => '3')));
        $two = $this->Vendorreview->find('count', array('conditions' => array('vendor_id' => $vendor_id, 'star' => '2')));
        $one = $this->Vendorreview->find('count', array('conditions' => array('vendor_id' => $vendor_id, 'star' => '1')));
        $five = ($five == '') ? 0 : $five;
        $four = ($four == '') ? 0 : $four;
        $three = ($three == '') ? 0 : $three;
        $two = ($five == '') ? 0 : $two;
        $one = ($five == '') ? 0 : $one;
        $total_rate = ($five * 5 + $four * 4 + $three * 3 + $two * 2 + $one * 1);
        $total_count = ($five + $four + $three + $two + $one);
        if ($total_count > 0) {
            $rating = $total_rate / $total_count;
        } else {
            $rating = 0;
        }
        return round($rating);
    }

    public function getAdmin() {
        $admin = $this->Adminuser->find('first', array('conditions' => array('admin_id' => '1')));
        return $admin['Adminuser'];
    }

    public function send_push_notification($registatoin_ids = null, $message) {

        $url = 'https://fcm.googleapis.com/fcm/send';
        $message['notifydata']['click_action'] = 'OPEN_ACTIVITY_1';
        $msg = array
            (
            'body' => '',
            'title' => $message['notifydata']['message'],
            'notify_from' => $message['notifydata']['notify_from'],
            'icon' => 'myicon',
            'sound' => 'mySound',
            "click_action" => "OPEN_ACTIVITY_1",
            'badge' => '1',
            'notification' => $message['notifydata'],
            'id' => isset($message['notifydata']['id']) ? $message['notifydata']['id'] : ""
        );
        foreach ($registatoin_ids as $registatoin_ids) {
            $fields = array('to' => $registatoin_ids, 'data' => $msg);

            if ($message['notifydata']['to'] == 'user'){
                $headers = array('Authorization: key=AAAA4s1H4as:APA91bF9WMcQrqmvGfuBJb6mBieM6ShCeUuiiZTpJ84d0v3cSgmXZI1dZ2Oln_8Qcrk73Po7fusVdLvmDblszQIbVwEpUHMK2EganCqgxS9xeJ6jj2RQK-oPNSeVNAZA3QmRXFSktVZ-', 'Content-Type: application/json');
            }else{
                $headers = array('Authorization: key=AAAAhYwC-4w:APA91bHF_4mM62JIpL2Je2ZN73Dh2H3nrJQ7T9BPzMidBzlYojQwRn1AmBLiukq8B2dgVINmW6li2deFHSPM407OEIwFFPp6aQq-0l4s0LmHx4U5nZCTJ5nrztDqHiozClixnZ4SyG_5', 'Content-Type: application/json');
            }
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            $this->request->data['Ordernotification']['msg'] = $message['notifydata']['message'];
            $this->request->data['Ordernotification']['notify_from'] = $message['notifydata']['notify_from'];
            $this->request->data['Ordernotification']['id'] = $message['notifydata']['id'];
            $this->request->data['Ordernotification']['to'] = $message['notifydata']['to'];
            $this->request->data['Ordernotification']['to_id'] = $message['notifydata']['to_id'];
            $this->request->data['Ordernotification']['created_date'] = date('Y-m-d H:i:s');
            $this->Ordernotification->saveAll($this->request->data['Ordernotification']);
            if ($result === FALSE) {
                return ('Curl failed: ' . curl_error($ch));
            }
            curl_close($ch);
        }
        return $result;
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
                return round(($miles * 1.609344), 2);
            } else if ($unit == "N") {
                return round(($miles * 0.8684), 2);
            } else {
                return round($miles, 2);
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

}
