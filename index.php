<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="./css/styles.css">
</head>

<script>
    /**
     * Remove table row on button press and update the cookie
     */
    function deleteRow(button) {
        var row = button.parentNode.parentNode;
        row.parentNode.removeChild(row);

        var tasksCookie = getCookie("tasks");
        tasksCookie = JSON.parse(decodeURIComponent(tasksCookie));
        deleteTask(tasksCookie, row.id);
        document.cookie = 'tasks=' + JSON.stringify(tasksCookie);
        window.location.href = "update_tasks.php";
    }

    /**
     * return cookie by name 
     */ 
    function getCookie(name) {
        name += '=';
        for (var ca = document.cookie.split(/;\s*/), i = ca.length - 1; i >= 0; i--)
            if (!ca[i].indexOf(name))
                return ca[i].replace(name, '');
    }

    /**
     *  delete task for given id
     */
    function deleteTask(tasks, id) {
        for (var i = 0; i < tasks.length; i++) {
            if (tasks[i].task_id == id) {
                tasks.splice(i,1);
            }
        }
    }
</script>

<body>
    <div class="container" style="width: 400px; margin: auto;">
        <h2 class="title">My Tasks</h2>
        <div>
            <table class="tasklist">
                <tbody class="task">
                    <div>
                        <form action="update_tasks.php" method="POST">
                            <div>
                                <input type="text" name="task" placeholder="Task name" required>
                                <input type="submit" name="submit" value="Add Task">
                            </div>
                        </form>
                    </div>
                    <div>
                        <?php
                            print $_SESSION['tasks_display'] ?? null;
                        ?>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>

