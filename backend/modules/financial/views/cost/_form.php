<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\FinancialConfigCostModel */
/* @var $form yii\widgets\ActiveForm */

$form = ActiveForm::begin([
            'id' => 'FinancialConfigCostModel',
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
echo $form->field($model, 'cost_name')->textInput()->label();
echo $form->field($model, 'expense_ratio')->textInput(['placeholder'=>'填小数,10%则填0.01'])->label();
echo $form->field($model, 'amount')->textInput(['placeholder'=>''])->label();
echo $form->field($model, 'investor_ratio')->textInput(['placeholder'=>'填小数,10%则填0.01'])->label();
echo $form->field($model, 'platform_ratio')->textInput(['placeholder'=>'填小数,10%则填0.01'])->label();
echo $form->field($model, 'cooperation_ratio')->textInput(['placeholder'=>'填小数,10%则填0.01'])->label();


echo '<div class="form-actions">' . Html::submitButton($model->isNewRecord ? '确定' : '提交', ['class' => 'btn btn-primary']) . '</div>';
ActiveForm::end();