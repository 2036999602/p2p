<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '活动管理', 'url' => ['index']];
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
                        echo $this->render('/activity_manager/_search', ['model' => $model]);
                        ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                    <div class="text-left margin-bottom-sm form-group">
                        <?php
                        echo \yii\bootstrap\Html::a('添加', ['add'], ['class' => 'btn btn-primary', 'title' => '添加']) . "&nbsp;&nbsp;";
                        echo \yii\bootstrap\Html::a('批量删除', 'javascript:void(0)', ['onclick' => "commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','" . yii\helpers\Url::to(['delete']) . "','确定要删除所选么？','selection[]','input','checked',false,false,false,true)", 'class' => 'btn btn-primary', 'title' => '批量删除']) . "&nbsp;&nbsp;";
                        
                        echo \yii\bootstrap\Html::a('编辑', 'javascript:void(0)', ['onclick' => "commonDataOperate('get','','" . yii\helpers\Url::to(['update']) . "','','selection[]','input','checked',true)", 'class' => 'btn btn-primary', 'title' => '编辑']) . "&nbsp;&nbsp;";
                        
                        echo \yii\bootstrap\Html::a('审核', 'javascript:void(0)', ['onclick' => "commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','" . yii\helpers\Url::to(['audit']) . "','确定要审核吗？','selection[]','input','checked',false,false,false)", 'class' => 'btn btn-primary', 'title' => '审核']) . "&nbsp;&nbsp;";
                        
                        echo \yii\bootstrap\Html::a('暂停', 'javascript:void(0)', ['onclick' => "commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','" . yii\helpers\Url::to(['suspend']) . "','确定要暂停吗？','selection[]','input','checked',false,false,false)", 'class' => 'btn btn-primary', 'title' => '暂停']) . "&nbsp;&nbsp;";
                        
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
                            'attribute'=>'activity_name',
                            //'label'=>'项目类型',
                            //'formate'=>'int',
                            //'content'=>function($model){return $model->id;}
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'activity_audience',
                            'label'=>'活动对象',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->activity_audience)?"":$model->activity_audience===0?"所有会员":common\logic\BaseLogic::getInstance()->loadModel('MemberRankModel')->getSingleAttribute('rank_name',['id'=>$model->activity_audience]);},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'activity_condition',
                            'label'=>'活动条件',
                            //'formate'=>'int',
                            'content'=>function($model){return empty($model->activity_condition)?"":Yii::$app->params['extend_params']['activity_join_type'][$model->activity_condition];},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'award_content',
                            //'label'=>'奖励条件',
                            //'formate'=>'int',
                            'content'=>function($model){return empty($model->award_content)?"":Yii::$app->params['extend_params']['outsite_amount_type'][$model->award_type].$model->award_content.Yii::$app->params['extend_params']['outsite_amount_type_addon_value'][$model->award_type];},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'start_time',
                            //'label'=>'项目类型',
                            //'formate'=>'int',
                            'content'=>function($model){return empty($model->start_time)?"":date("Y-m-d H:i",$model->start_time);},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'end_time',
                            //'label'=>'奖励类型',
                            //'formate'=>'int',
                            'content'=>function($model){return empty($model->end_time)?"":date("Y-m-d H:i",$model->end_time);},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'get_award_expiry_date',
                            //'label'=>'项目类型',
                            //'formate'=>'int',
                            'content'=>function($model){return empty($model->get_award_expiry_date)?"":date("Y-m-d H:i",$model->get_award_expiry_date);},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'status',
                            'label'=>'状态',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->status)?"":Yii::$app->params['extend_params']['activity_status'][$model->status];},
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