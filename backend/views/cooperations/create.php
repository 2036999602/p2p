<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\CooperationsModel */

$this->title = 'Create Cooperations Model';
$this->params['breadcrumbs'][] = ['label' => 'Cooperations Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cooperations-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
