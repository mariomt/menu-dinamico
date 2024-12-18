CREATE DATABASE IF NOT EXISTS menus;

USE menus;

CREATE TABLE IF NOT EXISTS menus(
    id INT(11) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    description TEXT,
    parent_id INT(11) UNSIGNED DEFAULT NULL,

    CONSTRAINT fk_padre FOREIGN KEY (parent_id) REFERENCES menus(id)
);
