<?php
date_default_timezone_get('Etc/GMT');

require_once('functions.php');
require_once('data.php');

$went_wrong = '';

$user_id = 1;

$connection = mysqli_connect('localhost', 'root', '', 'doingsdone');

if ($connection == false) {
    $went_wrong = 'Oшибка подключения: ' . mysqli_connect_error();
} else {
    // Setting charset
    mysqli_set_charset($connection, 'utf8');

    // Getting projects
    $projects_sql = "SELECT * FROM projects WHERE `author_id` =" . $user_id;
    $projects_result = mysqli_query($connection, $projects_sql);
    if (!$projects_result) {
        $error = mysqli_error($connection);
        $went_wrong = 'Ошибка MySQL: ' . $error;
    } else {
        $projects_rows = mysqli_fetch_all($projects_result, MYSQLI_ASSOC);
    }

    // Getting tasks
    if (isset($_GET['project'])) { // Checking if proper request
        $project_id = $_GET['project'];

        if ($project_id === '') {
            http_response_code(404);
            $went_wrong = 'Ошибка 404: По данному запросу задач не найдено.';
        } else {
            $tasks_sql = "SELECT * FROM tasks WHERE author_id =" . $user_id . " AND project_id =" . $project_id;
        }
    } else {
        $tasks_sql = "SELECT * FROM tasks WHERE author_id =" . $user_id;
    }

    $tasks_result = mysqli_query($connection, $tasks_sql);
    if (!$tasks_result) {
        $error = mysqli_error($connection);
        $went_wrong = 'Ошибка MySQL: ' . $error;
    } else {
        $tasks_rows = mysqli_fetch_all($tasks_result, MYSQLI_ASSOC);
    }
}

// Rendering page
if ($projects_rows && $tasks_rows && $went_wrong === '') {
    $page_content = include_template('index.php', [
        'show_complete_tasks' => $show_complete_tasks,
        'tasks' => $tasks_rows
    ]);

    $layout_content = include_template('layout.php', [
        'content' => $page_content,
        'projects' => $projects_rows,
        'tasks' => $tasks_rows,
        'title' => 'Дела в порядке'
    ]);

    echo $layout_content;
} else {
    echo $went_wrong;
}

?>
