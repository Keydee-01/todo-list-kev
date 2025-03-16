<?php
include "db.php";


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_POST['task'])) {
    $taskname = $_POST['task'];
    $user_id = $_SESSION['user_id'];


    $query = $conn->prepare("INSERT INTO tasks (task_name, user_id) VALUES (:tname, :user_id)");
    $query->bindParam(":tname", $taskname, PDO::PARAM_STR);
    $query->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $query->execute();


    header("Location: index.php");
    exit();
}


$query = $conn->prepare("SELECT * FROM tasks WHERE is_completed = 0 AND user_id = :user_id");
$query->bindParam(":user_id", $_SESSION['user_id'], PDO::PARAM_INT);
$query->execute();
$tasks = $query->fetchAll(PDO::FETCH_ASSOC);
