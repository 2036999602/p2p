<?php

namespace backend\logic;

class AdminLogic extends \common\logic\baseLogic {

    public function __construct() {
        $this->loadModel('User');
    }

    /**
     * 说明：插入数据
     * @author 飞鹰007(email:371399893@qq.com)
     * @param array $data activeform的数据，模型名的数组
     * @return boolean
     */
    public function save($data) {
        if ($this->_model->load($data) && $this->_model->validate()) {
            $trans = \Yii::$app->db->beginTransaction();
            try {
                $username = $data[$this->_model_name]['username'];
                $password_hash = \Yii::$app->security->generatePasswordHash($data[$this->_model_name]['password_hash']);
                $created_at = time();
                //admin插入数据
                $admin = new \common\models\AdminsModel();
                $admin->user_name = $username;
                $admin->password_hash = $password_hash;
                $admin->level = 8;
                $admin->created_at = $created_at;
                $admin->add_by = \Yii::$app->user->id;
                $result = $admin->save();
                if (!$result) {
                    $error = array_values($admin->getFirstErrors());
                    if (!empty($error)) {
                        throw new \Exception($error[0] . '111');
                    }
                }

                $this->_model->password_hash = $password_hash;
                $this->_model->username = $username;
                $this->_model->admin_id = $admin->id;
                $this->_model->created_at = $created_at;
                $this->_model->status = 10;
                $this->_model->operater_id = \Yii::$app->user->id;
                $result = $this->_model->save(false);
                if (!$result) {
                    $error = array_values($this->_model->getFirstErrors());
                    if (!empty($error)) {
                        throw new \Exception($error[0] . 'cccc');
                        //$this->setErrors($error[0]);
                        //\Yii::$app->session->setFlash('error', $this->error);
                        //return false;
                    }
                }
                $user_id = $this->_model->id;
                //处理公司关联
                $user_role = new \common\models\UserRoleModel();
                if (!empty($data[$this->_model_name]['company_name'])) {
                    $user_role->role_type = 'CooperationsModel';
                    $user_role->user_id = $user_id;
                    $user_role->role_id = $data[$this->_model_name]['company_name'];
                    if (!$user_role->save()) {
                        $error = array_values($user_role->getFirstErrors());
                        if (!empty($error)) {
                            throw new \Exception($error[0] . 'bbbb');
                        }
                    }
                }
                //die($data[$this->_model_name]['item_name']);
                //处理角色

                $assignment_model = new \mdm\admin\models\Assignment($user_id);
                $items[0] = [$data[$this->_model_name]['item_name']];
                $success = $assignment_model->assign($items);

                if (!$result) {
                    throw new \Exception('角色保存出错');
                }


                \Yii::$app->session->setFlash('success', '增加成功');
                $trans->commit();
            } catch (\Exception $e) {
                \Yii::$app->session->setFlash('error', $e->getMessage() . 'dddd');
                $trans->rollBack();
            }
            return true;
            //return $this->_model->save(false);
        } else {
            $error = $this->_model->getFirstErrors();
            if (!empty($error)) {
                \Yii::$app->session->setFlash('error', implode(",", $error) . 'fffff');
            }
        }
        return false;
    }

