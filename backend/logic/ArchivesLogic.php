<?php
namespace backend\logic;

class ArchivesLogic extends \common\logic\baseLogic{
    public function delete($condition=[]){
        if(!empty($condition) && !is_array($condition) && is_numeric($condition)){
            $condition=['id'=>$condition];
        }        
        $result=$this->_model->deleteAll($condition);
        if($result){
            //删除附加表
            $addon_reuslt=$this->loadModel('ArticleModel')->getModel()->deleteAll(['archive_id'=>\yii\helpers\ArrayHelper::getValue($condition, 'id')]);
            if(!$addon_reuslt){
                \Yii::$app->session->setFlash('error', '删除附加表 article 信息失败');
            }
            
            //删除文件
            $files_model=$this->loadModel('UploadsModel')->getModel();
            $files=$files_model->find()->select('id')->where(['doc_id'=>\yii\helpers\ArrayHelper::getValue($condition, 'id'),'doc_model'=>'ArchivesModel'])->asArray()->all();
            if(!empty($files)){
                $file_module=\Yii::$app->getModule('attachments');
                foreach($files as $k=>$v){
                    $file_module->detachFile($v['id']);                    
                }
            }
            \Yii::$app->session->setFlash('success', '操作成功');
            return true;
        }
        \Yii::$app->session->setFlash('error', '操作失败');
        return false;
    }
}