<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '提现申请', 'url' => ['withdraw-cash-index']];
$this->params['breadcrumbs'][] = $this->title;


//$this->registerJsFile('@web/js/bootstrap.min.js', ['depends'=>[\backend\assets\AppAsset::className()],'position'=>$this::POS_END]);

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
                        <div class="text-left margin-bottom-sm form-group">
                        <?php
                        echo $this->render('/withdraw_cash/_search', ['model' => $model]);
                        ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        
                        <div class="text-left margin-bottom-sm form-group">
                        <?php
                                $columns=[
                            [
                                'class' => 'kartik\grid\CheckboxColumn',
                                'headerOptions' => ['class'=>'text-center'],
                            ],
                            [
                                'attribute'=>'id',
                                'label'=>'订单号',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '操作',
                                'template' => '{withdraw-cash-audit}{withdraw-cash-audit-no}',
                                'headerOptions' => ['class'=>'text-center'],
                                'contentOptions' => [],  
                                'buttons' => [
                                    'withdraw-cash-audit'=>function($url,$model,$key){
                                        return Html::a('同意提现', yii\helpers\Url::to(['withdraw-cash-audit','id'=>$model->id,'status'=>1]), [
                                            'title' => '同意提现',
                                            //'data-method' => 'get',
                                            //'data-pjax' => '0',
                                            'class'=>'btn-xs btn-info',
                                        ])."&nbsp;";
                                    },
                                    'withdraw-cash-audit-no'=>function($url,$model,$key){
                                        return Html::a('不同意提现', yii\helpers\Url::to(['withdraw-cash-audit','id'=>$model->id,'status'=>0]), [
                                            'title' => '不同意提现',
                                            //'data-method' => 'get',
                                            //'data-pjax' => '0',
                                            'class'=>'btn-xs btn-info',
                                        ])."&nbsp;";
                                    },
                                ]
                            ],
                            //['attribute'=>'','label'=>'当前时间','content'=>function($model){return ;}],
                            [
                                'attribute'=>'user_id',
                                'label'=>'用户帐号',
                                //'formate'=>'int',
                                'content'=>function($model){return \common\logic\BaseLogic::getInstance()->loadModel('User')->getModel()->find()->select('username')->where(['id'=>$model->user_id])->scalar();},
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute'=>'amount',
                                'label'=>'交易金额(元)',
                                //'formate'=>'int',
                                'content'=>function($model){return $model->amount."元";},
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute' => 'bank_id',
//                                'label'=>'手续费',
                                'content' => function($model) {
                                    return Yii::$app->params['extend_params']['banks'][$model->bank_id];
                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],
                            [
                                'attribute' => 'bank_card',
//                                'label'=>'手续费',
//                                'content' => function($model) {
//                                    return $model->fee.'元';
//                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],
                            [
                                'attribute' => 'status',
                                'label'=>'状态',
                                'content' => function($model) {
                                    return Yii::$app->params['extend_params']['withdraw_cash_status'][$model->status];
                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],
                            [
                                'attribute' => 'remark',
                                //'label'=>'状态',
//                                'content' => function($model) {
//                                    return $model->cooperation_ratio.'%';
//                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],
                            [
                                'attribute' => 'created_at',
                                //'label'=>'状态',
                                'content' => function($model) {
                                    return $model->created_at==0?"未处理":date("Y-m-d H:i",$model->created_at);
                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],
                            [
                                'attribute' => 'audite_time',
                                //'label'=>'状态',
                                'content' => function($model) {
                                    return $model->audite_time==0?"未处理":date("Y-m-d H:i",$model->audite_time);
                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],
                        ];
                                echo \yii\bootstrap\Html::a('同意提现', 'javascript:void(0)', ['onclick' => "commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','" . yii\helpers\Url::to(['withdraw-cash-audit','status'=>1]) . "','确定要通过吗','selection[]','input','checked',false,false,false)", 'class' => 'btn btn-primary', 'title' => '同意提现']) . "&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('不同意提现', 'javascript:void(0)', ['onclick' => "commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','" . yii\helpers\Url::to(['withdraw-cash-audit','status'=>0]) . "','确定不通过吗','selection[]','input','checked',false,false,false)", 'class' => 'btn btn-primary', 'title' => '不同意提现']) . "&nbsp;&nbsp;";
                        
                                echo \kartik\export\ExportMenu::widget([
                                    'dataProvider' => $list,
                                    'folder'=>'@backend/runtime/export',
                                    'columns' => $columns,
                                    'fontAwesome' => true,
                                    'dropdownOptions' => [
                                        'label' => '导出所有',
                                        'class' => 'btn btn-default'
                                    ]
                                ])
                        ?>
                    </div>
                        
                </div>
                </div>
                    <?php 
                    //echo $this->render('/cooperation/_search', ['model' => $searchModel]);
                    
                    echo \kartik\grid\GridView::widget([
                        'dataProvider' => $list,
                        'layout' => "{items}\n{pager}",
//                        'options'=>[],
//                        'pager'=>[ 
//                            //'options'=>['class'=>'hidden'],
//                            //关闭分页 
//                            'firstPageLabel'=>"首页", 
//                            'prevPageLabel'=>'上一页', 
//                            'nextPageLabel'=>'下一页', 
//                            'lastPageLabel'=>'尾页', 
//                        ],
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
                        'columns' => $columns,
                    ]);
                    ?>

            </div>
        </div>
    </div>