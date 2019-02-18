CREATE DATABASE doingsdone
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE doingsdone;

CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name CHAR(128),
    author INT
);

CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_finished TIMESTAMP,
    state TINYINT DEFAULT 0,
    description CHAR(255),
    filename CHAR(255),
    date_due TIMESTAMP,
    author INT,
    project INT
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_register TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email CHAR(255),
    name CHAR(255),
    pass CHAR(255)
);

