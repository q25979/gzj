/*
 Navicat Premium Data Transfer

 Source Server         : 本地
 Source Server Type    : MySQL
 Source Server Version : 50553
 Source Host           : localhost:3306
 Source Schema         : gzj

 Target Server Type    : MySQL
 Target Server Version : 50553
 File Encoding         : 65001

 Date: 21/06/2019 11:46:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for tplay_admin
-- ----------------------------
DROP TABLE IF EXISTS `tplay_admin`;
CREATE TABLE `tplay_admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nickname` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '昵称',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `thumb` int(11) NOT NULL DEFAULT 1 COMMENT '管理员头像',
  `create_time` int(11) NOT NULL COMMENT '创建时间',
  `update_time` int(11) NOT NULL COMMENT '修改时间',
  `login_time` int(11) NULL DEFAULT NULL COMMENT '最后登录时间',
  `login_ip` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '最后登录ip',
  `admin_cate_id` int(2) NOT NULL DEFAULT 1 COMMENT '管理员分组',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE,
  INDEX `admin_cate_id`(`admin_cate_id`) USING BTREE,
  INDEX `nickname`(`nickname`) USING BTREE,
  INDEX `create_time`(`create_time`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tplay_admin
-- ----------------------------
INSERT INTO `tplay_admin` VALUES (1, 'Tplay', 'admin', '31c64b511d1e90fcda8519941c1bd660', 1, 1510885948, 1517622948, 1560932364, '127.0.0.1', 1);

-- ----------------------------
-- Table structure for tplay_admin_cate
-- ----------------------------
DROP TABLE IF EXISTS `tplay_admin_cate`;
CREATE TABLE `tplay_admin_cate`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `permissions` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '权限菜单',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '备注',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE,
  INDEX `name`(`name`) USING BTREE,
  INDEX `create_time`(`create_time`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tplay_admin_cate
-- ----------------------------
INSERT INTO `tplay_admin_cate` VALUES (1, '超级管理员', '51,4,5,6,7,8,11,13,14,16,17,19,20,21,26,28,29,52,54,56,34,35,37,38,39,40,42,43,44,45,47,48', 0, 1561013436, '超级管理员，拥有最高权限！');

-- ----------------------------
-- Table structure for tplay_admin_log
-- ----------------------------
DROP TABLE IF EXISTS `tplay_admin_log`;
CREATE TABLE `tplay_admin_log`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_menu_id` int(11) NOT NULL COMMENT '操作菜单id',
  `admin_id` int(11) NOT NULL COMMENT '操作者id',
  `ip` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '操作ip',
  `operation_id` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '操作关联id',
  `create_time` int(11) NOT NULL COMMENT '操作时间',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE,
  INDEX `admin_id`(`admin_id`) USING BTREE,
  INDEX `create_time`(`create_time`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 46 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tplay_admin_log
-- ----------------------------
INSERT INTO `tplay_admin_log` VALUES (1, 50, 1, '127.0.0.1', '', 1560932364);
INSERT INTO `tplay_admin_log` VALUES (2, 4, 1, '127.0.0.1', '1', 1561004760);
INSERT INTO `tplay_admin_log` VALUES (3, 4, 1, '127.0.0.1', '1', 1561009840);
INSERT INTO `tplay_admin_log` VALUES (4, 4, 1, '127.0.0.1', '2', 1561009855);
INSERT INTO `tplay_admin_log` VALUES (5, 4, 1, '127.0.0.1', '6', 1561009876);
INSERT INTO `tplay_admin_log` VALUES (6, 4, 1, '127.0.0.1', '9', 1561009906);
INSERT INTO `tplay_admin_log` VALUES (7, 4, 1, '127.0.0.1', '22', 1561009930);
INSERT INTO `tplay_admin_log` VALUES (8, 4, 1, '127.0.0.1', '52', 1561010032);
INSERT INTO `tplay_admin_log` VALUES (9, 28, 1, '127.0.0.1', '1', 1561010060);
INSERT INTO `tplay_admin_log` VALUES (10, 4, 1, '127.0.0.1', '23', 1561010114);
INSERT INTO `tplay_admin_log` VALUES (11, 4, 1, '127.0.0.1', '24', 1561010127);
INSERT INTO `tplay_admin_log` VALUES (12, 4, 1, '127.0.0.1', '30', 1561010147);
INSERT INTO `tplay_admin_log` VALUES (13, 4, 1, '127.0.0.1', '23', 1561010171);
INSERT INTO `tplay_admin_log` VALUES (14, 4, 1, '127.0.0.1', '24', 1561010184);
INSERT INTO `tplay_admin_log` VALUES (15, 4, 1, '127.0.0.1', '25', 1561010195);
INSERT INTO `tplay_admin_log` VALUES (16, 4, 1, '127.0.0.1', '30', 1561010218);
INSERT INTO `tplay_admin_log` VALUES (17, 4, 1, '127.0.0.1', '53', 1561010294);
INSERT INTO `tplay_admin_log` VALUES (18, 4, 1, '127.0.0.1', '54', 1561010395);
INSERT INTO `tplay_admin_log` VALUES (19, 4, 1, '127.0.0.1', '55', 1561010450);
INSERT INTO `tplay_admin_log` VALUES (20, 4, 1, '127.0.0.1', '55', 1561010494);
INSERT INTO `tplay_admin_log` VALUES (21, 4, 1, '127.0.0.1', '56', 1561010620);
INSERT INTO `tplay_admin_log` VALUES (22, 28, 1, '127.0.0.1', '1', 1561010645);
INSERT INTO `tplay_admin_log` VALUES (23, 4, 1, '127.0.0.1', '52', 1561010740);
INSERT INTO `tplay_admin_log` VALUES (24, 4, 1, '127.0.0.1', '53', 1561010750);
INSERT INTO `tplay_admin_log` VALUES (25, 4, 1, '127.0.0.1', '57', 1561010837);
INSERT INTO `tplay_admin_log` VALUES (26, 4, 1, '127.0.0.1', '31', 1561010865);
INSERT INTO `tplay_admin_log` VALUES (27, 4, 1, '127.0.0.1', '58', 1561011086);
INSERT INTO `tplay_admin_log` VALUES (28, 4, 1, '127.0.0.1', '59', 1561011132);
INSERT INTO `tplay_admin_log` VALUES (29, 4, 1, '127.0.0.1', '60', 1561011259);
INSERT INTO `tplay_admin_log` VALUES (30, 4, 1, '127.0.0.1', '61', 1561011273);
INSERT INTO `tplay_admin_log` VALUES (31, 4, 1, '127.0.0.1', '62', 1561011385);
INSERT INTO `tplay_admin_log` VALUES (32, 4, 1, '127.0.0.1', '63', 1561011409);
INSERT INTO `tplay_admin_log` VALUES (33, 4, 1, '127.0.0.1', '64', 1561011458);
INSERT INTO `tplay_admin_log` VALUES (34, 4, 1, '127.0.0.1', '65', 1561011480);
INSERT INTO `tplay_admin_log` VALUES (35, 4, 1, '127.0.0.1', '60', 1561011527);
INSERT INTO `tplay_admin_log` VALUES (36, 4, 1, '127.0.0.1', '61', 1561011544);
INSERT INTO `tplay_admin_log` VALUES (37, 4, 1, '127.0.0.1', '62', 1561011559);
INSERT INTO `tplay_admin_log` VALUES (38, 4, 1, '127.0.0.1', '63', 1561011570);
INSERT INTO `tplay_admin_log` VALUES (39, 4, 1, '127.0.0.1', '64', 1561011590);
INSERT INTO `tplay_admin_log` VALUES (40, 4, 1, '127.0.0.1', '65', 1561011601);
INSERT INTO `tplay_admin_log` VALUES (41, 4, 1, '127.0.0.1', '66', 1561011816);
INSERT INTO `tplay_admin_log` VALUES (42, 4, 1, '127.0.0.1', '67', 1561011866);
INSERT INTO `tplay_admin_log` VALUES (43, 28, 1, '127.0.0.1', '1', 1561013436);
INSERT INTO `tplay_admin_log` VALUES (44, 51, 1, '127.0.0.1', '', 1561013454);
INSERT INTO `tplay_admin_log` VALUES (45, 51, 1, '127.0.0.1', '', 1561013604);

-- ----------------------------
-- Table structure for tplay_admin_menu
-- ----------------------------
DROP TABLE IF EXISTS `tplay_admin_menu`;
CREATE TABLE `tplay_admin_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `module` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '模块',
  `controller` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '控制器',
  `function` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '方法',
  `parameter` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '参数',
  `description` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '描述',
  `is_display` int(1) NOT NULL DEFAULT 1 COMMENT '1显示在左侧菜单2只作为节点',
  `type` int(1) NOT NULL DEFAULT 1 COMMENT '1权限节点2普通节点',
  `pid` int(11) NOT NULL DEFAULT 0 COMMENT '上级菜单0为顶级菜单',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `icon` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '图标',
  `is_open` int(1) NOT NULL DEFAULT 0 COMMENT '0默认闭合1默认展开',
  `orders` int(11) NOT NULL DEFAULT 0 COMMENT '排序值，越小越靠前',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE,
  INDEX `module`(`module`) USING BTREE,
  INDEX `controller`(`controller`) USING BTREE,
  INDEX `function`(`function`) USING BTREE,
  INDEX `is_display`(`is_display`) USING BTREE,
  INDEX `type`(`type`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 68 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '系统菜单表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tplay_admin_menu
-- ----------------------------
INSERT INTO `tplay_admin_menu` VALUES (1, '系统设置', '', '', '', '', '系统设置。', 1, 2, 0, 0, 1561009840, 'fa-cog', 0, 1);
INSERT INTO `tplay_admin_menu` VALUES (2, '菜单管理', '', '', '', '', '菜单管理。', 1, 2, 1, 0, 1561009855, 'fa-paw', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (51, '系统菜单排序', 'admin', 'menu', 'orders', '', '系统菜单排序。', 2, 1, 3, 1517562047, 1517562047, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (3, '系统菜单', 'admin', 'menu', 'index', NULL, '系统菜单管理', 1, 2, 2, 0, 0, 'fa-share-alt', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (4, '新增/修改系统菜单', 'admin', 'menu', 'publish', '', '新增/修改系统菜单.', 2, 1, 3, 1516948769, 1516948769, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (5, '删除系统菜单', 'admin', 'menu', 'delete', '', '删除系统菜单。', 2, 1, 3, 1516948857, 1516948857, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (6, '个人资料', '', '', '', '', '个人信息管理。', 1, 1, 1, 1516949308, 1561009876, 'fa-user', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (7, '个人信息', 'admin', 'admin', 'personal', '', '个人信息修改。', 1, 1, 6, 1516949435, 1516949435, 'fa-user', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (8, '修改密码', 'admin', 'admin', 'editpassword', '', '管理员修改个人密码。', 1, 1, 6, 1516949702, 1517619887, 'fa-unlock-alt', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (9, '网站配置', '', '', '', '', '系统相关设置。', 1, 2, 1, 1516949853, 1561009906, 'fa-cog', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (10, '网站设置', 'admin', 'webconfig', 'index', '', '网站相关设置首页。', 1, 2, 9, 1516949994, 1516949994, 'fa-bullseye', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (11, '修改网站设置', 'admin', 'webconfig', 'publish', '', '修改网站设置。', 2, 1, 10, 1516950047, 1516950047, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (12, '邮件设置', 'admin', 'emailconfig', 'index', '', '邮件配置首页。', 1, 2, 9, 1516950129, 1516950129, 'fa-envelope', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (13, '修改邮件设置', 'admin', 'emailconfig', 'publish', '', '修改邮件设置。', 2, 1, 12, 1516950215, 1516950215, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (14, '发送测试邮件', 'admin', 'emailconfig', 'mailto', '', '发送测试邮件。', 2, 1, 12, 1516950295, 1516950295, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (15, '短信设置', 'admin', 'smsconfig', 'index', '', '短信设置首页。', 1, 2, 9, 1516950394, 1516950394, 'fa-comments', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (16, '修改短信设置', 'admin', 'smsconfig', 'publish', '', '修改短信设置。', 2, 1, 15, 1516950447, 1516950447, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (17, '发送测试短信', 'admin', 'smsconfig', 'smsto', '', '发送测试短信。', 2, 1, 15, 1516950483, 1516950483, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (18, 'URL 设置', 'admin', 'urlsconfig', 'index', '', 'url 设置。', 1, 2, 9, 1516950738, 1516950804, 'fa-code-fork', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (19, '新增/修改url设置', 'admin', 'urlsconfig', 'publish', '', '新增/修改url设置。', 2, 1, 18, 1516950850, 1516950850, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (20, '启用/禁用url美化', 'admin', 'urlsconfig', 'status', '', '启用/禁用url美化。', 2, 1, 18, 1516950909, 1516950909, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (21, ' 删除url美化规则', 'admin', 'urlsconfig', 'delete', '', ' 删除url美化规则。', 2, 1, 18, 1516950941, 1516950941, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (22, '会员管理', '', '', '', '', '会员管理。', 1, 2, 0, 1516950991, 1561009930, 'fa-users', 0, 2);
INSERT INTO `tplay_admin_menu` VALUES (23, '管理员', '', '', '', '', '系统管理员管理。', 1, 2, 22, 1516951071, 1561010171, 'fa-user', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (24, '管理员', 'admin', 'admin', 'index', '', '系统管理员列表。', 1, 2, 23, 1516951163, 1561010184, 'fa-user', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (25, '新增/修改管理员', 'admin', 'admin', 'publish', '', '新增/修改系统管理员。', 2, 2, 24, 1516951224, 1561010195, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (26, '删除管理员', 'admin', 'admin', 'delete', '', '删除管理员。', 2, 1, 24, 1516951253, 1516951253, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (27, '权限组', 'admin', 'admin', 'admincate', '', '权限分组。', 1, 2, 23, 1516951353, 1517018168, 'fa-dot-circle-o', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (28, '新增/修改权限组', 'admin', 'admin', 'admincatepublish', '', '新增/修改权限组。', 2, 1, 27, 1516951483, 1516951483, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (29, '删除权限组', 'admin', 'admin', 'admincatedelete', '', '删除权限组。', 2, 1, 27, 1516951515, 1516951515, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (30, '操作日志', 'admin', 'admin', 'log', '', '系统管理员操作日志。', 1, 2, 23, 1516951754, 1561010218, 'fa-pencil', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (31, '内容', '', '', '', '', '内容管理。', 1, 1, 0, 1516952262, 1561010865, 'fa-th-large', 0, 7);
INSERT INTO `tplay_admin_menu` VALUES (32, '文章', '', '', '', '', '文章相关管理。', 1, 2, 31, 1516952698, 1517015846, 'fa-bookmark', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (33, '分类', 'admin', 'articlecate', 'index', '', '文章分类管理。', 1, 2, 32, 1516952856, 1516952856, 'fa-tag', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (34, '新增/修改文章分类', 'admin', 'articlecate', 'publish', '', '新增/修改文章分类。', 2, 1, 33, 1516952896, 1516952896, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (35, '删除文章分类', 'admin', 'articlecate', 'delete', '', '删除文章分类。', 2, 1, 33, 1516952942, 1516952942, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (36, '文章', 'admin', 'article', 'index', '', '文章管理。', 1, 2, 32, 1516953011, 1516953028, 'fa-bookmark', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (37, '新增/修改文章', 'admin', 'article', 'publish', '', '新增/修改文章。', 2, 1, 36, 1516953056, 1516953056, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (38, '审核/拒绝文章', 'admin', 'article', 'status', '', '审核/拒绝文章。', 2, 1, 36, 1516953113, 1516953113, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (39, '置顶/取消置顶文章', 'admin', 'article', 'is_top', '', '置顶/取消置顶文章。', 2, 1, 36, 1516953162, 1516953162, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (40, '删除文章', 'admin', 'article', 'delete', '', '删除文章。', 2, 1, 36, 1516953183, 1516953183, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (41, '附件', 'admin', 'attachment', 'index', '', '附件管理。', 1, 2, 31, 1516953306, 1516953306, 'fa-cube', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (42, '附件审核', 'admin', 'attachment', 'audit', '', '附件审核。', 2, 1, 41, 1516953359, 1516953440, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (43, '附件上传', 'admin', 'attachment', 'upload', '', '附件上传。', 2, 1, 41, 1516953392, 1516953392, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (44, '附件下载', 'admin', 'attachment', 'download', '', '附件下载。', 2, 1, 41, 1516953430, 1516953430, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (45, '附件删除', 'admin', 'attachment', 'delete', '', '附件删除。', 2, 1, 41, 1516953477, 1516953477, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (46, '留言', 'admin', 'tomessages', 'index', '', '留言管理。', 1, 2, 31, 1516953526, 1516953526, 'fa-comments', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (47, '留言处理', 'admin', 'tomessages', 'mark', '', '留言处理。', 2, 1, 46, 1516953605, 1516953605, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (48, '留言删除', 'admin', 'tomessages', 'delete', '', '留言删除。', 2, 1, 46, 1516953648, 1516953648, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (49, '图片上传', 'admin', 'common', 'upload', '', '图片上传。', 2, 2, 0, 1516954491, 1516954491, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (50, '管理员登录', 'admin', 'common', 'login', '', '管理员登录。', 2, 2, 0, 1516954517, 1516954517, '', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (52, '用户管理', '', '', '', '', '用户信息', 1, 1, 22, 1561010032, 1561010740, 'fa-user', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (53, '用户列表', '', '', '', '', '用户列表', 1, 2, 52, 1561010294, 1561010750, 'fa-user', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (54, '登录记录', '', '', '', '', '用户登录记录', 1, 1, 52, 1561010395, 1561010395, 'fa-book', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (55, '商家管理', '', '', '', '', '商家管理', 1, 2, 22, 1561010450, 1561010494, 'fa-shopping-bag', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (56, '商家认证', '', '', '', '', '商家认证', 1, 1, 55, 1561010620, 1561010620, 'fa-address-card', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (57, '信息管理', '', '', '', '', '信息发布管理', 1, 2, 0, 1561010837, 1561010837, 'fa-book', 0, 3);
INSERT INTO `tplay_admin_menu` VALUES (58, '交易记录', '', '', '', '', '交易详细记录', 1, 2, 0, 1561011086, 1561011086, 'fa-tasks', 0, 4);
INSERT INTO `tplay_admin_menu` VALUES (59, '黑名单管理', '', '', '', '', '黑名单管理', 1, 2, 0, 1561011132, 1561011132, 'fa-lock', 0, 6);
INSERT INTO `tplay_admin_menu` VALUES (60, '商家信息', '', '', '', '', '商家信息管理', 1, 2, 57, 1561011259, 1561011527, 'fa-send', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (61, '普通信息', '', '', '', '', '', 1, 2, 57, 1561011273, 1561011544, 'fa-send', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (62, '充值记录', '', '', '', '', '', 1, 2, 58, 1561011385, 1561011559, 'fa-tasks', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (63, '消费记录', '', '', '', '', '消费记录详情', 1, 2, 58, 1561011409, 1561011570, 'fa-tasks', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (64, '黑名单列表', '', '', '', '', '黑名单列表', 1, 2, 59, 1561011458, 1561011590, 'fa-tasks', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (65, '详情记录', '', '', '', '', '黑名单详情记录', 1, 2, 59, 1561011480, 1561011601, 'fa-tasks', 0, 0);
INSERT INTO `tplay_admin_menu` VALUES (66, '数据统计', '', '', '', '', '数据统计', 1, 2, 0, 1561011816, 1561011816, 'fa-bar-chart', 0, 5);
INSERT INTO `tplay_admin_menu` VALUES (67, '数据统计', '', '', '', '', '数据统计', 1, 2, 66, 1561011866, 1561011866, 'fa-bar-chart', 0, 0);

-- ----------------------------
-- Table structure for tplay_article
-- ----------------------------
DROP TABLE IF EXISTS `tplay_article`;
CREATE TABLE `tplay_article`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tag` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `article_cate_id` int(11) NOT NULL,
  `thumb` int(11) NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `admin_id` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `edit_admin_id` int(11) NOT NULL COMMENT '最后修改人',
  `status` int(1) NOT NULL DEFAULT 0 COMMENT '0待审核1已审核',
  `is_top` int(1) NOT NULL DEFAULT 0 COMMENT '1置顶0普通',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE,
  INDEX `status`(`status`) USING BTREE,
  INDEX `is_top`(`is_top`) USING BTREE,
  INDEX `article_cate_id`(`article_cate_id`) USING BTREE,
  INDEX `admin_id`(`admin_id`) USING BTREE,
  INDEX `create_time`(`create_time`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tplay_article_cate
-- ----------------------------
DROP TABLE IF EXISTS `tplay_article_cate`;
CREATE TABLE `tplay_article_cate`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tag` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '关键词',
  `description` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tplay_attachment
-- ----------------------------
DROP TABLE IF EXISTS `tplay_attachment`;
CREATE TABLE `tplay_attachment`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `module` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '所属模块',
  `filename` char(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件名',
  `filepath` char(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件路径+文件名',
  `filesize` int(10) UNSIGNED NOT NULL DEFAULT 0 COMMENT '文件大小',
  `fileext` char(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件后缀',
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '会员ID',
  `uploadip` char(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '上传IP',
  `status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0未审核1已审核-1不通过',
  `create_time` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `admin_id` int(11) NOT NULL COMMENT '审核者id',
  `audit_time` int(11) NOT NULL COMMENT '审核时间',
  `use` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用处',
  `download` int(11) NOT NULL DEFAULT 0 COMMENT '下载量',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE,
  INDEX `status`(`status`) USING BTREE,
  INDEX `filename`(`filename`) USING BTREE,
  INDEX `create_time`(`create_time`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '附件表' ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tplay_attachment
-- ----------------------------
INSERT INTO `tplay_attachment` VALUES (1, 'admin', '79811855a6c06de53047471c4ff82a36.jpg', '\\uploads\\admin\\admin_thumb\\20180104\\79811855a6c06de53047471c4ff82a36.jpg', 13781, 'jpg', 1, '127.0.0.1', 1, 1515046060, 1, 1515046060, 'admin_thumb', 0);

-- ----------------------------
-- Table structure for tplay_emailconfig
-- ----------------------------
DROP TABLE IF EXISTS `tplay_emailconfig`;
CREATE TABLE `tplay_emailconfig`  (
  `email` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮箱配置标识',
  `from_email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮件来源也就是邮件地址',
  `from_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `smtp` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮箱smtp服务器',
  `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮箱账号',
  `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮箱密码',
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮件标题',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邮件模板',
  INDEX `email`(`email`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tplay_emailconfig
-- ----------------------------
INSERT INTO `tplay_emailconfig` VALUES ('email', '', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for tplay_messages
-- ----------------------------
DROP TABLE IF EXISTS `tplay_messages`;
CREATE TABLE `tplay_messages`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `create_time` int(11) NOT NULL,
  `ip` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `is_look` int(1) NOT NULL DEFAULT 0 COMMENT '0未读1已读',
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE,
  INDEX `is_look`(`is_look`) USING BTREE,
  INDEX `create_time`(`create_time`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tplay_smsconfig
-- ----------------------------
DROP TABLE IF EXISTS `tplay_smsconfig`;
CREATE TABLE `tplay_smsconfig`  (
  `sms` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'sms' COMMENT '标识',
  `appkey` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `secretkey` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `type` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'normal' COMMENT '短信类型',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '短信签名',
  `code` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '短信模板ID',
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '短信默认模板',
  INDEX `sms`(`sms`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tplay_smsconfig
-- ----------------------------
INSERT INTO `tplay_smsconfig` VALUES ('sms', '', '', '', '', '', '');

-- ----------------------------
-- Table structure for tplay_urlconfig
-- ----------------------------
DROP TABLE IF EXISTS `tplay_urlconfig`;
CREATE TABLE `tplay_urlconfig`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aliases` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '想要设置的别名',
  `url` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '原url结构',
  `desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '备注',
  `status` int(1) NOT NULL DEFAULT 1 COMMENT '0禁用1使用',
  `create_time` int(11) NOT NULL,
  `update_time` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id`(`id`) USING BTREE,
  INDEX `status`(`status`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tplay_urlconfig
-- ----------------------------
INSERT INTO `tplay_urlconfig` VALUES (1, 'admin_login', 'admin/common/login', '后台登录地址。', 0, 1517621629, 1517621629);

-- ----------------------------
-- Table structure for tplay_webconfig
-- ----------------------------
DROP TABLE IF EXISTS `tplay_webconfig`;
CREATE TABLE `tplay_webconfig`  (
  `web` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '网站配置标识',
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '网站名称',
  `keywords` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '关键词',
  `desc` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '描述',
  `is_log` int(1) NOT NULL DEFAULT 1 COMMENT '1开启日志0关闭',
  `file_type` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '允许上传的类型',
  `file_size` bigint(20) NULL DEFAULT NULL COMMENT '允许上传的最大值',
  `statistics` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '统计代码',
  `black_ip` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT 'ip黑名单',
  `url_suffix` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'url伪静态后缀',
  INDEX `web`(`web`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tplay_webconfig
-- ----------------------------
INSERT INTO `tplay_webconfig` VALUES ('web', 'Tplay后台管理框架', 'Tplay,后台管理,thinkphp5,layui', 'Tplay是一款基于ThinkPHP5.0.12 + layui2.2.45 + ECharts + Mysql开发的后台管理框架，集成了一般应用所必须的基础性功能，为开发者节省大量的时间。', 1, 'jpg,png,gif,mp4,zip,jpeg', 500, '', '', NULL);

SET FOREIGN_KEY_CHECKS = 1;
