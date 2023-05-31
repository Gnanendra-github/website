<!DOCTYPE html>
<html>
<head>
  
  <title>ALL FLIGHTS</title>
  <link rel="stylesheet" type="text/css" href="admin_view_flights.css">


</head>
<body class="content1">
<div class="navigation-bar">
    <a href="home.php">User Dashboard</a>
    <a href="admin_home.php">Admin Dashboard</a>
    <a href="admin_home.php">Add New Flight</a>
    <a href="admin_view_flights.php">View Flights</a>
    <a href="admin_view_bookings.php">View Bookings</a>


    <span id="userFirstName"></span>
    <a href="logout.php" class="right">Logout</a>
    <a href="admin_view_feedback.php " class="right">View Feedbacks</a>
 
  </div>

  <div class="display_results">
  <h1> Available Flights</h1>
  <?php
include('connection.php');

$sql = "SELECT * FROM flight_details";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    echo "<table>";
    echo "<tr>";
    echo "<th>Flight Number</th>";
    echo "<th>Airline Name</th>";
    echo "<th>Source</th>";
    echo "<th>Destination</th>";
    echo "<th>Departure</th>";
    echo "<th>Arrival</th>";
    echo "<th>Status</th>";
    echo "<th>Fare</th>";
    echo "<th>Action</th>";
    echo "</tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['fnumber'] . "</td>";
        echo "<td>" . $row['flight_name'] . "</td>";
        echo "<td>" . $row['source'] . "</td>";
        echo "<td>" . $row['destination'] . "</td>";
        echo "<td>" . $row['departure_time'] . "</td>";
        echo "<td>" . $row['arrival_time'] . "</td>";
        
        $departureDate = strtotime($row['departure_time']);
        $currentDate = strtotime(date('Y-m-d H:i:s'));
        
        if ($departureDate > $currentDate + (24 * 60 * 60)) {
            echo "<td>Not Departed</td>";
        } elseif ($departureDate >= $currentDate) {
            echo "<td>Starting Soon</td>";
        } else {
            echo "<td>Already Departed</td>";
        }
        
        echo "<td>" . $row['fare'] . "</td>";
        echo "<td><a href='admin_delete_flight.php?flightNumber=" . $row['fnumber'] . "'>Delete</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No flights found.";
}

mysqli_close($con);
?>



   
  </div>
</body>
</html>
