<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminSearchModel */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row text-left">
    <?php
    $form = ActiveForm::begin([
                'action' => ['trade-index'],
                'method' => 'get',
                'options'=>['class'=>'form-horizontal text-black'],
                'fieldConfig' => [
                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                    'wrapperOptions' => [
                        'class' => 'col-lg-2'
                    ],
                ],
    ]);

    $items = yii\helpers\ArrayHelper::merge(["" => "请选择"],Yii::$app->params['extend_params']['trade_type']);
    echo $form->field($model, 'trade_type', ['template' => '<div class="" id="DataTables_Table_0_add_type"><label>{input}</label></div>', 'options' => ['class' => 'col-sm-2']])->dropDownList($items);

    echo $form->field($model, 'id', ['options' => []])->textInput(['placeholder' => '项目编号','alt' => '项目编号'])->label(false);
    echo Html::submitButton('搜索', ['class' => 'btn btn-primary col-md-1 col-sm-2 col-xs-3']);
    ActiveForm::end();
?>
</div>

