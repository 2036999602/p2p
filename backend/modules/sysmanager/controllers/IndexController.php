<?php

namespace backend\modules\sysmanager\controllers;

use yii\web\Controller;

/**
 * Default controller for the `sysmanager` module
 */
class IndexController extends Controller
{
    public $post;
    public $get;
    private $ids;

    public function __construct($id, $module, $config = array()) {
        parent::__construct($id, $module, $config);
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
    
        //下面开始系统参数配置
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $model=\backend\logic\UserLogic::getInstance();
        $select='u.username,u.created_at,ext.login_time,uas.item_name,c.company_name';
        $main_table=$model->getModel()->tableName().' as u';
        $join_type=['left join','left join','left join','left join','left join'];
        $join_table=[\common\models\MemberExtModel::tableName().' as ext',\backend\models\AuthAssignmentModel::tableName().' as uas',\common\models\UserRoleModel::tableName().' as ur',\backend\models\AuthItemModel::tableName().' as ai',\common\models\CooperationsModel::tableName().' as c'];
        $join_table_on=['u.id=ext.user_id','u.id=uas.user_id','u.id=ur.user_id','uas.item_name=ai.name','ur.role_id=c.id'];
        $orderby='u.id desc';
        $id=['u.id'=>\Yii::$app->user->id,'ai.type'=>1];
        $groupby='u.id';
        $row=$model->getJoinOne($select,$main_table,$join_type,$join_table,$join_table_on,$orderby,$id,$groupby);

        return $this->render('index',['title'=>'个人信息','model'=>$row]);
    }
    
