<?php
session_start();
if ($_SESSION['userSession'] == "" || $_SESSION['userSession'] == "none") {
    header('Location: login.php');
} else {
    // connect to db
    $conn = mysqli_connect('localhost', 'will', 'will123', 'db');
    //check connection
    if ($conn) {

        $query = "SELECT * FROM topics";
        $result = mysqli_query($conn, $query);

         // Check if only one record of the user exists
         if (mysqli_num_rows($result) > 0) { 
             header('Location: admin.php');
         } 
         else {
            header('Location: admin_nodata.php');
         }
    } else {
        die("Connection failed: " . $conn->connect_error);
    }
}
