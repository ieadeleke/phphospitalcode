<?php
  session_start();
  if(!isset($_SESSION['loggedIn'])) {
    header('location: login.php');
  }
  if(($_SESSION['designation'] === 'medical_team')) {
    header('location: medical_dashboard.php');
  }
  if(($_SESSION['designation'] === 'super_admin')) {
    header('location: admin.php');
  }
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
      background: #F5F5FF;
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
    .container h6::after {
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
    .dot {
      background: #28A745;
      border-color: #28A745;
      width: 10px;
      height: 10px;
      display: inline-block;
      border-radius: 50%;
      margin-right: 3px;
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
  </style>
</head>
<body>
<?php 
        if(isset($_SESSION['success'])) {
      ?>
              <li class="alert alert-success text-dark text-center">
                <?= isset($_SESSION['success']) ? $_SESSION['success'] : '' ?>
              </li>
      <?php 
          unset($_SESSION['success']);
        }    
      ?>
  <header class="">
  <nav>
        <ul>
          <li><a href="appointment.php">Book Appointment</a></li>
          <li><a href="payfees.php">Pay Bills</a></li>
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
          <h3>Welcome Home, <?= $_SESSION['lname'].' '.$_SESSION['fname']; ?></h3>
          <h6> <?= $_SESSION['lname'] ?></h6>
          <span class="dot"></span><?= $_SESSION['designation'] ?>
        </div>
      </div>
    </div>
    <div class="container">
      <h6>Details</h6>
      <div class="mt-4 pt-4"></div>
        <div class="row">
          <div class="col-md-6 col-lg-6">
            <ul>
                <li><span>Access Level:</span><span class="text-uppercase"><?= $_SESSION['designation'] ?></span></li>
                <li><span>Department</span><?= $_SESSION['department'] ?></li>
                <li><span>Date of Registration:</span> <?= $_SESSION['date_of_reg'] ?></li>
                <li><span>Last Logged In:</span> <?= $_SESSION['last_login'] ?></li>
            </ul>
          </div>
 
        </div>
    </div>
</body>
</html>