<?php
include ('connection.php');



if(isset($_POST['submit']))
{
    $PLANE_ID= $_POST['pnumber'];
    $PLANE_NAME = $_POST['pname'];
    $FROM=$_POST['from'];
    $TO=$_POST['to'];
    $DEPART_TIME=$_POST['depart-time'];
    $ARRIVAL_TIME=$_POST['arrival-time'];
    $DISTANCE=$_POST['distance'];
    $MAX_PASSENGERS=$_POST['passenger'];
    $FARE=$_POST['price'];

  
    $sql = "INSERT INTO `flight_details`(`fnumber`,`flight_name`,`source`,`destination`,`departure_time`,`arrival_time`,`total_seats`,`distance`,`fare`)
            VALUES ('$PLANE_ID','$PLANE_NAME','$FROM','$TO','$DEPART_TIME','$ARRIVAL_TIME',' $MAX_PASSENGERS','$DISTANCE$',' $FARE')";
    
    $result = mysqli_query($con, $sql);
    if($result) {
        echo '<script type="text/javascript">';
        echo 'alert("NEW FLIGHT ADDED SUCCESSFULLY");';
        echo 'window.location.href="admin_home.php";';
        echo '</script>';
    } else {
        die(mysqli_error($con));
    }
}
?>








<!DOCTYPE html>
<html>
<head>
  
  <title>ADMIN PANEL</title>
  <link rel="stylesheet" type="text/css" href="admin_home.css">


</head>
<body class="content2">
  <div class="navigation-bar">
    <a href="home.php">User Dashboard</a>
    <a href="admin_home.php">Admin Dashboard</a>
    <a href="admin_home.php">Add New Flight</a>
    <a href="admin_view_flights.php">View Flights</a>
    <a href="admin_view_bookings.php">View Bookings</a>


    <span id="userFirstName"></span>
    <a href="logout.php" class="right">Logout</a>
    <a href="admin_view_feedback.php" class="right">View Feedbacks</a>
 
  </div>


                    <div class="round-trip">
                      <h1>ADD FLIGHT</h1>
                      <h4></h4>
                      <form class="input-details" action="admin_home.php" method="POST">

                        <div class="sidefor-fromto">
                          <div class="sidebyside">
                        <label for="plane-id">Plane ID</label>
                        <input type="number" id="pnumber" name="pnumber" placeholder="Enter Plane ID" required>
                          </div>
                          <div class="sidebyside">
                          <label for="plane-name">Plane Name</label>
                          <input type="text" id="pname" name="pname" placeholder="Enter Plane name" required>

                        </div>
                      </div>



                        <div class="sidefor-fromto">
                            <div class="sidebyside">
                              <label for="from">From:</label>
                              <input type="text" id="from" name="from" placeholder="Enter Source" required><br><br>
                            </div>
                          
                        
                        <div class="sidebyside">
                              <label for="to">To:</label>
                              <input type="text" id="to" name="to" placeholder="Enter Destination" required><br>
                            </div>
                        </div>
          
                        <div class="sidefor-fromto">
                        <div class="sidebyside">
                          <label for="depart-time">Departure Time:</label>
                          <input type="datetime-local" id="depart-time" name="depart-time" min="<?php echo date('Y-m-d\TH:i', strtotime('+1 day')); ?>" required>
                        </div>
                        <div class="sidebyside">
                          <label for="arrival-time">Arrival Time:</label>
                          <input type="datetime-local" id="arrival-time" name="arrival-time" min="<?php echo date('Y-m-d\TH:i', strtotime('+1 day')); ?>" required>
                        </div>
                      </div>




                      <div class="sidefor-fromto">
                        <div class="sidebyside">
                        <label for="Distance">Distance</label>
                        <input type="number" id="distance" name="distance" placeholder="Enter  in Kilometers" required><br><br>
                    </div>
                    <div class="sidebyside">
                        <label for="passenger">No Of Passengers:</label>
                        <input type="number" id="passenger" name="passenger" placeholder="Maximun 60" min="30" max="60" required><br><br>
                      </div>
                    </div>


                    <div class="sidefor-fromto">
                      <div class="sidebyside">
                        <label for="fare">Fare</label>
                        <input type="number" id="fare" name="price" placeholder="Cost of Ticket" required><br><br>
                      </div>
                    </div>
                      
                        <input type="submit" name="submit" id="submit" value="Add Flight">
         
        </form>
      </div>
      
</body>
</html>
