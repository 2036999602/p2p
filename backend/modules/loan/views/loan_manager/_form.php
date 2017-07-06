<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */

$form = ActiveForm::begin([
            'id' => 'LoansModel',
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
echo $form->field($model, 'cooperation_code')->textInput()->label('企业编码'.\backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel')->getSingleAttribute('company_number',['id'=>$model->cooperation_id]));
echo $form->field($model, 'loan_amount')->textInput()->label('借款金额（元）');
echo $form->field($model, 'mini_investment_amount')->textInput()->label('最低投标限额（元）');
echo $form->field($model, 'year_yield_rate')->textInput()->label('年化收益率（%）');
$loan_bid_types=Yii::$app->params['extend_params']['loan_bid_type'];
echo $form->field($model, 'loan_bid_type')->dropDownList($loan_bid_types)->label('标种类型');
echo $form->field($model, 'term_of_loan')->textInput()->label();
$loan_types=\yii\helpers\ArrayHelper::map(common\logic\BaseLogic::getInstance()->loadModel('FinancialTypeModel')->getList(true),'id','financial_name');
echo $form->field($model, 'loan_type')->dropDownList($loan_types)->label('借贷类型');
$repayment_types=\yii\helpers\ArrayHelper::map(common\logic\BaseLogic::getInstance()->loadModel('PaymentTypeModel')->getList(true),'id','payment_name');
echo $form->field($model, 'repayment_type')->dropDownList($repayment_types)->label();


echo $form->field($model, 'investment_award_type')->dropDownList(Yii::$app->params['extend_params']['investment_award_type'])->label('奖励类型');
echo $form->field($model, 'investment_award_amount')->textInput()->label();

echo $form->field($model, 'need_password')->textInput(['placeholder'=>'填写密码则变为定向标'])->label('投标限定');

if(empty(\yii\helpers\ArrayHelper::toArray($aptitude_model))){
echo '<div class="form-group">
	<div class="box">
            <div class="box-header">
		<h2><i class="fa fa-list"></i><span class="break"></span>认证信息</h2>
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
    echo $this->render('/loan_manager/_add_more_aptitudes', ['form'=>$form,'aptitude_model'=>$model]);
}

echo $form->field($model, 'load_content')->widget(\crazydb\ueditor\UEditor::className())->label();
echo $form->field($model, 'repayment_source')->widget(\crazydb\ueditor\UEditor::className())->label();
echo $form->field($model, 'repayment_guarantee')->widget(\crazydb\ueditor\UEditor::className())->label();



echo '<div class="form-actions">' . Html::submitButton($model->isNewRecord ? '确定' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) . '</div>';
ActiveForm::end();