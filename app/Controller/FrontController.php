<?php

App::uses('AppController', 'Controller');

/**
 * Staticpages Controller
 *
 * @property Staticpage $Staticpage
 * @property PaginatorComponent $Paginator
 */
class FrontController extends AppController {

    /**
     * Components
     *
     * @var array
     */

    /**
     * admin_index method
     *
     * @return void
     */
   
    public function index() {
   
       $this->layout = 'front';

    }

    public function privacy_policy() {
       $this->layout = 'privacy_policy';

    }
    
        public function tac() {
       $this->layout = 'tac';

    }

   public function contact() {
$this->autorender = false;
$this->layout = false;
$receiving_email_address="balaji.rice2020@gmail.com";
        $name = $this->request->data['name'];
$subject = $this->request->data['subject'];
$from = $this->request->data['email'];
$msg = $this->request->data['message'];
$from_mail="support@moziztech.com";
              $headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from_mail."\r\n".
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<p >Name : '.$name.'</p>';
$message .= '<p >Email : '.$from.'</p>';
$message .= '<p >Subject : '.$subject.'</p>';
$message .= '<p >Message : '.$msg.'</p>';
$message .= '</body></html>';
 
// Sending email
$subject = "Contact Us form from QRice.com";
if(mail($receiving_email_address, $subject, $message, $headers)){
    echo "OK";
} else{
    echo 'Unable to send email. Please try again.';
}
    }
    
    /**
     * admin_edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
 
}
