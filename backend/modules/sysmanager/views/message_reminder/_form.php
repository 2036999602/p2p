<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminModel */
/* @var $form yii\widgets\ActiveForm */

$form = ActiveForm::begin([
            'id' => 'MessageReminderModel',
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
$items=['to_sms'=>'短信','to_email'=>'邮箱','in_site'=>'站内信'];
echo $form->field($model, 'get_repayment')->inline(true)->checkboxList($items)->label();

echo $form->field($model, 'cash_dividends')->inline(true)->checkboxList($items)->label();


echo $form->field($model, 'loan_success')->inline(true)->checkboxList($items)->label();


echo $form->field($model, 'recharge_success')->inline(true)->checkboxList($items)->label();


echo $form->field($model, 'fund_change')->inline(true)->checkboxList($items)->label();


echo '<div class="form-actions">' . Html::submitButton('确定', ['class' => 'btn btn-primary']) . '</div>';
ActiveForm::end();