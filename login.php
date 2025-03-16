<?php
session_start();
include "db.php";


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $query = $conn->prepare("SELECT * FROM loginuser WHERE username= :username");
    $query->bindParam(":username", $username);
    $query->execute();


    $user = $query->fetch();
    if ($user) {
        if ($password == $user['password']) {
            $_SESSION['username'] = $user['username'];
            $_SESSION['user_id'] = $user['user_id'];
            header("Location: index.php");
            exit();
        } else {
            echo "<label class='incorrect-p'>  Incorrect username or password.</label>";
        }
    } else {
        echo "<label class='incorrect-p'> Incorrect username or password.</label>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/login-style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>


<body>
    <?php
    if (!isset($_SESSION['username'])) {
    ?>
        <form action="login.php" method="post">
            <div class="main-body">
                <p class="log-p">Log in to your account</p>
                <p class="user-p">Username</p>
                <input class="username-con" type="text" name="username" placeholder="Enter you username">
                <p class="pass-p">Password</p>
                <input class="password-con" type="password" name="password" placeholder="Enter password">
                <button class="Loginbtn">Log In</button>
                <div class="lower-con">
                    <p class="dont">Dont have an account?</p>
                    <a href="register.php">Register</a>
                </div>
            </div>
        </form>
    <?php } ?>
</body>


</html>
