<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\AptitudesModel */

$this->title = 'Update Aptitudes Model: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Aptitudes Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="aptitudes-model-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
