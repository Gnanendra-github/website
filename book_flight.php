<?php
include('connection.php');


session_start(); 


if(isset($_SESSION['user_id'])) {
  include('connection.php');
  
  $user_id = $_SESSION['user_id'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $flightNumber = $_POST['flightNumber'];
  $source = $_POST['source'];
  $destination = $_POST['destination'];
  $fare=$_POST['fare'];

  
  $USERID = $_SESSION['user_id'];
  $PNR_NO = rand(4000, 5000);
  $SEAT_NO = rand(1, 60);
  

  $sql = "INSERT INTO `ticket`(`userid`, `pnr_no`, `fnumber`, `seat_no`, `fare`)
          VALUES ('$USERID', '$PNR_NO', '$flightNumber', '$SEAT_NO', '$fare')";
  mysqli_query($con, $sql);

  
  if (mysqli_error($con)) {
    echo "Error: " . mysqli_error($con);
  } else {
    echo "Success";
  }
}
?>
