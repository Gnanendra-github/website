<?php
include ('connection.php');


if(isset($_POST['submit'])){
  $PHNO=$_POST['phno'];
  $PASSWORD=$_POST['password'];

  $stmt=$con->prepare("select * from admin where phno= ?");
  $stmt->bind_param("s",$PHNO);
  $stmt->execute();
  $stmt_result=$stmt->get_result();
  if($stmt_result->num_rows>0){
      $data=$stmt_result->fetch_assoc();
      if($data['password']===$PASSWORD){
        echo '<script type="text/javascript">';
        echo 'alert("LOGGED IN SUCCESSFULLY");';
        echo 'window.location.href="admin_home.php";';
        echo '</script>';
        }else{
        echo '<script type="text/javascript">';
        echo 'alert("INVALID EMAIL OR PASSWORD");';
        echo 'window.location.href="admin_login.php";';
        echo '</script>';
      
      }

  }else{
 
  }
}
?>






<!DOCTYPE html>
<html>
<head>
  
  <title>ADMIN</title>
  <link rel="stylesheet" type="text/css" href="login.css">


</head>
<body class="content3">
  <div class="navbar">
    <a href="home.php">Home</a>
  
  </div>

  <div class="login">
    <h1>ADMIN</h1>
    <h4></h4>
    <form class="input-details" action="admin_login.php" method="POST">

      <label>Phone Number</label>
      <input type="number" name="phno" required placeholder="ENTER YOUR PHONE NO"><br>



      <label>Password</label>
      <input type="password" name="password" required placeholder="PASSWORD"><br><br>

      <input type="submit" name="submit" id="submit" value="Admin Login">
    </form>
  
  </div>
</body>
</html>
