<?php

// connect to db
$conn = mysqli_connect('localhost', 'will', 'will123', 'db');

if (isset($_POST['password']) && isset($_POST['confirm_password'])) {

    if ($_POST['password'] == $_POST['confirm_password']) {

        //check connection
        if ($conn) {
            if (isset($_POST['institutionName']) && isset($_POST['confirm_password'])) {

                $password_ = strtolower($_POST['confirm_password']);
                $institution_name = strtolower($_POST['institutionName']);

                $sql = "INSERT INTO user (username, password,institution) VALUES ('$institution_name', '$password_','$institution_name')";

                if (mysqli_query($conn, $sql)) {

                    // $message = "Thank you for registering with Unam Assistant Chatbot";
                    // echo "<script type='text/javascript'>alert('$message');</script>";
                    header('Location: login.php');
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }

                mysqli_close($conn);
            }
        } else {
            die("Connection failed: " . $conn->connect_error);
        }
    } else {
        $msg = "Password does not match!";

//         print '<div>Are you sure? <input type="submit" name="del_confirm" value="yes!" formaction="action.php" />
// <input type="submit" name="del_no" value="no!" formaction="<addresstothispage>" />';

        //echo '<script type="text/javascript">alert("' . $msg . '")</script>';
        echo '<script type="text/javascript">if (confirm("' . $msg . '")) {
            // Save it!
            window.open(\'registration.php\', \'_top\');
        } else {
            window.open(\'registration.php\', \'_top\');
        }</script>';

        
        //header('Location: registration.php');
    }
}
