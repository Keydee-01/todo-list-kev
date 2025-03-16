<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstname = $_POST['username'];
    $password = $_POST['password'];

    $query = $conn->prepare("INSERT INTO loginuser (username, password)  VALUES (:un,:pw)");

    $query->bindParam(":un", $firstname);
    $query->bindParam(":pw", $password);
    // 
    try {
        $query->execute();
        header("Location: login.php");
    } catch (\Throwable $th) {
        echo "Something went wrong. Please try again.!!";
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
        <form action="register.php" method="post">
            <div class="main-body">
                <p class="log-p">Register an account</p>
                <p class="user-p">Username</p>
                <input class="username-con" type="text" name="username" placeholder="Enter you username">
                <p class="pass-p">Password</p>
                <input class="passwprd-con" type="password" name="password" placeholder="Enter password">
                <button class="Loginbtn">Register</button>
                <div class="lower-con">
                    <p class="do">Already have account?</p>
                    <a href="login.php">Log in</a>
                </div>
            </div>
        </form>
    <?php } ?>
</body>

</html>