<?php
session_start();
if ($_SESSION['userSession'] == "" || $_SESSION['userSession'] == "none") {
    echo "null";
    header('Location: login.php');
} else {
    // connect to db
    $conn = mysqli_connect('localhost', 'will', 'will123', 'db');
    //check 
    if ($conn) {
        //echo $_SESSION['topic'];
        if ($_SESSION['topic'] == "none") {
            $q = "SELECT * FROM topics LIMIT 1";
            $r = mysqli_query($conn, $q);
            while ($row = $r->fetch_assoc()) {
                $_SESSION['topic'] = $row["topic"];
            }
        } else {
            // if($_SESSION['control'] != "activated"){
            //     $_SESSION['control'] = "";
            //     $_SESSION['topic'] = $_COOKIE["cookieTopic"];
            // }
            $_SESSION['topic'] = $_COOKIE["cookieTopic"];
        }

        //echo $_SESSION['topic'];

        $query = "SELECT * FROM topics";
        $result = mysqli_query($conn, $query);

        $query2 = "SELECT * FROM question_vault WHERE topic='" . $_SESSION['topic'] . "'";
        $result2 = mysqli_query($conn, $query2);
    } else {
        die("Connection failed: " . $conn->connect_error);
    }
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
    <script src="js/jquery.js"></script>
</head>

<body>
    <div class="left">
        <h2 align="center" style="color:white">Topics</h2>
        <a href="#popup1" style="text-decoration:none"><button id="link_button" class="custom_button center">+ Add topic</button></a>

        <div class="scrollable">

            <?php
            while ($row = $result->fetch_assoc()) {
                $exp = explode(" ", $row["topic"]);
                $exp_fullString = "";
                $exp_count = 0;
                foreach ($exp as $expItem) {
                    if ($exp_count == 0) {
                        $exp_fullString = $expItem;
                    } else {
                        $exp_fullString = $exp_fullString . "_" . $expItem;
                    }
                    $exp_count = $exp_count + 1;
                }
                ?>

                <img id=<?php echo $exp_fullString; ?> onclick="deleteTopic(id)" src="img/delete_white.png" alt="delete" style="width: 20px; height: 20px" class="pointer">
                <br />
                <div id=<?php echo $exp_fullString ?> class="custom_button_topic pointer" onclick="topicSwitch(id)" class="pointer">
                    <p><?php echo $row["topic"] ?></p>
                </div><br />
            <?php
            }
            ?>
        </div>
    </div>

    <div class="right">
        <button onclick="window.open('logout.php', '_top');">sign out</button>
        <h2 align="center">"<?php echo $_SESSION['topic'] ?>"</h2>

        <button class="custom_button" style="margin-left:20px; margin-top: 1px" onclick="openQuestionPage(id)">+ Add Question</button>

        <div class="scrollable">

            <table id="questions" style="margin-top: 16px; margin-left:8px">
                <tr>
                    <th>#</th>
                    <th>Question(s)</th>
                    <th>Response</th>
                </tr>
                <?php
                $count_holder = 0;
                while ($row = $result2->fetch_assoc()) {
                    $count_holder = $count_holder + 1
                    ?>
                    <tr id=<?php echo $row["topic"] ?> onclick="" class="pointer">
                        <td><?php echo $count_holder ?></td>
                        <td><?php echo $row["questions"]; ?></td>
                        <td><?php echo $row["response"]; ?></td>
						<td>
						<img id=<?php 
								$exp2 = explode(" ", $row["id"]);
								$exp2_fullString = "";
								$exp2_count = 0;
								foreach ($exp2 as $expItem2) {
									if ($exp2_count == 0) {
										$exp2_fullString = $expItem2;
									} else {
										$exp2_fullString = $exp2_fullString . "_" . $expItem2;
									}
									$exp2_count = $exp2_count + 1;
								};
							echo $exp2_fullString;?> onclick="deleteQuestion(id)" src="img/close_black.png" alt="delete" style="width: 20px; height: 20px" class="pointer">
						</td>
                    </tr>
                <?php
                }
                ?>
            </table>
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