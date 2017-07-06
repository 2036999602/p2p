<?php

namespace backend\modules\loan\controllers;

use yii\web\Controller;

/**
 * Default controller for the `loan` module
 */
class LoanManagerController extends Controller
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
     * 借款标列表
     * @return string
     */
    public function actionIndex()
    {
        $logic=\common\logic\BaseLogic::getInstance()->loadModel('LoansModel');       
        $model=$logic->getModel();
        $to_array=false;
        $status_array=[0,1,2];
        if(isset($this->get['list_type']) && $this->get['list_type']){
            $where=['l.status'=>$status_array[$this->get['list_type']]];
        }else{
            $where=['l.status'=>[0,4]];
        }
        $orderby=['id'=>SORT_DESC];
        $limit=10;
        $join=[
            'table'=>['name'=>'loans','alias'=>'l'],//table是查询主表 join_table是要联合查询的表
            'join_table'=>[
                ['name'=>'aptitudes_loan','alias'=>'al','join_type'=>'left','on'=>'l.id=al.loan_id'],
                //['name'=>'uploads','alias'=>'up','join_type'=>'left','on'=>'al.upload_id=up.id'],
            ],
            'select'=>'l.*,al.aptitude_name,al.upload_id',//注意这里的m,ext,u要与alias对应
        ];
        $page_item_num=10;
        
        $search_filter=[];
        if(isset($this->get[$model->formName()]['search_keyword']) && $this->get[$model->formName()]['search_keyword']){
            $search_keyword=$this->get[$model->formName()]['search_keyword'];
            $select='u.id';
            $main_table=$logic->loadModel('User')->getModel()->tableName().' as u';
            $join_type=['left join'];
            $join_table=[\common\models\MemberExtModel::tableName().' as ext'];
            $join_table_on=['u.id=ext.user_id'];
            $id=['or',['like','u.username',$search_keyword],['like','u.mobile',$search_keyword],['like','ext.real_name',$search_keyword]];
            $orderby='';
            $groupby='';
            $user_model=$logic->loadModel('User')->getJoinOne($select,$main_table,$join_type,$join_table,$join_table_on,$orderby,$id,$groupby);
            if($user_model){
                $this->get[$model->formName()]['user_id']=$user_model['id'];
            }
            unset($this->get[$model->formName()]['search_keyword']);
            
            $search_filter[]=[
                'var_type'=>'int',//该字段的类型 int 与 string 或者var_query_range=[value1,value2]
                'var_name'=>'user_id',//字段名
                'table_alias'=>'l',//表的别名，与join_table的设置一致，add_type是member_ext表的字段
                'filter_method'=>'and'//查询关联方法 and 与 or
            ];
        }
//        if(isset($this->get['list_type']) && $this->get['list_type']==1){//风控专用
//            $this->get[$model->formName()]['status']=1;
//            $search_filter[]=[
//                'var_type'=>'int',//该字段的类型 int 与 string 或者var_query_range=[value1,value2]
//                'operator'=>'=',
//                'var_name'=>'status',//字段名
//                'table_alias'=>'',//表的别名，与join_table的设置一致，add_type是member_ext表的字段
//                'filter_method'=>'and'//查询关联方法 and 与 or
//            ];
//        }
//        if(isset($this->get['list_type']) && $this->get['list_type']==2){//预发标专用
//            $this->get[$model->formName()]['status']=2;
//            $search_filter[]=[
//                'var_type'=>'int',//该字段的类型 int 与 string 或者var_query_range=[value1,value2]
//                'var_name'=>'status',//字段名
//                'operator'=>'=',
//                'table_alias'=>'',//表的别名，与join_table的设置一致，add_type是member_ext表的字段
//                'filter_method'=>'and'//查询关联方法 and 与 or
//            ];
//        }
        $http_query=$this->get;
        $list=$logic->loadModel('LoansModel')->getList($to_array,$where,$orderby,$limit,$join,$page_item_num,$http_query,$search_filter,'l.user_id');
        //print_r($list);die;
        return $this->render('/loan_manager/index',['title'=>'借款管理','list'=>$list,'model'=>$model]);
    }
   
    
    /**
     * 说明：编辑
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUpdate(){
        $logic=\backend\logic\LoanLogic::getInstance();
        $model=$logic->getOne(['id'=>$this->ids[0]]);
        if($this->post){
            $result=$logic->loanUpdate($this->ids,$this->post);
            if($result){
                return $this->redirect(['index']);
            }
        }      
        $join=[
            'table'=>['name'=>'aptitudes_loan','alias'=>'al'],//table是查询主表 join_table是要联合查询的表
            'join_table'=>[['name'=>'uploads','alias'=>'u','join_type'=>'left','on'=>'al.id=u.doc_id']],
            'select'=>'al.aptitude_name,al.sorts,al.loan_id,u.id',//注意这里的m,ext,u要与alias对应
        ];
        $aptitudes=\common\logic\BaseLogic::getInstance()->loadModel('AptitudesLoanModel')->getList(false,['al.loan_id'=>$model->id],'al.sorts desc',0,$join);
        return $this->render('/loan_manager/update',['title'=>'编辑借款','model'=>$model,'aptitude_model'=>$aptitudes]);
    }
    
    /**
     * 说明：审核
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionAudit(){
        $logic=\common\logic\BaseLogic::getInstance()->loadModel('LoansModel'); 
        $model=$logic->getOne(['id'=>$this->ids[0]]);
        $status=1;
        if(isset($this->get['status'])){
            $this->post[$model->formName()]['status']=(int)$this->get['status'];
        }
        if($this->post){
            $status=!isset($this->post[$model->formName()]['status'])?1:$this->post[$model->formName()]['status'];            
            $this->post[$model->formName()]['status']=$status;
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
        
        return $this->render('/activity_manager/update',['title'=>'审核','model'=>$model]);
    }
    
    
    /**
     * 说明：删除
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionDelete(){
        die("功能待开发");
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
    
    /**
     * 说明：查看标信息，其实是借款人信息
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionView(){
        $logic=\backend\logic\LoanLogic::getInstance();
        $model=empty($logic->getOne(['id'=>$this->ids[0]]))?$logic->getModel():$logic->getOne(['id'=>$this->ids[0]]);
        $select='u.username,u.mobile,u.email,
            ext.rank_id,ext.bank_card,ext.real_name,ext.sex,ext.identification_card,ext.marriage,ext.education_background,ext.address,ext.trade,ext.professional_title
            
';
        
        $main_table=$logic->loadModel('User')->getModel()->tableName().' as u';
        $join_type=['left join'];
        $join_table=[\common\models\MemberExtModel::tableName().' as ext'];
        $join_table_on=['ext.user_id=u.id'];
        $id=['u.id'=>!isset($model->user_id)?0:$model->user_id];
        $orderby='';
        $groupby='';
        $user_model=$logic->loadModel('User')->getJoinOne($select,$main_table,$join_type,$join_table,$join_table_on,$orderby,$id,$groupby);
        
        
        $select='c.company_name';
        $main_table=$logic->loadModel('UserRoleModel')->getModel()->tableName().' as ur';
        $join_type=['left join'];
        $join_table=[\common\models\CooperationsModel::tableName().' as c'];
        $join_table_on=['ur.role_id=c.id'];
        $id=['ur.user_id'=>!isset($model->user_id)?0:$model->user_id,'role_type'=>$logic->loadModel('CooperationsModel')->getModel()->formName()];
        $orderby='';
        $groupby='';
        $cooperation_model=$logic->getJoinOne($select,$main_table,$join_type,$join_table,$join_table_on,$orderby,$id,$groupby);
        
        $addon_info=\yii\helpers\ArrayHelper::merge(\yii\helpers\ArrayHelper::toArray($user_model),\yii\helpers\ArrayHelper::toArray($cooperation_model));

        if(\Yii::$app->request->isAjax){
            $this->layout=false;
            return json_encode(['status'=>1,'msg'=>'查看借款人信息','data'=>['title'=>'查看借款人信息','content'=>$this->render('/loan_manager/view',['title'=>'查看借款人信息','model'=>$model,'addon_info'=>$addon_info])]]);
        }
        return $this->render('/loan_manager/view',['title'=>'查看借款人信息','model'=>$model,'addon_info'=>$addon_info]);
    }
}
