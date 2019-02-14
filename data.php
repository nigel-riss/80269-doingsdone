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
        'due' => 1575165600,
        'project' => $projects['inbox'],
        'done' => false
    ], [
        'title' => 'Выполнить тестовое задание',
        'due' => 1577239200,
        'project' => $projects['work'],
        'done' => false
    ], [
        'title' => 'Сделать задание первого раздела',
        'due' => 1576893600,
        'project' => $projects['study'],
        'done' => false
    ], [
        'title' => 'Встреча с другом',
        'due' => 1576980000,
        'project' => $projects['inbox'],
        'done' => true
    ], [
        'title' => 'Купить корм для кота',
        'due' => null,
        'project' => $projects['personal'],
        'done' => false
    ], [
        'title' => 'Заказать пиццу',
        'due' => 1550104008,
        'project' => $projects['personal'],
        'done' => false
    ]
];

?>