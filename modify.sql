DROP TABLE IF EXISTS `z_member_ext`;
CREATE TABLE `z_member_ext` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '��ԱID',
  `sex` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0��Ů 1����',
  `real_name` varchar(10) NOT NULL DEFAULT '' COMMENT '����',
  `identification_card` char(18) NOT NULL DEFAULT '' COMMENT '���֤',
  `bank_card` varchar(30) NOT NULL DEFAULT '' COMMENT '���п���',
  `rank_id` int(11) NOT NULL DEFAULT '0' COMMENT '����ID',
  `scores` int(11) NOT NULL DEFAULT '0' COMMENT '����',
  `add_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0��ǰ̨ע�� 1����̨����',
  `referee_id` int(11) NOT NULL DEFAULT '0' COMMENT '�Ƽ�user_id',
  `education_background` varchar(30) NOT NULL DEFAULT '' COMMENT 'ѧ��',
  `marriage` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0��δ�� 1���ѻ�',
  `area_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '����ID',
  `address` varchar(255) NOT NULL DEFAULT '' COMMENT 'סַ',
  `trade` smallint(3) NOT NULL DEFAULT '0' COMMENT '������ҵ',
  `professional_title` varchar(50) NOT NULL DEFAULT '' COMMENT 'ְ��',
  `login_ip` int(10) NOT NULL DEFAULT '0' COMMENT 'IP',
  `login_time` int(10) NOT NULL DEFAULT '0' COMMENT '��¼ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COMMENT='��Ա��չ��'
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

ALTER TABLE `z_aptitudes` ADD COLUMN `sort`  int(11) NOT NULL DEFAULT 0 COMMENT '������ֵֵ������ǰ' AFTER `upload_id`;

ALTER TABLE `z_attach_file`
MODIFY COLUMN `name`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '�ļ���' AFTER `id`,
MODIFY COLUMN `model`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'ģ����' AFTER `name`,
MODIFY COLUMN `itemId`  int(11) NOT NULL DEFAULT 0 COMMENT '�ĵ�ID' AFTER `model`,
MODIFY COLUMN `hash`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'md5��hash' AFTER `itemId`,
MODIFY COLUMN `size`  int(11) NOT NULL DEFAULT 0 COMMENT '�ļ���С' AFTER `hash`,
MODIFY COLUMN `type`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '�ļ�����' AFTER `size`,
MODIFY COLUMN `mime`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '�ļ�ͷ����' AFTER `type`,
ADD COLUMN `user_id`  int(11) NOT NULL DEFAULT 0 COMMENT '��ԱID' AFTER `id`;
ALTER TABLE `z_attach_file`
ADD COLUMN `created_at`  int(10) NOT NULL DEFAULT 0 COMMENT '����ʱ��' AFTER `mime`;

ALTER TABLE `z_uploads`
ADD COLUMN `file_hash`  varchar(255) NOT NULL DEFAULT '' COMMENT '�ļ���md5' AFTER `file_size`;
ALTER TABLE `z_uploads`
ADD COLUMN `file_mime`  varchar(255) NOT NULL DEFAULT '' COMMENT '�ļ�mime' AFTER `file_size`;

ALTER TABLE `z_uploads`
MODIFY COLUMN `fdfs_path`  varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'fastdfsȺ��·��' AFTER `fdfs_filename`;

ALTER TABLE `z_uploads`
MODIFY COLUMN `doc_model`  varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT 'ģ������' AFTER `doc_id`;

ALTER TABLE `z_uploads`
ADD COLUMN `file_alt`  varchar(255) NOT NULL DEFAULT '' COMMENT '�ļ�����' AFTER `file_hash`;


ALTER TABLE `z_aptitudes`
ADD COLUMN `aptitude_id`  int(11) NOT NULL DEFAULT 0 COMMENT '������ID' AFTER `user_id`;

ALTER TABLE `z_aptitudes`
CHANGE COLUMN `aptitude_id` `cooperation_id`  int(11) NOT NULL DEFAULT 0 COMMENT '������ID' AFTER `user_id`;



ALTER TABLE `z_aptitudes`
CHANGE COLUMN `sort` `sorts`  int(11) NOT NULL DEFAULT 0 COMMENT '������ֵֵ������ǰ' AFTER `upload_id`;

ALTER TABLE `z_aptitudes`
ENGINE=InnoDB;

ALTER TABLE `z_member_ext`
MODIFY COLUMN `address`  varchar(255) NOT NULL DEFAULT '' COMMENT 'סַ' AFTER `marriage`;

