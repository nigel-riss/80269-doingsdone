<?php
date_default_timezone_get('Etc/GMT');

require_once('functions.php');
require_once('data.php');

$user_id = 1;

$connection = mysqli_connect('localhost', 'root', '', 'doingsdone');

$con_status = '';
if ($connection == false) {
    echo 'Oшибка подключения: ' . mysqli_connect_error();
} else {
    mysqli_set_charset($connection, 'utf8');

    $projects_sql = "SELECT * FROM projects WHERE `author_id` =" . $user_id;
    // $projects_sql = "SELECT * FROM projects";
    $projects_result = mysqli_query($connection, $projects_sql);
    
    if (!$projects_result) {
        $error = mysqli_error($connection);
        echo 'Ошибка MySQL: ' . $error;
    } else {
        $projects_rows = mysqli_fetch_all($projects_result, MYSQLI_ASSOC);
        echo print_r($projects_rows);
    }

    $page_content = include_template('index.php', [
        'show_complete_tasks' => $show_complete_tasks,
        'tasks' => $tasks
    ]);

    $layout_content = include_template('layout.php', [
        'content' => $page_content,
        'projects' => $projects_rows,
        'tasks' => $tasks,
        'title' => 'Дела в порядке'
        // 'title' => $con_status
    ]);

    echo $layout_content;
}

?>
