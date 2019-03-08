<?php
date_default_timezone_get('Etc/GMT');

require_once('functions.php');
require_once('data.php');

$user_id = 1;

$connection = mysqli_connect('localhost', 'root', '', 'doingsdone');

if ($connection == false) {
    $server_error = 'Oшибка подключения: ' . mysqli_connect_error();
    http_response_code(500);
    echo $server_error;
    exit;
} 

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
        response_with_code(404, 'Ошибка 404: По данному запросу задач не найдено.');
    }

    // Checking if any tasks for the project
    $tasks_count_sql = "SELECT COUNT(*) FROM tasks WHERE author_id =" . $user_id . " AND project_id =" . $project_id;
    $tasks_count = (int)send_sql_request($connection, $tasks_count_sql)[0]['COUNT(*)'];
    if ($tasks_count <= 0) {
        response_with_code(404, 'Ошибка 404: По данному запросу задач не найдено.');
    }
} else {
    $project_id = 0;
}


// Getting tasks
$tasks_sql = "SELECT * FROM tasks WHERE author_id =" . $user_id;
$tasks_rows = send_sql_request($connection, $tasks_sql);

// Rendering page
if (!($projects_rows && $tasks_rows)) {
    response_with_code(500, 'Ошибка сервера');
}

$page_content = include_template('index.php', [
    'show_complete_tasks' => $show_complete_tasks,
    'tasks' => $tasks_rows,
    'project_id' => $project_id
]);

// Почему это не работает?
// foreach ($projects_rows as $project) {
//     $project['tasks_num'] = calculate_tasks($connection, $user_id, escape_html($project['id']));
// }

for ($i = 0; $i < sizeof($projects_rows); $i++) {
    $projects_rows[$i]['tasks_num'] = calculate_tasks($connection, $user_id, escape_html($projects_rows[$i]['id']));
}

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'projects' => $projects_rows,
    'tasks' => $tasks_rows,
    'title' => 'Дела в порядке'
]);

echo $layout_content;

?>
