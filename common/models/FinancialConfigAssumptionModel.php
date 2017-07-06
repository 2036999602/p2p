<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%assumption}}".
 *
 * @property string $id
 * @property integer $loan_id
 * @property integer $loan_user_id
 * @property integer $assumption_periods
 * @property string $assumption_amount
 * @property string $assumption_principal
 * @property string $assumption_interest
 * @property string $assumption_fine
 * @property integer $created_at
 */
class FinancialConfigAssumptionModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%assumption}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['loan_id', 'loan_user_id', 'assumption_periods', 'created_at'], 'integer'],
            [['assumption_amount', 'assumption_principal', 'assumption_interest', 'assumption_fine'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loan_id' => '借款ID',
            'loan_user_id' => '借款人会员ID',
            'assumption_periods' => '代还期数',
            'assumption_amount' => '代还总金额',
            'assumption_principal' => '代还本金',
            'assumption_interest' => '代还利息',
            'assumption_fine' => '代还罚金',
            'created_at' => '代还时间',
        ];
    }
}
