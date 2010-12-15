# 2010/12/13 - BDH: Issue #37 ----------------------------------------------------------------------

ALTER TABLE `user` MODIFY COLUMN `id` INT(11) NOT NULL,
 ADD COLUMN `force_update_password_flag` TINYINT UNSIGNED NOT NULL DEFAULT 0 AFTER `reset_token`,
 ADD COLUMN `force_update_profile_flag` TINYINT UNSIGNED NOT NULL DEFAULT 0 AFTER `force_update_password_flag`;
