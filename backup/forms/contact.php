<?php
  /**
  * Requires the "PHP Email Form" library
  * The "PHP Email Form" library is available only in the pro version of the template
  * The library should be uploaded to: vendor/php-email-form/php-email-form.php
  * For more info and help: https://bootstrapmade.com/php-email-form/
  */

  // Replace contact@example.com with your real receiving email address
  $receiving_email_address = 'balaji.rice2020@gmail.com';
  

//   if( file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php' )) {
//     include( $php_email_form );
//   } else {
//     die( 'Unable to load the "PHP Email Form" Library!');
//   }

//   $contact = new PHP_Email_Form;
//   $contact->ajax = true;
  
//   $contact->to = $receiving_email_address;
//   $contact->from_name = $_POST['name'];
//   $contact->from_email = $_POST['email'];
//   $contact->subject = $_POST['subject'];

  // Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
  /*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

//   $contact->add_message( $_POST['name'], 'From');
//   $contact->add_message( $_POST['email'], 'Email');
//   $contact->add_message( $_POST['message'], 'Message', 10);

$subject = $_POST['subject'];
$from = $_POST['email'];
$msg = $_POST['message'];
$name = $_POST['name'];
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<p >Name : '.$name.'</p>';
$message .= '<p >Email : '.$_POST['email'].'</p>';
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

    //  $receiving_email_address = 'rachnagaur658@gmail.com';
  // echo $contact->send();
?>
