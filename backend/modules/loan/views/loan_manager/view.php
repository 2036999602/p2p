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
            [
                'attribute'=>false,
                'label'=>'申请人',
                'format'=>'raw',
                'value'=>function($model) use ($addon_info){return $addon_info['real_name']."&nbsp;".common\logic\BaseLogic::getInstance()->loadModel('MemberRankModel')->getSingleAttribute('rank_name',['id'=>$addon_info['rank_id']]);}
            ],
            [
                'attribute'=>false,
                'label'=>'帐号手机号',
                'format'=>'raw',
                'value'=>function($model) use ($addon_info){return $addon_info['mobile'];}
            ],
            [
                'attribute'=>false,
                'label'=>'可用金额',
                'format'=>'raw',
                'value'=>function($model){
                return common\logic\BaseLogic::getInstance()->loadModel('MemberAccountModel')->getSingleAttribute('amount',['user_id'=>$model->user_id]);
                
                }
            ],
            'loan_amount',
            [
                'attribute'=>'loaner_property',
                //'label'=>'客户号',
                'value'=>function($model){return Yii::$app->params['extend_params']['loaner_property'][$model->loaner_property];}
            ],
            [
                'attribute'=>false,
                'label'=>'邮箱',
                'format'=>'raw',
                'value'=>function($model) use ($addon_info){return $addon_info['email'];}
            ],
            [
                'attribute'=>false,
                'label'=>'签约企业',
                'format'=>'raw',
                'value'=>function($model) use ($addon_info){return $addon_info['company_name'];}
            ],
            [
                'attribute'=>'created_at',
                'label'=>'申请时间',
                'value'=>function($model){return date('Y-m-d H:i',$model->created_at);}
            ],
            [
                'attribute'=>'status',
                'label'=>'标的状态',
                'value'=>function($model){return Yii::$app->params['extend_params']['loan_status'][$model->status];}
            ],
            [
                'attribute'=>false,
                'label'=>'借款次数',
                'value'=>function($model){return backend\logic\LoanLogic::getInstance()->loadModel('loansModel')->getModel()->find()->where(['status'=>6,'user_id'=>$model->user_id])->count();}
            ],
            [
                'attribute'=>false,
                'label'=>'借款总金额',
                'value'=>function($model){return backend\logic\LoanLogic::getInstance()->loadModel('loansModel')->getModel()->find()->where(['status'=>6,'user_id'=>$model->user_id])->sum('loan_amount');}
            ],
            [
                'attribute'=>false,
                'label'=>'待还总金额',
                'value'=>function($model){
                return common\logic\BaseLogic::getInstance()->loadModel('LoanRepaymentModel')->getModel()->find()->where(['user_id'=>$model->user_id])->sum('repayment_of_principal')+common\logic\BaseLogic::getInstance()->loadModel('LoanRepaymentModel')->getModel()->find()->where(['user_id'=>$model->user_id])->sum('interest_payable');
                
                }
            ],
            [
                'attribute'=>false,
                'label'=>'逾期次数',
                'value'=>function($model){return common\logic\BaseLogic::getInstance()->loadModel('LoanRepaymentModel')->getModel()->find()->where(['and',['user_id'=>$model->user_id],['>','overdue_days',0]])->count();}
            ],
            [
                'attribute'=>false,
                'label'=>'性别',
                'format'=>'raw',
                'value'=>function($model) use ($addon_info){return !isset($addon_info['sex'])?"":Yii::$app->params['extend_params']['member_info']['sex'][$addon_info['sex']];}
            ],
            [
                'attribute'=>false,
                'label'=>'手机号',
                'format'=>'raw',
                'value'=>function($model) use ($addon_info){return !isset($addon_info['mobile'])?"":$addon_info['mobile'];}
            ],
            [
                'attribute'=>false,
                'label'=>'身份证',
                'format'=>'raw',
                'value'=>function() use ($addon_info){return !isset($addon_info['identification_card'])?"":$addon_info['identification_card'];}
            ],
            [
                'attribute'=>false,
                'label'=>'银行卡号',
                'format'=>'raw',
                'value'=>function() use ($addon_info){return !isset($addon_info['bank_card'])?"":$addon_info['bank_card'];}
            ],
            [
                'attribute'=>false,
                'label'=>'学历',
                'format'=>'raw',
                'value'=>function() use ($addon_info){return !isset($addon_info['education_background'])?"":$addon_info['education_background'];}
            ],
            [
                'attribute'=>false,
                'label'=>'婚烟',
                'format'=>'raw',
                'value'=>function() use ($addon_info){return !isset($addon_info['marriage'])?"":$addon_info['marriage'];}
            ],
            [
                'attribute'=>false,
                'label'=>'住址',
                'format'=>'raw',
                'value'=>function() use ($addon_info){return !isset($addon_info['address'])?"":$addon_info['address'];}
            ],
            [
                'attribute'=>false,
                'label'=>'行业',
                'format'=>'raw',
                'value'=>function() use ($addon_info){return !isset($addon_info['trade'])?"":$addon_info['trade'];}
            ],
            [
                'attribute'=>false,
                'label'=>'职称',
                'format'=>'raw',
                'value'=>function() use ($addon_info){return !isset($addon_info['professional_title'])?"":$addon_info['professional_title'];}
            ],            
            [
                'attribute'=>false,
                'label'=>'就职公司',
                'value'=>function($model){
                        return '某某公司';
                },
            ],
            [
                'attribute'=>false,
                'label'=>'就职公司地址',
                'value'=>function($model){
                        return '某某路';                    
                },
            ],
            [
                'attribute'=>false,
                'label'=>'风控提醒',
                'value'=>function($model){
                        return backend\logic\LoanLogic::getInstance()->loadModel('LoansModel')->getModel()->find()->select('id')->where(['status'=>[0,1,2,5]])->scalar()?"提醒，尚有一笔借款进行中":"";                    
                },
            ],
            'usage_of_loan',
        ],
    ]) ?>
</div>
