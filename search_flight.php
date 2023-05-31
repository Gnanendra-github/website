<!DOCTYPE html>
<html>
<head>
  <title>Searching Flights</title>
  <link rel="stylesheet" type="text/css" href="search_flight.css">
</head>
<body class="content1">
<div class="navigation-bar">
  <a href="home.php">Home</a>
  <a href="user_bookings.php">My Bookings</a>
  <a href="feedback.php">Give Feedback</a>
  <a href="logout.php" class="right">Logout</a>
</div>

<div class="display_results">
  <?php
  include('connection.php');
  session_start(); 

 
  if (isset($_SESSION['user_id'])) {
    include('connection.php');
    $user_id = $_SESSION['user_id'];
  }

  if (isset($_POST['submit'])) {
    $source = $_POST['source'];
    $destination = $_POST['destination'];
    $dep_date = $_POST['depart-date'];

    $sql = "SELECT * FROM flight_details WHERE source = '$source' AND destination = '$destination' AND DATE(departure_time) = '$dep_date'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo "<h1>" . $source . " to " . $destination . "</h1>";
      echo "<table>";
      echo "<tr>";
      echo "<th>Airline Number</th>";
      echo "<th>Airline Name</th>";
      echo "<th>Departure</th>";
      echo "<th>Arrival</th>";
      echo "<th>Status</th>";
      echo "<th>Fare</th>";
      echo "<th>Book</th>";
      echo "</tr>";

      while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['fnumber'] . "</td>";
        echo "<td>" . $row['flight_name'] . "</td>";
        echo "<td>" . $row['departure_time'] . "</td>";
        echo "<td>" . $row['arrival_time'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>" . $row['fare'] . "</td>";
        echo "<td><button onclick='confirmBooking(" . $row['fnumber'] . ", \"$source\", \"$destination\", " . $row['fare'] . ")'>Buy</button></td>";
        echo "</tr>";
      }

      echo "</table>";
    } else {
      echo "<h1>No flights found for the given source, destination, and date.</h1>";
    }
  }
  ?>

  <script>
    function confirmBooking(flightNumber, source, destination, fare) {
      var confirmed = confirm("Are you sure you want to book this flight from " + source + " to " + destination + "?");

      if (confirmed) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            alert("Flight booked successfully!");
            window.location.href = "user_bookings.php";
          }
        };
        xhttp.open("POST", "book_flight.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("flightNumber=" + flightNumber + "&source=" + source + "&destination=" + destination + "&fare=" + fare);
      }
    }
  </script>
</div>
</body>
</html>
