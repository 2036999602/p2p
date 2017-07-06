<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%member_recommend_friends}}".
 *
 * @property string $id
 * @property string $user_id
 * @property integer $recommend_type
 * @property string $recommender_user_id
 * @property integer $level
 * @property string $created_at
 */
class MemberRecommendFriendsModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_recommend_friends}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'recommend_type', 'recommender_user_id', 'level', 'created_at'], 'integer'],
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
            'recommend_type' => '0-邀请链接',
            'recommender_user_id' => '好友ID',
            'level' => '1-一级好友 2-二级好友',
            'created_at' => '推荐时间',
        ];
    }
}
