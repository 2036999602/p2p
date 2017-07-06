<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%sys_config}}".
 *
 * @property string $id
 * @property string $param_name
 * @property string $params
 */
class SysConfigModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%sys_config}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['param_name'], 'string', 'max' => 50],
            //[['params'], 'string', 'max' => 255],
            [['params'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'param_name' => '参数名',
            'params' => '参数',
        ];
    }
}
