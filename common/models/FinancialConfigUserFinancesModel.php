<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_finance_statistics}}".
 *
 * @property string $id
 * @property integer $user_id
 * @property string $amounts
 * @property string $collects
 * @property string $profits
 * @property string $recharges
 * @property string $withdrawals
 * @property string $rewards
 * @property string $red_packets
 */
class FinancialConfigUserFinancesModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_finance_statistics}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['amounts', 'collects', 'profits', 'recharges', 'withdrawals', 'rewards', 'red_packets'], 'number'],
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
            'amounts' => '可用金额',
            'collects' => '待收总额',
            'profits' => '收益总额',
            'recharges' => '充值总额',
            'withdrawals' => '提现总额',
            'rewards' => '奖励总额',
            'red_packets' => '红包总额',
        ];
    }
}
