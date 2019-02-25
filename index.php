<?php
date_default_timezone_get('Etc/GMT');

require_once('functions.php');
require_once('data.php');

$connection = mysqli_connect('localhost', 'root', '', 'doingsdone');

$con_status = '';
if ($connection == false) {
    echo 'Oшибка подключения: ' . mysqli_connect_error();
} else {
    $page_content = include_template('index.php', [
        'show_complete_tasks' => $show_complete_tasks,
        'tasks' => $tasks
    ]);

    $layout_content = include_template('layout.php', [
        'content' => $page_content,
        'projects' => $projects,
        'tasks' => $tasks,
        // 'title' => 'Дела в порядке'
        'title' => $con_status
    ]);

    echo $layout_content;
}

?>
