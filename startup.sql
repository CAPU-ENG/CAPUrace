/* This script creates the database for capurace. */
/* The description of the database is in the wiki, Database-Structure.md */

CREATE DATABASE IF NOT EXISTS capurace;
USE capurace;

CREATE TABLE IF NOT EXISTS user (
        school VARCHAR(30) NOT NULL DEFAULT NULL UNIQUE KEY,
        id SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        leader VARCHAR(10) NOT NULL DEFAULT NULL,
        tel VARCHAR(11) NOT NULL DEFAULT NULL,
        mail VARCHAR(30) NOT NULL DEFAULT NULL,
        password VARCHAR(30) NOT NULL DEFAULT NULL,
        nteams SMALLINT UNSIGNED NOT NULL DEFAULT 0,
        bill INT NOT NULL DEFAULT 0,
        paid SMALLINT NOT NULL DEFAULT 0
);

CREATE TABLE IF NOT EXISTS people (
        name VARCHAR(10) NOT NULL DEFAULT NULL,
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        gender INT NOT NULL DEFAULT NULL,
        idcard VARCHAR(40) NOT NULL DEFAULT NULL,
        schoolid INT NOT NULL DEFAULT NULL,
        accommodation INT NOT NULL DEFAULT 1,
        meal INT NOT NULL DEFAULT 1,
        race INT NOT NULL DEFAULT NULL,
        teamrace INT NOT NULL DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS team (
        id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
        first INT UNSIGNED NOT NULL DEFAULT NULL,
        second INT UNSIGNED NOT NULL DEFAULT NULL,
        third INT UNSIGNED NOT NULL DEFAULT NULL,
        schoolid INT UNSIGNED NOT NULL DEFAULT NULL
);

-- Create an administrator.

-- INSERT INTO user(school, id, leader, tel, mail, password) VALUES('', '0', '', '', 'admin', '');
