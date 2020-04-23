<?php
  session_start();

  $errorCount = 0;

  $_SESSION['email'] = empty($_POST['email']) ? $errorCount++ : $_POST['email'];
  $_SESSION['password'] = empty($_POST['password']) ? $errorCount++ : $_POST['password'];

  if($errorCount > 0) {
    if($errorCount < 2) {
      $_SESSION['error'] = 'There is '. $errorCount . ' error in your form';
    } else {
      $_SESSION['error'] = 'There are '. $errorCount . ' errors in your form';
    }
    header('location: login.php');
  } else {

    $scandir = scandir('user_details');

    for($i = 0; $i <= count($scandir); $i++) {
      $substr = substr($scandir[$i], 2);
        if($substr === $_SESSION['email'].'.json') {
          $file = file_get_contents('user_details/'.$scandir[$i]);
          $allfiles = json_decode($file);
          if( password_verify($_POST['password'], $allfiles->password) ) {
            $allfiles->current_login = date('Y-m-d H-i-s');

						$_SESSION['fname'] = $allfiles->fname;
						$_SESSION['lname'] = $allfiles->lname;
						$_SESSION['designation'] = $allfiles->designation;
						$_SESSION['department'] = $allfiles->department;
						$_SESSION['email'] = $allfiles->email;
						$_SESSION['date_of_reg'] = $allfiles->date_of_reg;
						$_SESSION['last_login'] = $allfiles->last_login;
						$_SESSION['loggedIn'] = $allfiles->id;
						$_SESSION['password'] = $_POST['password'];
						if (strlen($allfiles->last_login) > 2) {
							$_SESSION['last_login'] = $allfiles->last_login;
						} else {
							$_SESSION['last_login'] = date('Y-m-d H-i-s');
						}
						header('location: patientdashboard.php');
          } else {
						$_SESSION['error'] = 'Password is wrong';
						header('location: login.php');
					}
        }
    }


  }



?>