<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%trades}}".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $trade_type
 * @property string $amount
 * @property string $fee
 * @property string $take_off_fee_amount
 * @property string $operate_channels
 * @property integer $status
 * @property string $remark
 * @property integer $created_at
 */
class FinancialConfigTradesModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%trades}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','user_id', 'trade_type', 'status', 'created_at'], 'integer'],
            [['amount', 'fee', 'take_off_fee_amount'], 'number'],
            [['remark','operate_channels'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '会员ID',
            'trade_type' => '交易类型 1-充值 2-提现 3-收款 4-项目收款',
            'amount' => '交易金额',
            'fee' => '手续费',
            'take_off_fee_amount' => '到账金额',
            'operate_channels' => '操作渠道',
            'status' => '状态',
            'remark' => '备注',
            'created_at' => '创建时间',
        ];
    }
}
