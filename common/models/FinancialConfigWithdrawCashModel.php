<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%withdraw_cash}}".
 *
 * @property string $id
 * @property integer $user_id
 * @property string $amount
 * @property integer $bank_id
 * @property string $bank_card
 * @property integer $auditer_id
 * @property integer $status
 * @property string $remark
 * @property integer $created_at
 * @property integer $audite_time
 */
class FinancialConfigWithdrawCashModel extends \yii\db\ActiveRecord
{
    public $search_start_time;
    public $search_end_time;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%withdraw_cash}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'auditer_id', 'status', 'created_at', 'audite_time','bank_id'], 'integer'],
            [['amount'], 'number'],
            [['bank_card'], 'string', 'max' => 80],
            [['remark'], 'string', 'max' => 255],
            ['search_end_time','compare','compareAttribute'=>'search_start_time','operator'=>'>=','message'=>'搜索结束的时间必须大于搜索开始的时间'],
            ['user_id','safe'],
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
            'amount' => '提现金额',
            'bank_id'=>'银行ID',
            'bank_card' => '提现的银行卡号',
            'auditer_id' => '审核人ID',
            'status' => '0-同意 1-拒绝',
            'remark' => '备注',
            'created_at' => '申请时间',
            'audite_time' => '审核时间',
        ];
    }
}
