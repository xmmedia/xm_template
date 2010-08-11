-- phpMyAdmin SQL Dump
-- version 2.9.2
-- http://www.phpmyadmin.net
--
-- Server version: 5.0.27
-- PHP Version: 4.3.9

-- --------------------------------------------------------

--
-- Table structure for table `auth_log`
--

CREATE TABLE `auth_log` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `access_time` datetime NOT NULL,
  `auth_type_id` int(11) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `access_type_id` (`auth_type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `auth_type`
--

CREATE TABLE `auth_type` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(30) NOT NULL,
  `display_order` smallint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `display_order` (`display_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `auth_type`
--

INSERT INTO `auth_type` VALUES (1, 'Logged In', 1);
INSERT INTO `auth_type` VALUES (2, 'Logged Out', 2);
INSERT INTO `auth_type` VALUES (3, 'Invalid Password', 3);
INSERT INTO `auth_type` VALUES (4, 'Invalid Username', 4);
INSERT INTO `auth_type` VALUES (5, 'Failed to Populate Session', 5);
INSERT INTO `auth_type` VALUES (6, 'Invalid Username & Password', 6);
INSERT INTO `auth_type` VALUES (7, 'Unknown Error', 7);

-- --------------------------------------------------------

--
-- Table structure for table `claero_change`
--

CREATE TABLE `claero_change` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `event_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `sql` varchar(4096) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `record_id` int(11) NOT NULL,
  `query_type` varchar(12) NOT NULL,
  `row_count` int(11) NOT NULL,
  `query_time` decimal(10,3) unsigned NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `user_id` (`user_id`),
  KEY `table_name` (`table_name`),
  KEY `query_type` (`query_type`),
  KEY `record_id` (`record_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `claero_change`
--

-- --------------------------------------------------------

--
-- Table structure for table `claero_foreign`
--

CREATE TABLE `claero_foreign` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(128) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `column_name` varchar(128) NOT NULL,
  `foreign_table` varchar(64) NOT NULL,
  `foreign_column` varchar(128) NOT NULL,
  `delete_foreign_flag` tinyint(1) NOT NULL,
  `expire_foreign_flag` tinyint(1) NOT NULL default '0',
  `type` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `table_name` (`table_name`),
  KEY `column_name` (`column_name`),
  KEY `foreign_table` (`foreign_table`),
  KEY `foreign_column` (`foreign_column`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `claero_foreign`
--

INSERT INTO `claero_foreign` VALUES (1, 'claero_change - user_id', 'claero_change', 'user_id', 'user', 'id', 0, 0, '');
INSERT INTO `claero_foreign` VALUES (3, 'claero_form_field - claero_form_id', 'claero_form_field', 'claero_form_id', 'claero_form', 'id', 0, 0, '');
INSERT INTO `claero_foreign` VALUES (4, 'claero_form_table - claero_form_id', 'claero_form_table', 'claero_form_id', 'claero_form', 'id', 0, 0, '');
INSERT INTO `claero_foreign` VALUES (6, 'user_group - user_id', 'user_group', 'user_id', 'user', 'id', 0, 0, '');
INSERT INTO `claero_foreign` VALUES (7, 'user_group - group_id', 'user_group', 'group_id', 'group', 'id', 0, 0, '');
INSERT INTO `claero_foreign` VALUES (8, 'permission - page_id', 'permission', 'page_id', 'page', 'id', 0, 0, '');
INSERT INTO `claero_foreign` VALUES (9, 'group_permission - group_id', 'group_permission', 'group_id', 'group', 'id', 0, 0, '');
INSERT INTO `claero_foreign` VALUES (10, 'group_permission - permission_id', 'group_permission', 'permission_id', 'permission', 'id', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `claero_form`
--

CREATE TABLE `claero_form` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(128) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `claero_form`
--


-- --------------------------------------------------------

--
-- Table structure for table `claero_form_field`
--

CREATE TABLE `claero_form_field` (
  `id` int(11) NOT NULL auto_increment,
  `claero_form_id` int(11) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `column_name` varchar(128) NOT NULL,
  `search_flag` tinyint(1) NOT NULL default '0',
  `edit_flag` tinyint(1) NOT NULL default '0',
  `display_flag` tinyint(1) NOT NULL default '0',
  `required_flag` tinyint(1) NOT NULL default '0',
  `primary_flag` tinyint(1) NOT NULL,
  `display_order` smallint(6) NOT NULL,
  `reg_exp` varchar(1024) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `form_table_col` (`claero_form_id`,`table_name`,`column_name`),
  KEY `search_flag` (`search_flag`),
  KEY `edit_flag` (`edit_flag`),
  KEY `display_flag` (`display_flag`),
  KEY `required_flag` (`required_flag`),
  KEY `display_order` (`display_order`),
  KEY `primary_flag` (`primary_flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `claero_form_field`
--


-- --------------------------------------------------------

--
-- Table structure for table `claero_form_table`
--

CREATE TABLE `claero_form_table` (
  `id` int(11) NOT NULL auto_increment,
  `claero_form_id` int(11) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `primary_flag` tinyint(1) NOT NULL,
  `display_order` smallint(6) NOT NULL,
  `relationship` varchar(10) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `form_table` (`claero_form_id`,`table_name`),
  KEY `primary_flag` (`primary_flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `claero_form_table`
--


-- --------------------------------------------------------

--
-- Table structure for table `claero_meta`
--

CREATE TABLE `claero_meta` (
  `id` int(11) NOT NULL auto_increment,
  `table_name` varchar(64) NOT NULL,
  `column_name` varchar(128) NOT NULL,
  `label` varchar(255) NOT NULL,
  `search_flag` tinyint(1) NOT NULL,
  `edit_flag` tinyint(1) NOT NULL,
  `display_flag` tinyint(1) NOT NULL,
  `view_flag` tinyint(1) NOT NULL,
  `required_flag` tinyint(1) NOT NULL,
  `form_type` varchar(32) NOT NULL,
  `source_table` text NOT NULL,
  `id_field` varchar(128) NOT NULL,
  `name_field` varchar(128) NOT NULL,
  `form_value` varchar(1024) NOT NULL,
  `field_size` int(3) NOT NULL,
  `max_length` int(3) NOT NULL,
  `min_width` smallint(6) NOT NULL,
  `display_order` smallint(6) NOT NULL,
  `reg_exp` varchar(1024) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `table_col` (`table_name`,`column_name`),
  KEY `edit_flag` (`edit_flag`),
  KEY `display_flag` (`display_flag`),
  KEY `search_flag` (`search_flag`),
  KEY `display_order` (`display_order`),
  KEY `required_flag` (`required_flag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `claero_meta`
--

INSERT INTO `claero_meta` VALUES (118, 'auth_log', '', 'Auth Log', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (111, 'auth_log', 'id', 'Id', 0, 1, 0, 0, 0, 'hidden', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (112, 'auth_log', 'user_id', 'User', 1, 1, 1, 1, 0, 'select', 'SELECT id, CONCAT(username, '' - '', first_name, '' '', last_name) AS name FROM user ORDER BY name', 'id', 'name', '', 0, 0, 0, 1, '');
INSERT INTO `claero_meta` VALUES (113, 'auth_log', 'username', 'Username', 1, 1, 1, 1, 0, 'text', '', '', '', '', 30, 30, 0, 2, '');
INSERT INTO `claero_meta` VALUES (114, 'auth_log', 'access_time', 'Access Time', 1, 1, 1, 1, 0, 'datetime', '', '', '', '', 0, 0, 0, 3, '');
INSERT INTO `claero_meta` VALUES (115, 'auth_log', 'auth_type_id', 'Auth Type', 1, 1, 1, 1, 0, 'select', 'SELECT id, name FROM auth_type ORDER BY display_order, name', 'id', 'name', '', 0, 0, 0, 4, '');
INSERT INTO `claero_meta` VALUES (116, 'auth_log', 'browser', 'Browser', 1, 1, 1, 1, 0, 'text', '', '', '', '', 30, 255, 0, 5, '');
INSERT INTO `claero_meta` VALUES (117, 'auth_log', 'ip_address', 'Ip Address', 1, 1, 1, 1, 0, 'text', '', '', '', '', 30, 15, 0, 6, '');
INSERT INTO `claero_meta` VALUES (122, 'auth_type', '', 'Auth Type', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (119, 'auth_type', 'id', 'Id', 0, 1, 0, 0, 0, 'hidden', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (120, 'auth_type', 'name', 'Name', 1, 1, 1, 1, 0, 'text', '', '', '', '', 30, 30, 0, 1, '');
INSERT INTO `claero_meta` VALUES (121, 'auth_type', 'display_order', 'Display Order', 1, 1, 1, 1, 0, 'text', '', '', '', '', 6, 6, 0, 2, '');
INSERT INTO `claero_meta` VALUES (51, 'claero_change', '', 'Change Log', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (18, 'claero_change', 'id', 'Id', 0, 1, 0, 0, 0, 'hidden', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (19, 'claero_change', 'user_id', 'User', 1, 1, 1, 1, 0, 'select', 'SELECT id, CONCAT(first_name, '' '', last_name) AS name FROM user ORDER BY name', 'id', 'name', '', 0, 0, 0, 1, '');
INSERT INTO `claero_meta` VALUES (20, 'claero_change', 'event_time', 'Event Time', 1, 1, 1, 1, 0, 'text', '', '', '', '', 40, 0, 0, 2, '');
INSERT INTO `claero_meta` VALUES (21, 'claero_change', 'sql', 'Sql', 1, 1, 1, 1, 0, 'text_area', '', '', '', '', 60, 6, 0, 3, '');
INSERT INTO `claero_meta` VALUES (22, 'claero_change', 'table_name', 'Table Name', 1, 1, 1, 1, 0, 'text', '', '', '', '', 40, 64, 0, 4, '');
INSERT INTO `claero_meta` VALUES (23, 'claero_change', 'record_id', 'Record', 1, 1, 1, 1, 0, 'text', '', '', '', '', 0, 0, 0, 5, '');
INSERT INTO `claero_meta` VALUES (24, 'claero_change', 'query_type', 'Query Type', 1, 1, 1, 1, 0, 'text', '', '', '', '', 40, 12, 0, 6, '');
INSERT INTO `claero_meta` VALUES (25, 'claero_change', 'row_count', 'Row Count', 1, 1, 1, 1, 0, 'text', '', '', '', '', 40, 0, 0, 7, '');
INSERT INTO `claero_meta` VALUES (26, 'claero_change', 'query_time', 'Query Time', 1, 1, 1, 1, 0, 'text', '', '', '', '', 40, 0, 0, 8, '');
INSERT INTO `claero_meta` VALUES (52, 'claero_foreign', '', 'Foreign Keys', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (27, 'claero_foreign', 'id', 'Id', 0, 1, 0, 0, 0, 'hidden', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (28, 'claero_foreign', 'name', 'Name', 1, 1, 1, 1, 0, 'text', '', '', '', '', 40, 128, 0, 1, '');
INSERT INTO `claero_meta` VALUES (29, 'claero_foreign', 'table_name', 'Table Name', 1, 1, 1, 1, 0, 'table_select', '', '', '', '', 0, 0, 0, 2, '');
INSERT INTO `claero_meta` VALUES (30, 'claero_foreign', 'column_name', 'Column Name', 1, 1, 1, 1, 0, 'text', '', '', '', '', 40, 128, 0, 3, '');
INSERT INTO `claero_meta` VALUES (31, 'claero_foreign', 'foreign_table', 'Foreign Table', 1, 1, 1, 1, 0, 'table_select', '', '', '', '', 0, 0, 0, 4, '');
INSERT INTO `claero_meta` VALUES (32, 'claero_foreign', 'foreign_column', 'Foreign Column', 1, 1, 1, 1, 0, 'text', '', '', '', '', 40, 128, 0, 5, '');
INSERT INTO `claero_meta` VALUES (33, 'claero_foreign', 'delete_foreign_flag', 'Delete Foreign', 1, 1, 1, 1, 0, 'checkbox', '', '', '', '', 0, 0, 0, 6, '');
INSERT INTO `claero_meta` VALUES (34, 'claero_foreign', 'expire_foreign_flag', 'Expire Foreign', 1, 1, 1, 1, 0, 'checkbox', '', '', '', '', 0, 0, 0, 7, '');
INSERT INTO `claero_meta` VALUES (65, 'claero_foreign', 'type', 'Type', 1, 1, 1, 1, 0, 'text', '', '', '', '', 10, 10, 0, 9, '');
INSERT INTO `claero_meta` VALUES (53, 'claero_form', '', 'Meta Forms', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (35, 'claero_form', 'id', 'Id', 0, 1, 0, 0, 0, 'hidden', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (36, 'claero_form', 'name', 'Name', 1, 1, 1, 1, 0, 'text', '', '', '', '', 40, 128, 0, 1, '');
INSERT INTO `claero_meta` VALUES (54, 'claero_form_field', '', 'Meta Forms - Field', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (37, 'claero_form_field', 'id', 'Id', 0, 1, 0, 0, 0, 'hidden', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (38, 'claero_form_field', 'claero_form_id', 'Claero Form', 1, 1, 1, 1, 0, 'select', 'SELECT id, name FROM claero_form ORDER BY name', 'id', 'name', '', 0, 0, 0, 1, '');
INSERT INTO `claero_meta` VALUES (39, 'claero_form_field', 'table_name', 'Table Name', 1, 1, 1, 1, 0, 'table_select', '', '', '', '', 0, 0, 0, 2, '');
INSERT INTO `claero_meta` VALUES (40, 'claero_form_field', 'column_name', 'Column Name', 1, 1, 1, 1, 0, 'text', '', '', '', '', 40, 128, 0, 3, '');
INSERT INTO `claero_meta` VALUES (41, 'claero_form_field', 'search_flag', 'Search Flag', 1, 1, 1, 1, 0, 'checkbox', '', '', '', '', 0, 0, 0, 4, '');
INSERT INTO `claero_meta` VALUES (42, 'claero_form_field', 'edit_flag', 'Edit Flag', 1, 1, 1, 1, 0, 'checkbox', '', '', '', '', 0, 0, 0, 5, '');
INSERT INTO `claero_meta` VALUES (43, 'claero_form_field', 'display_flag', 'Display Flag', 1, 1, 1, 1, 0, 'checkbox', '', '', '', '', 0, 0, 0, 6, '');
INSERT INTO `claero_meta` VALUES (44, 'claero_form_field', 'required_flag', 'Required', 1, 1, 1, 1, 0, 'checkbox', '', '', '', '', 0, 0, 0, 7, '');
INSERT INTO `claero_meta` VALUES (45, 'claero_form_field', 'display_order', 'Display Order', 1, 1, 1, 1, 0, 'text', '', '', '', '', 40, 0, 0, 8, '');
INSERT INTO `claero_meta` VALUES (67, 'claero_form_field', 'primary_flag', 'Primary', 1, 1, 1, 1, 0, 'checkbox', '', '', '', '', 0, 0, 0, 10, '');
INSERT INTO `claero_meta` VALUES (68, 'claero_form_field', 'reg_exp', 'Reg Exp', 1, 1, 0, 0, 0, 'text', '', '', '', '', 30, 1024, 0, 11, '');
INSERT INTO `claero_meta` VALUES (55, 'claero_form_table', '', 'Meta Form - Table', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (46, 'claero_form_table', 'id', 'Id', 0, 1, 0, 0, 0, 'hidden', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (47, 'claero_form_table', 'claero_form_id', 'Claero Form', 1, 1, 1, 1, 0, 'select', 'SELECT id, name FROM claero_form ORDER BY name', 'id', 'name', '', 0, 0, 0, 1, '');
INSERT INTO `claero_meta` VALUES (48, 'claero_form_table', 'table_name', 'Table Name', 1, 1, 1, 1, 0, 'table_select', '', '', '', '', 0, 0, 0, 2, '');
INSERT INTO `claero_meta` VALUES (49, 'claero_form_table', 'display_order', 'Display Order', 1, 1, 1, 1, 0, 'text', '', '', '', '', 40, 0, 0, 3, '');
INSERT INTO `claero_meta` VALUES (66, 'claero_form_table', 'primary_flag', 'Primary', 1, 1, 1, 1, 0, 'checkbox', '', '', '', '', 0, 0, 0, 5, '');
INSERT INTO `claero_meta` VALUES (104, 'claero_form_table', 'relationship', 'Relationship', 1, 1, 1, 1, 0, 'text', '', '', '', '', 10, 10, 0, 6, '');
INSERT INTO `claero_meta` VALUES (50, 'claero_meta', '', 'Meta Data', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (1, 'claero_meta', 'id', 'Id', 0, 1, 0, 0, 0, 'hidden', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (2, 'claero_meta', 'table_name', 'Table Name', 1, 1, 1, 1, 0, 'table_select', '', '', '', '', 30, 64, 0, 1, '');
INSERT INTO `claero_meta` VALUES (3, 'claero_meta', 'column_name', 'Column Name', 1, 1, 1, 1, 0, 'text', '', '', '', '', 30, 128, 0, 2, '');
INSERT INTO `claero_meta` VALUES (4, 'claero_meta', 'label', 'Label', 1, 1, 1, 1, 0, 'text', '', '', '', '', 30, 255, 0, 3, '');
INSERT INTO `claero_meta` VALUES (5, 'claero_meta', 'search_flag', 'Search Flag', 1, 1, 1, 1, 0, 'checkbox', '', '', '', '', 0, 0, 0, 4, '');
INSERT INTO `claero_meta` VALUES (6, 'claero_meta', 'edit_flag', 'Edit Flag', 1, 1, 1, 1, 0, 'checkbox', '', '', '', '', 0, 0, 0, 5, '');
INSERT INTO `claero_meta` VALUES (7, 'claero_meta', 'display_flag', 'Display Flag', 1, 1, 1, 1, 0, 'checkbox', '', '', '', '', 0, 0, 0, 6, '');
INSERT INTO `claero_meta` VALUES (103, 'claero_meta', 'view_flag', 'View Flag', 1, 1, 1, 1, 0, 'checkbox', '', '', '', '', 0, 0, 0, 7, '');
INSERT INTO `claero_meta` VALUES (8, 'claero_meta', 'required_flag', 'Required', 1, 1, 1, 1, 0, 'checkbox', '', '', '', '', 0, 0, 0, 8, '');
INSERT INTO `claero_meta` VALUES (9, 'claero_meta', 'form_type', 'Form Type', 1, 1, 1, 1, 0, 'form_type', '', '', '', '', 30, 32, 0, 9, '');
INSERT INTO `claero_meta` VALUES (10, 'claero_meta', 'source_table', 'Source Table', 1, 1, 1, 1, 0, 'text_area', '', '', '', '', 60, 6, 0, 10, '');
INSERT INTO `claero_meta` VALUES (11, 'claero_meta', 'id_field', 'Id Field', 1, 1, 0, 0, 0, 'text', '', '', '', '', 30, 128, 0, 11, '');
INSERT INTO `claero_meta` VALUES (12, 'claero_meta', 'name_field', 'Name Field', 1, 1, 0, 0, 0, 'text', '', '', '', '', 30, 128, 0, 12, '');
INSERT INTO `claero_meta` VALUES (13, 'claero_meta', 'form_value', 'Form Value', 1, 1, 0, 0, 0, 'text_area', '', '', '', '', 30, 4, 0, 13, '');
INSERT INTO `claero_meta` VALUES (14, 'claero_meta', 'field_size', 'Field Size', 1, 1, 1, 1, 0, 'text', '', '', '', '', 3, 3, 0, 14, '');
INSERT INTO `claero_meta` VALUES (15, 'claero_meta', 'max_length', 'Max Length', 1, 1, 1, 1, 0, 'text', '', '', '', '', 3, 3, 0, 15, '');
INSERT INTO `claero_meta` VALUES (16, 'claero_meta', 'min_width', 'Min Width', 1, 1, 0, 0, 0, 'text', '', '', '', '', 6, 6, 0, 16, '');
INSERT INTO `claero_meta` VALUES (17, 'claero_meta', 'display_order', 'Display Order', 1, 1, 1, 1, 0, 'text', '', '', '', '', 6, 6, 0, 17, '');
INSERT INTO `claero_meta` VALUES (100, 'claero_meta', 'reg_exp', 'Reg Exp', 1, 1, 1, 1, 0, 'text_area', '', '', '', '', 40, 5, 0, 18, '');
INSERT INTO `claero_meta` VALUES (72, 'group', '', 'Groups', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (69, 'group', 'id', 'Id', 0, 1, 0, 0, 0, 'hidden', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (70, 'group', 'name', 'Name', 1, 1, 1, 1, 0, 'text', '', '', '', '', 30, 100, 0, 1, '');
INSERT INTO `claero_meta` VALUES (71, 'group', 'description', 'Description', 1, 1, 1, 1, 0, 'text_area', '', '', '', '', 50, 5, 0, 2, '');
INSERT INTO `claero_meta` VALUES (88, 'group_permission', '', 'Group - Permission', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (85, 'group_permission', 'id', 'Id', 0, 1, 0, 0, 0, 'hidden', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (86, 'group_permission', 'group_id', 'Group', 1, 1, 1, 1, 0, 'select', 'SELECT id, name FROM `group` ORDER BY name', 'id', 'name', '', 0, 0, 0, 1, '');
INSERT INTO `claero_meta` VALUES (87, 'group_permission', 'permission_id', 'Permission', 1, 1, 1, 1, 0, 'select', 'SELECT perm.id, CONCAT(p.name, '' ('', p.path, '') - '', perm.action) AS name FROM permission AS perm LEFT JOIN page AS p ON (p.id = perm.page_id) ORDER BY name', 'id', 'name', '', 0, 0, 0, 2, '');
INSERT INTO `claero_meta` VALUES (84, 'permission', '', 'Permissions', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (81, 'permission', 'id', 'Id', 0, 1, 0, 0, 0, 'hidden', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (82, 'permission', 'page_id', 'Page', 1, 1, 1, 1, 0, 'select', 'SELECT id, CONCAT_WS('''', name, '' ('', path, '')'') AS name FROM page ORDER BY name', 'id', 'name', '', 0, 0, 0, 1, '');
INSERT INTO `claero_meta` VALUES (83, 'permission', 'action', 'Action', 1, 1, 1, 1, 0, 'text', '', '', '', '', 30, 50, 0, 2, '');
INSERT INTO `claero_meta` VALUES (64, 'user', '', 'Users', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (56, 'user', 'id', 'Id', 0, 1, 0, 0, 0, 'hidden', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (57, 'user', 'username', 'Username / Email', 1, 1, 1, 1, 0, 'text', '', '', '', '', 30, 100, 0, 1, '');
INSERT INTO `claero_meta` VALUES (58, 'user', 'password', 'Password', 0, 1, 0, 0, 0, 'password', '', '', '', '', 30, 64, 0, 2, '');
INSERT INTO `claero_meta` VALUES (59, 'user', 'first_name', 'First Name', 1, 1, 1, 1, 0, 'text', '', '', '', '', 30, 128, 0, 3, '');
INSERT INTO `claero_meta` VALUES (60, 'user', 'last_name', 'Last Name', 1, 1, 1, 1, 0, 'text', '', '', '', '', 30, 128, 0, 4, '');
INSERT INTO `claero_meta` VALUES (62, 'user', 'inactive_flag', 'Inactive', 1, 1, 1, 1, 0, 'checkbox', '', '', '', '', 0, 0, 0, 7, '');
INSERT INTO `claero_meta` VALUES (63, 'user', 'login_count', 'Login Count', 0, 0, 1, 1, 0, 'text', '', '', '', '', 30, 0, 0, 8, '');
INSERT INTO `claero_meta` VALUES (101, 'user', 'passphrase_q', 'Passphrase Question', 1, 1, 0, 0, 0, 'text', '', '', '', '', 30, 150, 0, 8, '');
INSERT INTO `claero_meta` VALUES (102, 'user', 'passphrase_a', 'Passphrase Answer', 1, 1, 0, 0, 0, 'text', '', '', '', '', 30, 50, 0, 9, '');
INSERT INTO `claero_meta` VALUES (80, 'user_group', '', 'User - Group', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (77, 'user_group', 'id', 'Id', 0, 1, 0, 0, 0, 'hidden', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (78, 'user_group', 'user_id', 'User', 1, 1, 1, 1, 0, 'select', 'SELECT id, CONCAT(first_name, '' '', last_name) AS name FROM user ORDER BY name', 'id', 'name', '', 0, 0, 0, 1, '');
INSERT INTO `claero_meta` VALUES (79, 'user_group', 'group_id', 'Group', 1, 1, 1, 1, 0, 'select', 'SELECT id, name FROM `group` ORDER BY name', 'id', 'name', '', 0, 0, 0, 2, '');
INSERT INTO `claero_meta` VALUES (110, 'user_token', '', 'User - Token', 0, 0, 0, 0, 0, '', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (105, 'user_token', 'id', 'Id', 0, 1, 0, 0, 0, 'hidden', '', '', '', '', 0, 0, 0, 0, '');
INSERT INTO `claero_meta` VALUES (106, 'user_token', 'date_created', 'Date Created', 1, 1, 1, 1, 0, 'datetime', '', '', '', '', 0, 0, 0, 1, '');
INSERT INTO `claero_meta` VALUES (107, 'user_token', 'date_expired', 'Date Expired', 1, 1, 1, 1, 0, 'datetime', '', '', '', '', 0, 0, 0, 2, '');
INSERT INTO `claero_meta` VALUES (108, 'user_token', 'user_id', 'User', 1, 1, 1, 1, 0, 'select', 'SELECT id, CONCAT_WS('''', last_name, '', '', first_name, '' ('', username, '')'') AS name FROM user ORDER BY name', 'id', 'name', '', 0, 0, 0, 3, '');
INSERT INTO `claero_meta` VALUES (109, 'user_token', 'token', 'Token', 1, 1, 1, 1, 0, 'text', '', '', '', '', 35, 35, 0, 4, '');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group`
--

INSERT INTO `group` VALUES (1, 'Administrator', 'This is for administrators who are allowed to do anything.');

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `group_permission`
--

INSERT INTO `group_permission` VALUES (1, 1, 1);
INSERT INTO `group_permission` VALUES (2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(11) NOT NULL auto_increment,
  `controller` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` VALUES (1, 'admin', 'all');
INSERT INTO `permission` VALUES (2, 'meta', 'all');



-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(100) NOT NULL,
  `password` varchar(35) NOT NULL,
  `first_name` varchar(128) NOT NULL,
  `last_name` varchar(128) NOT NULL,
  `inactive_flag` tinyint(1) NOT NULL,
  `passphrase_q` varchar(150) NOT NULL,
  `passphrase_a` varchar(50) NOT NULL,
  `login_count` smallint(6) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `password` (`password`),
  KEY `inactive_flag` (`inactive_flag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES (1, 'admin@admin.com', 'eac26977dde17cb84cb2e009571abf7b', 'Admin', 'Account', 0, '', '', 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_group`
--

INSERT INTO `user_group` VALUES (1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL auto_increment,
  `date_created` datetime NOT NULL,
  `date_expired` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(35) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `date_expired` (`date_expired`,`user_id`,`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_token`
--
