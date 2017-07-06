/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50553
Source Host           : localhost:3306
Source Database       : zshp2p

Target Server Type    : MYSQL
Target Server Version : 50553
File Encoding         : 65001

Date: 2017-07-04 15:15:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for z_activity
-- ----------------------------
DROP TABLE IF EXISTS `z_activity`;
CREATE TABLE `z_activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `activity_name` varchar(80) NOT NULL DEFAULT '' COMMENT '活动名称',
  `activity_audience` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '活动对象 0-所有 其它数据对应rank_id',
  `activity_condition` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-不限 1-投资总额 2-单笔投资 3-借款总额 4-邀请好友数',
  `award_condition` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '奖励条件 ',
  `project_type` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '0-所有项目 其它为financial_type的ID',
  `award_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1-红包 2-理财金 3-加息券',
  `award_content` varchar(30) NOT NULL DEFAULT '' COMMENT '奖品',
  `start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动开始时间',
  `end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '活动结束时间',
  `get_award_expiry_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '奖品领取有效时间',
  `auditer_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '审核人ID',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-待审核 1-审核通过 2-审核拒绝 3-暂停',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for z_activity_log
-- ----------------------------
DROP TABLE IF EXISTS `z_activity_log`;
CREATE TABLE `z_activity_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '领取人ID',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '活动ID',
  `award_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-自由 1-投资总额 2-单笔投资 3-借款总额 4-邀请好友数',
  `outside_amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '金额数量',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-待领取 1-已领取',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '领取时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for z_admin
-- ----------------------------
DROP TABLE IF EXISTS `z_admin`;
CREATE TABLE `z_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '管理员名称',
  `password_hash` varchar(80) NOT NULL DEFAULT '' COMMENT 'hash密码',
  `level` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-超级管理员 1－普通管理员',
  `auth_key` varchar(32) NOT NULL DEFAULT '' COMMENT '密码验证键',
  `add_by` int(11) NOT NULL DEFAULT '0' COMMENT '增加者ID',
  `created_at` int(10) NOT NULL DEFAULT '0',
  `updated_at` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='管理员表';

-- ----------------------------
-- Table structure for z_aptitudes
-- ----------------------------
DROP TABLE IF EXISTS `z_aptitudes`;
CREATE TABLE `z_aptitudes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '上传者ID',
  `cooperation_id` int(11) NOT NULL DEFAULT '0' COMMENT '资质主ID',
  `aptitude_name` varchar(50) NOT NULL DEFAULT '' COMMENT '资质名称',
  `upload_id` int(11) NOT NULL DEFAULT '0' COMMENT '文件ID',
  `sorts` int(11) NOT NULL DEFAULT '0' COMMENT '排序，最值值优先排前',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='资质信息';

-- ----------------------------
-- Table structure for z_aptitudes_loan
-- ----------------------------
DROP TABLE IF EXISTS `z_aptitudes_loan`;
CREATE TABLE `z_aptitudes_loan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传者ID',
  `loan_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '资质主ID',
  `aptitude_name` varchar(50) NOT NULL DEFAULT '' COMMENT '资质名称',
  `upload_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文件ID',
  `sorts` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序，最小值优先排前',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='标的相关的资质信息';

-- ----------------------------
-- Table structure for z_archives
-- ----------------------------
DROP TABLE IF EXISTS `z_archives`;
CREATE TABLE `z_archives` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '属性 0－普通 1－幻灯',
  `type_id` int(11) NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `title` varchar(60) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '标题',
  `introduce` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '简介',
  `upload_id` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '缩略图',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0－待审核 1－审核通过 2－审核拒绝',
  `is_disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-待审核 1-已审核 2-审核拒绝',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '发表时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '编辑时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8 COMMENT='文档'
/*!50100 PARTITION BY RANGE (id)
(PARTITION p0 VALUES LESS THAN (3000000) ENGINE = MyISAM,
 PARTITION p1 VALUES LESS THAN (6000000) ENGINE = MyISAM,
 PARTITION p2 VALUES LESS THAN (9000000) ENGINE = MyISAM,
 PARTITION p3 VALUES LESS THAN (12000000) ENGINE = MyISAM,
 PARTITION p4 VALUES LESS THAN (15000000) ENGINE = MyISAM,
 PARTITION p5 VALUES LESS THAN (18000000) ENGINE = MyISAM,
 PARTITION p6 VALUES LESS THAN (21000000) ENGINE = MyISAM,
 PARTITION p7 VALUES LESS THAN (24000000) ENGINE = MyISAM,
 PARTITION p8 VALUES LESS THAN (27000000) ENGINE = MyISAM,
 PARTITION p9 VALUES LESS THAN MAXVALUE ENGINE = MyISAM) */;

-- ----------------------------
-- Table structure for z_archives_type
-- ----------------------------
DROP TABLE IF EXISTS `z_archives_type`;
CREATE TABLE `z_archives_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) NOT NULL DEFAULT '' COMMENT '隶属模块名',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '上级ID',
  `type_name` varchar(50) NOT NULL DEFAULT '' COMMENT '栏目名称',
  `introduce` varchar(255) NOT NULL,
  `is_cover` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-是封面 1-不是封面',
  `template_name` varchar(255) NOT NULL DEFAULT '' COMMENT '模板名称',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='文档栏目表';

