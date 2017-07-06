<?php
namespace common\models;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class FileForm extends \yii\base\Model{
    public $file;
    public function rules()
    {
        return [
            //[['']],
            //[['file'],'required'],
            [['file'], 'file', 'extensions' => 'txt', 'mimeTypes' => 'application/x-txt-compressed,text/plain',],
        ];
    }
    public function attributeLabels() {
        $labels=parent::attributeLabels();
        return \yii\helpers\ArrayHelper::merge($labels, ['file'=>'文件']);
    }
    
    public function save(){
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
    
}



