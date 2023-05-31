<!DOCTYPE html>
<html>
<head>
  <title>ALL FEEDBACKS</title>
  <link rel="stylesheet" type="text/css" href="admin_view_feedback.css">
</head>
<body class="content1">
<div class="navigation-bar">
    <a href="home.php">User Dashboard</a>
    <a href="admin_home.php">Admin Dashboard</a>
    <a href="admin_home.php">Add New Flight</a>
    <a href="admin_view_flights.php">View Flights</a>
    <a href="admin_view_bookings.php">View Bookings</a>
    <a href="logout.php" class="right">Logout</a>
    <a href="admin_view_feedback.php" class="right">View Feedbacks</a>
  </div>

  <div class="display_results">
    <?php
    include('connection.php');

 
    $sql = "SELECT * FROM feedback";
    $result = mysqli_query($con, $sql);

    
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>Feedback ID</th>";
        echo "<th>User Name</th>";
        echo "<th>User ID</th>";
        echo "<th>Description</th>";
        echo "</tr>";

       
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['feedbackid'] . "</td>";
            echo "<td>" . $row['fname'] . "</td>";
            echo "<td>" . $row['userid'] . "</td>";
            echo "<td>" . $row['feedbackdata'] . "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "No feedbacks found.";
    }

    mysqli_close($con);
    ?>
  </div>
</body>
</html>
