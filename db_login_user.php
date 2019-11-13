<?php
session_start();
if ($_SESSION['userSession'] == "") {
    header('Location: login.php');
}

// connect to database
$conn = mysqli_connect('localhost', 'will', 'will123', 'db');

//check connection
if ($conn) {

    // Check if the username and password is entered by user
    if (isset($_POST['username']) and isset($_POST['password'])) {

        // SQL query statment to get user details
        $query = "SELECT * FROM user WHERE institution='" . $_POST['username'] . "' AND password='" . $_POST['password'] . "'";

        // Connect to database and get the details of each record from database table
        $result = mysqli_query($conn, $query);

        // Get the number of records from table
        $count = mysqli_num_rows($result);

        // Check if only one record of the user exists
        if ($count == 1) {
            // Store username
            $_SESSION['userSession'] = mysqli_fetch_row($result)[0];

            if ($_POST['username'] == 'admin') {
                // Login and navigate to admin dasboard
                header('Location: superadmin.php');
            } else {
                // Login and navigate to admin dasboard
                header('Location: admin_manager.php');
            }
        } else {
            echo "incorrect password or username";
        }
    }
} else {
    die("Connection failed: " . $conn->connect_error);
}
