<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AdminModel */

$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '管理员管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/jquery.noty.min.js', ['depends'=>[\backend\assets\AppAsset::className()],'position'=>$this::POS_END]);
$this->registerJsFile('@web/js/jquery.raty.min.js', ['depends'=>[\backend\assets\AppAsset::className()],'position'=>$this::POS_END]);
$this->registerJsFile('@web/js/jquery.gritter.min.js', ['depends'=>[\backend\assets\AppAsset::className()],'position'=>$this::POS_END]);

?>
<div class="content">
    <div class="box">            
        <div class="box-header" data-original-title="<?= Html::encode($this->title) ?>">
            <h2>
                <i class="fa fa-user"></i>
                <span class="break"></span>
                <?= Html::encode($this->title) ?>
            </h2>
            <div class="box-icon">
                <a href="#" class="btn-setting"><i class="fa fa-wrench"></i></a>
                <a href="#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                <a href="#" class="btn-close"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="box-content">
            <div class="row">
                <div class="col-lg-12">

                    <?=
                    $this->render('_form', [
                        'model' => $model,
                        'roles'=>$roles,
                        'cooperations'=>$cooperations
                    ])
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>
