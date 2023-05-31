<?php
include ('connection.php');
if(isset($_POST['submit'])){
  $EMAIL=$_POST['email'];
  $PASSWORD=$_POST['password'];

  $stmt=$con->prepare("select * from users where email= ?");
  $stmt->bind_param("s",$EMAIL);
  $stmt->execute();
  $stmt_result=$stmt->get_result();
  if($stmt_result->num_rows>0){
      $data=$stmt_result->fetch_assoc();
      if($data['password']===$PASSWORD){



        $user_id = $data['userid']; 
        $fname = $data['fname']; 
        session_start();
        $_SESSION['user_id'] = $user_id;
        $_SESSION['fname_user'] = $fname;

        echo '<script type="text/javascript">';
        echo 'alert("LOGIN SUCCESSFUL");';
        echo 'window.location.href="home.php";';
        echo '</script>';
        exit();

        
        }else{
        echo '<script type="text/javascript">';
        echo 'alert("INVALID EMAIL OR PASSWORD");';
        echo 'window.location.href="login.php";';
        echo '</script>';
      
      }

  }else{
 
  }
}
?>


<!DOCTYPE html>
<html>
<head>
  
  <title>LOGIN</title>
  <link rel="stylesheet" type="text/css" href="login.css">


</head>
<body class="content3">
  <div class="navbar">
    <a href="#">Home</a>
    <a href="#">About</a>
    <a href="register.php" class="right">New User?</a>
  </div>

  <div class="login">
    <h1>Login</h1>
    <h4></h4>
    <form class="input-details" action="login.php" method="POST">

      <label>Email</label>
      <input type="email" name="email" required placeholder="ENTER YOUR EMAIL"><br>



      <label>Password</label>
      <input type="password" name="password" required placeholder="PASSWORD"><br><br>

      <input type="submit" name="submit" id="submit" value="Login">
    </form>
  
  </div>
</body>
</html>
