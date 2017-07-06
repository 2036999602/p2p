<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '推荐好友列表', 'url' => ['recommend-friends']];
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
                        
                        $columns=[
                        [
                            'attribute'=>'id',
                                //'label'=>'ID',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'recommender_user_id',
                            'label'=>'推荐人',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->user_id)?"":\backend\logic\UserLogic::getInstance()->loadModel('User')->getSingleAttribute('username',['id'=>$model->recommender_user_id]);},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'user_id',
                            'label'=>'一级好友数',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->user_id)?"":common\logic\BaseLogic::getInstance()->loadModel('MemberRecommendFriendsModel')->getModel()->find()->where(['level'=>1,'recommender_user_id'=>$model->recommender_user_id])->count();},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'user_id',
                            'label'=>'二级好友数',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->user_id)?"":common\logic\BaseLogic::getInstance()->loadModel('MemberRecommendFriendsModel')->getModel()->find()->where(['level'=>2,'recommender_user_id'=>$model->recommender_user_id])->count();},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>false,
                            'label'=>'投资总额',
                            //'formate'=>'int',
                            'content'=>function($model){return 500000;},
                            'headerOptions'=>['class'=>'text-center']
                        ],
//                        [
//                            'attribute'=>'created_at',
//                            'label'=>'邀请时间',
//                            //'formate'=>'int',
//                            'content'=>function($model){return !isset($model->created_at)?"":date("Y-m-d H:i",$model->created_at);},
//                            'headerOptions'=>['class'=>'text-center']
//                        ],
                        
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
                                ]);
                        ?>
                    </div>
                    </div>
                </div>
                    <?php 
                    
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
                        'columns' => yii\helpers\ArrayHelper::merge([[
                                'class' => 'kartik\grid\CheckboxColumn',
                                'headerOptions' => ['class'=>'text-center'],
                            ]],$columns),
                    ]);
                    ?>

            </div>
        </div>
    </div>