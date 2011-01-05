-- phpMyAdmin SQL Dump
-- version 2.11.9.4
-- http://www.phpmyadmin.net
--
-- Host:
-- Generation Time: Nov 26, 2010 at 01:47 AM
-- Server version: 5.0.77
-- PHP Version: 5.2.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `journeyx_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_log`
--

CREATE TABLE `auth_log` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) collate utf8_unicode_ci NOT NULL,
  `access_time` datetime NOT NULL,
  `auth_type_id` int(11) NOT NULL,
  `browser` varchar(255) collate utf8_unicode_ci NOT NULL,
  `ip_address` varchar(15) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `access_type_id` (`auth_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `auth_type`
--

CREATE TABLE `auth_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) collate utf8_unicode_ci NOT NULL,
  `display_order` smallint(6) NOT NULL,
  PRIMARY KEY  (`id`),
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

--
-- Dumping data for table `change_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `demo`
--

CREATE TABLE `demo` (
  `id` int(11) NOT NULL auto_increment,
  `text` varchar(50) collate utf8_unicode_ci NOT NULL,
  `checkbox` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  `datetime` datetime NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `hidden` varchar(10) collate utf8_unicode_ci NOT NULL,
  `password` varchar(50) collate utf8_unicode_ci NOT NULL,
  `phone` varchar(32) collate utf8_unicode_ci NOT NULL,
  `radio` tinyint(1) NOT NULL,
  `demo_sub_id` int(11) NOT NULL,
  `textarea` text collate utf8_unicode_ci NOT NULL,
  `yes_no` tinyint(1) NOT NULL,
  `public_filename` varchar(255) collate utf8_unicode_ci NOT NULL,
  `public_original_filename` varchar(255) collate utf8_unicode_ci NOT NULL,
  `private_filename` varchar(255) collate utf8_unicode_ci NOT NULL,
  `private_original_filename` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `demo`
--

INSERT INTO `demo` VALUES(2, 'Text', 0, '2010-10-14', '2010-10-19 08:58:45', 2, 'blah 1', '', '011-554-524-9876-123', 2, 2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam eu risus in eros aliquam ultricies nec sit amet purus. Nulla et nibh eros. Integer id lacus in risus auctor iaculis. Etiam rhoncus suscipit feugiat. Vivamus vitae pulvinar risus. Nulla porta turpis in purus consequat dictum. Sed et augue dolor, sed vulputate felis. Duis at nisi tortor, vitae venenatis arcu. Etiam vel cursus augue. Donec at mauris nunc. Morbi egestas dolor ac massa tincidunt sit amet malesuada elit porta. Nullam elit purus, tincidunt ac gravida sit amet, vestibulum et ligula. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Integer risus lectus, malesuada vitae pharetra mollis, accumsan non tortor. Mauris at diam in elit rhoncus volutpat nec at neque. Aenean nec augue sit amet lacus luctus convallis sed et odio. Proin facilisis, lorem eu placerat vulputate, odio elit pulvinar urna, in tincidunt massa neque eget lorem.', 2, '1289109933_001.jpg', '001.jpg', '027.jpg', '027.jpg');
INSERT INTO `demo` VALUES(3, 'Text 2', 1, '0000-00-00', '0000-00-00 00:00:00', 1, '', '', '----', 0, 1, 'a big bunch of text!', 0, '', '', '', '');
INSERT INTO `demo` VALUES(7, 'Test', 1, '2010-11-10', '0000-00-00 00:00:00', 0, '', '', '1-613-744-7011-123', 2, 0, '', 0, '1289405446_dsc09926c-400.png', 'DSC09926c-400.png', '20101022-nakamoto-resume.pdf', '20101022-nakamoto-resume.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `demo_sub`
--

CREATE TABLE `demo_sub` (
  `id` int(11) NOT NULL auto_increment,
  `expiry_date` datetime NOT NULL,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `display_order` smallint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `date_expired` (`id`,`expiry_date`,`display_order`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `demo_sub`
--

INSERT INTO `demo_sub` VALUES(1, '0000-00-00 00:00:00', 'Option 1', 3);
INSERT INTO `demo_sub` VALUES(2, '0000-00-00 00:00:00', 'Option 2', 2);
INSERT INTO `demo_sub` VALUES(4, '2010-11-04 23:22:57', 'Option 3', 3);
INSERT INTO `demo_sub` VALUES(5, '2010-11-04 23:23:21', 'Options 3', 3);
INSERT INTO `demo_sub` VALUES(6, '0000-00-00 00:00:00', 'Option 3', 3);
INSERT INTO `demo_sub` VALUES(7, '0000-00-00 00:00:00', 'Option 4', 4);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `id` int(11) NOT NULL auto_increment,
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
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
  `id` int(11) NOT NULL auto_increment,
  `permission` varchar(255) collate utf8_unicode_ci NOT NULL,
  `name` varchar(150) collate utf8_unicode_ci NOT NULL,
  `description` varchar(500) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
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
INSERT INTO `permission` VALUES(11, 'cl4admin', 'DB Admin Access', 'Gives access to DB Admin, although other permissions are required to access individual models/tables and actions.');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_id` varchar(24) collate utf8_unicode_ci NOT NULL,
  `last_active` int(10) unsigned NOT NULL,
  `contents` longtext collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`session_id`),
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
  `force_update_password_flag` tinyint(1) unsigned NOT NULL,
  `force_update_profile_flag` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `password` (`password`),
  KEY `active_flag` (`active_flag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES(1, '0000-00-00 00:00:00', 'admin@admin.com', '4668682c67aa41e5abeefb3989dbf7879d14290099bdd892f8', 'Admin', 'Admin', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0, 0);
INSERT INTO `user` VALUES(2, '0000-00-00 00:00:00', 'craig@nakamoto.ca', '8804290dc243b37f4e3f83e53ff5a9334aabd0e4446b5e86f0', 'Craig', 'Nakamoto', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0, 0);
INSERT INTO `user` VALUES(3, '0000-00-00 00:00:00', 'user@example.com', '526faa0fb5f3e551a8b6904fd6108a92ffb2392f6751b27b7e', 'User1', '#1', 1, 0, '0000-00-00 00:00:00', 1, '0000-00-00 00:00:00', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `user_id` (`user_id`,`group_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` VALUES(1, 1, 1);
INSERT INTO `user_group` VALUES(2, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL auto_increment,
  `date_created` datetime NOT NULL,
  `date_expired` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(35) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `date_expired` (`date_expired`,`user_id`,`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_token`
--