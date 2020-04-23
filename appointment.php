<?php
  session_start();
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
      <h6 class="text-danger">Please note that appointment dates may be adjusted based on Doctor's Schedule</h6>
        <form action="appointment_code.php" method="POST">

          <div class="form-group">
            <div class="row">
              <div class="col-lg-6 col-md-6">
                <label for="date">Date</label>
                <input type="date" name="date" class="form-control" id="date">
              </div>
              <div class="col-lg-6 col-md-6">
                <label for="time">Time</label>
                <input type="time" name="time" class="form-control" id="time">
              </div>
            </div>
          </div>
          <div class="form-group">
              <label for="nature">Nature of Appointment</label>
              <select class="form-control" id="nature" name="nature">
                <option>Emergency</option>
                <option>Urgent</option>
                <option>Not so Urgent</option>
              </select>
          </div>
          <div class="form-group">
            <label for="department">Department to See</label>
            <select class="form-control" id="department" name="department">
                <option>Neurology</option>
                <option>Cardiology</option>
                <option>Emergency Care</option>
                <option>Intensive Care Unit</option>
            </select>
          </div>
          <div class="form-group">
            <input type="hidden" name="email" value="<?= $_SESSION['email'] ?>">
          </div>
          <div class="form-group">
            <label for="complaint">Initial Complaint</label>
            <textarea class="form-control" id="complaint" name="complaint" cols="20" rows="5"></textarea>
          </div>

          <button class="btn btn-success" style="float: right;">Book Appointment</button>

        </form>
      </div>
    </div>
  </div>
</body>
</html>