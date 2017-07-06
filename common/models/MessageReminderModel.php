<?php
namespace common\models;

use \yii\base\Model;

class MessageReminderModel extends Model{
    public $get_repayment, $cash_dividends,$loan_success,$recharge_success,$fund_change;    
    
    public function rules() {
        $rules=parent::rules();
        $_rules=[
            [['get_repayment', 'cash_dividends','loan_success','recharge_success','fund_change'],'safe']
        ];
        return \yii\helpers\ArrayHelper::merge($_rules, $rules);
    }
    
    public function attributeLabels() {
        $attribute_labels=parent::attributeLabels();
        $_attribute_labels=[
            'get_repayment'=>'收到还款',
            'cash_dividends'=>'提现成功',
            'loan_success'=>'借款成功',
            'recharge_success'=>'充值成功',
            'fund_change'=>'资金变化',
            ];
        return \yii\helpers\ArrayHelper::merge($_attribute_labels, $attribute_labels);
    }   
}