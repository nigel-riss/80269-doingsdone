<?php
date_default_timezone_get('Etc/GMT');

require_once('functions.php');
require_once('data.php');


$page_content = include_template('index.php', [
    'show_complete_tasks' => $show_complete_tasks,
    'tasks' => $tasks
]);

$layout_content = include_template('layout.php', [
    'content' => $page_content,
    'projects' => $projects,
    'tasks' => $tasks,
    'title' => 'Дела в порядке'
]);

echo $layout_content;

?>
