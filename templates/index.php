<h2 class="content__main-heading">Список задач</h2>

<form class="search-form" action="index.php" method="post">
    <input class="search-form__input" type="text" name="" value="" placeholder="Поиск по задачам">

    <input class="search-form__submit" type="submit" name="" value="Искать">
</form>

<div class="tasks-controls">
    <nav class="tasks-switch">
        <a href="/" class="tasks-switch__item tasks-switch__item--active">Все задачи</a>
        <a href="/" class="tasks-switch__item">Повестка дня</a>
        <a href="/" class="tasks-switch__item">Завтра</a>
        <a href="/" class="tasks-switch__item">Просроченные</a>
    </nav>

    <label class="checkbox">
        <!--добавить сюда аттрибут "checked", если переменная $show_complete_tasks равна единице-->
        <input class="checkbox__input visually-hidden show_completed" type="checkbox" <?= $show_complete_tasks ? 'checked' : '';?>>
        <span class="checkbox__text">Показывать выполненные</span>
    </label>
</div>

<table class="tasks">
    <?php foreach ($tasks as $task): ?>
    <?php if (($show_complete_tasks || !($task['state'] == 1)) 
            && ($task['project_id'] == $project_id) || ($project_id == 0)): ?>

        <tr class="tasks__item task <?= check_deadline_24h(strtotime($task['date_due'])) ? 'task--important':''; ?>">
            <td class="task__select">
                <label class="checkbox task__checkbox">
                    <input class="checkbox__input visually-hidden task__checkbox" type="checkbox" value="1" <?= $task['state'] ? 'checked' : ''; ?>>
                    <span class="checkbox__text"><?= escape_html($task['description']); ?></span>
                </label>
            </td>

            <!-- <td class="task__file">
                <a class="download-link" href="#">Home.psd</a>
            </td> -->

            <td class="task__date"><?= $task['date_due'] ? date('d.m.Y', strtotime($task['date_due'])) : 'Нет'; ?></td>

            <td class="task__controls">
            </td>
        </tr>

    <?php endif; ?>
    <?php endforeach; ?>
</table>