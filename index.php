<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
}
?>

<?php
include "add_task.php";
include "complete_task.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/style.css">
    <title>To Do List</title>
</head>

<body>
    <div class="main-div">
        <aside>
            <div class="todo">To Do List</div>
            <div class="new">New Task</div>
        </aside>
        <main>
            <div>
                    <div class="upper-form">
                    <p class="new-task-word">New Task</p>
                    <button class="x-button" type="button " onclick="logout()">Log Out</button>
                    </div>
                    <form action="" method="post">
                    <input type="text" name="task" placeholder="Task" required>
                    <button class="add-button" type="submit">Add Task</button>
                </form>
            </div>
            <div>
                <div>
                    <p>Task Lists</p>
                    <?php foreach ($tasks as $task): ?>
                        <div class=tasklists>
                            <?php echo htmlspecialchars($task['task_name']); ?>
                            <div>
                                <button class="complete-button" type="button " onclick="confirm1(<?= $task['id'] ?>)">Complete</button>
                                <button class="delete-button" type="button " onclick="confirm2(<?= $task['id'] ?>)">Delete</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p>Completed Tasks</p>
                <?php foreach ($complete as $ctask): ?>
                    <div class=tasklists>
                        <?php echo htmlspecialchars($ctask['task_name']); ?>
                        <div>
                            <button class="delete-button" type="button " onclick="confirm2(<?= $ctask['id'] ?>)">Delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>
                </form>
            </div>
        </main>
    </div>
</body>
<script>
    function confirm1(id) {
        window.location = "complete_task.php?id=" + id;
    }
    function confirm2(id) {
        const c = confirm("Sigurado ka ba sa iyong desisyon, kapatid?");
        if (c) {
            window.location = "delete_task.php?id=" + id;
        }
    }
    function logout() {
        window.location.href = "logout.php";
    }
</script>
</html>

