<?php
session_start();
$template = 'templates/task_template.php';


//add new data to a cookie
function update_cookie($cookie_name, $new_data)
{
    $data = '';
    if (isset($_COOKIE[$cookie_name])) {
        $data = json_decode($_COOKIE[$cookie_name], true);
        if (!$new_data) {
            //no new data, just return the cookie
            return $data;
        }
        $data[] = $new_data[0];
        setcookie($cookie_name, json_encode($data), time() + 86400);
    } else {
        $data = $new_data;
        setcookie($cookie_name, json_encode($data), time() + 86400);
    }
    return $data;
}


//generate templates per row of data
function generate_template($file, $data)
{
    $output = '';
    foreach ($data as $row) {
        $output .= template($file, $row);
    }
    return $output;
}

//output a single template
function template($file, $data)
{
    if (!file_exists($file)) {
        return '';
    }

    if (is_array($data)) {
        extract($data, EXTR_PREFIX_ALL, 'templ');
    }

    ob_start();
    include $file;
    return ob_get_clean();
}

// if submit was pressed, add task and redirect to index
if (isset($_POST['submit'])) {
    if (isset($_SESSION['task_id'])) {
        $_SESSION['task_id']++;
    } else {
        $_SESSION['task_id'] = 1;
    }

    if (!isset($task_data)) {
        $task_data = array();
    }

    $task_data[] = array('task_id' => $_SESSION['task_id'], 'task_name' => $_POST['task']);
    $tasks = update_cookie("tasks", $task_data);
 
    $_SESSION['tasks_display'] = generate_template($template, $tasks);

} else {
    //just update the list
    $tasks = update_cookie("tasks", null);
    $_SESSION['tasks_display'] = generate_template($template, $tasks);
}

header("Location: index.php");
