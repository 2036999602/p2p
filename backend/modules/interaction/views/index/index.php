<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '互动列表', 'url' => ['index']];
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
                        //echo $this->render('_search', ['model' => $model]);
                        ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                    <div class="text-left margin-bottom-sm form-group">
                        <?php
                        echo \yii\bootstrap\Html::a('所有', yii\helpers\Url::to(['index']), ['class' => 'btn btn-primary', 'title' => '所有']) . "&nbsp;&nbsp;";
                        echo \yii\bootstrap\Html::a('红包列表', yii\helpers\Url::to(['index',$model->formName().'[award_type]'=>1]), ['class' => 'btn btn-primary', 'title' => '红包列表']) . "&nbsp;&nbsp;";
                        echo \yii\bootstrap\Html::a('理财金列表', yii\helpers\Url::to(['index',$model->formName().'[award_type]'=>2]), ['class' => 'btn btn-primary', 'title' => '理财金列表']) . "&nbsp;&nbsp;";
                        echo \yii\bootstrap\Html::a('加息列表', yii\helpers\Url::to(['index',$model->formName().'[award_type]'=>3]), ['class' => 'btn btn-primary', 'title' => '加息列表']) . "&nbsp;&nbsp;";
                        //echo \yii\bootstrap\Html::a('推荐好友列表', 'javascript:void(0)', ['onclick' => "commonDataOperate('get','','" . yii\helpers\Url::to(['index']) . "','','selection[]','input','checked',true)", 'class' => 'btn btn-primary', 'title' => '编辑']) . "&nbsp;&nbsp;";
                        
                        ?>
                    </div>
                    </div>
                </div>
                    <?php 
                    $columns=[
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
                            'attribute'=>'user_id',
                            'label'=>'领取人帐号',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->user_id)?"":\backend\logic\UserLogic::getInstance()->loadModel('User')->getSingleAttribute('username',['id'=>$model->user_id]);},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'activity_id',
                            'label'=>'活动名称',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->activity_id)?"":common\logic\BaseLogic::getInstance()->loadModel('ActivityModel')->getSingleAttribute('activity_name',['id'=>$model->activity_id]);},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'outside_amount',
                            //'label'=>'活动条件',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->outside_amount)?"":Yii::$app->params['extend_params']['outsite_amount_type'][$model->award_type].$model->outside_amount.Yii::$app->params['extend_params']['outsite_amount_type_addon_value'][$model->award_type];},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'status',
                            'label'=>'状态',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->status)?"":Yii::$app->params['extend_params']['has_get_outsite_amount'][$model->status];},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>false,
                            'label'=>'发放时间',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->activity_id)?"":date("Y-m-d H:i",common\logic\BaseLogic::getInstance()->loadModel('ActivityModel')->getSingleAttribute('start_time',['id'=>$model->activity_id]));},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>false,
                            'label'=>'领取截止时间',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->activity_id)?"":date("Y-m-d H:i",common\logic\BaseLogic::getInstance()->loadModel('ActivityModel')->getSingleAttribute('get_award_expiry_date',['id'=>$model->activity_id]));},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>false,
                            'label'=>'过期',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->activity_id)?"":time()>common\logic\BaseLogic::getInstance()->loadModel('ActivityModel')->getSingleAttribute('get_award_expiry_date',['id'=>$model->activity_id])?"已过期":"未过期";},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                    ];
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