CREATE TABLE IF NOT EXISTS `#__hqcblistmailer_emails` (
`id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,

`ordering` INT(11)  NOT NULL ,
`state` TINYINT(1)  NOT NULL ,
`checked_out` INT(11)  NOT NULL ,
`checked_out_time` DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
`emailsender` VARCHAR(255)  NOT NULL ,
`emailsendername` VARCHAR(255)  NOT NULL ,
`emailsubject` VARCHAR(255)  NOT NULL ,
`emailcblist` TEXT NOT NULL ,
`emailtofield` TEXT NOT NULL ,
`emailtonamefield` TEXT NOT NULL ,
`emailccfield1` TEXT NOT NULL ,
`emailccfield2` TEXT NOT NULL ,
`emailccfield3` TEXT NOT NULL ,
`emailbody` TEXT NOT NULL ,
`emailfieldsavailable` TEXT NOT NULL ,
`created_by` INT(11)  NOT NULL ,
PRIMARY KEY (`id`)
) DEFAULT COLLATE=utf8_general_ci;

