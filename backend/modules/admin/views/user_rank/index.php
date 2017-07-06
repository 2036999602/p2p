<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '会员级别管理', 'url' => ['user-rank-index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/bootstrap.min.js', ['depends' => [\backend\assets\AppAsset::className()], 'position' => $this::POS_END]);
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
            <?php
            //Pjax::begin(['id'=>'formdatalist']);
            //$form=\yii\bootstrap\ActiveForm::begin(['action'=>yii\helpers\Url::to(['user-disable']),'options' => ['data-pjax' => 0,'id'=>'user-form']]);
            ?>
            <div class="box-content text-center">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-left margin-bottom-sm form-group">
                            
                            <?php
                                echo \yii\bootstrap\Html::a('添加级别', ['user-rank-add'], ['class'=>'btn btn-primary','title'=>'添加组别'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('编辑', 'javascript:void(0)', ['onclick'=>"commonDataOperate('get','','".yii\helpers\Url::to(['user-rank-update'])."','','selection[]','input','checked',true)",'class'=>'btn btn-primary','title'=>'编辑'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('禁用', 'javascript:void(0)', ['onclick'=>"commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','".yii\helpers\Url::to(['user-rank-disable'])."','确定要禁用吗','selection[]','input','checked',false,false,true)",'class'=>'btn btn-primary','title'=>'禁用'])."&nbsp;&nbsp;";
                                
                                echo \yii\bootstrap\Html::a('删除', 'javascript:void(0)', ['onclick'=>"commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','".yii\helpers\Url::to(['user-rank-delete'])."','确定要删除吗','selection[]','input','checked',false,false,true)",'class'=>'btn btn-primary','title'=>'删除'])."&nbsp;&nbsp;";
                                
                                $grid_columns=[
                            
//                            [
//                                'class' => 'yii\grid\ActionColumn',
//                                'header' => '操作',
//                                'template' => '{view}{delete}{update}{audit}{disable}',
//                                'headerOptions' => [],
//                                'contentOptions' => [],
//                                'buttons' => [
//                                    'view'=>function($url,$model,$key){
//                                        return Html::a('查看', \yii\helpers\Url::to(['user-view','id'=>$model->id]), [
//                                            'title' => '查看',
//                                            'data-method' => 'post',
//                                            'data-pjax' => '0',
//                                            'class'=>'btn-xs btn-info',
//                                        ])."&nbsp;";
//                                    },
//                                    'update'=>function($url,$model,$key){
//                                        return Html::a('编辑', \yii\helpers\Url::to(['user-update','id'=>$model->id]), [
//                                            'title' => '编辑',
//                                            'data-method' => 'post',
//                                            'data-pjax' => '0',
//                                            'class'=>'btn-xs btn-success'
//                                        ])."&nbsp;";
//                                    },
//                                    'delete'=>function($url,$model,$key){
//                                        return Html::a('删除', \yii\helpers\Url::to(['user-delete','id'=>$model->id]), [
//                                            'title' => '删除',
//                                            'data-method' => 'post',
//                                            'data-pjax' => '1',
//                                            'data-confirm'=>'确定删除吗',
//                                            'class'=>'btn-xs btn-danger'
//                                        ])."&nbsp;";
//                                    },
//                                    'audit'=>function($url,$model,$key){
//                                        return Html::a('审核', \yii\helpers\Url::to(['user-audit','id'=>$model->id]), [
//                                            'title' => '审核',
//                                            'data-method' => 'post',
//                                            'data-pjax' => '0',
//                                            'data-confirm'=>'确定审核吗',
//                                            'class'=>'btn-xs btn-success'
//                                        ])."&nbsp;";
//                                    },
//                                    'disable'=>function($url,$model,$key){
//                                        return Html::a('屏蔽', \yii\helpers\Url::to(['user-disable','id'=>$model->id]), [
//                                            'title' => '屏蔽',
//                                            'data-method' => 'post',
//                                            'data-pjax' => '0',
//                                            'data-confirm'=>'确定屏蔽吗',
//                                            'class'=>'btn-xs btn-success'
//                                        ])."&nbsp;";
//                                    },
//                                ],
//                            ],
                            [
                                'attribute'=>'id',
                                'headerOptions' => ['class'=>'text-center'],
                            ],
                            [
                                'attribute'=>'scores_range',
                                'headerOptions' => ['class'=>'text-center'],
                            ],
                            [
                                'attribute'=>'rank_name',
                                'headerOptions' => ['class'=>'text-center'],
                            ],
                            
                            [
                                'attribute' => 'is_enable',
                                'label'=>'禁用',
                                'content' => function($model, $key, $index, $widget) {
                                    return Yii::$app->params['extend_params']['common_is_enable'][$model->is_enable];
                                },
                                'headerOptions' => ['class'=>'text-center'],
                            ],                            
                            
                        ];
                                
                            ?>
                        </div>
                        
                    </div>
                </div>
                    
                    <?php 
                    
                    
                    echo GridView::widget([
                    //echo \kartik\grid\GridView::widget([
                    //echo \kartik\export\ExportMenu::widget([
                        'dataProvider' => $list,
                        //'filterModel' => $searchModel,
                        //'caption' => '',
                        'layout' => "{items}\n{pager}",
                        //'options'=>['tag'=>false],
                        
//                        'tableOptions' => [
//                            'class' => 'table table-striped table-bordered bootstrap-datatable datatable dataTable',
//                            'id' => 'DataTables_Table_0',
//                            'aria-describedby' => 'DataTables_Table_0_info',
//                            
//                        ],
//                        'headerRowOptions' => [
//                            'role' => 'row',
//                            'class'=>'text-center',
//                        ],
//                        'rowOptions'=>[
//                            
//                        ],
                        'columns' => yii\helpers\ArrayHelper::merge([[
                                'class' => 'yii\grid\CheckboxColumn',
                                'headerOptions' => ['class'=>'text-center'],
                            ]],$grid_columns),
                    ]);
                    ?>

            </div>
            <?php 
            //\yii\bootstrap\ActiveForm::end();
            //Pjax::end(); 
            ?>
        </div>
    </div>

