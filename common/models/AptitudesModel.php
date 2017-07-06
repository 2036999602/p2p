<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%aptitudes}}".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $aptitude_id
 * @property string $aptitude_name
 * @property integer $upload_id
 * @property integer $sort
 */
class AptitudesModel extends \yii\db\ActiveRecord
{
    public $file;
    public $files;
    //public $uploadfiles;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%aptitudes}}';
    }
    
//    public function behaviors() {
//        $behavios=parent::behaviors();
//        $behavios['fileBehavior'] = [
//            
//			'class' => \nemmo\attachments\behaviors\FileBehavior::className(),
//                        'model_name'=>$this->formName(),
//		];
//        return $behavios;
//    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cooperation_id'], 'integer'],
            //[['aptitude_name'], 'string', 'max' => 50],
            [['aptitude_name', 'sorts'],'safe'],
            //['uploadfiles','file', 'skipOnEmpty' => false, 'extensions' => 'gif, jpg,png,jpeg', 'mimeTypes' => 'image/jpeg, image/png,image/jpg']
            [['file','files'], 'file', 'extensions' => 'jpg, png,jpeg', 'mimeTypes' => 'image/jpeg, image/png,image/jpg',],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            //'user_id' => '上传者ID',
            'cooperation_id' => '资质主ID',
            'aptitude_name' => '资质名称',
            'sorts' => '排序，最值值优先排前',
        ];
    }
}