    /**
     * 说明：批量更新数据
     * @author 飞鹰007(email:371399893@qq.com)
     * @param array $id 如 $id=[1,2,3]
     * @param array $data 带有值的字段名数组 如 $data=['title'=>'aaa','user_id'=>1] 
     * @return
     */
    public function update($id = [], $data = []) {
        if ($this->_model->load($data) && $this->_model->validate()) {
            $error = '';
            if (!empty($id)) {

                $attributes = $data[$this->_model_name];
                unset($attributes['id']);
                $company_name = isset($attributes['company_name']) ? $attributes['company_name'] : '';
                unset($attributes['company_name']);
                $item_name = isset($attributes['item_name']) ? $attributes['item_name'] : "";
                unset($attributes['item_name']);

                if (isset($attributes['re_password_hash'])) {
                    unset($attributes['re_password_hash']);
                }
                $password_hash = !empty($data[$this->_model_name]['password_hash']) ? \Yii::$app->security->generatePasswordHash($data[$this->_model_name]['password_hash']) : "";
                $updated_at = time();

                foreach ($id as $k => $v) {
                    try {
                        $trans = \Yii::$app->db->beginTransaction();
                        //$this->_model->findOne(['id'=>$v]);
                        //$admin->add_by=\Yii::$app->user->id;
                        $this->_model->updated_at = $updated_at;
                        if (!empty($password_hash)) {
                            $this->_model->password_hash = $password_hash;
                        }

                        $result = $this->_model->update();

                        //$result=$this->_model->updateAll($attributes,"id=".$v);
                        if (!$result) {
                            $error = array_values($this->_model->getFirstErrors());
                            if (!empty($error)) {
                                throw new \Exception($error[0] . '更新会员信息出错');
                            }
                            //$error.='操作ID:'.$v."<br />";
                        } else {
                            //$error.='<font color=red>操作成功ID:'.$v."</font><br />";
                        }


                        $user = $this->_model->find()->where(['id' => $v])->one();
                        //处理admin   
                        $admin = \common\models\AdminsModel::findOne($user->admin_id);
                        if (empty($admin)) {
                            $admin = new \common\models\AdminsModel();
                            $admin->user_name = $user->username;
                            $admin->password_hash = $user->password_hash;
                            $admin->add_by = \Yii::$app->user->id;
                            $admin->created_at = time();
                            $admin->level = 8;
                            if ($admin->save()) {
                                $user->admin_id = $admin->id;
                                if (!$user->update()) {
                                    $error = $user->getFirestErrors();
                                    if (!empty($error)) {
                                        throw new \Exception("更新管理员ID到用户表时出错 " . $error[0]);
                                    }
                                }
                            } else {
                                $error = $admin->getFirstErrors();
                                if (!empty($error)) {
                                    throw new \Exception($error[0]);
                                }
                            }
                        } else {
                            //$admin->user_name=$username;
                            if (!empty($password_hash)) {
                                $admin->password_hash = $password_hash;
                            }
                            //$admin->level=8;
                            $admin->updated_at = $updated_at;
                            if (!$admin->update()) {
                                $error = array_values($admin->getFirstErrors());
                                if (!empty($error)) {
                                    throw new \Exception($error[0] . '更新管理员信息出错');
                                }
                            }
                        }

                        //处理公司关联

                        if (!empty($company_name)) {
                            $user_role = \common\models\UserRoleModel::findOne(['user_id' => $v, 'role_type' => 'CooperationsModel']);
                            if (empty($user_role) && !is_object($user_role)) {
                                $user_role = new \common\models\UserRoleModel();
                                $user_role->role_type = 'CooperationsModel';
                                $user_role->user_id = $v;
                            }
                            $user_role->role_id = $company_name;
                            if (!$user_role->save()) {
                                $error = array_values($user_role->getFirstErrors());
                                if (!empty($error)) {
                                    throw new \Exception($error[0] . 'bbbb');
                                }
                            }
                        }
                        //die($data[$this->_model_name]['item_name']);
                        //处理角色
                        //$assignment_model = new \mdm\admin\models\Assignment($v);
                        //$items[0]=[$item_name];                
                        //$assignment_model->revoke($items);
                        //$success = $assignment_model->assign($items);

                        $authass = \backend\models\AuthAssignmentModel::findOne(['user_id' => $v]);
                        if (empty($authass)) {
                            $assignment_model = new \mdm\admin\models\Assignment($v);
                            $items[0] = [$item_name];
                            $assignment_model->revoke($items);
                            $success = $assignment_model->assign($items);
                        } else {
                            $authass->item_name = $item_name;
                            $success = $authass->update();
                            if (!$success) {
                                $authass = new \backend\models\AuthAssignmentModel();
                                $authass->item_name = $item_name;
                                $authass->user_id = $v;
                                $authass->created_at = time();
                                $success = $authass->update();
                            }
                        }
                        //throw new \Exception('角色保存出错'.print_r($authass,true));

                        if (!$success) {
                            throw new \Exception($item_name . '角色保存出错');
                        }


                        \Yii::$app->session->setFlash('success', '保存成功');
                        $trans->commit();
                        return true;
                    } catch (\Exception $e) {
                        $trans->rollBack();
                        \Yii::$app->session->setFlash('success', $e->getMessage());
                        return false;
                    }
                }
//                if(!empty($error)){
//                    \Yii::$app->session->setFlash('success', $error);
//                    return rtrim($error);
//                }
            } else {
                $error = $this->_model->getFirstErrors();
                if (!empty($error)) {
                    \Yii::$app->session->setFlash('error', implode(",", $error));
                }
                return false;
            }
        }
    }

