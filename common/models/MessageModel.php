<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "z_message".
 *
 * @property string $id
 * @property integer $reid
 * @property integer $msg_type
 * @property integer $sender_id
 * @property integer $receiver_id
 * @property string $title
 * @property string $content
 * @property integer $created_at
 */
class MessageModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%message}}';
    }
    
    public function behaviors() {
        $behaviors=parent::behaviors();
        return \yii\helpers\ArrayHelper::merge($behaviors, [['class'=>\yii\behaviors\TimestampBehavior::className(),'attributes'=>[\yii\db\ActiveRecord::EVENT_AFTER_INSERT=>['created_at']]]]);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reid', 'msg_type', 'sender_id', 'created_at'], 'integer'],
            [['title'], 'string', 'max' => 30],
            [['content'], 'string', 'max' => 255],
            [['receiver_id','title','content'],'required','on'=>['user-send-message']],
            ['receiver_id','existIt','on'=>['user-send-message']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'reid' => '对方消息ID',
            'msg_type' => '消息类型 0-系统消息 1-管理消息 2-好友消息',
            'sender_id' => '发送者ID',
            'receiver_id' => '接收者ID',
            'title' => '消息标题',
            'content' => '消息内容',
            'created_at' => '发送时间',
        ];
    }
    
    public function existIt($attribute,$params){
        $exist=(new User())->find()->select('id')->where(['id'=>$this->receiver_id])->orWhere(['like','username',$this->receiver_id])->scalar();
        if(!$exist || $exist==0){
            $error='该会员 '.$this->receiver_id.' 不存在';
            $this->addError($attribute, $error);
        }
    }
}
