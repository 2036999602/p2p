<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CooperationsModel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cooperations Models', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cooperations-model-view">

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
            'user_id',
            'company_name',
            'company_number',
            'legal_representative',
            'cooperation_start_time:datetime',
            'cooperation_end_time:datetime',
            'upload_id',
            'aptitude_id',
            'introduce',
            'risk_management_mode',
            'is_forbidden',
            'status',
            'remark',
            'auditer_id',
            'created_id',
            'updated_id',
        ],
    ]) ?>

</div>