    /**
     * 说明：批量删除数据
     * @author 飞鹰007(email:371399893@qq.com)
     * @param array $ids 一般是指ID的数组 如 $id=[1,2,3,4,5]
     * @return
     */
    public function delete($ids = []) {
        if (!empty($ids) && !is_array($ids) && is_numeric($ids)) {
            $ids = [0 => $ids];
        }
        foreach ($ids as $value) {
            try {
                $trans = \Yii::$app->db->beginTransaction();
                $user = $this->_model->findOne(['id' => $value]);
                if (empty($user)) {
                    throw new \Exception('该ID ' . $value . ' 未存在数据库');
                }
                $admin_id = empty($this->_model->admin_id) ? $user['admin_id'] : $this->_model->admin_id;
                $result = $user->delete();
                if (!$result) {
                    $error = $this->_model->getFirstErrors();
                    if (!empty($error)) {
                        throw new \Exception($error[0]);
                    }
                }
                //删除admin
                $admin = \common\models\AdminsModel::findOne(['id' => $admin_id]);
                if (empty($admin)) {
                    throw new \Exception('该管理员ID ' . $admin_id . ' 未存在数据库');
                }
                if (!$admin->delete()) {
                    $error = $admin->getFirstErrors();
                    if (!empty($error)) {
                        throw new \Exception($error[0]);
                    }
                }
                //删除关联
                $user_role = \common\models\UserRoleModel::findOne(['user_id' => $value]);
                if (!empty($user_role) && !$user_role->delete()) {
                    $error = $user_role->getFirstErrors();
                    if (!empty($error)) {
                        throw new \Exception($error[0]);
                    }
                }
                $trans->commit();
                //if($result){
                //$this->trigger(self::EVENT_AFTER_DELETE);
                \Yii::$app->session->setFlash('success', '操作成功');
                return true;
                //}
            } catch (\Exception $e) {
                $trans->rollBack();
                \Yii::$app->session->setFlash('error', $e->getMessage());
                if (\Yii::$app->request->isAjax) {
                    echo $e->getMessage();
                }
                return false;
            }
        }
    }

    public function saveAndFile($data = []) {
        if (empty($data)) {
            \Yii::$app->session->setFlash('error', '传递的数据为空');
            return false;
        }
        if ($this->_model->load($data) && $this->_model->validate()) {
            if(isset($data[$this->_model_name]['param_name']) && isset($data[$this->_model_name]['params'])){
                $key = $this->_model->param_name;
                $value = $this->_model->params;
            }elseif(isset($data[$this->_model_name]['financial_name']) && isset($data[$this->_model_name]['financial_value'])){
                $key = $this->_model->financial_name;
                $value = $this->_model->financial_value;
            }elseif(isset($data[$this->_model_name]['payment_name']) && isset($data[$this->_model_name]['payment_value'])){
                $key = $this->_model->payment_name;
                $value = $this->_model->payment_value;
            }
            
            $result = $this->_model->save();
            if (!$result) {
                $error = $this->_model->getFirstErrors();
                if (!empty($error)) {
                    \Yii::$app->session->setFlash('error', $error[0]);
                    return false;
                }
            }

            //将参数写入文件
            $file = include \Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'extend_params.php';
            if ($file) {
                if($this->_model_name=="SysConfigModel"){
                    if (array_key_exists('sysconfig', $file)) {
                        if(array_key_exists($key, $file['sysconfig'])){
                            $file['sysconfig'][$key] = $value;
                        }else{
                            $file['sysconfig'][$key] = $value;
                        }
                    } else {
                        $file['sysconfig']=[$key=>$value];
                    }
                }
                
                //处理项目类型                
                if($this->_model_name=="FinancialTypeModel"){
                    if (array_key_exists('financial_type', $file)) {
                        if(array_key_exists($key, $file['financial_type'])){
                            $file['financial_type'][$key] = $value;
                        }else{
                            $file['financial_type'][$key] = $value;
                        }
                    } else {
                        $file['financial_type']=[$key=>$value];
                    }
                }
                
                //处理项目类型                
                if($this->_model_name=="PaymentTypeModel"){
                    if (array_key_exists('payment_type', $file)) {
                        if(array_key_exists($key, $file['payment_type'])){
                            $file['payment_type'][$key] = $value;
                        }else{
                            $file['payment_type'][$key] = $value;
                        }
                    } else {
                        $file['payment_type']=[$key=>$value];
                    }
                }
            }
            $content="<?php \r\nreturn ".var_export($file,true).";";
            
            if (!file_put_contents(\Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'extend_params.php', $content)) {
                \Yii::$app->session->setFlash('error', '参数写入配置文件出错');
                return false;
            }
            \Yii::$app->session->setFlash('success', '操作成功');
            return true;
        } else {
            $error = $this->_model->getFirstErrors();
            if (!empty($error)) {
                \Yii::$app->session->setFlash('error', $error[0]);
            }
            return false;
        }
    }
    
