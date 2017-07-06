<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CooperationsSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Cooperations Models';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cooperations-model-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Cooperations Model', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'company_name',
            'company_number',
            'legal_representative',
            // 'cooperation_start_time:datetime',
            // 'cooperation_end_time:datetime',
            // 'upload_id',
            // 'aptitude_id',
            // 'introduce',
            // 'risk_management_mode',
            // 'is_forbidden',
            // 'status',
            // 'remark',
            // 'auditer_id',
            // 'created_id',
            // 'updated_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
