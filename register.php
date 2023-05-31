<?php
include ('connection.php');

function generateUniqueUserID() {
    global $con;
    $query = "SELECT MAX(userid) AS max_id FROM users";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    $maxID = $row['max_id'];
    $newID = $maxID + 1;
  
    return $newID;
}

if(isset($_POST['submit']))
{
    $USERID = generateUniqueUserID();
    $FNAME = $_POST['first_name'];
    $LNAME = $_POST['last_name'];
    $EMAIL = $_POST['email'];
    $PHONE = $_POST['pnumber'];
    $DOB = $_POST['dateofbirth'];
    $ADDRESS = $_POST['address'];
    $COUNTRY = $_POST['country'];
    $GENDER = $_POST['gender'];
    $CREATE_PASSWORD = $_POST['cpassword'];
  
    $sql = "INSERT INTO `users`(`userid`,`fname`, `lname`, `email`, `phone_no`,`date_of_birth`,`address`,`country`,`gender`, `password`)
            VALUES ('$USERID','$FNAME','$LNAME','$EMAIL','$PHONE','$DOB','$ADDRESS','$COUNTRY','$GENDER','$CREATE_PASSWORD')";
    
    $result = mysqli_query($con, $sql);
    if($result) {
        echo '<script type="text/javascript">';
        echo 'alert("YOUR REGISTRATION IS SUCCESS");';
        echo 'window.location.href="login.php";';
        echo '</script>';
    } else {
        die(mysqli_error($con));
    }
}
?>


<!DOCTYPE html>
<html>
<head>
  
  <title>Registration</title>
  <link rel="stylesheet" type="text/css" href="register.css">


</head>
<body class="content1">
  <div class="navigation-bar">
    <a href="#">Home</a>
    <a href="#">About</a>
    <a href="login.php" class="right">Login</a>
  </div>

  <div class="register">
    <h1>Sign Up</h1>
    <h4></h4>
    <form class="input-details" action="register.php" method="POST">
      <div class="sidefor-fromto">
        <div class="sidebyside">
      <label>First Name</label>
      <input type="text" name="first_name" required placeholder="FIRST NAME"><br>
        </div>
      <div class="sidebyside">
      <label>Last Name</label>
      <input type="text" name="last_name" required placeholder="LAST NAME"><br>
        </div>
      </div>


      <div class="sidefor-fromto">
        <div class="sidebyside">
      <label>Email</label>
      <input type="email" name="email" required placeholder="ENTER YOUR EMAIL"><br>
        </div>
        <div class="sidebyside">
      <label>Phone Number</label>
      <input type="number" name="pnumber" required placeholder="ENTER YOUR NUMBER"><br>
        </div>
        </div>


      <label>Date of birth</label>
      <input type="date" name="dateofbirth" required placeholder="ENTER YOUR DOB"><br>

      <div class="sidefor-fromto">
        <div class="sidebyside">
      <label>Address</label>
      <input type="text" name="address" required placeholder="Address"><br>
      </div>
      <div class="sidebyside">
      <label>Country</label>
      <input type="text" name="country" required placeholder="Country"><br>
      </div>
      </div>

      <div class="sidefor-fromto">
        <div class="sidebyside">
          <label>Gender</label>
          <select name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
          </select>
        </div>
      </div>

      <div class="sidefor-fromto">
        <div class="sidebyside">
      <label>Password</label>
      <input type="password" name="password" required placeholder="PASSWORD"><br>
      </div>
      <div class="sidebyside">
      <label>Confirm Password</label>
      <input type="password" name="cpassword" required placeholder="CONFIRM PASSWORD"><br><br><br>
      </div>
      </div>


      <input type="submit" name="submit" id="submit" value="Register">
    </form>
  
  </div>
</body>
</html>
