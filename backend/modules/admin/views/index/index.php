<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '管理员管理', 'url' => ['index']];
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
                        echo \yii\bootstrap\Html::a('添加', ['add'], ['class' => 'btn btn-primary', 'alt' => '添加']) . "&nbsp;&nbsp;";
                        echo \yii\bootstrap\Html::a('批量删除', 'javascript:void(0)', ['onclick' => "commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','" . yii\helpers\Url::to(['delete']) . "','确定要删除所选么？','selection[]','input','checked',false,false,false,true)", 'class' => 'btn btn-primary', 'alt' => '批量删除']) . "&nbsp;&nbsp;";
                        //echo \yii\bootstrap\Html::a('查看', 'javascript:void(0)', ['onclick' => "commonDataOperate('" . yii\helpers\Url::to(['cooperation-view']) . "','','selection[]','input','checked',true)", 'class' => 'btn btn-primary', 'title' => '查看']) . "&nbsp;&nbsp;";
                        echo \yii\bootstrap\Html::a('编辑', 'javascript:void(0)', ['onclick' => "commonDataOperate('get','','" . yii\helpers\Url::to(['update']) . "','','selection[]','input','checked',true)", 'class' => 'btn btn-primary', 'alt' => '编辑']) . "&nbsp;&nbsp;";
                        echo \yii\bootstrap\Html::a('审核', 'javascript:void(0)', ['onclick' => "commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','" . yii\helpers\Url::to(['audit']) . "','确定要审核吗','selection[]','input','checked',false,false,true)", 'class' => 'btn btn-primary', 'alt' => '审核']) . "&nbsp;&nbsp;";
                        echo \yii\bootstrap\Html::a('屏蔽', 'javascript:void(0)', ['onclick' => "commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','" . yii\helpers\Url::to(['disable']) . "','确定要屏蔽吗','selection[]','input','checked',false,false,true)", 'class' => 'btn btn-primary', 'alt' => '屏蔽']) . "&nbsp;&nbsp;";
                        
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
//                            [
//                                'class' => 'yii\grid\ActionColumn',
//                                'header' => '操作',
//                                'template' => '{view}{update}{audit}{disable}',
//                                'headerOptions' => ['class'=>'text-center'],
//                                'contentOptions' => [],
//                                'buttons' => [
//                                    'view'=>function($url,$model,$key){
//                                        return Html::a('查看', \yii\helpers\Url::to(['cooperation-view','id'=>$model->id]), [
//                                            'title' => '查看',
//                                            'data-method' => 'post',
//                                            'data-pjax' => '0',
//                                            'class'=>'btn-xs btn-info',
//                                        ])."&nbsp;";
//                                    },
//                                    'update'=>function($url,$model,$key){
//                                        return Html::a('编辑', \yii\helpers\Url::to(['cooperation-update','id'=>$model->id]), [
//                                            'title' => '编辑',
//                                            'data-method' => 'post',
//                                            'data-pjax' => '0',
//                                            'class'=>'btn-xs btn-success'
//                                        ])."&nbsp;";
//                                    },
//                                    'delete'=>function($url,$model,$key){
//                                        return Html::a('删除', \yii\helpers\Url::to(['cooperation-delete','id'=>$model->id]), [
//                                            'title' => '删除',
//                                            'data-method' => 'post',
//                                            'data-pjax' => '0',
//                                            'data-confirm'=>'确定删除吗',
//                                            'class'=>'btn-xs btn-danger'
//                                        ])."&nbsp;";
//                                    },
//                                    'audit'=>function($url,$model,$key){
//                                        return Html::a('审核', \yii\helpers\Url::to(['cooperation-audit','id'=>$model->id]), [
//                                            'title' => '审核',
//                                            'data-method' => 'post',
//                                            'data-pjax' => '0',
//                                            'data-confirm'=>'确定审核吗',
//                                            'class'=>'btn-xs btn-success'
//                                        ])."&nbsp;";
//                                    },
//                                    'disable'=>function($url,$model,$key){
//                                        return Html::a('屏蔽', \yii\helpers\Url::to(['cooperation-disable','id'=>$model->id]), [
//                                            'title' => '屏蔽',
//                                            'data-method' => 'post',
//                                            'data-pjax' => '0',
//                                            'data-confirm'=>'确定屏蔽吗',
//                                            'class'=>'btn-xs btn-success'
//                                        ])."&nbsp;";
//                                    },
//                                ],
//                            ],
                            //['attribute'=>'','label'=>'当前时间','content'=>function($model){return ;}],
                            [
                                'attribute'=>'username',
                                'label'=>'管理员帐号',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute'=>false,
                                'label'=>'所属企业',
                                //'formate'=>'int',
                                'content'=>function($model){return empty($model->role_type)?"":\common\logic\BaseLogic::getInstance()->loadModel($model->role_type)->getModel()->find()->select('company_name')->where(['id'=>$model->role_id])->scalar();},
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute'=>false,
                                'label'=>'所属角色',
                                //'formate'=>'int',
                                'content'=>function($model){return \common\logic\BaseLogic::getInstance()->loadModel('AuthAssignmentModel')->getModel()->find()->select('item_name')->where(['user_id'=>$model->id])->scalar();},
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute' => 'add_by',
                                'label'=>'添加人',
                                'content' => function($model) {
                                    return empty($model->add_by)?"":\common\models\User::find()->select('username')->where(['id'=>$model->add_by])->scalar();
                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],
                            [
                                'attribute' => 'operater_id',
                                'label'=>'审核人',
                                'content' => function($model) {
                                    return empty($model->operater_id)?"":\common\models\User::find()->select('username')->where(['id'=>$model->operater_id])->scalar();
                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],
                            [
                                'attribute' => 'status',
                                'label'=>'状态',
                                'content' => function($model) {
                                    return Yii::$app->params['extend_params']['user_status'][$model->status];
                                },
                                'headerOptions'=>['class'=>'text-center'],
                            ],     
                            [
                                'attribute' => 'is_disable',
                                'label'=>'屏蔽',
                                'content' => function($model) {
                                    return Yii::$app->params['extend_params']['disable_status'][$model->is_disable];
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