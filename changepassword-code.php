<?php
  session_start();

  $errorCount = 0;
  $_SESSION['email'] = $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];
  $_SESSION['token'] = $token = $_POST['token'];

  if(empty($password) || empty($cpassword) || empty($token) || empty($email)) {
    $errorCount++;
  }
  $password === $cpassword ? '': $errorCount++;
    
  if($errorCount > 0) {
    $_SESSION['error'] = 'There is an error with your submission';
    header('location: changepassword.php');
  } else {
    $scantokens = scandir('tokens');
      for($t = 0; $t < count($scantokens); $t++) {
        if($scantokens[$t] === $token) {
          $scandir = scandir('user_details');
          for($i = 0; $i <= count($scandir); $i++) {
            $substr = substr($scandir[$i], 1);
            if($substr === $email.'.json') {
              $getContents = file_get_contents('user_details/'.$scandir);
              $decode = json_decode($getContents);
              $hash = password_hash($password, PASSWORD_DEFAULT);
              $decode->password = $hash;
              
              file_put_contents('user_details/'.$scandir, json_encode($decode));
              $_SESSION['success'] = 'Password Reset Successful';
              header('location: login.php');

            } else {
              $_SESSION['success'] = 'Email could not be found in database';
              header('location: login.php'); 
            }
          }
        }
      }
    }


?>