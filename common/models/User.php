<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }
    
    
    /**
     * @inheritdoc
     */
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
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['username','required','on'=>['user-add']],            
            ['username','unique','targetClass' => '\common\models\User', 'message' => '用户名已存在.','on'=>['user-add','add']],
            ['password_hash','required','on'=>['user-add','add']],
            //['re_password_hash','required','on'=>['user-add']],
            //['cooperation_end_time', 'compare','compareAttribute'=>'cooperation_start_time','operator'=>'>'],
            //['re_password_hash', 'compare', 'compareAttribute'=>'password_hash','operator'=>'==','message'=>'两次密码不相同','on'=>['user-add']],
            ['email', 'required','on'=>['user-add']],
            ['email', 'email','on'=>['user-add']],
            ['email', 'unique','targetClass' => '\common\models\User', 'message' => '邮箱已存在.','on'=>['user-add']],
            ['mobile','integer','on'=>['user-add']],
            ['mobile','required','on'=>['user-add']],
            ['mobile','unique','targetClass' => '\common\models\User', 'message' => '手机号已存在.','on'=>['user-add']],
        ];
    }
    
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return \yii\base\Model::scenarios();
    }
    
    public function attributes() {
        $attributes=parent::attributes();
        array_push($attributes,'re_password_hash');
        //针对搜索增加attribute
        array_push($attributes,'search_select');
        array_push($attributes,'search_keyword');
        
        
        array_push($attributes, 'company_name');
        array_push($attributes, 'item_name');
        array_push($attributes, 'login_time');
        array_push($attributes, 'role_type');
        array_push($attributes, 'role_id');
        array_push($attributes, 'add_by');
        $ext_model=new \common\models\MemberExtModel();
        $attributes_ext=$ext_model->attributes();
        unset($attributes_ext[0]);
        $attribute_array=array_merge($attributes,$attributes_ext);        
        return $attribute_array;
    }
    
    public function attributeLabels()
    {
        $ext_model=new \common\models\MemberExtModel();
        $attributeLabels_ext=$ext_model->attributeLabels();        
        $attributeLabels=array_merge($attributeLabels_ext,[
            'id' => 'ID',
            'username' => '会员名',
            'password_hash' => '密码',
            're_password_hash' => '确认密码',
            'password_reset_token'=>'password_reset_token',
            'mobile' => '手机号',
            'email' => '邮箱',
            'is_disable' => '0－启用 1-禁用',
            'auth_key' => 'Auth Key',
            'status'=>'status',
            'created_at' => '创建时间',
            'search_select'=>'搜索下拉选择',
            'search_keyword'=>'搜索关键字'
        ]);
        return $attributeLabels; 
    }


    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {        
        return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
    
//    public function getMemberExt(){
//        return $this->hasOne(\common\models\MemberExtModel::className(),['user_id'=>'id']);
//    }
}
