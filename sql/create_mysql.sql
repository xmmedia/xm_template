-- phpMyAdmin SQL Dump
-- version 2.11.9.4
-- http://www.phpmyadmin.net
--
-- Host:
-- Generation Time: Jan 13, 2011 at 12:53 AM
-- Server version: 5.1.50
-- PHP Version: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `templat4_core`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_log`
--

CREATE TABLE `auth_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_time` datetime NOT NULL,
  `auth_type_id` int(11) unsigned NOT NULL,
  `browser` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `access_type_id` (`auth_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_log`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_type`
--

CREATE TABLE `auth_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `display_order` smallint(6) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `display_order` (`display_order`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_type`
--

INSERT INTO `auth_type` VALUES(1, 'Logged In', 1);
INSERT INTO `auth_type` VALUES(2, 'Logged Out', 2);
INSERT INTO `auth_type` VALUES(3, 'Invalid Password', 3);
INSERT INTO `auth_type` VALUES(4, 'Invalid Username & Password', 4);
INSERT INTO `auth_type` VALUES(5, 'Unknown Error', 5);
INSERT INTO `auth_type` VALUES(6, 'Too Many Attempts', 6);
INSERT INTO `auth_type` VALUES(8, 'Verifying Human', 7);

-- --------------------------------------------------------

--
-- Table structure for table `change_log`
--

CREATE TABLE `change_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `event_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) unsigned NOT NULL,
  `table_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `record_pk` int(11) unsigned NOT NULL,
  `query_type` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `row_count` int(11) unsigned NOT NULL,
  `sql` varchar(15000) COLLATE utf8_unicode_ci NOT NULL,
  `changed` varchar(5000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `table_name` (`table_name`),
  KEY `query_type` (`query_type`),
  KEY `record_pk` (`record_pk`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `change_log`
--

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group`
--

INSERT INTO `group` VALUES(1, 'System Administrator', 'Programmer level administrator who can access database admin, etc.');
INSERT INTO `group` VALUES(2, 'Administrator', 'Client administrator, can edit user table.');

-- --------------------------------------------------------

--
-- Table structure for table `group_permission`
--

CREATE TABLE `group_permission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(11) unsigned NOT NULL,
  `permission_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_id` (`group_id`,`permission_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `group_permission`
--

INSERT INTO `group_permission` VALUES(1, 1, 1);
INSERT INTO `group_permission` VALUES(2, 1, 2);
INSERT INTO `group_permission` VALUES(3, 1, 3);
INSERT INTO `group_permission` VALUES(4, 1, 4);
INSERT INTO `group_permission` VALUES(5, 1, 5);
INSERT INTO `group_permission` VALUES(6, 1, 6);
INSERT INTO `group_permission` VALUES(7, 1, 7);
INSERT INTO `group_permission` VALUES(8, 1, 8);
INSERT INTO `group_permission` VALUES(9, 1, 9);
INSERT INTO `group_permission` VALUES(10, 2, 1);
INSERT INTO `group_permission` VALUES(11, 2, 10);
INSERT INTO `group_permission` VALUES(12, 1, 22);
INSERT INTO `group_permission` VALUES(13, 2, 22);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` VALUES(1, 'account/profile', 'Edit Profile', 'Can edit their profile, including changing their password.');
INSERT INTO `permission` VALUES(2, 'cl4admin/*/add', 'Database Admin Add', 'Can add or add similar any item in the DB Admin.');
INSERT INTO `permission` VALUES(3, 'cl4admin/*/edit', 'Database Admin Edit', 'Can edit any items in the DB Admin.');
INSERT INTO `permission` VALUES(4, 'cl4admin/*/search', 'Database Admin Search', 'Can search for any items in the DB Admin.');
INSERT INTO `permission` VALUES(5, 'cl4admin/*/export', 'Database Admin Export', 'Can export any items in the DB Admin.');
INSERT INTO `permission` VALUES(6, 'cl4admin/*/delete', 'Database Admin Delete', 'Can delete any item in the DB Admin.');
INSERT INTO `permission` VALUES(7, 'cl4admin/*/view', 'Database Admin View', 'Can view any item in the DB Admin.');
INSERT INTO `permission` VALUES(8, 'cl4admin/*/index', 'Database Admin List', 'Can view a list of items in the DB Admin.');
INSERT INTO `permission` VALUES(9, 'cl4admin/model_create', 'Database Admin Model Create', 'Can create PHP models from the DB Admin. (Unique from other DB Admin permissions.)');
INSERT INTO `permission` VALUES(10, 'cl4admin/useradmin/*', 'Database Admin - User', 'Can perform all possible actions on users in the DB Admin (add, edit, delete, search, view, list, export).');
INSERT INTO `permission` VALUES(22, 'cl4admin', 'DB Admin Access', 'Gives access to DB Admin, although other permissions are required to access individual models/tables and actions.');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `last_active` int(10) unsigned NOT NULL,
  `contents` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_active` (`last_active`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `session`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `expiry_date` datetime NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active_flag` tinyint(1) unsigned NOT NULL,
  `login_count` smallint(6) unsigned NOT NULL,
  `last_login` datetime NOT NULL,
  `failed_login_count` mediumint(9) unsigned NOT NULL,
  `last_failed_login` datetime NOT NULL,
  `reset_token` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `force_update_password_flag` tinyint(1) unsigned NOT NULL,
  `force_update_profile_flag` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`expiry_date`,`username`),
  KEY `active_flag` (`active_flag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci; 

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES(1, '0000-00-00 00:00:00', 'admin@admin.com', '530a807bf7906acb79edb3b181956805048afcadf0a71f9037', 'Admin', 'Admin', 1, 286, '2011-01-04 22:28:42', 0, '2011-01-03 14:09:13', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` VALUES(1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date_created` datetime NOT NULL,
  `date_expired` datetime NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `token` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_expired` (`date_expired`,`user_id`,`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_token`
--
