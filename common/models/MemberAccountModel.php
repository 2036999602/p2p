<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%member_account}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $amount
 * @property string $frozen_amount
 */
class MemberAccountModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_account}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['amount', 'frozen_amount'], 'number'],
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
            'amount' => '可用金额',
            'frozen_amount' => '冻结金额',
        ];
    }
}
