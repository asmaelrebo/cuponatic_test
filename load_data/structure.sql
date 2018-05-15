USE cuponatic_test;
-- CREATE TABLE "products" ------------------------------------
CREATE TABLE `products` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`title` VarChar( 255 ) CHARACTER SET utf8 NOT NULL,
	`description` Text CHARACTER SET utf8 NOT NULL,
	`start_date` DateTime NOT NULL,
	`end_date` DateTime NOT NULL,
	`price` Int( 11 ) NOT NULL,
	`image` VarChar( 255 ) CHARACTER SET utf8 NOT NULL,
	`sold` Int( 11 ) NOT NULL,
	`tags` Text CHARACTER SET utf8 NOT NULL,
	`count_total` Int( 11 ) NOT NULL,
	PRIMARY KEY ( `id` ) )
CHARACTER SET = utf8
ENGINE = InnoDB
AUTO_INCREMENT = 1;
-- ------------------------------------------------------------

-- CREATE TABLE "search_statistics" -------------------------------------
CREATE TABLE `search_statistics` ( 
	`id` Int( 11 ) UNSIGNED AUTO_INCREMENT NOT NULL,
	`product_id` Int( 11 ) NOT NULL,
	`keyword` VarChar( 255 ) NOT NULL,
	`count` Int(11) NOT NULL,
	`created_at` DateTime NOT NULL,
	`updated_at` DateTime,
	PRIMARY KEY ( `id` ) )
ENGINE = InnoDB;
-- -------------------------------------------------------------
