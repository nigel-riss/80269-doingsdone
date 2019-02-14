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
 * calculateTasks
 * Calculates tasks in a project
 *
 * @param  array $tasksArr
 * @param  string $projectName
 *
 * @return int
 */
function calculateTasks($tasksArr, $projectName) {
    $tasksCount = 0;
    foreach ($tasksArr as $task) {
        $tasksCount += ($task['project'] === $projectName) ? 1 : 0;
    }
    return $tasksCount;
}


/**
 * escapeHtml
 * Filters HTML in input text
 *
 * @param  string $string
 *
 * @return string
 */
function escapeHtml($string) {
    $text = htmlspecialchars($string);
    // $text = strip_tags($string);

    return $text;
}


/**
 * checkDeadline24
 * Checks if it is less then 24 hours to deadline
 *
 * @param  int $date
 *
 * @return boolean
 */
function checkDeadline24($date) {
    // return false is there is no due date
    if ($date === null) {
        return false;
    }

    $currTimestamp= time();
    $secondsLeft = $date - $currTimestamp;
    $hoursLeft = floor($secondsLeft / 3600);

    return $hoursLeft < 24;
}
?>