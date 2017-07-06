<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminModel */
/* @var $form yii\widgets\ActiveForm */

$form = ActiveForm::begin([
            'id' => 'user-form',
            'fieldConfig' => [
                'template' => '{beginWrapper}{label}{error}{input}{endWrapper}',
                'options' => [],
                'errorOptions' => [
                    'tag' =>'label',
                    'class' => 'text-warning', 
                ],
                'inputTemplate' => '{input}',
            ],
        ]);
echo $form->field($model, 'username')->textInput()->label('帐   号：');
echo $form->field($model, 'password_hash')->passwordInput()->label('密   码：');
echo $form->field($model, 're_password_hash')->passwordInput()->label('鹕认密码：');
echo $form->field($model, 'mobile')->textInput()->label('手机号：');
echo $form->field($model, 'email')->textInput()->label('邮    箱：');


echo '<div class="form-actions">' . Html::submitButton($model->isNewRecord ? '确定' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) . '</div>';
ActiveForm::end();