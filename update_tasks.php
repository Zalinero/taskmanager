<?php
session_start();

//add new data to a cookie
function update_cookie($cookie_name, $new_data)
{
    $data='';
    if (isset($_COOKIE[$cookie_name])) {
        $data = json_decode($_COOKIE[$cookie_name], true);
        array_push($data, $new_data);
        setcookie($cookie_name, json_encode($data), time() + 86400);
    } else {
        $data = [$new_data];
        setcookie($cookie_name, json_encode($data), time() + 86400);
    }

    return $data;
}

//generate templates per row of data
function generate_template($file, $data) {
    $output = '';
    foreach ($data as $t) {
        $output .= template($file, $t);
    }
    return $output;
}

//output a single template
function template($file, $data)
{
    if (!file_exists($file)) {
        return '';
    }
    ob_start();
    include $file;
    return ob_get_clean();
}

// function templateSimple($file, $data)
// {
//     $output = '';
//     foreach ($data as $t) {
//         $output .= file_get_contents($file);
//     }
//     return $output;
// }

// if submit was pressed, update tasklist and redirect to index
if (isset($_POST['submit'])) {
    $tasks = update_cookie("tasks", $_POST['task']);
    $file = 'templates/task_template.php';

    // $_SESSION['tasklist'] = templateSimple($file, $tasks);
    $_SESSION['tasklist'] = generate_template($file, $tasks);

    header("Location: index.php");
}
