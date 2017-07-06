<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%activity}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $activity_name
 * @property integer $activity_audience
 * @property integer $activity_condition
 * @property string $award_condition
 * @property integer $project_type
 * @property integer $award_type
 * @property string $award_content
 * @property string $start_time
 * @property string $end_time
 * @property string $get_award_expiry_date
 * @property string $auditer_id
 * @property integer $status
 * @property string $remark
 * @property string $created_at
 */
class ActivityModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%activity}}';
    }
    
    public function behaviors() {
        $behavios=parent::behaviors();
        $behavios['timestampBehaviors']=['class'=>\yii\behaviors\TimestampBehavior::className(),'attributes'=>[\yii\db\ActiveRecord::EVENT_AFTER_INSERT=>['created_at']]];
        return $behavios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'activity_audience', 'activity_condition', 'project_type', 'award_type',  'auditer_id', 'status', 'created_at'], 'integer'],
            [['award_condition'], 'number'],
            [['activity_name'], 'string', 'max' => 80],
            [['award_content'], 'string', 'max' => 30],
            [['remark'], 'string', 'max' => 255],
            
            [['start_time', 'end_time', 'get_award_expiry_date',],'safe'],
            ['end_time', 'compare','compareAttribute'=>'start_time','operator'=>'>','on'=>['add','update']],
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
            'activity_name' => '活动名称',
            'activity_audience' => '活动对象 0-所有 其它数据对应rank_id',
            'activity_condition' => '0-不限 1-投资总额 2-单笔投资 3-借款总额 4-邀请好友数',
            'award_condition' => '奖励条件 ',
            'project_type' => '0-所有项目 其它为financial_type的ID',
            'award_type' => '1-红包 2-理财金 3-加息券',
            'award_content' => '奖品',
            'start_time' => '活动开始时间',
            'end_time' => '活动结束时间',
            'get_award_expiry_date' => '奖品领取有效时间',
            'auditer_id' => '审核人ID',
            'status' => '0-待审核 1-审核通过 2-审核拒绝 3-暂停',
            'remark' => '备注',
            'created_at' => '创建时间',
        ];
    }
}
