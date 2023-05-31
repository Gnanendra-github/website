<?php
include('connection.php');

if (isset($_GET['flightNumber'])) {
                 $flightNumber = $_GET['flightNumber'];

          $sql = "DELETE FROM flight_details WHERE fnumber = '$flightNumber'";
        $result = mysqli_query($con, $sql);

            
            if ($result) {
                echo '<script type="text/javascript">';
                       echo 'alert("FLIGHT DELETED SUCCESSFULLY");';
                echo 'window.location.href="admin_view_flights.php";';
                    echo '</script>';
            } else {
                echo "Error deleting flight: " . mysqli_error($con);
            }
        } else {
                    echo "Invalid flight number.";
}


mysqli_close($con);
?>
