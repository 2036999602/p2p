<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%financial_config_cost}}".
 *
 * @property string $id
 * @property string $cost_name
 * @property string $expense_ratio
 * @property string $amount
 * @property string $investor_ratio
 * @property string $platform_ratio
 * @property string $cooperation_ratio
 */
class FinancialConfigCostModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%financial_config_cost}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['expense_ratio', 'amount', 'investor_ratio', 'platform_ratio', 'cooperation_ratio'], 'number'],
            [['cost_name'], 'string', 'max' => 255],
            [['expense_ratio', 'amount', 'investor_ratio', 'platform_ratio', 'cooperation_ratio','cost_name'],'required','on'=>['cost-add','cost-update']]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cost_name' => '费用名称',
            'expense_ratio' => '费用占比',
            'amount' => '金额',
            'investor_ratio' => '投资人占比',
            'platform_ratio' => '平台占比',
            'cooperation_ratio' => '合作企业占比',
        ];
    }
}
