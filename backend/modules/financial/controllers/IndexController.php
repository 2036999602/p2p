<?php

namespace backend\modules\financial\controllers;

use yii\web\Controller;

/**
 * Default controller for the `financial` module
 */
class IndexController extends Controller
{    
    public $post;
    public $get;
    private $ids;
    
    public function init() {
        parent::init();
        $this->post = \Yii::$app->getRequest()->post();
        $this->get = \Yii::$app->getRequest()->get();
        $this->ids = isset($this->post['id']) ? (strrpos($this->post['id'], ",") ? explode(",", $this->post['id']) : [$this->post['id']]) : [];
        if (empty($this->ids) && isset($this->post['selection']) && !empty($this->post['selection'])) {
            $this->ids = $this->post['selection'];
        }
        if(empty($this->ids) && isset($this->get['id']) && !empty($this->get['id'])){
            $this->ids = strrpos($this->get['id'], ",") ? explode(",", $this->get['id']) : [$this->get['id']];
        }
    }
    
    /**
     * 说明：费用列表
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionCostIndex(){
        $list=\common\logic\BaseLogic::getInstance()->loadModel('FinancialConfigCostModel')->getList(false);
        return $this->render('/cost/index', ['title'=>'费用设置','list'=>$list]);
    }
    
    /**
     * 说明：增加费用
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionCostAdd(){
        $logic=\common\logic\BaseLogic::getInstance()->loadModel('FinancialConfigCostModel');        
        if($this->post){
            $result=$logic->scenario('cost-add')->save($this->post);
            if($result){
                return $this->redirect(['/financial/index/cost-index']);
            }
        }
        $model=$logic->getModel();
        return $this->render('/cost/add', ['title'=>'增加费用设置','model'=>$model]);
    }
    
    /**
     * 说明：编辑费用
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionCostUpdate(){
        $logic=\common\logic\BaseLogic::getInstance()->loadModel('FinancialConfigCostModel');
        $model=$logic->getOne(['id'=>$this->ids[0]]);
        if($this->post){
            $result=$logic->update(['id'=>$this->ids[0]],$this->post);
            if($result){
                return $this->redirect(['/financial/index/cost-index']);
            }
        }
        return $this->render('/cost/update', ['title'=>'修改费用设置','model'=>$model]);
    }
    //费用结束
    
    
    
    /**
     * 说明：交易记录列表
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionTradeIndex(){
        
        $join = [
            'table' => ['name' => 'trades', 'alias' => 't'],
            'join_table' => [
                ['name' => 'user', 'alias' => 'u', 'join_type' => 'left', 'on' => 't.user_id=u.id'],
                ],
            'select' => 'u.username,t.*',
        ];
        $search_filter =[];
        if(isset($this->get['FinancialConfigTradesModel']['trade_type'])){
            array_push($search_filter, ['var_type'=>'int','var_name'=>'trade_type','table_alias'=>'t','filter_method'=>'and']);
        }
        if(isset($this->get['FinancialConfigTradesModel']['id'])){
            array_push($search_filter, ['var_type'=>'int','var_name'=>'id','table_alias'=>'t','filter_method'=>'and']);
        }
        $where=[];
        $list = \common\logic\BaseLogic::getInstance()->loadModel('FinancialConfigTradesModel')->getList(false, $where, ['id'=>SORT_DESC], 10, $join, 10, $this->get, $search_filter);

        $model = new \common\models\FinancialConfigTradesModel();
        return $this->render('/trades/index', [
                    'list' => $list,
                    'model' => $model,
                    'title' => '交易记录',
        ]);
        
    }
    
    //交易记录结束
    
    /**
     * 说明：提现申请列表
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionWithdrawCashIndex(){
        
        $join = [
            'table' => ['name' => 'withdraw_cash', 'alias' => 'wc'],
            'join_table' => [
                ['name' => 'user', 'alias' => 'u', 'join_type' => 'left', 'on' => 'wc.user_id=u.id'],
                ],
            'select' => 'u.username,wc.*',
        ];
        $search_filter =[];
        
        if(isset($this->get['FinancialConfigWithdrawCashModel']['user_id'])){
            $user_id=\backend\logic\UserLogic::getInstance()->getModel()->find()->select('id')->where(['username'=>$this->get['FinancialConfigWithdrawCashModel']['user_id']])->scalar();
            if($user_id){
                $this->get['FinancialConfigWithdrawCashModel']['user_id']=$user_id;
                array_push($search_filter, ['var_type'=>'int','var_name'=>'user_id','table_alias'=>'wc','filter_method'=>'and']);            
            }
        }
        $start_time=false;
        $end_time=false;
        if(isset($this->get['FinancialConfigWithdrawCashModel']['search_start_time'])){
            $start_time=strtotime($this->get['FinancialConfigWithdrawCashModel']['search_start_time']);
        }
        if(isset($this->get['FinancialConfigWithdrawCashModel']['search_end_time'])){
            $end_time=strtotime($this->get['FinancialConfigWithdrawCashModel']['search_end_time']);
        }
        if($start_time && $end_time){        
            array_push($search_filter, ['var_query_range'=>[$start_time,$end_time],'var_type'=>'int','var_name'=>'created_at','table_alias'=>'wc','filter_method'=>'and']);            
        }
        elseif($start_time){
           array_push($search_filter, ['var_query_range'=>[$start_time,null],'var_type'=>'int','var_name'=>'created_at','table_alias'=>'wc','filter_method'=>'and']);            
        }
        elseif($end_time){
           array_push($search_filter, ['var_query_range'=>[null,$end_time],'var_type'=>'int','var_name'=>'created_at','table_alias'=>'wc','filter_method'=>'and']);            
        }
        $where=[];
        $list = \common\logic\BaseLogic::getInstance()->loadModel('FinancialConfigWithdrawCashModel')->getList(false, $where, ['id'=>SORT_DESC], 10, $join, 10, $this->get, $search_filter);

        $model = new \common\models\FinancialConfigWithdrawCashModel();
        return $this->render('/withdraw_cash/index', [
                    'list' => $list,
                    'model' => $model,
                    'title' => '提现申请',
        ]);
        
    }
    
    /**
     * 说明：提现申请列表
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionWithdrawCashAudit(){
        if($this->post){
            $logic=\common\logic\BaseLogic::getInstance()->loadModel('FinancialConfigWithdrawCashModel');
            if(isset($this->get['status'])){
                $this->post[$logic->getModel()->formName()]['status']=$this->get['status'];
                $this->post[$logic->getModel()->formName()]['audite_time']=time();
            }
            $result = $logic->update($this->ids,$this->post);
            if($result){
                if(\Yii::$app->getRequest()->isAjax){
                    return json_encode(['status'=>1,'msg'=>'操作成功','data'=>['title'=>'审核提现','content'=>'操作成功']]);
                }
                \Yii::$app->session->setFlash('success', '操作成功');
            }else{
                if(\Yii::$app->getRequest()->isAjax){
                    return json_encode(['status'=>0,'msg'=>'操作失败','data'=>['title'=>'审核提现','content'=>'操作失败']]);
                }
                \Yii::$app->session->setFlash('error', '操作失败');
            }
        }
        return $this->redirect(['withdraw-cash-index']);
    }
    
    //提现申请结束
    
    //用户资金开始
    //交易记录结束
    
    /**
     * 说明：提现申请列表
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUserFinancesIndex(){        
        $list = \common\logic\BaseLogic::getInstance()->loadModel('FinancialConfigUserFinancesModel')->getList(false);
        
        return $this->render('/user_finances/index', [
                    'list' => $list,
                    'title' => '用户资金列表',
        ]);
        
    }
    //用户资金结束
    
    
    
    /**
     * 说明：平台资金列表
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionPlatformFundsIndex(){        
        $model = \common\logic\BaseLogic::getInstance()->loadModel('FinancialConfigPlatformFundsModel')->getOne();
        $member_count=\backend\logic\UserLogic::getInstance()->loadModel('User')->getModel()->find()->count();        
        $member_man_count=\backend\logic\UserLogic::getInstance()->loadModel('User')->getModel()->find()->from(\common\models\User::tableName().' as u')->leftjoin(\common\models\MemberExtModel::tableName().' as ext','u.id=ext.user_id')->where(['ext.sex'=>1])->count('u.id');
        $member_vip_count=\backend\logic\UserLogic::getInstance()->loadModel('User')->getModel()->find()->from(\common\models\MemberExtModel::tableName().' as u')->leftjoin(\common\models\MemberRankModel::tableName().' as mr','u.rank_id=mr.id')->where(['like','mr.rank_name','vip'])->count('u.id');
        
        $member_recharge_success_sum=\common\logic\BaseLogic::getInstance()->loadModel('FinancialConfigTradesModel')->getModel()->find()->where(['status'=>1,'trade_type'=>1])->sum('amount');
        $member_withdraw_cash_success_sum=\common\logic\BaseLogic::getInstance()->loadModel('FinancialConfigTradesModel')->getModel()->find()->where(['status'=>1,'trade_type'=>2])->sum('amount');
        $member_amount_sum=\common\logic\BaseLogic::getInstance()->loadModel('MemberAccountModel')->getModel()->find()->sum('amount');
        $member_frozen_amount_sum=\common\logic\BaseLogic::getInstance()->loadModel('MemberAccountModel')->getModel()->find()->sum('frozen_amount');
        $member['all_count']=$member_count;
        $member['man_count']=$member_man_count;
        $member['woman_count']=$member_count-$member_man_count;
        $member['vip_count']=$member_vip_count;
        $member['recharge_sum']=$member_recharge_success_sum;
        $member['withdraw_cash_sum']=$member_withdraw_cash_success_sum;
        $member['amount_sum']=$member_amount_sum;
        $member['frozen_amount_sum']=$member_frozen_amount_sum;
        //$member_obj=new \yii\base\Object(['all_count','man_count']);
        $member_obj=new \yii\base\DynamicModel($member);

        //echo $member_withdraw_cash_success_sum;die;
        //(new \common\models\User())->find()->sum($q);
        return $this->render('/platform_funds/index', [
                    'model' => $model,
                    'title' => '平台资金列表',
                    'member_obj'=>$member_obj,
        ]);
        
    }
    
    /**
     * 说明：平台充值
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionPlatformFundsRecharge(){
        $model = \common\logic\BaseLogic::getInstance()->loadModel('FinancialConfigPlatformFundsModel')->getOne(['id'=>$this->ids[0]]);
        $model->setScenario('platform-funds-recharge');
        if($model->load($this->post) && $model->validate()){
            $model->amount=$model->recharge_amount+$model->amount;
            $result=$model->save();
            if($result){
                \Yii::$app->session->setFlash('success', '充值成功');
                return $this->redirect(['platform-funds-index']);
            }
            \Yii::$app->session->setFlash('error', '充值失败');
        }
        return $this->render('/platform_funds/add', [
                    'model' => $model,
                    'title' => '平台充值',
        ]);
        
    }
    //平台资金结束
    
    //平台代偿还开始
     /**
     * 说明：平台资金列表
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionAssumptionIndex(){        
        $list = \common\logic\BaseLogic::getInstance()->loadModel('FinancialConfigAssumptionModel')->getList(false);

        return $this->render('/assumption/index', [
                    'list' => $list,
                    'title' => '平台代偿还列表',
        ]);
        
    }
    //理台代偿还结束
}
