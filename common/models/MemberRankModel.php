<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%member_rank}}".
 *
 * @property string $id
 * @property string $scores_range
 * @property string $rank_name
 * @property integer $is_enable
 */
class MemberRankModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_rank}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_enable'], 'integer'],
            [['scores_range'], 'string', 'max' => 80],
            [['rank_name'], 'string', 'max' => 30],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'scores_range' => '积分范围',
            'rank_name' => '级别名',
            'is_enable' => '0-禁用 1-启用',
        ];
    }
}
