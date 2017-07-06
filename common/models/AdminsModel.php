<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%admin}}".
 *
 * @property integer $id
 * @property string $user_name
 * @property string $password_hash
 * @property integer $level
 * @property string $auth_key
 * @property integer $created_at
 * @property integer $updated_at
 */
class AdminsModel extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $company_name;
    public $item_name;
    public $role_type;
    public $role_id;
    public $username;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin}}';
    }
    
    public function behaviors() {
        $behaviors=parent::behaviors();
        $behaviors['timestamBehaviors']=['class'=>\yii\behaviors\TimestampBehavior::className()];
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level', 'created_at', 'updated_at','add_by'], 'integer'],
            [['user_name'], 'string', 'max' => 50],
            [['password_hash'], 'string', 'max' => 80],
            [['auth_key'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_name' => '管理员名称',
            'password_hash' => 'hash密码',
            'level' => '0-超级管理员 1－普通管理员',
            'auth_key' => '密码验证键',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'company_name'=>'所属企业',
            'item_name'=>'所属角色',
            'add_by'=>'添加人ID'
        ];
    }
    
    public static function findByUsername($username)
    {
        return static::findOne(['user_name' => $username]);
    }
    
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }
    
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    
    public function getAuthKey()
    {
        return $this->auth_key;
    }
    public function getId()
    {
        return $this->getPrimaryKey();
    }
    
    
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
    
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
    
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
}
