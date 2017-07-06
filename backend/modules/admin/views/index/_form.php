<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminModel */
/* @var $form yii\widgets\ActiveForm */

$form = ActiveForm::begin([
            'id' => 'AdminsModel',
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
echo $form->field($model, 'admin_id')->hiddenInput()->label(false);
echo $form->field($model, 'company_name')->dropDownList(yii\helpers\ArrayHelper::map($cooperations, 'id', 'company_name'))->label('所属企业：');
echo $form->field($model, 'item_name')->dropDownList(yii\helpers\ArrayHelper::map($roles, 'name', 'name'))->label('所属角色：');
if(Yii::$app->controller->action->id!="update"){echo $form->field($model, 'username')->textInput()->label('管理员帐号：');}
echo $form->field($model, 'password_hash')->passwordInput(['value'=>''])->label('密码：');
echo $form->field($model, 're_password_hash')->passwordInput(['value'=>''])->label('校对密码：');

echo '<div class="form-actions">' . Html::submitButton($model->isNewRecord ? '确定' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) . '</div>';
ActiveForm::end();