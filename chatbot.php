<?php
session_start();
// connect to db
$conn = mysqli_connect('localhost', 'will', 'will123', 'db');
//check connection
if ($conn) {

    $query = "SELECT topic, response, keywords FROM question_vault";
    $result = mysqli_query($conn, $query);

    $index = 0;
    $registrationQuestionsAnswer = array();
    $fullObj = "";
    while ($row = $result->fetch_assoc()) {
        $topic = $row["topic"];
        $response = $row["response"];
        $qkeyWords = $row["keywords"];
        $fullObj = $topic . ";" . $response . ";" . $qkeyWords;
        $registrationQuestionsAnswer[$index] = $fullObj . "&";
        $index = $index + 1;
    }
    //last index
    if ($fullObj != "") {
        $registrationQuestionsAnswer[$index - 1] = $fullObj;
    }

    //$converted = json_encode($registrationQuestionsAnswer);
} else {
    die("Connection failed: " . $conn->connect_error);
}
?>

<html>

<head>
    <title>Unam Assistant Chatbot</title>
    <link rel="stylesheet" href="style/chatbot_window.css">
    <link rel="stylesheet" href="style/chatbotUI.css">
</head>

<body>

    <var id="myVar" style="display:none"><?php echo json_encode($registrationQuestionsAnswer) ?></var>

    <!-- The Modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <!-- <span id="close" class="close">&times;</span> -->
                <h3>Unam Assistant</h3>
            </div>
            <div class="modal-body" id="contentDivScroll">
                <!-- bot chat message -->
                <div class="conversation_outerbox" id="bot0">
                    <div class="image_round_frame">
                        <img src="img/chatbot.png" alt="unam assistant" style="width: 34px; height: 30px; margin: 5px 5px">
                    </div><br>
                    <p id="botReply" class="conversation_box bot_box_color">Hello. How can I assist you?</p>
                    <p id="date" class="bot_time_stamp"></p>
                </div>

                <!-- user -->
                <div class="conversation_outerbox" name="us" id="user0" style="display:none">
                    <div class="image_round_frame push_right">
                        <img src="img/profile.png" alt="unam assistant" style="width: 30px; height: 30px; margin: 5px 5px">
                    </div><br>
                    <p class="conversation_box user_box_color"></p>
                    <span class="user_time_stamp"></span>
                    <br>
                    <!-- conversation animation -->
                    <div class="botReplyLoading">
                        <img src="img/chatbot.png" alt="unam assistant" style="width: 25px; height: 20px">
                        <br><img src="img/bot_chat_loader.gif" alt="unam assistant" style="width: 100px; height: 35px; margin-top:0px">
                    </div>
                </div>

            </div>

            <!-- footer -->
            <div class="modal-footer">
                <div class="containerFooter">
                    <!-- <textarea name="Text1" cols="80" rows="3" id="myMessage" style="width:75%;"></textarea> -->
                    <input type="text" id="message" class="input_message_field" name="message" placeholder="Your message..." style="width:75%;">
                    <!-- <button class="send_message_button" type="button" onclick="addUserConversation()">Send ></button> -->
                </div>
                <!-- <span id="close" class="closeChat" style="position: fixed; bottom: 6px: right: 5px">&times;</span> -->
            </div>
        </div>

    </div>

    <!-- Launch button -->
    <!-- <button class="roundButton" onclick="openModal()">Bot...</button> -->
    <img id="botButton" src="img/chatbot.png" class="roundButton" onclick="openModal()" alt="unam assistant bot.." style="width: 40px; height: 35px; margin: 5px 5px">

    <script src="js/conversation.js"></script>
</body>

</html>