-- Selecting the database
USE doingsdone;

-- Adding existing projects into database
INSERT INTO projects (name, author_id)
VALUES
    ("Входящие", 1),
    ("Учёба", 2),
    ("Работа", 1),
    ("Домашние дела", 1),
    ("Авто", 1);

-- Adding few users
INSERT INTO users (date_register, email, name, password_hash)
VALUES
    (NOW(), "somebody@gmail.com", "anonymus", "506cb09be8bda393999f0d666f719a0dffd7f46261d6353c3534f6e6576121e8"),
    (NOW(), "another@mail.ru", "vasiliy", "4997b306e3fec8d8cf7d4512a14a29ec24fd8646b66322a799d001d2d961c742");

-- Adding existing tasks
INSERT INTO tasks (date_finished, description, filename, date_due, author_id, project_id)
VALUES
    (NULL, "Собеседование в IT компании", "", FROM_UNIXTIME(1575165600), 2, 1),
    (NULL, "Выполнить тестовое задание", "", FROM_UNIXTIME(1577239200), 1, 3),
    (NULL, "Сделать задание первого раздела", "", FROM_UNIXTIME(1576893600), 2, 2),
    (NULL, "Встреча с другом", "", FROM_UNIXTIME(1576980000), 1, 1),
    (NULL, "Купить корм для кота", "", NULL, 1, 4),
    (NULL, "Заказать пиццу", "", FROM_UNIXTIME(1550104008), 1, 4);

-- Selecting all projects for certain user
SELECT * FROM projects WHERE author_id = 1;

-- Selecting all tasks for certain project
SELECT * FROM tasks WHERE project_id = 1;

-- Setting task as done
UPDATE tasks SET state = 1, date_finished = NOW()
WHERE id = 4;

-- Updating task name by id
UPDATE tasks SET description = "Заказать гамбургер"
WHERE id = 6;
