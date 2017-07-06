<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\AptitudesModel */

$this->title = $title;
//$this->params['breadcrumbs'][] = ['label' => 'Aptitudes Models', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-model-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            'username',
            'mobile',
            'email',
            [
                'attribute'=>false,
                'label'=>'客户号',
                'value'=>function($model){return 'rrrrrss3324';}
            ],
            [
                'attribute'=>false,
                'label'=>'帐户总金额',
                'value'=>function($model){return 555555555.00;}
            ],
            [
                'attribute'=>false,
                'label'=>'冻结金额',
                'value'=>function($model){return 335555.00;}
            ],
            [
                'attribute'=>false,
                'label'=>'可用余额',
                'value'=>function($model){return 6555.00;}
            ],
            [
                'attribute'=>false,
                'label'=>'借款次数',
                'value'=>function($model){return 12;}
            ],
            [
                'attribute'=>false,
                'label'=>'借款总金额',
                'value'=>function($model){return 56433446555.00;}
            ],
            [
                'attribute'=>false,
                'label'=>'待还总金额',
                'value'=>function($model){return 8754566555.00;}
            ],
            [
                'attribute'=>false,
                'label'=>'预期次数',
                'value'=>function($model){return 2;}
            ],
            [
                'attribute'=>false,
                'label'=>'性别',
                'value'=>function($model){
                    return Yii::$app->params['extend_params']['member_info']['sex'][$model->sex];                
                },
            ],
            'mobile',
            'identification_card',
            'bank_card',
            'education_background',
                    
            [
                'attribute'=>'marriage',
                'label'=>'婚姻',
                'value'=>function($model){
                        return Yii::$app->params['extend_params']['member_info']['marriage'][$model->marriage];                    
                },
            ],
            'address',
            'trade',
            'professional_title',
        ],
    ]) ?>
</div>
