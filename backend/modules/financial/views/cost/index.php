<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '费用设置', 'url' => ['cost-index']];
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
                        echo \yii\bootstrap\Html::a('添加', ['cost-add'], ['class' => 'btn btn-primary', 'title' => '添加企业']) . "&nbsp;&nbsp;";
                        echo \yii\bootstrap\Html::a('编辑', 'javascript:void(0)', ['onclick' => "commonDataOperate('get','','" . yii\helpers\Url::to(['cost-update']) . "','','selection[]','input','checked',true)", 'class' => 'btn btn-primary', 'alt' => '编辑']) . "&nbsp;&nbsp;";
                        
                        ?>
                    </p></div>
                </div>
                    <?php 
                    //echo $this->render('/cooperation/_search', ['model' => $searchModel]);
                    Pjax::begin(['id' => 'cooperation','timeout'=>3000]);
                    echo GridView::widget([
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
                        'columns' => [
                            [
                                'class' => 'yii\grid\CheckboxColumn',
                                'headerOptions' => ['class'=>'text-center'],
                            ],
                            [
                                'attribute'=>'id',
                                //'label'=>'ID',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => '操作',
                                'template' => '{cost-update}',
                                'headerOptions' => ['class'=>'text-center'],
                                'contentOptions' => [],  
                                'buttons' => [
                                    'cost-update'=>function($url,$model,$key){
                                        return Html::a('编辑', $url, [
                                            'title' => '编辑',
                                            //'data-method' => 'get',
                                            //'data-pjax' => '0',
                                            'class'=>'btn-xs btn-info',
                                        ])."&nbsp;";
                                    },
                                ]
                            ],
                            //['attribute'=>'','label'=>'当前时间','content'=>function($model){return ;}],
                            [
                                'attribute'=>'cost_name',
                                //'label'=>'ID',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute'=>'expense_ratio',
                                //'label'=>'ID',
                                //'formate'=>'int',
                                'content'=>function($model){return $model->expense_ratio."%";},
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute'=>'amount',
                                //'label'=>'ID',
                                //'formate'=>'int',
                                'content'=>function($model){return $model->amount."元";},
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute' => 'investor_ratio',
                                //'label'=>'法定代表人',
                                'content' => function($model) {
                                    return $model->investor_ratio.'元';
                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],
                            [
                                'attribute' => 'platform_ratio',
                                //'label'=>'审核人',
                                'content' => function($model) {
                                    return $model->platform_ratio.'%';
                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],
                            [
                                'attribute' => 'cooperation_ratio',
                                //'label'=>'状态',
                                'content' => function($model) {
                                    return $model->cooperation_ratio.'%';
                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],
                        ],
                    ]);
                    ?>
<?php Pjax::end(); ?>
            </div>
        </div>
    </div>