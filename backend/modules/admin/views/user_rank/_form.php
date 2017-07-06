<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminModel */
/* @var $form yii\widgets\ActiveForm */

$form = ActiveForm::begin([
            'id' => 'UserRankModel',
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
echo $form->field($model, 'scores_range')->textInput(['placeholder'=>'如： 10000-20000'])->label();
echo $form->field($model, 'rank_name')->textInput(['placeholder'=>'如： 中级会员'])->label();
$items=Yii::$app->params['extend_params']['common_is_enable'];
$model->is_enable=!isset($model->is_enable)?1:$model->is_enable;
echo $form->field($model, 'is_enable')->inline(true)->radioList($items)->label('启用');


echo '<div class="form-actions">' . Html::submitButton($model->isNewRecord ? '确定' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) . '</div>';
ActiveForm::end();