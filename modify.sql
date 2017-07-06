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
SET FOREIGN_KEY_CHECKS=1;

ALTER TABLE `z_aptitudes` ADD COLUMN `sort`  int(11) NOT NULL DEFAULT 0 COMMENT '排序，最值值优先排前' AFTER `upload_id`;

ALTER TABLE `z_attach_file`
MODIFY COLUMN `name`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件名' AFTER `id`,
MODIFY COLUMN `model`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模型名' AFTER `name`,
MODIFY COLUMN `itemId`  int(11) NOT NULL DEFAULT 0 COMMENT '文档ID' AFTER `model`,
MODIFY COLUMN `hash`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'md5的hash' AFTER `itemId`,
MODIFY COLUMN `size`  int(11) NOT NULL DEFAULT 0 COMMENT '文件大小' AFTER `hash`,
MODIFY COLUMN `type`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件类型' AFTER `size`,
MODIFY COLUMN `mime`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '文件头类型' AFTER `type`,
ADD COLUMN `user_id`  int(11) NOT NULL DEFAULT 0 COMMENT '会员ID' AFTER `id`;
ALTER TABLE `z_attach_file`
ADD COLUMN `created_at`  int(10) NOT NULL DEFAULT 0 COMMENT '创建时间' AFTER `mime`;

ALTER TABLE `z_uploads`
ADD COLUMN `file_hash`  varchar(255) NOT NULL DEFAULT '' COMMENT '文件名md5' AFTER `file_size`;
ALTER TABLE `z_uploads`
ADD COLUMN `file_mime`  varchar(255) NOT NULL DEFAULT '' COMMENT '文件mime' AFTER `file_size`;

ALTER TABLE `z_uploads`
MODIFY COLUMN `fdfs_path`  varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'fastdfs群组路径' AFTER `fdfs_filename`;

ALTER TABLE `z_uploads`
MODIFY COLUMN `doc_model`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '模型名称' AFTER `doc_id`;

ALTER TABLE `z_uploads`
ADD COLUMN `file_alt`  varchar(255) NOT NULL DEFAULT '' COMMENT '文件标题' AFTER `file_hash`;


ALTER TABLE `z_aptitudes`
ADD COLUMN `aptitude_id`  int(11) NOT NULL DEFAULT 0 COMMENT '资质主ID' AFTER `user_id`;

ALTER TABLE `z_aptitudes`
CHANGE COLUMN `aptitude_id` `cooperation_id`  int(11) NOT NULL DEFAULT 0 COMMENT '资质主ID' AFTER `user_id`;



ALTER TABLE `z_aptitudes`
CHANGE COLUMN `sort` `sorts`  int(11) NOT NULL DEFAULT 0 COMMENT '排序，最值值优先排前' AFTER `upload_id`;

ALTER TABLE `z_aptitudes`
ENGINE=InnoDB;

ALTER TABLE `z_member_ext`
MODIFY COLUMN `address`  varchar(255) NOT NULL DEFAULT '' COMMENT '住址' AFTER `marriage`;

CREATE TABLE IF NOT EXITS `z_message` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`reid`  int(11) NOT NULL DEFAULT 0 COMMENT '对方消息ID' ,
`msg_type`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '消息类型 0-系统消息 1-管理消息 2-好友消息' ,
`sender_id`  int(11) NOT NULL DEFAULT 0 COMMENT '发送者ID' ,
`receiver_id`  int(11) NOT NULL DEFAULT 0 COMMENT '接收者ID' ,
`title`  varchar(30) NOT NULL DEFAULT '' COMMENT '消息标题' ,
`content`  varchar(255) NOT NULL DEFAULT '' COMMENT '消息内容' ,
`created_at`  int(10) NOT NULL DEFAULT 0 COMMENT '发送时间' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
COMMENT='站内短信表'
CHECKSUM=0
DELAY_KEY_WRITE=0
;

