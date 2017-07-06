<?php

namespace common\modules\upload\controllers;

use yii\web\Controller;

/**
 * Default controller for the `upload` module
 */
class FilesController extends Controller
{
    public $save_path;
    public $model;
    public $model_attribute;
    public $model_attributes;
    
    public $post;
    public $get;
    private $pjax_return_content;
    private $ids;
   
    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
        $this->pjax_return_content = false;
        $this->post = \Yii::$app->getRequest()->post();
        $this->get = \Yii::$app->getRequest()->get();
        $this->ids = isset($this->post['id']) ? (strrpos($this->post['id'], ",") ? explode(",", $this->post['id']) : [$this->post['id']]) : [];
        if (empty($this->ids) && isset($this->post['selection']) && !empty($this->post['selection'])) {
            $this->ids = $this->post['selection'];
        }
        if(empty($this->ids) && isset($this->get['id']) && !empty($this->get['id'])){
            $this->ids = strrpos($this->get['id'], ",") ? explode(",", $this->get['id']) : [$this->get['id']];
        }
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionUpload($addon_model_name='',$addon_attribute='',$addon_model_data=[]){
        if(empty($attribute) || empty($model_name)){
            return null;
        }
        $this->model=\common\logic\BaseLogic::getInstance()->loadModel($model_name)->getModel();
        $save_path='';
        if(isset($this->save_path['upload_root']) && !empty($this->save_path['upload_root'])){
            $save_path.=$this->save_path['upload_root'];
        }
        if(isset($this->save_path['upload_dir']) && !empty($this->save_path['upload_dir'])){
            $save_path.=DIRECTORY_SEPARATOR.$this->save_path['upload_dir'];
        }
        if(isset($this->save_path['upload_dir_use_uid']) && $this->save_path['upload_dir_use_uid']){
            $save_path.=DIRECTORY_SEPARATOR.\Yii::$app->user->id;
        }
        if(isset($this->save_path['upload_dir_use_date']) && !empty($this->save_path['upload_dir_use_date'])){
            $save_path.=DIRECTORY_SEPARATOR.date($this->save_path['upload_dir_use_date']);
        }
        $this->model->$attribute=\yii\web\UploadedFile::getInstance($this->model, $this->model->$attribute);
        if(!isset($this->save_path['upload_dir_use_true_file_name'])){
            $file_name=md5(microtime(true));
        }
    }
    
    public function actionDelete(){
        $msg=false;
        if(!empty($this->ids)){
            $uploads=\common\logic\BaseLogic::getInstance()->loadModel('UploadsModel')->getOne(['id'=>$this->ids]);
            
            //$result=\common\logic\BaseLogic::getInstance()->loadModel('UploadsModel')->delete(['id'=>$this->ids]);
            //if($result){
                //删除文件关联的文档
                //if(!empty($uploads) && $uploads->doc_id>0){
                    $doc_result=\common\logic\BaseLogic::getInstance()->loadModel($uploads->doc_model)->delete(['id'=>$uploads->doc_id]);
                    if(!$doc_result){
                        $msg.='删除'.$uploads->doc_model.'关联文档失败<br >';
                    }
                //}
                //删除文件
                foreach ($this->ids as $k=>$v) {
                    $file_result=\Yii::$app->runAction('/attachments/file/delete',['id'=>$v]);
                    if(!$file_result){
                        $msg.='删除 文件'.$v.'失败 <br />';
                    }
                }                
            //}
        }
        if(\Yii::$app->request->isAjax){
            echo json_encode(['status'=>$msg?1:0,'msg'=>$msg?$msg:"操作成功",'data'=>[]]);
        }else{
            return $this->render('delete', ['msg'=>$msg,'model'=>isset($uploads)?$uploads:new \common\models\UploadsModel()]);
        }
    }
}
