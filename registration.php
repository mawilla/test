<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/login_form.css">
</head>

<body>

    <form action="db_insert_user.php" class="login_form center" method="POST">
        <div class="imgcontainer">
        <h2>Register</h2>
            <img src="img/chatbot.png" alt="Avatar" class="avatar" style="height:40px; width:48px">
        </div>

        <div class="container">
            <label for="Institution_nam"><b>Institution name</b></label>
            <input type="text" placeholder="Enter institution name.." name="institutionName" required>
            <br><br>

            <!-- <label for="username"><b>Admin username</b></label>
            <input type="password" placeholder="Username.." name="username" required>
            <br><br> -->

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Password.." name="password" required>
            <br><br>

            <label for="confirm_password"><b>Confirm Password</b></label>
            <input type="password" placeholder="Password.." name="confirm_password" required>
            <br><br>

            <button type="submit">Register</button>
        </div>
    </form>

</body>

</html>