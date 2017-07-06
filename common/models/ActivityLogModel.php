<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%activity_log}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $activity_id
 * @property integer $award_type
 * @property string $outside_amount
 * @property integer $status
 * @property string $created_at
 */
class ActivityLogModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'activity_id', 'award_type', 'status', 'created_at'], 'integer'],
            [['outside_amount'], 'number'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '领取人ID',
            'activity_id' => '活动ID',
            'award_type' => '0-自由 1-投资总额 2-单笔投资 3-借款总额 4-邀请好友数',
            'outside_amount' => '金额数量',
            'status' => '0-待领取 1-已领取',
            'created_at' => '领取时间',
        ];
    }
}
