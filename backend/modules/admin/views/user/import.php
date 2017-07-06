<?php
use yii\helpers\Html;
$this->title = $title;
$this->params['breadcrumbs'][] = ['label' => '会员管理', 'url' => ['user-index']];
$this->params['breadcrumbs'][] = $this->title;

$this->registerJsFile('@web/js/jquery.sparkline.min.js', ['depends'=>[\backend\assets\AppAsset::className()],'position'=>$this::POS_END]);

$this->registerJsFile('@web/js/jquery.raty.min.js', ['depends'=>[\backend\assets\AppAsset::className()],'position'=>$this::POS_END]);
$this->registerJsFile('@web/js/jquery.gritter.min.js', ['depends'=>[\backend\assets\AppAsset::className()],'position'=>$this::POS_END]);



$this->registerJsFile('@web/js/pages/table.js', ['depends'=>[\backend\assets\AppAsset::className()],'position'=>$this::POS_END]);
?>

    <div class="col-lg-12">
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
            <?php
            //Pjax::begin(['id'=>'formdatalist']);
            //$form=\yii\bootstrap\ActiveForm::begin(['action'=>yii\helpers\Url::to(['user-disable']),'options' => ['data-pjax' => 0,'id'=>'user-form']]);
            ?>
            <div class="box-content">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="text-left margin-bottom-sm">
<?php
                                echo \yii\bootstrap\Html::a('添加会员', ['user-add'], ['class'=>'btn btn-primary','title'=>'添加会员'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('查看帐户', 'javascript:void(0)', ['onclick'=>"commonDataOperate('".yii\helpers\Url::to(['user-view'])."','','selection[]','input','checked',false,true,true)",'class'=>'btn btn-primary','title'=>'查看帐户'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('审核', 'javascript:void(0)', ['onclick'=>"commonDataOperate('".yii\helpers\Url::to(['user-audit'])."','确定要审核吗','selection[]','input','checked',false,false,true)",'class'=>'btn btn-primary','title'=>'审核'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('屏蔽', 'javascript:void(0)', ['onclick'=>"commonDataOperate('".yii\helpers\Url::to(['user-disable'])."','确定要屏蔽吗','selection[]','input','checked',false,false,true)",'class'=>'btn btn-primary','title'=>'屏蔽'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('会员交易记录', 'javascript:void(0)', ['onclick'=>"commonDataOperate('".yii\helpers\Url::to(['user-accounts'])."','','selection[]','input','checked',true)",'class'=>'btn btn-primary','title'=>'屏蔽'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('重置密码', 'javascript:void(0)', ['onclick'=>"commonDataOperate('".yii\helpers\Url::to(['user-reset-password'])."','确定要重置吗，请确定您勾选了要重置密码的ID，以免误操作','selection[]','input','checked',false,false,true)",'class'=>'btn btn-primary','title'=>'重置密码密码'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('导出Excel', 'javascript:void(0)', ['onclick'=>"commonDataOperate('".yii\helpers\Url::to(['user-export-execl'])."','','selection[]','input','checked',false,false,true,true)",'class'=>'btn btn-primary','title'=>'导出Excel'])."&nbsp;&nbsp;";
                                echo \yii\bootstrap\Html::a('批量导入', 'javascript:void(0)', ['onclick'=>"commonDataOperate('".yii\helpers\Url::to(['user-import-infos'])."','','selection[]','input','checked',2)",'class'=>'btn btn-primary','title'=>'导入会员信息'])."&nbsp;&nbsp;";

                            ?>
                        </p>
                    </div>
                </div>
                    
                    <?php 

$form=\yii\bootstrap\ActiveForm::begin(['options'=>['enctype'=>"multipart/form-data",'class'=>'form-group']]);

echo $form->field($model, 'file',['options'=>['class'=>'form-group']])->fileInput(['accept'=>'application/x-txt-compressed,text/plain'])->label();

echo "<div class='form-group'>".yii\bootstrap\Html::a('例子下载', '/uploads/other/memberinfo.txt',['target'=>'_blank'])."</div>";
echo "<div class='form-group'>".yii\bootstrap\Html::submitButton('提交').'</div>';
echo "";
yii\bootstrap\ActiveForm::end();
?>

            </div>
        </div>
    </div>