DROP TABLE IF EXISTS `z_archives`;
CREATE TABLE `z_archives` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '属性 0－普通 1－幻灯',
  `type_id` int(11) NOT NULL DEFAULT '0' COMMENT '栏目ID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `title` varchar(60) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '标题',
  `introduce` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '简介',
  `litpic` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '缩略图',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0－待审核 1－审核通过 2－审核拒绝',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '发表时间',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '编辑时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文档'
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
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_article`;
CREATE TABLE `z_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `archive_id` int(11) NOT NULL DEFAULT '0' COMMENT '文档ID',
  `content` text CHARACTER SET utf8mb4 NOT NULL COMMENT '内容',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章表';
SET FOREIGN_KEY_CHECKS=1;


DROP TABLE IF EXISTS `z_archives_type`;
CREATE TABLE `z_archives_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) NOT NULL DEFAULT '' COMMENT '隶属模块名',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '上级ID',
  `type_name` varchar(50) NOT NULL DEFAULT '' COMMENT '栏目名称',
  `introduce` varchar(255) NOT NULL,
  `is_cover` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-是封面 1-不是封面',
  `template_name` varchar(255) NOT NULL DEFAULT '' COMMENT '模板名称',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='文档栏目表';
SET FOREIGN_KEY_CHECKS=1;

ALTER TABLE `z_archives_type`
ADD COLUMN `created_at`  int(10) NOT NULL DEFAULT 0 COMMENT '创建时间' AFTER `template_name`;

ALTER TABLE `z_archives`
CHANGE COLUMN `litpic` `upload_id`  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '缩略图' AFTER `introduce`;

ALTER TABLE `z_archives`
ADD COLUMN `is_disable`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-正常 1-屏蔽' AFTER `status`,
ADD COLUMN `remark`  varchar(255) NOT NULL DEFAULT '' COMMENT '备注' AFTER `is_disable`;

DROP TABLE IF EXISTS `z_user_role`;
CREATE TABLE `z_user_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_type` varchar(50) NOT NULL DEFAULT '' COMMENT '关联的表名',
  `role_id` smallint(3) NOT NULL DEFAULT '0' COMMENT '关联的ID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='会员帐户关联表';
SET FOREIGN_KEY_CHECKS=1;


ALTER TABLE `z_member_ext`
ADD COLUMN `login_time`  int(10) NOT NULL DEFAULT 0 COMMENT '登录时间' AFTER `login_ip`;


ALTER TABLE `z_user_role`
MODIFY COLUMN `role_id`  varchar(255) NOT NULL DEFAULT '' COMMENT '关联的ID' AFTER `role_type`;

ALTER TABLE `z_admin`
ENGINE=InnoDB;

ALTER TABLE `z_user_role`
ENGINE=InnoDB;


ALTER TABLE `z_admin`
ADD COLUMN `add_by`  int(11) NOT NULL DEFAULT 0 COMMENT '增加者ID' AFTER `auth_key`;

ALTER TABLE `z_user`
ADD COLUMN `operater_id`  int(11) NOT NULL DEFAULT 0 COMMENT '操作人ID' AFTER `status`;


ALTER TABLE `z_user`
ADD COLUMN `admin_id`  int(11) NOT NULL DEFAULT 0 COMMENT '管理员身份ID' AFTER `operater_id`;


CREATE TABLE `z_sys_config` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`param_name`  varchar(50) NOT NULL DEFAULT '' COMMENT '参数名' ,
`params`  varchar(255) NOT NULL DEFAULT '' COMMENT '参数' ,
PRIMARY KEY (`id`)
)
COMMENT='系缚参数配置表'
;

DROP TABLE IF EXISTS `z_financial_type`;
CREATE TABLE `z_financial_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `financial_name` varchar(50) NOT NULL DEFAULT '' COMMENT '理财项目名',
  `financial_value` varchar(255) NOT NULL DEFAULT '' COMMENT '理财项目设置值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='系统管理理财项目设置表';
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_payment_type`;
CREATE TABLE `z_payment_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(50) NOT NULL DEFAULT '' COMMENT '还款方式名',
  `payment_value` varchar(255) NOT NULL DEFAULT '' COMMENT '还款方式描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='系统管理理财项目设置表';
