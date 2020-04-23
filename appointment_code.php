<?php
  session_start();
  $date = $_POST['date'];
  $time = $_POST['time'];
  $nature = $_POST['nature'];
  $department = $_POST['department'];
  $complaint = $_POST['complaint'];
  $email = $_POST['email'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];

  $scandir = scandir('appointments');
  if (count($scandir) == 2) {
    $id = 1;
  } else if(count($scandir) > 2) {
    $id = ((count($scandir) - 1));
  };

  //remove all the space in between the department name and replace them with ' - '
  $split = str_replace(' ','-', $department);

  // initialize an empty array to hold the value of number prefixes before the names of appointments
  $numbers = [];

  for ($i = 2; $i < count($scandir); $i++) {
    // remove the first two letters in front of database appointment name
    $newscandir = substr($scandir[$i],2);
    // remove the last .json extension
    $newscandir = substr($newscandir,0, -5);

    //compare what we have in database to what is coming in
    if ($newscandir === $split) {
      // since we have the one with the same department as the incoming department, collect the first number in front of them
      $new_count = substr($scandir[$i],0,1);

      // push the numbers into the initialized numbers array
      array_push($numbers,$new_count);
    }
    
  }
  //find the largest number in the array and add it up
  $largest_number = (max($numbers));
  // add 1 to the largest number so we can save it in the database
  $new_number = $largest_number++;

  $data = [
    'id' => $id,
    'first_name' => $fname,
    'last_name' => $lname,
    'sender' => $email,
    'date' => $date,
    'time' => $time,
    'nature' => $nature,
    'department' => $department,
    'complaint' => $complaint,
  ];
  file_put_contents('appointments/'.$largest_number.'-'.$split.'.json', json_encode($data));
  $_SESSION['success'] = 'Appointment booked successfully';
  header('location: patientdashboard.php');

?>