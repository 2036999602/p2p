<?php

namespace backend\modules\interaction\controllers;

use yii\web\Controller;

/**
 * Default controller for the `interaction` module
 */
class ActivityManagerController extends Controller
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
     * 活动列表
     * @return string
     */
    public function actionIndex()
    {
        $logic=\common\logic\BaseLogic::getInstance()->loadModel('ActivityModel');       
        $model=$logic->getModel();
        $to_array=false;
        $where=[];
        $orderby=['id'=>SORT_DESC];
        $limit=10;
        $join=[];
        $page_item_num=10;
        
        $search_filter=[];
        if(isset($this->get[$model->formName()]['activity_name'])){
            $search_filter[]=[
                'var_type'=>'string',//该字段的类型 int 与 string 或者var_query_range=[value1,value2]
                'var_name'=>'activity_name',//字段名
                'table_alias'=>'',//表的别名，与join_table的设置一致，add_type是member_ext表的字段
                'filter_method'=>'and'//查询关联方法 and 与 or
            ];
        }
        if(isset($this->get[$model->formName()]['start_time']) && $this->get[$model->formName()]['start_time']){
            $this->get[$model->formName()]['start_time']=strtotime($this->get[$model->formName()]['start_time']);
            $search_filter[]=[
                'var_type'=>'int',//该字段的类型 int 与 string 或者var_query_range=[value1,value2]
                'operator'=>'>=',
                'var_name'=>'start_time',//字段名
                'table_alias'=>'',//表的别名，与join_table的设置一致，add_type是member_ext表的字段
                'filter_method'=>'and'//查询关联方法 and 与 or
            ];
        }
        if(isset($this->get[$model->formName()]['end_time']) && $this->get[$model->formName()]['end_time']){
            $this->get[$model->formName()]['end_time']=strtotime($this->get[$model->formName()]['end_time']);
            $search_filter[]=[
                'var_type'=>'int',//该字段的类型 int 与 string 或者var_query_range=[value1,value2]
                'var_name'=>'end_time',//字段名
                'operator'=>'<=',
                'table_alias'=>'',//表的别名，与join_table的设置一致，add_type是member_ext表的字段
                'filter_method'=>'and'//查询关联方法 and 与 or
            ];
        }
        $http_query=$this->get;
        $list=$logic->getList($to_array,$where,$orderby,$limit,$join,$page_item_num,$http_query,$search_filter);
        //print_r($list);die;
        return $this->render('/activity_manager/index',['title'=>'活动管理','list'=>$list,'model'=>$model]);
    }
    
    /**
     * 说明：增加活动
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionAdd(){
        $logic=\common\logic\BaseLogic::getInstance()->loadModel('ActivityModel'); 
        $model=$logic->getModel();
        if($this->post){
            $this->post[$model->formName()]['start_time']=strtotime($this->post[$model->formName()]['start_time']);
            $this->post[$model->formName()]['end_time']=strtotime($this->post[$model->formName()]['end_time']);
            $this->post[$model->formName()]['get_award_expiry_date']=strtotime($this->post[$model->formName()]['get_award_expiry_date']);
            $this->post[$model->formName()]['user_id']=\Yii::$app->user->id;
            $result=$logic->save($this->post);
            if($result){
                return $this->redirect(['index']);
            }
        }
        $member_ranks=\common\logic\BaseLogic::getInstance()->loadModel('MemberRankModel')->getList(true,['is_enable'=>1]);
        $financial_types=\common\logic\BaseLogic::getInstance()->loadModel('FinancialTypeModel')->getList(true);
        return $this->render('/activity_manager/add',['title'=>'增加活动','model'=>$model,'member_ranks'=>$member_ranks,'financial_types'=>$financial_types]);
    }
    
    /**
     * 说明：编辑
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUpdate(){
        $logic=\common\logic\BaseLogic::getInstance()->loadModel('ActivityModel'); 
        $model=$logic->getOne(['id'=>$this->ids[0]]);
        if($this->post){
            $this->post[$model->formName()]['start_time']=strtotime($this->post[$model->formName()]['start_time']);
            $this->post[$model->formName()]['end_time']=strtotime($this->post[$model->formName()]['end_time']);
            $this->post[$model->formName()]['get_award_expiry_date']=strtotime($this->post[$model->formName()]['get_award_expiry_date']);
            $this->post[$model->formName()]['user_id']=\Yii::$app->user->id;
            $result=$logic->update($this->ids,$this->post);
            if($result){
                return $this->redirect(['index']);
            }
        }
        $member_ranks=\common\logic\BaseLogic::getInstance()->loadModel('MemberRankModel')->getList(true,['is_enable'=>1]);
        $financial_types=\common\logic\BaseLogic::getInstance()->loadModel('FinancialTypeModel')->getList(true);
        return $this->render('/activity_manager/update',['title'=>'编辑活动','model'=>$model,'member_ranks'=>$member_ranks,'financial_types'=>$financial_types]);
    }
    
    /**
     * 说明：审核
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionAudit(){
        $logic=\common\logic\BaseLogic::getInstance()->loadModel('ActivityModel'); 
        $model=$logic->getOne(['id'=>$this->ids[0]]);
        $status=0;
        if($model){
            $status=$model->status;
        }
        if($this->post){
            $this->post[$model->formName()]['status']=$status===1?0:1;            
            $result=$logic->update($this->ids,$this->post);
            if($result){
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>1,'msg'=>'操作成功','data'=>['titlle'=>'审核','content'=>'操作成功']]);
                }else{
                    return $this->redirect(['index']);
                }
            }else{
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>0,'msg'=>'操作失败','data'=>['titlle'=>'审核','content'=>'操作失败']]);
                }
            }
        }
        $member_ranks=\common\logic\BaseLogic::getInstance()->loadModel('MemberRankModel')->getList(true,['is_enable'=>1]);
        $financial_types=\common\logic\BaseLogic::getInstance()->loadModel('FinancialTypeModel')->getList(true);
        return $this->render('/activity_manager/update',['title'=>'编辑活动','model'=>$model,'member_ranks'=>$member_ranks,'financial_types'=>$financial_types]);
    }
    
    /**
     * 说明：暂停
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionSuspend(){
        $logic=\common\logic\BaseLogic::getInstance()->loadModel('ActivityModel'); 
        $model=$logic->getOne(['id'=>$this->ids[0]]);
        $status=0;
        if($model){
            $status=$model->status;
        }
        if($this->post){
            $this->post[$model->formName()]['status']=$status===3?1:3;            
            $result=$logic->update($this->ids,$this->post);
            if($result){
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>1,'msg'=>'操作成功','data'=>['titlle'=>'暂停','content'=>'操作成功']]);
                }else{
                    return $this->redirect(['index']);
                }
            }else{
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>0,'msg'=>'操作失败','data'=>['titlle'=>'暂停','content'=>'操作失败']]);
                }
            }
        }
        $member_ranks=\common\logic\BaseLogic::getInstance()->loadModel('MemberRankModel')->getList(true,['is_enable'=>1]);
        $financial_types=\common\logic\BaseLogic::getInstance()->loadModel('FinancialTypeModel')->getList(true);
        return $this->render('/activity_manager/update',['title'=>'编辑活动','model'=>$model,'member_ranks'=>$member_ranks,'financial_types'=>$financial_types]);
    }
    
    /**
     * 说明：删除
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionDelete(){
        $logic=\common\logic\BaseLogic::getInstance()->loadModel('ActivityModel'); 
        if($this->post){            
            $result=$logic->delete(['id'=>$this->ids]);
            if($result){
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>1,'msg'=>'操作成功','data'=>['titlle'=>'删除','content'=>'操作成功']]);
                }else{
                    return $this->redirect(['index']);
                }
            }else{
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>0,'msg'=>'操作失败','data'=>['titlle'=>'删除','content'=>'操作失败']]);
                }
            }
        }
        return $this->redirect(['index']);
    }
}
