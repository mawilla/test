<?php
session_start();
$_SESSION['topic'] = "none";
$_SESSION['userSession'] = "none";
$_SESSION['control'] = "";
$_COOKIE["cookieTopic"] = "";
?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/login_form.css">
</head>

<body>
    <form action="db_login_user.php" class="login_form center" method="POST">
        <div class="imgcontainer">
            <h2>Login</h2>
            <img src="img/chatbot.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <button type="submit">Login</button>
            <!-- <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label> -->
            <p align="center">Don't have an account? <a href="registration.php"> Register</a></p>
        </div>
    </form>

    <form action="db_login_user.php" class="login_form center" method="POST" style="display: none">
        <div class="imgcontainer">
            <h2>Sign up</h2>
            <img src="img/chatbot.png" alt="Avatar" class="avatar">
        </div>

        <div class="container">
            <label for="institution"><b>Institution name</b></label>
            <input type="text" placeholder="Enter Username" name="institution" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="password" required>

            <label for="confirm_password"><b>Confirm password</b></label>
            <input type="password" placeholder="Enter Password" name="confirm_password" required>

            <button type="submit">Sign up</button>
            <!-- <label>
                <input type="checkbox" checked="checked" name="remember"> Remember me
            </label> -->
            <p align="center">Don't have an account click? <a href="registration.php">Register</a></p>
        </div>
    </form>

    <div class="loginFooter">
        <br>
        <h2 align="center">Easier to answer frequently Asked Question (FAQ), from start to finish</h2>
        <p align="center"> Reduce the the time spent on answering frequently asked questions by the public.
        </p>
    </div>

</body>

</html>