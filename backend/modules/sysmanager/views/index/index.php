<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '系统管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


$this->registerJsFile('@web/js/bootstrap.min.js', ['depends'=>[\backend\assets\AppAsset::className()],'position'=>$this::POS_END]);

?>

    <div class="col-lg-12">
        <div class="box">            
            <div class="box-header" data-original-title="<?= Html::encode($this->title) ?>">
                <h2>
                    <i class="fa fa-user"></i>
                    <span class="break"></span>
                    <?= Html::encode($this->title) ?>
                </h2>
                <div class="box-icon">
                    <a href="#" class="btn-setting"><i class="fa fa-wrench"></i></a>
                    <a href="#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                    <a href="#" class="btn-close"><i class="fa fa-times"></i></a>
                </div>
            </div>

            <div class="box-content text-center">
                <div class="row">
                    <div class="col-lg-12">
                    <p class="text-left">
                        <?php
                        echo \yii\bootstrap\Html::a('修改密码', ['/admin/index/user-reset-password','id'=>Yii::$app->user->id], [ 'class' => 'btn btn-primary', 'alt' => '修改密码']);
                        
                        ?>
                    </p></div>
                </div>
                    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            [
                'attribute'=>'company_name',
                'label'=>'所属企业',
//                'format'=>'text',
                //'value'=>function($model){return $model->company_name;},
                'headerOptions'=>['class'=>'text-center']
            ],
            [
                'attribute'=>'item_name',
                'label'=>'角色',
//                'format'=>'text',
                //'value'=>function($model){return $model->company_number;},
                'headerOptions'=>['class'=>'text-center']
            ],  
            [
                'attribute'=>'username',
//                'label'=>'',
//                'format'=>'text',
                //'value'=>function($model){return $model->legal_representative;},
                'headerOptions'=>['class'=>'text-center']
            ],
            [
                'attribute'=>'created_at',
                'label'=>'开通时间',
//                'format'=>'text',
                //'value'=>function($model){return date("Y-m-d",$model->cooperation_start_time)."-".date('Y-m-d',$model->cooperation_start_time);},
                'headerOptions'=>['class'=>'text-center']
            ],
            [
                'attribute'=>'login_time',
                'label'=>'上次登录时间',
                //'format'=>'raw',
                'value'=>function($model){                    
                    return date("Y-m-d",$model->login_time);
                },
                'headerOptions'=>['class'=>'text-center']
            ],            
        ],
    ]) ?>

            </div>
        </div>
    </div>