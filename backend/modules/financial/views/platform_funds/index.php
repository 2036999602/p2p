<?php

//use yii\helpers\Html;
//use yii\grid\GridView;
//use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '平台资金列表', 'url' => ['platform-funds-index']];
$this->params['breadcrumbs'][] = $this->title;


$this->registerJsFile('@web/js/bootstrap.min.js', ['depends' => [\backend\assets\AppAsset::className()], 'position' => $this::POS_END]);
?>

<div class="col-lg-6">
    <div class="box">            
        <div class="box-header" data-original-title="支出费用">
            <h2>
                <i class="fa fa-user"></i>
                <span class="break"></span>
                支出费用
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
                        echo \yii\widgets\DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'recharge_fees',
                                'withdraw_cash_fees',
                                'red_packets',
                                'cashed_red_packets',
                                [
                                    'attribute' => false,
                                    'label' => '总支出(元)',
                                    'value' => function($model) {
                                        return $model->recharge_fees + $model->withdraw_cash_fees + $model->red_packets + $model->cashed_red_packets;
                                    }
                                ],
                                [
                                    'attribute' => false,
                                    //'label'=>'_',
                                    'value' => function($model) {
                                        return '&nbsp;';
                                    }
                                ]
                            ],
                        ])
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
    
<div class="col-lg-6">    
    <div class="box">            
        <div class="box-header" data-original-title="收入资金">
            <h2>
                <i class="fa fa-user"></i>
                <span class="break"></span>
                收入资金
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
                        echo \yii\widgets\DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'debt_transfer_fees',
                                'prepayment_penalty',
                                'aged_fail',
                                'trade_fees_investor',
                                'trade_fees_lender',
                                [
                                    'attribute' => false,
                                    'label' => '总收入(元)',
                                    'value' => function($model) {
                                        return $model->debt_transfer_fees + $model->prepayment_penalty + $model->aged_fail + $model->trade_fees_investor+$model->trade_fees_lender;
                                    }
                                ]
                            ],
                        ])
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12">    
    <div class="box">            
        <div class="box-header" data-original-title="平台可用资金">
            <h2>
                <i class="fa fa-user"></i>
                <span class="break"></span>
                平台可用资金
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
                        echo \yii\widgets\DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'amount',                                
                                [
                                    'attribute' => false,
                                    'format'=>'raw',
                                    'label' => '充值',
                                    'value' => function($model) {
                                        return \yii\bootstrap\Html::a("进行充值",\yii\helpers\Url::to(['platform-funds-recharge','id'=>$model->id]));
                                    }
                                ]
                            ],
                        ])
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="col-lg-6">    
    <div class="box">            
        <div class="box-header" data-original-title="会员资金统计">
            <h2>
                <i class="fa fa-user"></i>
                <span class="break"></span>
                会员资金统计
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
                        echo \yii\widgets\DetailView::widget([
                            'model' => $member_obj,
                            'attributes' => [
                                [
                                    'attribute'=>'all_count',
                                    'label'=>'会员总数',
                                    'format'=>'raw',
                                    'value'=>function($model){return $model->all_count.'&nbsp;(男：'.$model->man_count.'，女：'.$model->woman_count.')，VIP：'.$model->vip_count;}
                                ],
//                                [
//                                    'attribute'=>'vip_count',
//                                    'label'=>'VIP数',
//                                ],
                                [
                                    'attribute'=>'recharge_sum',
                                    'label'=>'成功充值',
                                ],
                                [
                                    'attribute'=>'withdraw_cash_sum',
                                    'label'=>'成功提现',
                                ],
                                [
                                    'attribute'=>'amount_sum',
                                    'label'=>'会员总资金',
                                ],
                                [
                                    'attribute'=>'frozen_amount_sum',
                                    'label'=>'会员冻结总资金',
                                ],
                            ],
                        ])
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>