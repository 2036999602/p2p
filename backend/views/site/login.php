<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '登录';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="row">
        <div class="login-box">
            <h2>登录</h2>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <fieldset>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true,'class'=>'input-large col-xs-12'])->label('用户名') ?>

                <?= $form->field($model, 'password')->passwordInput(['class'=>'input-large col-xs-12'])->label('密码') ?>
                <div class="clearfix"></div>
                <?= $form->field($model, 'rememberMe')->checkbox()->label('记住') ?>
                <div class="clearfix"></div>
                <div class="form-group">
                    <?= Html::submitButton('登录', ['class' => 'btn btn-primary col-xs-12', 'name' => 'login-button']) ?>
                </div>
            </fieldset>
            <?php ActiveForm::end(); ?>	
        </div>
    </div><!--/row-->
</div><!--/row-->