<?php

	session_start();

	$scandir = scandir('user_details');
	$des = substr($_SESSION['designation'], 0,1);
			for( $i = 0; $i < count($scandir); $i++ ) {
				
				if($scandir[$i] === $des.'-'.$_SESSION['email'].'.json' ) {

					$account = file_get_contents('user_details/'.$scandir[$i]);

					$allfiles = json_decode($account);
					$hashed_password = password_hash($_SESSION['password'], PASSWORD_DEFAULT);

					$pass = password_verify($_SESSION['password'], $allfiles->password);

					if ( $pass ) {
						$allfiles->last_login = $allfiles->current_login;
						unset($_SESSION['fname']);
						unset($_SESSION['lname']);
						unset($_SESSION['email']);
						unset($_SESSION['password']);
						unset($_SESSION['designation']);
						unset($_SESSION['date_of_reg']);
						unset($_SESSION['last_login']);
						unset($_SESSION['department']);
						unset($_SESSION['loggedIn']);
						
						header('location: login.php');
					}
				}

			}


?>
