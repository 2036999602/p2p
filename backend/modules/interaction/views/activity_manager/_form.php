<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$form = ActiveForm::begin([
            'id' => 'ActivityModel',
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
echo $form->field($model, 'activity_name')->textInput()->label();

$member_rank_array=\yii\helpers\ArrayHelper::merge([0=>'所有会员'], \yii\helpers\ArrayHelper::map($member_ranks, 'id', 'rank_name'));
echo $form->field($model, 'activity_audience')->dropDownList($member_rank_array)->label('活动对象');

$activity_condition_array=Yii::$app->params['extend_params']['activity_join_type'];
unset($activity_condition_array[0]);
echo $form->field($model, 'activity_condition')->dropDownList($activity_condition_array)->label('活动条件');

echo $form->field($model, 'award_condition')->textInput()->label();

$project_type_array=\yii\helpers\ArrayHelper::merge([0=>'所有项目'], \yii\helpers\ArrayHelper::map($financial_types, 'id', 'financial_name'));
echo $form->field($model, 'project_type')->dropDownList($project_type_array)->label('项目类型');

$activity_award_type_array=Yii::$app->params['extend_params']['outsite_amount_type'];
unset($activity_award_type_array[0]);
echo $form->field($model, 'award_type')->dropDownList($activity_award_type_array)->label('奖励类型');

//$activity_award_type_value_array=Yii::$app->params['extend_params']['outsite_amount_type_addon_value'];

echo $form->field($model, 'award_content')->textInput()->label();

$model->start_time=isset($model->start_time)&&$model->start_time?date("Y-m-d H:i",intval($model->start_time)):date('Y-m-d H:i');
echo $form->field($model, 'start_time')->widget(kartik\datetime\DateTimePicker::className(), [
    //'convertFormat' => true,
    'pluginOptions' => [
        'autoclose' => true,
        'readonly' => true,
        'size' => 'ms',
        'removeButton' => false,
	'pickerButton' => ['icon' => 'time'],
        'format' => 'yyyy-mm-dd hh:ii',
        'startDate' => date('Y-m-d H:i'),
        'todayHighlight' => true
    ]
]);
$model->end_time=isset($model->end_time)&&$model->end_time?date("Y-m-d H:i",intval($model->end_time)):date("Y-m-d H:i",strtotime('+6 Hours'));
echo $form->field($model, 'end_time')->widget(kartik\datetime\DateTimePicker::className(), [
    //'convertFormat' => true,
    'pluginOptions' => [
        'autoclose' => true,
        'readonly' => true,
        'size' => 'ms',
        'removeButton' => false,
	'pickerButton' => ['icon' => 'time'],
        'format' => 'yyyy-mm-dd hh:ii',
        'startDate' => strtotime('+6 Hours'),
        'todayHighlight' => true
    ]
]);

$model->get_award_expiry_date=isset($model->get_award_expiry_date)?date("Y-m-d H:i",intval($model->get_award_expiry_date)):date("Y-m-d H:i",strtotime('+3 Months'));
echo $form->field($model, 'get_award_expiry_date')->widget(kartik\datetime\DateTimePicker::className(), [
    //'convertFormat' => true,
    'pluginOptions' => [
        'autoclose' => true,
        'readonly' => true,
        'size' => 'ms',
        'removeButton' => false,
	'pickerButton' => ['icon' => 'time'],
        'format' => 'yyyy-mm-dd hh:ii',
        'startDate' => strtotime('+3 Months'),
        'todayHighlight' => true
    ]
]);

echo '<div class="form-actions">' . Html::submitButton($model->isNewRecord ? '确定' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) . '</div>';
ActiveForm::end();