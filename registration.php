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
			padding: 0%;
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
        <form action="registration-code.php" method="POST">
        <div class="form-group">
					<label>First Name</label> <br>
					<input type="text" name="fname" class="form-control" value="<?= !empty($_SESSION['fname']) ? $_SESSION['fname'] : ''?>" placeholder="First Name">
				</div>
				<div class="form-group">
					<label>Last Name</label> <br>
					<input type="text" name="lname" class="form-control" value="<?= !empty($_SESSION['lname']) ? $_SESSION['lname'] : ''?>" placeholder="Last Name">
				</div>

				<div class="form-group">
					<label>Email Address</label> <br>
					<input type="email" name="email" class="form-control" minlength="5" value="<?= !empty($_SESSION['email']) ? $_SESSION['email'] : ''?>" placeholder="Email Address">
				</div>

				<div class="form-group">
					<label>Password</label> <br>
					<input type="password" name="password" class="form-control" value="<?= !empty($_SESSION['email']) ? $_SESSION['email'] : ''?>" placeholder="Password">
				</div>

				<div class="form-group">
					<label>Gender</label> <br>
					<select name="gender" class="form-control">
						<option  
							<?php

								if((!empty($_SESSION['gender'])) && ($_SESSION['gender'] == 'male'))
									echo("selected")
							?>
						 value="male">Male</option>
						<option
						<?php

								if((!empty($_SESSION['gender'])) && ($_SESSION['gender'] == 'female'))
									echo("selected")
							?>
							 value="female">Female</option>
					</select>
				</div>
				<div class="form-group">
					<label>Designation</label> <br>
					<select name="designation" class="form-control">
						<option  
							<?php

								if((!empty($_SESSION['designation'])) && ($_SESSION['designation'] == 'medical_doctor'))
									echo("selected")
							?>
						 value="medical_team">Medical Team (MT)</option>
						<option
						<?php

								if((!empty($_SESSION['designation'])) && ($_SESSION['designation'] == 'patient'))
									echo("selected")
							?>
							 value="patient">Patient</option>
							 <option  
							<?php

								if((!empty($_SESSION['designation'])) && ($_SESSION['designation'] == 'super_admin'))
									echo("selected")
							?>
						 value="super_admin">Super Admin</option>
					</select>
				</div>
				<div class="form-group">
					<label>Department</label> <br>
					<select class="form-control" id="department" name="department">
                <option
								<?php

									if((!empty($_SESSION['department'])) && ($_SESSION['department'] == 'Neurology'))
										echo("selected")
									?>
								>Neurology</option>
                <option
								<?php

									if((!empty($_SESSION['department'])) && ($_SESSION['department'] == 'Cardiology'))
										echo("selected")
									?>
								>Cardiology</option>
                <option
								<?php

									if((!empty($_SESSION['department'])) && ($_SESSION['department'] == 'Emergency Care'))
										echo("selected")
									?>
								>Emergency Care</option>
                <option
								<?php

									if((!empty($_SESSION['department'])) && ($_SESSION['department'] == 'Intensive Care Unit'))
										echo("selected")
									?>
								>Intensive Care Unit</option>
            </select>
				</div>


				<button class="btn btn-primary">CREATE ACCOUNT</button>

				<div>&nbsp;</div>
				<a href="/phptask/login.php">Have an account? Log In Here</a>
        </form>
      </div>
    </div>
  </div>
</body>
</html>