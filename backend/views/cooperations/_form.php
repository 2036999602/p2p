<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\CooperationsModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cooperations-model-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'legal_representative')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cooperation_start_time')->textInput() ?>

    <?= $form->field($model, 'cooperation_end_time')->textInput() ?>

    <?= $form->field($model, 'upload_id')->textInput() ?>

    <?= $form->field($model, 'aptitude_id')->textInput() ?>

    <?= $form->field($model, 'introduce')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'risk_management_mode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'is_forbidden')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auditer_id')->textInput() ?>

    <?= $form->field($model, 'created_id')->textInput() ?>

    <?= $form->field($model, 'updated_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
