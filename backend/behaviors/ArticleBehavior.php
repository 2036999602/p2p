<?php
/**
 * Created by PhpStorm.
 * User: Алимжан
 * Date: 27.01.2015
 * Time: 12:24
 */

namespace backend\behaviors;

use yii\db\ActiveRecord;

class ArticleBehavior extends \yii\base\Behavior
{
    public $model_name;
    
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'save',
            ActiveRecord::EVENT_AFTER_UPDATE => 'update',
            ActiveRecord::EVENT_AFTER_DELETE => 'delete',            
        ];
    }

    public function save($event)
    {
        if(!empty($this->model_name) && !empty($this->owner->id)){
            $id=$this->owner->id;
            $model = \common\logic\BaseLogic::getInstance()->loadModel($this->model_name)->getOne(['archive_id'=>$id]);
            if($model->load(\Yii::$app->getRequest()->post()) && $model->validate()){
                $model->archive_id=$id;
                $result=$model->save();
                if(!$result){
                    $error=$model->getFirstErrors();
                    if(!empty($error)){
                        \Yii::$app->session->setFlash('error', implode(",", $error));
                    }
                }
            }else{
                $error=$model->getFirstErrors();
                if(!empty($error)){
                    \Yii::$app->session->setFlash('error', implode(",", $error));
                }
            }
        }
    }

    public function delete($event)
    {
        if(!empty($this->model_name) && !empty($this->owner->id)){
            $id=$this->owner->id;
            \Yii::$app->session->setFlash('warning', $this->owner->id."|".$id.str_replace('model', '', strtolower($this->model_name)).'信息');
            $result = \common\logic\BaseLogic::getInstance()->loadModel($this->model_name)->delete(['archive_id'=>$id]);
            if(!$result){
                \Yii::$app->session->setFlash('error', $id.'删除附加表'.str_replace('model', '', strtolower($this->model_name)).'信息失败');
            }
        }
    }
    
    public function update($event)
    {
        if(!empty($this->model_name) && !empty($this->owner->id)){
            $id=$this->owner->id;
            $model = \common\logic\BaseLogic::getInstance()->loadModel($this->model_name)->getOne(['archive_id'=>$id]);
            if($model->load(\Yii::$app->getRequest()->post()) && $model->validate()){
                $model->archive_id=$id;
                $result=$model->save();
                if(!$result){
                    $error=$model->getFirstErrors();
                    if(!empty($error)){
                        \Yii::$app->session->setFlash('error', implode(",", $error));
                    }
                }
            }else{
                $error=$model->getFirstErrors();
                if(!empty($error)){
                    \Yii::$app->session->setFlash('error', implode(",", $error));
                }
            }
        }
    }
}