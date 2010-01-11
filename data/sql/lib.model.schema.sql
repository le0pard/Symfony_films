
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- users
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `users`;


CREATE TABLE `users`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`login` VARCHAR(100)  NOT NULL,
	`password` VARCHAR(100)  NOT NULL,
	`email` VARCHAR(100)  NOT NULL,
	`website_blog` VARCHAR(500),
	`avatar` VARCHAR(500),
	`about` TEXT,
	`last_login` DATETIME,
	`is_active` TINYINT default 0 NOT NULL,
	`persistence_token` VARCHAR(200) default '',
	`is_super_admin` TINYINT default 0 NOT NULL,
	`count_of_films` INTEGER default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `users_U_1` (`login`),
	UNIQUE KEY `users_U_2` (`email`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- users_group
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `users_group`;


CREATE TABLE `users_group`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255)  NOT NULL,
	`description` TEXT,
	PRIMARY KEY (`id`),
	UNIQUE KEY `users_group_U_1` (`name`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- users_users_group
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `users_users_group`;


CREATE TABLE `users_users_group`
(
	`user_id` INTEGER  NOT NULL,
	`group_id` INTEGER  NOT NULL,
	PRIMARY KEY (`user_id`,`group_id`),
	CONSTRAINT `users_users_group_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`id`)
		ON DELETE CASCADE,
	INDEX `users_users_group_FI_2` (`group_id`),
	CONSTRAINT `users_users_group_FK_2`
		FOREIGN KEY (`group_id`)
		REFERENCES `users_group` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- users_remember_key
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `users_remember_key`;


CREATE TABLE `users_remember_key`
(
	`user_id` INTEGER  NOT NULL,
	`remember_key` VARCHAR(32),
	`ip_address` VARCHAR(50)  NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`user_id`,`ip_address`),
	CONSTRAINT `users_remember_key_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- film
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `film`;


CREATE TABLE `film`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`title` VARCHAR(500)  NOT NULL,
	`original_title` VARCHAR(500)  NOT NULL,
	`normal_logo` VARCHAR(255),
	`thumb_logo` VARCHAR(255),
	`url` VARCHAR(500),
	`pub_year` INTEGER,
	`director` VARCHAR(255),
	`cast` VARCHAR(1000),
	`about` TEXT,
	`country` VARCHAR(500),
	`duration` VARCHAR(500),
	`file_info` TEXT,
	`is_visible` TINYINT default 1 NOT NULL,
	`is_private` TINYINT default 0 NOT NULL,
	`is_public` TINYINT default 0 NOT NULL,
	`modified_user_id` INTEGER,
	`modified_at` DATETIME,
	`modified_text` VARCHAR(500),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `film_FI_1` (`user_id`),
	CONSTRAINT `film_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`id`),
	INDEX `film_FI_2` (`modified_user_id`),
	CONSTRAINT `film_FK_2`
		FOREIGN KEY (`modified_user_id`)
		REFERENCES `users` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- film_links
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `film_links`;


CREATE TABLE `film_links`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`film_id` INTEGER  NOT NULL,
	`title` VARCHAR(200)  NOT NULL,
	`url` VARCHAR(500)  NOT NULL,
	`sort` INTEGER default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`,`film_id`),
	INDEX `film_links_FI_1` (`film_id`),
	CONSTRAINT `film_links_FK_1`
		FOREIGN KEY (`film_id`)
		REFERENCES `film` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- film_types
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `film_types`;


CREATE TABLE `film_types`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(500)  NOT NULL,
	`url` VARCHAR(500)  NOT NULL,
	`logo` VARCHAR(500)  NOT NULL,
	`description` TEXT,
	`is_visible` TINYINT default 1 NOT NULL,
	`is_not_main` TINYINT default 0 NOT NULL,
	`created_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- film_raiting
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `film_raiting`;


CREATE TABLE `film_raiting`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`film_id` INTEGER  NOT NULL,
	`user_id` INTEGER  NOT NULL,
	`raiting` INTEGER default 1 NOT NULL,
	PRIMARY KEY (`id`,`film_id`,`user_id`),
	INDEX `film_raiting_FI_1` (`film_id`),
	CONSTRAINT `film_raiting_FK_1`
		FOREIGN KEY (`film_id`)
		REFERENCES `film` (`id`)
		ON DELETE CASCADE,
	INDEX `film_raiting_FI_2` (`user_id`),
	CONSTRAINT `film_raiting_FK_2`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- film_gallery
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `film_gallery`;


CREATE TABLE `film_gallery`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`film_id` INTEGER  NOT NULL,
	`thumb_img` VARCHAR(500)  NOT NULL,
	`normal_img` VARCHAR(500)  NOT NULL,
	`sort` INTEGER default 0,
	PRIMARY KEY (`id`,`film_id`),
	INDEX `film_gallery_FI_1` (`film_id`),
	CONSTRAINT `film_gallery_FK_1`
		FOREIGN KEY (`film_id`)
		REFERENCES `film` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- film_film_types
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `film_film_types`;


CREATE TABLE `film_film_types`
(
	`film_id` INTEGER  NOT NULL,
	`film_genre_id` INTEGER  NOT NULL,
	PRIMARY KEY (`film_id`,`film_genre_id`),
	CONSTRAINT `film_film_types_FK_1`
		FOREIGN KEY (`film_id`)
		REFERENCES `film` (`id`)
		ON DELETE CASCADE,
	INDEX `film_film_types_FI_2` (`film_genre_id`),
	CONSTRAINT `film_film_types_FK_2`
		FOREIGN KEY (`film_genre_id`)
		REFERENCES `film_types` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- comments
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;


CREATE TABLE `comments`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`film_id` INTEGER  NOT NULL,
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`,`film_id`),
	INDEX `comments_FI_1` (`user_id`),
	CONSTRAINT `comments_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`id`),
	INDEX `comments_FI_2` (`film_id`),
	CONSTRAINT `comments_FK_2`
		FOREIGN KEY (`film_id`)
		REFERENCES `film` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- messages
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `messages`;


CREATE TABLE `messages`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`message_type` INTEGER  NOT NULL,
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `messages_FI_1` (`user_id`),
	CONSTRAINT `messages_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- user_friends
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_friends`;


CREATE TABLE `user_friends`
(
	`user_id` INTEGER  NOT NULL,
	`friend_id` INTEGER  NOT NULL,
	`commit` TINYINT default 0 NOT NULL,
	PRIMARY KEY (`user_id`),
	CONSTRAINT `user_friends_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`id`)
		ON DELETE CASCADE,
	INDEX `user_friends_FI_2` (`friend_id`),
	CONSTRAINT `user_friends_FK_2`
		FOREIGN KEY (`friend_id`)
		REFERENCES `users` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- news
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `news`;


