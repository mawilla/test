<?php
// GET USER ID
session_start();
if ($_SESSION['userSession'] == "" || $_SESSION['userSession'] == "none") {
    header('Location: login.php');
}
// connect to db
$conn = mysqli_connect('localhost', 'will', 'will123', 'db');

//check connection
if ($conn) {

    if (isset($_POST['questionA']) and isset($_POST['response'])) {

        $keyWordsArray = array();
        $index = 0;

        // create keyword holders
        $questionArray1 = array();
        $questionArray2 = array();
        //$questionArray3 = array();

        // create keywords
        $questionArray1 = explode(" ",  $_POST['questionA']);
        $questionArray2 = explode(" ",  $_POST['questionB']);
        //$questionArray3 = explode(" ",  $_POST['question3']);

        foreach ($questionArray1 as $questionA) {
            $index ++;
            foreach ($questionArray2 as $questionB) {
                if ($questionA == $questionB) {
                    $keyWordsArray[$index] = $questionA;
                }
            }
        }

        $keyWordString = "";
        foreach ($keyWordsArray as $keyword) {

            if ($keyWordString == "") {
                $keyWordString = $keyword;
            } else {
                $keyWordString = $keyWordString . "," . $keyword;
            }
        }

        $questions = $_POST['questionA'] . ";" . $_POST['questionB'];

        $sql = "INSERT INTO question_vault (topic, response, keywords, questions) VALUES ('".$_SESSION['topic']."', '" . $_POST['response'] . "', '" . $keyWordString . "', '" . $questions . "')";

        if (mysqli_query($conn, $sql)) {

            header('Location: admin.php');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
    }
} else {
    die("Connection failed: " . $conn->connect_error);
}
