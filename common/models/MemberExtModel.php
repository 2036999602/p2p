<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%member_ext}}".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $sex
 * @property string $real_name
 * @property string $identification_card
 * @property string $bank_card
 * @property integer $rank_id
 * @property integer $scores
 * @property integer $add_type
 * @property integer $referee_id
 * @property string $education_background
 * @property integer $marriage
 * @property string $address
 * @property integer $trade
 * @property string $professional_title
 * @property integer $login_ip
 * @property integer $login_time
 */
class MemberExtModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member_ext}}';
    }    
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'sex', 'rank_id', 'scores', 'add_type', 'referee_id', 'marriage',  'trade','login_time'], 'integer'],
            [['real_name'], 'string', 'max' => 10],
            [['identification_card'], 'string', 'max' => 18],
            [['bank_card', 'education_background'], 'string', 'max' => 30],
            [['professional_title'], 'string', 'max' => 50],
            [['address',],'string','max'=>255],
            [[ 'login_ip'],'safe']
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
            'sex' => '0－女 1－男',
            'real_name' => '姓名',
            'identification_card' => '身份证',
            'bank_card' => '银行卡号',
            'rank_id' => '级别ID',
            'scores' => '积分',
            'add_type' => '0－前台注册 1－后台增加',
            'referee_id' => '推荐user_id',
            'education_background' => '学历',
            'marriage' => '0－未婚 1－已婚',
            'address' => '住址',
            'trade' => '所属行业',
            'professional_title' => '职称',
            'login_ip' => 'IP',
            'login_time'=>'登录时间'
        ];
    }
}