SET FOREIGN_KEY_CHECKS=1;

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
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_trades`;
CREATE TABLE `z_trades` (
  `id` bigint(30) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `trade_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '交易类型 1-充值 2-提现 3-收款 4-项目收款',
  `amount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '交易金额',
  `fee` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '手续费',
  `take_off_fee_amount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '到账金额',
  `operate_channels`  varchar(255) NOT NULL DEFAULT '' COMMENT '操作渠道',
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT '状态',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_withdraw_cash`;
CREATE TABLE `z_withdraw_cash` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `amount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '提现金额',
  `bank_id`  int(11) NOT NULL DEFAULT '0' COMMENT '银行ID',
  `bank_card` varchar(80) NOT NULL DEFAULT '' COMMENT '提现的银行卡号',
  `auditer_id` int(11) NOT NULL DEFAULT '0' COMMENT '审核人ID',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-同意 1-拒绝',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '申请时间',
  `audite_time` int(10) NOT NULL DEFAULT '0' COMMENT '审核时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;


ALTER TABLE `z_trades`
ROW_FORMAT=DYNAMIC;

ALTER TABLE `z_trades` PARTITION BY RANGE(id) (PARTITION `p0` VALUES LESS THAN (1000000) , PARTITION `p1` VALUES LESS THAN (2000000) , PARTITION `p2` VALUES LESS THAN (3000000) , PARTITION `p3` VALUES LESS THAN (4000000) , PARTITION `p4` VALUES LESS THAN (5000000) , PARTITION `p5` VALUES LESS THAN (6000000) , PARTITION `p6` VALUES LESS THAN (7000000) , PARTITION `p7` VALUES LESS THAN (8000000) , PARTITION `p8` VALUES LESS THAN (9000000) , PARTITION `p9` VALUES LESS THAN (10000000) , PARTITION `p10` VALUES LESS THAN (11000000) , PARTITION `p11` VALUES LESS THAN (12000000) , PARTITION `p12` VALUES LESS THAN (13000000) , PARTITION `p13` VALUES LESS THAN (14000000) , PARTITION `p14` VALUES LESS THAN (15000000) , PARTITION `p15` VALUES LESS THAN (16000000) , PARTITION `p16` VALUES LESS THAN (17000000) , PARTITION `p17` VALUES LESS THAN (18000000) , PARTITION `p18` VALUES LESS THAN (19000000) , PARTITION `p19` VALUES LESS THAN (20000000) , PARTITION `p20` VALUES LESS THAN (21000000) , PARTITION `p21` VALUES LESS THAN (22000000) , PARTITION `p22` VALUES LESS THAN (23000000) , PARTITION `p23` VALUES LESS THAN (24000000) , PARTITION `p24` VALUES LESS THAN (25000000) , PARTITION `p25` VALUES LESS THAN (26000000) , PARTITION `p26` VALUES LESS THAN (27000000) , PARTITION `p27` VALUES LESS THAN (28000000) , PARTITION `p28` VALUES LESS THAN (29000000) , PARTITION `p29` VALUES LESS THAN (MAXVALUE) ) ;

ALTER TABLE `z_trades`
ADD COLUMN `operate_channels`  varchar(255) NOT NULL DEFAULT '' COMMENT '操作渠道' AFTER `take_off_fee_amount`;


DROP TABLE IF EXISTS `z_user_finance_statistics`;
CREATE TABLE `z_user_finance_statistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '会员ID',
  `amounts` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '可用金额',
  `collects` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '总待收金额',
  `profits` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '总收益金额',
  `recharges` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '总充值金额',
  `withdrawals` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '总提现金额',
  `rewards` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '奖励总额',
  `red_packets` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '红包总额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户资金统计表';
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_platform_funds`;
CREATE TABLE `z_platform_funds` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  ·amount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '平台可用资金'
  `recharge_fees` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '充值手续费',
  `withdraw_cash_fees` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '充值手续费',
  `red_packets` decimal(12,2) NOT NULL DEFAULT ‘0.00’ COMMENT '红包总额'
  `cashed_red_packets` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '已兑现红包',
  `debt_transfer_fees` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '债权转让收入',
  `prepayment_penalty` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '提前还款违约金',
  `aged_fail` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '逾期违约金',
  `trade_fees_investor` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '交易服务费-投资人',
  `trade_fees_lender` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '交易服务费-贷款人',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_assumption`;
CREATE TABLE `z_assumption` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL DEFAULT '0' COMMENT '借款ID',
  `loan_user_kd` int(11) NOT NULL DEFAULT '0' COMMENT '借款人会员ID',
  `assumption_periods` smallint(3) NOT NULL DEFAULT '0' COMMENT '代偿期数',
  `assumption_amount` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '代还总金额',
  `assumption_principal` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '代还本金',
  `assumption_interest` decimal(12,3) unsigned NOT NULL,
  `assumption_fine` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '代付罚金',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '代付时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;


DROP TABLE IF EXISTS `z_member_rank`;
CREATE TABLE `z_member_rank` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `scores_range` varchar(80) NOT NULL DEFAULT '' COMMENT '积分范围',
  `rank_name` varchar(30) NOT NULL DEFAULT '' COMMENT '级别名',
  `is_enable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-禁用 1-启用',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_member_account`;