     //下面是企业会员功能
    /**
     * 说明：公司列表
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionCooperationIndex() {
        $get = \Yii::$app->getRequest()->get();
        $search_filter = [];
        $logic = \backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel');
        $list = $logic->getList();
        $title = "合作企业管理";


        $render_array = array_merge([
            'list' => $list,
            'searchModel' => $logic->getModel(),
            'title' => $title,
                ]);

        return $this->render('/cooperation/index', $render_array);
    }
    
    /**
     * 说明：增加公司
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionCooperationAdd() {
        $logic=\backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel');
        $model=$logic->getModel();        
        $model_name=$model->formName();
        $model->setScenario('cooperation-add');
        if($model->load($this->post) && $model->validate()){   
            $result=$logic->save($this->post);
            if($result){
                \Yii::$app->session->setFlash('success', '操作成功');
                return $this->redirect(['cooperation-index']);
            }else{
                \Yii::$app->session->setFlash('success', '操作失败');
            }
        }
        return $this->render('/cooperation/add', 
                [
                    'title'=>'增加企业',
                    'model'=>$model,
                    'aptitude_model'=>new \common\models\AptitudesModel(),
                ]
            );
    }
    
    /**
     * 说明：编辑公司
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionCooperationUpdate() {
        $logic=\backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel');
        $model=$logic->getOne(['c.id'=>$this->ids]);  
        $model=is_object($model)?$model:$logic->getModel();
        $user_id=$model->user_id;
        $model->user_id=empty($user_id)?0:\backend\logic\CooperationLogic::getInstance()->loadModel('User')->getModel()->find()->select('username')->where(['id'=>$user_id])->scalar();
        $model->setScenario('cooperation-update');
        if($model->load($this->post) && $model->validate()){
            $this->post[$model->formName()]['updated_at']=time();
            $user_id=\backend\logic\CooperationLogic::getInstance()->loadModel('User')->getModel()->find()->select('id')->where(['username'=>$this->post[$model->formName()]['user_id']])->scalar();
            if($user_id){
                $this->post[$model->formName()]['user_id']=$user_id;
            }
            $result=$logic->update($this->ids,$this->post);

            if($result!==false){
                \Yii::$app->session->setFlash('success', '操作成功');
                return $this->refresh();
            }else{
                \Yii::$app->session->setFlash('success', '操作失败');
            }
        }
        $join=[
            'table'=>['name'=>'aptitudes','alias'=>'a'],//table是查询主表 join_table是要联合查询的表
            'join_table'=>[['name'=>'uploads','alias'=>'u','join_type'=>'left','on'=>'a.id=u.doc_id']],
            'select'=>'a.aptitude_name,a.sorts,a.cooperation_id,u.id',//注意这里的m,ext,u要与alias对应
        ];
        $aptitudes=\common\logic\BaseLogic::getInstance()->loadModel('AptitudesModel')->getList(false,['a.cooperation_id'=>$model->id],'a.sorts desc',0,$join);
        
        
        return $this->render('/cooperation/update', 
                [
                    'title'=>'编辑企业',
                    'model'=>$model,
                    'aptitude_model'=>empty($aptitudes)?new \common\models\AptitudesModel():$aptitudes,
                ]
            );
    }
    
    /**
     * 说明：审核公司
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionCooperationAudit() {
        $logic=\backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel');
        $model=$logic->getOne(['id'=>$this->ids]);
        $model=is_object($model)?$model:$logic->getModel();
        $user_id=$model->user_id;
        $model->user_id=empty($user_id)?0:\backend\logic\CooperationLogic::getInstance()->loadModel('User')->getModel()->find()->select('username')->where(['id'=>$user_id])->scalar();
        if($this->post){
            $this->post['CooperationsModel']['status']=1;
            $this->post['CooperationsModel']['auditer_id']=\Yii::$app->user->id;
            $result=\backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel')->update($this->ids,$this->post);
            if($result){
                if(\Yii::$app->getRequest()->isAjax){
                    return json_encode(['status'=>1,'msg'=>'','data'=>['title'=>'审核','content'=>'审核成功']]);
                }
                \Yii::$app->session->setFlash('success', '操作成功');
                return $this->refresh();
            }else{
                if(\Yii::$app->getRequest()->isAjax){
                    return json_encode(['status'=>0,'msg'=>'操作失败','data'=>[]]);
                }
                \Yii::$app->session->setFlash('success', '操作失败');
            }
        }
        return $this->render('/cooperation/update', 
                [
                    'title'=>'编辑企业',
                    'model'=>$model
                ]
            );
    }
    
    /**
     * 说明：屏蔽公司
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionCooperationDisable() {
        $logic = \backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel');
        $model = $logic->getOne(['id' => $this->ids]);
        $model = is_object($model) ? $model : $logic->getModel();
        $user_id = $model->user_id;
        $model->user_id = empty($user_id) ? 0 : \backend\logic\CooperationLogic::getInstance()->loadModel('User')->getModel()->find()->select('username')->where(['id' => $user_id])->scalar();
        if ($this->post) {
            $this->post['CooperationsModel']['is_forbidden'] = 1;
            $this->post['CooperationsModel']['auditer_id'] = \Yii::$app->user->id;
            $result = \backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel')->update($this->ids, $this->post);
            if ($result) {
                if (\Yii::$app->getRequest()->isAjax) {
                    return json_encode(['status' => 1, 'msg' => '', 'data' => ['title' => '屏蔽', 'content' => '屏蔽成功']]);
                }
                \Yii::$app->session->setFlash('success', '操作成功');
                return $this->refresh();
            } else {
                if (\Yii::$app->getRequest()->isAjax) {
                    return json_encode(['status' => 0, 'msg' => '操作失败', 'data' => []]);
                }
                \Yii::$app->session->setFlash('success', '操作失败');
            }
        }
        return $this->render('/cooperation/update', [
                    'title' => '编辑企业',
                    'model' => $model
                        ]
        );
    }
    
    /**
     * 说明：查看公司信息
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionCooperationView() {
        $logic=\backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel');
        $result = $logic->getOne(['in', 'c.id', $this->ids]);
        $model=empty($result)?$logic->getModel():$result;
        if (\Yii::$app->request->isAjax) {
            return json_encode($model);
        } else {
            if(empty($this->ids)){
                \Yii::$app->session->setFlash('error', '缺少参数');
            }
            return $this->render('/cooperation/view', 
                    [
                        'title'=>'查看企业信息',
                        'model' => $model,
                    ]
            );
        }
    }
    
    /**
     * 说明：删除公司
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionCooperationDelete() {
        $query_result = \backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel')->delete(['id'=>$this->ids]);
        if ($query_result) {
            $result = ['status' => 1, 'msg' => '操作成功', 'data' => ['title' => '批量删除', 'content' => '批量删除成功 ' . $query_result]];
        } else {
            $result = ['status' => 0, 'msg' => '操作成功', 'data' => []];
        }
        if (\Yii::$app->request->isAjax) {
            return json_encode($result);
        } else {
            return $this->redirect(['cooperation-index']);
        }
    }

    //企业会员功能结束
    
    /**
     * 说明：系统参数列表
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionSysConfigIndex(){
        $list=\common\logic\BaseLogic::getInstance()->loadModel('SysConfigModel')->getList(false);
        return $this->render('/sysconfig/index', ['title'=>'系统配置','list'=>$list]);
    }
    
    /**
     * 说明：增加系统参数
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionSysConfigAdd(){
        if($this->post){
            $result=\backend\logic\AdminLogic::getInstance()->loadModel('SysConfigModel')->saveAndFile($this->post);
            if($result){
                return $this->redirect(['index']);
            }
        }
        return $this->render('/sysconfig/add', ['title'=>'增加参数','model'=>\common\logic\BaseLogic::getInstance()->loadModel('SysConfigModel')->getModel()]);
    }
    
    /**
     * 说明：修改系统参数
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionSysConfigUpdate(){
        if($this->post){
            $result=\backend\logic\AdminLogic::getInstance()->loadModel('SysConfigModel')->updateAndFile($this->ids,$this->post);
            if($result){
                return $this->redirect(['index']);
            }
        }
        return $this->render('/sysconfig/update', ['title'=>'编辑参数','model'=>\common\logic\BaseLogic::getInstance()->loadModel('SysConfigModel')->getModel()->findOne($this->ids[0])]);
    }
    
    /**
     * 说明：删除系统参数
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionSysConfigDelete() {
        //print_r($this->ids);die();
        $query_result = \backend\logic\AdminLogic::getInstance()->loadModel('SysConfigModel')->deleteAndFile(['id'=>$this->ids]);
        if ($query_result) {
            $result = ['status' => 1, 'msg' => '操作成功', 'data' => ['title' => '批量删除', 'content' => '批量删除成功 ' . $query_result]];
        } else {
            $result = ['status' => 0, 'msg' => '操作成功，无数据变动', 'data' => []];
        }
        if (\Yii::$app->request->isAjax) {
            return json_encode($result);
        } else {
            return $this->redirect(['index']);
        }
    }
    //系统参数配置结束
    
    //系统管理 理财项目开始
    
    /**
     * 说明：理财项目列表
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionFinancialTypeIndex(){
        $list=\common\logic\BaseLogic::getInstance()->loadModel('FinancialTypeModel')->getList(false);
        return $this->render('/financial_type/index', ['title'=>'项目类型','list'=>$list]);
    }
    
    /**
     * 说明：增加系统参数
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionFinancialTypeAdd(){
        if($this->post){
            $result=\backend\logic\AdminLogic::getInstance()->loadModel('FinancialTypeModel')->saveAndFile($this->post);
            if($result){
                return $this->redirect(['financial-type-index']);
            }
        }
        return $this->render('/financial_type/add', ['title'=>'增加项目类型','model'=>\common\logic\BaseLogic::getInstance()->loadModel('FinancialTypeModel')->getModel()]);
    }
    
    /**
     * 说明：修改系统参数
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionFinancialTypeUpdate(){
        if($this->post){
            $result=\backend\logic\AdminLogic::getInstance()->loadModel('FinancialTypeModel')->updateAndFile($this->ids,$this->post);
            if($result){
                return $this->redirect(['financial-type-index']);
            }
        }
        return $this->render('/financial_type/update', ['title'=>'编辑项目类型','model'=>\common\logic\BaseLogic::getInstance()->loadModel('FinancialTypeModel')->getModel()->findOne($this->ids[0])]);
    }
    
    /**
     * 说明：删除系统参数
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionFinancialTypeDelete() {
        //print_r($this->ids);die();
        $query_result = \backend\logic\AdminLogic::getInstance()->loadModel('FinancialTypeModel')->deleteAndFile(['id'=>$this->ids]);
        if ($query_result) {
            $result = ['status' => 1, 'msg' => '操作成功', 'data' => ['title' => '批量删除', 'content' => '批量删除成功 ' . $query_result]];
        } else {
            $result = ['status' => 0, 'msg' => '操作成功，无数据变动', 'data' => []];
        }
        if (\Yii::$app->request->isAjax) {
            return json_encode($result);
        } else {
            return $this->redirect(['financial-type-index']);
        }
    }
    //系统管理 理财项目结束
    
    
    
    //系统管理 还款方式开始
    
    /**
     * 说明：还款方式列表
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionPaymentTypeIndex(){
        $list=\common\logic\BaseLogic::getInstance()->loadModel('PaymentTypeModel')->getList(false);
        return $this->render('/payment_type/index', ['title'=>'还款方式','list'=>$list]);
    }
    
    /**
     * 说明：增加系还款方式
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionPaymentTypeAdd(){
        if($this->post){
            $result=\backend\logic\AdminLogic::getInstance()->loadModel('PaymentTypeModel')->saveAndFile($this->post);
            if($result){
                return $this->redirect(['payment-type-index']);
            }
        }
        return $this->render('/payment_type/add', ['title'=>'增加还款方式','model'=>\common\logic\BaseLogic::getInstance()->loadModel('PaymentTypeModel')->getModel()]);
    }
    
    /**
     * 说明：修改还款方式
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionPaymentTypeUpdate(){
        if($this->post){
            $result=\backend\logic\AdminLogic::getInstance()->loadModel('PaymentTypeModel')->updateAndFile($this->ids,$this->post);
            if($result){
                return $this->redirect(['payment-type-index']);
            }
        }
        return $this->render('/payment_type/update', ['title'=>'编辑还款方式','model'=>\common\logic\BaseLogic::getInstance()->loadModel('PaymentTypeModel')->getModel()->findOne($this->ids[0])]);
    }
    
    /**
     * 说明：删除系还款方式
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionPaymentTypeDelete() {
        //print_r($this->ids);die();
        $query_result = \backend\logic\AdminLogic::getInstance()->loadModel('PaymentTypeModel')->deleteAndFile(['id'=>$this->ids]);
        if ($query_result) {
            $result = ['status' => 1, 'msg' => '操作成功', 'data' => ['title' => '批量删除', 'content' => '批量删除成功 ' . $query_result]];
        } else {
            $result = ['status' => 0, 'msg' => '操作成功，无数据变动', 'data' => []];
        }
        if (\Yii::$app->request->isAjax) {
            return json_encode($result);
        } else {
            return $this->redirect(['payment-type-index']);
        }
    }
    //系统管理 理财项目结束
    
    //邮件smtp服务器开始
    public function actionEmailSmtpIndex(){
        if($this->post){
            $result=\backend\logic\AdminLogic::getInstance()->loadModel('EmailSmtpModel')->emailSmtpSave($this->post);
            if($result){
                return $this->redirect(['email-smtp-index']);
            }
        }
        $model=new \common\models\EmailSmtpModel();
        if(isset(\Yii::$app->params['extend_params']['email_smtp_config'])){
            $attributes=\Yii::$app->params['extend_params']['email_smtp_config'];
            $model->attributes=$attributes;
        }

        return $this->render('/email_smtp/index', ['title'=>'邮箱smtp设置','model'=>$model]);
    }
    //邮件smtp服务器结束
    
    
    //消息发送设置开始
    public function actionMessageReminderIndex(){
        if($this->post){
            $result=\backend\logic\AdminLogic::getInstance()->loadModel('MessageReminderModel')->messageReminderSave($this->post);
            if($result){
                return $this->redirect(['message-reminder-index']);
            }
        }
        $model=new \common\models\MessageReminderModel();
        if(isset(\Yii::$app->params['extend_params']['message_reminder_config'])){
            $attributes=\Yii::$app->params['extend_params']['message_reminder_config'];
            $model->attributes=$attributes;
        }

        return $this->render('/message_reminder/index', ['title'=>'消息提醒设置','model'=>$model]);
    }
    //消息发送设置结束
}
