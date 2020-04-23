<?php
  session_start();

  $errorCount = 0;

  $_SESSION['fname'] = empty($_POST['fname']) ? $errorCount++ : $_POST['fname'];
  $_SESSION['lname'] = empty($_POST['lname']) ? $errorCount++ : $_POST['lname'];
  $_SESSION['email'] = empty($_POST['email']) ? $errorCount++ : $_POST['email'];
  $_SESSION['password'] = empty($_POST['password']) ? $errorCount++ : $_POST['password'];
  $_SESSION['department'] = empty($_POST['department']) ? $errorCount++ : $_POST['department'];
  $_SESSION['gender'] = empty($_POST['gender']) ? $errorCount++ : $_POST['gender'];
  $_SESSION['designation'] = empty($_POST['designation']) ? $errorCount++ : $_POST['designation'];
  $_SESSION['designation'] = empty($_POST['designation']) ? $errorCount++ : $_POST['designation'];
  if (!ctype_alpha($_SESSION['fname'])) {
		$errorsCount++;
	}
	if (!ctype_alpha($_SESSION['lname'])) {
		$errorsCount++;
	}

  if($errorCount > 0) {
    if($errorCount < 2) {
      $_SESSION['error'] = 'There is '. $errorCount . ' error in your form';
    } else {
      $_SESSION['error'] = 'There are '. $errorCount . ' errors in your form';
    }
    header('location: registration.php');
  } else {
    $des = substr($_SESSION['designation'], 0,1);
    $scandir = scandir('user_details');

    for($i = 0; $i <= count($scandir); $i++) {
      $substr = substr($scandir[$i], 2);
        if($substr === $_SESSION['email'].'.json') {
          $_SESSION['error'] = 'Email exists in Database';
          header('location: registration.php');
          die();
        }
    }
    if (count($scandir) == 2) {
      $id = 1;
    } else if(count($scandir) > 2) {
      $id = ((count($scandir) - 1));
    };

      $data = [
        'id' => $id,
				'fname' => $_SESSION['fname'],
				'lname' => $_SESSION['lname'],
				'email' => $_SESSION['email'],
				'gender' => $_SESSION['gender'],
				'designation' => $_SESSION['designation'],
				'department' => $_SESSION['department'],
				'password' => password_hash($_SESSION['password'], PASSWORD_DEFAULT),
				'date_of_reg' => date('Y-m-d H-i-s'),
				'last_login' => '',
				'current_login' => '',
      ];

      file_put_contents('user_details/'.$des.'-'.$_SESSION['email'].'.json', json_encode($data));
      $_SESSION['success'] = 'User Registered Successfully';
      header('location: login.php');


  }



?>