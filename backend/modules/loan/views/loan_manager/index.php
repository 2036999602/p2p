<?php

use yii\helpers\Html;
use yii\grid\GridView;
//use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '借款列表', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;


//$this->registerJsFile('@web/js/bootstrap.min.js');

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
                        if(null===Yii::$app->getRequest()->get('list_type')){
                            echo $this->render('/loan_manager/_search', ['model' => $model]);
                        }
                        ?>
                        </div>
                    </div>
                    <div class="col-lg-12">
                    <div class="text-left margin-bottom-sm form-group">
                        <?php
                        //echo \yii\bootstrap\Html::a('添加', ['add'], ['class' => 'btn btn-primary', 'title' => '添加']) . "&nbsp;&nbsp;";
                        if(null===Yii::$app->getRequest()->get('list_type')){
                            echo \yii\bootstrap\Html::a('批量删除', 'javascript:void(0)', ['onclick' => "commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','" . yii\helpers\Url::to(['delete']) . "','确定要删除所选么？','selection[]','input','checked',false,false,false,true)", 'class' => 'btn btn-primary', 'title' => '批量删除']) . "&nbsp;&nbsp;";
                        }
                        
                        echo \yii\bootstrap\Html::a('编辑', 'javascript:void(0)', ['onclick' => "commonDataOperate('get','','" . yii\helpers\Url::to(['update']) . "','','selection[]','input','checked',true)", 'class' => 'btn btn-primary', 'title' => '编辑']) . "&nbsp;&nbsp;";
                        if(null!==Yii::$app->getRequest()->get('list_type') && Yii::$app->getRequest()->get('list_type')==1){
                            $audit_url=yii\helpers\Url::to(['audit','status'=>2]);
                        }else{
                            $audit_url=yii\helpers\Url::to(['audit']);
                        }
                        echo \yii\bootstrap\Html::a('审核', 'javascript:void(0)', ['onclick' => "commonDataOperate('post','".Yii::$app->getRequest()->getCsrfToken()."','" . $audit_url . "','确定要审核吗？','selection[]','input','checked',false,false,false)", 'class' => 'btn btn-primary', 'title' => '审核']) . "&nbsp;&nbsp;";
                        
                        echo \yii\bootstrap\Html::a('查看', 'javascript:void(0)', ['onclick' => "commonDataOperate('get','','" . yii\helpers\Url::to(['view']) . "','','selection[]','input','checked',false,false,true,false)", 'class' => 'btn btn-primary', 'title' => '查看']) . "&nbsp;&nbsp;";
                        
                        if(null!==Yii::$app->getRequest()->get('list_type') && Yii::$app->getRequest()->get('list_type')==1){
                            echo \yii\bootstrap\Html::a('不合格', 'javascript:void(0)', ['onclick' => "LoanUnqualified('" . yii\helpers\Url::to(['audit','list_type'=>2]) . "','".Yii::$app->getRequest()->getCsrfToken()."','".$model->formName()."');", 'class' => 'btn btn-primary', 'title' => '审核']) . "&nbsp;&nbsp;";
                        }
                        
                        $columns=[
                        [
                            'attribute'=>'id',
                                //'label'=>'ID',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'user_id',
                            'label'=>'申请人',
                            //'formate'=>'int',
                            'content'=>function($model){return common\logic\BaseLogic::getInstance()->loadModel('MemberExtModel')->getSingleAttribute('real_name',['user_id'=>$model->user_id]);},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'user_id',
                            'label'=>'帐号',
                            //'formate'=>'int',
                            'content'=>function($model){return common\logic\BaseLogic::getInstance()->loadModel('User')->getSingleAttribute('username',['id'=>$model->user_id]);},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'loan_amount',
                            //'label'=>'活动对象',
                            //'formate'=>'int',
                            //'content'=>function($model){return !isset($model->activity_audience)?"":$model->activity_audience===0?"所有会员":common\logic\BaseLogic::getInstance()->loadModel('MemberRankModel')->getSingleAttribute('rank_name',['id'=>$model->activity_audience]);},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'loaner_property',
                            //'label'=>'借款人属性',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->loaner_property)?"":Yii::$app->params['extend_params']['loaner_property'][$model->loaner_property];},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'cooperation_id',
                            'label'=>'合作企业',
                            //'formate'=>'int',
                            'content'=>function($model){return \backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel')->getSingleAttribute('company_name',['id'=>$model->cooperation_id]);},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'created_at',
                            //'label'=>'项目类型',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->created_at)?"":date("Y-m-d H:i",$model->created_at);},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        [
                            'attribute'=>'status',
                            'label'=>'状态',
                            //'formate'=>'int',
                            'content'=>function($model){return !isset($model->status)?"":Yii::$app->params['extend_params']['loan_status'][$model->status];},
                            'headerOptions'=>['class'=>'text-center']
                        ],
                        
                        
                    ];
                    if(null===Yii::$app->getRequest()->get('list_type')){
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
                    }
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