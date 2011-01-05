-- DB Change Log: useful when trying to implement template features on an existing database

-- BDH 20101213 - adding force password and profile update flags
-- x8
ALTER TABLE `user` ADD `force_update_password_flag` TINYINT( 1 ) UNSIGNED NOT NULL ,
ADD `force_update_profile_flag` TINYINT( 1 ) UNSIGNED NOT NULL ;
-- x8

-- DH 20110104 - adding the change log table and removing old claero_change
-- x8
CREATE TABLE `change_log` (
  `id` int(11) NOT NULL auto_increment,
  `event_timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `table_name` varchar(64) collate utf8_unicode_ci NOT NULL,
  `record_pk` int(11) NOT NULL,
  `query_type` varchar(12) collate utf8_unicode_ci NOT NULL,
  `row_count` int(11) NOT NULL,
  `sql` varchar(15000) collate utf8_unicode_ci NOT NULL,
  `changed` varchar(5000) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `table_name` (`table_name`),
  KEY `query_type` (`query_type`),
  KEY `record_pk` (`record_pk`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

DROP TABLE `claero_change` ;
-- x8

-- DH 20110104 - adding permission for access to the DB Admin link
-- This needs to be added to the appropriate group as well
-- x8
INSERT INTO `permission` VALUES(NULL, 'cl4admin', 'DB Admin Access', 'Gives access to DB Admin, although other permissions are required to access individual models/tables and actions.');
-- x8