<?php 
return array (
  'member_info' => 
  array (
    'sex' => 
    array (
      0 => '女',
      1 => '男',
    ),
    'marriage' => 
    array (
      0 => '未婚',
      1 => '已婚',
    ),
  ),
  'user_status' => 
  array (
    0 => '待审核',
    10 => '已审核',
  ),
  'doc_status' => 
  array (
    0 => '待审核',
    1 => '已审核',
    2 => '审核拒绝',
  ),
  'doc_disable_status' => 
  array (
    0 => '正常',
    1 => '屏蔽',
  ),
  'common_is_enable' => 
  array (
    0 => '禁用',
    1 => '启用',
  ),
  'disable_status' => 
  array (
    0 => '正常',
    1 => '屏蔽',
  ),
  'trade_type' => 
  array (
    0 => '未知交易类型',
    1 => '充值',
    2 => '提现',
    3 => '收款',
    4 => '项目收款',
  ),
  'trade_status' => 
  array (
    0 => '待交易',
    1 => '交易完成',
    2 => '交易失败',
    3 => '重新发起交易',
    4 => '重新交易成功',
    5 => '重新交易失败',
  ),
  'activity_join_type' => 
  array (
    0 => '不限',
    1 => '投资总额',
    2 => '单笔投资',
    3 => '借款总额',
    4 => '邀请好友数',
  ),
  'activity_status' => 
  array (
    0 => '待审核',
    1 => '已审核',
    2 => '审核拒绝',
    3 => '暂停',
  ),
  'outsite_amount_type' => 
  array (
    0 => '请选择',
    1 => '红包',
    2 => '理财金',
    3 => '加息券',
  ),
  'outsite_amount_type_addon_value' => 
  array (
    0 => '',
    1 => '元',
    2 => '元',
    3 => '%',
  ),
  'has_get_outsite_amount' => 
  array (
    0 => '未领取',
    1 => '已领取',
  ),
  'withdraw_cash_status' => 
  array (
    0 => '待处理',
    1 => '同意',
    2 => '拒绝',
  ),
  'loan_bid_type'=>
  array(
      0=>'月标',
      1=>'天标'
  ),
  'loaner_property'=>
    array(
        0 => '个人',
        1=>'企业'
    ),
  'investment_award_type'=>
   array(
       0=>'不奖励',
       1=>'红包',
       2=>'加息'
   ),
  'loan_status' => 
  array (
    0 => '待审核',
    1 => '已审核',
    2 =>'准备标',
    3 =>'审核拒绝',
    4 =>'风控不合格',
    5 =>'标满',
    6 =>'流标',
    7 =>'转让'
  ),
  'banks' => 
  array (
    1 => '中国工商银行',
  ),
  'sysconfig' => 
  array (
    '大法师' => '1',
  ),
  'financial_type' => 
  array (
    '新手标' => '新手标',
    '企信贷' => '企信贷款',
    '定向标' => '定向标',
  ),
  'payment_type' => 
  array (
    '等额本息' => '等额本息还款法是在每月还款期内，每月偿还同等金额的借款（包括本金和利息）。借款人每月还款额中的本金比重逐……',
    '先息后本' => '先息后本还款法是指每月偿还相同额度的利息，借款到期日一次性归还借款本金。',
  ),
  'email_smtp_config' => 
  array (
    'smtp_link' => 'smtp.qq3.com',
    'email' => 'stadt@qq.com',
    'smtp_password' => 'aaaaaa',
    'smtp_port' => '993',
    'smtp_protocol' => NULL,
    'test_email' => NULL,
  ),
  'message_reminder_config' => 
  array (
    'get_repayment' => 
    array (
      0 => 'to_sms',
    ),
    'cash_dividends' => 
    array (
      0 => 'to_email',
    ),
    'loan_success' => 
    array (
      0 => 'in_site',
    ),
    'recharge_success' => 
    array (
      0 => 'to_sms',
      1 => 'to_email',
      2 => 'in_site',
    ),
    'fund_change' => 
    array (
      0 => 'to_sms',
      1 => 'in_site',
    ),
  ),
);