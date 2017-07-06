<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%cooperations}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $company_name
 * @property string $company_address
 * @property string $company_number
 * @property string $legal_representative
 * @property integer $cooperation_start_time
 * @property integer $cooperation_end_time
 * @property integer $upload_id
 * @property integer $aptitude_ids
 * @property string $introduce
 * @property string $risk_management_mode
 * @property integer $is_forbidden
 * @property integer $status
 * @property string $remark
 * @property integer $auditer_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class CooperationsModel extends \yii\db\ActiveRecord
{
    public $aptitude_name;
    public $aptitudes;
    public $file;
    public $file_name;
    public $files;
    public $sorts;
    public $upid;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%cooperations}}';
    }
    
//    public function behaviors() {
//        $behavios=parent::behaviors();
//        $behavios['fileBehavior'] = [
//            
//			'class' => \nemmo\attachments\behaviors\FileBehavior::className(),
//            'model_name'=>$this->formName(),
//		];
//        return $behavios;
//    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_forbidden', 'status', 'auditer_id', 'created_at', 'updated_at'], 'integer'],
            [['company_name', 'company_address', 'introduce', 'risk_management_mode', 'remark'], 'string', 'max' => 255],
            [['company_number'], 'string', 'max' => 50],
            [['legal_representative'], 'string', 'max' => 20],
            ['user_id','safe'],
            ['user_id','existIt','on'=>['cooperation-add','cooperation-update']],//这个校验 existIt要在cooperationmodel.php增加方法
            [['cooperation_start_time', 'cooperation_end_time', /*'aptitude_ids'*/],'safe'],
            [
                [
                    //'file',
                    'company_name',
                    'company_number',
                    'legal_representative',
                    'cooperation_start_time',
                    'cooperation_end_time',
                    'introduce',
                    'risk_management_mode'
                ],'required','on'=>['cooperation-add','cooperation-update']
            ],
            ['id','integer','on'=>['cooperation-update']],
            ['id','required','on'=>['cooperation-update']],
            ['cooperation_end_time', 'compare','compareAttribute'=>'cooperation_start_time','operator'=>'>'],
            \yii\helpers\ArrayHelper::merge([['file','files'], 'file'], \Yii::$app->getModule('attachments')->rules)
            //[['file','files'], 'file', 'extensions' => 'jpg, png,jpeg', 'mimeTypes' => 'image/jpeg, image/png,image/jpg',],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '添加人ID',
            'company_name' => '企业名称',
            'company_address' => '公司地址',
            'company_number' => '企业编号',
            'legal_representative' => '法定代表人',
            'cooperation_start_time' => '合作开始时间',
            'cooperation_end_time' => '合作结束时间',
            //'upload_id' => '文件ID',
            //'aptitude_ids' => '资质ID组',
            'introduce' => '企业介绍',
            'risk_management_mode' => '风控模式',
            'is_forbidden' => '0－不禁用 1－禁用',
            'status' => '0－待审核 1－审核通过 2－审核拒绝',
            'remark' => '备注',
            'auditer_id' => '审核人ID',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'file'=>'文件'
        ];
    }
    
    public function existIt($attribute,$params){
        $exist=(new User())->find()->where(['id'=>$this->user_id])->orWhere(['like','username',$this->user_id])->scalar();
        if(!$exist){
            $error='该会员 '.$this->user_id.' 不存在';
            $this->addError($attribute, $error);
        }
    }
    
    public function getAptitudes($ids=[]){
        return \backend\logic\CooperationLogic::getInstance()->loadModel($this->formName())->getOne($ids);
    }
}
