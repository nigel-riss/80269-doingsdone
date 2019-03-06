<?php

/**
 * include_template
 * Template function
 *
 * @param  string $name
 * @param  array $data
 *
 * @return string
 */
function include_template($name, $data) {
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}


/**
 * calculate_tasks
 * Calculates tasks in a project
 *
 * @param  array $tasksArr
 * @param  integer $projectName
 *
 * @return int
 */
function calculate_tasks($tasksArr, $projectId) {
    $tasksCount = 0;
    foreach ($tasksArr as $task) {
        $tasksCount += ($task['project_id'] === $projectId) ? 1 : 0;
    }
    return $tasksCount;
}


/**
 * escape_html
 * Filters HTML in input text
 *
 * @param  string $string
 *
 * @return string
 */
function escape_html($string) {
    $text = htmlspecialchars($string);
    // $text = strip_tags($string);

    return $text;
}


/**
 * check_deadline_24h
 * Checks if it is less then 24 hours to deadline
 *
 * @param  int $date
 *
 * @return boolean
 */
function check_deadline_24h($date) {
    // return false is there is no due date
    if ($date === '') {
        return false;
    }

    $currTimestamp= time();
    $secondsLeft = $date - $currTimestamp;
    $hoursLeft = floor($secondsLeft / 3600);

    return $hoursLeft < 24;
}


/**
 * response_with_code
 * Set http response code, prints error text and exit script
 *
 * @param  int $error_code
 * @param  string $error_tex
 *
 */
function response_with_code($error_code, $error_text) {
    http_response_code($error_code);
    echo $error_text;
    exit;
}


/**
 * send_sql_request
 * Send mysql request using existing connection
 *
 * @param  mysqli $connection
 * @param  string $sql_request
 *
 * @return Array 
 */
function send_sql_request($connection, $sql_request) {
    $result = [];
    $sql_result = mysqli_query($connection, $sql_request);
    if (!$sql_result) {
        $error = mysqli_error($connection);
        response_with_code(500, 'Ошибка MySQL: ' . $error);
    } else {
        $result = mysqli_fetch_all($sql_result, MYSQLI_ASSOC);
    }

    return $result;
}


?>