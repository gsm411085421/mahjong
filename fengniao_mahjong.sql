-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-04-17 09:20:25
-- 服务器版本： 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fengniao_mahjong`
--

-- --------------------------------------------------------

--
-- 表的结构 `tp_admin`
--

CREATE TABLE `tp_admin` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `user` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '账户别称',
  `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员账户',
  `password` char(60) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '账户密码',
  `phone` char(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '电话',
  `headimg` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '管理员头像',
  `last_login_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '最后一次登录时间',
  `last_login_ip` int(10) NOT NULL COMMENT '最后登录ip',
  `login_times` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '登录次数',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_time` datetime DEFAULT NULL COMMENT '删除时间',
  `status` tinyint(1) UNSIGNED DEFAULT '1' COMMENT '是否可用'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `tp_admin`
--

INSERT INTO `tp_admin` (`id`, `user`, `name`, `password`, `phone`, `headimg`, `last_login_time`, `last_login_ip`, `login_times`, `create_at`, `delete_time`, `status`) VALUES
(1, 'admin', '超级管理员', 'b70482e5bc2ccd501a5ceff731233136', '15928907435', '/uploads/images/20170413/f8779448f1689e618b284850b2c576f0.jpg', '2017-04-13 15:18:09', 2130706433, 176, '2017-03-15 08:14:49', NULL, 1),
(3, 'admin123', '', 'b70482e5bc2ccd501a5ceff731233136', '15928907435', '/uploads/images/20170412/9a59052d14c64ec59d51d96a64db6076.jpg', '2017-04-17 09:06:14', 2130706433, 18, '2017-03-20 03:33:13', NULL, 1),
(4, 'kefu123', '', 'b70482e5bc2ccd501a5ceff731233136', '13309076146', '/uploads/images/20170411/fa8b57d69745bb41f73390ef0a63a0ad.jpg', '2017-04-17 10:55:24', 2130706433, 16, '2017-04-11 08:10:42', NULL, 1);

-- --------------------------------------------------------

--
-- 表的结构 `tp_auth_group`
--

CREATE TABLE `tp_auth_group` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `title` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '组名',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态',
  `rules` char(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_auth_group`
--

INSERT INTO `tp_auth_group` (`id`, `title`, `status`, `rules`) VALUES
(2, '管理员', 1, '2,4,5,6,7,8,9,10,11'),
(3, '客服', 1, '4,5,6,7,8,9,10');

-- --------------------------------------------------------

--
-- 表的结构 `tp_auth_group_access`
--

CREATE TABLE `tp_auth_group_access` (
  `uid` mediumint(8) UNSIGNED NOT NULL COMMENT '用户ID',
  `group_id` mediumint(8) UNSIGNED NOT NULL COMMENT '分组ID',
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_auth_group_access`
--

INSERT INTO `tp_auth_group_access` (`uid`, `group_id`, `id`) VALUES
(4, 3, 2),
(3, 2, 3);

-- --------------------------------------------------------

--
-- 表的结构 `tp_auth_rule`
--

CREATE TABLE `tp_auth_rule` (
  `id` mediumint(8) UNSIGNED NOT NULL,
  `name` char(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限规则',
  `title` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限内容',
  `type` tinyint(2) UNSIGNED NOT NULL,
  `status` tinyint(2) UNSIGNED NOT NULL,
  `pid` char(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='权限规则';

--
-- 转存表中的数据 `tp_auth_rule`
--

INSERT INTO `tp_auth_rule` (`id`, `name`, `title`, `type`, `status`, `pid`) VALUES
(2, '', '权限管理', 0, 1, '0'),
(4, '', '会员管理', 0, 1, '0'),
(5, '', '代理管理', 0, 1, '0'),
(6, '', '房间管理', 0, 1, '0'),
(7, '', '统计管理', 0, 1, '0'),
(8, '', '结算管理', 0, 1, '0'),
(9, '', '公告管理', 0, 1, '0'),
(10, '', '商城管理', 0, 1, '0'),
(11, '', '系统管理', 0, 1, '0'),
(12, 'Admin/adminLists', '管理员列表', 0, 1, '2'),
(13, 'Admin/groupLists', '用户组列表', 0, 0, '2'),
(14, 'Member/member', '会员中心', 0, 0, '4'),
(15, 'Recharge/recharge', '充值记录', 0, 0, '4'),
(16, 'Convert/withdraw', '兑换管理', 0, 0, '4'),
(17, 'Member/agency', '代理管理', 0, 0, '5'),
(18, 'Convert/withdrawAgency', '兑换记录', 0, 0, '5'),
(19, 'System/agencyDetail', '代理说明', 1, 0, '5'),
(20, 'Panda_rooms/roomList', '熊猫房间', 0, 0, '6'),
(21, 'Landlords_rooms/roomList', '斗地主房间', 1, 0, '6'),
(22, 'Statis/statisList', '同座率统计', 0, 0, '7'),
(23, 'Settlement_records/records', '结算记录', 1, 0, '8'),
(24, 'Punish_coin/punishList', '罚金记录', 0, 0, '8'),
(25, 'Disable_member/disableMemberList', '封号记录', 0, 0, '8'),
(26, 'Complains_records/records', '投诉记录', 0, 0, '8'),
(27, 'Notice/notice', '公告管理', 0, 0, '9'),
(28, 'System/rule', '平台规则', 0, 0, '9'),
(29, 'Goods/goodsManage', '商品管理', 0, 0, '10'),
(30, 'Order/order', '订单管理', 0, 0, '10'),
(31, 'System/system', '业务配置', 0, 0, '11');

-- --------------------------------------------------------

--
-- 表的结构 `tp_complains_records`
--

CREATE TABLE `tp_complains_records` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL COMMENT '会员ID',
  `complain_object_id` int(10) UNSIGNED NOT NULL COMMENT '投诉对象ID',
  `game_type_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '游戏类型内容',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '投诉时间',
  `update_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT '处理时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '处理状态0 未核实 1已核实'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='投诉记录表';

--
-- 转存表中的数据 `tp_complains_records`
--

INSERT INTO `tp_complains_records` (`id`, `member_id`, `complain_object_id`, `game_type_content`, `create_at`, `update_at`, `status`) VALUES
(1, 4, 5, '熊猫麻将作弊', '2017-03-27 01:29:18', '0000-00-00 00:00:00', 1),
(3, 4, 5, '啊发发发', '2017-03-27 01:41:23', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tp_convert`
--

CREATE TABLE `tp_convert` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `is_agency` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0普通会员 1 代理商',
  `member_id` int(10) UNSIGNED NOT NULL COMMENT '申请人ID',
  `convert_num` int(10) UNSIGNED NOT NULL COMMENT '兑换数量',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_at` datetime NOT NULL COMMENT '操作时间',
  `admin_user` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '操作管理员',
  `remark` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '处理备注信息',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '红包 0发放失败 1正常发放'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='兑换记录表';

--
-- 转存表中的数据 `tp_convert`
--

INSERT INTO `tp_convert` (`id`, `is_agency`, `member_id`, `convert_num`, `create_at`, `update_at`, `admin_user`, `remark`, `status`) VALUES
(6, 1, 100001, 1, '2017-03-15 09:16:17', '2017-03-24 16:07:00', 'admin', '请联系客服', 1),
(18, 1, 100003, 1, '2017-03-30 09:16:17', '2017-03-24 16:07:02', 'admin', '请联系客服进行重新兑换', 0),
(20, 1, 100002, 1, '2017-03-13 09:16:17', '2017-03-24 15:59:20', 'admin', '已核实', 1),
(21, 0, 100004, 1, '2017-03-03 09:16:17', '2017-03-24 16:23:36', 'admin', '已充值，已处理好hj ', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tp_disable_member`
--

CREATE TABLE `tp_disable_member` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(11) UNSIGNED NOT NULL COMMENT '会员ID',
  `remark` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '备注',
  `seal_user` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '封号管理员',
  `unlock_user` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '解封管理员',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '禁用时间',
  `update_at` datetime NOT NULL COMMENT '解封时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tp_disable_member`
--

INSERT INTO `tp_disable_member` (`id`, `member_id`, `remark`, `seal_user`, `unlock_user`, `create_at`, `update_at`) VALUES
(19, 100002, '', 'admin', 'admin', '2017-03-29 05:04:56', '2017-03-29 13:03:23'),
(20, 100001, '', 'admin', 'admin', '2017-03-29 05:05:26', '2017-03-29 13:03:42'),
(21, 100001, '', 'admin', 'admin', '2017-03-29 05:33:42', '2017-03-29 13:40:08'),
(22, 100002, '', 'admin', 'admin', '2017-03-29 05:35:05', '2017-03-29 13:34:03'),
(23, 100004, '', 'admin', 'admin', '2017-03-29 05:41:57', '2017-03-29 13:44:55'),
(24, 100003, '', 'admin', 'admin', '2017-03-29 05:41:58', '2017-03-29 13:44:47'),
(25, 100001, '', 'admin', 'admin', '2017-03-29 06:07:47', '2017-03-29 14:06:04'),
(35, 100001, '', 'admin', '', '2017-03-29 07:02:02', '0000-00-00 00:00:00'),
(42, 100001, '', 'admin', '', '2017-03-29 09:18:39', '0000-00-00 00:00:00'),
(43, 100002, '', 'admin', '', '2017-03-29 09:18:40', '0000-00-00 00:00:00'),
(44, 100003, '', 'admin', '', '2017-03-29 09:18:56', '0000-00-00 00:00:00'),
(45, 100004, '', 'admin', 'admin', '2017-03-29 09:18:57', '2017-03-31 09:18:07'),
(46, 100001, '', 'admin', '', '2017-03-29 09:35:16', '0000-00-00 00:00:00'),
(47, 100002, '', 'admin', '', '2017-03-29 09:36:07', '0000-00-00 00:00:00'),
(48, 100004, '', 'admin', '', '2017-03-29 09:37:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `tp_goods`
--

CREATE TABLE `tp_goods` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `name` char(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '商品名',
  `price` float UNSIGNED NOT NULL COMMENT '商品价格',
  `goods_num` mediumint(8) UNSIGNED NOT NULL COMMENT '商品数量',
  `goods_standard` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品规格',
  `goods_img` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品图片',
  `goods_detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '商品详情',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发布时间',
  `update_at` datetime NOT NULL COMMENT '下架时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='商城商品表';

--
-- 转存表中的数据 `tp_goods`
--

INSERT INTO `tp_goods` (`id`, `name`, `price`, `goods_num`, `goods_standard`, `goods_img`, `goods_detail`, `create_at`, `update_at`, `status`) VALUES
(30, '熊猫房卡', 30, 99953, '30', '/uploads/images/20170330/755424f01293b04809eb92cb31a00f5d.png', '熊猫房卡2', '2017-03-22 07:45:02', '2017-03-22 20:22:56', 1),
(31, '熊猫房卡', 60, 99989, '60', '/uploads/images/20170330/1e448083ed9aaf284a12ce41f75b5288.png', '熊猫房卡', '2017-03-22 07:45:29', '2017-03-23 14:41:20', 1),
(36, '熊猫房卡', 120, 99989, '120', '/uploads/images/20170330/7c8c7b34b2b30a6f5e98fe6897737a77.png', '这个宝贝注定热销', '2017-03-23 08:45:01', '0000-00-00 00:00:00', 1),
(38, '熊猫房卡', 250, 99998, '250', '/uploads/images/20170330/db3f7ff6f1c3e3ba9953ef86d418b755.png', '周五了可是没有周末啊', '2017-03-24 02:29:27', '2017-03-24 10:28:40', 1),
(39, '英雄联盟皮肤', 120, 99999, '30', '/uploads/images/20170330/f338d30136187339a9e05be36b3c59d6.png', '哈哈嘻嘻', '2017-03-24 02:35:29', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tp_landlords_rooms`
--

CREATE TABLE `tp_landlords_rooms` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `room_member_id` int(11) NOT NULL DEFAULT '0' COMMENT '房间创建者ID',
  `type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '斗地主类型1癞子  2三人  3四人',
  `booms` tinyint(1) NOT NULL DEFAULT '0' COMMENT '选择癞子后炸弹上限  3三炸 4四炸 5五炸',
  `times` tinyint(1) NOT NULL DEFAULT '0' COMMENT '选择3人或者4人斗地主后番数  3三番 4四番 5五番',
  `record_way` tinyint(1) NOT NULL DEFAULT '0' COMMENT '计分方式 仅 四人 有效，1-加底 2-滚番',
  `has_pi` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否带皮子 仅三人有效 1-带 2-不带',
  `room_num` char(8) NOT NULL DEFAULT '' COMMENT '房间号',
  `low_times` tinyint(4) UNSIGNED NOT NULL DEFAULT '0' COMMENT '房间底分',
  `member_id1` int(11) NOT NULL DEFAULT '0' COMMENT '会员1ID',
  `member_id2` int(11) NOT NULL DEFAULT '0' COMMENT '会员2ID',
  `member_id3` int(11) NOT NULL DEFAULT '0' COMMENT '会员3ID',
  `update_at` datetime DEFAULT NULL COMMENT '创建时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '房间开启状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='斗地主房间表';

--
-- 转存表中的数据 `tp_landlords_rooms`
--

INSERT INTO `tp_landlords_rooms` (`id`, `room_member_id`, `type`, `booms`, `times`, `record_way`, `has_pi`, `room_num`, `low_times`, `member_id1`, `member_id2`, `member_id3`, `update_at`, `status`) VALUES
(1, 100002, 1, 5, 0, 0, 0, '124521', 1, 100002, 100004, 0, '2017-04-07 14:43:54', 1),
(2, 100003, 2, 0, 5, 0, 1, '123456', 1, 0, 0, 0, '2017-04-07 10:12:15', 1),
(3, 100002, 3, 0, 5, 2, 0, '123456', 1, 100001, 100002, 100004, '2017-04-07 10:13:00', 1),
(4, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-07 10:09:46', 0),
(5, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-07 10:09:43', 0),
(6, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-07 10:09:40', 0),
(7, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-07 10:09:37', 0),
(8, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-07 10:09:33', 0),
(9, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-07 10:09:23', 0),
(10, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-07 10:09:27', 0),
(11, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-07 10:09:30', 0),
(12, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(13, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(14, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(15, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(16, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(17, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(18, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(19, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(20, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(21, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(22, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(23, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(24, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(25, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(26, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(27, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(28, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(29, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(30, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(31, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(32, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(33, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(34, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(35, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(36, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(37, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(38, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(39, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(40, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(41, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(42, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(43, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(44, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(45, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(46, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(47, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(48, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(49, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(50, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(51, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(52, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(53, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(54, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(55, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(56, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(57, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(58, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(59, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(60, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(61, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(62, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(63, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(64, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(65, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(66, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(67, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(68, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(69, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(70, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(71, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(72, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(73, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(74, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(75, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(76, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(77, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(78, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(79, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(80, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(81, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(82, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(83, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(84, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(85, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(86, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(87, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(88, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(89, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(90, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(91, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(92, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(93, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(94, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(95, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(96, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(97, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(98, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(99, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0),
(100, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 11:15:09', 0);

-- --------------------------------------------------------

--
-- 表的结构 `tp_member`
--

CREATE TABLE `tp_member` (
  `id` int(10) UNSIGNED NOT NULL,
  `openid` char(28) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '用户微信openid',
  `nickname` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '用户昵称',
  `head_img` varchar(48) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '会员微信头像',
  `sycee_num` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '剩余元宝数量',
  `coin_num` int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '剩余金币数量',
  `pid` int(8) UNSIGNED DEFAULT '0' COMMENT '上级id',
  `level` tinyint(1) UNSIGNED DEFAULT '0' COMMENT '1 一级 2 二级 3 三级',
  `is_rank` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '0 普通会员 1 代理商',
  `login_ip` int(11) UNSIGNED NOT NULL COMMENT '用户登录ip',
  `count` smallint(8) UNSIGNED NOT NULL DEFAULT '0' COMMENT '玩牌局数',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_at` datetime NOT NULL COMMENT '上次登录时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员表';

--
-- 转存表中的数据 `tp_member`
--

INSERT INTO `tp_member` (`id`, `openid`, `nickname`, `head_img`, `sycee_num`, `coin_num`, `pid`, `level`, `is_rank`, `login_ip`, `count`, `create_at`, `update_at`, `status`) VALUES
(100001, 'yhkjs_456456asdkjhjh_dfsd5SD', 'EchoUp', '/data/avatar/3.png', 1, 1999, 0, 0, 1, 25487945, 8, '2017-03-16 01:10:32', '0000-00-00 00:00:00', 1),
(100002, 'hghkjkljlk_hghjfghg23132_jkl', 'Hank', '/data/avatar/100002.png', 940, 4001, 100001, 1, 1, 2564545, 0, '2017-03-13 01:17:17', '0000-00-00 00:00:00', 1),
(100003, 'hghkjkljlk_hghjfghg23132_jss', 'HankCFT', '/data/avatar/2.png', 12, 1000, 100002, 2, 1, 2564545, 0, '2017-03-13 01:17:17', '0000-00-00 00:00:00', 0),
(100004, 'hghkjkljlk_hghjfghasdasasaaa', 'EchoUpDay', '/data/avatar/100004.png', 9, 5000, 100003, 3, 0, 2564545, 0, '2017-03-13 01:17:17', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tp_member_profile`
--

CREATE TABLE `tp_member_profile` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL COMMENT '会员ID',
  `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '会员真实姓名',
  `phone` char(11) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '会员电话号码',
  `id_cards` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '会员身份证号',
  `wechat` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '会员微信号',
  `bank_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '开户银行',
  `bank_account` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '银行账号',
  `qq` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'QQ号',
  `email` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '电子邮箱',
  `alipay` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '支付宝号',
  `self_intro` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '自我介绍',
  `other_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '其他说明',
  `panda_id` char(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '熊猫麻将ID',
  `landlords_id` char(8) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '斗地主ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='会员个人信息表';

--
-- 转存表中的数据 `tp_member_profile`
--

INSERT INTO `tp_member_profile` (`id`, `member_id`, `name`, `phone`, `id_cards`, `wechat`, `bank_name`, `bank_account`, `qq`, `email`, `alipay`, `self_intro`, `other_desc`, `panda_id`, `landlords_id`) VALUES
(1, 100001, '闫豪', '15928907435', '410825199308127539', 'yanhao', '中国工商银行', '20172017501720172017', '267991151', 'yanhao2016@qq.com', 'yanhao2016@qq.com', 'Php搬砖工', '小菜鸟', '520', '521'),
(2, 100002, '张豪', '13458304308', '410825199308127539', 'yanhao324818', '工商银行', '5215215215215215211', '4110852421', 'yanhao2016@qq.com', 'yanhao2016@qq', 'PHP搬运工', '小菜鸟', '52221', '520'),
(3, 100003, '管少敏', '13309076146', '4687163464646', 'akgfa5555', '中国农业银行', '464676164646', '4646466', '411085421@qq.com', '54546464646', '没什么介绍的', 'afa', '461', '7897'),
(4, 100004, '5565', '15928907435', '410825199308127539', 'zhenshi', '上搞事公司公司', '54631646', '267992250', '2679911521@qq.com', '6796634613', '啊发发发', '啊发发', '8888888', '4444144');

-- --------------------------------------------------------

--
-- 表的结构 `tp_menu`
--

CREATE TABLE `tp_menu` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父级ID',
  `name` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `rule_id` int(11) DEFAULT '0' COMMENT '权限规则ID tp_auth_rule.id 一级菜单为0',
  `sort` smallint(4) NOT NULL DEFAULT '100' COMMENT '排序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='菜单设置';

--
-- 转存表中的数据 `tp_menu`
--

INSERT INTO `tp_menu` (`id`, `pid`, `name`, `rule_id`, `sort`) VALUES
(1, 0, '首页', 0, 100),
(2, 0, '权限管理', 4, 100),
(3, 0, '会员管理', 0, 1),
(4, 0, '代理管理', 1, 100),
(5, 0, '房间管理', 2, 100),
(6, 0, '统计管理', 3, 100),
(7, 0, '结算管理', 0, 2),
(8, 0, '公告管理', 0, 3),
(10, 0, '商城管理', 0, 4),
(11, 0, '系统配置', 0, 5),
(12, 2, '管理员列表', 0, 0),
(13, 12, '用户组列表', 0, 7),
(14, 3, '会员中心', 0, 8),
(15, 14, '充值记录', 0, 9),
(16, 3, '兑换记录', 28, 100),
(17, 4, '代理中心', 31, 100),
(18, 17, '兑换记录', 30, 100),
(19, 4, '代理说明', 32, 100),
(20, 5, '熊猫房间', 33, 100),
(21, 5, '斗地主房间', 0, 100),
(22, 20, '同座统计', 0, 100),
(23, 7, '结算记录', 0, 100),
(24, 22, '罚金记录', 0, 100),
(25, 7, '封号记录', 0, 100),
(26, 22, '投诉记录', 0, 100),
(27, 8, '公告管理', 0, 100),
(28, 8, '平台规则', 0, 100),
(29, 10, '商品管理', 0, 100),
(30, 10, '订单管理', 0, 100),
(31, 11, '业务配置', 0, 100);

-- --------------------------------------------------------

--
-- 表的结构 `tp_notice`
--

CREATE TABLE `tp_notice` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `admin_user` varchar(15) NOT NULL COMMENT '发布人',
  `title` varchar(10) NOT NULL COMMENT '公告标题',
  `content` text NOT NULL COMMENT '公告内容',
  `type` tinyint(1) UNSIGNED NOT NULL COMMENT '0:系统公告 1:活动公告 2:即时公告',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '发布时间',
  `update_at` datetime NOT NULL COMMENT '修改时间',
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '0' COMMENT '公告状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='系统公告';

--
-- 转存表中的数据 `tp_notice`
--

INSERT INTO `tp_notice` (`id`, `admin_user`, `title`, `content`, `type`, `create_at`, `update_at`, `status`) VALUES
(101, 'admin', '特别通知啊', '即时公告2', 2, '2017-03-30 02:26:11', '2017-04-05 10:08:27', 1),
(106, 'admin', '新通知', '即时公告3', 2, '2017-03-30 02:25:53', '2017-04-05 10:08:39', 1),
(112, 'admin', '第三条通知', '<p>游戏纠纷请截图，私发客服微信处理</p>', 0, '2017-03-30 02:30:41', '2017-03-30 14:13:09', 0),
(119, 'admin', '今天是3月24日', '即时公告1', 2, '2017-03-30 02:25:36', '2017-04-05 10:08:59', 1),
(121, 'admin', '你妹的', '<p>即将开发功能，元宝功能，商城功能，鱼乐分</p>', 0, '2017-03-30 02:29:26', '2017-03-30 14:13:10', 0),
(122, 'admin', '今天周五注意啦', '<p>官方微信客服yulepipei01，VRZN2016，162305380，玩家务必加一个微信</p>', 0, '2017-03-30 02:28:41', '2017-03-30 14:13:11', 0),
(123, 'admin', '第三条通知啊啊啊', '<p>代理咨询请加VRZN2016</p>', 0, '2017-03-30 02:27:26', '2017-03-30 14:13:20', 0),
(126, 'admin', '系统公告', '<p>1 官方微信客服 HankCFT，echoup,fengniao,玩家务必加一个微信</p><p>2 代理咨询请假Hank</p><p>3游戏纠纷请截图，私发客服微信处理</p><p>4目前平台开放功能：排行榜（日榜，周榜，月榜，奖金高达1000金币），大厅聊天功能</p><p>5即将开放功能。元宝功能，商城功能，鱼乐分（诚信系统）</p><p>(特别提示玩家请认真阅读首页规则？)</p>', 0, '2017-03-30 06:10:18', '2017-03-30 14:11:49', 1),
(127, 'admin', '系统公告', '<p><br/></p><p>1 官方微信客服 HankCFT，echoup,fengniao,玩家务必加一个微信</p><p>2 代理咨询请假Hank</p><p>3游戏纠纷请截图，私发客服微信处理</p><p>4目前平台开放功能：排行榜（日榜，周榜，月榜，奖金高达1000金币），大厅聊天功能</p><p>5即将开放功能。元宝功能，商城功能，鱼乐分（诚信系统）</p><p>(特别提示玩家请认真阅读首页规则？)</p>', 0, '2017-03-30 06:26:52', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- 表的结构 `tp_order`
--

CREATE TABLE `tp_order` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL COMMENT '会员ID',
  `goods_id` smallint(6) UNSIGNED NOT NULL COMMENT '商品ID',
  `order_num` char(18) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '订单编号',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '订单创建时间',
  `update_at` datetime NOT NULL COMMENT '处理时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '处理状态 0 未处理 1已处理'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='订单表';

--
-- 转存表中的数据 `tp_order`
--

INSERT INTO `tp_order` (`id`, `member_id`, `goods_id`, `order_num`, `create_at`, `update_at`, `status`) VALUES
(15, 100002, 30, '201704011035203922', '2017-04-01 02:37:41', '0000-00-00 00:00:00', 0),
(16, 100002, 31, '201704011804041578', '2017-04-01 10:05:50', '0000-00-00 00:00:00', 0),
(17, 100002, 30, '201704011804078747', '2017-04-01 10:05:53', '0000-00-00 00:00:00', 0),
(18, 100002, 30, '201704061531037546', '2017-04-06 07:33:52', '0000-00-00 00:00:00', 0),
(19, 100002, 30, '201704061531584242', '2017-04-06 07:34:22', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- 表的结构 `tp_panda_rooms`
--

CREATE TABLE `tp_panda_rooms` (
  `id` int(11) NOT NULL,
  `room_member_id` int(11) NOT NULL DEFAULT '0' COMMENT '房间创建者ID',
  `type1` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 血战到底  2三人两房',
  `type2` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 自摸加底 2自摸加翻',
  `type3` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1 点杠花（点炮） 2 点杠花（自摸）',
  `type4` tinyint(1) NOT NULL DEFAULT '0' COMMENT '带幺九、将对     0未选择  1选择',
  `type5` tinyint(1) NOT NULL DEFAULT '0' COMMENT '换三张  0未开启  1开启',
  `type6` tinyint(1) NOT NULL DEFAULT '0' COMMENT '门清中张 0未开启  1开启',
  `type7` tinyint(1) NOT NULL DEFAULT '0' COMMENT '天地糊  0未选择  1选择',
  `room_num` char(8) NOT NULL DEFAULT '' COMMENT '房间号',
  `low_times` int(10) UNSIGNED NOT NULL COMMENT '底分倍数 100 200 500 1000',
  `member_id1` int(11) NOT NULL COMMENT '会员1ID',
  `member_id2` int(11) NOT NULL COMMENT '会员2ID',
  `member_id3` int(11) NOT NULL COMMENT '会员3ID',
  `update_at` datetime DEFAULT NULL COMMENT '创建时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='熊猫麻将房间表';

--
-- 转存表中的数据 `tp_panda_rooms`
--

INSERT INTO `tp_panda_rooms` (`id`, `room_member_id`, `type1`, `type2`, `type3`, `type4`, `type5`, `type6`, `type7`, `room_num`, `low_times`, `member_id1`, `member_id2`, `member_id3`, `update_at`, `status`) VALUES
(1, 100001, 2, 2, 2, 1, 1, 1, 1, '123456', 2, 100004, 0, 0, '2017-04-07 14:02:45', 1),
(2, 100002, 2, 2, 2, 1, 1, 1, 1, '123456', 2, 0, 0, 0, '2017-04-07 13:56:22', 1),
(3, 100001, 2, 2, 2, 1, 1, 1, 0, '521125', 2, 0, 0, 0, '2017-04-06 15:04:07', 1),
(4, 100001, 2, 1, 1, 0, 0, 0, 0, '123456', 1, 0, 0, 0, '2017-04-06 15:06:51', 1),
(5, 100002, 2, 2, 2, 1, 1, 1, 1, '521125', 1, 0, 0, 0, '2017-04-07 14:01:16', 1),
(6, 100004, 2, 2, 2, 1, 1, 1, 1, '521125', 1, 0, 0, 0, '2017-04-06 15:14:12', 1),
(7, 100002, 2, 2, 2, 0, 1, 0, 1, '521414', 2, 0, 0, 0, '2017-04-06 17:49:17', 1),
(8, 100004, 1, 1, 1, 1, 1, 1, 1, '521414', 2, 0, 0, 0, '2017-04-06 17:52:12', 1),
(9, 100001, 1, 1, 1, 0, 0, 0, 0, '123456', 1, 0, 0, 0, '2017-04-06 18:17:57', 1),
(10, 100001, 1, 1, 1, 0, 0, 0, 0, '123456', 1, 0, 0, 0, '2017-04-06 18:19:08', 1),
(11, 100003, 1, 1, 1, 0, 0, 0, 0, '123456', 1, 0, 0, 0, '2017-04-06 18:19:23', 1),
(12, 100001, 2, 1, 1, 0, 0, 0, 0, '123456', 1, 0, 0, 0, '2017-04-07 09:21:45', 1),
(13, 100003, 1, 1, 1, 0, 0, 0, 0, '123123', 1, 0, 0, 0, '2017-04-07 09:27:46', 1),
(14, 100003, 1, 1, 1, 0, 0, 0, 0, '123456', 1, 0, 0, 0, '2017-04-07 09:28:06', 1),
(15, 100002, 1, 1, 1, 0, 0, 0, 0, '123456', 1, 0, 0, 0, '2017-04-07 09:36:07', 1),
(16, 100004, 2, 1, 1, 1, 0, 0, 0, '123434', 1, 0, 0, 0, '2017-04-07 09:41:53', 1),
(17, 100004, 1, 1, 1, 0, 0, 0, 0, '123456', 1, 0, 0, 0, '2017-04-07 09:43:34', 1),
(18, 100004, 2, 2, 2, 0, 1, 0, 1, '123456', 1, 0, 0, 0, '2017-04-07 09:58:35', 1),
(19, 100004, 1, 1, 1, 0, 0, 0, 0, '123456', 1, 0, 0, 0, '2017-04-07 10:49:44', 1),
(20, 100004, 1, 1, 1, 0, 0, 0, 0, '123456', 1, 0, 0, 0, '2017-04-07 11:01:52', 1),
(21, 100002, 1, 1, 1, 0, 0, 0, 0, '123456', 1, 0, 0, 0, '2017-04-07 13:43:22', 1),
(22, 100001, 1, 1, 1, 0, 0, 0, 0, '123456', 1, 0, 0, 0, '2017-04-07 13:46:36', 1),
(23, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:21:59', 0),
(24, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:22:07', 0),
(25, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:22:10', 0),
(26, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:23:05', 0),
(27, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:23:09', 0),
(28, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:23:12', 0),
(29, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:23:16', 0),
(30, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:23:19', 0),
(31, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:23:23', 0),
(32, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:19:19', 0),
(33, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:19:16', 0),
(34, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:19:13', 0),
(35, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:19:09', 0),
(36, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:19:06', 0),
(37, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:19:02', 0),
(38, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:18:56', 0),
(39, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:18:59', 0),
(40, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:18:52', 0),
(41, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:18:42', 0),
(42, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:18:46', 0),
(43, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:18:38', 0),
(44, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:18:35', 0),
(45, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:18:27', 0),
(46, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:18:30', 0),
(47, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-04-06 14:23:26', 0),
(48, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(49, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(50, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(51, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(52, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(53, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(54, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(55, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(56, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(57, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(58, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(59, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(60, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(61, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(62, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(63, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(64, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(65, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(66, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(67, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(68, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(69, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(70, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(71, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(72, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(73, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(74, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(75, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(76, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(77, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(78, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(79, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(80, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(81, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(82, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(83, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(84, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(85, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(86, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(87, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(88, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(89, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(90, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(91, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(92, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(93, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(94, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(95, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(96, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(97, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(98, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(99, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0),
(100, 0, 0, 0, 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '2017-03-30 12:37:10', 0);

-- --------------------------------------------------------

--
-- 表的结构 `tp_punish_coin`
--

CREATE TABLE `tp_punish_coin` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL COMMENT '会员ID',
  `punish_coin` int(10) UNSIGNED NOT NULL COMMENT '处罚金币数量',
  `admin_user` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '处理人',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='罚金记录表';

--
-- 转存表中的数据 `tp_punish_coin`
--

INSERT INTO `tp_punish_coin` (`id`, `member_id`, `punish_coin`, `admin_user`, `create_at`) VALUES
(1, 100001, 50, 'admin', '2017-03-28 07:26:49'),
(2, 100001, 10, 'admin', '2017-03-28 09:53:48'),
(3, 100001, 152, 'admin', '2017-03-28 09:54:16'),
(4, 100002, 100, 'admin', '2017-03-29 01:31:32'),
(5, 100002, 580, 'admin', '2017-03-29 01:40:59'),
(6, 100003, 550, 'admin', '2017-03-29 01:44:31'),
(7, 100002, 1, 'admin', '2017-03-29 03:05:59'),
(8, 100001, 1, 'admin', '2017-03-29 03:06:38'),
(9, 100001, 1, 'admin', '2017-03-29 03:22:56'),
(10, 100001, 12, 'admin', '2017-03-29 05:12:08'),
(11, 100001, 2, 'admin', '2017-03-29 08:15:51'),
(12, 100001, 4, 'admin', '2017-04-06 01:43:06'),
(13, 100001, 4, 'admin', '2017-04-06 01:43:07'),
(14, 100001, 3, 'admin', '2017-04-06 02:47:31'),
(15, 100002, 999, 'admin', '2017-04-06 08:00:35');

-- --------------------------------------------------------

--
-- 表的结构 `tp_recharge`
--

CREATE TABLE `tp_recharge` (
  `id` int(10) UNSIGNED NOT NULL,
  `member_id` int(10) UNSIGNED NOT NULL COMMENT '会员ID',
  `recharge_num` int(10) UNSIGNED NOT NULL COMMENT '充值数量',
  `admin_user` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作人',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '充值时间',
  `status` tinyint(1) UNSIGNED NOT NULL DEFAULT '1' COMMENT '状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='充值记录表';

--
-- 转存表中的数据 `tp_recharge`
--

INSERT INTO `tp_recharge` (`id`, `member_id`, `recharge_num`, `admin_user`, `create_at`, `status`) VALUES
(0, 100003, 50, 'admin', '2017-03-29 06:36:43', 1),
(15, 100001, 50, 'admin', '2017-03-27 09:59:25', 1),
(16, 100001, 85, 'admin', '2017-03-27 10:13:22', 1),
(17, 100001, 400, 'admin', '2017-03-29 03:08:45', 1),
(100011, 100001, 1, 'admin', '2017-03-29 02:45:56', 1),
(100012, 100002, 1000, 'admin', '2017-03-29 03:05:47', 1),
(100013, 100001, 875, 'admin', '2017-03-29 03:08:55', 1),
(100014, 100002, 888, 'admin', '2017-03-29 03:09:06', 1),
(100015, 100001, 1, 'admin', '2017-03-29 03:23:00', 1),
(100016, 100001, 2, 'admin', '2017-03-29 08:14:31', 1),
(100017, 100001, 22, 'admin', '2017-03-29 09:40:01', 1),
(100018, 100001, 33, 'admin', '2017-03-29 09:40:13', 1),
(100021, 100001, 5, 'admin', '2017-04-06 03:02:16', 1),
(100022, 100001, 2, 'admin', '2017-04-06 03:06:17', 1),
(100023, 100001, 999, 'admin', '2017-04-06 08:00:27', 1);

-- --------------------------------------------------------

--
-- 表的结构 `tp_room`
--

CREATE TABLE `tp_room` (
  `id` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `tp_room`
--

INSERT INTO `tp_room` (`id`, `pid`, `name`) VALUES
(1, 0, '北京28'),
(2, 0, '新加坡28'),
(3, 1, '北京28-1'),
(4, 1, '北京28-2'),
(5, 2, '新加坡28-1'),
(6, 2, '新加坡28-2');

-- --------------------------------------------------------

--
-- 表的结构 `tp_settlement`
--

CREATE TABLE `tp_settlement` (
  `id` int(10) UNSIGNED NOT NULL,
  `type` tinyint(1) UNSIGNED NOT NULL COMMENT '1:游戏消耗  2:游戏结算 3:兑换 4:管理员操作',
  `member_id` int(10) UNSIGNED NOT NULL COMMENT '用户ID',
  `game_type_content` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '游戏类型内容',
  `money` int(10) NOT NULL COMMENT '金币额度',
  `coin_num` int(10) UNSIGNED NOT NULL COMMENT '剩余金币',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '完成时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='会员金币流水表';

--
-- 转存表中的数据 `tp_settlement`
--

INSERT INTO `tp_settlement` (`id`, `type`, `member_id`, `game_type_content`, `money`, `coin_num`, `create_at`) VALUES
(1, 2, 100004, '熊猫麻将', 11, 0, '2017-03-27 02:06:09'),
(3, 2, 100002, '熊猫麻将', 2, 0, '2017-03-27 02:06:28'),
(5, 1, 100004, '熊猫麻将', 2, 1, '2017-03-30 06:36:13');

-- --------------------------------------------------------

--
-- 表的结构 `tp_settlement_records`
--

CREATE TABLE `tp_settlement_records` (
  `id` smallint(6) UNSIGNED NOT NULL,
  `member_id1` int(10) UNSIGNED NOT NULL COMMENT '此桌用户1ID',
  `mi1_money` int(11) NOT NULL COMMENT '此桌用户1所得金币',
  `member_id2` int(10) UNSIGNED NOT NULL COMMENT '此桌用户2ID',
  `mi2_money` int(11) NOT NULL COMMENT '此桌用户2所得金币',
  `member_id3` int(10) UNSIGNED NOT NULL COMMENT '此桌用户3ID',
  `mi3_money` int(11) NOT NULL COMMENT '此桌用户3所得金币',
  `member_id4` int(10) UNSIGNED NOT NULL COMMENT '此桌用户4ID',
  `mi4_money` int(11) NOT NULL COMMENT '此桌用户4所得金币',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '计算时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '结算状态 1正常结算 2未结算'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='结算记录表';

--
-- 转存表中的数据 `tp_settlement_records`
--

INSERT INTO `tp_settlement_records` (`id`, `member_id1`, `mi1_money`, `member_id2`, `mi2_money`, `member_id3`, `mi3_money`, `member_id4`, `mi4_money`, `create_at`, `status`) VALUES
(2, 100001, -2000, 100002, 2000, 100003, -2000, 100004, 2000, '2017-03-24 05:47:43', 2),
(4, 100002, 2, 100001, -2, 100004, 2, 100003, -2, '2017-03-27 01:41:00', 2);

-- --------------------------------------------------------

--
-- 表的结构 `tp_statis`
--

CREATE TABLE `tp_statis` (
  `id` int(11) UNSIGNED NOT NULL,
  `uid1` int(8) UNSIGNED NOT NULL COMMENT '用户一ID',
  `uid2` int(8) UNSIGNED NOT NULL COMMENT '用户二ID',
  `count` smallint(6) UNSIGNED NOT NULL DEFAULT '0' COMMENT '次数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='同坐率统计表';

--
-- 转存表中的数据 `tp_statis`
--

INSERT INTO `tp_statis` (`id`, `uid1`, `uid2`, `count`) VALUES
(1, 100001, 100002, 4),
(2, 100003, 100004, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tp_admin`
--
ALTER TABLE `tp_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_auth_group`
--
ALTER TABLE `tp_auth_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_auth_group_access`
--
ALTER TABLE `tp_auth_group_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_auth_rule`
--
ALTER TABLE `tp_auth_rule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_complains_records`
--
ALTER TABLE `tp_complains_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_convert`
--
ALTER TABLE `tp_convert`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_disable_member`
--
ALTER TABLE `tp_disable_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_goods`
--
ALTER TABLE `tp_goods`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_landlords_rooms`
--
ALTER TABLE `tp_landlords_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tp_member`
--
ALTER TABLE `tp_member`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_member_profile`
--
ALTER TABLE `tp_member_profile`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `member_id` (`member_id`);

--
-- Indexes for table `tp_menu`
--
ALTER TABLE `tp_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_notice`
--
ALTER TABLE `tp_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_order`
--
ALTER TABLE `tp_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_panda_rooms`
--
ALTER TABLE `tp_panda_rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `tp_punish_coin`
--
ALTER TABLE `tp_punish_coin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_recharge`
--
ALTER TABLE `tp_recharge`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_room`
--
ALTER TABLE `tp_room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_settlement`
--
ALTER TABLE `tp_settlement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_settlement_records`
--
ALTER TABLE `tp_settlement_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tp_statis`
--
ALTER TABLE `tp_statis`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `tp_admin`
--
ALTER TABLE `tp_admin`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `tp_auth_group`
--
ALTER TABLE `tp_auth_group`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `tp_auth_group_access`
--
ALTER TABLE `tp_auth_group_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `tp_auth_rule`
--
ALTER TABLE `tp_auth_rule`
  MODIFY `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- 使用表AUTO_INCREMENT `tp_complains_records`
--
ALTER TABLE `tp_complains_records`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `tp_convert`
--
ALTER TABLE `tp_convert`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- 使用表AUTO_INCREMENT `tp_disable_member`
--
ALTER TABLE `tp_disable_member`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
--
-- 使用表AUTO_INCREMENT `tp_goods`
--
ALTER TABLE `tp_goods`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- 使用表AUTO_INCREMENT `tp_landlords_rooms`
--
ALTER TABLE `tp_landlords_rooms`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- 使用表AUTO_INCREMENT `tp_member`
--
ALTER TABLE `tp_member`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100005;
--
-- 使用表AUTO_INCREMENT `tp_member_profile`
--
ALTER TABLE `tp_member_profile`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `tp_menu`
--
ALTER TABLE `tp_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- 使用表AUTO_INCREMENT `tp_notice`
--
ALTER TABLE `tp_notice`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- 使用表AUTO_INCREMENT `tp_order`
--
ALTER TABLE `tp_order`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- 使用表AUTO_INCREMENT `tp_panda_rooms`
--
ALTER TABLE `tp_panda_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- 使用表AUTO_INCREMENT `tp_punish_coin`
--
ALTER TABLE `tp_punish_coin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- 使用表AUTO_INCREMENT `tp_recharge`
--
ALTER TABLE `tp_recharge`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100024;
--
-- 使用表AUTO_INCREMENT `tp_room`
--
ALTER TABLE `tp_room`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `tp_settlement`
--
ALTER TABLE `tp_settlement`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `tp_settlement_records`
--
ALTER TABLE `tp_settlement_records`
  MODIFY `id` smallint(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `tp_statis`
--
ALTER TABLE `tp_statis`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
