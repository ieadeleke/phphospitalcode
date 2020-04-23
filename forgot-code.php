<?php
session_start();
$_SESSION['email'] = $email = $_POST['email'];
if(empty($_POST['email'])) {
  $_SESSION['error'] = 'Your email is required to reset your password';
  header('location: forgot.php');
} else {

  $scandir = scandir('user_details');
    for($i = 1; $i < count($scandir); $i++) {
      $substr = substr($scandir[$i], 2);
      if($substr === $email.'.json') {
        $alphabet = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $token = substr(str_shuffle($alphabet), 16);
        $url = 'http://localhost/phptask/changepassword.php?token='.$token.'&email='.$email;
        $to = $_SESSION['email'];
        $subject = 'SNH - Password Reset';
        $message = 'Hi there, Please find below the link to reset your password on the Start.ng Hospital. This link has a very short lifespan and will expire withing 15 minutes.
        '.$url;
        $header = "From: Adeleke Ife". "r\n".
        "CC: eadelekeife@gmail.com";
        
        $try = mail($to,$subject,$message,$header);

        if($try) {
          file_put_contents('tokens/'.$token.'-'.$email.'.json','Working Token');
          $_SESSION['success'] = 'Password reset link has been sent to your mail';
          header('location: login.php');
        } else {
          echo 'Could not send mail';
        }

      }
    }

}

?>