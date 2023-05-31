<!DOCTYPE html>
<html>
<head>
  <title>ALL FLIGHTS</title>
  <link rel="stylesheet" type="text/css" href="admin_view_bookings2.css">

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

  <div class="input-box">
  <form class="input-details" action="admin_view_bookings2.php" method="POST">
      <div class="sidefor-fromto">
        <div class="sidebyside">
          <label>Enter flight number</label>
          <input type="text" name="flightno" required placeholder="Flight No"><br>
        </div>
        <div class="sidebyside">
          <label>Select Date</label>
          <input type="date" name="date" required placeholder="Select Data"><br><br>
        </div>
      </div>
      <input type="submit" value="Search">
    </form>

  </div>

  <div class="display_flights">

  <h1>Bookings</h1>
    <?php
    include('connection.php');

    if (isset($_POST['flightno']) && isset($_POST['date'])) {
        $flightNo = $_POST['flightno'];
        $date = $_POST['date'];

        $sql = "SELECT t.fnumber,t.pnr_no, u.fname, fd.fare, fd.source, fd.destination, fd.departure_time, fd.arrival_time
                FROM ticket t
                JOIN users u ON t.userid = u.userid
                JOIN flight_details fd ON t.fnumber = fd.fnumber
                WHERE t.fnumber = '$flightNo' AND DATE(fd.departure_time) = '$date'";

        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr>";
            echo "<th>Flight Number</th>";
            echo "<th>PNR Number</th>";
            echo "<th>User Name</th>";
            echo "<th>Fare</th>";
            echo "<th>Source</th>";
            echo "<th>Destination</th>";
            echo "<th>Departure</th>";
            echo "<th>Arrival</th>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['fnumber'] . "</td>";
                echo "<td>" . $row['pnr_no'] . "</td>";
                echo "<td>" . $row['fname'] . "</td>";
                echo "<td>" . $row['fare'] . "</td>";
                echo "<td>" . $row['source'] . "</td>";
                echo "<td>" . $row['destination'] . "</td>";
                echo "<td>" . $row['arrival_time'] . "</td>";
                echo "<td>" . $row['departure_time'] . "</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No bookings found.";
        }
    } else {
        echo "Please enter flight number and date.";
    }

    mysqli_close($con);
    ?>

  </div>

 
    

  </div>
</body>
</html>
