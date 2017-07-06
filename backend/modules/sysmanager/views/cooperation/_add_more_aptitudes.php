<?php
$aptitude_model=new \common\models\AptitudesModel();
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