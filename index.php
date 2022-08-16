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

<body>
    <div class="container" style="width: 400px; margin: auto;">
        <!-- header -->
        <h2 class="title">My Tasks</h2>

        <!-- input field -->
        <div>
            <table class="tasklist">
                <tbody class="task">
                    <div>
                        <form action="update_tasks.php" method="POST">
                            <div>
                                <input type="text" name="task" placeholder="Task name">
                                <input type="submit" name="submit" value="Add Task">
                            </div>
                        </form>
                    </div>
                    <div>
                        <?php
                        //TODO: SANITIZE
                        if (isset($_SESSION['tasklist'])) {
                            print $_SESSION['tasklist'];
                        }
                        ?>
                    </div>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>