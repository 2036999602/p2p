<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%uploads}}".
 *
 * @property string $id
 * @property integer $user_id
 * @property integer $type_id
 * @property integer $doc_id
 * @property integer $doc_model
 * @property string $file_path
 * @property string $file_name
 * @property string $file_type
 * @property string $file_size
 * @property string $file_hash
 * @property string $file_mime
 * @property string $fdfs_storage_host
 * @property string $fdfs_filename
 * @property string $fdfs_path
 * @property integer $created_at
 * @property integer $updated_at
 */
class UploadsModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%uploads}}';
    }
    
//    public function behaviors() {
//        $behavios=parent::behaviors();
//        $behavios['fileBehavior'] = [
//			'class' => \nemmo\attachments\behaviors\FileBehavior::className()
//		];
//        return $behavios;
//    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'type_id', 'doc_id', 'created_at', 'updated_at'], 'integer'],
            [['file_path', 'fdfs_storage_host', 'fdfs_filename','file_hash','file_mime','file_alt'], 'string', 'max' => 255],
            [['file_name', 'fdfs_path'], 'string', 'max' => 80],
            [['file_type'], 'string', 'max' => 15],
            [['file_size'], 'string', 'max' => 20],
            ['doc_model','string','max'=>100],            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => '会员ID',
            'type_id' => '栏目ID',
            'doc_id' => '文档ID',
            'doc_model' => '文档类型 0－文章类(article) 1－会员类(member) 2-企业类(cooperation)',
            'file_path' => '文件路径',
            'file_name' => '文件名',
            'file_type' => '文件类型',
            'file_size' => '文件大小',
            'file_hash' => '文件名md5',
            'file_mime' =>'文件头mime类型',
            'file_alt' => '文件标题',
            'fdfs_storage_host' => 'fastdfs链接主机',
            'fdfs_filename' => 'fastdfs文件名',
            'fdfs_path' => 'fastdfs群组路径',
            'created_at' => '上传时间',
            'updated_at' => '更新时间',
        ];
    }
}
