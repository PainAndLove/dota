-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2014-03-06 17:08:05
-- 服务器版本： 5.6.16
-- PHP Version: 5.5.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mysql`
--

-- --------------------------------------------------------

--
-- 表的结构 `ability_upgrades`
--

CREATE TABLE IF NOT EXISTS `ability_upgrades` (
  `slot_id` int(10) unsigned NOT NULL,
  `ability` int(8) unsigned NOT NULL,
  `time` int(10) unsigned NOT NULL,
  `level` tinyint(4) unsigned NOT NULL,
  KEY `FK_ability_upgrades_slots` (`slot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `additional_units`
--

CREATE TABLE IF NOT EXISTS `additional_units` (
  `slot_id` int(10) unsigned NOT NULL,
  `unitname` varchar(100) NOT NULL,
  `item_0` int(10) NOT NULL,
  `item_1` int(10) NOT NULL,
  `item_2` int(10) NOT NULL,
  `item_3` int(10) NOT NULL,
  `item_4` int(10) NOT NULL,
  `item_5` int(10) NOT NULL,
  KEY `FK_additional_units_slots` (`slot_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `match_id` bigint(20) NOT NULL,
  `season` tinyint(4) unsigned DEFAULT NULL,
  `radiant_win` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `duration` int(11) unsigned NOT NULL DEFAULT '0',
  `first_blood_time` int(11) unsigned NOT NULL DEFAULT '0',
  `match_seq_num` bigint(20) unsigned DEFAULT NULL,
  `game_mode` tinyint(4) NOT NULL,
  `tower_status_radiant` int(11) unsigned NOT NULL DEFAULT '0',
  `tower_status_dire` int(11) unsigned NOT NULL DEFAULT '0',
  `barracks_status_radiant` int(11) unsigned NOT NULL DEFAULT '0',
  `barracks_status_dire` int(11) unsigned NOT NULL DEFAULT '0',
  `replay_salt` bigint(20) DEFAULT NULL,
  `lobby_type` smallint(6) unsigned NOT NULL DEFAULT '0',
  `human_players` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `leagueid` int(4) unsigned NOT NULL DEFAULT '0',
  `cluster` smallint(6) unsigned NOT NULL DEFAULT '0',
  `positive_votes` int(11) unsigned NOT NULL DEFAULT '0',
  `negative_votes` int(11) unsigned NOT NULL DEFAULT '0',
  `radiant_team_id` int(11) unsigned DEFAULT NULL,
  `radiant_name` varchar(200) DEFAULT NULL,
  `radiant_logo` varchar(32) DEFAULT NULL,
  `radiant_team_complete` tinyint(3) unsigned DEFAULT NULL,
  `dire_team_id` int(11) unsigned DEFAULT NULL,
  `dire_name` varchar(200) DEFAULT NULL,
  `dire_logo` varchar(32) DEFAULT NULL,
  `dire_team_complete` tinyint(3) unsigned DEFAULT NULL,
  `start_time` bigint(12) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `matchid` (`match_id`),
  KEY `FK_matches_game_mods` (`game_mode`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=65 ;

--
-- 转存表中的数据 `matches`
--

INSERT INTO `matches` (`id`, `match_id`, `season`, `radiant_win`, `duration`, `first_blood_time`, `match_seq_num`, `game_mode`, `tower_status_radiant`, `tower_status_dire`, `barracks_status_radiant`, `barracks_status_dire`, `replay_salt`, `lobby_type`, `human_players`, `leagueid`, `cluster`, `positive_votes`, `negative_votes`, `radiant_team_id`, `radiant_name`, `radiant_logo`, `radiant_team_complete`, `dire_team_id`, `dire_name`, `dire_logo`, `dire_team_complete`, `start_time`) VALUES
(38, 545437810, NULL, 0, 2014, 240, 496860397, 1, 32, 2047, 12, 63, NULL, 0, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1393766571),
(39, 545340993, NULL, 0, 3024, 193, 496796356, 1, 0, 1974, 0, 63, NULL, 0, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1393762857),
(40, 545275318, NULL, 1, 2294, 167, 496721663, 3, 1958, 260, 63, 51, NULL, 0, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1393760263),
(41, 535277667, NULL, 0, 2272, 112, 487716872, 1, 0, 2038, 0, 63, NULL, 7, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1393144534),
(42, 535197115, NULL, 1, 2838, 66, 487659450, 1, 1796, 0, 51, 0, NULL, 7, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1393140968),
(43, 535039180, NULL, 1, 2301, 255, 487502510, 1, 2038, 0, 63, 0, NULL, 7, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1393132801),
(44, 534987941, NULL, 0, 2887, 52, 487466331, 1, 0, 1956, 0, 63, NULL, 7, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1393129458),
(45, 534948061, NULL, 1, 2286, 59, 487422064, 1, 1828, 0, 63, 0, NULL, 7, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1393126508),
(46, 534043620, NULL, 0, 2098, 222, 486599910, 1, 0, 2038, 0, 63, NULL, 7, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1393077283),
(47, 533955286, NULL, 0, 2689, 20, 486535474, 1, 0, 1952, 0, 60, NULL, 7, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1393074164),
(48, 533669965, NULL, 1, 2875, 62, 486281118, 1, 1972, 4, 63, 3, NULL, 7, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1393062553),
(49, 533600233, NULL, 1, 2405, 294, 486212338, 16, 1975, 0, 63, 48, NULL, 7, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1393059545),
(50, 533415686, NULL, 1, 1988, 163, 486031533, 1, 2038, 4, 63, 3, NULL, 7, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1393048790),
(51, 533362917, NULL, 0, 2863, 192, 485996296, 1, 0, 1974, 0, 63, NULL, 7, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1393045372),
(52, 532418837, NULL, 0, 2159, 117, 485135034, 3, 260, 2039, 51, 63, NULL, 0, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1392989062),
(53, 532342599, NULL, 1, 2702, 24, 485073344, 1, 1974, 0, 63, 16, NULL, 0, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1392985767),
(54, 532285914, NULL, 0, 2093, 140, 485011783, 1, 256, 1983, 48, 63, NULL, 0, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1392983300),
(55, 532234795, NULL, 0, 2030, 293, 484966064, 1, 4, 1974, 3, 63, NULL, 0, 10, 0, 231, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1392980827),
(56, 529328145, NULL, 0, 973, 0, 482291513, 15, 0, 0, 0, 0, NULL, 4, 5, 0, 223, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1392822202),
(57, 529274169, NULL, 0, 879, 0, 482243360, 15, 0, 0, 0, 0, NULL, 4, 5, 0, 223, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1392820490),
(58, 529205210, NULL, 0, 1530, 0, 482193892, 15, 0, 0, 0, 0, NULL, 4, 5, 0, 222, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1392818358),
(59, 529177093, NULL, 0, 291, 0, 482130716, 15, 0, 0, 0, 0, NULL, 4, 5, 0, 223, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1392817498),
(60, 527569570, NULL, 1, 3595, 89, 480740810, 1, 1542, 6, 35, 3, NULL, 0, 10, 0, 222, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1392731419),
(61, 527495468, NULL, 0, 2410, 36, 480649378, 3, 0, 1982, 0, 63, NULL, 0, 10, 0, 222, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1392728553),
(62, 527445365, NULL, 1, 1585, 212, 480586298, 3, 1983, 0, 63, 0, NULL, 0, 10, 0, 223, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1392726467),
(63, 527383506, NULL, 0, 2372, 290, 480547082, 1, 0, 1846, 0, 63, NULL, 0, 10, 0, 222, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1392723697),
(64, 527340760, NULL, 0, 1650, 244, 480498303, 1, 4, 1975, 3, 63, NULL, 0, 10, 0, 223, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1392721485);

-- --------------------------------------------------------

--
-- 表的结构 `picks_bans`
--

CREATE TABLE IF NOT EXISTS `picks_bans` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `match_id` bigint(20) NOT NULL,
  `is_pick` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `hero_id` int(10) NOT NULL DEFAULT '0',
  `team` int(1) unsigned NOT NULL DEFAULT '0',
  `order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `slots`
--

CREATE TABLE IF NOT EXISTS `slots` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `match_id` bigint(20) NOT NULL DEFAULT '0',
  `account_id` bigint(20) NOT NULL DEFAULT '0',
  `hero_id` int(10) NOT NULL DEFAULT '0',
  `player_slot` tinyint(10) unsigned NOT NULL DEFAULT '0',
  `item_0` int(10) NOT NULL DEFAULT '0',
  `item_1` int(10) NOT NULL DEFAULT '0',
  `item_2` int(10) NOT NULL DEFAULT '0',
  `item_3` int(10) NOT NULL DEFAULT '0',
  `item_4` int(10) NOT NULL DEFAULT '0',
  `item_5` int(10) NOT NULL DEFAULT '0',
  `kills` int(10) NOT NULL DEFAULT '0',
  `deaths` int(10) NOT NULL DEFAULT '0',
  `assists` int(10) NOT NULL DEFAULT '0',
  `leaver_status` int(10) NOT NULL DEFAULT '0',
  `gold` int(10) NOT NULL DEFAULT '0',
  `last_hits` int(10) NOT NULL DEFAULT '0',
  `denies` int(10) NOT NULL DEFAULT '0',
  `gold_per_min` int(10) NOT NULL DEFAULT '0',
  `xp_per_min` int(10) NOT NULL DEFAULT '0',
  `gold_spent` int(10) NOT NULL DEFAULT '0',
  `hero_damage` int(10) NOT NULL DEFAULT '0',
  `tower_damage` int(10) NOT NULL DEFAULT '0',
  `hero_healing` int(10) NOT NULL DEFAULT '0',
  `level` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_slots_users` (`account_id`),
  KEY `FK_slots_heroes` (`hero_id`),
  KEY `FK_slots_items` (`item_0`),
  KEY `FK_slots_items_1` (`item_1`),
  KEY `FK_slots_items_2` (`item_2`),
  KEY `FK_slots_items_3` (`item_3`),
  KEY `FK_slots_items_4` (`item_4`),
  KEY `FK_slots_items_5` (`item_5`),
  KEY `FK_slots_matches` (`match_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `status`
--

CREATE TABLE IF NOT EXISTS `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `account_id` bigint(20) unsigned NOT NULL,
  `statu` int(1) unsigned NOT NULL COMMENT '0为已经完成 1为还在进行更新',
  `last_match_id` bigint(20) unsigned NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Host` char(60) COLLATE utf8_bin NOT NULL DEFAULT '',
  `User` char(16) COLLATE utf8_bin NOT NULL DEFAULT '',
  `Password` char(41) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL DEFAULT '',
  `Select_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Insert_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Update_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Delete_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Drop_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Reload_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Shutdown_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Process_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `File_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Grant_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `References_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Index_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Alter_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Show_db_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Super_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_tmp_table_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Lock_tables_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Execute_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Repl_slave_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Repl_client_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_view_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Show_view_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_routine_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Alter_routine_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_user_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Event_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Trigger_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `Create_tablespace_priv` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  `ssl_type` enum('','ANY','X509','SPECIFIED') CHARACTER SET utf8 NOT NULL DEFAULT '',
  `ssl_cipher` blob NOT NULL,
  `x509_issuer` blob NOT NULL,
  `x509_subject` blob NOT NULL,
  `max_questions` int(11) unsigned NOT NULL DEFAULT '0',
  `max_updates` int(11) unsigned NOT NULL DEFAULT '0',
  `max_connections` int(11) unsigned NOT NULL DEFAULT '0',
  `max_user_connections` int(11) unsigned NOT NULL DEFAULT '0',
  `plugin` char(64) COLLATE utf8_bin DEFAULT '',
  `authentication_string` text COLLATE utf8_bin,
  `password_expired` enum('N','Y') CHARACTER SET utf8 NOT NULL DEFAULT 'N',
  PRIMARY KEY (`Host`,`User`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and global privileges';

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`Host`, `User`, `Password`, `Select_priv`, `Insert_priv`, `Update_priv`, `Delete_priv`, `Create_priv`, `Drop_priv`, `Reload_priv`, `Shutdown_priv`, `Process_priv`, `File_priv`, `Grant_priv`, `References_priv`, `Index_priv`, `Alter_priv`, `Show_db_priv`, `Super_priv`, `Create_tmp_table_priv`, `Lock_tables_priv`, `Execute_priv`, `Repl_slave_priv`, `Repl_client_priv`, `Create_view_priv`, `Show_view_priv`, `Create_routine_priv`, `Alter_routine_priv`, `Create_user_priv`, `Event_priv`, `Trigger_priv`, `Create_tablespace_priv`, `ssl_type`, `ssl_cipher`, `x509_issuer`, `x509_subject`, `max_questions`, `max_updates`, `max_connections`, `max_user_connections`, `plugin`, `authentication_string`, `password_expired`) VALUES
('localhost', 'root', '', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', '', '', '', '', 0, 0, 0, 0, '', '', 'N'),
('127.0.0.1', 'root', '', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', '', '', '', '', 0, 0, 0, 0, '', '', 'N'),
('::1', 'root', '', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', '', '', '', '', 0, 0, 0, 0, '', '', 'N'),
('localhost', '', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '', '', '', '', 0, 0, 0, 0, '', NULL, 'N'),
('localhost', 'pma', '', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '', '', '', '', 0, 0, 0, 0, '', '', 'N');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `account_id` bigint(20) NOT NULL DEFAULT '0',
  `personaname` varchar(50) NOT NULL DEFAULT '',
  `steamid` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 限制导出的表
--

--
-- 限制表 `ability_upgrades`
--
ALTER TABLE `ability_upgrades`
  ADD CONSTRAINT `FK_ability_upgrades_slots` FOREIGN KEY (`slot_id`) REFERENCES `slots` (`id`);

--
-- 限制表 `additional_units`
--
ALTER TABLE `additional_units`
  ADD CONSTRAINT `FK_additional_units_slots` FOREIGN KEY (`slot_id`) REFERENCES `slots` (`id`);

--
-- 限制表 `slots`
--
ALTER TABLE `slots`
  ADD CONSTRAINT `FK_slots_matches` FOREIGN KEY (`match_id`) REFERENCES `matches` (`match_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
