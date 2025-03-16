<?php
include "db.php";


if ($_SERVER['REQUEST_METHOD'] == "GET" && isset($_GET['id'])) {
    $stmt = $conn->prepare("UPDATE tasks SET is_completed = 1 WHERE id = :id");
    $stmt->bindParam(":id", $_GET['id'], PDO::PARAM_INT);


    try {
        $stmt->execute();
        header("Location: index.php");
        exit();
    } catch (Exception $e) {
        echo "Something went wrong: " . $e->getMessage();
    }
}

if (!isset($_SESSION['user_id'])) {
    echo "user not logged in.";
    exit();
}


$user_id = $_SESSION['user_id'];


$query = $conn->prepare("SELECT * FROM tasks WHERE is_completed = 1 AND user_id = :user_id");
$query->bindParam(":user_id", $user_id, PDO::PARAM_INT);


try {
    $query->execute();
    $complete = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo "Something went wrong: " . $e->getMessage();
}