-- ----------------------------
-- Table structure for z_area
-- ----------------------------
DROP TABLE IF EXISTS `z_area`;
CREATE TABLE `z_area` (
  `areaid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `areaname` varchar(50) NOT NULL DEFAULT '',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  `arrparentid` varchar(255) NOT NULL DEFAULT '',
  `child` tinyint(1) NOT NULL DEFAULT '0',
  `arrchildid` text NOT NULL,
  `listorder` smallint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`areaid`)
) ENGINE=MyISAM AUTO_INCREMENT=82267 DEFAULT CHARSET=utf8 COMMENT='地区';

-- ----------------------------
-- Table structure for z_article
-- ----------------------------
DROP TABLE IF EXISTS `z_article`;
CREATE TABLE `z_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `archive_id` int(11) NOT NULL DEFAULT '0' COMMENT '文档ID',
  `content` text CHARACTER SET utf8mb4 NOT NULL COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='文章表';

-- ----------------------------
-- Table structure for z_assumption
-- ----------------------------
DROP TABLE IF EXISTS `z_assumption`;
CREATE TABLE `z_assumption` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL DEFAULT '0' COMMENT '借款ID',
  `loan_user_id` int(11) NOT NULL DEFAULT '0' COMMENT '借款人会员ID',
  `assumption_periods` smallint(3) NOT NULL DEFAULT '0' COMMENT '代还期数',
  `assumption_amount` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '代还总金额',
  `assumption_principal` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '代还本金',
  `assumption_interest` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '代还利息',
  `assumption_fine` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '代还罚金',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '代还时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for z_auth_assignment
-- ----------------------------
DROP TABLE IF EXISTS `z_auth_assignment`;
CREATE TABLE `z_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  CONSTRAINT `z_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `z_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for z_auth_item
-- ----------------------------
DROP TABLE IF EXISTS `z_auth_item`;
CREATE TABLE `z_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `z_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `z_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for z_auth_item_child
-- ----------------------------
DROP TABLE IF EXISTS `z_auth_item_child`;
CREATE TABLE `z_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `z_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `z_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `z_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `z_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for z_auth_rule
-- ----------------------------
DROP TABLE IF EXISTS `z_auth_rule`;
CREATE TABLE `z_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for z_cooperations
-- ----------------------------
DROP TABLE IF EXISTS `z_cooperations`;
CREATE TABLE `z_cooperations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '添加人ID',
  `company_name` varchar(255) NOT NULL DEFAULT '' COMMENT '企业名称',
  `company_address` varchar(255) NOT NULL DEFAULT '' COMMENT '公司地址',
  `company_number` varchar(50) NOT NULL DEFAULT '' COMMENT '企业编号',
  `legal_representative` varchar(20) NOT NULL DEFAULT '' COMMENT '法定代表人',
  `cooperation_start_time` int(10) NOT NULL DEFAULT '0' COMMENT '合作开始时间',
  `cooperation_end_time` int(10) NOT NULL DEFAULT '0' COMMENT '合作结束时间',
  `upload_id` int(11) NOT NULL DEFAULT '0' COMMENT '文件ID',
  `aptitude_ids` varchar(50) NOT NULL DEFAULT '0' COMMENT '资质ID组',
  `introduce` varchar(255) NOT NULL DEFAULT '' COMMENT '企业介绍',
  `risk_management_mode` varchar(255) NOT NULL DEFAULT '' COMMENT '风控模式',
  `is_forbidden` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0－不禁用 1－禁用',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0－待审核 1－审核通过 2－审核拒绝',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `auditer_id` int(11) NOT NULL DEFAULT '0' COMMENT '审核人ID',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='合作企业';

-- ----------------------------
-- Table structure for z_financial_config_cost
-- ----------------------------
DROP TABLE IF EXISTS `z_financial_config_cost`;
CREATE TABLE `z_financial_config_cost` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cost_name` varchar(255) NOT NULL DEFAULT '' COMMENT '费用名称',
  `expense_ratio` decimal(2,2) NOT NULL DEFAULT '0.00' COMMENT '费用占比',
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '金额',
  `investor_ratio` decimal(2,2) NOT NULL DEFAULT '0.00' COMMENT '投资人占比',
  `platform_ratio` decimal(2,2) NOT NULL DEFAULT '0.00' COMMENT '平台占比',
  `cooperation_ratio` decimal(2,2) NOT NULL DEFAULT '0.00' COMMENT '合作企业占比',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='财管资金参数配置表';

-- ----------------------------
-- Table structure for z_financial_type
-- ----------------------------
DROP TABLE IF EXISTS `z_financial_type`;
CREATE TABLE `z_financial_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `financial_name` varchar(50) NOT NULL DEFAULT '' COMMENT '理财项目名',
  `financial_value` varchar(255) NOT NULL DEFAULT '' COMMENT '理财项目设置值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='系统管理理财项目设置表';

-- ----------------------------
-- Table structure for z_loans
-- ----------------------------
DROP TABLE IF EXISTS `z_loans`;
CREATE TABLE `z_loans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发标人ID',
  `auditer_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '审核人ID',
  `cooperation_code` varchar(3) NOT NULL DEFAULT '' COMMENT '企业编码',
  `loan_amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '借款金额',
  `mini_investment_amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '最小投资额',
  `year_yield_rate` decimal(3,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '年化益率',
  `loan_bid_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-月标 1-天标',
  `term_of_loan` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '借款期限',
  `loan_type` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '借款类型financial_type_id',
  `repayment_type` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '还款方式payment_typ_id',
  `investment_award_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '投资奖励类型 0-不奖励 1-红包 2-加息',
  `investment_award_amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '奖励数量',
  `need_password` varchar(255) NOT NULL DEFAULT '' COMMENT '定向标（密码标）',
  `qualification_information` varchar(20) NOT NULL DEFAULT '' COMMENT '资质信息ID组',
  `load_content` text NOT NULL COMMENT '标的内容',
  `repayment_source` text NOT NULL COMMENT '还款来源',
  `repayment_guarantee` text NOT NULL COMMENT '还款保障',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-待审核 1-已审核 2-准备标 3-审核拒绝 4-风控不合格 5-标满 6-流标 7-转让 ',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `update_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '编辑时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='借款表';

-- ----------------------------
-- Table structure for z_member_account
-- ----------------------------
DROP TABLE IF EXISTS `z_member_account`;
CREATE TABLE `z_member_account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `amount` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '可用金额',
  `frozen_amount` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '冻结金额',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='用户资金总统计表';

-- ----------------------------
-- Table structure for z_member_ext
-- ----------------------------
DROP TABLE IF EXISTS `z_member_ext`;
CREATE TABLE `z_member_ext` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0－女 1－男',
  `real_name` varchar(10) NOT NULL DEFAULT '' COMMENT '姓名',
  `identification_card` char(18) NOT NULL DEFAULT '' COMMENT '身份证',
  `bank_card` varchar(30) NOT NULL DEFAULT '' COMMENT '银行卡号',
  `rank_id` int(11) NOT NULL DEFAULT '0' COMMENT '级别ID',
  `scores` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `add_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0－前台注册 1－后台增加',
  `referee_id` int(11) NOT NULL DEFAULT '0' COMMENT '推荐user_id',
  `education_background` varchar(30) NOT NULL DEFAULT '' COMMENT '学历',
  `marriage` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0－未婚 1－已婚',
  `area_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '地区ID',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT '住址',
  `trade` smallint(3) NOT NULL DEFAULT '0' COMMENT '所属行业',
  `professional_title` varchar(50) NOT NULL DEFAULT '' COMMENT '职称',
  `login_ip` int(10) NOT NULL DEFAULT '0' COMMENT 'IP',
  `login_time` int(10) NOT NULL DEFAULT '0' COMMENT '登录时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='会员扩展表'
/*!50100 PARTITION BY RANGE (id)
(PARTITION p0 VALUES LESS THAN (3000000) ENGINE = InnoDB,
 PARTITION p1 VALUES LESS THAN (6000000) ENGINE = InnoDB,
 PARTITION p2 VALUES LESS THAN (9000000) ENGINE = InnoDB,
 PARTITION p3 VALUES LESS THAN (12000000) ENGINE = InnoDB,
 PARTITION p4 VALUES LESS THAN (15000000) ENGINE = InnoDB,
 PARTITION p5 VALUES LESS THAN (18000000) ENGINE = InnoDB,
 PARTITION p6 VALUES LESS THAN (21000000) ENGINE = InnoDB,
 PARTITION p7 VALUES LESS THAN (24000000) ENGINE = InnoDB,
 PARTITION p8 VALUES LESS THAN (27000000) ENGINE = InnoDB,
 PARTITION p9 VALUES LESS THAN (30000000) ENGINE = InnoDB,
 PARTITION p10 VALUES LESS THAN MAXVALUE ENGINE = InnoDB) */;

-- ----------------------------
-- Table structure for z_member_rank
-- ----------------------------
DROP TABLE IF EXISTS `z_member_rank`;
CREATE TABLE `z_member_rank` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `scores_range` varchar(80) NOT NULL DEFAULT '' COMMENT '积分范围',
  `rank_name` varchar(30) NOT NULL DEFAULT '' COMMENT '级别名',
  `is_enable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-禁用 1-启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for z_member_recommend_friends
-- ----------------------------
DROP TABLE IF EXISTS `z_member_recommend_friends`;
CREATE TABLE `z_member_recommend_friends` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `recommend_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-邀请链接',
  `recommender_user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '好友ID',
  `level` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-一级好友 2-二级好友',
  `created_at` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '推荐时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for z_member_role_amount
-- ----------------------------
DROP TABLE IF EXISTS `z_member_role_amount`;
CREATE TABLE `z_member_role_amount` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `role_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-正常金额 1-红包 2-奖励  3-理财金 4-加息券',
  `role_number` varchar(20) NOT NULL,
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for z_menu
-- ----------------------------
DROP TABLE IF EXISTS `z_menu`;
CREATE TABLE `z_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `route` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `data` blob,
  PRIMARY KEY (`id`),
  KEY `parent` (`parent`),
  CONSTRAINT `z_menu_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `z_menu` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for z_message
-- ----------------------------
DROP TABLE IF EXISTS `z_message`;
CREATE TABLE `z_message` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `reid` int(11) NOT NULL DEFAULT '0' COMMENT '对方消息ID',
  `msg_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '消息类型 0-系统消息 1-管理消息 2-好友消息',
  `sender_id` int(11) NOT NULL DEFAULT '0' COMMENT '发送者ID',
  `receiver_id` int(11) NOT NULL DEFAULT '0' COMMENT '接收者ID',
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '消息标题',
  `content` varchar(255) NOT NULL DEFAULT '' COMMENT '消息内容',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '发送时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='站内短信表';

-- ----------------------------
-- Table structure for z_migration
-- ----------------------------
DROP TABLE IF EXISTS `z_migration`;
CREATE TABLE `z_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for z_payment_type
-- ----------------------------
DROP TABLE IF EXISTS `z_payment_type`;
CREATE TABLE `z_payment_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(50) NOT NULL DEFAULT '' COMMENT '还款方式名',
  `payment_value` varchar(255) NOT NULL DEFAULT '' COMMENT '还款方式描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='系统管理理财项目设置表';

-- ----------------------------
-- Table structure for z_platform_funds
-- ----------------------------
DROP TABLE IF EXISTS `z_platform_funds`;
CREATE TABLE `z_platform_funds` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `amount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '平台可用资金',
  `recharge_fees` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '充值手续费',
  `withdraw_cash_fees` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '充值手续费',
  `red_packets` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '红包总额',
  `cashed_red_packets` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '已兑现红包',
  `debt_transfer_fees` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '债权转让收入',
  `prepayment_penalty` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '提前还款违约金',
  `aged_fail` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '逾期违约金',
  `trade_fees_investor` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '交易服务费-投资人',
  `trade_fees_lender` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '交易服务费-贷款人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for z_sys_config
-- ----------------------------
DROP TABLE IF EXISTS `z_sys_config`;
CREATE TABLE `z_sys_config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `param_name` varchar(50) NOT NULL DEFAULT '' COMMENT '参数名',
  `params` varchar(255) NOT NULL DEFAULT '' COMMENT '参数',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COMMENT='系缚参数配置表';

-- ----------------------------
-- Table structure for z_trades
-- ----------------------------
DROP TABLE IF EXISTS `z_trades`;
CREATE TABLE `z_trades` (
  `id` bigint(30) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `trade_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '交易类型 1-充值 2-提现 3-收款 4-项目收款',
  `amount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '交易金额',
  `fee` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `take_off_fee_amount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '到账金额',
  `operate_channels` varchar(255) NOT NULL DEFAULT '' COMMENT '操作渠道',
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT '状态',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC
/*!50100 PARTITION BY RANGE (id)
(PARTITION p0 VALUES LESS THAN (1000000) ENGINE = InnoDB,
 PARTITION p1 VALUES LESS THAN (2000000) ENGINE = InnoDB,
 PARTITION p2 VALUES LESS THAN (3000000) ENGINE = InnoDB,
 PARTITION p3 VALUES LESS THAN (4000000) ENGINE = InnoDB,
 PARTITION p4 VALUES LESS THAN (5000000) ENGINE = InnoDB,
 PARTITION p5 VALUES LESS THAN (6000000) ENGINE = InnoDB,
 PARTITION p6 VALUES LESS THAN (7000000) ENGINE = InnoDB,
 PARTITION p7 VALUES LESS THAN (8000000) ENGINE = InnoDB,
 PARTITION p8 VALUES LESS THAN (9000000) ENGINE = InnoDB,
 PARTITION p9 VALUES LESS THAN (10000000) ENGINE = InnoDB,
 PARTITION p10 VALUES LESS THAN (11000000) ENGINE = InnoDB,
 PARTITION p11 VALUES LESS THAN (12000000) ENGINE = InnoDB,
 PARTITION p12 VALUES LESS THAN (13000000) ENGINE = InnoDB,
 PARTITION p13 VALUES LESS THAN (14000000) ENGINE = InnoDB,
 PARTITION p14 VALUES LESS THAN (15000000) ENGINE = InnoDB,
 PARTITION p15 VALUES LESS THAN (16000000) ENGINE = InnoDB,
 PARTITION p16 VALUES LESS THAN (17000000) ENGINE = InnoDB,
 PARTITION p17 VALUES LESS THAN (18000000) ENGINE = InnoDB,
 PARTITION p18 VALUES LESS THAN (19000000) ENGINE = InnoDB,
 PARTITION p19 VALUES LESS THAN (20000000) ENGINE = InnoDB,
 PARTITION p20 VALUES LESS THAN (21000000) ENGINE = InnoDB,
 PARTITION p21 VALUES LESS THAN (22000000) ENGINE = InnoDB,
 PARTITION p22 VALUES LESS THAN (23000000) ENGINE = InnoDB,
 PARTITION p23 VALUES LESS THAN (24000000) ENGINE = InnoDB,
 PARTITION p24 VALUES LESS THAN (25000000) ENGINE = InnoDB,
 PARTITION p25 VALUES LESS THAN (26000000) ENGINE = InnoDB,
 PARTITION p26 VALUES LESS THAN (27000000) ENGINE = InnoDB,
 PARTITION p27 VALUES LESS THAN (28000000) ENGINE = InnoDB,
 PARTITION p28 VALUES LESS THAN (29000000) ENGINE = InnoDB,
 PARTITION p29 VALUES LESS THAN MAXVALUE ENGINE = InnoDB) */;

-- ----------------------------
-- Table structure for z_uploads
-- ----------------------------
DROP TABLE IF EXISTS `z_uploads`;
CREATE TABLE `z_uploads` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `type_id` int(11) NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `doc_id` int(11) NOT NULL DEFAULT '0' COMMENT '文档ID',
  `doc_model` varchar(100) NOT NULL DEFAULT '' COMMENT '模型名称',
  `file_path` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
  `file_name` varchar(80) NOT NULL DEFAULT '' COMMENT '文件名',
  `file_type` varchar(15) NOT NULL DEFAULT '' COMMENT '文件类型',
  `file_size` varchar(20) NOT NULL DEFAULT '' COMMENT '文件大小',
  `file_mime` varchar(255) NOT NULL DEFAULT '' COMMENT '文件mime',
  `file_hash` varchar(255) NOT NULL DEFAULT '' COMMENT '文件名md5',
  `file_alt` varchar(255) NOT NULL DEFAULT '' COMMENT '文件标题',
  `fdfs_storage_host` varchar(255) NOT NULL DEFAULT '' COMMENT 'fastdfs链接主机',
  `fdfs_filename` varchar(255) NOT NULL DEFAULT '' COMMENT 'fastdfs文件名',
  `fdfs_path` varchar(80) NOT NULL DEFAULT '' COMMENT 'fastdfs群组路径',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '上传时间',
  `updated_at` int(10) NOT NULL DEFAULT '0' COMMENT '更新时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=354 DEFAULT CHARSET=utf8 COMMENT='上传类'
/*!50100 PARTITION BY RANGE (id)
(PARTITION p0 VALUES LESS THAN (5000000) ENGINE = MyISAM,
 PARTITION p1 VALUES LESS THAN (10000000) ENGINE = MyISAM,
 PARTITION p2 VALUES LESS THAN (15000000) ENGINE = MyISAM,
 PARTITION p3 VALUES LESS THAN (20000000) ENGINE = MyISAM,
 PARTITION p4 VALUES LESS THAN (25000000) ENGINE = MyISAM,
 PARTITION p5 VALUES LESS THAN (30000000) ENGINE = MyISAM,
 PARTITION p6 VALUES LESS THAN (35000000) ENGINE = MyISAM,
 PARTITION p7 VALUES LESS THAN (40000000) ENGINE = MyISAM,
 PARTITION p8 VALUES LESS THAN MAXVALUE ENGINE = MyISAM) */;

-- ----------------------------
-- Table structure for z_user
-- ----------------------------
DROP TABLE IF EXISTS `z_user`;
CREATE TABLE `z_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '用户名',
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '验证键',
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '哈希密码',
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '重置密码请求码',
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '邮箱',
  `mobile` varchar(15) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '手机',
  `is_disable` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-正常 1-屏蔽',
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT '状态 0－待审核 10－已激活',
  `operater_id` int(11) NOT NULL DEFAULT '0' COMMENT '操作人ID',
  `admin_id` int(11) NOT NULL DEFAULT '0' COMMENT '管理员身份ID',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '编辑时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='会员表'
/*!50100 PARTITION BY RANGE (id)
(PARTITION p0 VALUES LESS THAN (3000000) ENGINE = InnoDB,
 PARTITION p1 VALUES LESS THAN (6000000) ENGINE = InnoDB,
 PARTITION p2 VALUES LESS THAN (9000000) ENGINE = InnoDB,
 PARTITION p3 VALUES LESS THAN (12000000) ENGINE = InnoDB,
 PARTITION p4 VALUES LESS THAN (15000000) ENGINE = InnoDB,
 PARTITION p5 VALUES LESS THAN (18000000) ENGINE = InnoDB,
 PARTITION p6 VALUES LESS THAN (21000000) ENGINE = InnoDB,
 PARTITION p7 VALUES LESS THAN (24000000) ENGINE = InnoDB,
 PARTITION p8 VALUES LESS THAN (27000000) ENGINE = InnoDB,
 PARTITION p9 VALUES LESS THAN (30000000) ENGINE = InnoDB,
 PARTITION p10 VALUES LESS THAN MAXVALUE ENGINE = InnoDB) */;

-- ----------------------------
-- Table structure for z_user_finance_statistics
-- ----------------------------
DROP TABLE IF EXISTS `z_user_finance_statistics`;
CREATE TABLE `z_user_finance_statistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `amounts` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '可用金额',
  `collects` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '待收总额',
  `profits` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '收益总额',
  `recharges` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '充值总额',
  `withdrawals` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '提现总额',
  `rewards` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '奖励总额',
  `red_packets` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '红包总额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='用户资金统计表';

-- ----------------------------
-- Table structure for z_user_role
-- ----------------------------
DROP TABLE IF EXISTS `z_user_role`;
CREATE TABLE `z_user_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_type` varchar(50) NOT NULL DEFAULT '' COMMENT '关联的表名',
  `role_id` varchar(255) NOT NULL DEFAULT '' COMMENT '关联的ID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='会员帐户关联表';

-- ----------------------------
-- Table structure for z_withdraw_cash
-- ----------------------------
DROP TABLE IF EXISTS `z_withdraw_cash`;
CREATE TABLE `z_withdraw_cash` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `amount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '提现金额',
  `bank_id` int(11) NOT NULL DEFAULT '0' COMMENT '银行ID',
  `bank_card` varchar(80) NOT NULL DEFAULT '' COMMENT '提现的银行卡号',
  `auditer_id` int(11) NOT NULL DEFAULT '0' COMMENT '审核人ID',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-同意 1-拒绝',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '申请时间',
  `audite_time` int(10) NOT NULL DEFAULT '0' COMMENT '审核时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;