CREATE TABLE IF NOT EXITS `z_message` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`reid`  int(11) NOT NULL DEFAULT 0 COMMENT '�Է���ϢID' ,
`msg_type`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '��Ϣ���� 0-ϵͳ��Ϣ 1-������Ϣ 2-������Ϣ' ,
`sender_id`  int(11) NOT NULL DEFAULT 0 COMMENT '������ID' ,
`receiver_id`  int(11) NOT NULL DEFAULT 0 COMMENT '������ID' ,
`title`  varchar(30) NOT NULL DEFAULT '' COMMENT '��Ϣ����' ,
`content`  varchar(255) NOT NULL DEFAULT '' COMMENT '��Ϣ����' ,
`created_at`  int(10) NOT NULL DEFAULT 0 COMMENT '����ʱ��' ,
PRIMARY KEY (`id`)
)
ENGINE=MyISAM
COMMENT='վ�ڶ��ű�'
CHECKSUM=0
DELAY_KEY_WRITE=0
;

DROP TABLE IF EXISTS `z_archives`;
CREATE TABLE `z_archives` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT '���� 0����ͨ 1���õ�',
  `type_id` int(11) NOT NULL DEFAULT '0' COMMENT '��ĿID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '��ԱID',
  `title` varchar(60) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '����',
  `introduce` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '���',
  `litpic` varchar(255) CHARACTER SET utf8mb4 NOT NULL DEFAULT '' COMMENT '����ͼ',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0������� 1�����ͨ�� 2����˾ܾ�',
  `created_at` int(11) NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  `updated_at` int(11) NOT NULL DEFAULT '0' COMMENT '�༭ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='�ĵ�'
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
  `archive_id` int(11) NOT NULL DEFAULT '0' COMMENT '�ĵ�ID',
  `content` text CHARACTER SET utf8mb4 NOT NULL COMMENT '����',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='���±�';
SET FOREIGN_KEY_CHECKS=1;


