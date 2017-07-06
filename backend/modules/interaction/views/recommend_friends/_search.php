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
                'action' => ['recommend-friends'],
                'method' => 'get',
                'options'=>['class'=>'form-horizontal text-black'],
                'fieldConfig' => [
                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                    'wrapperOptions' => [
                        'class' => 'col-lg-2'
                    ],
                ],
    ]);

    
    echo $form->field($model, 'user_id', ['options' => ['class'=>'']])->textInput(['placeholder' => '请输入推荐人','alt' => '请输入推荐人']);

    if(isset($model->created_at)&&$model->created_at){
        $model->created_at=date('Y-m-d H:i',$model->created_at);
    }
    echo $form->field($model, 'created_at',['wrapperOptions'=>['class'=>'col-lg-3'],'options'=>['class'=>'']])->widget(kartik\datetime\DateTimePicker::className(), [
        //'convertFormat' => true,
        'options'=>['placeholder'=>'推荐时间'],
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
    
    
    echo Html::submitButton('搜索', ['class' => 'btn btn-primary col-md-1 col-sm-2 col-xs-3']);
    ActiveForm::end();
?>
</div>

