<?php

require_once('functions.php');
require_once('data.php');

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
}

// Rendering page
if ($projects_rows) {
    $page_content = include_template('add.php', [
        'projects' => $projects_rows
    ]);

    $layout_content = include_template('layout.php', [
        'content' => $page_content,
        'projects' => $projects_rows,
        'title' => 'Дела в порядке'
    ]);

    echo $layout_content;
} else {
    response_with_code(500, 'Ошибка сервера');
}

?>