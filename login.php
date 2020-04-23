<?php
  session_start();
  if(isset($_SESSION['loggedIn'])) {
    header('location: patientdashboard.php');
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
      background: #007BFF;
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
    header {
      background: #fff;
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
      color: #000;
    }
  </style>
</head>
<body>
  <header class="">
  <nav>
        <ul>
          <li><a href="registration.php">Register</a></li>
          <li><a href="">Log In</a></li>
          <li><a href="">Book An Appointment</a></li>
          <li><a href="">Pay Hospital Fees</a></li>
        </ul>
      </nav>
    <h4>SNH </h4>
  </header>
  <div class="mt-5 pt-5 container">
    <div class="col-lg-6 col-md-6">
      <div class="card p-5">
      <form action="login_code.php" method="POST">
        <?php 
          if(isset($_SESSION['error'])) {
        ?>
                <li class="alert text-danger text-center">
                  <?php isset($_SESSION['error']) ? print_r($_SESSION['error']) : '' ?>
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

          <div class="form-group">
            <label>Email Address</label> <br>
            <input type="email" name="email" class="form-control" minlength="5" value="<?= !empty($_SESSION['email']) ? $_SESSION['email'] : ''?>" placeholder="Email Address">
          </div>

          <div class="form-group">
            <label>Password</label> <br>
            <input type="password" name="password" class="form-control" value="<?= !empty($_SESSION['email']) ? $_SESSION['email'] : ''?>" placeholder="Password">
          </div>

          <button type="submit" class="btn btn-primary">LOG IN</button>

          <div>&nbsp;</div>
          <a href="/phptask/registration.php">Don't have an account? Register Here</a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>