<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminModel */
/* @var $form yii\widgets\ActiveForm */

$form = ActiveForm::begin([
            'id' => 'ArchivesTypeModel',
            'options' => ['enctype' => 'multipart/form-data'],
            'fieldConfig' => [
                'template' => '{beginWrapper}{label}&nbsp;{error}{input}{endWrapper}',                
                'errorOptions' => [
                    'tag' =>'label',
                    'class' => 'text-warning', 
                ],
                'inputTemplate' => '{input}',
            ],
        ]);
echo $form->field($model, 'type_name')->textInput()->label('栏目名：');
$model->module_name=empty($model->module_name)?$this->context->module->id:$model->module_name;
echo $form->field($model, 'module_name')->hiddenInput()->label(false);
$model->template_name=empty($model->template_name)?'index':$model->template_name;
echo $form->field($model, 'template_name')->hiddenInput()->label(false);

echo '<div class="form-actions">' . Html::submitButton($model->isNewRecord ? '确定' : '提交', ['onclick' => "$('#file-input').fileinput('upload');",'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) . '</div>';
ActiveForm::end();