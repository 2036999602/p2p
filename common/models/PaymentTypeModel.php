<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%payment_type}}".
 *
 * @property string $id
 * @property string $payment_name
 * @property string $payment_value
 */
class PaymentTypeModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%payment_type}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payment_name'], 'string', 'max' => 50],
            [['payment_value'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payment_name' => '还款方式名',
            'payment_value' => '还款方式描述',
        ];
    }
}
