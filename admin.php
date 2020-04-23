<?php
  session_start();
  if(!isset($_SESSION['loggedIn'])) {
    header('location: login.php');
  }
 if(($_SESSION['designation'] === 'patient')) {
    header('location: patientdashboard.php');
  }
  if(($_SESSION['designation'] === 'medical_team')) {
    header('location: medical_dashboard.php');
  }
   $scandir = scandir('user_details');
  $p = 0; $m = 0;

  $patients = [];
  $doctors = [];
  for($i = 0; $i < count($scandir); $i++) {
    $des = substr($scandir[$i], 0,1);
    
    if( $des === 'p' ) {
      $p++;

      $substr = substr($scandir[$i],2);
      array_push($patients, substr($substr, 0, -5));
    };
    if( $des === 'm' ) {
      $m++;

      $substr = substr($scandir[$i],2);
      array_push($doctors, substr($substr, 0, -5));
   
    };
  }
  $appointment = scandir('appointments');
  $appointment_count = (count($appointment) - 2);

  $scandir_appointments = scandir('appointments');

  $users = scandir('appointments');


  $arr = [];
  for($i = 2; $i < count($scandir_appointments); $i++) {

      $read_file = file_get_contents('appointments/'.$scandir_appointments[$i]); 
      $format_read_file = json_decode($read_file);
      array_push($arr,$format_read_file);
    };

?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans&display=swap" rel="stylesheet">
  <title>SNH Hospital Registration</title>
  <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
  <script src="bootstrap/dist/js/bootstrap.min.js"></script>
  <style>
    html,body {
      font-family: 'Josefin Sans', sans-serif;
    }
    .container {
      margin: 0 auto;
      justify-content: center;
      align-items: center;
    }
    li {
      list-style: none;
    }
    .service-icon {
      width: 7rem;
      height: 7rem;
      background: #007BFF;
      border-radius: 50%;
      font-size: 6rem;
    }
    .container .col-lg-9 h6::after {
      background: #000;
      width: 5%;
      height: 2px;
      display: block;
      content: '';
    }
    ul li span {
      display: inline-block;
      min-width: 220px;
    }
    header {
      background: #E9ECEF;
      min-height: 3rem;
      padding: 5px 30px;
    }
    header nav  {
      float: right;
    }
    header nav li {
      display: inline-block;
      padding: 10px;
    }
    header ul li a {
      color: #007BFF;
    }
    .dot {
      background: #28A745;
      border-color: #28A745;
      width: 10px;
      height: 10px;
      display: inline-block;
      border-radius: 50%;
      margin-right: 3px;
    }
  </style>
</head>
<body>
  <header class="">
  <nav>
        <ul>
          <li><a href="admin-register.php">Register New User</a></li>
          <li>
          <form action="logout.php" method="POST">
            <input type="submit" class="btn btn-danger" value="LOG OUT">
          </form>
          </li>
        </ul>
      </nav>
    <h4>SNH </h4>
  </header>
        <?php 
        if(isset($_SESSION['error'])) {
      ?>
              <li class="alert text-danger text-center">
                <?= isset($_SESSION['error']) ? $_SESSION['error'] : '' ?>
              </li>
      <?php
          unset($_SESSION['error']); 
        } 
      ?>
      <?php 
        if(isset($_SESSION['success'])) {
      ?>
              <li class="alert text-success text-center">
                <?= isset($_SESSION['success']) ? $_SESSION['success'] : '' ?>
              </li>
      <?php 
          unset($_SESSION['success']);
        }    
      ?>
    <div class="jumbotron">
      <div class="media">
        <div class="service-icon container text-center text-white">A</div>
        <div class="media-body mx-3 mt-4">
          <h3>Welcome Back, <?= $_SESSION['lname'] ?></h3>
          <h6> <?= $_SESSION['email'] ?></h6>
          <span class="dot"></span><?= $_SESSION['designation'] ?>
        </div>
      </div>
    </div>
    <div class="container">
      <h6>Hospital Details</h6>
      <div class="mt-4 pt-4"></div>
        <div class="row">
          <div class="col-lg-4">
            <div class="card p-5 text-center">
                <?php 
                  if(($p > 1) || ($p === 0)) {
                    echo $p.' <br> registered patients';
                  } else if($p === 1) {
                    echo $p.' <br> registered patient';
                  }
               ?>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card p-5 text-center">
                <?php 
                  if(($m > 1) || ($m === 0)) {
                    echo $m.' <br> registered medical doctors';
                  } else if($m === 1){
                    echo $m.' <br> registered medical doctor';
                  }
               ?>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card p-5 text-center">
            <?php 
                  if(($appointment_count > 1) || ( $appointment_count === 0)) {
                    echo  $appointment_count.' <br> medical appointments';
                  } else if($appointment_count === 1) {
                    echo  $appointment_count.' <br> medical appointment';
                  }
               ?>
            </div>
          </div>
        </div>

        <div class="mt-4 pt-4"></div>
        <div class="row">
          <div class="col-lg-4">
            <div class="card text-center">
            <div class="card-header">
                  Patients
            </div>
            <div class="card-body p-5 ">
            <?php
                for($i = 0; $i < count($patients); $i++) {
                  ?>
                  <h6> <?= $patients[$i] ?> </h6>
                  <hr>
              <?php
                }
              ?>
            </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card text-center">
            <div class="card-header">
                Doctors
            </div>
            <div class="card-body p-5 ">
            <?php
                for($i = 0; $i < count($doctors); $i++) {
                  ?>
                   <h6> <?= $doctors[$i] ?> </h6>
                  <hr>
              <?php
                }
              ?>
            </div>
            </div>
          </div>
          <div class="col-lg-4">
          <div class="card">
            <div class="card-header">
              <h6>Appointments</h6>
            </div>
            <div class="p-5 card-body">
              <?php
                for($i = 0; $i < count($arr); $i++) {
                  ?>
                  <h6><?= $arr[$i]->last_name ?> <?= $arr[$i]->first_name ?>
                  <small>(<?= $arr[$i]->date ?>, <?= $arr[$i]->time ?>) - <?= $arr[$i]->department ?></small></h6>
                  <p><?=$arr[$i]->complaint?></p>
                  <hr>
              <?php
                }
              ?>
            </div>
          </div>
          </div>
        </div>

    </div>
</body>
</html>