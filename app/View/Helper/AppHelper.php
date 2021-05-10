<?php

/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
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
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Helper', 'View');

/**
 * Application helper
 *
 * Add your application-wide methods in the class below, your helpers
 * will inherit them.
 *
 * @package       app.View.Helper
 */
class AppHelper extends Helper {

    public $components = array('Paginator', 'Session');

    public function read_more($string, $length) {
        $string = strip_tags($string);
        if (strlen($string) > $length) {
            $stringCut = substr($string, 0, $length);
            $string = substr($stringCut, 0, strrpos($stringCut, ' '));
        }
        return $string;
    }

    function show_image($image, $width, $height) {
        //$this->helper('file');                   why need this?
        //$image_content = read_file($image);      We does not want to use this as output.
        //resize image           
        $image = imagecreatefromjpeg($image);
        $thumbImage = imagecreatetruecolor(50, 50);
        imagecopyresized($thumbImage, $image, 0, 0, 0, 0, 50, 50, $width, $height);
        imagedestroy($image);
        //imagedestroy($thumbImage); do not destroy before display :)
        // ob_end_clean();  // clean the output buffer ... if turned on.
        header('Content-Type: image/jpeg');
        imagejpeg($thumbImage); //you does not want to save.. just display
    }

    function date_formats($date) {
        list($m, $d, $y) = explode('-', $date);
        $times = mktime(0, 0, 0, $m, $d, $y);
        $dates = date('Y-m-d', $times);

        return date("m-d-Y", strtotime("$dates"));
    }

    function date_format($date) {
        $date = date('m-d-Y', strtotime($date));
        return $date;
    }

    public function sqlformat($date, $time = null) {
        list($m, $d, $y) = explode('-', $date);
        $times = mktime(0, 0, 0, $m, $d, $y);
        $dates = date('Y-m-d', $times);
        return date("Y-m-d H:i:s", strtotime("$dates $time"));
    }

    function time_format($date) {
        $date = date('h:i a', strtotime($date));
        return $date;
    }

    function datetime_format($date) {
        $date = date('m-d-Y h:i a', strtotime($date));
        return $date;
    }

    function timthumb($folder, $w, $h) {
        $image = WEBROOT_URL . "files/timthumb.php?src=" . WEBROOT_URL . "files/" . $folder . "/" . $banner['Slider']['slider_image'] . "&w=" . $w . "&h=" . $h . "";
    }

    public function format($date) {
        return date("Y-m-d", strtotime(str_replace(array("/", ","), array("-", " "), $date)));
    }

    public function book_id($id) {
        return 'ZBS' . sprintf("%03d", $id);
    }