DROP TABLE IF EXISTS `z_archives_type`;
CREATE TABLE `z_archives_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(50) NOT NULL DEFAULT '' COMMENT '����ģ����',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT '�ϼ�ID',
  `type_name` varchar(50) NOT NULL DEFAULT '' COMMENT '��Ŀ����',
  `introduce` varchar(255) NOT NULL,
  `is_cover` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-�Ƿ��� 1-���Ƿ���',
  `template_name` varchar(255) NOT NULL DEFAULT '' COMMENT 'ģ������',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='�ĵ���Ŀ��';
SET FOREIGN_KEY_CHECKS=1;

ALTER TABLE `z_archives_type`
ADD COLUMN `created_at`  int(10) NOT NULL DEFAULT 0 COMMENT '����ʱ��' AFTER `template_name`;

ALTER TABLE `z_archives`
CHANGE COLUMN `litpic` `upload_id`  varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '' COMMENT '����ͼ' AFTER `introduce`;

ALTER TABLE `z_archives`
ADD COLUMN `is_disable`  tinyint(1) NOT NULL DEFAULT 0 COMMENT '0-���� 1-����' AFTER `status`,
ADD COLUMN `remark`  varchar(255) NOT NULL DEFAULT '' COMMENT '��ע' AFTER `is_disable`;

DROP TABLE IF EXISTS `z_user_role`;
CREATE TABLE `z_user_role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_type` varchar(50) NOT NULL DEFAULT '' COMMENT '�����ı���',
  `role_id` smallint(3) NOT NULL DEFAULT '0' COMMENT '������ID',
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '�û�ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='��Ա�ʻ�������';
SET FOREIGN_KEY_CHECKS=1;


ALTER TABLE `z_member_ext`
ADD COLUMN `login_time`  int(10) NOT NULL DEFAULT 0 COMMENT '��¼ʱ��' AFTER `login_ip`;


ALTER TABLE `z_user_role`
MODIFY COLUMN `role_id`  varchar(255) NOT NULL DEFAULT '' COMMENT '������ID' AFTER `role_type`;

ALTER TABLE `z_admin`
ENGINE=InnoDB;

ALTER TABLE `z_user_role`
ENGINE=InnoDB;


ALTER TABLE `z_admin`
ADD COLUMN `add_by`  int(11) NOT NULL DEFAULT 0 COMMENT '������ID' AFTER `auth_key`;

ALTER TABLE `z_user`
ADD COLUMN `operater_id`  int(11) NOT NULL DEFAULT 0 COMMENT '������ID' AFTER `status`;


ALTER TABLE `z_user`
ADD COLUMN `admin_id`  int(11) NOT NULL DEFAULT 0 COMMENT '����Ա���ID' AFTER `operater_id`;


CREATE TABLE `z_sys_config` (
`id`  int(11) UNSIGNED NOT NULL AUTO_INCREMENT ,
`param_name`  varchar(50) NOT NULL DEFAULT '' COMMENT '������' ,
`params`  varchar(255) NOT NULL DEFAULT '' COMMENT '����' ,
PRIMARY KEY (`id`)
)
COMMENT='ϵ���������ñ�'
;

DROP TABLE IF EXISTS `z_financial_type`;
CREATE TABLE `z_financial_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `financial_name` varchar(50) NOT NULL DEFAULT '' COMMENT '�����Ŀ��',
  `financial_value` varchar(255) NOT NULL DEFAULT '' COMMENT '�����Ŀ����ֵ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='ϵͳ���������Ŀ���ñ�';
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_payment_type`;
CREATE TABLE `z_payment_type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(50) NOT NULL DEFAULT '' COMMENT '���ʽ��',
  `payment_value` varchar(255) NOT NULL DEFAULT '' COMMENT '���ʽ����',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='ϵͳ���������Ŀ���ñ�';
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_financial_config_cost`;
CREATE TABLE `z_financial_config_cost` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `cost_name` varchar(255) NOT NULL DEFAULT '' COMMENT '��������',
  `expense_ratio` decimal(2,2) NOT NULL DEFAULT '0.00' COMMENT '����ռ��',
  `amount` decimal(8,2) NOT NULL DEFAULT '0.00' COMMENT '���',
  `investor_ratio` decimal(2,2) NOT NULL DEFAULT '0.00' COMMENT 'Ͷ����ռ��',
  `platform_ratio` decimal(2,2) NOT NULL DEFAULT '0.00' COMMENT 'ƽ̨ռ��',
  `cooperation_ratio` decimal(2,2) NOT NULL DEFAULT '0.00' COMMENT '������ҵռ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='�ƹ��ʽ�������ñ�';
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_trades`;
CREATE TABLE `z_trades` (
  `id` bigint(30) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '��ԱID',
  `trade_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '�������� 1-��ֵ 2-���� 3-�տ� 4-��Ŀ�տ�',
  `amount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '���׽��',
  `fee` decimal(6,2) NOT NULL DEFAULT '0.00' COMMENT '������',
  `take_off_fee_amount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '���˽��',
  `operate_channels`  varchar(255) NOT NULL DEFAULT '' COMMENT '��������',
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT '״̬',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '��ע',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_withdraw_cash`;
CREATE TABLE `z_withdraw_cash` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '��ԱID',
  `amount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '���ֽ��',
  `bank_id`  int(11) NOT NULL DEFAULT '0' COMMENT '����ID',
  `bank_card` varchar(80) NOT NULL DEFAULT '' COMMENT '���ֵ����п���',
  `auditer_id` int(11) NOT NULL DEFAULT '0' COMMENT '�����ID',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-ͬ�� 1-�ܾ�',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '��ע',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  `audite_time` int(10) NOT NULL DEFAULT '0' COMMENT '���ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;


ALTER TABLE `z_trades`
ROW_FORMAT=DYNAMIC;

ALTER TABLE `z_trades` PARTITION BY RANGE(id) (PARTITION `p0` VALUES LESS THAN (1000000) , PARTITION `p1` VALUES LESS THAN (2000000) , PARTITION `p2` VALUES LESS THAN (3000000) , PARTITION `p3` VALUES LESS THAN (4000000) , PARTITION `p4` VALUES LESS THAN (5000000) , PARTITION `p5` VALUES LESS THAN (6000000) , PARTITION `p6` VALUES LESS THAN (7000000) , PARTITION `p7` VALUES LESS THAN (8000000) , PARTITION `p8` VALUES LESS THAN (9000000) , PARTITION `p9` VALUES LESS THAN (10000000) , PARTITION `p10` VALUES LESS THAN (11000000) , PARTITION `p11` VALUES LESS THAN (12000000) , PARTITION `p12` VALUES LESS THAN (13000000) , PARTITION `p13` VALUES LESS THAN (14000000) , PARTITION `p14` VALUES LESS THAN (15000000) , PARTITION `p15` VALUES LESS THAN (16000000) , PARTITION `p16` VALUES LESS THAN (17000000) , PARTITION `p17` VALUES LESS THAN (18000000) , PARTITION `p18` VALUES LESS THAN (19000000) , PARTITION `p19` VALUES LESS THAN (20000000) , PARTITION `p20` VALUES LESS THAN (21000000) , PARTITION `p21` VALUES LESS THAN (22000000) , PARTITION `p22` VALUES LESS THAN (23000000) , PARTITION `p23` VALUES LESS THAN (24000000) , PARTITION `p24` VALUES LESS THAN (25000000) , PARTITION `p25` VALUES LESS THAN (26000000) , PARTITION `p26` VALUES LESS THAN (27000000) , PARTITION `p27` VALUES LESS THAN (28000000) , PARTITION `p28` VALUES LESS THAN (29000000) , PARTITION `p29` VALUES LESS THAN (MAXVALUE) ) ;

ALTER TABLE `z_trades`
ADD COLUMN `operate_channels`  varchar(255) NOT NULL DEFAULT '' COMMENT '��������' AFTER `take_off_fee_amount`;


DROP TABLE IF EXISTS `z_user_finance_statistics`;
CREATE TABLE `z_user_finance_statistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0' COMMENT '��ԱID',
  `amounts` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '���ý��',
  `collects` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '�ܴ��ս��',
  `profits` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '��������',
  `recharges` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '�ܳ�ֵ���',
  `withdrawals` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '�����ֽ��',
  `rewards` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '�����ܶ�',
  `red_packets` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '����ܶ�',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='�û��ʽ�ͳ�Ʊ�';
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_platform_funds`;
CREATE TABLE `z_platform_funds` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  ��amount` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT 'ƽ̨�����ʽ�'
  `recharge_fees` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '��ֵ������',
  `withdraw_cash_fees` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '��ֵ������',
  `red_packets` decimal(12,2) NOT NULL DEFAULT ��0.00�� COMMENT '����ܶ�'
  `cashed_red_packets` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '�Ѷ��ֺ��',
  `debt_transfer_fees` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT 'ծȨת������',
  `prepayment_penalty` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '��ǰ����ΥԼ��',
  `aged_fail` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '����ΥԼ��',
  `trade_fees_investor` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '���׷����-Ͷ����',
  `trade_fees_lender` decimal(12,2) NOT NULL DEFAULT '0.00' COMMENT '���׷����-������',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_assumption`;
CREATE TABLE `z_assumption` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `loan_id` int(11) NOT NULL DEFAULT '0' COMMENT '���ID',
  `loan_user_kd` int(11) NOT NULL DEFAULT '0' COMMENT '����˻�ԱID',
  `assumption_periods` smallint(3) NOT NULL DEFAULT '0' COMMENT '��������',
  `assumption_amount` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '�����ܽ��',
  `assumption_principal` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '��������',
  `assumption_interest` decimal(12,3) unsigned NOT NULL,
  `assumption_fine` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '��������',
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;


DROP TABLE IF EXISTS `z_member_rank`;
CREATE TABLE `z_member_rank` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `scores_range` varchar(80) NOT NULL DEFAULT '' COMMENT '���ַ�Χ',
  `rank_name` varchar(30) NOT NULL DEFAULT '' COMMENT '������',
  `is_enable` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0-���� 1-����',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_member_account`;
CREATE TABLE `z_member_account` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '��ԱID',
  `amount` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '���ý��',
  `frozen_amount` decimal(12,3) unsigned NOT NULL DEFAULT '0.000' COMMENT '������',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='�û��ʽ���ͳ�Ʊ�';
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_member_role_amount`;
CREATE TABLE `z_member_role_amount` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `role_type` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0-������� 1-��� 2-����  3-��ƽ� 4-��Ϣȯ',
  `role_number` varchar(20) NOT NULL,
  `created_at` int(10) NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;


DROP TABLE IF EXISTS `z_activity`;
CREATE TABLE `z_activity` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '��ԱID',
  `activity_name` varchar(80) NOT NULL DEFAULT '' COMMENT '�����',
  `activity_audience` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '����� 0-���� �������ݶ�Ӧrank_id',
  `activity_condition` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-���� 1-Ͷ���ܶ� 2-����Ͷ�� 3-����ܶ� 4-���������',
  `award_condition` decimal(10,2) NOT NULL DEFAULT '0.00' COMMENT '�������� ',
  `project_type` smallint(2) unsigned NOT NULL DEFAULT '0' COMMENT '0-������Ŀ ����Ϊfinancial_type��ID',
  `award_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '1-��� 2-��ƽ� 3-��Ϣȯ',
  `award_content` varchar(30) NOT NULL DEFAULT '' COMMENT '��Ʒ',
  `start_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '���ʼʱ��',
  `end_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�����ʱ��',
  `get_award_expiry_date` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '��Ʒ��ȡ��Чʱ��',
  `auditer_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '�����ID',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-����� 1-���ͨ�� 2-��˾ܾ� 3-��ͣ',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '��ע',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;


DROP TABLE IF EXISTS `z_activity_log`;
CREATE TABLE `z_activity_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '��ȡ��ID',
  `activity_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '�ID',
  `award_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-���� 1-Ͷ���ܶ� 2-����Ͷ�� 3-����ܶ� 4-���������',
  `outside_amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '�������',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-����ȡ 1-����ȡ',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '��ȡʱ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_member_recommend_friends`;
CREATE TABLE `z_member_recommend_friends` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '��ԱID',
  `recommend_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-��������',
  `recommender_user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '�Ƽ���ID',
  `level`  tinyint(1) NOT NULL DEFAULT 1 COMMENT '1-һ������ 2-��������'
  `created_at`  int(11) UNSIGNED NOT NULL DEFAULT '0' COMMENT '�Ƽ�ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_loans`;
CREATE TABLE `z_loans` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '������ID',
  `loaner_property`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0-���� 1-��ҵ',
  `auditer_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '�����ID',
  `cooperation_code` varchar(3) NOT NULL DEFAULT '' COMMENT '��ҵ����',
  `loan_amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '�����',
  `mini_investment_amount` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '��СͶ�ʶ�',
  `year_yield_rate` decimal(3,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '�껯����',
  `loan_bid_type` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-�±� 1-���',
  `term_of_loan` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '�������',
  `loan_type` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '�������financial_type_id',
  `repayment_type` smallint(3) unsigned NOT NULL DEFAULT '0' COMMENT '���ʽpayment_typ_id',
  `investment_award_type` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Ͷ�ʽ������� 0-������ 1-��� 2-��Ϣ',
  `need_password` varchar(255) NOT NULL DEFAULT '' COMMENT '����꣨����꣩',
  `qualification_information` varchar(20) NOT NULL DEFAULT '' COMMENT '������ϢID��',
  `load_content` text NOT NULL COMMENT '�������',
  `repayment_source` text NOT NULL COMMENT '������Դ',
  `repayment_guarantee` text NOT NULL COMMENT '�����',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-����� 1-����� 2-׼���� 3-��˾ܾ� 4-��ز��ϸ� 5-���� 6-���� 7-ת�� ',
  `remark` varchar(255) NOT NULL DEFAULT '' COMMENT '��ע',
  `created_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  `updated_at` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '�༭ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='����';
SET FOREIGN_KEY_CHECKS=1;

DROP TABLE IF EXISTS `z_aptitudes_loan`;
CREATE TABLE `z_aptitudes_loan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '�ϴ���ID',
  `loan_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '������ID',
  `aptitude_name` varchar(50) NOT NULL DEFAULT '' COMMENT '��������',
  `upload_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '�ļ�ID',
  `sorts` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '������Сֵ������ǰ',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='�����ص�������Ϣ';
SET FOREIGN_KEY_CHECKS=1;


############    20170705 
ALTER TABLE `z_loans`
ADD COLUMN `loaner_property`  tinyint(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0-���� 1-��ҵ' AFTER `user_id`;

ALTER TABLE `z_loans`
ADD COLUMN `cooperation_id`  int(11) UNSIGNED NOT NULL DEFAULT 0 COMMENT '��ҵID' AFTER `auditer_id`;

ALTER TABLE `z_loans`
MODIFY COLUMN `cooperation_code`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '��ҵ����' AFTER `cooperation_id`;


DROP TABLE IF EXISTS `z_loan_repayment`;
CREATE TABLE `z_loan_repayment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '������ID',
  `cooperation_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '������˾ID',
  `loan_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '���ID',
  `repayment_of_principal` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '��������',
  `interest_payable` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '������Ϣ',
  `repaymented_money` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '�ѻ����',
  `no_repayment_money` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT 'δ�����',
  `repayment_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '������',
  `repayment_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0-������ 1-���ֻ��� 2-ȫ������',
  `overdue_enalty_interest` decimal(12,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '���ڷ�Ϣ',
  `overdue_days` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT '��������',
  `repaymented_time` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '����ʱ��',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SET FOREIGN_KEY_CHECKS=1;

ALTER TABLE `z_member_account`
MODIFY COLUMN `amount`  decimal(12,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '���ý��' AFTER `user_id`,
MODIFY COLUMN `frozen_amount`  decimal(12,2) UNSIGNED NOT NULL DEFAULT 0.00 COMMENT '������' AFTER `amount`;

ALTER TABLE `z_loans`
ADD COLUMN `usage_of_loan`  varchar(255) NOT NULL DEFAULT '' COMMENT '�����;' AFTER `load_content`;

############    20170705 