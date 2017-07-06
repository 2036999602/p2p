<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '交易记录', 'url' => ['trade-index']];
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
                                $columns=[
//                            [
//                                'class' => 'kartik\grid\CheckboxColumn',
//                                'headerOptions' => ['class'=>'text-center'],
//                            ],
                            [
                                'attribute'=>'id',
                                'label'=>'订单号',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                                'headerOptions'=>['class'=>'text-center']
                            ],
//                            [
//                                'class' => 'yii\grid\ActionColumn',
//                                'header' => '操作',
//                                'template' => '{cost-update}',
//                                'headerOptions' => ['class'=>'text-center'],
//                                'contentOptions' => [],  
//                                'buttons' => [
//                                    'cost-update'=>function($url,$model,$key){
//                                        return Html::a('编辑', $url, [
//                                            'title' => '编辑',
//                                            //'data-method' => 'get',
//                                            //'data-pjax' => '0',
//                                            'class'=>'btn-xs btn-info',
//                                        ])."&nbsp;";
//                                    },
//                                ]
//                            ],
                            //['attribute'=>'','label'=>'当前时间','content'=>function($model){return ;}],
                            [
                                'attribute'=>'user_id',
                                'label'=>'用户帐号',
                                //'formate'=>'int',
                                'content'=>function($model){return \common\logic\BaseLogic::getInstance()->loadModel('User')->getModel()->find()->select('username')->where(['id'=>$model->user_id])->scalar();},
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute'=>'trade_type',
                                'label'=>'交易类型',
                                //'formate'=>'int',
                                'content'=>function($model){return Yii::$app->params['extend_params']['trade_type'][$model->trade_type];},
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
                                'attribute' => 'fee',
                                'label'=>'手续费',
                                'content' => function($model) {
                                    return $model->fee.'元';
                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],
                            [
                                'attribute' => 'take_off_fee_amount',
                                'label'=>'实际到账(元)',
                                'content' => function($model) {
                                    return $model->take_off_fee_amount.'元';
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
                                'attribute' => 'status',
                                'label'=>'状态',
                                'content' => function($model) {
                                    return Yii::$app->params['extend_params']['trade_status'][$model->status];
                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],
                            [
                                'attribute' => 'operate_channels',
//                                'label'=>'状态',
//                                'content' => function($model) {
//                                    return Yii::$app->params['extend_params']['trade_status'][$model->status];
//                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],
                        ];
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
                        <div class="text-left margin-bottom-sm margin-top-lg form-group">
                        <?php
                        echo $this->render('/trades/_search', ['model' => $model]);
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