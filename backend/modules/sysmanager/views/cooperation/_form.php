<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminModel */
/* @var $form yii\widgets\ActiveForm */

$form = ActiveForm::begin([
            'id' => 'CooperatsModel',
            'options' => ['enctype' => 'multipart/form-data'],
            'fieldConfig' => [
                'template' => '{beginWrapper}{label}&nbsp;{error}{input}{endWrapper}',                
                'errorOptions' => [
                    'tag' =>'label',
                    'class' => 'text-warning', 
                ],
                'inputTemplate' => '{input}',
            ],
        ]);
echo $form->field($model, 'company_name')->textInput()->label('企业名称：');
echo $form->field($model, 'company_number')->textInput()->label('企业编号：');
echo $form->field($model, 'legal_representative')->textInput()->label('法定代表人：');


$model->cooperation_start_time=!empty(intval($model->cooperation_start_time))?date("Y-m-d H:i",intval($model->cooperation_start_time)):'';
echo $form->field($model, 'cooperation_start_time')->widget(kartik\datetime\DateTimePicker::className(), [
    'convertFormat' => true,
    'pluginOptions' => [
        'autoclose' => true,
        'readonly' => true,
        'size' => 'ms',
        'removeButton' => false,
	'pickerButton' => ['icon' => 'time'],
        'format' => 'yyyy-MM-dd hh:i',
        'startDate' => date('Y-m-d H:i'),
        'todayHighlight' => true
    ]
]);
$model->cooperation_end_time=!empty(intval($model->cooperation_end_time))?date("Y-m-d H:i",intval($model->cooperation_end_time)):'';
echo $form->field($model, 'cooperation_end_time')->widget(kartik\datetime\DateTimePicker::className(), [
    'convertFormat' => true,
    'pluginOptions' => [
        'autoclose' => true,
        'readonly' => true,
        'size' => 'ms',
        'removeButton' => false,
	'pickerButton' => ['icon' => 'time'],
        'format' => 'yyyy-MM-dd hh:i',
        'startDate' => strtotime('+6 Hours'),
        'todayHighlight' => true
    ]
]);

$model->file='file';
echo $form->field($model, 'file',['template'=>'{label}&nbsp;{error}{input}'.(!empty($model->upid)?\yii\bootstrap\Html::a('查看', yii\helpers\Url::to(['/attachments/file/show-image','id'=>$model->upid]),['target'=>'_blank']):"")])->fileInput()->label('合同：');

if(empty(\yii\helpers\ArrayHelper::toArray($aptitude_model))){
echo '<div class="form-group">
	<div class="box">
            <div class="box-header">
		<h2><i class="fa fa-list"></i><span class="break"></span>企业资质</h2>
            </div>
            <div class="input-group"><a href="javascript:void(0)" class="btn btn-primary" onclick="addMore(\'aptitudes\',\'input-group\')">增加更多</a></div>
            <div class="box-content" id="aptitudes">
            <div class="input-group">
            '.$form->field($aptitude_model, 'sorts[]',['options'=>['class'=>'col-lg-4']])->textInput()->label('排序，数字大优先').'
            '.$form->field($aptitude_model, 'aptitude_name[]',['options'=>['class'=>'col-lg-4']])->textInput()->label('名称').'
            '.$form->field($aptitude_model, 'files[]',['options'=>['class'=>'col-lg-4']])->fileInput(['multiple'=>'multiple'])->label('图片').'
            </div>
	</div>
        <div class="input-group"><a href="javascript:void(0)" class="btn btn-primary" onclick="addMore(\'aptitudes\',\'input-group\')">增加更多</a></div>
    </div>';
}else{
    echo $form->field($model, 'id')->hiddenInput()->label(false);
    echo yii\grid\GridView::widget([
        'dataProvider' => $aptitude_model,
        'summary'=>false,
        'layout' => "{items}\n{pager}",
        'columns'=>[
            [
                'attribute'=>'aptitude_name',
                'label'=>'认证项目'
            ],
            [
                'attribute'=>'upid',
                'label'=>'图片',
                'content'=>function($aptitude_model){return yii\bootstrap\Html::a('查看',yii\helpers\Url::to(['/attachments/file/show-image','id'=>$aptitude_model->id]),['target'=>'_blank']);},
            ],
            [
                'attribute'=>'sorts',
                'label'=>'排序',
                'content'=>function($aptitude_model){return $aptitude_model->sorts;},
            ],
            [
                'attribute'=>false,
                'label'=>'操作',//commonDataOperate('/index.php?r=admin%2Findex%2Fcooperation-delete','确定要删除所选么？','selection[]','input','checked',false,false,false,true)
                'content'=>function($aptitude_model){return ''.Html::a('删除<input type="checkbox" style="display:none;" name="selection[]" value="'.$aptitude_model->id.'" />', 'javascript:void(0)', ['onclick'=>"\$(this).find('input').attr('checked','checked');commonDataOperate('".yii\helpers\Url::to(['/filemanager/files/delete','id'=>$aptitude_model->id])."','确定要删除吗','selection[]','input','checked',false,false,false,true)"]);}
            ],
        ],
    ]);
    echo $this->render('/cooperation/_add_more_aptitudes', ['form'=>$form,'aptitude_model'=>$model]);
}
echo $form->field($model, 'introduce')->textInput()->label('企业简介：');
echo $form->field($model, 'risk_management_mode')->textarea()->label('风控模式：');


echo '<div class="form-actions">' . Html::submitButton($model->isNewRecord ? '确定' : '提交', ['onclick' => "$('#file-input').fileinput('upload');",'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) . '</div>';
ActiveForm::end();