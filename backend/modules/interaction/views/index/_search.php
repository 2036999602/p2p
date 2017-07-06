<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row text-left">
    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options'=>['class'=>'form-horizontal text-black'],
                'fieldConfig' => [
                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                    'wrapperOptions' => [
                        'class' => 'col-lg-2'
                    ],
                ],
    ]);

    
    echo $form->field($model, 'activity_name', ['options' => ['class'=>'']])->textInput(['placeholder' => '请输入活动名称','alt' => '请输入活动名称']);

    if(isset($model->start_time)&&$model->start_time){
        $model->start_time=date('Y-m-d H:i',$model->start_time);
    }
    echo $form->field($model, 'start_time',['wrapperOptions'=>['class'=>'col-lg-3'],'options'=>['class'=>'']])->widget(kartik\datetime\DateTimePicker::className(), [
        //'convertFormat' => true,
        'options'=>['placeholder'=>'活动开始时间'],
        'pluginOptions' => [
            'autoclose' => true,
            'readonly' => true,
            'size' => 'ms',
            'removeButton' => false,
            'pickerButton' => ['icon' => 'time'],
            'format' => 'yyyy-mm-dd hh:ii',
            //'startDate' => date('Y-m-d H:i'),
            'todayHighlight' => true
        ]
    ]);
    
    if(isset($model->end_time)&&$model->end_time){
        $model->end_time=date('Y-m-d H:i',$model->end_time);
    }
    echo $form->field($model, 'end_time',['wrapperOptions'=>['class'=>'col-lg-3'],'options'=>['class'=>'']])->widget(kartik\datetime\DateTimePicker::className(), [
        //'convertFormat' => true,
        'options'=>['placeholder'=>'活动结束时间'],
        'pluginOptions' => [
            'autoclose' => true,
            'readonly' => true,
            'size' => 'ms',
            'removeButton' => false,
            'pickerButton' => ['icon' => 'time'],
            'format' => 'yyyy-mm-dd hh:ii',
            //'startDate' => strtotime('+6 Hours'),
            'todayHighlight' => true
        ]
    ]);
    echo Html::submitButton('搜索', ['class' => 'btn btn-primary col-md-1 col-sm-2 col-xs-3']);
    ActiveForm::end();
?>
</div>

