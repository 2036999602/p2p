<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminModel */
/* @var $form yii\widgets\ActiveForm */

$form = ActiveForm::begin([
            'id' => 'PaymentTypeModel',
            //'options' => ['enctype' => 'multipart/form-data'],
            'fieldConfig' => [
                'template' => '{beginWrapper}{label}&nbsp;{error}{input}{endWrapper}',                
                'errorOptions' => [
                    'tag' =>'label',
                    'class' => 'text-warning', 
                ],
                'inputTemplate' => '{input}',
            ],
        ]);

echo $form->field($model, 'payment_name')->textInput()->label('还款方式');

echo $form->field($model, 'payment_value')->textarea()->label('描述');

echo '<div class="form-actions">' . Html::submitButton($model->isNewRecord ? '确定' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) . '</div>';
ActiveForm::end();