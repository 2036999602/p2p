<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%financial_type}}".
 *
 * @property string $id
 * @property string $financial_name
 * @property string $financial_value
 */
class FinancialTypeModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%financial_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['financial_name'], 'string', 'max' => 50],
            [['financial_value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'financial_name' => '理财项目名',
            'financial_value' => '理财项目设置值',
        ];
    }
}
