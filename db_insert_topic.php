<?php
// GET USER ID
session_start();
if ($_SESSION['userSession'] == "" || $_SESSION['userSession'] == "none") {
    header('Location: login.php');
}

// connect to db
$conn = mysqli_connect('localhost', 'will', 'will123', 'db');

//check connection
if($conn){

    if ( isset($_POST['topic']) ){
       
        $sql = "INSERT INTO topics (topic, short_version) VALUES ('".$_POST['topic']."', 'not seet')";

        if (mysqli_query($conn, $sql)) {

            header('Location: admin.php');

        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        mysqli_close($conn);
    }
}
else{
    die("Connection failed: " . $conn->connect_error);
}
?>

