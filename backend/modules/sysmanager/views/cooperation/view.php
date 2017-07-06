<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CooperationModel */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '企业管理', 'url' => ['cooperation-index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cooperation-model-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute'=>'company_name',
//                'label'=>'',
//                'format'=>'text',
                //'value'=>function($model){return $model->company_name;},
                'headerOptions'=>['class'=>'text-center']
            ],
            [
                'attribute'=>'company_number',
//                'label'=>'',
//                'format'=>'text',
                //'value'=>function($model){return $model->company_number;},
                'headerOptions'=>['class'=>'text-center']
            ],  
            [
                'attribute'=>'legal_representative',
//                'label'=>'',
//                'format'=>'text',
                //'value'=>function($model){return $model->legal_representative;},
                'headerOptions'=>['class'=>'text-center']
            ],
            [
                'attribute'=>false,
                'label'=>'合作时长',
//                'format'=>'text',
                'value'=>function($model){return date("Y-m-d",$model->cooperation_start_time)."-".date('Y-m-d',$model->cooperation_start_time);},
                'headerOptions'=>['class'=>'text-center']
            ],
            [
                'attribute'=>false,
                'label'=>'合同',
                'format'=>'raw',
                'value'=>function($model){
                    $file_infos=\backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel')->getFile(0,$model->id,0,0,true);
                    if(!empty($file_infos)){                        
                        return "<span>".$file_infos['file_name']."</span>".$file_infos['file_url'];
                    }
                    return $model->upload_id.",".$model->id.",".$model->user_id;
                },
                'headerOptions'=>['class'=>'text-center']
            ],
            [
                'attribute'=>'id',
                'label'=>'企业资质',
                'format'=>'raw',
                'value'=>function($model){
                    //$ids=strrpos($model->aptitude_ids,",")?['doc_id'=>explode(",", $model->aptitude_ids)]:['doc_id'=>$model->aptitude_ids];
                    //$ids=$model->id;
                    $ids=[];
                    $list=(new common\models\AptitudesModel())->find()->select('id')->where(['cooperation_id'=>$model->id])->all();
                    if(!empty($list)){
                        foreach($list as $k=>$v){
                            array_push($ids, $v['id']);
                        }
                        $ids=['u.doc_id'=>$ids];
                    }
                    return Yii::$app->view->render('/cooperation/_aptitudes', ['title'=>'','list'=>backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel')->setQueryModelName('AptitudesModel')->getAptitudesInfo($ids)]);                    
                },
                'headerOptions'=>['class'=>'text-center']
            ],
            [
                'attribute'=>'introduce',
                //'label'=>'',
//                'format'=>'text',
                //'value'=>function($model){return date("Y-m-d",$model->cooperation_start_time)."-".date('Y-m-d',$model->cooperation_start_time);},
                'headerOptions'=>['class'=>'text-center']
            ],
            [
                'attribute'=>'risk_management_mode',
                //'label'=>'',
//                'format'=>'text',
                //'value'=>function($model){return date("Y-m-d",$model->cooperation_start_time)."-".date('Y-m-d',$model->cooperation_start_time);},
                'headerOptions'=>['class'=>'text-center']
            ],
            [
                'attribute'=>'risk_management_mode',
                'label'=>'数据统计',
//                'format'=>'text',
                'content'=>function($model){return '待处理字段';},
                'headerOptions'=>['class'=>'text-center']
            ],
            [
                'attribute'=>'risk_management_mode',
                'label'=>'签约项目',
//                'format'=>'text',
                'content'=>function($model){return '待处理字段';},
                'headerOptions'=>['class'=>'text-center']
            ],
        ],
    ]) ?>
</div>
