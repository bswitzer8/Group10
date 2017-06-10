USE group10;

CREATE TABLE IF NOT EXISTS `users` (
	`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
	`created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	`name` varchar(255) NOT NULL,
	`email` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `listitems` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `description` TEXT DEFAULT NULL,
  `due_date` TIMESTAMP NULL DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `priority` INT UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`),
  INDEX `UserID`(`user_id` ASC),
  CONSTRAINT `user_id` FOREIGN KEY(`user_id`) REFERENCES `group10`.`users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE 
);

CREATE TABLE IF NOT EXISTS `sharedlistitems` (
	`user_id` INT UNSIGNED NOT NULL,
	`list_id` INT UNSIGNED NOT NULL,
	PRIMARY KEY (`user_id`, `list_id`),
  	INDEX `UserID`(`user_id` ASC),
  	INDEX `ListID` (`list_id` ASC),
  	CONSTRAINT `user_id1` FOREIGN KEY(`user_id`) REFERENCES `group10`.`users`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE, 
  	CONSTRAINT `list_id1` FOREIGN KEY(`list_id`) REFERENCES `group10`.`listitems`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE 
);

CREATE TABLE IF NOT EXISTS `filters` (
  `list_id` INT UNSIGNED NOT NULL,
  `filter` varchar(255) NOT NULL,
  PRIMARY KEY (`list_id`, `filter`),
    INDEX `ListId`(`list_id` ASC),
    INDEX `Filter`(`filter` ASC),
    CONSTRAINT `list_id` FOREIGN KEY(`list_id`) REFERENCES `group10`.`listitems`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE 
);