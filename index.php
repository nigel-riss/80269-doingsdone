<?php
date_default_timezone_get('Etc/GMT');

require_once('functions.php');
require_once('data.php');

$user_error = '';

$user_id = 1;

$connection = mysqli_connect('localhost', 'root', '', 'doingsdone');

if ($connection == false) {
    $server_error = 'Oшибка подключения: ' . mysqli_connect_error();
    http_response_code(500);
    echo $server_error;
    exit;
} else {
    // Setting charset
    mysqli_set_charset($connection, 'utf8');

    // Getting projects
    $projects_sql = "SELECT * FROM projects WHERE author_id = " . $user_id;
    $projects_rows = send_sql_request($connection, $projects_sql);

    // Getting project id
    if (isset($_GET['project'])) {
        $project_id = (int)$_GET['project'];

        // Checking if proper request
        if ($project_id <= 0) {
            throw_user_error(404, 'Ошибка 404: По данному запросу задач не найдено.');
        }

        // Checking if any tasks for the project
        // ИМХО это бредовое требование, если нет задач, то почему пользователь должен получать ошибку, а не пустое поле?
        // Или хотя-бы надпись "Для данного проекта еще нет задач. Создать? (ссылка)"
        $tasks_count_sql = "SELECT COUNT(*) FROM tasks WHERE author_id =" . $user_id . " AND project_id =" . $project_id;
        $tasks_count = (int)send_sql_request($connection, $tasks_count_sql)[0]['COUNT(*)'];
        if ($tasks_count <= 0) {
            throw_user_error(404, 'Ошибка 404: По данному запросу задач не найдено.');
        }
    } else {
        $project_id = 0;
    }


    // Getting tasks
    $tasks_sql = "SELECT * FROM tasks WHERE author_id =" . $user_id;
    $tasks_rows = send_sql_request($connection, $tasks_sql);
}

// Rendering page
if ($projects_rows && $tasks_rows) {
    $page_content = include_template('index.php', [
        'show_complete_tasks' => $show_complete_tasks,
        'tasks' => $tasks_rows,
        'project_id' => $project_id
    ]);

    $layout_content = include_template('layout.php', [
        'content' => $page_content,
        'projects' => $projects_rows,
        'tasks' => $tasks_rows,
        'title' => 'Дела в порядке'
    ]);

    echo $layout_content;
} else {
    throw_user_error(500, 'Ошибка сервера');
}

?>
