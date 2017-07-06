<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AptitudesModel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Aptitudes Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="aptitudes-model-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'aptitude_name',
            'upload_id',
        ],
    ]) ?>

</div>
