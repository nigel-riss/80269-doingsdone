CREATE DATABASE doingsdone
    DEFAULT CHARACTER SET utf8
    DEFAULT COLLATE utf8_general_ci;

USE doingsdone;

CREATE TABLE projects (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(128),
    author_id INT UNSIGNED
);

CREATE TABLE tasks (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date_creation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    date_finished TIMESTAMP,
    state BYTE(1) DEFAULT 0,
    description VARCHAR(255),
    filename VARCHAR(255),
    date_due TIMESTAMP,
    author_id INT UNSIGNED,
    project_id INT UNSIGNED
);

CREATE TABLE users (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date_register TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    email VARCHAR(255),
    name VARCHAR(255),
    password_hash VARCHAR(255)
);

