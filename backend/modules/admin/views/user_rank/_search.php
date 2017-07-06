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
                'action' => ['user-index'],
                'method' => 'get',
                'options'=>['class'=>'form-horizontal text-black'],
                'fieldConfig' => [
                    'template' => '{beginWrapper}{input}{error}{endWrapper}',
                    'wrapperOptions' => [
                        'class' => 'col-lg-2'
                    ],
                ],
    ]);

    $items = ["" => "请选择", 0 => '非后台添加', 1 => '后台添加'];
    echo $form->field($model, 'add_type', ['template' => '<div class="" id="DataTables_Table_0_add_type"><label>{input}</label></div>', 'options' => ['class' => 'col-sm-2']])->dropDownList($items);

    $items = ["" => "请选择", 0 => '未实名认证', 1 => '已实名认证'];
    echo $form->field($model, 'real_name', ['template' => '<div class="" id="DataTables_Table_0_real_name"><label>{input}</label></div>', 'options' => ['class' => 'col-sm-2']])->dropDownList($items);

    $items = ["" => "请选择", 0 => '非绑定银行卡', 1 => '已绑定银行卡'];
    echo $form->field($model, 'bank_card', ['template' => '<div class="" id="DataTables_Table_0_bank_card"><label>{input}</label></div>', 'options' => ['class' => 'col-sm-2']])->dropDownList($items);
    echo $form->field($model, 'search_keyword', ['options' => []])->textInput(['placeholder' => '会员名/手机号/邮箱/推荐人','alt' => '会员名/手机号/邮箱/推荐人'])->label(false);
    echo Html::submitButton('搜索', ['class' => 'btn btn-primary col-md-1 col-sm-2 col-xs-3']);
    ActiveForm::end();
?>
</div>

