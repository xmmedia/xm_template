# 2010/12/13 - BDH: Issue #37 ----------------------------------------------------------------------

ALTER TABLE `user` ADD `force_update_password_flag` TINYINT( 1 ) UNSIGNED NOT NULL ,
ADD `force_update_profile_flag` TINYINT( 1 ) UNSIGNED NOT NULL ;