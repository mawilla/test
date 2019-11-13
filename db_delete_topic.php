<?php
session_start();
if ($_SESSION['userSession'] == "" || $_SESSION['userSession'] == "none") {
    header('Location: login.php');
}

// connect to db
$conn = mysqli_connect('localhost', 'will', 'will123', 'db');

//check connection
if($conn){

    $sql = "DELETE FROM topics WHERE topic ='" . $_COOKIE["cookieTopic"] . "'";
    $sql2 = "DELETE FROM question_vault WHERE topic ='" . $_COOKIE["cookieTopic"] . "'";

    if(mysqli_query($conn, $sql)){
        mysqli_query($conn, $sql2);
        $_SESSION['topic'] = "none";


        header('Location: admin_manager.php');
    }
}
else{
    die("Connection failed: " . $conn->connect_error);
}
?>