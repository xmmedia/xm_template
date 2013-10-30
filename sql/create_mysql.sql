-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host:
-- Generation Time: Sep 14, 2012 at 04:40 PM
-- Server version: 5.1.61
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `template_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_log`
--

CREATE TABLE `auth_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_time` datetime NOT NULL,
  `auth_type_id` int(10) unsigned NOT NULL DEFAULT '0',
  `browser` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `auth_type_id` (`auth_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `auth_log`
--

-- --------------------------------------------------------

--
-- Table structure for table `change_log`
--

CREATE TABLE `change_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `event_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `first_change_log_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `table_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `record_pk` int(10) unsigned NOT NULL DEFAULT '0',
  `query_type` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `row_count` int(10) unsigned NOT NULL DEFAULT '0',
  `sql` longtext COLLATE utf8_unicode_ci NOT NULL,
  `changed` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `table_name` (`table_name`),
  KEY `query_type` (`query_type`),
  KEY `record_pk` (`record_pk`),
  KEY `first_change_log_id` (`first_change_log_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `change_log`
--

-- --------------------------------------------------------

--
-- Table structure for table `change_script`
--

CREATE TABLE `change_script` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `filename` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `applied` datetime NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `log` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `change_script`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `date_submitted` datetime NOT NULL,
  `ip_address` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact`
--


-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expiry_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `last_update_user_id` int(10) unsigned NOT NULL,
  `code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `content_page_id` int(10) unsigned NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `instructions` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `text_only_flag` tinyint(1) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `expiry_date` (`expiry_date`,`code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` VALUES(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'test', 'Test Content', 0, 'Just a test to make sure content admin is working.', 'This doesn''t display anywhere. It''s just a test to demo the content admin.', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `content_history`
--

CREATE TABLE `content_history` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expiry_date` datetime NOT NULL,
  `content_id` int(10) unsigned NOT NULL,
  `creation_date` datetime NOT NULL,
  `creation_user_id` int(10) unsigned NOT NULL,
  `post_date` datetime NOT NULL,
  `post_user_id` int(10) unsigned NOT NULL,
  `history_date` datetime NOT NULL,
  `history_user_id` int(10) unsigned NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `comments` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expiry_date` (`expiry_date`,`content_id`,`post_date`,`history_date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `content_history`
--


-- --------------------------------------------------------

--
-- Table structure for table `content_page`
--

CREATE TABLE `content_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expiry_date` datetime NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expiry_date` (`expiry_date`,`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `content_page`
--


-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `expiry_date` datetime NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `exchange_rate` decimal(11,5) NOT NULL DEFAULT '1.00000',
  `code` char(3) COLLATE utf8_unicode_ci NOT NULL,
  `currency_code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `display_order` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `code` (`code`),
  KEY `display_order` (`display_order`),
  KEY `date_expired` (`expiry_date`),
  KEY `currency_code` (`currency_code`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` VALUES(1, '0000-00-00 00:00:00', 'Afghanistan', '', '1.00000', 'AF', '', 100);
INSERT INTO `country` VALUES(2, '0000-00-00 00:00:00', 'Åland Islands', '', '1.00000', 'AX', '', 110);
INSERT INTO `country` VALUES(3, '0000-00-00 00:00:00', 'Albania', '', '1.00000', 'AL', '', 120);
INSERT INTO `country` VALUES(4, '0000-00-00 00:00:00', 'Algeria', '', '1.00000', 'DZ', '', 130);
INSERT INTO `country` VALUES(5, '0000-00-00 00:00:00', 'American Samoa', '', '1.00000', 'AS', '', 140);
INSERT INTO `country` VALUES(6, '0000-00-00 00:00:00', 'Andorra', '', '1.00000', 'AD', '', 150);
INSERT INTO `country` VALUES(7, '0000-00-00 00:00:00', 'Angola', '', '1.00000', 'AO', '', 160);
INSERT INTO `country` VALUES(8, '0000-00-00 00:00:00', 'Anguilla', '', '1.00000', 'AI', '', 170);
INSERT INTO `country` VALUES(9, '0000-00-00 00:00:00', 'Antarctica', '', '1.00000', 'AQ', '', 180);
INSERT INTO `country` VALUES(10, '0000-00-00 00:00:00', 'Antigua and Barbuda', '', '1.00000', 'AG', '', 190);
INSERT INTO `country` VALUES(11, '0000-00-00 00:00:00', 'Argentina', '', '1.00000', 'AR', '', 200);
INSERT INTO `country` VALUES(12, '0000-00-00 00:00:00', 'Armenia', '', '1.00000', 'AM', '', 210);
INSERT INTO `country` VALUES(13, '0000-00-00 00:00:00', 'Aruba', '', '1.00000', 'AW', '', 220);
INSERT INTO `country` VALUES(14, '0000-00-00 00:00:00', 'Australia', '$', '1.00000', 'AU', 'AUD', 230);
INSERT INTO `country` VALUES(15, '0000-00-00 00:00:00', 'Austria', '', '1.00000', 'AT', '', 240);
INSERT INTO `country` VALUES(16, '0000-00-00 00:00:00', 'Azerbaijan', '', '1.00000', 'AZ', '', 250);
INSERT INTO `country` VALUES(17, '0000-00-00 00:00:00', 'Bahamas', '', '1.00000', 'BS', '', 260);
INSERT INTO `country` VALUES(18, '0000-00-00 00:00:00', 'Bahrain', '', '1.00000', 'BH', '', 270);
INSERT INTO `country` VALUES(19, '0000-00-00 00:00:00', 'Bangladesh', '', '1.00000', 'BD', '', 280);
INSERT INTO `country` VALUES(20, '0000-00-00 00:00:00', 'Barbados', '', '1.00000', 'BB', '', 290);
INSERT INTO `country` VALUES(21, '0000-00-00 00:00:00', 'Belarus', '', '1.00000', 'BY', '', 300);
INSERT INTO `country` VALUES(22, '0000-00-00 00:00:00', 'Belgium', '', '1.00000', 'BE', '', 310);
INSERT INTO `country` VALUES(23, '0000-00-00 00:00:00', 'Belize', '', '1.00000', 'BZ', '', 320);
INSERT INTO `country` VALUES(24, '0000-00-00 00:00:00', 'Benin', '', '1.00000', 'BJ', '', 330);
INSERT INTO `country` VALUES(25, '0000-00-00 00:00:00', 'Bermuda', '', '1.00000', 'BM', '', 340);
INSERT INTO `country` VALUES(26, '0000-00-00 00:00:00', 'Bhutan', '', '1.00000', 'BT', '', 350);
INSERT INTO `country` VALUES(27, '0000-00-00 00:00:00', 'Bolivia, Plurinational State of', '', '1.00000', 'BO', '', 360);
INSERT INTO `country` VALUES(28, '0000-00-00 00:00:00', 'Bonaire, Saint Eustatius and Saba', '', '1.00000', 'BQ', '', 370);
INSERT INTO `country` VALUES(29, '0000-00-00 00:00:00', 'Bosnia and Herzegovina', '', '1.00000', 'BA', '', 400);
INSERT INTO `country` VALUES(30, '0000-00-00 00:00:00', 'Botswana', '', '1.00000', 'BW', '', 390);
INSERT INTO `country` VALUES(31, '0000-00-00 00:00:00', 'Bouvet Island', '', '1.00000', 'BV', '', 400);
INSERT INTO `country` VALUES(32, '0000-00-00 00:00:00', 'Brazil', '', '1.00000', 'BR', '', 410);
INSERT INTO `country` VALUES(33, '0000-00-00 00:00:00', 'British Indian Ocean Territory', '', '1.00000', 'IO', '', 420);
INSERT INTO `country` VALUES(34, '0000-00-00 00:00:00', 'Brunei Darussalam', '', '1.00000', 'BN', '', 430);
INSERT INTO `country` VALUES(35, '0000-00-00 00:00:00', 'Bulgaria', '', '1.00000', 'BG', '', 440);
INSERT INTO `country` VALUES(36, '0000-00-00 00:00:00', 'Burkina Faso', '', '1.00000', 'BF', '', 450);
INSERT INTO `country` VALUES(37, '0000-00-00 00:00:00', 'Burundi', '', '1.00000', 'BI', '', 460);
INSERT INTO `country` VALUES(38, '0000-00-00 00:00:00', 'Cambodia', '', '1.00000', 'KH', '', 470);
INSERT INTO `country` VALUES(39, '0000-00-00 00:00:00', 'Cameroon', '', '1.00000', 'CM', '', 480);
INSERT INTO `country` VALUES(40, '0000-00-00 00:00:00', 'Canada', '$', '1.00000', 'CA', 'CAD', 1);
INSERT INTO `country` VALUES(41, '0000-00-00 00:00:00', 'Cape Verde', '', '1.00000', 'CV', '', 500);
INSERT INTO `country` VALUES(42, '0000-00-00 00:00:00', 'Cayman Islands', '', '1.00000', 'KY', '', 510);
INSERT INTO `country` VALUES(43, '0000-00-00 00:00:00', 'Central African Republic', '', '1.00000', 'CF', '', 520);
INSERT INTO `country` VALUES(44, '0000-00-00 00:00:00', 'Chad', '', '1.00000', 'TD', '', 530);
INSERT INTO `country` VALUES(45, '0000-00-00 00:00:00', 'Chile', '', '1.00000', 'CL', '', 540);
INSERT INTO `country` VALUES(46, '0000-00-00 00:00:00', 'China', '', '1.00000', 'CN', '', 550);
INSERT INTO `country` VALUES(47, '0000-00-00 00:00:00', 'Christmas Island', '', '1.00000', 'CX', '', 560);
INSERT INTO `country` VALUES(48, '0000-00-00 00:00:00', 'Cocos (Keeling) Islands', '', '1.00000', 'CC', '', 570);
INSERT INTO `country` VALUES(49, '0000-00-00 00:00:00', 'Colombia', '', '1.00000', 'CO', '', 580);
INSERT INTO `country` VALUES(50, '0000-00-00 00:00:00', 'Comoros', '', '1.00000', 'KM', '', 590);
INSERT INTO `country` VALUES(51, '0000-00-00 00:00:00', 'Congo', '', '1.00000', 'CG', '', 600);
INSERT INTO `country` VALUES(52, '0000-00-00 00:00:00', 'Congo, the Democratic Republic of the', '', '1.00000', 'CD', '', 610);
INSERT INTO `country` VALUES(53, '0000-00-00 00:00:00', 'Cook Islands', '', '1.00000', 'CK', '', 620);
INSERT INTO `country` VALUES(54, '0000-00-00 00:00:00', 'Costa Rica', '', '1.00000', 'CR', '', 630);
INSERT INTO `country` VALUES(55, '0000-00-00 00:00:00', 'Côte d''Ivoire', '', '1.00000', 'CI', '', 640);
INSERT INTO `country` VALUES(56, '0000-00-00 00:00:00', 'Croatia', '', '1.00000', 'HR', '', 650);
INSERT INTO `country` VALUES(57, '0000-00-00 00:00:00', 'Cuba', '', '1.00000', 'CU', '', 660);
INSERT INTO `country` VALUES(58, '0000-00-00 00:00:00', 'Curaçao', '', '1.00000', 'CW', '', 670);
INSERT INTO `country` VALUES(59, '0000-00-00 00:00:00', 'Cyprus', '', '1.00000', 'CY', '', 680);
INSERT INTO `country` VALUES(60, '0000-00-00 00:00:00', 'Czech Republic', '', '1.00000', 'CZ', 'CZK', 690);
INSERT INTO `country` VALUES(61, '0000-00-00 00:00:00', 'Denmark', '', '1.00000', 'DK', 'DKK', 700);
INSERT INTO `country` VALUES(62, '0000-00-00 00:00:00', 'Djibouti', '', '1.00000', 'DJ', '', 710);
INSERT INTO `country` VALUES(63, '0000-00-00 00:00:00', 'Dominica', '', '1.00000', 'DM', '', 720);
INSERT INTO `country` VALUES(64, '0000-00-00 00:00:00', 'Dominican Republic', '', '1.00000', 'DO', '', 730);
INSERT INTO `country` VALUES(65, '0000-00-00 00:00:00', 'Ecuador', '', '1.00000', 'EC', '', 740);
INSERT INTO `country` VALUES(66, '0000-00-00 00:00:00', 'Egypt', '', '1.00000', 'EG', '', 750);
INSERT INTO `country` VALUES(67, '0000-00-00 00:00:00', 'El Salvador', '', '1.00000', 'SV', '', 760);
INSERT INTO `country` VALUES(68, '0000-00-00 00:00:00', 'Equatorial Guinea', '', '1.00000', 'GQ', '', 770);
INSERT INTO `country` VALUES(69, '0000-00-00 00:00:00', 'Eritrea', '', '1.00000', 'ER', '', 780);
INSERT INTO `country` VALUES(70, '0000-00-00 00:00:00', 'Estonia', '', '1.00000', 'EE', '', 790);
INSERT INTO `country` VALUES(71, '0000-00-00 00:00:00', 'Ethiopia', '', '1.00000', 'ET', '', 800);
INSERT INTO `country` VALUES(72, '0000-00-00 00:00:00', 'Falkland Islands (Malvinas)', '', '1.00000', 'FK', '', 810);
INSERT INTO `country` VALUES(73, '0000-00-00 00:00:00', 'Faroe Islands', '', '1.00000', 'FO', '', 820);
INSERT INTO `country` VALUES(74, '0000-00-00 00:00:00', 'Fiji', '', '1.00000', 'FJ', '', 830);
INSERT INTO `country` VALUES(75, '0000-00-00 00:00:00', 'Finland', '', '1.00000', 'FI', '', 840);
INSERT INTO `country` VALUES(76, '0000-00-00 00:00:00', 'France', '', '1.00000', 'FR', '', 850);
INSERT INTO `country` VALUES(77, '0000-00-00 00:00:00', 'French Guiana', '', '1.00000', 'GF', '', 860);
INSERT INTO `country` VALUES(78, '0000-00-00 00:00:00', 'French Polynesia', '', '1.00000', 'PF', '', 870);
INSERT INTO `country` VALUES(79, '0000-00-00 00:00:00', 'French Southern Territories', '', '1.00000', 'TF', '', 880);
INSERT INTO `country` VALUES(80, '0000-00-00 00:00:00', 'Gabon', '', '1.00000', 'GA', '', 890);
INSERT INTO `country` VALUES(81, '0000-00-00 00:00:00', 'Gambia', '', '1.00000', 'GM', '', 900);
INSERT INTO `country` VALUES(82, '0000-00-00 00:00:00', 'Georgia', '', '1.00000', 'GE', '', 910);
INSERT INTO `country` VALUES(83, '0000-00-00 00:00:00', 'Germany', '', '1.00000', 'DE', '', 920);
INSERT INTO `country` VALUES(84, '0000-00-00 00:00:00', 'Ghana', '', '1.00000', 'GH', '', 930);
INSERT INTO `country` VALUES(85, '0000-00-00 00:00:00', 'Gibraltar', '', '1.00000', 'GI', '', 940);
INSERT INTO `country` VALUES(86, '0000-00-00 00:00:00', 'Greece', '', '1.00000', 'GR', '', 950);
INSERT INTO `country` VALUES(87, '0000-00-00 00:00:00', 'Greenland', '', '1.00000', 'GL', '', 960);
INSERT INTO `country` VALUES(88, '0000-00-00 00:00:00', 'Grenada', '', '1.00000', 'GD', '', 970);
INSERT INTO `country` VALUES(89, '0000-00-00 00:00:00', 'Guadeloupe', '', '1.00000', 'GP', '', 980);
INSERT INTO `country` VALUES(90, '0000-00-00 00:00:00', 'Guam', '', '1.00000', 'GU', '', 990);
INSERT INTO `country` VALUES(91, '0000-00-00 00:00:00', 'Guatemala', '', '1.00000', 'GT', '', 1000);
INSERT INTO `country` VALUES(92, '0000-00-00 00:00:00', 'Guernsey', '', '1.00000', 'GG', '', 1010);
INSERT INTO `country` VALUES(93, '0000-00-00 00:00:00', 'Guinea', '', '1.00000', 'GN', '', 1020);
INSERT INTO `country` VALUES(94, '0000-00-00 00:00:00', 'Guinea-Bissau', '', '1.00000', 'GW', '', 1030);
INSERT INTO `country` VALUES(95, '0000-00-00 00:00:00', 'Guyana', '', '1.00000', 'GY', '', 1040);
INSERT INTO `country` VALUES(96, '0000-00-00 00:00:00', 'Haiti', '', '1.00000', 'HT', '', 1050);
INSERT INTO `country` VALUES(97, '0000-00-00 00:00:00', 'Heard Island and McDonald Islands', '', '1.00000', 'HM', '', 1060);
INSERT INTO `country` VALUES(98, '0000-00-00 00:00:00', 'Holy See (Vatican City State)', '', '1.00000', 'VA', '', 1070);
INSERT INTO `country` VALUES(99, '0000-00-00 00:00:00', 'Honduras', '', '1.00000', 'HN', '', 1080);
INSERT INTO `country` VALUES(100, '0000-00-00 00:00:00', 'Hong Kong', '', '1.00000', 'HK', 'HKD', 1090);
INSERT INTO `country` VALUES(101, '0000-00-00 00:00:00', 'Hungary', '', '1.00000', 'HU', 'HUF', 1100);
INSERT INTO `country` VALUES(102, '0000-00-00 00:00:00', 'Iceland', '', '1.00000', 'IS', '', 1110);
INSERT INTO `country` VALUES(103, '0000-00-00 00:00:00', 'India', '', '1.00000', 'IN', '', 1120);
INSERT INTO `country` VALUES(104, '0000-00-00 00:00:00', 'Indonesia', '', '1.00000', 'ID', '', 1130);
INSERT INTO `country` VALUES(105, '0000-00-00 00:00:00', 'Iran, Islamic Republic of', '', '1.00000', 'IR', '', 1140);
INSERT INTO `country` VALUES(106, '0000-00-00 00:00:00', 'Iraq', '', '1.00000', 'IQ', '', 1150);
INSERT INTO `country` VALUES(107, '0000-00-00 00:00:00', 'Ireland', '', '1.00000', 'IE', '', 1160);
INSERT INTO `country` VALUES(108, '0000-00-00 00:00:00', 'Isle of Man', '', '1.00000', 'IM', '', 1170);
INSERT INTO `country` VALUES(109, '0000-00-00 00:00:00', 'Israel', '', '1.00000', 'IL', '', 1180);
INSERT INTO `country` VALUES(110, '0000-00-00 00:00:00', 'Italy', '', '1.00000', 'IT', '', 1190);
INSERT INTO `country` VALUES(111, '0000-00-00 00:00:00', 'Jamaica', '', '1.00000', 'JM', '', 1200);
INSERT INTO `country` VALUES(112, '0000-00-00 00:00:00', 'Japan', '', '1.00000', 'JP', 'JPY', 1210);
INSERT INTO `country` VALUES(113, '0000-00-00 00:00:00', 'Jersey', '', '1.00000', 'JE', '', 1220);
INSERT INTO `country` VALUES(114, '0000-00-00 00:00:00', 'Jordan', '', '1.00000', 'JO', '', 1230);
INSERT INTO `country` VALUES(115, '0000-00-00 00:00:00', 'Kazakhstan', '', '1.00000', 'KZ', '', 1240);
INSERT INTO `country` VALUES(116, '0000-00-00 00:00:00', 'Kenya', '', '1.00000', 'KE', '', 1250);
INSERT INTO `country` VALUES(117, '0000-00-00 00:00:00', 'Kiribati', '', '1.00000', 'KI', '', 1260);
INSERT INTO `country` VALUES(118, '0000-00-00 00:00:00', 'Kuwait', '', '1.00000', 'KW', '', 1270);
INSERT INTO `country` VALUES(119, '0000-00-00 00:00:00', 'Kyrgyzstan', '', '1.00000', 'KG', '', 1280);
INSERT INTO `country` VALUES(120, '0000-00-00 00:00:00', 'Laos', '', '1.00000', 'LA', '', 1290);
INSERT INTO `country` VALUES(121, '0000-00-00 00:00:00', 'Latvia', '', '1.00000', 'LV', '', 1300);
INSERT INTO `country` VALUES(122, '0000-00-00 00:00:00', 'Lebanon', '', '1.00000', 'LB', '', 1310);
INSERT INTO `country` VALUES(123, '0000-00-00 00:00:00', 'Lesotho', '', '1.00000', 'LS', '', 1320);
INSERT INTO `country` VALUES(124, '0000-00-00 00:00:00', 'Liberia', '', '1.00000', 'LR', '', 1330);
INSERT INTO `country` VALUES(125, '0000-00-00 00:00:00', 'Libyan Arab Jamahiriya', '', '1.00000', 'LY', '', 1340);
INSERT INTO `country` VALUES(126, '0000-00-00 00:00:00', 'Liechtenstein', '', '1.00000', 'LI', '', 1350);
INSERT INTO `country` VALUES(127, '0000-00-00 00:00:00', 'Lithuania', '', '1.00000', 'LT', '', 1360);
INSERT INTO `country` VALUES(128, '0000-00-00 00:00:00', 'Luxembourg', '', '1.00000', 'LU', '', 1370);
INSERT INTO `country` VALUES(129, '0000-00-00 00:00:00', 'Macao', '', '1.00000', 'MO', '', 1400);
INSERT INTO `country` VALUES(130, '0000-00-00 00:00:00', 'Macedonia, the former Yugoslav Republic of', '', '1.00000', 'MK', '', 1390);
INSERT INTO `country` VALUES(131, '0000-00-00 00:00:00', 'Madagascar', '', '1.00000', 'MG', '', 1400);
INSERT INTO `country` VALUES(132, '0000-00-00 00:00:00', 'Malawi', '', '1.00000', 'MW', '', 1410);
INSERT INTO `country` VALUES(133, '0000-00-00 00:00:00', 'Malaysia', '', '1.00000', 'MY', '', 1420);
INSERT INTO `country` VALUES(134, '0000-00-00 00:00:00', 'Maldives', '', '1.00000', 'MV', '', 1430);
INSERT INTO `country` VALUES(135, '0000-00-00 00:00:00', 'Mali', '', '1.00000', 'ML', '', 1440);
INSERT INTO `country` VALUES(136, '0000-00-00 00:00:00', 'Malta', '', '1.00000', 'MT', '', 1450);
INSERT INTO `country` VALUES(137, '0000-00-00 00:00:00', 'Marshall Islands', '', '1.00000', 'MH', '', 1460);
INSERT INTO `country` VALUES(138, '0000-00-00 00:00:00', 'Martinique', '', '1.00000', 'MQ', '', 1470);
INSERT INTO `country` VALUES(139, '0000-00-00 00:00:00', 'Mauritania', '', '1.00000', 'MR', '', 1480);
INSERT INTO `country` VALUES(140, '0000-00-00 00:00:00', 'Mauritius', '', '1.00000', 'MU', '', 1490);
INSERT INTO `country` VALUES(141, '0000-00-00 00:00:00', 'Mayotte', '', '1.00000', 'YT', '', 1500);
INSERT INTO `country` VALUES(142, '0000-00-00 00:00:00', 'Mexico', '', '1.00000', 'MX', '', 1510);
INSERT INTO `country` VALUES(143, '0000-00-00 00:00:00', 'Micronesia, Federated States of', '', '1.00000', 'FM', '', 1520);
INSERT INTO `country` VALUES(144, '0000-00-00 00:00:00', 'Moldova, Republic of', '', '1.00000', 'MD', '', 1530);
INSERT INTO `country` VALUES(145, '0000-00-00 00:00:00', 'Monaco', '', '1.00000', 'MC', '', 1540);
INSERT INTO `country` VALUES(146, '0000-00-00 00:00:00', 'Mongolia', '', '1.00000', 'MN', '', 1550);
INSERT INTO `country` VALUES(147, '0000-00-00 00:00:00', 'Montenegro', '', '1.00000', 'ME', '', 1560);
INSERT INTO `country` VALUES(148, '0000-00-00 00:00:00', 'Montserrat', '', '1.00000', 'MS', '', 1570);
INSERT INTO `country` VALUES(149, '0000-00-00 00:00:00', 'Morocco', '', '1.00000', 'MA', '', 1580);
INSERT INTO `country` VALUES(150, '0000-00-00 00:00:00', 'Mozambique', '', '1.00000', 'MZ', '', 1590);
INSERT INTO `country` VALUES(151, '0000-00-00 00:00:00', 'Myanmar', '', '1.00000', 'MM', '', 1600);
INSERT INTO `country` VALUES(152, '0000-00-00 00:00:00', 'Namibia', '', '1.00000', 'NA', '', 1610);
INSERT INTO `country` VALUES(153, '0000-00-00 00:00:00', 'Nauru', '', '1.00000', 'NR', '', 1620);
INSERT INTO `country` VALUES(154, '0000-00-00 00:00:00', 'Nepal', '', '1.00000', 'NP', '', 1630);
INSERT INTO `country` VALUES(155, '0000-00-00 00:00:00', 'Netherlands', '', '1.00000', 'NL', '', 1640);
INSERT INTO `country` VALUES(156, '0000-00-00 00:00:00', 'New Caledonia', '', '1.00000', 'NC', '', 1650);
INSERT INTO `country` VALUES(157, '0000-00-00 00:00:00', 'New Zealand', '', '1.00000', 'NZ', 'NZD', 1660);
INSERT INTO `country` VALUES(158, '0000-00-00 00:00:00', 'Nicaragua', '', '1.00000', 'NI', '', 1670);
INSERT INTO `country` VALUES(159, '0000-00-00 00:00:00', 'Niger', '', '1.00000', 'NE', '', 1680);
INSERT INTO `country` VALUES(160, '0000-00-00 00:00:00', 'Nigeria', '', '1.00000', 'NG', '', 1690);
INSERT INTO `country` VALUES(161, '0000-00-00 00:00:00', 'Niue', '', '1.00000', 'NU', '', 1700);
INSERT INTO `country` VALUES(162, '0000-00-00 00:00:00', 'Norfolk Island', '', '1.00000', 'NF', '', 1710);
INSERT INTO `country` VALUES(163, '0000-00-00 00:00:00', 'North Korea', '', '1.00000', 'KP', '', 1720);
INSERT INTO `country` VALUES(164, '0000-00-00 00:00:00', 'Northern Mariana Islands', '', '1.00000', 'MP', '', 1730);
INSERT INTO `country` VALUES(165, '0000-00-00 00:00:00', 'Norway', '', '1.00000', 'NO', 'NOK', 1740);
INSERT INTO `country` VALUES(166, '0000-00-00 00:00:00', 'Oman', '', '1.00000', 'OM', '', 1750);
INSERT INTO `country` VALUES(167, '0000-00-00 00:00:00', 'Pakistan', '', '1.00000', 'PK', '', 1760);
INSERT INTO `country` VALUES(168, '0000-00-00 00:00:00', 'Palau', '', '1.00000', 'PW', '', 1770);
INSERT INTO `country` VALUES(169, '0000-00-00 00:00:00', 'Palestinian Territory, Occupied', '', '1.00000', 'PS', '', 1780);
INSERT INTO `country` VALUES(170, '0000-00-00 00:00:00', 'Panama', '', '1.00000', 'PA', '', 1790);
INSERT INTO `country` VALUES(171, '0000-00-00 00:00:00', 'Papua New Guinea', '', '1.00000', 'PG', '', 1800);
INSERT INTO `country` VALUES(172, '0000-00-00 00:00:00', 'Paraguay', '', '1.00000', 'PY', '', 1810);
INSERT INTO `country` VALUES(173, '0000-00-00 00:00:00', 'Peru', '', '1.00000', 'PE', '', 1820);
INSERT INTO `country` VALUES(174, '0000-00-00 00:00:00', 'Philippines', '', '1.00000', 'PH', '', 1830);
INSERT INTO `country` VALUES(175, '0000-00-00 00:00:00', 'Pitcairn', '', '1.00000', 'PN', '', 1840);
INSERT INTO `country` VALUES(176, '0000-00-00 00:00:00', 'Poland', '', '1.00000', 'PL', 'PLN', 1850);
INSERT INTO `country` VALUES(177, '0000-00-00 00:00:00', 'Portugal', '', '1.00000', 'PT', '', 1860);
INSERT INTO `country` VALUES(178, '0000-00-00 00:00:00', 'Puerto Rico', '', '1.00000', 'PR', '', 1870);
INSERT INTO `country` VALUES(179, '0000-00-00 00:00:00', 'Qatar', '', '1.00000', 'QA', '', 1880);
INSERT INTO `country` VALUES(180, '0000-00-00 00:00:00', 'Réunion', '', '1.00000', 'RE', '', 1890);
INSERT INTO `country` VALUES(181, '0000-00-00 00:00:00', 'Romania', '', '1.00000', 'RO', '', 1900);
INSERT INTO `country` VALUES(182, '0000-00-00 00:00:00', 'Russian Federation', '', '1.00000', 'RU', '', 1910);
INSERT INTO `country` VALUES(183, '0000-00-00 00:00:00', 'Rwanda', '', '1.00000', 'RW', '', 1920);
INSERT INTO `country` VALUES(184, '0000-00-00 00:00:00', 'Saint Barthélemy', '', '1.00000', 'BL', '', 1930);
INSERT INTO `country` VALUES(185, '0000-00-00 00:00:00', 'Saint Helena, Ascension and Tristan da Cunha', '', '1.00000', 'SH', '', 1940);
INSERT INTO `country` VALUES(186, '0000-00-00 00:00:00', 'Saint Kitts and Nevis', '', '1.00000', 'KN', '', 1950);
INSERT INTO `country` VALUES(187, '0000-00-00 00:00:00', 'Saint Lucia', '', '1.00000', 'LC', '', 1960);
INSERT INTO `country` VALUES(188, '0000-00-00 00:00:00', 'Saint Martin (French part)', '', '1.00000', 'MF', '', 1970);
INSERT INTO `country` VALUES(189, '0000-00-00 00:00:00', 'Saint Pierre and Miquelon', '', '1.00000', 'PM', '', 1980);
INSERT INTO `country` VALUES(190, '0000-00-00 00:00:00', 'Saint Vincent and the Grenadines', '', '1.00000', 'VC', '', 1990);
INSERT INTO `country` VALUES(191, '0000-00-00 00:00:00', 'Samoa', '', '1.00000', 'WS', '', 2000);
INSERT INTO `country` VALUES(192, '0000-00-00 00:00:00', 'San Marino', '', '1.00000', 'SM', '', 2010);
INSERT INTO `country` VALUES(193, '0000-00-00 00:00:00', 'Sao Tome and Principe', '', '1.00000', 'ST', '', 2020);
INSERT INTO `country` VALUES(194, '0000-00-00 00:00:00', 'Saudi Arabia', '', '1.00000', 'SA', '', 2030);
INSERT INTO `country` VALUES(195, '0000-00-00 00:00:00', 'Senegal', '', '1.00000', 'SN', '', 2040);
INSERT INTO `country` VALUES(196, '0000-00-00 00:00:00', 'Serbia', '', '1.00000', 'RS', '', 2050);
INSERT INTO `country` VALUES(197, '0000-00-00 00:00:00', 'Seychelles', '', '1.00000', 'SC', '', 2060);
INSERT INTO `country` VALUES(198, '0000-00-00 00:00:00', 'Sierra Leone', '', '1.00000', 'SL', '', 2070);
INSERT INTO `country` VALUES(199, '0000-00-00 00:00:00', 'Singapore', '', '1.00000', 'SG', 'SGD', 2080);
INSERT INTO `country` VALUES(200, '0000-00-00 00:00:00', 'Sint Maarten (Dutch part)', '', '1.00000', 'SX', '', 2090);
INSERT INTO `country` VALUES(201, '0000-00-00 00:00:00', 'Slovakia', '', '1.00000', 'SK', '', 2100);
INSERT INTO `country` VALUES(202, '0000-00-00 00:00:00', 'Slovenia', '', '1.00000', 'SI', '', 2110);
INSERT INTO `country` VALUES(203, '0000-00-00 00:00:00', 'Solomon Islands', '', '1.00000', 'SB', '', 2120);
INSERT INTO `country` VALUES(204, '0000-00-00 00:00:00', 'Somalia', '', '1.00000', 'SO', '', 2130);
INSERT INTO `country` VALUES(205, '0000-00-00 00:00:00', 'South Africa', '', '1.00000', 'ZA', '', 2140);
INSERT INTO `country` VALUES(206, '0000-00-00 00:00:00', 'South Georgia and the South Sandwich Islands', '', '1.00000', 'GS', '', 2150);
INSERT INTO `country` VALUES(207, '0000-00-00 00:00:00', 'South Korea', '', '1.00000', 'KR', '', 2160);
INSERT INTO `country` VALUES(208, '0000-00-00 00:00:00', 'Spain', '', '1.00000', 'ES', '', 2170);
INSERT INTO `country` VALUES(209, '0000-00-00 00:00:00', 'Sri Lanka', '', '1.00000', 'LK', '', 2180);
INSERT INTO `country` VALUES(210, '0000-00-00 00:00:00', 'Sudan', '', '1.00000', 'SD', '', 2190);
INSERT INTO `country` VALUES(211, '0000-00-00 00:00:00', 'Suriname', '', '1.00000', 'SR', '', 2200);
INSERT INTO `country` VALUES(212, '0000-00-00 00:00:00', 'Svalbard and Jan Mayen', '', '1.00000', 'SJ', '', 2210);
INSERT INTO `country` VALUES(213, '0000-00-00 00:00:00', 'Swaziland', '', '1.00000', 'SZ', '', 2220);
INSERT INTO `country` VALUES(214, '0000-00-00 00:00:00', 'Sweden', '', '1.00000', 'SE', 'SEK', 2230);
INSERT INTO `country` VALUES(215, '0000-00-00 00:00:00', 'Switzerland', '', '1.00000', 'CH', 'CHF', 2240);
INSERT INTO `country` VALUES(216, '0000-00-00 00:00:00', 'Syrian Arab Republic', '', '1.00000', 'SY', '', 2250);
INSERT INTO `country` VALUES(217, '0000-00-00 00:00:00', 'Taiwan, Province of China', '', '1.00000', 'TW', '', 2350);
INSERT INTO `country` VALUES(218, '0000-00-00 00:00:00', 'Tajikistan', '', '1.00000', 'TJ', '', 2270);
INSERT INTO `country` VALUES(219, '0000-00-00 00:00:00', 'Tanzania, United Republic of', '', '1.00000', 'TZ', '', 2280);
INSERT INTO `country` VALUES(220, '0000-00-00 00:00:00', 'Thailand', '', '1.00000', 'TH', '', 2290);
INSERT INTO `country` VALUES(221, '0000-00-00 00:00:00', 'Timor-Leste', '', '1.00000', 'TL', '', 2300);
INSERT INTO `country` VALUES(222, '0000-00-00 00:00:00', 'Togo', '', '1.00000', 'TG', '', 2310);
INSERT INTO `country` VALUES(223, '0000-00-00 00:00:00', 'Tokelau', '', '1.00000', 'TK', '', 2320);
INSERT INTO `country` VALUES(224, '0000-00-00 00:00:00', 'Tonga', '', '1.00000', 'TO', '', 2330);
INSERT INTO `country` VALUES(225, '0000-00-00 00:00:00', 'Trinidad and Tobago', '', '1.00000', 'TT', '', 2340);
INSERT INTO `country` VALUES(226, '0000-00-00 00:00:00', 'Tunisia', '', '1.00000', 'TN', '', 2350);
INSERT INTO `country` VALUES(227, '0000-00-00 00:00:00', 'Turkey', '', '1.00000', 'TR', '', 2360);
INSERT INTO `country` VALUES(228, '0000-00-00 00:00:00', 'Turkmenistan', '', '1.00000', 'TM', '', 2370);
INSERT INTO `country` VALUES(229, '0000-00-00 00:00:00', 'Turks and Caicos Islands', '', '1.00000', 'TC', '', 2400);
INSERT INTO `country` VALUES(230, '0000-00-00 00:00:00', 'Tuvalu', '', '1.00000', 'TV', '', 2390);
INSERT INTO `country` VALUES(231, '0000-00-00 00:00:00', 'Uganda', '', '1.00000', 'UG', '', 2400);
INSERT INTO `country` VALUES(232, '0000-00-00 00:00:00', 'Ukraine', '', '1.00000', 'UA', '', 2410);
INSERT INTO `country` VALUES(233, '0000-00-00 00:00:00', 'United Arab Emirates', '', '1.00000', 'AE', '', 2420);
INSERT INTO `country` VALUES(234, '0000-00-00 00:00:00', 'United Kingdom', '', '1.00000', 'GB', 'GBP', 2430);
INSERT INTO `country` VALUES(235, '0000-00-00 00:00:00', 'United States', '$', '1.00000', 'US', 'USD', 2);
INSERT INTO `country` VALUES(236, '0000-00-00 00:00:00', 'United States Minor Outlying Islands', '', '1.00000', 'UM', '', 2450);
INSERT INTO `country` VALUES(237, '0000-00-00 00:00:00', 'Uruguay', '', '1.00000', 'UY', '', 2460);
INSERT INTO `country` VALUES(238, '0000-00-00 00:00:00', 'Uzbekistan', '', '1.00000', 'UZ', '', 2470);
INSERT INTO `country` VALUES(239, '0000-00-00 00:00:00', 'Vanuatu', '', '1.00000', 'VU', '', 2480);
INSERT INTO `country` VALUES(240, '0000-00-00 00:00:00', 'Venezuela, Bolivarian Republic of', '', '1.00000', 'VE', '', 2490);
INSERT INTO `country` VALUES(241, '0000-00-00 00:00:00', 'Viet Nam', '', '1.00000', 'VN', '', 2500);
INSERT INTO `country` VALUES(242, '0000-00-00 00:00:00', 'Virgin Islands, British', '', '1.00000', 'VG', '', 2510);
INSERT INTO `country` VALUES(243, '0000-00-00 00:00:00', 'Virgin Islands, U.S.', '', '1.00000', 'VI', '', 2520);
INSERT INTO `country` VALUES(244, '0000-00-00 00:00:00', 'Wallis and Futuna', '', '1.00000', 'WF', '', 2530);
INSERT INTO `country` VALUES(245, '0000-00-00 00:00:00', 'Western Sahara', '', '1.00000', 'EH', '', 2540);
INSERT INTO `country` VALUES(246, '0000-00-00 00:00:00', 'Yemen', '', '1.00000', 'YE', '', 2550);
INSERT INTO `country` VALUES(247, '0000-00-00 00:00:00', 'Zambia', '', '1.00000', 'ZM', '', 2560);
INSERT INTO `country` VALUES(248, '0000-00-00 00:00:00', 'Zimbabwe', '', '1.00000', 'ZW', '', 2570);

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
  `permission_id` int(10) unsigned NOT NULL DEFAULT '0',
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
INSERT INTO `group_permission` VALUES(12, 1, 11);
INSERT INTO `group_permission` VALUES(13, 2, 11);
INSERT INTO `group_permission` VALUES(14, 1, 12);
INSERT INTO `group_permission` VALUES(15, 1, 15);
INSERT INTO `group_permission` VALUES(16, 1, 18);
INSERT INTO `group_permission` VALUES(17, 1, 19);
INSERT INTO `group_permission` VALUES(18, 1, 16);
INSERT INTO `group_permission` VALUES(19, 1, 17);
INSERT INTO `group_permission` VALUES(20, 1, 20);
INSERT INTO `group_permission` VALUES(21, 1, 22);
INSERT INTO `group_permission` VALUES(22, 1, 26);
INSERT INTO `group_permission` VALUES(23, 1, 23);
INSERT INTO `group_permission` VALUES(24, 1, 24);
INSERT INTO `group_permission` VALUES(25, 1, 25);
INSERT INTO `group_permission` VALUES(26, 1, 21);
INSERT INTO `group_permission` VALUES(29, 1, 14);
INSERT INTO `group_permission` VALUES(30, 1, 13);
INSERT INTO `group_permission` VALUES(31, 1, 27);
INSERT INTO `group_permission` VALUES(32, 1, 28);
INSERT INTO `group_permission` VALUES(33, 2, 27);
INSERT INTO `group_permission` VALUES(34, 2, 28);
INSERT INTO `group_permission` VALUES(35, 2, 14);
INSERT INTO `group_permission` VALUES(36, 2, 15);
INSERT INTO `group_permission` VALUES(37, 2, 18);
INSERT INTO `group_permission` VALUES(38, 2, 19);
INSERT INTO `group_permission` VALUES(39, 2, 16);
INSERT INTO `group_permission` VALUES(40, 2, 17);
INSERT INTO `group_permission` VALUES(41, 2, 20);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission` (`permission`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` VALUES(1, 'account/profile', 'Edit Profile', 'Can edit their profile, including changing their password.');
INSERT INTO `permission` VALUES(2, 'xm_db_admin/*/add', 'Database Admin Add', 'Can add or add similar any item in the DB Admin.');
INSERT INTO `permission` VALUES(3, 'xm_db_admin/*/edit', 'Database Admin Edit', 'Can edit any items in the DB Admin.');
INSERT INTO `permission` VALUES(4, 'xm_db_admin/*/search', 'Database Admin Search', 'Can search for any items in the DB Admin.');
INSERT INTO `permission` VALUES(5, 'xm_db_admin/*/export', 'Database Admin Export', 'Can export any items in the DB Admin.');
INSERT INTO `permission` VALUES(6, 'xm_db_admin/*/delete', 'Database Admin Delete', 'Can delete any item in the DB Admin.');
INSERT INTO `permission` VALUES(7, 'xm_db_admin/*/view', 'Database Admin View', 'Can view any item in the DB Admin.');
INSERT INTO `permission` VALUES(8, 'xm_db_admin/*/index', 'Database Admin List', 'Can view a list of items in the DB Admin.');
INSERT INTO `permission` VALUES(9, 'xm_db_admin/model_create', 'Database Admin Model Create', 'Can create PHP models from the DB Admin. (Unique from other DB Admin permissions.)');
INSERT INTO `permission` VALUES(10, 'xm_db_admin/contact/*', 'Database Admin - Contacts', 'Can perform all possible actions on Contacts in the DB Admin (add, edit, delete, search, view, list, export).');
INSERT INTO `permission` VALUES(11, 'xm_db_admin', 'DB Admin Access', 'Gives access to DB Admin, although other permissions are required to access individual models/tables and actions.');
INSERT INTO `permission` VALUES(12, 'userguide', 'Kohana User Guide', 'Gives access to the Kohana User Guide and API Browser by enabling the modules.');
INSERT INTO `permission` VALUES(13, 'db_change/index', 'DB Change', 'Allows the user to run SQL commands across multiple databases.');
INSERT INTO `permission` VALUES(14, 'user_admin/index', 'User Admin', 'Allows the user to access the list of users.');
INSERT INTO `permission` VALUES(15, 'user_admin/add', 'User Admin - Add User', 'Allows the user to add new users.');
INSERT INTO `permission` VALUES(16, 'user_admin/edit', 'User Admin - Edit User', 'Allows the user to edit users, excluding their permissions.');
INSERT INTO `permission` VALUES(17, 'user_admin/edit/permissions', 'User Admin - Edit User Permissions', 'Allows the user to edit a users permissions.');
INSERT INTO `permission` VALUES(18, 'user_admin/user/group/*', 'User Admin - All Groups', 'Allows the user to add any permission group to a user.');
INSERT INTO `permission` VALUES(19, 'user_admin/delete', 'User Admin - Delete User', 'Allows the user to delete users.');
INSERT INTO `permission` VALUES(20, 'user_admin/email_password', 'User Admin - Email Password', 'Allows the user to email a new password to a user.');
INSERT INTO `permission` VALUES(21, 'user_admin/group/index', 'User Admin - Groups List', 'Allows the user to access the list of permission groups.');
INSERT INTO `permission` VALUES(22, 'user_admin/group/add', 'User Admin - Group Add', 'Allows the user to add a new permission group. Doesn''t allow the user to assign permissions to the group.');
INSERT INTO `permission` VALUES(23, 'user_admin/group/edit', 'User Admin - Group Edit', 'Allows the user to edit the name and description of a permission group.');
INSERT INTO `permission` VALUES(24, 'user_admin/group/permissions', 'User Admin - Group Permissions', 'Allows the user to add and remove permissions from the permission group.');
INSERT INTO `permission` VALUES(25, 'user_admin/group/users', 'User Admin - Group Users', 'Allows the user to add and remove users from the permission group.');
INSERT INTO `permission` VALUES(26, 'user_admin/group/delete', 'User Admin - Group Delete', 'Allows the user to delete a permission group.');
INSERT INTO `permission` VALUES(27, 'content_admin', 'Content Admin', 'Allows the user to access the content admin. Required for users to edit content.');
INSERT INTO `permission` VALUES(28, 'content_admin/*', 'Content Admin - All Content', 'Allows the user to make changes to all content.');

-- --------------------------------------------------------

--
-- Table structure for table `request_log`
--

CREATE TABLE `request_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `datetime` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `get` text COLLATE utf8_unicode_ci NOT NULL,
  `post` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `request_log`
--

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
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `expiry_date` datetime NOT NULL,
  `country_id` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `abbrev` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `alternate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_order` smallint(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_expired` (`expiry_date`),
  KEY `alternate` (`alternate`),
  KEY `country_id` (`country_id`),
  KEY `display_order` (`display_order`),
  KEY `date_expired_2` (`expiry_date`,`country_id`,`name`,`display_order`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` VALUES(1, '0000-00-00 00:00:00', 40, 'Alberta', 'AB', '', 10);
INSERT INTO `state` VALUES(2, '0000-00-00 00:00:00', 235, 'Alaska', 'AK', '', 100);
INSERT INTO `state` VALUES(3, '0000-00-00 00:00:00', 235, 'Alabama', 'AL', '', 100);
INSERT INTO `state` VALUES(4, '0000-00-00 00:00:00', 235, 'American Samoa', 'AS', '', 100);
INSERT INTO `state` VALUES(5, '0000-00-00 00:00:00', 235, 'Arkansas', 'AR', '', 100);
INSERT INTO `state` VALUES(6, '0000-00-00 00:00:00', 235, 'Arizona', 'AZ', '', 100);
INSERT INTO `state` VALUES(7, '0000-00-00 00:00:00', 40, 'British Columbia', 'BC', '', 10);
INSERT INTO `state` VALUES(8, '0000-00-00 00:00:00', 235, 'California', 'CA', '', 100);
INSERT INTO `state` VALUES(9, '0000-00-00 00:00:00', 235, 'Colorado', 'CO', '', 100);
INSERT INTO `state` VALUES(10, '0000-00-00 00:00:00', 235, 'Connecticut', 'CT', '', 100);
INSERT INTO `state` VALUES(11, '0000-00-00 00:00:00', 235, 'District of Columbia', 'DC', '', 100);
INSERT INTO `state` VALUES(12, '0000-00-00 00:00:00', 235, 'Delaware', 'DE', '', 100);
INSERT INTO `state` VALUES(13, '0000-00-00 00:00:00', 235, 'Florida', 'FL', '', 100);
INSERT INTO `state` VALUES(14, '0000-00-00 00:00:00', 235, 'Georgia', 'GA', '', 100);
INSERT INTO `state` VALUES(15, '0000-00-00 00:00:00', 235, 'Guam', 'GU', '', 100);
INSERT INTO `state` VALUES(16, '0000-00-00 00:00:00', 235, 'Hawaii', 'HI', '', 100);
INSERT INTO `state` VALUES(17, '0000-00-00 00:00:00', 235, 'Iowa', 'IA', '', 100);
INSERT INTO `state` VALUES(18, '0000-00-00 00:00:00', 235, 'Idaho', 'ID', '', 100);
INSERT INTO `state` VALUES(19, '0000-00-00 00:00:00', 235, 'Illinois', 'IL', '', 100);
INSERT INTO `state` VALUES(20, '0000-00-00 00:00:00', 235, 'Indiana', 'IN', '', 100);
INSERT INTO `state` VALUES(21, '0000-00-00 00:00:00', 235, 'Kansas', 'KS', '', 100);
INSERT INTO `state` VALUES(22, '0000-00-00 00:00:00', 235, 'Kentucky', 'KY', '', 100);
INSERT INTO `state` VALUES(23, '0000-00-00 00:00:00', 235, 'Louisiana', 'LA', '', 100);
INSERT INTO `state` VALUES(24, '0000-00-00 00:00:00', 235, 'Massachusetts', 'MA', '', 100);
INSERT INTO `state` VALUES(25, '0000-00-00 00:00:00', 40, 'Manitoba', 'MB', '', 10);
INSERT INTO `state` VALUES(26, '0000-00-00 00:00:00', 235, 'Maryland', 'MD', '', 100);
INSERT INTO `state` VALUES(27, '0000-00-00 00:00:00', 235, 'Maine', 'ME', '', 100);
INSERT INTO `state` VALUES(28, '0000-00-00 00:00:00', 235, 'Michigan', 'MI', '', 100);
INSERT INTO `state` VALUES(29, '0000-00-00 00:00:00', 235, 'Micronesia', 'FM', '', 100);
INSERT INTO `state` VALUES(30, '0000-00-00 00:00:00', 235, 'Minnesota', 'MN', '', 100);
INSERT INTO `state` VALUES(31, '0000-00-00 00:00:00', 235, 'Missouri', 'MO', '', 100);
INSERT INTO `state` VALUES(32, '0000-00-00 00:00:00', 235, 'Mississippi', 'MS', '', 100);
INSERT INTO `state` VALUES(33, '0000-00-00 00:00:00', 235, 'Montana', 'MT', '', 100);
INSERT INTO `state` VALUES(34, '0000-00-00 00:00:00', 40, 'New Brunswick', 'NB', '', 10);
INSERT INTO `state` VALUES(35, '0000-00-00 00:00:00', 235, 'North Carolina', 'NC', '', 100);
INSERT INTO `state` VALUES(36, '0000-00-00 00:00:00', 235, 'North Dakota', 'ND', '', 100);
INSERT INTO `state` VALUES(37, '0000-00-00 00:00:00', 235, 'Nebraska', 'NE', '', 100);
INSERT INTO `state` VALUES(38, '0000-00-00 00:00:00', 40, 'Newfoundland/Labrador', 'NL', 'Newfoundland|Labrador|Newfoundland and Labrador|Newfoundland & Labrador', 10);
INSERT INTO `state` VALUES(39, '0000-00-00 00:00:00', 235, 'New Hampshire', 'NH', '', 100);
INSERT INTO `state` VALUES(40, '0000-00-00 00:00:00', 235, 'New Jersey', 'NJ', '', 100);
INSERT INTO `state` VALUES(41, '0000-00-00 00:00:00', 235, 'New Mexico', 'NM', '', 100);
INSERT INTO `state` VALUES(42, '0000-00-00 00:00:00', 40, 'Nova Scotia', 'NS', '', 10);
INSERT INTO `state` VALUES(43, '0000-00-00 00:00:00', 40, 'Northwest Territories', 'NT', 'NWT|North West Territories', 10);
INSERT INTO `state` VALUES(44, '0000-00-00 00:00:00', 40, 'Nunavut', 'NU', '', 10);
INSERT INTO `state` VALUES(45, '0000-00-00 00:00:00', 235, 'Nevada', 'NV', '', 100);
INSERT INTO `state` VALUES(46, '0000-00-00 00:00:00', 235, 'New York', 'NY', '', 100);
INSERT INTO `state` VALUES(47, '0000-00-00 00:00:00', 235, 'Ohio', 'OH', '', 100);
INSERT INTO `state` VALUES(48, '0000-00-00 00:00:00', 235, 'Oklahoma', 'OK', '', 100);
INSERT INTO `state` VALUES(49, '0000-00-00 00:00:00', 40, 'Ontario', 'ON', '', 10);
INSERT INTO `state` VALUES(50, '0000-00-00 00:00:00', 235, 'Oregon', 'OR', '', 100);
INSERT INTO `state` VALUES(51, '0000-00-00 00:00:00', 235, 'Pennsylvania', 'PA', '', 100);
INSERT INTO `state` VALUES(52, '0000-00-00 00:00:00', 40, 'Prince Edward Island', 'PE', 'PEI', 10);
INSERT INTO `state` VALUES(53, '0000-00-00 00:00:00', 235, 'Puerto Rico', 'PR', '', 100);
INSERT INTO `state` VALUES(54, '0000-00-00 00:00:00', 40, 'Quebec', 'QC', '', 10);
INSERT INTO `state` VALUES(55, '0000-00-00 00:00:00', 235, 'Rhode Island', 'RI', '', 100);
INSERT INTO `state` VALUES(56, '0000-00-00 00:00:00', 235, 'South Carolina', 'SC', '', 100);
INSERT INTO `state` VALUES(57, '0000-00-00 00:00:00', 235, 'South Dakota', 'SD', '', 100);
INSERT INTO `state` VALUES(58, '0000-00-00 00:00:00', 40, 'Saskatchewan', 'SK', '', 10);
INSERT INTO `state` VALUES(59, '0000-00-00 00:00:00', 235, 'Tennessee', 'TN', '', 100);
INSERT INTO `state` VALUES(60, '0000-00-00 00:00:00', 235, 'Texas', 'TX', '', 100);
INSERT INTO `state` VALUES(61, '0000-00-00 00:00:00', 235, 'Utah', 'UT', '', 100);
INSERT INTO `state` VALUES(62, '0000-00-00 00:00:00', 235, 'Virginia', 'VA', '', 100);
INSERT INTO `state` VALUES(63, '0000-00-00 00:00:00', 235, 'Virgin Islands', 'VI', '', 100);
INSERT INTO `state` VALUES(64, '0000-00-00 00:00:00', 235, 'Vermont', 'VT', '', 100);
INSERT INTO `state` VALUES(65, '0000-00-00 00:00:00', 235, 'Washington', 'WA', '', 100);
INSERT INTO `state` VALUES(66, '0000-00-00 00:00:00', 235, 'Wisconsin', 'WI', '', 100);
INSERT INTO `state` VALUES(67, '0000-00-00 00:00:00', 235, 'West Virginia', 'WV', '', 100);
INSERT INTO `state` VALUES(68, '0000-00-00 00:00:00', 235, 'Wyoming', 'WY', '', 100);
INSERT INTO `state` VALUES(69, '0000-00-00 00:00:00', 40, 'Yukon', 'YT', '', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tree`
--

CREATE TABLE `tree` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expiry_date` datetime NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lft` int(10) unsigned NOT NULL,
  `rgt` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expiry_date` (`expiry_date`,`lft`,`rgt`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tree`
--

INSERT INTO `tree` VALUES(1, '0000-00-00 00:00:00', 'root', 1, 22);
INSERT INTO `tree` VALUES(14, '0000-00-00 00:00:00', 'Televisions', 13, 16);
INSERT INTO `tree` VALUES(13, '0000-00-00 00:00:00', 'Electronics', 12, 17);
INSERT INTO `tree` VALUES(12, '0000-00-00 00:00:00', 'Cherry', 7, 8);
INSERT INTO `tree` VALUES(11, '0000-00-00 00:00:00', 'Red', 6, 9);
INSERT INTO `tree` VALUES(10, '0000-00-00 00:00:00', 'Fruit', 3, 10);
INSERT INTO `tree` VALUES(9, '0000-00-00 00:00:00', 'Food', 2, 11);
INSERT INTO `tree` VALUES(15, '0000-00-00 00:00:00', 'Tube', 14, 15);
INSERT INTO `tree` VALUES(16, '0000-00-00 00:00:00', 'Orange', 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expiry_date` datetime NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(100) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active_flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `login_count` smallint(6) unsigned NOT NULL DEFAULT '0',
  `last_login` datetime NOT NULL,
  `failed_login_count` mediumint(9) unsigned NOT NULL DEFAULT '0',
  `last_failed_login` datetime NOT NULL,
  `reset_token` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `force_update_password_flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `force_update_profile_flag` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`expiry_date`,`username`),
  KEY `active_flag` (`active_flag`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` VALUES(1, '0000-00-00 00:00:00', 'admin@admin.com', '06b28319e30193fc0f1d06ad118db92cc53ec695e3f9c9257b63224015763728', 'Admin', 'Admin', 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_group`
--

CREATE TABLE `user_group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0',
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
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_created` datetime NOT NULL,
  `date_expired` datetime NOT NULL,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `token` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `date_expired` (`date_expired`,`user_id`,`token`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_token`
--