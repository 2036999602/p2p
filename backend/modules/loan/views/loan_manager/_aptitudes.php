<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CooperationModel */

$this->title = $title;
?>
<div class="cooperation-model-view">

    <?= \yii\grid\GridView::widget([
        'dataProvider' => $list,
        'columns' => [
            //'id',
            [
                'attribute'=>'aptitude_name',
                'label'=>'认证项目',
//                'format'=>'text',
                //'value'=>function($model){return $model->company_name;},
                'headerOptions'=>['class'=>'text-center']
            ],
            [
                'attribute'=>'id',
                'label'=>'图片预览',
//                'format'=>'text',
                'content'=>function($model){
                    return "<a target='_blank' href='".\yii\helpers\Url::to(['/attachments/file/show-image','id'=>$model->id])."'>".$model->file_name."</a>";
                },
                'headerOptions'=>['class'=>'text-center']
            ],              
        ],
    ]) ?>
</div>
