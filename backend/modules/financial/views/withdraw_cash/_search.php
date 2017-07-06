<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="text-left">
    <?php
    $form = ActiveForm::begin([
                'action' => ['withdraw-cash-index'],
                'method' => 'get',
                'options'=>['class'=>'form-horizontal text-black'],
                'fieldConfig' => [
                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                    'wrapperOptions' => [
                        'class' => 'col-lg-2'
                    ],
                ],
    ]);

 
    echo $form->field($model, 'user_id', ['options' => ['class'=>'']])->textInput(['placeholder' => '请输入用户名','alt' => '请输入用户名'])->label('用户名');
    echo $form->field($model, 'search_start_time',['wrapperOptions'=>['class'=>'col-lg-3'],'options'=>['class'=>'']])->widget(\kartik\datetime\DateTimePicker::className(),[

    'options' => ['placeholder' => '点击选择时间'],
    'convertFormat' => false,
    'removeButton' => false,
    'pickerButton' => ['icon' => 'time'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd hh:ii',
        'startDate' => date('Y-m-d H:i'),
        'todayHighlight' => true,
        'delete'=>false,
        'autoclose' => true
    ]
])->label('开始时间');
    
    echo $form->field($model, 'search_end_time',['wrapperOptions'=>['class'=>'col-lg-3'],'options'=>['class'=>'']])->widget(\kartik\datetime\DateTimePicker::className(),[

    'options' => ['placeholder' => '点击选择时间'],
    'convertFormat' => false,
    'removeButton' => false,
    'pickerButton' => ['icon' => 'time'],
    'pluginOptions' => [
        'format' => 'yyyy-mm-dd hh:ii',
        'startDate' => strtotime("+1 day"),
        'todayHighlight' => true,
        'autoclose' => true
    ]
])->label('结束时间');
    echo Html::submitButton('搜索', ['class' => 'btn btn-primary col-md-1 col-sm-2 col-xs-3']);
    ActiveForm::end();
?>
</div>

