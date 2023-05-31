<?php
include('connection.php');

if (isset($_POST['submit'])) {
    session_start();
    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        $stmt = $con->prepare("SELECT fname FROM users WHERE userid = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt_result = $stmt->get_result();

        if ($stmt_result->num_rows > 0) {
            $data = $stmt_result->fetch_assoc();
            $fname = $data['fname'];
        }
    }

    $feedbackid = generateUniquefeedbackID();
    $feedbackdata = $_POST['feedback'];

    $sql = "INSERT INTO feedback (feedbackid, userid, fname, feedbackdata)
            VALUES ('$feedbackid', '$user_id', '$fname', '$feedbackdata')";

    $result = mysqli_query($con, $sql);
    if ($result) {
        echo '<script type="text/javascript">';
        echo 'alert("Your feedback has been submitted successfully!");';
        echo 'window.location.href="home.php";';
        echo '</script>';
    } else {
        die(mysqli_error($con));
    }
}

function generateUniquefeedbackID()
{
    global $con;
    $query = "SELECT MAX(feedbackid) AS max_id FROM feedback";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $maxID = $row['max_id'];
    $newID = $maxID + 1;

    return $newID;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>FEEDBACK</title>
  <link rel="stylesheet" type="text/css" href="feedback.css">
</head>
<body class="content1">
  <div class="navigation-bar">
    <a href="home.php">Home</a>
    <a href="user_bookings.php">My Bookings</a>
    
    <a href="feedback.php">Give Feedback</a>
    <a href="admin_login.php">Admin</a>
    <a href="logout.php" class="right">Logout</a>
  </div>

  <div class="register">
    <h1>FEEDBACK</h1>
    <form class="input-details" action="feedback.php" method="POST">
      <textarea name="feedback" required placeholder="Give Your Valuable Feedback"></textarea><br><br>
      <input type="submit" name="submit" id="submit" value="Submit Feedback">
    </form>
  </div>
</body>
</html>
