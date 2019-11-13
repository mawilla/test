<?php
session_start();
$_SESSION['module_id_post'] = "none";
// connect to db
$conn = mysqli_connect('localhost', 'vincent', 'test1234', 'codecolab_db');
//check connection
if ($conn) {
    // This block of code gets all module ids asscoited with current user
    $query_moduleIds = "SELECT DISTINCT * FROM user_module WHERE user_id = '" .$_SESSION['loggedin']. "'";
    $result_moduleIds = mysqli_query($conn, $query_moduleIds);

    $moduleIds = array();
    $counter = 0;
    while ($row_Ids = $result_moduleIds->fetch_assoc()) {
        $moduleIds[$counter] = $row_Ids['module_id'];
        $counter = $counter + 1;
    }

    // This block of code uses the acquired ids from above code to get
    // the module records associated with the current user
    $counter = 0;
    $modules = array();
    foreach ($moduleIds as $mId) {
        $query_modules = "SELECT DISTINCT * FROM module WHERE module_id = '" . $mId . "'";
        $modules[$counter] = mysqli_query($conn, $query_modules);
        $counter = $counter + 1;
    }

    // this block of sets all acquired module record details from query type to approprite array type
    // for easy accessibilty and usage
    $counter = 0;
    $userModules = array();
    foreach ($modules as $module_unpacked) {
        //echo "print";

        while ($row = mysqli_fetch_array($module_unpacked)) {
            $userModules[$counter] = $row;
        }
        $counter = $counter + 1;
    }

} else {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dasboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/module_card.css">
    <link rel="stylesheet" href="css/modal.css">
</head>

<body>
    <!-- LEFT SIDE OF DASBOARD -->
    <div class="dashboard_left lecturer_dashb">
        <div class="top_nav shadow_bottom">
            <p class="push_left"><a href="#">logout</a></p>
        </div>

        <div class="center round" id="profile_div">
            <img src="img/man.png" alt="Avatar" class="center large_image_size" style="padding-top: 30px">
            <p align="center">Professor X</p>
        </div>


        <!-- left navigation buttons -->
        <button class="dashboard_button lecturer_dashb selected pointer" onclick=""><img src="img/module.png" alt="Avatar" class="center small_image_size push_left">Modules</button>
        <button class="dashboard_button lecturer_dashb pointer" onclick="window.open('lecturer_posts.php', '_top');">
            <img src="img/post.png" alt="Avatar" class="center small_image_size push_left">Posts</button>
        <button class="dashboard_button lecturer_dashb pointer" onclick="">
            <img src="img/chatroom.png" alt="Avatar" class="center small_image_size push_left">Chat rooms</button>
        <button class="dashboard_button lecturer_dashb pointer" onclick="window.open('lecturer_students.php', '_top');"> <img src="img/students.png" alt="Avatar" class="small_image_size push_left">Students</button>
    </div>

    <!-- RIGHT SIDE OF DASHBOARD -->
    <div class="dashboard_right">
        <!-- Hidden top nav, only show in mobile device size -->
        <div class="top_nav profile_background  menu_bar">
            <table class="dashboard_table">
                <tr>
                    <th><img src="img/module.png" alt="Avatar" class="center" style="height: 16px; width: 16px;">modules
                    </th>
                    <th><img src="img/post.png" alt="Avatar" class="center" style="height: 16px; width: 16px;">Posts
                    </th>
                    <th><img src="img/chatroom.png" alt="Avatar" class="center" style="height: 16px; width: 16px;">Chatroom</th>
                    <th><img src="img/settings.png" alt="Avatar" class="center" style="height: 16px; width: 16px;">Settings</th>
                    <th><img src="img/person_pin.png" alt="Avatar" class="center" style="height: 16px; width: 16px;">profile</th>
                </tr>
            </table>
        </div>

        <!-- top nav bar -->
        <div class="top_nav shadow_bottom notification_background">
            <h2 class="push_left" style="margin-top:14px">Modules</h2>
            <img src="img/notification.png" alt="Avatar" class="small_image_size push_right" style="height: 35px; width: 35px;">
        </div><br />

        <button class="base_button add_button shadow pointer" onclick="window.open('lecturer_add_module.php', '_top')"><img src="img/add.png" alt="Avatar" class="push_left small_image_size">Add Module</button><br /><br /><br />

        <!-- Content section -->
        <div class="scrollable">
            <!-- posts cards sesction -->
            <div class="row">
                <?php
                $counter = 1;
                $m = array();
                foreach ($userModules as $module) { //Get modules for the looged in user and display in table rows on dashboard
                    ?>
                    <div class="column">
                        <div class="cardstyle">
                            <!-- <div class="tooltip">
                                <img src="img/delete.png" alt="Avatar" class="small_image_size center pointer">
                                <span class="tooltiptext">Delete</span>
                            </div> -->
                            <a id="link_dialog" name=<?php echo $module["module_id"]; ?> class="button" onclick="deleteAlert1(name)"> <img src="img/delete.png" alt="Avatar" class="small_image_size center pointer" id=<?php echo $module["module_id"]; ?>></a>
                            <br />
                            <img src="img/module_black.png" alt="Avatar" class="medium_image_size center round_image">
                            <div class="container">
                                <h3 align="center"><b><?php echo $module["module_id"]; ?></b></h3>
                                <p align="center"><?php echo $module["module_name"]; ?></p>
                            </div>
                            <button id="edit_button" class="pointer" name=<?php echo $module["module_id"]; ?> onclick="editModule(name)">Edit</button>
                            <button id="students_button" class="pointer" name=<?php echo $module["module_id"]; ?> onclick="viewStudents(name)">Students (<?php echo $module["total_students"]; ?>)</button>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>


        <!-- Dialog -->
        <div id="popup1" class="overlay">
            <div class="popup">
                <h2>Alert</h2>
                <a class="close" href="#">&times;</a>
                <div class="content">
                    <p id="message1">Are you sre you want to delete?</p>
                </div>
                <a href="#"><button class="cancel">Cancel</button></a><button onclick="deleteModule()" class="yes">Yes</button>
            </div>
        </div>



        <!-- JavaScripts *start*-->
        <script src="js/view_details.js"></script>
</body>

</html>