    function facebook_time_ago($timestamp) {
        $time_ago = strtotime($timestamp);
        $current_time = time();
        $time_difference = $current_time - $time_ago;
        $seconds = $time_difference;
        $minutes = round($seconds / 60);           // value 60 is seconds  
        $hours = round($seconds / 3600);           //value 3600 is 60 minutes * 60 sec  
        $days = round($seconds / 86400);          //86400 = 24 * 60 * 60;  
        $weeks = round($seconds / 604800);          // 7*24*60*60;  
        $months = round($seconds / 2629440);     //((365+365+365+365+366)/5/12)*24*60*60  
        $years = round($seconds / 31553280);     //(365+365+365+365+366)/5 * 24 * 60 * 60  
        if ($seconds <= 60) {
            return "Just Now";
        } else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "1 min ago";
            } else {
                return "$minutes min ago";
            }
        } else if ($hours <= 24) {
            if ($hours == 1) {
                return "1 hr ago";
            } else {
                return "$hours hr ago";
            }
        } else if ($days <= 7) {
            if ($days == 1) {
                return date('l', strtotime($timestamp)) . ' at ' . date('g:i A', strtotime($timestamp));
            } else {
                return date('l', strtotime($timestamp)) . ' at ' . date('g:i A', strtotime($timestamp));
            }
        } else if ($weeks <= 4.3) { //4.3 == 52/12  
            if ($weeks == 1) {
                return date('F d', strtotime($timestamp)) . ' at ' . date('g:i A', strtotime($timestamp));
            } else {
                return date('F d', strtotime($timestamp)) . ' at ' . date('g:i A', strtotime($timestamp));
            }
        } else if ($months <= 12) {
            if ($months == 1) {
                return date('F d', strtotime($timestamp));
            } else {
                return date('F d', strtotime($timestamp));
            }
        } else {
            if ($years == 1) {
                return date('m-d-Y', strtotime($timestamp));
            } else {
                return date('m-d-Y', strtotime($timestamp));
            }
        }
    }

    function activity($ac_id, $activity_id) {
        $ac = ClassRegistry::init('Proposalactivity')->find('first', array('conditions' => array('ac_id' => $ac_id)));
        $ac_msg = (!empty($ac)) ? $ac['Proposalactivity']['activity'] : "";
        $activity = ClassRegistry::init('Activity')->find('first', array('conditions' => array('activity_id' => $activity_id)));
        $proposal = ClassRegistry::init('Proposal')->find('first', array('conditions' => array('proposal_id' => $activity['Activity']['proposal_id'])));
        $proposalname = $proposal['Proposal']['proposal_name'];
        if ($activity['Activity']['user_type'] == 'User') {
            if ($activity['Activity']['userid'] == $_SESSION['Adminuser']['admin_id']) {
                $name = 'You';
            } else {
                $usr = ClassRegistry::init('Adminuser')->find('first', array('conditions' => array('admin_id' => $activity['Activity']['userid'])));
                $name = $usr['Adminuser']['adminname'];
            }
            $usr = ClassRegistry::init('Adminuser')->find('first', array('conditions' => array('admin_id' => $activity['Activity']['userid'])));
            $name = $usr['Adminuser']['adminname'];
        } else {
            $usr = ClassRegistry::init('Companycontact')->find('first', array('conditions' => array('comcontact_id' => $activity['Activity']['userid'])));
            $company = ClassRegistry::init('Company')->find('first', array('conditions' => array('company_id' => $usr['Companycontact']['company_id'])));
            $name = $company['Company']['contact_person'];
        }
        $admin_message = str_replace(array('{name}', '{proposalname}'), array($name, $proposalname), $ac_msg);
        return $admin_message;
    }

    public function checkpriv($priv_id) {
        if ($_SESSION['Adminuser']['usertype_id'] != '0') {
            $priv = ClassRegistry::init('Userprivilege')->find('all', array('conditions' => array('priv_id' => $priv_id, 'user_id' => $_SESSION['Adminuser']['admin_id'])));
            if (empty($priv)) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    public function allActivity($conditions = NULL) {
        $conditions['Adminuser.admin_id !='] = '1';
        $activities = ClassRegistry::init('Allactivity')->find('all', array('joins' => array(
                array(
                    'table' => 'tbl_adminusers',
                    'alias' => 'Adminuser',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Adminuser.admin_id = Allactivity.activityuser_id'
                    )
                )
            ), 'fields' => array('Allactivity.*', 'Adminuser.*'), 'conditions' => $conditions));
        return $activities;
    }

    public function share_link($url = "", $provide = "") {
        switch ($provide) {
            case "fb":
                $return_url = sprintf('https://www.facebook.com/sharer/sharer.php?u=%s', $url);
                break;
            case "tw":
                $return_url = sprintf('https://twitter.com/home?status=%s', $url);
                break;
            case "gp":
                $return_url = sprintf('https://plus.google.com/share?url=%s', $url);
                break;
            case "li":
                $return_url = sprintf('https://www.linkedin.com/shareArticle?mini=true&url=%s&title=&summary=&source=', $url);
                break;
            case "pr":
                $return_url = sprintf('https://pinterest.com/pin/create/button/?url=%s&media=&description=', $url);
                break;
            case "dribble":
                $return_url = sprintf('https://www.google.com/share?url=%s', $url);
                break;
            default:
                $return_url = $url;
        }
        return $return_url;
    }

    public function getDeliveryAddress($id = NULL) {
        $address = ClassRegistry::init('Deliveryaddress')->find('first', array('conditions' => array('address_id' => $id)));
        $deliveryaddres = '';
        $deliveryaddres.=(!empty($address['Deliveryaddress']['flat_no'])) ? $address['Deliveryaddress']['flat_no'] . ',' : '';
        $deliveryaddres.=(!empty($address['Deliveryaddress']['building'])) ? $address['Deliveryaddress']['building'] . ',' : '';
        $deliveryaddres.=(!empty($address['Deliveryaddress']['landmark'])) ? $address['Deliveryaddress']['landmark'] . ',' : '';
        $deliveryaddres.=(!empty($address['Deliveryaddress']['location'])) ? $address['Deliveryaddress']['location'] . ',' : '';
        $deliveryaddres.=(!empty($address['Deliveryaddress']['pincode'])) ? $address['Deliveryaddress']['pincode'] . ',' : '';
        return $deliveryaddres;
    }

}
