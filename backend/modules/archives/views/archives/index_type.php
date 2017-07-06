<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AdminSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '栏目管理', 'url' => ['index']];
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
                        echo \yii\bootstrap\Html::a('添加栏目', ['type-add'], ['class' => 'btn btn-primary','alt'=>'添加栏目']) . "&nbsp;&nbsp;";
                        echo \yii\bootstrap\Html::a('编辑', 'javascript:void(0)', ['onclick' => "commonDataOperate('get','','" . yii\helpers\Url::to(['type-update']) . "','','selection[]','input','checked',true)", 'class' => 'btn btn-primary', 'alt' => '编辑']) . "&nbsp;&nbsp;";
                        echo \yii\bootstrap\Html::a('批量删除', 'javascript:void(0)', ['onclick' => "commonDataOperate('post','".Yii::$app->request->getCsrfToken()."','" . yii\helpers\Url::to(['type-delete']) . "','确定要删除所选么？','selection[]','input','checked',false,false,false,true)", 'class' => 'btn btn-primary', 'alt' => '批量删除']) . "&nbsp;&nbsp;";
                        
                        ?>
                    </p></div>
                </div>
                    <?php 
                    //echo $this->render('/cooperation/_search', ['model' => $searchModel]);
                    //Pjax::begin(['id' => 'cooperation','timeout'=>3000]);
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
//                                        return Html::a('查看', \yii\helpers\Url::to(['type-view','id'=>$model->id]), [
//                                            'title' => '查看',
//                                            'data-method' => 'post',
//                                            'data-pjax' => '0',
//                                            'class'=>'btn-xs btn-info',
//                                        ])."&nbsp;";
//                                    },
//                                    'update'=>function($url,$model,$key){
//                                        return Html::a('编辑', \yii\helpers\Url::to(['type-update','id'=>$model->id]), [
//                                            'title' => '编辑',
//                                            'data-method' => 'post',
//                                            'data-pjax' => '0',
//                                            'class'=>'btn-xs btn-success'
//                                        ])."&nbsp;";
//                                    },
//                                    'delete'=>function($url,$model,$key){
//                                        return Html::a('删除', \yii\helpers\Url::to(['type-delete','id'=>$model->id]), [
//                                            'title' => '删除',
//                                            'data-method' => 'post',
//                                            'data-pjax' => '0',
//                                            'data-confirm'=>'确定删除吗',
//                                            'class'=>'btn-xs btn-danger'
//                                        ])."&nbsp;";
//                                    },
//                                ],
//                            ],
                            //['attribute'=>'','label'=>'当前时间','content'=>function($model){return ;}],
                            [
                                'attribute'=>'type_name',
                                //'label'=>'ID',
                                //'formate'=>'int',
                                //'content'=>function($model){return $model->id;}
                                'headerOptions'=>['class'=>'text-center']
                            ],
                            [
                                'attribute'=>'created_at',
                                //'label'=>'ID',
                                //'formate'=>'int',
                                'content'=>function($model){return date("Y-m-d H:i",$model->created_at);},
                                'headerOptions'=>['class'=>'text-center']
                            ],                            
                        ],
                    ]);
                    ?>
<?php 
//Pjax::end(); 
?>
            </div>
        </div>
    </div>