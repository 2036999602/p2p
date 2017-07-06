<?php

namespace backend\modules\admin\controllers;

use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class IndexController extends Controller {

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
     * 说明：个人信息
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionIndex() {
        $join = [
            'table' => ['name' => 'admin', 'alias' => 'a'],
            'join_table' => [
                ['name' => 'user', 'alias' => 'u', 'join_type' => 'left', 'on' => 'a.id=u.admin_id'],
                ['name' => 'user_role', 'alias' => 'ur', 'join_type' => 'left', 'on' => 'ur.user_id=u.id'],
                ['name' => 'member_ext', 'alias' => 'ext', 'join_type' => 'left', 'on' => 'u.id=ext.user_id'],
                ],
            'select' => 'a.add_by,u.*,ext.login_time,u.username,ur.role_type,ur.role_id',
        ];
        $where=['!=','u.id',\Yii::$app->user->id];
        $list=\backend\logic\AdminLogic::getInstance()->getList(false,$where,['id'=>SORT_DESC],10,$join);

        return $this->render('index',['title'=>'管理员管理','list'=>$list]);
    }
    
    
    /**
     * 说明：增加管理 员
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionAdd(){
        $logic=\backend\logic\AdminLogic::getInstance();
        if($this->post){
            $logic->loadModel('User');
            if($logic->scenario('add')->save($this->post)){
                return $this->redirect(['index']);
            }
        }
        $cooperation_model=\backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel')->getModel()->find()->select('id,company_name')->asArray()->all();
        
        $role_model=\common\logic\BaseLogic::getInstance()->loadModel('AuthItemModel')->getModel()->find()->select('name')->where(['type'=>1])->asArray()->all();
  
        $model=$logic->loadModel('User')->getModel();
        return $this->render('add', ['title'=>'增加管理员','model'=>$model,'cooperations'=>$cooperation_model,'roles'=>$role_model]);
    }
    
    /**
     * 说明：编辑管理员
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUpdate(){
        $logic=\backend\logic\AdminLogic::getInstance();
        if($this->post){
            $logic->loadModel('User');
            if($logic->update($this->ids,$this->post)){
            return $this->redirect(['index']);
            }
        }
        $cooperation_model=\backend\logic\CooperationLogic::getInstance()->loadModel('CooperationsModel')->getModel()->find()->select('id,company_name')->asArray()->all();
        
        $role_model=\common\logic\BaseLogic::getInstance()->loadModel('AuthItemModel')->getModel()->find()->select('name')->where(['type'=>1])->asArray()->all();
  
        
        //$model=$logic->loadModel('User')->getModel()->findOne($this->ids[0]);
        $select='ur.role_id as company_name,aa.item_name,u.admin_id';
        $main_table=\common\models\User::tableName().' as u';
        $join_type=['left join','left join'];
        $join_table=[\backend\models\AuthAssignmentModel::tableName().' as aa',\common\models\UserRoleModel::tableName().' as ur'];
        $join_table_on=['u.id=aa.user_id','u.id=ur.user_id'];
        $orderby='u.id desc';
        $id=['u.id'=>$this->ids[0],'ur.role_type'=>'CooperationsModel'];
        $model=$logic->loadModel('User')->getJoinOne($select,$main_table,$join_type,$join_table,$join_table_on,$orderby,$id,'');
        $model=empty($model)?\backend\logic\AdminLogic::getInstance()->loadModel('User')->getOne(['id'=>$this->ids[0]]):$model;
        return $this->render('update', ['title'=>'编辑管理员-'.$model->username,'model'=>$model,'cooperations'=>$cooperation_model,'roles'=>$role_model]);
    }
    
    /**
     * 说明：删除管理员
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionDelete(){
        //print_r($this->ids);die;
        $result=\backend\logic\AdminLogic::getInstance()->delete($this->ids);
        $status=0;
        $msg='删除失败';
        if($result){
            $status=1;
            $msg='删除成功';
        }
        if(\Yii::$app->request->isAjax){
            return json_encode(['status'=>$status,'msg'=>$msg,'data'=>['title'=>'删除管理员','content'=>$msg]]);
        }else{
            return $this->redirect(['index']);
        }
        //return $this->redirect(['index']);
    }
    
    /**
     * 说明：审核管理员
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionAudit(){
        $logic=\backend\logic\AdminLogic::getInstance();
        if($this->post){
            $model=$logic->loadModel('User')->getModel();
            if($model->updateAll(['status'=>10,'operater_id'=>\Yii::$app->user->id],['id'=>$this->ids])){
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>1,'msg'=>'操作成功','data'=>['title'=>'审核','content'=>'操作成功']]);
                }else{
                    return $this->redirect(['index']);
                }
            }else{
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>0,'msg'=>'操作失败','data'=>['title'=>'审核','content'=>'操作失败']]);
                }else{
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('audit', ['title'=>'审核','model'=>$model]);
    }
    
    /**
     * 说明：屏蔽管理员
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionDisable(){
        $logic=\backend\logic\AdminLogic::getInstance();
        if($this->post){
            $model=$logic->loadModel('User')->getModel();
            if($model->updateAll(['is_disable'=>1,'operater_id'=>\Yii::$app->user->id],['id'=>$this->ids])){
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>1,'msg'=>'操作成功','data'=>['title'=>'屏蔽','content'=>'操作成功']]);
                }else{
                    return $this->redirect(['index']);
                }
            }else{
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>0,'msg'=>'操作失败','data'=>['title'=>'屏蔽','content'=>'操作失败']]);
                }else{
                    return $this->redirect(['index']);
                }
            }
        }
        return $this->render('audit', ['title'=>'屏蔽','model'=>$model]);
    }

    /**
     * 说明：发送站内消息
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUserSendMessage(){
        $logic=\common\logic\BaseLogic::getInstance()->loadModel('MessageModel');
        $model=$logic->getModel();
        $model->setScenario('user-send-message');
        if($model->load($this->post) && $model->validate()){
            $username=$model->receiver_id;
            $user_id=\common\logic\BaseLogic::getInstance()->loadModel('User')->getModel()->find()->select('id')->where(['username'=>$username])->orWhere(['id'=>$username])->scalar();
            $model->sender_id=\Yii::$app->user->id;
            $model->msg_type=1;            
            $model->receiver_id=$user_id;
            if($model->sender_id==$model->receiver_id){
                $result=false;
                $model->addError('receiver_id', '不能给本人发消息');
            }else{
            $result=$model->save();
            }
            if(!$result){
                $msg='';
                $error=array_values($model->getFirstErrors());
                if(!empty($error)){
                    $msg=$error;
                }
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>0,'msg'=>!empty($msg)&&is_array($msg)?$msg[0]:'']);
                }else{
                    \Yii::$app->session->setFlash('error', !empty($msg)&&is_array($msg)?$msg[0].$user_id:'');
                }
            }else{
                \Yii::$app->session->setFlash('success', '操作成功');
                if(isset($this->get['gourl']) && !empty($this->get['gourl'])){
                    return $this->redirect($this->get['gourl']);
                }
            }
        }
        return $this->render('/user/send_message', ['title'=>'发送消息','model'=>$model]);
    }
    
    /**
     * 说明：会员管理列表
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUserIndex() {
        //$http=\Yii::$app->getRequest();
        $get = \Yii::$app->getRequest()->get();
        $join = [
            'table' => ['name' => 'user', 'alias' => 'u'],
            'join_table' => [
                ['name' => 'member_ext', 'alias' => 'ext', 'join_type' => 'left', 'on' => 'u.id=ext.user_id'],
                ],
            'select' => 'u.*,ext.real_name,ext.add_type',
        ];
        $search_filter =[];
        if(isset($get['User']['real_name'])){
            array_push($search_filter, ['var_type'=>'string','var_name'=>'real_name','table_alias'=>'ext','filter_method'=>'and']);
        }
        if(isset($get['User']['add_type'])){
            array_push($search_filter, ['var_type'=>'int','var_name'=>'add_type','table_alias'=>'ext','filter_method'=>'and']);
        }
        if(isset($get['User']['bank_card'])){
            array_push($search_filter, ['var_type'=>'string','var_name'=>'bank_card','table_alias'=>'ext','filter_method'=>'and']);
        }
//        $search_filter = [
//            [
//                'var_type' => 'int',
//                'var_name' => 'add_type',
//                'table_alias' => 'ext',
//                'filter_method' => 'and'
//            ],
//            [
//                'var_type' => 'string',
//                'var_name' => 'real_name',
//                'table_alias' => '',
//                'filter_method' => 'and'
//            ],
//            [
//                'var_type' => 'string',
//                'var_name' => 'bank_card',
//                'table_alias' => 'ext',
//                'filter_method' => 'and'
//            ]
//        ];
        
        $where=['u.admin_id'=>0];
        $list = \backend\logic\UserLogic::getInstance()->loadModel('User')->getList(false, $where, ['u.id'=>SORT_DESC], 10, $join, 10, $get, $search_filter);
        $title = "会员管理";
        $model = new \common\models\User();
        return $this->render('/user/index', [
                    'list' => $list,
                    'model' => $model,
                    'title' => $title,
        ]);
    }
    
    /**
     * 说明：会员交易资金列表
     * @author 飞鹰007(email:371399893@qq.com)
     * @param
     * @return
     */
    public function actionUserAccounts() {
        if (\Yii::$app->request->isAjax) {
            
        }
        die("功能待开发");
        $title = "会员交易记录";
//        if($this->pjax_return_content){
//            return $list;
//        }
        //print_r($list);die;
        $model = new \common\models\User();
        return $this->render('/user/accounts', [
                    'model' => $model,
                    'title' => $title,
        ]);
    }
    
    /**
     * 说明：增加管理员
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUserAdd() {
        $model = \backend\logic\UserLogic::getInstance()->loadModel('User')->getModel();
        $model->setScenario('user-add');
        $post = \Yii::$app->getRequest()->post();
        if ($model->load($post) && $model->validate()) {
            $result = \backend\logic\UserLogic::getInstance()->loadModel('User')->scenario('user-add')->save($post);
            if ($result) {
                \Yii::$app->session->setFlash('success', '操作成功');
                return $this->redirect(['user-index']);
            } else {
                \Yii::$app->session->setFlash('success', '操作失败');
            }
        }
        $title = "会员管理";
        return $this->render('/user/add', [
                    'model' => $model,
                    'title' => $title,
        ]);
    }
    
    /**
     * 说明：查看会员信息
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUserView() {
        if (\Yii::$app->request->isAjax) {
            $this->layout = false;
            $row = \backend\logic\UserLogic::getInstance()->loadModel('User')->getOne(['in', 'm.id', $this->ids]);
            if ($row) {
                $result = ['status' => 1, 'msg' => '', 'data' => ['title' => '会员基本信息', 'content' => $this->render('/user/view', ['title' => '会员基本信息', 'model' => $row])]];
            } else {
                $result = ['status' => 0, 'msg' => '操作失败，数据查询失败', 'data' => []];
            }
            return json_encode($result);
        } else {
            $row = \backend\logic\UserLogic::getInstance()->loadModel('User')->getOne(['in', 'm.id', $this->ids]);
            return $this->render('/usr/view', ['model' => $row]);
        }
    }
    
    /**
     * 说明：审核会员
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUserAudit() {
        if (\Yii::$app->request->isAjax) {
            $query_result = \backend\logic\UserLogic::getInstance()->loadModel('User')->update($this->ids, ['User'=>['status' => 10]]);
            if ($query_result) {
                $result = ['status' => 1, 'msg' => '审核成功', 'data' => ['title' => '审核', 'content' => empty($query_result) ? '操作成功' : $query_result]];
            } else {
                $result = ['status' => 0, 'msg' => '操作成功', 'data' => []];
            }
            return json_encode($result);
        } else {
            $query_result = \backend\logic\UserLogic::getInstance()->loadModel('User')->update($this->ids, ['status' => 10]);
            if ($query_result) {
                \Yii::$app->session->setFlash('success', empty($query_result) ? '操作成功' : $query_result);
            } else {
                \Yii::$app->session->setFlash('error', '操作成功，无数据变动');
            }
            return $this->redirect(['user-index']);
        }
    }
    
    /**
     * 说明：屏蔽会员
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUserDisable() {
        if (\Yii::$app->request->isAjax) {
            $query_result = \backend\logic\UserLogic::getInstance()->loadModel('User')->update($this->ids, ['User'=>['is_disable' => 1]]);
            if ($query_result) {
                $result = ['status' => 1, 'msg' => '屏蔽成功', 'data' => ['title' => '屏蔽', 'content' => empty($query_result) ? "操作成功" : $query_result]];
            } else {
                $result = ['status' => 0, 'msg' => '操作成功，无数据变动 ', 'data' => []];
            }
            return json_encode($result);
        } else {
            $query_result = \backend\logic\UserLogic::getInstance()->loadModel('User')->update($this->ids, ['is_disable' => 1]);
            if ($query_result) {
                \Yii::$app->session->setFlash('success', !empty($query_result) ? $query_result : '操作成功');
            } else {
                \Yii::$app->session->setFlash('error', '操作成功，无数据变动');
            }
            return $this->redirect(['user-index']);
        }
    }
    
    /**
     * 说明：重设会员密码为系统设置的密码168168
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUserResetPassword() {
        if (\Yii::$app->request->isAjax) {
            $reset_password = isset(\Yii::$app->params['reset_member_password']) && !empty(\Yii::$app->params['reset_member_password']) ? \Yii::$app->params['reset_member_password'] : 168168;
            $passhowrd_hash = \Yii::$app->security->generatePasswordHash($reset_password);
            $query_result = \backend\logic\UserLogic::getInstance()->loadModel('User')->update($this->ids, ['User'=>['password_hash' => $passhowrd_hash]]);
            if ($query_result) {
                $result = ['status' => 1, 'msg' => '密码重置成功', 'data' => ['title' => '重置密码', 'content' => $query_result . '操作成功，密码重置为' . $reset_password]];
            } else {
                $result = ['status' => 0, 'msg' => '操作成功，无数据变动', 'data' => []];
            }
            return json_encode($result);
        } else {
            if($this->post){
                $passhowrd_hash = \Yii::$app->security->generatePasswordHash($this->post['User']['password_hash']);
                $query_result = \backend\logic\UserLogic::getInstance()->loadModel('User')->update($this->ids, ['User'=>['password_hash' => $passhowrd_hash]]);
                //$query_result = \backend\logic\UserLogic::getInstance()->loadModel('User')->update($this->ids, ['is_disable' => 1]);
                if ($query_result) {
                    \Yii::$app->session->setFlash('success', empty($query_result) ? '操作成功' : $query_result);
                } else {
                    \Yii::$app->session->setFlash('error', '操作成功，无数据变动');
                }
                //return $this->redirect(['user-index']);
            }
            return $this->render('/user/reset_password',['model'=>\common\models\User::findOne($this->ids[0])]);
        }
    }
    
    /**
     * 说明：导入会员帐户
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUserImportInfos() {
        $model = new \common\models\FileForm();
        if ($this->post) {
            if ($model->load($this->post) && $model->validate($this->post)) {
                if (isset($_FILES['FileForm']['tmp_name']['file']) && is_uploaded_file($_FILES['FileForm']['tmp_name']['file'])) {
                    echo str_repeat(" ", 1024);
                    $file = fopen($_FILES['FileForm']['tmp_name']['file'], "r");
                    if (!$file) {
                        throw new \yii\web\NotFoundHttpException("读取文件失败!");
                    }

                    $msg = '';
                    $i = 0;
                    while (!feof($file)) {
                        $row = fgets($file);
                        if ($i >= 1) {
                            if (!empty($row)) {
                                $tran = \Yii::$app->db->beginTransaction();
                                list($username, $password, $mobile, $email, $sex, $real_name, $identification_card, $marriage, $address) = explode(",", $row);
                                $user = \common\logic\BaseLogic::getInstance()->loadModel('User')->getModel();
                                $query = $user->findOne(['username' => $username]);
                                if (empty($query)) {
                                    try {
                                        $user->username = $username;
                                        $user->password_hash = \Yii::$app->security->generatePasswordHash($password);
                                        $user->mobile = $mobile;
                                        $user->email = $email;
                                        $result = $user->save();
                                        if (!$result) {
                                            $msg.=print_r($user->getErrors(), true) . '<br />';
                                            throw new \Exception($msg);
                                        } else {
                                            $user_id = \Yii::$app->db->getLastInsertID();
                                            $user_ext = \common\logic\BaseLogic::getInstance()->loadModel('MemberExtModel')->getModel();
                                            $user_ext->sex = $sex;
                                            $user_ext->real_name = $real_name;
                                            $user_ext->identification_card = $identification_card;
                                            $user_ext->marriage = $marriage;
                                            $user_ext->address = $address;
                                            $user_ext->user_id = $user_id;
                                            $user_ext->add_type = 1;
                                            $ext_result = $user_ext->save();
                                            if (!$ext_result) {
                                                throw new \Exception(print_r($user_ext->getErrors(), true));
                                            }
                                            $msg.='增加会员 ' . $username . '成功<br />';
                                        }
                                        $tran->commit();
                                    } catch (\Exception $e) {
                                        $msg.=$e->getMessage();
                                        $tran->rollBack();
                                        echo $msg;
                                        die;
                                    }
                                }
                            } else {
                                $msg.='文件为空';
                            }
                            echo $msg;
                            ob_flush();
                            flush();
                            sleep(1);
                        }
                        ++$i;
                    }
                    fclose($file);

                    echo "导入完成<br />" . \yii\bootstrap\Html::a('返回用户管理', \yii\helpers\Url::to(['/admin/index/user-index']));
                }
                //return $this->goBack();
            }
        } else {
            return $this->render('/user/import', ['title' => '导入会员信息', 'model' => $model]);
        }
    }
    
    /**
     * 说明：用户级别列表
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUserRankIndex(){
        $list=\backend\logic\UserLogic::getInstance()->loadModel('MemberRankModel')->getList(false);
        return $this->render('/user_rank/index', ['title'=>'会员级别列表','list'=>$list]);
    }
    
    /**
     * 说明：用户级别增加
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUserRankAdd(){
        if($this->post){
            $result=\common\logic\BaseLogic::getInstance()->loadModel('MemberRankModel')->save($this->post);
            if($result){
                return $this->redirect(['user-rank-index']);
            }
        }
        $model=new \common\models\MemberRankModel();
        return $this->render('/user_rank/add', ['title'=>'增加会员级别','model'=>$model]);
    }
    
    /**
     * 说明：用户级别编辑
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUserRankUpdate(){
        if($this->post){
            $result=\common\logic\BaseLogic::getInstance()->loadModel('MemberRankModel')->update($this->ids,$this->post);
            if($result){
                return $this->redirect(['user-rank-index']);
            }
        }
        $model=\common\logic\BaseLogic::getInstance()->loadModel('MemberRankModel')->getOne(['id'=>$this->ids[0]]);
        return $this->render('/user_rank/update', ['title'=>'修改会员级别','model'=>$model]);
    }
    
    /**
     * 说明：用户级别删除
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUserRankDelete(){
        if($this->post){
            $result=\common\logic\BaseLogic::getInstance()->loadModel('MemberRankModel')->delete(['id'=>$this->ids]);
            if($result){
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>1,'msg'=>'操作成功','data'=>['title'=>'删除','content'=>'删除成功']]);
                }
                return $this->redirect(['user-rank-index']);
            }else{
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>0,'msg'=>'操作成功','data'=>['title'=>'删除','content'=>'删除失败']]);
                }
            }
        }
        return $this->redirect(['user-rank-index']);
    }
    
    /**
     * 说明：用户级别禁用
     * @author 飞鹰007(email:371399893@qq.com)
     */
    public function actionUserRankDisable(){
        if($this->post){
            $logic=\common\logic\BaseLogic::getInstance()->loadModel('MemberRankModel');
            $model=$logic->getOne(['id'=>$this->ids[0]]);
            $title="禁用";
            if(!empty($model)){
                $title=$model->is_enable===1?"禁用":"启用";
                $this->post[$model->formName()]['is_enable']=$model->is_enable===1?0:1;
            }
            $result=$logic->update($this->ids,$this->post);
            if($result){
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>1,'msg'=>'操作成功','data'=>['title'=>$title,'content'=>$title.'成功']]);
                }
                return $this->redirect(['user-rank-index']);
            }else{
                if(\Yii::$app->request->isAjax){
                    return json_encode(['status'=>0,'msg'=>'操作成功','data'=>['title'=>$title,'content'=>$title.'失败']]);
                }
            }
        }
        return $this->redirect(['user-rank-index']);
    }

    //会员功能结束   
}
