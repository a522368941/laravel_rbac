/*
Navicat MySQL Data Transfer

Source Server         : 本地mysql8.0
Source Server Version : 80012
Source Host           : localhost:3306
Source Database       : laravel_rbac

Target Server Type    : MYSQL
Target Server Version : 80012
File Encoding         : 65001

Date: 2022-09-15 17:36:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for sys_administrators
-- ----------------------------
DROP TABLE IF EXISTS `sys_administrators`;
CREATE TABLE `sys_administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL COMMENT '企业ID',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '用户名',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `true_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '姓名',
  `is_super` tinyint(4) NOT NULL DEFAULT '0' COMMENT '是否超级管理员',
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_disabled` char(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '0' COMMENT '是否禁用0：未禁用，1：已禁用',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `area_code` tinyint(4) DEFAULT NULL COMMENT '1-越城区 2-柯桥区 3-上虞区 4-新昌县 5-诸暨市 6-嵊州市 NULL-绍兴市',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `administrators_email_unique` (`email`,`company_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=106 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='后台用户表';

-- ----------------------------
-- Records of sys_administrators
-- ----------------------------
INSERT INTO `sys_administrators` VALUES ('1', '2', 'admin', 'admin', '15974118307', '系统管理员', '1', '$2y$10$QEYHWi1BuftL2BMpmrSqfezCwRi1H5qItzJVMFZ16W3bZMDX2UVCy', '1Rva4HHzPDlZ74g95RxCnlxad2D3AUT3zvJwLvUR1KNfkUALUTNaTc3ROHCg', '0', '2019-01-04 00:00:00', '2022-09-14 01:00:11', '7');
INSERT INTO `sys_administrators` VALUES ('105', null, null, 'admin1', '15678451236', 'admin1', '0', '$2y$10$gdav84H7/HEEyHrHGvNXLuYzSuSyucrO3BR2d5zWoaiTzaIF68kd6', 'ghEaMozQ2X94XEzKqEj5nwjSYi6N59a9lfAo0OJEkYXKTUcTdKh0jh6PgOtu', '0', '2022-09-14 01:00:55', '2022-09-15 01:42:44', null);

-- ----------------------------
-- Table structure for sys_administrator_role
-- ----------------------------
DROP TABLE IF EXISTS `sys_administrator_role`;
CREATE TABLE `sys_administrator_role` (
  `administrator_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `area_code` tinyint(4) DEFAULT NULL COMMENT '1-越城区 2-柯桥区 3-上虞区 4-新昌县 5-诸暨市 6-嵊州市 NULL-绍兴市'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='后台用户-角色';

-- ----------------------------
-- Records of sys_administrator_role
-- ----------------------------
INSERT INTO `sys_administrator_role` VALUES ('1', '1', null);
INSERT INTO `sys_administrator_role` VALUES ('105', '2', null);

-- ----------------------------
-- Table structure for sys_loginlog
-- ----------------------------
DROP TABLE IF EXISTS `sys_loginlog`;
CREATE TABLE `sys_loginlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL COMMENT '企业ID',
  `admin_id` int(11) DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1:登录，2:退出',
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `area_code` tinyint(4) DEFAULT NULL COMMENT '1-越城区 2-柯桥区 3-上虞区 4-新昌县 5-诸暨市 6-嵊州市 NULL-绍兴市',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9009 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sys_loginlog
-- ----------------------------
INSERT INTO `sys_loginlog` VALUES ('8985', '0', '92', 'ycsw', '1', '127.0.0.1', '2022-09-14 00:55:53', null);
INSERT INTO `sys_loginlog` VALUES ('8986', '0', '92', 'ycsw', '2', '127.0.0.1', '2022-09-14 00:56:08', null);
INSERT INTO `sys_loginlog` VALUES ('8987', '0', '1', 'admin', '1', '127.0.0.1', '2022-09-14 00:56:32', null);
INSERT INTO `sys_loginlog` VALUES ('8988', '0', '1', 'admin', '2', '127.0.0.1', '2022-09-14 01:04:08', null);
INSERT INTO `sys_loginlog` VALUES ('8989', '0', '105', 'admin1', '1', '127.0.0.1', '2022-09-14 01:04:18', null);
INSERT INTO `sys_loginlog` VALUES ('8990', '0', '105', 'admin1', '2', '127.0.0.1', '2022-09-14 01:04:31', null);
INSERT INTO `sys_loginlog` VALUES ('8991', '0', '1', 'admin', '1', '127.0.0.1', '2022-09-14 01:04:40', null);
INSERT INTO `sys_loginlog` VALUES ('8992', '0', '1', 'admin', '2', '127.0.0.1', '2022-09-14 01:26:22', null);
INSERT INTO `sys_loginlog` VALUES ('8993', '0', '1', 'admin', '1', '127.0.0.1', '2022-09-14 01:35:41', null);
INSERT INTO `sys_loginlog` VALUES ('8994', '0', '1', 'admin', '2', '127.0.0.1', '2022-09-14 01:36:07', null);
INSERT INTO `sys_loginlog` VALUES ('8995', '0', '1', 'admin', '1', '127.0.0.1', '2022-09-14 01:44:06', null);
INSERT INTO `sys_loginlog` VALUES ('8996', '0', '1', 'admin', '2', '127.0.0.1', '2022-09-14 01:44:14', null);
INSERT INTO `sys_loginlog` VALUES ('8997', '0', '1', 'admin', '1', '127.0.0.1', '2022-09-14 01:44:48', null);
INSERT INTO `sys_loginlog` VALUES ('8998', '0', '1', 'admin', '1', '127.0.0.1', '2022-09-14 05:23:17', null);
INSERT INTO `sys_loginlog` VALUES ('8999', '0', '1', 'admin', '1', '127.0.0.1', '2022-09-14 07:38:08', null);
INSERT INTO `sys_loginlog` VALUES ('9000', '0', '1', 'admin', '1', '127.0.0.1', '2022-09-14 07:43:33', null);
INSERT INTO `sys_loginlog` VALUES ('9001', '0', '1', 'admin', '2', '127.0.0.1', '2022-09-14 07:45:29', null);
INSERT INTO `sys_loginlog` VALUES ('9002', '0', '1', 'admin', '1', '127.0.0.1', '2022-09-14 09:07:23', null);
INSERT INTO `sys_loginlog` VALUES ('9003', '0', '105', 'admin1', '1', '127.0.0.1', '2022-09-15 01:10:51', null);
INSERT INTO `sys_loginlog` VALUES ('9004', '0', '105', 'admin1', '1', '127.0.0.1', '2022-09-15 01:14:47', null);
INSERT INTO `sys_loginlog` VALUES ('9005', '0', '105', 'admin1', '2', '127.0.0.1', '2022-09-15 01:37:12', null);
INSERT INTO `sys_loginlog` VALUES ('9006', '0', '105', 'admin1', '1', '127.0.0.1', '2022-09-15 01:42:32', null);
INSERT INTO `sys_loginlog` VALUES ('9007', '0', '105', 'admin1', '2', '127.0.0.1', '2022-09-15 01:42:54', null);
INSERT INTO `sys_loginlog` VALUES ('9008', '0', '1', 'admin', '1', '127.0.0.1', '2022-09-15 01:43:03', null);

-- ----------------------------
-- Table structure for sys_members
-- ----------------------------
DROP TABLE IF EXISTS `sys_members`;
CREATE TABLE `sys_members` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `created_at` varchar(100) DEFAULT NULL,
  `updated_at` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of sys_members
-- ----------------------------
INSERT INTO `sys_members` VALUES ('3', '123', '$2y$10$m/kECDRUTWhXj290aLQ8v./YAhG.DYOu/DwV5fE9m7yonZfMLUFwG', '2022-09-15 04:58:27', '2022-09-15 04:58:27');

-- ----------------------------
-- Table structure for sys_operationlog
-- ----------------------------
DROP TABLE IF EXISTS `sys_operationlog`;
CREATE TABLE `sys_operationlog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL COMMENT '企业ID',
  `admin_id` int(11) DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `method` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `input` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `route_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '路由名称',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `area_code` tinyint(4) DEFAULT NULL COMMENT '1-越城区 2-柯桥区 3-上虞区 4-新昌县 5-诸暨市 6-嵊州市 NULL-绍兴市',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=83880 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of sys_operationlog
-- ----------------------------
INSERT INTO `sys_operationlog` VALUES ('83824', null, '1', 'admin', '新增管理员', 'admin/admin_user', 'POST', '127.0.0.1', '{\"true_name\":\"123\",\"email\":\"213\",\"phone\":\"213\",\"password\":\"213\",\"roles\":\"1\",\"is_super\":\"0\"}', 'admin.admin_user.store', '2022-09-14 00:57:36', '2022-09-14 00:57:36', null);
INSERT INTO `sys_operationlog` VALUES ('83825', null, '1', 'admin', '删除管理员', 'admin/admin_user/104', 'DELETE', '127.0.0.1', '{\"_method\":\"DELETE\"}', 'admin.admin_user.destroy', '2022-09-14 00:58:03', '2022-09-14 00:58:03', null);
INSERT INTO `sys_operationlog` VALUES ('83826', null, '1', 'admin', '删除管理员', 'admin/admin_user/103', 'DELETE', '127.0.0.1', '{\"_method\":\"DELETE\"}', 'admin.admin_user.destroy', '2022-09-14 00:58:07', '2022-09-14 00:58:07', null);
INSERT INTO `sys_operationlog` VALUES ('83827', null, '1', 'admin', '删除管理员', 'admin/admin_user/102', 'DELETE', '127.0.0.1', '{\"_method\":\"DELETE\"}', 'admin.admin_user.destroy', '2022-09-14 00:58:10', '2022-09-14 00:58:10', null);
INSERT INTO `sys_operationlog` VALUES ('83828', null, '1', 'admin', '编辑模块', 'admin/permission/2', 'PUT', '127.0.0.1', '{\"name\":\"admin.admin_user.index\",\"fid\":\"1\",\"url\":\"http:\\/\\/www.laravel-demo.com\\/admin\\/permission\\/2\",\"display_name\":\"管理员管理\",\"description\":\"查看后台管理员列表\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"1\",\"icon\":\"。\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 00:59:13', '2022-09-14 00:59:13', null);
INSERT INTO `sys_operationlog` VALUES ('83829', null, '1', 'admin', '删除管理员', 'admin/admin_user/89', 'DELETE', '127.0.0.1', '{\"_method\":\"DELETE\"}', 'admin.admin_user.destroy', '2022-09-14 00:59:28', '2022-09-14 00:59:28', null);
INSERT INTO `sys_operationlog` VALUES ('83830', null, '1', 'admin', '删除管理员', 'admin/admin_user/85', 'DELETE', '127.0.0.1', '{\"_method\":\"DELETE\"}', 'admin.admin_user.destroy', '2022-09-14 00:59:31', '2022-09-14 00:59:31', null);
INSERT INTO `sys_operationlog` VALUES ('83831', null, '1', 'admin', '删除管理员', 'admin/admin_user/100', 'DELETE', '127.0.0.1', '{\"_method\":\"DELETE\"}', 'admin.admin_user.destroy', '2022-09-14 00:59:35', '2022-09-14 00:59:35', null);
INSERT INTO `sys_operationlog` VALUES ('83832', null, '1', 'admin', '删除管理员', 'admin/admin_user/99', 'DELETE', '127.0.0.1', '{\"_method\":\"DELETE\"}', 'admin.admin_user.destroy', '2022-09-14 00:59:39', '2022-09-14 00:59:39', null);
INSERT INTO `sys_operationlog` VALUES ('83833', null, '1', 'admin', '删除管理员', 'admin/admin_user/98', 'DELETE', '127.0.0.1', '{\"_method\":\"DELETE\"}', 'admin.admin_user.destroy', '2022-09-14 00:59:42', '2022-09-14 00:59:42', null);
INSERT INTO `sys_operationlog` VALUES ('83834', null, '1', 'admin', '删除管理员', 'admin/admin_user/92', 'DELETE', '127.0.0.1', '{\"_method\":\"DELETE\"}', 'admin.admin_user.destroy', '2022-09-14 00:59:46', '2022-09-14 00:59:46', null);
INSERT INTO `sys_operationlog` VALUES ('83835', null, '1', 'admin', '删除管理员', 'admin/admin_user/93', 'DELETE', '127.0.0.1', '{\"_method\":\"DELETE\"}', 'admin.admin_user.destroy', '2022-09-14 00:59:49', '2022-09-14 00:59:49', null);
INSERT INTO `sys_operationlog` VALUES ('83836', null, '1', 'admin', '删除管理员', 'admin/admin_user/94', 'DELETE', '127.0.0.1', '{\"_method\":\"DELETE\"}', 'admin.admin_user.destroy', '2022-09-14 00:59:52', '2022-09-14 00:59:52', null);
INSERT INTO `sys_operationlog` VALUES ('83837', null, '1', 'admin', '删除管理员', 'admin/admin_user/96', 'DELETE', '127.0.0.1', '{\"_method\":\"DELETE\"}', 'admin.admin_user.destroy', '2022-09-14 01:00:00', '2022-09-14 01:00:00', null);
INSERT INTO `sys_operationlog` VALUES ('83838', null, '1', 'admin', '删除管理员', 'admin/admin_user/95', 'DELETE', '127.0.0.1', '{\"_method\":\"DELETE\"}', 'admin.admin_user.destroy', '2022-09-14 01:00:02', '2022-09-14 01:00:02', null);
INSERT INTO `sys_operationlog` VALUES ('83839', null, '1', 'admin', '编辑管理员', 'admin/admin_user/1', 'PUT', '127.0.0.1', '{\"true_name\":\"系统管理员\",\"email\":\"admin\",\"phone\":\"15974118307\",\"password\":\"123456\",\"roles\":\"1\",\"is_super\":\"1\",\"id\":\"1\",\"_method\":\"PUT\"}', 'admin.admin_user.update', '2022-09-14 01:00:11', '2022-09-14 01:00:11', null);
INSERT INTO `sys_operationlog` VALUES ('83840', null, '1', 'admin', '删除角色', 'admin/role/18', 'DELETE', '127.0.0.1', '{\"_method\":\"DELETE\"}', 'admin.role.destroy', '2022-09-14 01:00:24', '2022-09-14 01:00:24', null);
INSERT INTO `sys_operationlog` VALUES ('83841', null, '1', 'admin', '', 'admin/role/2/permissions', 'POST', '127.0.0.1', '{\"permissions\":[\"23\",\"350\"],\"_token\":\"AVSt7vs0FAONIkDDKr5AXuIhF3mx5OVU25spje91\"}', 'admin.role.permissions', '2022-09-14 01:00:31', '2022-09-14 01:00:31', null);
INSERT INTO `sys_operationlog` VALUES ('83842', null, '1', 'admin', '新增管理员', 'admin/admin_user', 'POST', '127.0.0.1', '{\"true_name\":\"admin1\",\"email\":\"admin1\",\"phone\":\"15678451236\",\"password\":\"123456\",\"roles\":\"2\",\"is_super\":\"0\"}', 'admin.admin_user.store', '2022-09-14 01:00:55', '2022-09-14 01:00:55', null);
INSERT INTO `sys_operationlog` VALUES ('83843', null, '1', 'admin', '编辑模块', 'admin/permission/23', 'PUT', '127.0.0.1', '{\"name\":\"#\",\"fid\":\"0\",\"url\":\"http:\\/\\/www.laravel-demo.com\\/admin\\/permission\\/23\",\"display_name\":\"会员管理\",\"description\":\"11\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"1\",\"icon\":\"&#xe770\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:19:25', '2022-09-14 01:19:25', null);
INSERT INTO `sys_operationlog` VALUES ('83844', null, '1', 'admin', '编辑模块', 'admin/permission/350', 'PUT', '127.0.0.1', '{\"name\":\"admin.member.list\",\"fid\":\"23\",\"url\":\"http:\\/\\/www.laravel-demo.com\\/admin\\/permission\\/350\",\"display_name\":\"会员列表\",\"description\":\"11\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"2\",\"icon\":\"&#xe66f\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:22:01', '2022-09-14 01:22:01', null);
INSERT INTO `sys_operationlog` VALUES ('83845', null, '1', 'admin', '编辑模块', 'admin/permission/1', 'PUT', '127.0.0.1', '{\"name\":\"#\",\"fid\":\"0\",\"url\":\"http:\\/\\/www.laravel-demo.com\\/admin\\/permission\\/1\",\"display_name\":\"系统设置\",\"description\":\"系统设置\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"100\",\"icon\":\"&#xe614\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:22:59', '2022-09-14 01:22:59', null);
INSERT INTO `sys_operationlog` VALUES ('83846', null, '1', 'admin', '编辑模块', 'admin/permission/2', 'PUT', '127.0.0.1', '{\"name\":\"admin.admin_user.index\",\"fid\":\"1\",\"url\":\"http:\\/\\/www.laravel-demo.com\\/admin\\/permission\\/2\",\"display_name\":\"管理员管理\",\"description\":\"查看后台管理员列表\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"1\",\"icon\":\"&#xe612\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:23:25', '2022-09-14 01:23:25', null);
INSERT INTO `sys_operationlog` VALUES ('83847', null, '1', 'admin', '编辑模块', 'admin/permission/9', 'PUT', '127.0.0.1', '{\"name\":\"admin.permission.index\",\"fid\":\"1\",\"url\":\"http:\\/\\/www.laravel-demo.com\\/admin\\/permission\\/9\",\"display_name\":\"模块管理\",\"description\":\"页面\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"2\",\"icon\":\"&#xe672\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:23:59', '2022-09-14 01:23:59', null);
INSERT INTO `sys_operationlog` VALUES ('83848', null, '1', 'admin', '编辑模块', 'admin/permission/16', 'PUT', '127.0.0.1', '{\"name\":\"admin.role.index\",\"fid\":\"1\",\"url\":\"http:\\/\\/www.laravel-demo.com\\/admin\\/permission\\/16\",\"display_name\":\"角色权限\",\"description\":\"页面\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"3\",\"icon\":\"&#xe60a\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:24:58', '2022-09-14 01:24:58', null);
INSERT INTO `sys_operationlog` VALUES ('83849', null, '1', 'admin', '编辑模块', 'admin/permission/308', 'PUT', '127.0.0.1', '{\"name\":\"admin.loginlog.index\",\"fid\":\"1\",\"url\":\"http:\\/\\/www.laravel-demo.com\\/admin\\/permission\\/308\",\"display_name\":\"登录日志\",\"description\":\"登录日志\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"6\",\"icon\":\"&#xe649\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:25:21', '2022-09-14 01:25:21', null);
INSERT INTO `sys_operationlog` VALUES ('83850', null, '1', 'admin', '编辑模块', 'admin/permission/309', 'PUT', '127.0.0.1', '{\"name\":\"admin.operationlog.index\",\"fid\":\"1\",\"url\":\"http:\\/\\/www.laravel-demo.com\\/admin\\/permission\\/309\",\"display_name\":\"操作日志\",\"description\":\"操作日志\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"7\",\"icon\":\"&#xe647\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:25:36', '2022-09-14 01:25:36', null);
INSERT INTO `sys_operationlog` VALUES ('83851', null, '1', 'admin', '编辑模块', 'admin/permission/350', 'PUT', '127.0.0.1', '{\"name\":\"admin.member.list\",\"fid\":\"23\",\"url\":\"http:\\/\\/www.laravel-demo.com\\/admin\\/permission\\/350\",\"display_name\":\"会员列表\",\"description\":\"11\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"2\",\"icon\":\"&#xe66f\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:49:35', '2022-09-14 01:49:35', null);
INSERT INTO `sys_operationlog` VALUES ('83852', null, '1', 'admin', '编辑模块', 'admin/permission/350', 'PUT', '127.0.0.1', '{\"name\":\"admin.member.list\",\"fid\":\"23\",\"url\":\"http:\\/\\/www.laravel-demo.com\\/admin\\/permission\\/350\",\"display_name\":\"会员列表\",\"description\":\"11\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"2\",\"icon\":\"&#xe66f\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:51:06', '2022-09-14 01:51:06', null);
INSERT INTO `sys_operationlog` VALUES ('83853', null, '1', 'admin', '编辑模块', 'admin/permission/350', 'PUT', '127.0.0.1', '{\"name\":\"admin.member.list\",\"fid\":\"23\",\"url\":\"http:\\/\\/www.laravel-demo.com\\/admin\\/permission\\/350\",\"display_name\":\"会员列表\",\"description\":\"11\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"2\",\"icon\":\"&#xe66f\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:51:21', '2022-09-14 01:51:21', null);
INSERT INTO `sys_operationlog` VALUES ('83854', null, '1', 'admin', '编辑模块', 'admin/permission/350', 'PUT', '127.0.0.1', '{\"name\":\"admin.member.list\",\"fid\":\"23\",\"url\":\"http:\\/\\/www.laravel-demo.com\\/admin\\/permission\\/350\",\"display_name\":\"会员列表\",\"description\":\"11\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"2\",\"icon\":\"&#xe66f\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:53:45', '2022-09-14 01:53:45', null);
INSERT INTO `sys_operationlog` VALUES ('83855', null, '1', 'admin', '编辑模块', 'admin/permission/350', 'PUT', '127.0.0.1', '{\"name\":\"admin.member.list\",\"fid\":\"23\",\"url\":\"http:\\/\\/www.laravel-demo.com\\/admin\\/permission\\/350\",\"display_name\":\"会员列表\",\"description\":\"11\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"2\",\"icon\":\"&#xe66f\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:56:30', '2022-09-14 01:56:30', null);
INSERT INTO `sys_operationlog` VALUES ('83856', null, '1', 'admin', '编辑模块', 'admin/permission/350', 'PUT', '127.0.0.1', '{\"name\":\"admin.member.list\",\"fid\":\"23\",\"url\":\"admin.member.list\",\"display_name\":\"会员列表\",\"description\":\"11\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"2\",\"icon\":\"&#xe66f\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:57:19', '2022-09-14 01:57:19', null);
INSERT INTO `sys_operationlog` VALUES ('83857', null, '1', 'admin', '编辑模块', 'admin/permission/350', 'PUT', '127.0.0.1', '{\"name\":\"admin.member.list\",\"fid\":\"23\",\"url\":\"admin.member.list\",\"display_name\":\"会员列表\",\"description\":\"11\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"2\",\"icon\":\"&#xe66f\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:57:35', '2022-09-14 01:57:35', null);
INSERT INTO `sys_operationlog` VALUES ('83858', null, '1', 'admin', '编辑模块', 'admin/permission/23', 'PUT', '127.0.0.1', '{\"name\":\"#\",\"fid\":\"0\",\"url\":null,\"display_name\":\"会员管理\",\"description\":\"11\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"1\",\"icon\":\"&#xe770\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:57:42', '2022-09-14 01:57:42', null);
INSERT INTO `sys_operationlog` VALUES ('83859', null, '1', 'admin', '编辑模块', 'admin/permission/2', 'PUT', '127.0.0.1', '{\"name\":\"admin.admin_user.index\",\"fid\":\"1\",\"url\":\"admin.admin_user.index\",\"display_name\":\"管理员管理\",\"description\":\"查看后台管理员列表\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"1\",\"icon\":\"&#xe612\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:57:59', '2022-09-14 01:57:59', null);
INSERT INTO `sys_operationlog` VALUES ('83860', null, '1', 'admin', '编辑模块', 'admin/permission/9', 'PUT', '127.0.0.1', '{\"name\":\"admin.permission.index\",\"fid\":\"1\",\"url\":\"admin.permission.index\",\"display_name\":\"模块管理\",\"description\":\"页面\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"2\",\"icon\":\"&#xe672\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:58:07', '2022-09-14 01:58:07', null);
INSERT INTO `sys_operationlog` VALUES ('83861', null, '1', 'admin', '编辑模块', 'admin/permission/16', 'PUT', '127.0.0.1', '{\"name\":\"admin.role.index\",\"fid\":\"1\",\"url\":\"admin.role.index\",\"display_name\":\"角色权限\",\"description\":\"页面\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"3\",\"icon\":\"&#xe60a\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:58:15', '2022-09-14 01:58:15', null);
INSERT INTO `sys_operationlog` VALUES ('83862', null, '1', 'admin', '编辑模块', 'admin/permission/308', 'PUT', '127.0.0.1', '{\"name\":\"admin.loginlog.index\",\"fid\":\"1\",\"url\":\"admin.loginlog.index\",\"display_name\":\"登录日志\",\"description\":\"登录日志\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"6\",\"icon\":\"&#xe649\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:58:22', '2022-09-14 01:58:22', null);
INSERT INTO `sys_operationlog` VALUES ('83863', null, '1', 'admin', '编辑模块', 'admin/permission/309', 'PUT', '127.0.0.1', '{\"name\":\"admin.operationlog.index\",\"fid\":\"1\",\"url\":\"admin.operationlog.index\",\"display_name\":\"操作日志\",\"description\":\"操作日志\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"7\",\"icon\":\"&#xe647\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:58:30', '2022-09-14 01:58:30', null);
INSERT INTO `sys_operationlog` VALUES ('83864', null, '1', 'admin', '编辑模块', 'admin/permission/23', 'PUT', '127.0.0.1', '{\"name\":\"#\",\"fid\":\"0\",\"url\":null,\"display_name\":\"产品管理\",\"description\":\"11\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"1\",\"icon\":\"&#xe770\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:58:54', '2022-09-14 01:58:54', null);
INSERT INTO `sys_operationlog` VALUES ('83865', null, '1', 'admin', '编辑模块', 'admin/permission/350', 'PUT', '127.0.0.1', '{\"name\":\"admin.product.list\",\"fid\":\"23\",\"url\":\"admin.product.list\",\"display_name\":\"产品列表\",\"description\":\"11\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"2\",\"icon\":\"&#xe66f\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:59:09', '2022-09-14 01:59:09', null);
INSERT INTO `sys_operationlog` VALUES ('83866', null, '1', 'admin', '编辑模块', 'admin/permission/350', 'PUT', '127.0.0.1', '{\"name\":\"admin.product.index\",\"fid\":\"23\",\"url\":\"admin.product.index\",\"display_name\":\"产品列表\",\"description\":\"11\",\"is_default\":\"0\",\"is_menu\":\"1\",\"sort\":\"2\",\"icon\":\"&#xe66f\",\"_method\":\"PUT\"}', 'admin.permission.update', '2022-09-14 01:59:49', '2022-09-14 01:59:49', null);
INSERT INTO `sys_operationlog` VALUES ('83867', null, '105', 'admin1', '修改密码', 'admin/admin_user/savepassword', 'POST', '127.0.0.1', '{\"password_confirmation\":\"1234567\",\"password\":\"1234567\",\"oldpassword\":\"123456\"}', 'admin.admin_user.savepassword', '2022-09-15 01:15:44', '2022-09-15 01:15:44', null);
INSERT INTO `sys_operationlog` VALUES ('83868', null, '105', 'admin1', '修改密码', 'admin/admin_user/savepassword', 'POST', '127.0.0.1', '{\"password_confirmation\":\"1234567\",\"password\":\"1234567\",\"oldpassword\":\"123456\"}', 'admin.admin_user.savepassword', '2022-09-15 01:15:48', '2022-09-15 01:15:48', null);
INSERT INTO `sys_operationlog` VALUES ('83869', null, '105', 'admin1', '修改密码', 'admin/admin_user/savepassword', 'POST', '127.0.0.1', '{\"password_confirmation\":\"1234567\",\"password\":\"1234567\",\"oldpassword\":\"123456\"}', 'admin.admin_user.savepassword', '2022-09-15 01:18:02', '2022-09-15 01:18:02', null);
INSERT INTO `sys_operationlog` VALUES ('83870', null, '105', 'admin1', '修改密码', 'admin/admin_user/savepassword', 'POST', '127.0.0.1', '{\"password_confirmation\":\"1234567\",\"password\":\"1234567\",\"oldpassword\":\"123456\"}', 'admin.admin_user.savepassword', '2022-09-15 01:19:21', '2022-09-15 01:19:21', null);
INSERT INTO `sys_operationlog` VALUES ('83871', null, '105', 'admin1', '修改密码', 'admin/admin_user/savepassword', 'POST', '127.0.0.1', '{\"password_confirmation\":\"1234567\",\"password\":\"1234567\",\"oldpassword\":\"123456\"}', 'admin.admin_user.savepassword', '2022-09-15 01:21:38', '2022-09-15 01:21:38', null);
INSERT INTO `sys_operationlog` VALUES ('83872', null, '105', 'admin1', '修改密码', 'admin/admin_user/savepassword', 'POST', '127.0.0.1', '{\"password_confirmation\":\"1234567\",\"password\":\"1234567\",\"oldpassword\":\"123456\"}', 'admin.admin_user.savepassword', '2022-09-15 01:23:59', '2022-09-15 01:23:59', null);
INSERT INTO `sys_operationlog` VALUES ('83873', null, '105', 'admin1', '修改密码', 'admin/admin_user/savepassword', 'POST', '127.0.0.1', '{\"password_confirmation\":\"1234567\",\"password\":\"1234567\",\"oldpassword\":\"123456\"}', 'admin.admin_user.savepassword', '2022-09-15 01:24:09', '2022-09-15 01:24:09', null);
INSERT INTO `sys_operationlog` VALUES ('83874', null, '105', 'admin1', '修改密码', 'admin/admin_user/savepassword', 'POST', '127.0.0.1', '{\"password_confirmation\":\"1234567\",\"password\":\"1234567\",\"oldpassword\":\"123456\"}', 'admin.admin_user.savepassword', '2022-09-15 01:24:29', '2022-09-15 01:24:29', null);
INSERT INTO `sys_operationlog` VALUES ('83875', null, '105', 'admin1', '修改密码', 'admin/admin_user/savepassword', 'POST', '127.0.0.1', '{\"password_confirmation\":\"1234567\",\"password\":\"1234567\",\"oldpassword\":\"123456\"}', 'admin.admin_user.savepassword', '2022-09-15 01:35:40', '2022-09-15 01:35:40', null);
INSERT INTO `sys_operationlog` VALUES ('83876', null, '105', 'admin1', '修改密码', 'admin/admin_user/savepassword', 'POST', '127.0.0.1', '{\"password_confirmation\":\"1234567\",\"password\":\"1234567\",\"oldpassword\":\"1234567\"}', 'admin.admin_user.savepassword', '2022-09-15 01:35:59', '2022-09-15 01:35:59', null);
INSERT INTO `sys_operationlog` VALUES ('83877', null, '105', 'admin1', '修改密码', 'admin/admin_user/savepassword', 'POST', '127.0.0.1', '{\"password_confirmation\":\"123456\",\"password\":\"123456\",\"oldpassword\":\"1234567\"}', 'admin.admin_user.savepassword', '2022-09-15 01:36:11', '2022-09-15 01:36:11', null);
INSERT INTO `sys_operationlog` VALUES ('83878', null, '105', 'admin1', '修改密码', 'admin/admin_user/savepassword', 'POST', '127.0.0.1', '{\"password_confirmation\":\"1234567\",\"password\":\"1234567\",\"oldpassword\":\"123456\"}', 'admin.admin_user.savepassword', '2022-09-15 01:36:26', '2022-09-15 01:36:26', null);
INSERT INTO `sys_operationlog` VALUES ('83879', null, '105', 'admin1', '修改密码', 'admin/admin_user/savepassword', 'POST', '127.0.0.1', '{\"password_confirmation\":\"123456\",\"password\":\"123456\",\"oldpassword\":\"1234567\"}', 'admin.admin_user.savepassword', '2022-09-15 01:42:44', '2022-09-15 01:42:44', null);

-- ----------------------------
-- Table structure for sys_permissions
-- ----------------------------
DROP TABLE IF EXISTS `sys_permissions`;
CREATE TABLE `sys_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fid` int(11) NOT NULL DEFAULT '0',
  `icon` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(1000) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '路由权限',
  `display_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_name_en` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_menu` tinyint(4) NOT NULL DEFAULT '0',
  `is_default` tinyint(4) DEFAULT '0' COMMENT '默认享有权限(0:不享有，1：享有)',
  `sort` tinyint(4) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `area_code` tinyint(4) DEFAULT NULL COMMENT '1-越城区 2-柯桥区 3-上虞区 4-新昌县 5-诸暨市 6-嵊州市 NULL-绍兴市',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=352 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='模块菜单';

-- ----------------------------
-- Records of sys_permissions
-- ----------------------------
INSERT INTO `sys_permissions` VALUES ('1', '0', '&#xe614', '#-1663118580', '', '系统设置', '系统设置', 'Systerm Setting', '1', '0', '100', '2016-02-22 00:33:03', '2022-09-14 01:23:00', null);
INSERT INTO `sys_permissions` VALUES ('2', '1', '&#xe612', 'admin.admin_user.index', 'admin.admin_user.index', '管理员管理', '查看后台管理员列表', 'Membership', '1', '0', '1', '2016-02-17 23:56:26', '2022-09-14 01:57:59', null);
INSERT INTO `sys_permissions` VALUES ('3', '2', null, 'admin.admin_user.create', 'admin.admin_user.create,admin.admin_user.store', '新增', '新增管理员', 'Add', '0', '0', '1', '2016-02-22 19:48:18', '2020-02-06 17:00:28', null);
INSERT INTO `sys_permissions` VALUES ('5', '2', null, 'admin.admin_user.destroy', 'admin.admin_user.destroy,admin.admin_user.destroy.all', '删除', '删除管理员', 'Delete', '0', '0', '5', '2016-02-22 19:49:09', '2020-05-02 14:20:29', null);
INSERT INTO `sys_permissions` VALUES ('7', '2', null, 'admin.admin_user.edit', 'admin.admin_user.edit,admin.admin_user.update', '编辑', '编辑管理员', 'Edit', '0', '0', '3', '2016-02-22 19:48:35', '2018-07-18 06:16:27', null);
INSERT INTO `sys_permissions` VALUES ('9', '1', '&#xe672', 'admin.permission.index', 'admin.permission.index', '模块管理', '页面', 'Module', '1', '0', '2', '2016-02-22 19:51:36', '2022-09-14 01:58:07', null);
INSERT INTO `sys_permissions` VALUES ('10', '9', '', 'admin.permission.create', 'admin.permission.create,admin.permission.store', '新增', '新增模块', 'Add', '0', '0', '1', '2016-02-22 19:52:16', '2016-02-22 19:52:16', null);
INSERT INTO `sys_permissions` VALUES ('12', '9', '', 'admin.permission.edit', 'admin.permission.edit,admin.permission.update', '编辑', '编辑模块', 'Edit', '0', '0', '3', '2016-02-22 19:53:29', '2016-02-22 19:53:29', null);
INSERT INTO `sys_permissions` VALUES ('14', '9', null, 'admin.permission.destroy', 'admin.permission.destroy,\r\nadmin.permission.destroy.all', '删除', '删除模块', 'Delete', '0', '0', '5', '2016-02-22 19:54:27', '2020-02-06 17:07:19', null);
INSERT INTO `sys_permissions` VALUES ('16', '1', '&#xe60a', 'admin.role.index', 'admin.role.index', '角色权限', '页面', 'Role Permission', '1', '0', '3', '2016-02-22 19:56:07', '2022-09-14 01:58:15', null);
INSERT INTO `sys_permissions` VALUES ('17', '16', '', 'admin.role.create', 'admin.role.create,admin.role.store', '新增', '新增角色', 'Add', '0', '0', '1', '2016-02-22 19:56:33', '2016-02-22 19:56:33', null);
INSERT INTO `sys_permissions` VALUES ('19', '16', '', 'admin.role.edit', 'admin.role.edit,admin.role.update', '编辑', '编辑角色', 'Edit', '0', '0', '3', '2016-02-22 19:58:25', '2016-02-22 19:58:25', null);
INSERT INTO `sys_permissions` VALUES ('21', '16', '', 'admin.role.permissions', 'admin.role.permissions', '权限设置', '', 'Permission Setting', '0', '0', '7', '2016-02-22 19:59:26', '2016-02-22 19:59:26', null);
INSERT INTO `sys_permissions` VALUES ('22', '16', null, 'admin.role.destroy', 'admin.role.destroy,admin.role.destroy.all', '删除', '删除角色', 'Delete', '0', '0', '5', '2016-02-22 19:59:49', '2020-05-02 14:28:01', null);
INSERT INTO `sys_permissions` VALUES ('23', '0', '&#xe770', '#-1663120735', '', '产品管理', '11', null, '1', '0', '1', '2022-09-13 01:59:46', '2022-09-14 01:58:55', null);
INSERT INTO `sys_permissions` VALUES ('294', '2', null, 'admin.admin_user.resetpassword', 'admin.admin_user.resetpassword,admin.admin_user.savepassword', '修改密码', '修改密码', 'Change Password', '0', '1', '7', '2019-08-26 09:42:44', '2020-02-06 17:05:10', null);
INSERT INTO `sys_permissions` VALUES ('296', '2', null, 'admin.admin_user.show', 'admin.admin_user.show', '查看个人信息', '查看个人信息', 'Member Profile', '0', '1', '9', '2019-08-26 09:46:13', '2020-02-06 17:06:28', null);
INSERT INTO `sys_permissions` VALUES ('308', '1', '&#xe649', 'admin.loginlog.index', 'admin.loginlog.index', '登录日志', '登录日志', 'Login Data', '1', '0', '6', '2020-02-04 13:48:56', '2022-09-14 01:58:22', null);
INSERT INTO `sys_permissions` VALUES ('309', '1', '&#xe647', 'admin.operationlog.index', 'admin.operationlog.index', '操作日志', '操作日志', 'Operation Data', '1', '0', '7', '2020-02-04 13:49:36', '2022-09-14 01:58:30', null);
INSERT INTO `sys_permissions` VALUES ('347', '2', null, 'admin.admin_user.disable', 'admin.admin_user.disable', '禁用', '禁用管理员', 'Forbid', '0', '0', null, '2020-05-02 14:19:25', '2020-05-02 14:19:25', null);
INSERT INTO `sys_permissions` VALUES ('348', '2', null, 'admin.admin_user.permissions', 'admin.admin_user.permissions', '展会权限', '设置展会权限', 'Fair Authority', '0', '0', null, '2020-05-02 14:25:39', '2020-05-02 14:25:39', null);
INSERT INTO `sys_permissions` VALUES ('350', '23', '&#xe66f', 'admin.product.index', 'admin.product.index', '产品列表', '11', null, '1', '0', '2', '2022-09-13 02:36:26', '2022-09-14 01:59:49', null);

-- ----------------------------
-- Table structure for sys_permission_role
-- ----------------------------
DROP TABLE IF EXISTS `sys_permission_role`;
CREATE TABLE `sys_permission_role` (
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `area_code` tinyint(4) DEFAULT NULL COMMENT '1-越城区 2-柯桥区 3-上虞区 4-新昌县 5-诸暨市 6-嵊州市 NULL-绍兴市'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='模块菜单-角色';

-- ----------------------------
-- Records of sys_permission_role
-- ----------------------------
INSERT INTO `sys_permission_role` VALUES ('294', '1', null);
INSERT INTO `sys_permission_role` VALUES ('294', '1', null);
INSERT INTO `sys_permission_role` VALUES ('296', '1', null);
INSERT INTO `sys_permission_role` VALUES ('296', '1', null);
INSERT INTO `sys_permission_role` VALUES ('1', '1', null);
INSERT INTO `sys_permission_role` VALUES ('2', '1', null);
INSERT INTO `sys_permission_role` VALUES ('347', '1', null);
INSERT INTO `sys_permission_role` VALUES ('348', '1', null);
INSERT INTO `sys_permission_role` VALUES ('3', '1', null);
INSERT INTO `sys_permission_role` VALUES ('7', '1', null);
INSERT INTO `sys_permission_role` VALUES ('5', '1', null);
INSERT INTO `sys_permission_role` VALUES ('350', '1', null);
INSERT INTO `sys_permission_role` VALUES ('23', '2', null);
INSERT INTO `sys_permission_role` VALUES ('350', '2', null);
INSERT INTO `sys_permission_role` VALUES ('294', '2', null);
INSERT INTO `sys_permission_role` VALUES ('296', '2', null);
INSERT INTO `sys_permission_role` VALUES ('23', '1', null);
INSERT INTO `sys_permission_role` VALUES ('9', '1', null);
INSERT INTO `sys_permission_role` VALUES ('10', '1', null);
INSERT INTO `sys_permission_role` VALUES ('12', '1', null);
INSERT INTO `sys_permission_role` VALUES ('14', '1', null);
INSERT INTO `sys_permission_role` VALUES ('16', '1', null);
INSERT INTO `sys_permission_role` VALUES ('17', '1', null);
INSERT INTO `sys_permission_role` VALUES ('19', '1', null);
INSERT INTO `sys_permission_role` VALUES ('22', '1', null);
INSERT INTO `sys_permission_role` VALUES ('21', '1', null);
INSERT INTO `sys_permission_role` VALUES ('308', '1', null);
INSERT INTO `sys_permission_role` VALUES ('309', '1', null);

-- ----------------------------
-- Table structure for sys_roles
-- ----------------------------
DROP TABLE IF EXISTS `sys_roles`;
CREATE TABLE `sys_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL COMMENT '企业ID',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `area_code` tinyint(4) DEFAULT NULL COMMENT '1-越城区 2-柯桥区 3-上虞区 4-新昌县 5-诸暨市 6-嵊州市 NULL-绍兴市',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `roles_name_unique` (`name`,`company_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ROW_FORMAT=DYNAMIC COMMENT='角色';

-- ----------------------------
-- Records of sys_roles
-- ----------------------------
INSERT INTO `sys_roles` VALUES ('1', '2', 'administrator', '超级系统管理员', null, '2018-07-09 06:18:56', '2019-08-26 10:01:47', null);
INSERT INTO `sys_roles` VALUES ('2', null, 'admin', '普通管理员', '管理员', '2022-09-13 05:45:02', '2022-09-13 06:07:31', null);
