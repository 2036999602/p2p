<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%archives}}".
 *
 * @property string $id
 * @property integer $flag
 * @property integer $type_id
 * @property integer $user_id
 * @property string $title
 * @property string $introduce
 * @property string $litpic
 * @property integer $status
 * @property integer $is_disable
 * @property string $remark
 * @property integer $created_at
 * @property integer $updated_at
 */
class ArchivesModel extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%archives}}';
    }
    
    public function behaviors() {
        //$behavios=parent::behaviors();
        $behavios['fileBehavior'] = [
            'class' => \nemmo\attachments\behaviors\FileBehavior::className(),
            'model_name'=>$this->formName(),
	];
        $behavios['timestampBehavior'] = [
            'class' => \yii\behaviors\TimestampBehavior::className(),
	];
        $behavios['articleBehavior'] = [
            'class' => \backend\behaviors\ArticleBehavior::className(),
            'model_name'=>'ArticleModel',
	];
        return $behavios;
    }
    
    public function getInitialPreview(){
        
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['flag', 'user_id', 'status', 'created_at', 'updated_at','is_disable'], 'integer'],
            [['title'], 'string', 'max' => 60],
            [['introduce', 'upload_id'], 'string', 'max' => 255],
            [['type_id','remark'],'safe'],
            [['title','type_id'],'required','on'=>['add','update']],
            //[['title','type_id'],'on'=>['add','update']],
            \yii\helpers\ArrayHelper::merge([['file'], 'file'], \Yii::$app->getModule('attachments')->rules)
        ];
    }
    
    public function scenarios() {
        return \yii\base\Model::scenarios();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'flag' => '属性 0－普通 1－幻灯',
            'type_id' => '栏目ID',
            'user_id' => '会员ID',
            'title' => '标题',
            'introduce' => '简介',
            'upload_id' => '缩略图',
            'status' => '0－待审核 1－审核通过 2－审核拒绝',
            'is_disable'=>'0-正常 1-屏蔽',
            'remark'=>'备注',
            'created_at' => '发表时间',
            'updated_at' => '编辑时间',
        ];
    }
}
