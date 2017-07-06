<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CooperationModel */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '文档管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-model-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute'=>'title',
//                'label'=>'',
//                'format'=>'text',
                //'value'=>function($model){return $model->company_name;},
                'headerOptions'=>['class'=>'text-center']
            ],
            [
                'attribute'=>'type_id',
                'label'=>'栏目',
//                'format'=>'text',
                'value'=>function($model){return backend\logic\ArchivesLogic::getInstance()->loadModel('ArchivesTypeModel')->getModel()->find()->select('type_name')->where(['id'=>$model->type_id])->scalar();},
                'headerOptions'=>['class'=>'text-center']
            ],  
            [
                'attribute'=>false,
                'label'=>'内容',
                'format'=>'raw',
                'value'=>function($model){return backend\logic\ArchivesLogic::getInstance()->loadModel('ArticleModel')->getModel()->find()->select('content')->where(['archive_id'=>$model->id])->scalar();},
                'headerOptions'=>['class'=>'text-center']
            ], 
        ],
    ]) ?>
</div>
