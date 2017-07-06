<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CooperationsSearchModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cooperations-model-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'company_name') ?>

    <?= $form->field($model, 'company_number') ?>

    <?= $form->field($model, 'legal_representative') ?>

    <?php // echo $form->field($model, 'cooperation_start_time') ?>

    <?php // echo $form->field($model, 'cooperation_end_time') ?>

    <?php // echo $form->field($model, 'upload_id') ?>

    <?php // echo $form->field($model, 'aptitude_id') ?>

    <?php // echo $form->field($model, 'introduce') ?>

    <?php // echo $form->field($model, 'risk_management_mode') ?>

    <?php // echo $form->field($model, 'is_forbidden') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'remark') ?>

    <?php // echo $form->field($model, 'auditer_id') ?>

    <?php // echo $form->field($model, 'created_id') ?>

    <?php // echo $form->field($model, 'updated_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
