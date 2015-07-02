/*
Navicat MySQL Data Transfer

Source Server         : 116.90.227.149_1
Source Server Version : 50529
Source Host           : 116.90.227.149:3306
Source Database       : db_mikrotik

Target Server Type    : MYSQL
Target Server Version : 50529
File Encoding         : 65001

Date: 2013-12-10 12:54:24
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `ag_login`
-- ----------------------------
DROP TABLE IF EXISTS `ag_login`;
CREATE TABLE `ag_login` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `password` varchar(100) NOT NULL,
  `recovery_email` varchar(200) NOT NULL,
  `blocked` tinyint(1) NOT NULL DEFAULT '1',
  `blocked_reason` text NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login_attempt` tinyint(10) NOT NULL,
  `browser` varchar(100) NOT NULL,
  `login_ip` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `read_write_blocked` int(11) NOT NULL DEFAULT '1',
  `allow_queue_add` int(11) NOT NULL DEFAULT '1',
  `allow_queue_edit` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ag_login
-- ----------------------------
INSERT INTO ag_login VALUES ('10', 'shailesh', '0', 'bd0a67a9a62db7d8c857a6723a973dcb3d646d97', 'shailesh.singh@websurfer.com.np', '0', '', '2012-11-08 12:21:20', '0', '', '', '0', '0', '0', '0', '0');
INSERT INTO ag_login VALUES ('20', 'yunesh', '0', '35a352c6d13343f42bae9dc131fb189971f1d4f1', 'raj_singh82w220@yahoo.com', '0', '', '2013-03-07 14:35:50', '0', '', '', '0', '0', '1', '1', '0');

-- ----------------------------
-- Table structure for `bandwidth`
-- ----------------------------
DROP TABLE IF EXISTS `bandwidth`;
CREATE TABLE `bandwidth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `limits` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of bandwidth
-- ----------------------------
INSERT INTO bandwidth VALUES ('1', '64k', '64k');
INSERT INTO bandwidth VALUES ('2', '128k', '128k');
INSERT INTO bandwidth VALUES ('3', '256k', '256k');
INSERT INTO bandwidth VALUES ('4', '512k', '512k');
INSERT INTO bandwidth VALUES ('5', '1M', '1M');
INSERT INTO bandwidth VALUES ('6', '2M', '2M');
INSERT INTO bandwidth VALUES ('7', '0k', 'unlimited');
INSERT INTO bandwidth VALUES ('8', '1k', 'disabled');

-- ----------------------------
-- Table structure for `category`
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO category VALUES ('1', 'Hotspot111', 'Hotspot111', 'Hotspot');
INSERT INTO category VALUES ('5', 'asdfsdf113', 'wefedfsd112', 'sdfsdfsdf114');
INSERT INTO category VALUES ('18', 'shailesh1', 'shailesh1', 'shaielsh');

-- ----------------------------
-- Table structure for `devices_list`
-- ----------------------------
DROP TABLE IF EXISTS `devices_list`;
CREATE TABLE `devices_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `ip_addr` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `block_status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of devices_list
-- ----------------------------
INSERT INTO devices_list VALUES ('30', 'admin1123', '', '11.11.11.11', '1', '1');
INSERT INTO devices_list VALUES ('24', 'admin', '', '116.90.226.186', '1', '0');

-- ----------------------------
-- Table structure for `queues`
-- ----------------------------
DROP TABLE IF EXISTS `queues`;
CREATE TABLE `queues` (
  `q_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `target_address` longtext NOT NULL,
  `rx_max_limit` varchar(255) NOT NULL,
  `tx_max_limit` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `parent_queue_id` int(11) NOT NULL,
  `multiple_ips` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`q_id`)
) ENGINE=MyISAM AUTO_INCREMENT=211 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of queues
-- ----------------------------
INSERT INTO queues VALUES ('208', 'a', '1.1.1.1', '512k', '512k', '1', '0', '0');
INSERT INTO queues VALUES ('209', 'a1', '2.2.2.2', '512k', '512k', '1', '208', '0');
INSERT INTO queues VALUES ('210', 'a2', '3.3.3.3', '256k', '256k', '1', '209', '0');

-- ----------------------------
-- Table structure for `tbl_editlog`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_editlog`;
CREATE TABLE `tbl_editlog` (
  `log_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `fieldname` varchar(200) NOT NULL,
  `field_old_value` varchar(200) NOT NULL,
  `field_new_value` varchar(200) NOT NULL,
  `edited_by` varchar(200) NOT NULL,
  `edited_on` datetime NOT NULL,
  `category_id` int(10) NOT NULL,
  `device_name` varchar(100) NOT NULL,
  `extra` varchar(200) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `added_on` datetime NOT NULL,
  `table_name` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `affected_queue` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=527 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_editlog
-- ----------------------------
INSERT INTO tbl_editlog VALUES ('516', 'queue_name', 'aa', 'Queue is deleted', 'shailesh', '2013-03-08 13:12:25', '0', '116.90.226.186', '', 'Hotspot111', 'n/a', '0000-00-00 00:00:00', 'Queue Deleted', 'delete', null);
INSERT INTO tbl_editlog VALUES ('517', 'queue_name', 'aa1', 'Queue is deleted', 'shailesh', '2013-03-08 13:15:12', '0', '116.90.226.186', '', 'Hotspot111', 'n/a', '0000-00-00 00:00:00', 'Queue Deleted', 'delete', null);
INSERT INTO tbl_editlog VALUES ('518', 'queue_name', 'aa2', 'Queue is deleted', 'shailesh', '2013-03-08 13:16:09', '0', '116.90.226.186', '', 'Hotspot111', 'n/a', '0000-00-00 00:00:00', 'Queue Deleted', 'delete', null);
INSERT INTO tbl_editlog VALUES ('519', 'queue_name', 'bb1', 'Queue is deleted', 'shailesh', '2013-03-08 13:16:37', '0', '116.90.226.186', '', 'Hotspot111', 'n/a', '0000-00-00 00:00:00', 'Queue Deleted', 'delete', null);
INSERT INTO tbl_editlog VALUES ('520', 'queue_name', 'aaa', 'Queue is deleted', 'shailesh', '2013-03-08 13:20:12', '0', '116.90.226.186', '', 'Hotspot111', 'n/a', '0000-00-00 00:00:00', 'Queue Deleted', 'delete', null);
INSERT INTO tbl_editlog VALUES ('521', 'queue_name', 'aaaa', 'Queue is deleted', 'shailesh', '2013-03-08 13:20:27', '0', '116.90.226.186', '', 'Hotspot111', 'n/a', '0000-00-00 00:00:00', 'Queue Deleted', 'delete', null);
INSERT INTO tbl_editlog VALUES ('522', 'tx/rx', '64k/64k', '256k/256k', 'shailesh', '2013-03-08 14:01:54', '0', '116.90.226.186', '', 'Hotspot111', 'n/a', '0000-00-00 00:00:00', 'Queues is Edited', 'edit', null);
INSERT INTO tbl_editlog VALUES ('523', 'queue_name', 'n/a', 'a', 'n/a', '0000-00-00 00:00:00', '0', '116.90.226.186', '', 'Hotspot111', 'shailesh', '2013-03-08 14:48:33', 'New Queue Added', 'add', null);
INSERT INTO tbl_editlog VALUES ('524', 'queue_name', 'n/a', 'a1', 'n/a', '0000-00-00 00:00:00', '0', '116.90.226.186', '', 'Hotspot111', 'shailesh', '2013-03-08 14:48:50', 'New Queue Added', 'add', null);
INSERT INTO tbl_editlog VALUES ('525', 'queue_name', 'n/a', 'a2', 'n/a', '0000-00-00 00:00:00', '0', '116.90.226.186', '', 'Hotspot111', 'shailesh', '2013-03-08 14:49:06', 'New Queue Added', 'add', null);
INSERT INTO tbl_editlog VALUES ('526', 'Category', 'bbb', 'Deleted', 'shailesh', '2013-03-08 15:20:02', '0', 'n/a', '', 'bbb', 'n/a', '0000-00-00 00:00:00', 'Category is Deleted', 'delete', null);
