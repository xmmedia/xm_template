-- phpMyAdmin SQL Dump
-- version 2.11.9.4
-- http://www.phpmyadmin.net
--
-- Host:
-- Generation Time: Nov 09, 2010 at 11:42 PM
-- Server version: 5.1.50
-- PHP Version: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `templat4_core`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_log`
--

CREATE TABLE `auth_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_time` datetime NOT NULL,
  `auth_type_id` int(11) NOT NULL,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `display_order` smallint(6) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `claero_change`
--

CREATE TABLE `claero_change` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sql` varchar(4096) COLLATE utf8_unicode_ci NOT NULL,
  `table_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `record_id` int(11) NOT NULL,
  `query_type` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `row_count` int(11) NOT NULL,
  `query_time` decimal(10,3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `table_name` (`table_name`),
  KEY `query_type` (`query_type`),
  KEY `record_id` (`record_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `claero_change`
--

-- --------------------------------------------------------

--
-- Table structure for table `demo`
--

CREATE TABLE `demo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `checkbox` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `datetime` datetime NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `hidden` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `radio` tinyint(1) NOT NULL,
  `demo_sub_id` int(11) NOT NULL,
  `textarea` text COLLATE utf8_unicode_ci NOT NULL,
  `yes_no` tinyint(1) NOT NULL,
  `public_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `public_original_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `private_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `private_original_filename` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `demo`
--

INSERT INTO `demo` VALUES(2, 'Text', 0, '2010-10-14', '2010-10-19 08:58:45', 2, 'blah 1', '', '011-554-524-9876-123', 2, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu risus in eros aliquam ultricies nec sit amet purus. Nulla et nibh eros. Integer id lacus in risus auctor iaculis. Etiam rhoncus suscipit feugiat. Vivamus vitae pulvinar risus. Nulla porta turpis in purus consequat dictum. Sed et augue dolor, sed vulputate felis. Duis at nisi tortor, vitae venenatis arcu. Etiam vel cursus augue. Donec at mauris nunc. Morbi egestas dolor ac massa tincidunt sit amet malesuada elit porta. Nullam elit purus, tincidunt ac gravida sit amet, vestibulum et ligula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer risus lectus, malesuada vitae pharetra mollis, accumsan non tortor. Mauris at diam in elit rhoncus volutpat nec at neque. Aenean nec augue sit amet lacus luctus convallis sed et odio. Proin facilisis, lorem eu placerat vulputate, odio elit pulvinar urna, in tincidunt massa neque eget lorem.', 2, '1289109933_001.jpg', '001.jpg', '027.jpg', '027.jpg');
INSERT INTO `demo` VALUES(3, 'Text 2', 1, '0000-00-00', '0000-00-00 00:00:00', 1, '', '', '----', 0, 1, 'a big bunch of text!', 0, '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `demo_sub`
--

CREATE TABLE `demo_sub` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expiry_date` datetime NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `display_order` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_expired` (`id`,`expiry_date`,`display_order`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `demo_sub`
--

INSERT INTO `demo_sub` VALUES(1, '0000-00-00 00:00:00', 'Option 1', 3);
INSERT INTO `demo_sub` VALUES(2, '0000-00-00 00:00:00', 'Option 2', 2);
INSERT INTO `demo_sub` VALUES(4, '2010-11-04 23:22:57', 'Option 3', 3);
INSERT INTO `demo_sub` VALUES(5, '2010-11-04 23:23:21', 'Options 4', 3);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` VALUES(1, 'account/profile', 'Edit Profile', 'Can edit their profile, including changing their password.');
INSERT INTO `permission` VALUES(2, 'claeroadmin/*/add', 'Database Admin Add', 'Can add or add similar any item in the DB Admin.');
INSERT INTO `permission` VALUES(3, 'claeroadmin/*/edit', 'Database Admin Edit', 'Can edit any items in the DB Admin.');
INSERT INTO `permission` VALUES(4, 'claeroadmin/*/search', 'Database Admin Search', 'Can search for any items in the DB Admin.');
INSERT INTO `permission` VALUES(5, 'claeroadmin/*/export', 'Database Admin Export', 'Can export any items in the DB Admin.');
INSERT INTO `permission` VALUES(6, 'claeroadmin/*/delete', 'Database Admin Delete', 'Can delete any item in the DB Admin.');
INSERT INTO `permission` VALUES(7, 'claeroadmin/*/view', 'Database Admin View', 'Can view any item in the DB Admin.');
INSERT INTO `permission` VALUES(8, 'claeroadmin/*/index', 'Database Admin List', 'Can view a list of items in the DB Admin.');
INSERT INTO `permission` VALUES(9, 'claeroadmin/model_create', 'Database Admin Model Create', 'Can create PHP models from the DB Admin. (Unique from other DB Admin permissions.)');
INSERT INTO `permission` VALUES(10, 'claeroadmin/useradmin/*', 'Database Admin - User', 'Can perform all possible actions on users in the DB Admin (add, edit, delete, search, view, list, export).');

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expiry_date` datetime NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active_flag` tinyint(1) NOT NULL,
  `login_count` smallint(6) NOT NULL,
  `last_login` datetime NOT NULL,
  `failed_login_count` mediumint(9) NOT NULL,
  `last_failed_login` datetime NOT NULL,
  `reset_token` char(32) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `password` (`password`),
  KEY `active_flag` (`active_flag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES(1, '0000-00-00 00:00:00', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'Account', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '');
INSERT INTO `user` VALUES(2, '0000-00-00 00:00:00', 'craig@nakamoto.ca', '0d107d09f5bbe40cade3de5c71e9e9b7', 'Craig', 'Nakamoto', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '');
INSERT INTO `user` VALUES(3, '0000-00-00 00:00:00', 'user@example.com', 'd41d8cd98f00b204e9800998ecf8427e', 'User', '#1', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`,`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` VALUES(1, 1, 2);
INSERT INTO `user_group` VALUES(2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime NOT NULL,
  `date_expired` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_expired` (`date_expired`,`user_id`,`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_token`
--