    public function updateAndFile($ids=[],$data = []) {
        if (empty($data) || empty($ids)) {
            \Yii::$app->session->setFlash('error', '传递的数据为空');
            return false;
        }
        $old_sysconfig=$this->_model->findOne(['id'=>$ids[0]]);
        if(isset($old_sysconfig['param_name'])){
            $old_param_name=$old_sysconfig['param_name'];
        }elseif(isset($old_sysconfig['financial_name'])){
            $old_param_name=$old_sysconfig['financial_name'];
        }elseif(isset($old_sysconfig['payment_name'])){
            $old_param_name=$old_sysconfig['payment_name'];
        }
        if ($this->_model->load($data) && $this->_model->validate()) {            
            if(isset($data[$this->_model_name]['param_name']) && isset($data[$this->_model_name]['params'])){
                $key = $this->_model->param_name;
                $value = $this->_model->params;
            }elseif(isset($data[$this->_model_name]['financial_name']) && isset($data[$this->_model_name]['financial_value'])){
                $key = $this->_model->financial_name;
                $value = $this->_model->financial_value;
            }elseif(isset($data[$this->_model_name]['payment_name']) && isset($data[$this->_model_name]['payment_value'])){
                $key = $this->_model->payment_name;
                $value = $this->_model->payment_value;
            }
            $id=['id'=>$ids[0]];
            $attributes=$this->_model->attributes;
            unset($attributes['id']);
            if($id==''){
                \Yii::$app->session->setFlash('error', '传递的数据为空');
                return false;
            }
            //die($this->_model_name.$id."aaaaa".$old_param_name.print_r($attributes,true));
            //(new \common\models\User())->updateAll($attributes, $condition);
            $result = $this->_model->updateAll($attributes,$id);
            if (!$result) {
                $error = $this->_model->getFirstErrors();
                if (!empty($error)) {
                    \Yii::$app->session->setFlash('error', $error[0]);
                    return false;
                }
            }

            //将参数写入文件
            $file = include \Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'extend_params.php';
            if ($file) {
                if($this->_model_name=="SysConfigModel"){
                    if (array_key_exists('sysconfig', $file)) {
                        if(array_key_exists($key, $file['sysconfig'])){
                            $file['sysconfig'][$key] = $value;
                        }else{
                            if($key!=$old_param_name){
                                unset($file['sysconfig'][$old_param_name]);
                            }
                            $file['sysconfig'][$key] = $value;
                        }
                    } else {
                        $file['sysconfig']=[$key=>$value];
                    }
                }
                
                //处理项目类型
                if($this->_model_name=="FinancialTypeModel"){
                    if (array_key_exists('financial_type', $file)) {
                        if(array_key_exists($key, $file['financial_type'])){
                            $file['financial_type'][$key] = $value;
                        }else{
                            if($key!=$old_param_name){
                                unset($file['financial_type'][$old_param_name]);
                            }
                            $file['financial_type'][$key] = $value;
                        }
                    } else {
                        $file['financial_type']=[$key=>$value];
                    }
                }
                
                //处理还款方式
                if($this->_model_name=="PaymentTypeModel"){
                    if (array_key_exists('payment_type', $file)) {
                        if(array_key_exists($key, $file['payment_type'])){
                            $file['payment_type'][$key] = $value;
                        }else{
                            if($key!=$old_param_name){
                                unset($file['payment_type'][$old_param_name]);
                            }
                            $file['payment_type'][$key] = $value;
                        }
                    } else {
                        $file['payment_type']=[$key=>$value];
                    }
                }
                
                
            }            
            
            $content="<?php \r\nreturn ".var_export($file,true).";";
            
            if (!file_put_contents(\Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'extend_params.php', $content)) {
                \Yii::$app->session->setFlash('error', '参数写入配置文件出错');
                return false;
            }
            \Yii::$app->session->setFlash('success', '操作成功');
            return true;
        } else {
            $error = $this->_model->getFirstErrors();
            if (!empty($error)) {
                \Yii::$app->session->setFlash('error', $error[0]);
            }
            return false;
        }
    }
    
