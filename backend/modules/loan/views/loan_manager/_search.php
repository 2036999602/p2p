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

    
    echo $form->field($model, 'search_keyword', ['options' => ['class'=>'']])->textInput(['placeholder' => '申请人/帐号/手机号']);

    
    echo Html::submitButton('搜索', ['class' => 'btn btn-primary col-md-1 col-sm-2 col-xs-3']);
    ActiveForm::end();
?>
</div>

