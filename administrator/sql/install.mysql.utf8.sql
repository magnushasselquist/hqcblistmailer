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


INSERT INTO `#__content_types` (`type_title`, `type_alias`, `table`, `content_history_options`)
SELECT * FROM ( SELECT 'Email template','com_hqcblistmailer.emailtemplate','{"special":{"dbtable":"#__hqcblistmailer_emails","key":"id","type":"Email template","prefix":"HQ CB list-mailerTable"}}', '{"formFile":"administrator\/components\/com_hqcblistmailer\/models\/forms\/emailtemplate.xml", "hideFields":["checked_out","checked_out_time","params","language" ,"emailbody"], "ignoreChanges":["modified_by", "modified", "checked_out", "checked_out_time"], "convertToInt":["publish_up", "publish_down"], "displayLookup":[{"sourceColumn":"catid","targetTable":"#__categories","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"group_id","targetTable":"#__usergroups","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"created_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"},{"sourceColumn":"access","targetTable":"#__viewlevels","targetColumn":"id","displayColumn":"title"},{"sourceColumn":"modified_by","targetTable":"#__users","targetColumn":"id","displayColumn":"name"}]}') AS tmp
WHERE NOT EXISTS (
	SELECT type_alias FROM `#__content_types` WHERE (`type_alias` = 'com_hqcblistmailer.emailtemplate')
) LIMIT 1;
