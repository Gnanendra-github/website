<!DOCTYPE html>
<html>
<head>
  <title>ALL FLIGHTS</title>
  <link rel="stylesheet" type="text/css" href="admin_view_bookings.css">
</head>
<body class="content1">
<div class="navigation-bar">
    <a href="home.php">Home</a>
    <a href="user_bookings.php">My Bookings</a>
    <a href="#">Information</a>
    <a href="feedback.php"> Give Feedback</a>
    <a href="admin_login.php">Admin</a>
    <a href="logout.php" class="right">Logout</a>
  </div>

  <div class="display_results">
    <?php
    include('connection.php');
    session_start(); 
    if(isset($_SESSION['user_id'])) {
      $user_id = $_SESSION['user_id'];
    }

    $sql = "SELECT t.fnumber, t.pnr_no, u.fname, fd.fare, fd.source, fd.destination, fd.departure_time, fd.arrival_time
            FROM ticket t
            JOIN users u ON t.userid = u.userid
            JOIN flight_details fd ON t.fnumber = fd.fnumber
            WHERE t.userid = $user_id";

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
      echo "<th>Trip</th>";
      echo "</tr>";

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['fnumber'] . "</td>";
        echo "<td>" . $row['pnr_no'] . "</td>";
        echo "<td>" . $row['fname'] . "</td>";
        echo "<td>" . $row['fare'] . "</td>";
        echo "<td>" . $row['source'] . "</td>";
        echo "<td>" . $row['destination'] . "</td>";
        echo "<td>" . $row['departure_time'] . "</td>";
        echo "<td>" . $row['arrival_time'] . "</td>";

        
        $departureDate = strtotime($row['departure_time']);
        $currentDate = time();
        $tripStatus = ($departureDate > $currentDate) ? "Upcoming Trip" : "Completed Journey";
        
        echo "<td>" . $tripStatus . "</td>";
        echo "</tr>";
      }

      echo "</table>";
    } else {
      echo "No bookings found.";
    }

    mysqli_close($con);
    ?>
  </div>
</body>
</html>
