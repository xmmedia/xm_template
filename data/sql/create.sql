-- Authorization roles

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- Default roles 

INSERT INTO `roles`
    (`id`, `name`, `description`)
VALUES
    (1, 'Login', 'Login privileges, granted after account confirmation');

-- Groups

CREATE TABLE IF NOT EXISTS `groups` (
  `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;
 
-- Default groups

INSERT INTO `groups`
    (`id`, `name`, `description`)
VALUES
    (1, 'Superuser', 'Superuser.  Can do anything without needing specific roles.'),
    (2, 'User', 'Basic user.  May log in.');

-- Users
 
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `password` char(50) NOT NULL,
  `name` varchar(75) NOT NULL,
  `logins` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `last_login` int(10) UNSIGNED,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Default administrative user, password "admin1" with default salt

INSERT INTO `users`
    (`id`, `email`, `password` )
VALUES
    (1, 'admin@admin.com', 'af47bcfd2b57fb330b72b117250a011a23c49d7a3f32f5fb9a');

-- Session tokens for users

CREATE TABLE IF NOT EXISTS `user_tokens` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `user_agent` varchar(40) NOT NULL,
  `token` varchar(32) NOT NULL,
  `created` int(10) UNSIGNED NOT NULL,
  `expires` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `uniq_token` (`token`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `FK_user_tokens_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

-- Which groups have what roles

CREATE TABLE `groups_roles` (
  `group_id` INTEGER UNSIGNED NOT NULL,
  `role_id` INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY (`group_id`, `role_id`),
  CONSTRAINT `FK_groups_roles_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_groups_roles_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

-- Default roles for default groups

INSERT INTO `groups_roles`
    (`group_id`, `role_id`)
VALUES
    (2, 1); -- Users need Login role

-- What groups users are in

CREATE TABLE `users_groups` (
  `user_id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `group_id` INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`, `group_id`),
  CONSTRAINT `FK_users_groups_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_users_groups_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

-- Default admin user in default group

INSERT INTO `users_groups`
    (`user_id`, `group_id`)
VALUES
    (1, 1); -- Admin is a superuser