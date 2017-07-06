<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%aptitudes_loan}}".
 *
 * @property integer $id
 * @property string $user_id
 * @property string $loan_id
 * @property string $aptitude_name
 * @property string $upload_id
 * @property integer $sorts
 */
class AptitudesLoanModel extends \yii\db\ActiveRecord
{
    public $aptitudes;
    public $file;
    public $file_name;
    public $files;
    public $upid;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%aptitudes_loan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'loan_id', 'upload_id'], 'integer'],
            //[['aptitude_name'], 'string', 'max' => 50],
            [['sorts','aptitude_name'],'safe'],
            \yii\helpers\ArrayHelper::merge([['file','files'], 'file'], \Yii::$app->getModule('attachments')->rules)
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '上传者ID',
            'loan_id' => '资质主ID',
            'aptitude_name' => '资质名称',
            'upload_id' => '文件ID',
            'sorts' => '排序',
        ];
    }
}
