<?php
  session_start();
  if(!isset($_SESSION['loggedIn'])) {
    header('location: login.php');
  }
 if(($_SESSION['designation'] === 'patient')) {
    header('location: patientdashboard.php');
  }
  if(($_SESSION['designation'] === 'super_admin')) {
    header('location: admin.php');
  }

  $scandir = scandir('appointments');
  $newArray = [];
  $arr = [];
  for($i = 2; $i < count($scandir); $i++) {
    //get the numbers and hyphen in front of the contents of the contents of the appointments folder
    $get_count = substr($scandir[$i],0, 2);
    //remove the numbers and hyphen in front of the contents of the contents of the appointments folder
    $substr = substr($scandir[$i], 2);
    $appointment_replace = str_replace(' ','-',$substr);
    // remove the .json in front 
    $new_appointment = substr($appointment_replace, 0,-5);
    //remove the space and replace it with hyphen ( - ) so it can match the content of the folder
    $department_replace = str_replace(' ','-',$_SESSION['department']);
    if( $new_appointment === $department_replace ) {
      $read_file = file_get_contents('appointments/'.$get_count.$new_appointment.'.json'); 
      $format_read_file = json_decode($read_file);
      array_push($arr,$format_read_file);
    };
  

  }


?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js" integrity="sha384-xymdQtn1n3lH2wcu0qhcdaOpQwyoarkgLVxC/wZ5q7h9gHtxICrpcaSUfygqZGOe" crossorigin="anonymous"></script>
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
    .bell {
      position: relative;
    }
    .badge {
      position: absolute;
      top: 0;
      right: 0;
    }
  </style>
</head>
<body>
  <header class="">
      <nav>
        <ul>
          <li>
            <form action="logout.php" method="POST">
            <input type="submit" class="btn btn-danger" value="LOG OUT">
          </form>
          </li>
        </ul>
      </nav>
    <h4>SNH </h4>
  </header>
    <div class="jumbotron">
      <div class="media">
        <div class="service-icon container text-center text-white">I</div>
        <div class="media-body mx-3 mt-4">
          <h3>Welcome Doc, <?= $_SESSION['lname'].' '.$_SESSION['fname']; ?></h3>
          <h6> <?= $_SESSION['email'] ?></h6>
          <span class="dot"></span><?= $_SESSION['designation'] ?>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-md-8 col-lg-8">
          <h6>Details</h6>
          <div>&nbsp;</div>
            <ul>
                <li><span>Access Level:</span><span class="text-uppercase"><?= $_SESSION['designation'] ?></span></li>
                <li><span>Department:</span><?= $_SESSION['department'] ?></li>
                <li><span>Date of Registration:</span> <?= $_SESSION['date_of_reg'] ?></li>
                <li><span>Last Logged In:</span> <?= $_SESSION['last_login'] ?></li>
            </ul>
        </div>
        <div class="col-lg-4 col-md-4">
          <div class="card">
            <div class="card-header">
              <h6>Appointments</h6>
            </div>
            <div class="p-3 card-body">
              <?php
              if(count($arr) > 0) {
                for($i = 0; $i < count($arr); $i++) {
                  ?>
                  <h6><?= $arr[$i]->last_name ?> <?= $arr[$i]->first_name ?>
                  <small>(<?= $arr[$i]->date ?>, <?= $arr[$i]->time ?>)</small></h6>
                  <small> <span class="dot"></span><?= $arr[$i]->nature ?></small>
                  <p><?=$arr[$i]->complaint?></p>
                  <hr>
              <?php
                }
              } else { ?>
                <h6>You have no pending appointments</h6>
             <?php } ?>
            </div>
          </div>
        </div>
      </div>
</body>
</html>