CREATE TABLE `news`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER  NOT NULL,
	`title` VARCHAR(500)  NOT NULL,
	`url` VARCHAR(500),
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `news_FI_1` (`user_id`),
	CONSTRAINT `news_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `users` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- afisha_city
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `afisha_city`;


CREATE TABLE `afisha_city`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(500)  NOT NULL,
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- afisha_theater
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `afisha_theater`;


CREATE TABLE `afisha_theater`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`afisha_city_id` INTEGER  NOT NULL,
	`title` VARCHAR(500)  NOT NULL,
	`logo` VARCHAR(255),
	`link` VARCHAR(255),
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `afisha_theater_FI_1` (`afisha_city_id`),
	CONSTRAINT `afisha_theater_FK_1`
		FOREIGN KEY (`afisha_city_id`)
		REFERENCES `afisha_city` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- afisha
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `afisha`;


CREATE TABLE `afisha`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`afisha_theater_id` INTEGER  NOT NULL,
	`title` VARCHAR(500)  NOT NULL,
	`logo` VARCHAR(255),
	`link` VARCHAR(255),
	`description` TEXT,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `afisha_FI_1` (`afisha_theater_id`),
	CONSTRAINT `afisha_FK_1`
		FOREIGN KEY (`afisha_theater_id`)
		REFERENCES `afisha_theater` (`id`)
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- afisha_zal
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `afisha_zal`;


CREATE TABLE `afisha_zal`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`afisha_theater_id` INTEGER  NOT NULL,
	`afisha_id` INTEGER  NOT NULL,
	`title` VARCHAR(500)  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `afisha_zal_FI_1` (`afisha_theater_id`),
	CONSTRAINT `afisha_zal_FK_1`
		FOREIGN KEY (`afisha_theater_id`)
		REFERENCES `afisha_theater` (`id`)
		ON DELETE CASCADE,
	INDEX `afisha_zal_FI_2` (`afisha_id`),
	CONSTRAINT `afisha_zal_FK_2`
		FOREIGN KEY (`afisha_id`)
		REFERENCES `afisha` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- afisha_zal_time
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `afisha_zal_time`;


CREATE TABLE `afisha_zal_time`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`afisha_zal_id` INTEGER  NOT NULL,
	`afisha_id` INTEGER  NOT NULL,
	`time` DATETIME  NOT NULL,
	PRIMARY KEY (`id`),
	INDEX `afisha_zal_time_FI_1` (`afisha_zal_id`),
	CONSTRAINT `afisha_zal_time_FK_1`
		FOREIGN KEY (`afisha_zal_id`)
		REFERENCES `afisha_zal` (`id`)
		ON DELETE CASCADE,
	INDEX `afisha_zal_time_FI_2` (`afisha_id`),
	CONSTRAINT `afisha_zal_time_FK_2`
		FOREIGN KEY (`afisha_id`)
		REFERENCES `afisha` (`id`)
		ON DELETE CASCADE
)Type=InnoDB;

#-----------------------------------------------------------------------------
#-- static_pages
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `static_pages`;


CREATE TABLE `static_pages`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(500)  NOT NULL,
	`url` VARCHAR(500),
	`sort` INTEGER default 0,
	`description` TEXT,
	`is_visible` TINYINT default 1 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
