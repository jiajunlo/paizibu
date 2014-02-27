CREATE DATABASE `paizibu`;

USE `paizibu`;

CREATE TABLE IF NOT EXISTS `user`(
	`user_id` int(20) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
	`user_email` char(50) NOT NULL UNIQUE,
	`user_name` char(50) NOT NULL,
	`user_password` char(40) NOT NULL,
	`user_avatar` char(255) NOT NULL,
	`user_cover` char(255) NOT NULL,
	`user_sex` tinyint(1) NOT NULL DEFAULT 1,
	`user_register_time` timestamp DEFAULT current_timestamp NOT NULL,
	`user_valid` tinyint(1) DEFAULT 1 NOT NULL
)ENGINE=innoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `note`(
	`note_id` int(20) unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
	`user_id` int(20) unsigned NOT NULL,
	`note_title` char(50) NOT NULL,
	`note_content` TEXT NOT NULL,
	`note_time` timestamp DEFAULT current_timestamp NOT NULL,
	`note_weather` tinyint(2) DEFAULT 1 NOT NULL,
	`note_place` char(50) NOT NULL,
	`note_valid` tinyint(1) DEFAULT 1 NOT NULL,
	FOREIGN KEY (`user_id`) REFERENCES user(`user_id`) ON DELETE CASCADE
)ENGINE=innoDB DEFAULT CHARSET=utf8;
