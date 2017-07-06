<?php
namespace common\models;

use \yii\base\Model;

class EmailSmtpModel extends Model{
    public $smtp_link, $email,$smtp_password,$smtp_port,$smtp_protocol,$test_email;
    public function rules() {
        $rules=parent::rules();
        $_rules=[
            [['smtp_link','email','smtp_password','smtp_port'],'required']
        ];
        return \yii\helpers\ArrayHelper::merge($_rules, $rules);
    }
    
    public function attributeLabels() {
        $attribute_labels=parent::attributeLabels();
        $_attribute_labels=[
            'smtp_link'=>'smtp地址',
            'emial'=>'发信邮箱',
            'smtp_password'=>'smtp密码',
            'smtp_port'=>'smtp端口',
            'smtp_protocol'=>'smtp安全加密',
            'test_email'=>'测试接收邮箱'
            ];
        return \yii\helpers\ArrayHelper::merge($_attribute_labels, $attribute_labels);
    }   
}