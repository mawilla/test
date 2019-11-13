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
    <link rel="stylesheet" href="style/questionForm.css">
</head>

<body>
    <div class="left">
        <br />
        <img src="img/back.png" style="width: 35px; height: 35px; margin-left: 40%" alt="" onclick="window.open('util.php', '_top');">
        <br /><hr>
        <P style="margin: 16px; color:white" align="center">
            This Section allows the administartor to add questions and corresponding answer
        </P><br>
        <h3 style="margin: 16px; color:white">
            Steps
        </h3>
        <ol style="color:yellow;margin: 14px">
            <li>Enter the question in the first provided text field</li><br>
            <li>Rephrase the question differently in second text field</li><br>
            <li>Enter the expected anser to the question</li>
        </ol>
    </div>
    <br>

    <div class="right">
        <br />
        <h2 style="margin-left: 16px">"<?php echo $_SESSION['topic']; ?>"</h2>
        <br />

        <div class="container">
            <form action="db_insert_question.php" method="POST">
                <div class="row">
                    <div class="col-25">
                        <label for="questionA">Question</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="questionA" name="questionA" placeholder="question..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="questionB">Question</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="questionB" name="questionB" placeholder="question asked differently..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="subject">Response / Answer</label>
                    </div>
                    <div class="col-75">
                        <textarea id="subject" name="response" placeholder="your something.." style="height:200px"></textarea>
                    </div>
                </div>
                <div class="row">
                    <input type="submit" value="Submit">
                </div>
            </form>
        </div>

    </div>

    <!-- JavaScripts *start*-->
    <script src="js/view_details.js"></script>
    <script src="js/tabs.js"></script>
</body>

</html>