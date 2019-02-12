<?php

// показывать или нет выполненные задачи
$show_complete_tasks = rand(0, 1);

// Project names array
$projects = [
    'inbox' => 'Входящие',
    'study' => 'Учёба',
    'work' => 'Работа',
    'personal' => 'Домашние дела',
    'car' => 'Авто'
];

// Tasks array
$tasks = [
    [
        'title' => 'Собеседование в IT компании',
        'due' => '01.12.2019',
        'project' => $projects['inbox'],
        'done' => false
    ], [
        'title' => 'Выполнить тестовое задание',
        'due' => '25.12.2019',
        'project' => $projects['work'],
        'done' => false
    ], [
        'title' => 'Сделать задание первого раздела',
        'due' => '21.12.2019',
        'project' => $projects['study'],
        'done' => false
    ], [
        'title' => 'Встреча с другом',
        'due' => '22.12.2019',
        'project' => $projects['inbox'],
        'done' => true
    ], [
        'title' => 'Купить корм для кота',
        'due' => NULL,
        'project' => $projects['personal'],
        'done' => false
    ], [
        'title' => 'Заказать пиццу',
        'due' => NULL,
        'project' => $projects['personal'],
        'done' => false
    ]
];

?>