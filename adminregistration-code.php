<?php
  session_start();

  $errorCount = 0;

  $_SESSION['newfname'] = empty($_POST['fname']) ? $errorCount++ : $_POST['fname'];
  $_SESSION['newlname'] = empty($_POST['lname']) ? $errorCount++ : $_POST['lname'];
  $_SESSION['newemail'] = empty($_POST['email']) ? $errorCount++ : $_POST['email'];
  $_SESSION['newpassword'] = empty($_POST['password']) ? $errorCount++ : $_POST['password'];
  $_SESSION['newdepartment'] = empty($_POST['department']) ? $errorCount++ : $_POST['department'];
  $_SESSION['newgender'] = empty($_POST['gender']) ? $errorCount++ : $_POST['gender'];
  $_SESSION['newdesignation'] = empty($_POST['designation']) ? $errorCount++ : $_POST['designation'];
  $_SESSION['newdesignation'] = empty($_POST['designation']) ? $errorCount++ : $_POST['designation'];
  if (!ctype_alpha($_SESSION['newfname'])) {
		$errorsCount++;
	}
	if (!ctype_alpha($_SESSION['newlname'])) {
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

    $scandir = scandir('user_details');
    $des = substr($_SESSION['designation'], 0,1);

    for($i = 0; $i < count($scandir); $i++) {
      
        if($scandir[$i] === $des.'-'.$_SESSION['newemail'].'.json') {
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
				'fname' => $_SESSION['newfname'],
				'lname' => $_SESSION['newlname'],
				'email' => $_SESSION['newemail'],
				'gender' => $_SESSION['newgender'],
				'designation' => $_SESSION['newdesignation'],
				'department' => $_SESSION['newdepartment'],
				'password' => password_hash($_SESSION['newpassword'], PASSWORD_DEFAULT),
				'date_of_reg' => date('Y-m-d H-i-s'),
				'last_login' => '',
				'current_login' => '',
      ];
      file_put_contents('user_details/'.$des.'-'.$_SESSION['newemail'].'.json', json_encode($data));
      $_SESSION['success'] = 'User Registered Successfully';
      unset $_SESSION['newfname'];
	  unset $_SESSION['newlname'];
	  unset $_SESSION['newemail'];
	  unset $_SESSION['newpassword'];
	  unset $_SESSION['newdepartment'];
	  unset $_SESSION['newgender'];
	  unset $_SESSION['newdesignation'];
	  unset $_SESSION['newdesignation'];
      header('location: admin.php');


  }



?>