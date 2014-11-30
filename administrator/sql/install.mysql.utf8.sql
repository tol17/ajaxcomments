CREATE TABLE IF NOT EXISTS `#__comment` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`name` VARCHAR(50)  NOT NULL ,
`email` VARCHAR(255)  NOT NULL ,
`tel` VARCHAR(45)  NULL ,
`comment` TEXT NULL ,
`file` VARCHAR(255)  NULL ,
`answer` TINYINT(1)  NOT NULL ,
`date` DATETIME NOT NULL ,
PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT COLLATE=utf8_general_ci;

