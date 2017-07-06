<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AptitudesModel */

$this->title = 'Create Aptitudes Model';
$this->params['breadcrumbs'][] = ['label' => 'Aptitudes Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aptitudes-model-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
