
CREATE DATABASE IF NOT EXISTS group10;

-- the database name is group10 
USE group10;

CREATE TABLE IF NOT EXISTS `users` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`name` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);


CREATE TABLE IF NOT EXISTS `lists` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `description` TEXT DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `UserID`(`user_id` ASC),
  CONSTRAINT `user_id` FOREIGN KEY(`user_id`) REFERENCES `group10`.`users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE 
);

CREATE TABLE IF NOT EXISTS `sharedlists` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`user_id` INT UNSIGNED NOT NULL,
	`list_id` INT UNSIGNED NOT NULL,
	PRIMARY KEY (`id`),
  	INDEX `UserID`(`user_id` ASC),
  	INDEX `ListID` (`list_id` ASC),
  	FOREIGN KEY(`user_id`) REFERENCES `group10`.`users`(`id`) ON UPDATE CASCADE, 
  	FOREIGN KEY(`list_id`) REFERENCES `group10`.`lists`(`id`) ON UPDATE CASCADE
);



!-- INSERT INTO users (name, email, password) values ('ben', 'bswitzer8@gmail.com', 'butts');