/*
Navicat MySQL Data Transfer

Source Server         : goods
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : tp6

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2019-09-09 17:57:49
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for auth
-- ----------------------------
DROP TABLE IF EXISTS `auth`;
CREATE TABLE `auth` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '权限id',
  `authname` varchar(20) COLLATE utf8_sinhala_ci NOT NULL COMMENT '权限名',
  `controllername` varchar(10) COLLATE utf8_sinhala_ci NOT NULL COMMENT '控制器名',
  `actionname` varchar(10) COLLATE utf8_sinhala_ci NOT NULL COMMENT '方法名',
  `pid` tinyint(5) unsigned NOT NULL COMMENT '父id',
  `is_menu` enum('0','1') COLLATE utf8_sinhala_ci DEFAULT '0' COMMENT '是否主菜单 0否 1是',
  PRIMARY KEY (`id`),
  UNIQUE KEY `authname` (`authname`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_sinhala_ci;

-- ----------------------------
-- Records of auth
-- ----------------------------
INSERT INTO `auth` VALUES ('1', '用户管理', '0', '0', '0', '1');
INSERT INTO `auth` VALUES ('2', '用户添加', 'user', 'add', '1', '1');
INSERT INTO `auth` VALUES ('3', '用户修改', 'user', 'edit', '1', '0');
INSERT INTO `auth` VALUES ('4', '用户删除', 'user', 'delete', '1', '0');
INSERT INTO `auth` VALUES ('5', '用户展示', 'user', 'index', '1', '1');
INSERT INTO `auth` VALUES ('6', '用户注册', 'login', 'register', '1', '1');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `rolename` varchar(20) COLLATE utf8_sinhala_ci NOT NULL COMMENT '角色名',
  PRIMARY KEY (`id`),
  KEY `rolename` (`rolename`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_sinhala_ci;

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '超级管理员');
INSERT INTO `role` VALUES ('2', '普通员工');

-- ----------------------------
-- Table structure for roleauth
-- ----------------------------
DROP TABLE IF EXISTS `roleauth`;
CREATE TABLE `roleauth` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '角色权限表id',
  `roleid` tinyint(3) unsigned NOT NULL COMMENT '角色id',
  `authid` tinyint(3) unsigned NOT NULL COMMENT '权限id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_sinhala_ci;

-- ----------------------------
-- Records of roleauth
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(20) COLLATE utf8_sinhala_ci NOT NULL COMMENT '用户名',
  `password` varchar(255) COLLATE utf8_sinhala_ci NOT NULL COMMENT '密码',
  `is_super` enum('0','1') COLLATE utf8_sinhala_ci NOT NULL DEFAULT '0' COMMENT '是否超管 0否 1是',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除数据时间戳',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_sinhala_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '张三', '25d55ad283aa400af464c76d713c07ad', '1', '0');
INSERT INTO `user` VALUES ('2', '李四', '25f9e794323b453885f5181f1b624d0b', '0', '0');
INSERT INTO `user` VALUES ('3', '王五', '25f9e794323b453885f5181f1b624d0b', '0', '1567871041');
INSERT INTO `user` VALUES ('4', '赵日天', '25d55ad283aa400af464c76d713c07ad', '0', '0');

-- ----------------------------
-- Table structure for userrole
-- ----------------------------
DROP TABLE IF EXISTS `userrole`;
CREATE TABLE `userrole` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户角色表id',
  `userid` tinyint(3) unsigned NOT NULL COMMENT '用户id',
  `roleid` tinyint(3) unsigned NOT NULL COMMENT '角色id',
  `delete_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '删除用户角色数据时间戳',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_sinhala_ci;

-- ----------------------------
-- Records of userrole
-- ----------------------------
INSERT INTO `userrole` VALUES ('1', '1', '1', '0');
INSERT INTO `userrole` VALUES ('2', '2', '2', '0');
INSERT INTO `userrole` VALUES ('3', '3', '2', '1567871041');
INSERT INTO `userrole` VALUES ('4', '4', '2', '1567871990');
