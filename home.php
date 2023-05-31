<!DOCTYPE html>
<html>
<head>
  
  <title>Safe Airlines</title>
  <link rel="stylesheet" type="text/css" href="home.css">


</head>
<body class="content2">
  <div class="navigation-bar">
    <a href="home.php">Home</a>
    <a href="user_bookings.php">My Bookings</a>
   
    <a href="feedback.php">Give Feedback</a>
    <a href="admin_login.php">Admin</a>
    <a href="logout.php" class="right">Logout</a>

    <?php
  session_start(); 


  if(isset($_SESSION['user_id'])) {
    include('connection.php');
    
    $user_id = $_SESSION['user_id'];
    
   
    $stmt = $con->prepare("SELECT fname FROM users WHERE userid = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt_result = $stmt->get_result();
    
    if ($stmt_result->num_rows > 0) {
      $data = $stmt_result->fetch_assoc();
      $first_name = $data['fname'];
      echo '<a  class="right"> Welcome <span id="userFirstName" class="displayName">' . $first_name . '</span></a>';
    }
  }
  ?>

    
 
  </div>
                    <div class="oneway">
                      <h1>Round-Trip</h1>
                      <h4></h4>
                      <form class="input-details" action="search_flight.php" method="POST" onsubmit="return validateForm('round-trip');">

                        <div class="sidefor-fromto">
                            <div class="sidebyside">
                              <label for="round-from">From:</label>
                              <select id="round-from" name="source" required>
                                <option value="default" selected>Select location</option>
                                <option value="CHENNAI">CHENNAI</option>
                                <option value="MANGALORE">MANGALORE</option>
                                <option value="BANGALORE">BANGALORE</option>
                                <option value="BOMBAY">BOMBAY</option>
                                <option value="DELHI">DELHI</option>
                                <option value="SURAT">SURAT</option>
                              </select>
                            </div>
                          
                        
                        <div class="sidebyside">
                              <label for="round-to">To:</label>
                              <select id="round-to" name="destination" required>
                                <option value="default" selected>Select location</option>
                                <option value="CHENNAI">CHENNAI</option>
                                <option value="MANGALORE">MANGALORE</option>
                                <option value="BANGALORE">BANGALORE</option>
                                <option value="BOMBAY">BOMBAY</option>
                                <option value="DELHI">DELHI</option>
                                <option value="SURAT">SURAT</option>
                              </select>
                            </div>
                        </div>
          
      
          
            <label for="depart-date">Depart Date:</label>
            <input type="date" id="depart-date" name="depart-date" min="<?php echo date('Y-m-d'); ?>" required>
          
      
          
            <label for="return-date">Return Date:</label>
            <input type="date" id="return-date" name="return-date" min="<?php echo date('Y-m-d'); ?>" required>
          
      
          
            <label for="class">Class:</label>
            <select id="class" name="class" required>
              <option value="economy">Economy</option>
              <option value="business">Business</option>
              <option value="first-class">First Class</option>
            </select>
          
      
          
            <label for="passenger">Passengers:</label>
            <input type="number" id="passenger" name="passenger" min="1" max="3" required><br><br>
        
          
            <input type="submit" name="submit" id="submit" value="Search Flights">
         
        </form>
      </div>
      




  <div class="round-trip">
    <h1>Oneway</h1>
    
    <form class="input-details" action="search_flight.php " method="POST" onsubmit="return validateForm('oneway');">
        

                          <div class="sidefor-fromto">
                            <div class="sidebyside">
                              <label for="oneway-from">From:</label>
                              <select id="oneway-from" name="source" required>
                                <option value="default" selected>Select location</option>
                                <option value="CHENNAI">CHENNAI</option>
                                <option value="MANGALORE">MANGALORE</option>
                                <option value="BANGALORE">BANGALORE</option>
                                <option value="BOMBAY">BOMBAY</option>
                                <option value="DELHI">DELHI</option>
                                <option value="SURAT">SURAT</option>
                              </select>
                            </div>
      
    
                        <div class="sidebyside">
                              <label for="oneway-to">To:</label>
                              <select id="oneway-to" name="destination" required>
                                <option value="default" selected>Select location</option>
                                <option value="CHENNAI">CHENNAI</option>
                                <option value="MANGALORE">MANGALORE</option>
                                <option value="BANGALORE">BANGALORE</option>
                                <option value="BOMBAY">BOMBAY</option>
                                <option value="DELHI">DELHI</option>
                                <option value="SURAT">SURAT</option>
                            </select>
                          </div>
                      </div>



        <label for="depart-date">Depart Date:</label>
        <input type="date" id="depart-date" name="depart-date" min="<?php echo date('Y-m-d'); ?>" required>



        <label for="class">Class:</label>
        <select id="class" name="class" required>
        <option value="economy">Economy</option>
        <option value="business">Business</option>
        <option value="first-class">First Class</option>
        </select>

        <label for="passenger">Passengers:</label>
        <input type="number" id="passenger" name="passenger" min="1" max="3" required><br><br>

        <input type="submit" name="submit" id="submit" value="Search Flights">
    </form>
  
  </div>
  <script>
  function validateForm(formType) {
    var from, to;
    
    if (formType === 'round-trip') {
      from = document.getElementById("round-from").value;
      to = document.getElementById("round-to").value;
    } else if (formType === 'oneway') {
      from = document.getElementById("oneway-from").value;
      to = document.getElementById("oneway-to").value;
    }
    
    if (from === to) {
      alert("Error: 'From' and 'To' locations cannot be the same.");
      return false;
    }
    
    return true;
  }
</script>
</body>
</html>