    public function deleteAndFile($ids = []) {
        if (!empty($ids) && !is_array($ids) && is_numeric($ids)) {
            $ids = ['id' => $ids];
        }

        $sysconfig = $this->loadModel($this->_model_name)->getModel()->find()->asArray()->where($ids)->all();

        if (!empty($sysconfig)) {
            $result = $this->_model->deleteAll($ids);
            if (!$result) {
                $error = $this->_model->getFirstErrors();
                if (!empty($error)) {
                    throw new \Exception($error[0]);
                }
            }
            foreach ($sysconfig as $key => $value) {
                try {
                    //删除文件里的数组
                    if(isset($value['param_name'])){
                        $param_name = $value['param_name'];
                    }elseif(isset($value['financial_name'])){
                        $param_name = $value['financial_name'];
                    }elseif(isset($value['payment_name'])){
                        $param_name = $value['payment_name'];
                    }
                    $file = include \Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'extend_params.php';
                    if ($file) {
                        if (array_key_exists('sysconfig', $file) && $this->_model_name=="SysConfigModel") {
                            if (array_key_exists($param_name, $file['sysconfig'])) {
                                unset($file['sysconfig'][$param_name]);
                            }
                        }
                        
                        //处理项目类型
                        if (array_key_exists('financial_type', $file) && $this->_model_name=="FinancialTypeModel") {
                            if (array_key_exists($param_name, $file['financial_type'])) {
                                unset($file['financial_type'][$param_name]);
                            }
                        }
                        
                        //处理还款方式
                        if (array_key_exists('payment_type', $file) && $this->_model_name=="PaymentTypeModel") {
                            if (array_key_exists($param_name, $file['payment_type'])) {
                                unset($file['payment_type'][$param_name]);
                            }
                        }
                        
                    }
                    //将信息回写入配置文件里
                    $content = "<?php \r\nreturn " . var_export($file, true) . ";";

                    if (!file_put_contents(\Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'extend_params.php', $content)) {
                        throw new \Exception('参数写入配置文件出错');
                    }
                } catch (\Exception $e) {
                    \Yii::$app->session->setFlash('error', $e->getMessage());
                    return false;
                }
            }
        }
        \Yii::$app->session->setFlash('success', '操作成功');
        return true;
    }
    
    /**
     * 说明：将SMTP邮箱参数写入配置文件里，不存数据库
     * @author 飞鹰007(email:371399893@qq.com)
     * @param array $data
     * @return boolean
     */
    public function emailSmtpSave($data=[]){
        if($this->_model->load($data) && $this->_model->validate()){
            $attributes=$this->_model->attributes;
            //将参数写入文件
            $file = include \Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'extend_params.php';
            if ($file) {
                foreach ($attributes as $key => $value) {
                    if (array_key_exists('email_smtp_config', $file)) {
                        $file['email_smtp_config'][$key] = $value;
                    } else {
                        $file['email_smtp_config'] = [$key => $value];
                    }
                }
            }
            $content="<?php \r\nreturn ".var_export($file,true).";";
            
            if (!file_put_contents(\Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'extend_params.php', $content)) {
                \Yii::$app->session->setFlash('error', '参数写入配置文件出错');
                return false;
            }
            \Yii::$app->session->setFlash('success', '操作成功');
            return true;
        }
    }
    
    
    /**
     * 说明：将消息提醒写入配置文件里，不存数据库
     * @author 飞鹰007(email:371399893@qq.com)
     * @param array $data
     * @return boolean
     */
    public function messageReminderSave($data=[]){
        if($this->_model->load($data) && $this->_model->validate()){
            $attributes=$this->_model->attributes;
            //print_r($attributes);die;
            //将参数写入文件
            $file = include \Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'extend_params.php';
            if ($file) {
                foreach ($attributes as $key => $value) {
                    if (array_key_exists('message_reminder_config', $file)) {
                        $file['message_reminder_config'][$key] = $value;
                    } else {
                        $file['message_reminder_config'] = [$key => $value];
                    }
                }
            }
            $content="<?php \r\nreturn ".var_export($file,true).";";
            
            if (!file_put_contents(\Yii::getAlias('@common') . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'extend_params.php', $content)) {
                \Yii::$app->session->setFlash('error', '参数写入配置文件出错');
                return false;
            }
            \Yii::$app->session->setFlash('success', '操作成功');
            return true;
        }
    }

}
