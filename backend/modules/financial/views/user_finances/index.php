<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '会员资金列表', 'url' => ['user-financials-index']];
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
                        
                        <div class="text-left margin-bottom-sm form-group">
                        <?php
                                $columns=[
//                            [
//                                'class' => 'kartik\grid\CheckboxColumn',
//                                'headerOptions' => ['class'=>'text-center'],
//                            ],
                            [
                                'attribute'=>'id',
                                //'label'=>'订单号',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            
                            //['attribute'=>'','label'=>'当前时间','content'=>function($model){return ;}],
                            [
                                'attribute'=>'user_id',
                                'label'=>'会员帐号',
                                //'formate'=>'int',
                                'content'=>function($model){return backend\logic\UserLogic::getInstance()->loadModel('User')->getSingleAttribute('username',['id'=>$model->user_id]);},
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute'=>'amounts',
                                //'label'=>'订单号',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute'=>'collects',
                                //'label'=>'订单号',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute'=>'profits',
                                //'label'=>'订单号',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute'=>'recharges',
                                //'label'=>'订单号',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute'=>'withdrawals',
                                //'label'=>'订单号',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute'=>'rewards',
                                //'label'=>'订单号',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute'=>'red_packets',
                                //'label'=>'订单号',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                                'headerOptions'=>['class'=>'text-center']
                            ],
                        ];                                
                        ?>
                    </div>
                        
                </div>
                </div>
                    <?php 
                    //echo $this->render('/cooperation/_search', ['model' => $searchModel]);
                    
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
                        'columns' => $columns,
                    ]);
                    ?>

            </div>
        </div>
    </div>