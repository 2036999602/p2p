<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%loan_repayment}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $cooperation_id
 * @property string $loan_id
 * @property string $repayment_of_principal
 * @property string $interest_payable
 * @property string $repaymented_money
 * @property string $no_repayment_money
 * @property string $repayment_time
 * @property integer $repayment_status
 * @property string $overdue_enalty_interest
 * @property integer $overdue_days
 * @property string $repaymented_time
 */
class LoanRepaymentModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%loan_repayment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'cooperation_id', 'loan_id', 'repayment_time', 'repayment_status', 'overdue_days', 'repaymented_time'], 'integer'],
            [['repayment_of_principal', 'interest_payable', 'repaymented_money', 'no_repayment_money', 'overdue_enalty_interest'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '还款人ID',
            'cooperation_id' => '合作公司ID',
            'loan_id' => '借款ID',
            'repayment_of_principal' => '待还本金',
            'interest_payable' => '待还利息',
            'repaymented_money' => '已还金额',
            'no_repayment_money' => '未还金额',
            'repayment_time' => '还款日',
            'repayment_status' => '0-待还款 1-部分还款 2-全部还清',
            'overdue_enalty_interest' => '逾期罚息',
            'overdue_days' => '逾期天数',
            'repaymented_time' => '还款时间',
        ];
    }
}
