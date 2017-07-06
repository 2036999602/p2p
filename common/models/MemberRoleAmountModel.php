<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%member_role_amount}}".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $role_type
 * @property string $role_number
 * @property integer $created_at
 */
class MemberRoleAmountModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_role_amount}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'role_number'], 'required'],
            [['user_id', 'role_type', 'created_at'], 'integer'],
            [['role_number'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'role_type' => '0-正常金额 1-红包 2-奖励  3-理财金 4-加息券',
            'role_number' => 'Role Number',
            'created_at' => '创建时间',
        ];
    }
}
