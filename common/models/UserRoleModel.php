<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%user_role}}".
 *
 * @property string $id
 * @property string $role_type
 * @property string $role_id
 * @property integer $user_id
 */
class UserRoleModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_role}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['role_type'], 'string', 'max' => 50],
            [['role_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'role_type' => '关联的模型名',
            'role_id' => '关联的ID',
            'user_id' => '用户ID',
        ];
    }
}
