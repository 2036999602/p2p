<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminModel */
/* @var $form yii\widgets\ActiveForm */

$form = ActiveForm::begin([
            'id' => 'EmailSmtpModel',
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

echo $form->field($model, 'smtp_link')->textInput()->label('smtp地址');

echo $form->field($model, 'email')->textInput()->label('发信邮箱');

echo $form->field($model, 'smtp_password')->passwordInput()->label('smtp密码');

$model->smtp_port=empty($model->smtp_port)?"993":$model->smtp_port;
echo $form->field($model, 'smtp_port')->textInput()->label('smtp端口');

$model->smtp_protocol=empty($model->smtp_protocol)?"ssl":$model->smtp_protocol;
echo $form->field($model, 'smtp_protocol')->textInput()->label('安全加密');

echo $form->field($model, 'test_email')->textInput()->label('测试接收邮箱');


echo '<div class="form-actions">' . Html::submitButton('确定', ['class' => 'btn btn-primary']) . '</div>';
ActiveForm::end();