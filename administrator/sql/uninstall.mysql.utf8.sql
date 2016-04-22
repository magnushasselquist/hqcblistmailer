DROP TABLE IF EXISTS `#__hqcblistmailer_emails`;

DELETE FROM `#__content_types` WHERE (type_alias LIKE 'com_hqcblistmailer.%');