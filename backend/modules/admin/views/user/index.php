<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '会员管理', 'url' => ['user-index']];
$this->params['breadcrumbs'][] = $this->title;

//$this->registerJsFile('@web/js/jquery.sparkline.min.js', ['depends'=>[\backend\assets\AppAsset::className()],'position'=>$this::POS_END]);

//$this->registerJsFile('@web/js/jquery.raty.min.js', ['depends'=>[\backend\assets\AppAsset::className()],'position'=>$this::POS_END]);
//$this->registerJsFile('@web/js/jquery.gritter.min.js', ['depends'=>[\backend\assets\AppAsset::className()],'position'=>$this::POS_END]);



//$this->registerJsFile('@web/js/pages/table.js', ['depends'=>[\backend\assets\AppAsset::className()],'position'=>$this::POS_END]);
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
                                echo \yii\bootstrap\Html::a('添加会员', ['user-add'], ['class'=>'btn btn-primary','title'=>'添加会员'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('查看帐户', 'javascript:void(0)', ['onclick'=>"commonDataOperate('get','','".yii\helpers\Url::to(['user-view'])."','','selection[]','input','checked',false,true,true)",'class'=>'btn btn-primary','title'=>'查看帐户'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('审核', 'javascript:void(0)', ['onclick'=>"commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','".yii\helpers\Url::to(['user-audit'])."','确定要审核吗','selection[]','input','checked',false,false,true)",'class'=>'btn btn-primary','title'=>'审核'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('屏蔽', 'javascript:void(0)', ['onclick'=>"commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','".yii\helpers\Url::to(['user-disable'])."','确定要屏蔽吗','selection[]','input','checked',false,false,true)",'class'=>'btn btn-primary','title'=>'屏蔽'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('会员交易记录', 'javascript:void(0)', ['onclick'=>"commonDataOperate('get','','".yii\helpers\Url::to(['user-accounts'])."','','selection[]','input','checked',true)",'class'=>'btn btn-primary','title'=>'屏蔽'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('重置密码', 'javascript:void(0)', ['onclick'=>"commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','".yii\helpers\Url::to(['user-reset-password'])."','确定要重置吗，请确定您勾选了要重置密码的ID，以免误操作','selection[]','input','checked',false,false,true)",'class'=>'btn btn-primary','title'=>'重置密码密码'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('发送私信', 'javascript:void(0)', ['onclick'=>"SendMessage('".yii\helpers\Url::to(['user-send-message','gourl'=>yii\helpers\Url::to(['user-index'])])."','".Yii::$app->getRequest()->getCsrfToken()."')",'class'=>'btn btn-primary','title'=>'发送消息'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('批量导入', 'javascript:void(0)', ['onclick'=>"commonDataOperate('get','','".yii\helpers\Url::to(['user-import-infos'])."','','selection[]','input','checked',2)",'class'=>'btn btn-primary','title'=>'导入会员信息'])."&nbsp;&nbsp;";
                                
                                
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
                                'attribute'=>'username',
                                'headerOptions' => ['class'=>'text-center'],
                            ],
                            [
                                'attribute'=>'mobile',
                                'headerOptions' => ['class'=>'text-center'],
                            ],
                            
                            [
                                'attribute' => '',
                                'label'=>'可用金额（元）',
                                'content' => function($model, $key, $index, $widget) {
                                    return 10000;
                                },
                                'headerOptions' => ['class'=>'text-center'],
                            ],
                            'email',
                            [
                                'attribute' => 'is_disable',
                                'label'=>'屏蔽',
                                'content' => function($model, $key, $index, $widget) {
                                    return $model->is_disable == 1 ? "屏蔽" : "正常";
                                },
                                'headerOptions' => ['class'=>'text-center'],
                            ],
//                            'real_name',
//                            'identification_card',
//                            'bank_card',
//                            'rank_id',
//                            'scores',
//                            'referee_id',
                            [
                                'attribute' => 'add_type',
                                'label'=>'是否后台添加',
                                'content' => function($model, $key, $index, $widget) {
                                    return $model->add_type == 1 ? "是" : "否";
                                },
                                'headerOptions' => ['class'=>'text-center'],
                            ],
                            [
                                'attribute' => 'login_ip',
                                'headerOptions' => ['class'=>'text-center'],
                            ],
                            
                        ];
                                echo \kartik\export\ExportMenu::widget([
                                    'dataProvider' => $list,
                                    'folder'=>'@backend/runtime/export',
                                    'columns' => $grid_columns,
                                    'fontAwesome' => true,
                                    'dropdownOptions' => [
                                        'label' => '导出所有',
                                        'class' => 'btn btn-default'
                                    ]
                                ])
                                //echo \yii\bootstrap\Html::a('查看帐户', ['javascript:onclick(view())'], ['class'=>'btn btn-primary btn-setting','title'=>'查看帐户'])."&nbsp;&nbsp;";
                                
                                //
                                //echo \yii\bootstrap\Html::a('审核', '#', ['onclick'=>'javascript:onclick(audit())','class'=>'btn btn-primary','title'=>'审核'])."&nbsp;&nbsp;";
                                //Pjax::begin(['id'=>'formdatalist']);
                                //$form=\yii\bootstrap\ActiveForm::begin(['action'=>yii\helpers\Url::to(['user-disable']),'options' => ['class'=>'form-horizontal','data-pjax' => 1,'id'=>'user-form']]);
                                //echo \yii\bootstrap\Html::submitButton('审核', ['class'=>'btn btn-primary','onclick'=>'javascript:$("#user-form").attr("action","'.yii\helpers\Url::to(['user-audit']).'")'])."&nbsp;&nbsp;";
                                //echo \yii\bootstrap\Html::a('屏蔽', ['user-disable'], ['data-method' => 'post','data-pjax' => 1,'data-action'=>yii\helpers\Url::to(['user-disable']),'data-confirm'=>'确定要屏蔽吗','class'=>'btn btn-primary','title'=>'屏蔽'])."&nbsp;&nbsp;";
                                //echo \yii\bootstrap\Html::submitButton('屏蔽', ['class'=>'btn btn-primary','onclick'=>'javascript:$("#user-form").attr("action","'.yii\helpers\Url::to(['user-disable']).'")'])."&nbsp;&nbsp;";
                                //echo \yii\bootstrap\Html::submitButton('查看帐户', ['class'=>'btn btn-primary','onclick'=>'javascript:$("#user-form").attr("action","'.yii\helpers\Url::to(['user-view']).'")'])."&nbsp;&nbsp;";
                                
                            ?>
                        </div>
                        <div class="text-left margin-bottom-sm margin-top-lg form-group">
                        <?php
                        echo $this->render('/user/_search', ['model' => $model]);
                        ?>
                        </div>
                    </div>
                </div>
                    
                    <?php 
                    
                    
                    echo \kartik\grid\GridView::widget([
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
                                'class' => 'kartik\grid\CheckboxColumn',
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

