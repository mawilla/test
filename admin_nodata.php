<?php
session_start();
if ($_SESSION['userSession'] == "" || $_SESSION['userSession'] == "none") {
    header('Location: login.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style/admin.css">
    <link rel="stylesheet" href="style/table.css">
    <link rel="stylesheet" href="style/login_form.css">
    <link rel="stylesheet" href="style/modal.css">
    <link rel="stylesheet" href="style/tabbed_layout.css">
</head>

<body>
    <div class="left">
        <br />
        <img src="img/chatbot.png" alt="" style="width 60px; height: 60px" class="center">
        <p align="center">Unam Assistant Chatbot</p>
    </div>

    <div class="right">
        <br />
        <button id="link_button" class="custom_button center"><a href="#popup1">Add topic</a></button>
        <br />

        <h2 align="center">Welcome to Unam Assistant Chatbot</h2><br>

        <p align="center">Your chatbot has no conversations in its Knowladgebase. </p>
        <p align="center">Let's setup the bot by following the instructions below</p>
        <br>
        <div style="margin-left:32px">
            <ol>
                <li>Topic
                    <p>Allows you to organize your converstions into catgeories 
                        <br>or knowledge area of your choice. Click on "Add topic"
                    </p>
                </li>
                <li>Question
                    <p>Allows you create a conversation with a question and a response of your choice. 
                        <br>Click on "Add Question" which appears after you add a topic
                    </p>
                </li>
            </ol>
        </div>


    </div>

    <!-- Dialog -->
    <div id="popup1" class="overlay">
        <div class="popup">
            <h2>New Topic</h2>
            <a class="close" href="#">&times;</a>
            <div>
                <form action="db_insert_topic.php" method="POST">
                    <label for="topic">Topic name:</label><br />
                    <input id="valueText" type="text" name="topic"><br />
                    <label for="lname"></label><br />

                    <input type="submit" class="yes" value="Save"></a>
                </form>
            </div>

        </div>
    </div>
    <!-- JavaScripts *start*-->
    <script src="js/view_details.js"></script>
    <script src="js/tabs.js"></script>
</body>

</html>