<?php
  session_start();

  if(isset($_POST['submit'])) {
    $$_POST['email'] ? $_POST['email'] : ''; 

    if(empty($_POST['email'])) {
      $_SESSION['error'] = 'Please put in your email below';
      header('location: forgot.php');
    } else {
      
    }
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
    }header {
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
    .padding {
			padding: 10%;
		}
  </style>
</head>
<body>
  <header class="">
  <nav>
        <ul>
          <li><a href="">Register</a></li>
          <li><a href="login.php">Log In</a></li>
          <li><a href="">Book An Appointment</a></li>
          <li><a href="">Pay Hospital Fees</a></li>
        </ul>
      </nav>
    <h4>SNH </h4>
  </header>
  <div class="mt-5 pt-5 container">
    <div class="col-lg-6 col-md-6">
      <div class="card padding">
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
        <form action="appointment_code.php" method="POST">

          <div class="form-group">
            <input type="hidden" class="form-control" name="email" value="<?php
              if(isset($_SESSION['email'])) {
                  echo $_SESSION['email'];
                } else if(isset($_GET['email'])) {
                  echo $_GET['email'];
              };
              ?>">
          </div>

          <div class="form-group">
            <input type="hidden" class="form-control" name="token" value="<?php
              if(isset($_SESSION['token'])) {
                  echo $_SESSION['token'];
                } else if(isset($_GET['token'])) {
                  echo $_GET['token'];
              };
              ?>">
          </div>

          <div class="form-group">
            <label for="forgot">Password</label>
            <input type="password" class="form-control" name="password">
          </div>

          <div class="form-group">
            <label for="forgot">Confirm Password</label>
            <input type="password" class="form-control" name="cpassword">
          </div>
        
          <button class="btn btn-success" style="float: right;">Get Password Recovery Mail</button>

        </form>
      </div>
    </div>
  </div>
</body>
</html>