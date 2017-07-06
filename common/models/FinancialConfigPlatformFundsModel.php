<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%platform_funds}}".
 *
 * @property string $id
 * @property string $amount 
 * @property string $recharge_fees
 * @property string $withdraw_cash_fees
 * @property string $red_packets
 * @property string $cashed_red_packets
 * @property string $debt_transfer_fees
 * @property string $prepayment_penalty
 * @property string $aged_fail
 * @property string $trade_fees_investor
 * @property string $trade_fees_lender
 */
class FinancialConfigPlatformFundsModel extends \yii\db\ActiveRecord
{
    public $recharge_amount;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%platform_funds}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['amount','recharge_fees', 'withdraw_cash_fees', 'red_packets', 'cashed_red_packets', 'debt_transfer_fees', 'prepayment_penalty', 'aged_fail', 'trade_fees_investor', 'trade_fees_lender'], 'number'],
            ['recharge_amount','required','on'=>['platform-funds-recharge']],
            ['recharge_amount', 'integer','min'=>0.01,'integerPattern'=>'/^\s*[+]?\d+\s*$/','message'=>'金额必须是正整数']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'amount' => '平台可用资金',
            'recharge_fees' => '充值手续费',
            'withdraw_cash_fees' => '充值手续费',
            'red_packets' => 'Red Packets',
            'cashed_red_packets' => '已兑现红包',
            'debt_transfer_fees' => '债权转让收入',
            'prepayment_penalty' => '提前还款违约金',
            'aged_fail' => '逾期违约金',
            'trade_fees_investor' => '交易服务费-投资人',
            'trade_fees_lender' => '交易服务费-贷款人',
            'recharge_amount' => '充值金额',
        ];
    }
}
