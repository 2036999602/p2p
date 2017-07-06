<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%archives_type}}".
 *
 * @property integer $id
 * @property string $module_name
 * @property integer $parent_id
 * @property string $type_name
 * @property string $introduce
 * @property integer $is_cover
 * @property string $template_name
 * @property integer $created_at
 */
class ArchivesTypeModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%archives_type}}';
    }
    
    public function behaviors() {
        $behvios_p=parent::behaviors();
        $behvios=[
            'class'=>\yii\behaviors\TimestampBehavior::className(),
            'attributes'=>[
                \yii\db\ActiveRecord::EVENT_BEFORE_INSERT=>['created_at']
            ]
        ];
        array_push($behvios_p, $behvios);
        return $behvios_p;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'is_cover'], 'integer'],
            [['type_name'], 'required','on'=>['type-add','type-update']],
            [['module_name', 'type_name'], 'string', 'max' => 50],
            ['type_name','existName'],
            [['introduce', 'template_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'module_name' => '隶属模块名',
            'parent_id' => '上级ID',
            'type_name' => '栏目名称',
            'introduce' => 'Introduce',
            'is_cover' => '0-是封面 1-不是封面',
            'template_name' => '模板名称',
            'created_at'=>'创建时间'
        ];
    }
    
    public function existName($attribute,$params){
        $result=$this->find()->select('id')->where(['type_name'=>$this->type_name])->scalar();
        if($result){
            $this->addError($attribute, '存在相同栏目名');
        }
    }
}
