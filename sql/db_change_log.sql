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

-- DH 20110112 - changing all integer fields to unsigned
-- x8
ALTER TABLE `auth_log` CHANGE `id` `id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `user_id` `user_id` INT( 11 ) UNSIGNED NOT NULL ,
CHANGE `auth_type_id` `auth_type_id` INT( 11 ) UNSIGNED NOT NULL ;
ALTER TABLE `auth_type` CHANGE `id` `id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `display_order` `display_order` SMALLINT( 6 ) UNSIGNED NOT NULL ;
ALTER TABLE `change_log` CHANGE `id` `id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `user_id` `user_id` INT( 11 ) UNSIGNED NOT NULL ,
CHANGE `record_pk` `record_pk` INT( 11 ) UNSIGNED NOT NULL ,
CHANGE `row_count` `row_count` INT( 11 ) UNSIGNED NOT NULL ;
ALTER TABLE `group` CHANGE `id` `id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ;
ALTER TABLE `group_permission` CHANGE `id` `id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `group_id` `group_id` INT( 11 ) UNSIGNED NOT NULL ,
CHANGE `permission_id` `permission_id` INT( 11 ) UNSIGNED NOT NULL ;
ALTER TABLE `permission` CHANGE `id` `id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ;
ALTER TABLE `user` CHANGE `id` `id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `active_flag` `active_flag` TINYINT( 1 ) UNSIGNED NOT NULL ;
ALTER TABLE `user` CHANGE `login_count` `login_count` SMALLINT( 6 ) UNSIGNED NOT NULL ,
CHANGE `failed_login_count` `failed_login_count` MEDIUMINT( 9 ) UNSIGNED NOT NULL ;
ALTER TABLE `user_group` CHANGE `id` `id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `user_id` `user_id` INT( 11 ) UNSIGNED NOT NULL ,
CHANGE `group_id` `group_id` INT( 11 ) UNSIGNED NOT NULL ;
ALTER TABLE `user_token` CHANGE `id` `id` INT( 11 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE `user_id` `user_id` INT( 11 ) UNSIGNED NOT NULL ;
-- x8

-- DH 20110210 - adding expiry date to the username key (so usernames can be reused) and removing the unused password key
-- x8
ALTER TABLE `user` DROP INDEX `username` ,
ADD UNIQUE `username` ( `expiry_date` , `username` ) ;
ALTER TABLE `user` DROP INDEX `password` ;
-- x8

-- DH 20110212 - changing the length of the password field to allow long password hashes
-- x8
ALTER TABLE `user` CHANGE `password` `password` CHAR( 100 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ;
-- x8

-- DH 20110213 - adding a unique key the permission column in permission
-- x8
ALTER TABLE `permission` ADD UNIQUE `permission` ( `permission` );
-- x8

-- DH 20110213 - changing the sql and changed fields in change_log to longtext to support an almost unlimited length
-- x8
ALTER TABLE `change_log` CHANGE `sql` `sql` LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
CHANGE `changed` `changed` LONGTEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ;
-- x8

-- DH 20110313 - changing the defaults of integer fields to 0
-- x8
ALTER TABLE `auth_log` CHANGE `user_id` `user_id` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `auth_type_id` `auth_type_id` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0' ;
ALTER TABLE `auth_type` CHANGE `display_order` `display_order` SMALLINT( 6 ) UNSIGNED NOT NULL DEFAULT '0' ;
ALTER TABLE `change_log` CHANGE `user_id` `user_id` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `record_pk` `record_pk` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `row_count` `row_count` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0' ;
ALTER TABLE `group_permission` CHANGE `group_id` `group_id` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `permission_id` `permission_id` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0' ;
ALTER TABLE `user` CHANGE `active_flag` `active_flag` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `login_count` `login_count` SMALLINT( 6 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `failed_login_count` `failed_login_count` MEDIUMINT( 9 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `force_update_password_flag` `force_update_password_flag` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `force_update_profile_flag` `force_update_profile_flag` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0' ;
ALTER TABLE `user_group` CHANGE `user_id` `user_id` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0',
CHANGE `group_id` `group_id` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0' ;
ALTER TABLE `user_token` CHANGE `user_id` `user_id` INT( 11 ) UNSIGNED NOT NULL DEFAULT '0' ;
-- x8