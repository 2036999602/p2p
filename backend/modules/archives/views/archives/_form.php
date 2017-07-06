<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AdminModel */
/* @var $form yii\widgets\ActiveForm */

$form = ActiveForm::begin([
            'id' => 'ArchivesTypeModel',
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
echo $form->field($model, 'title')->textInput()->label('标题：');

$type_array=\yii\helpers\ArrayHelper::map($types, 'id', 'type_name');
echo $form->field($model, 'type_id')->dropDownList($type_array);

//echo $form->field($model, 'litpic')->fileInput()->label('图片');

echo "<div class='input-group'>图片：".\nemmo\attachments\components\AttachmentsInput::widget([
		'id' => 'file-input-litpic', // Optional
		'model' => $model,
		'options' => [ // Options of the Kartik's FileInput widget
			'multiple' => false, // If you want to allow multiple upload, default to false
		],
		'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget 
			'maxFileCount' => 1, // Client max files
                    'doc_model'=>$model->formName(),
                    'doc_id'=>$model->id,
                    'showUpload'=>false,
		]
	]).'</div>';


echo $form->field($article_model, 'content')->widget(\crazydb\ueditor\UEditor::className())->label('内容');


echo '<div class="form-actions">' . Html::submitButton($model->isNewRecord ? '确定' : '提交', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) . '</div>';
ActiveForm::end();