CREATE TABLE `z_member_account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `amount` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '可用金额',
  `frozen_amount` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '冻结金额',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户资金总统计表';
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_member_role_amount`;
CREATE TABLE `z_member_role_amount` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `role_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-正常金额 1-红包 2-奖励  3-理财金 4-加息券',
  `role_number` varchar(20) NOT NULL,
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '创建时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;


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
SET FOREIGN_KEY_CHECKS=1;


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
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_member_recommend_friends`;
CREATE TABLE `z_member_recommend_friends` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '会员ID',
  `recommend_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-邀请链接',
  `recommender_user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '推荐人ID',
  `level`  tinyint(1) NOT NULL DEFAULT 1 COMMENT '1-一级好友 2-二级好友'
  `created_at`  int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '推荐时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_loans`;
CREATE TABLE `z_loans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发标人ID',
  `loaner_property`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0-个人 1-企业',
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
  `need_password` varchar(255) NOT NULL DEFAULT '' COMMENT '定向标（密码标）',
  `qualification_information` varchar(20) NOT NULL DEFAULT '' COMMENT '资质信息ID组',
  `load_content` text NOT NULL COMMENT '标的内容',
  `repayment_source` text NOT NULL COMMENT '还款来源',
  `repayment_guarantee` text NOT NULL COMMENT '还款保障',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-待审核 1-已审核 2-准备标 3-审核拒绝 4-风控不合格 5-标满 6-流标 7-转让 ',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '编辑时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='借款表';
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_aptitudes_loan`;
CREATE TABLE `z_aptitudes_loan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上传者ID',
  `loan_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '资质主ID',
  `aptitude_name` varchar(50) NOT NULL DEFAULT '' COMMENT '资质名称',
  `upload_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '文件ID',
  `sorts` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '排序，最小值优先排前',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='标的相关的资质信息';
SET FOREIGN_KEY_CHECKS=1;


############    20170705 
ALTER TABLE `z_loans`
ADD COLUMN `loaner_property`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0-个人 1-企业' AFTER `user_id`;

ALTER TABLE `z_loans`
ADD COLUMN `cooperation_id`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '企业ID' AFTER `auditer_id`;

ALTER TABLE `z_loans`
MODIFY COLUMN `cooperation_code`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '企业编码' AFTER `cooperation_id`;


DROP TABLE IF EXISTS `z_loan_repayment`;
CREATE TABLE `z_loan_repayment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '还款人ID',
  `cooperation_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '合作公司ID',
  `loan_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '借款ID',
  `repayment_of_principal` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '待还本金',
  `interest_payable` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '待还利息',
  `repaymented_money` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '已还金额',
  `no_repayment_money` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '未还金额',
  `repayment_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '还款日',
  `repayment_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-待还款 1-部分还款 2-全部还清',
  `overdue_enalty_interest` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '逾期罚息',
  `overdue_days` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '逾期天数',
  `repaymented_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '还款时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;

ALTER TABLE `z_member_account`
MODIFY COLUMN `amount`  decimal(12,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '可用金额' AFTER `user_id`,
MODIFY COLUMN `frozen_amount`  decimal(12,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '冻结金额' AFTER `amount`;

ALTER TABLE `z_loans`
ADD COLUMN `usage_of_loan`  varchar(255) NOT NULL DEFAULT '' COMMENT '借款用途' AFTER `load_content`;

############    20170705 