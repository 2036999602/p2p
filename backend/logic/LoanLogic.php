<?php

namespace backend\logic;

class LoanLogic extends \common\logic\baseLogic {

    public function __construct() {
        $this->loadModel('LoansModel');
    }
    
    /**
     * 说明：批量更新数据
     * @author 飞鹰007(email:371399893@qq.com)
     * @param array $id 如 $id=[1,2,3]
     * @param array $data 带有值的字段名数组 如 $data=['title'=>'aaa','user_id'=>1] 
     * @return
     */
    public function loanUpdate($id = [], $data = []) {
        if ($this->_model->load($data) && $this->_model->validate()) {
            $UploadedFile = false;

            $data[$this->_model_name]['updated_at'] = time();
            $data[$this->_model_name]['status'] = 1;
            $data[$this->_model_name]['auditer_id'] = \Yii::$app->user->id;
            $aptitudes['AptitudesLoanModel'] = !isset($data['AptitudesLoanModel']) ? '' : $data['AptitudesLoanModel'];
            unset($data['AptitudesLoanModel']);
            if (isset($_FILES[$this->_model_name]) && is_uploaded_file($_FILES[$this->_model_name]['tmp_name']['file'])) {
                $UploadedFile = \yii\web\UploadedFile::getInstance($this->_model, 'file');
            }
            unset($data[$this->_model->formName()]['file']);

            if ($UploadedFile) {
                $filePath = $path = \Yii::$app->getModule('attachments')->getUserDirPath() . DIRECTORY_SEPARATOR . $UploadedFile->name;

                $fileHash = md5(microtime(true) . $filePath);
                //$fileType = pathinfo($filePath, PATHINFO_EXTENSION);
                $base_filename = pathinfo($UploadedFile, PATHINFO_FILENAME);
                $fileType = $UploadedFile->extension;
                $newFileName = "$fileHash.$fileType";
                $fileDirPath = \Yii::$app->getModule('attachments')->getFilesDirPath($fileHash);
                $newFilePath = $fileDirPath . DIRECTORY_SEPARATOR . $newFileName;
                $upresult = $UploadedFile->saveAs($newFilePath);
                if (!$upresult) {
                    \Yii::$app->session->setFlash('error', print_r($UploadedFile->getHasError(), true));
                }
            }//$um=new \common\models\User();$um->getScenario();$um->find();$um->updateAll($aptitudes, $newFilePath);$um->update();
            $attributes = $data[$this->_model_name];
            $id = $attributes['id'];
            $result = $this->_model->updateAll($attributes, ['id' => $id]);
            if ($result !== false) {
                $loan_id = $id;
                if ($UploadedFile) {
                    if ($upresult) {
                        $fileModel = new \nemmo\attachments\models\File();
                        $fileModel->user_id = \Yii::$app->user->id;
                        $fileModel->file_name = pathinfo($base_filename, PATHINFO_FILENAME);
                        $fileModel->doc_model = $this->_model->formName();
                        $fileModel->doc_id = $loan_id;
                        $fileModel->file_hash = $fileHash;
                        $fileModel->file_size = (string) filesize($newFilePath);
                        $fileModel->file_type = $fileType;
                        $fileModel->file_mime = \yii\helpers\FileHelper::getMimeType($newFilePath);
                        $fileModel->created_at = time();
                        if (!$fileModel->save()) {
                            \Yii::$app->session->setFlash('error', print_r($fileModel->getErrors(), true));
                        }
                    } else {
                        \Yii::$app->session->setFlash('error', print_r($UploadedFile->getHasError(), true));
                    }
                }
                $addon_model = \common\logic\BaseLogic::getInstance()->loadModel('AptitudesLoanModel')->getModel();

                $UploadedFiles = false;
                if (isset($_FILES[$addon_model->formName()]) && is_uploaded_file($_FILES[$addon_model->formName()]['tmp_name']['files'][0])) {
                    $UploadedFiles = \yii\web\UploadedFile::getInstances($addon_model, 'files');
                }
                if ($UploadedFiles && $addon_model->load($aptitudes) && $addon_model->validate() && isset($aptitudes[$addon_model->formName()]['sorts'])) {
                    $sorts = $aptitudes[$addon_model->formName()]['sorts'];
                    $aptitude_name = $aptitudes[$addon_model->formName()]['aptitude_name'];
                    $testmsg = '';
                    foreach ($sorts as $k => $v) {
                        $addon_model = \common\logic\BaseLogic::getInstance()->loadModel('AptitudesLoanModel')->getModel();
                        //$addon_model = new \common\models\AptitudesModel();
                        $addon_model->sorts = empty($v) ? 0 : $v;
                        $addon_model->aptitude_name = $aptitude_name[$k];
                        $addon_model->loan_id = $loan_id;
                        $addon_model->user_id=\Yii::$app->user->id;
                        $result = $addon_model->save();
                        if (!$result) {
                            \Yii::$app->session->setFlash('error', print_r($addon_model->attributes, true) . '插入表出错' . print_r($addon_model->getErrors(), true));
                            return false;
                        } else {
                            $id = $addon_model->id;
                            if ($UploadedFiles) {
                                $filePath = $path = \Yii::$app->getModule('attachments')->getUserDirPath() . DIRECTORY_SEPARATOR . $UploadedFiles[$k]->name;
                                //$testmsg.=$filePath.'|';
                                $fileHash = md5(microtime(true) . $filePath);
                                $base_filename = pathinfo($UploadedFiles[$k], PATHINFO_FILENAME);
                                $fileType = $UploadedFiles[$k]->extension;
                                $newFileName = "$fileHash.$fileType";
                                $fileDirPath = \Yii::$app->getModule('attachments')->getFilesDirPath($fileHash);
                                $newFilePath = $fileDirPath . DIRECTORY_SEPARATOR . $newFileName;
                                $upresult = $UploadedFiles[$k]->saveAs($newFilePath);

                                if ($upresult) {
                                    $fileModel = new \nemmo\attachments\models\File();
                                    $fileModel->user_id = \Yii::$app->user->id;
                                    $fileModel->file_name = $base_filename;
                                    $fileModel->doc_model = $addon_model->formName();
                                    $fileModel->doc_id = $id;
                                    $fileModel->file_hash = $fileHash;
                                    $fileModel->file_size = (string) filesize($newFilePath);
                                    $fileModel->file_type = $fileType;
                                    $fileModel->file_mime = \yii\helpers\FileHelper::getMimeType($newFilePath);
                                    $fileModel->created_at = time();
                                    if (!$fileModel->save()) {                                        
                                        \Yii::$app->session->setFlash('error', print_r($fileModel->getErrors(), true));
                                    }else{
                                        $file_id=$fileModel->id;
                                        $addon_row=\common\logic\BaseLogic::getInstance()->loadModel('AptitudesLoanModel')->getOne(['id'=>$id]);
                                        if($addon_row){
                                            $addon_row->upload_id=$file_id;
                                            $addon_row->update();
                                        }
                                    }
                                } else {
                                    \Yii::$app->session->setFlash('error', print_r($UploadedFiles[$k]->getHasError(), true));
                                }
                            }
                        }
                    }
                } else {
                    if ($UploadedFiles) {
                        $error=array_values($addon_model->getFirstErrors());
                        if(!empty($error)){
                            \Yii::$app->session->setFlash('error', '附加表操作出错'.$error[0]);
                        }else{
                        \Yii::$app->session->setFlash('error', '附加表操作出错');
                        }
                    }
                }
            }
            if (isset($testmsg) && !empty($testmsg)) {
                \Yii::$app->session->setFlash('warning', $testmsg);
            }
            return $result;
        } else {
            $error = $this->_model->getFirstErrors();
            if (!empty($error)) {
                \Yii::$app->session->setFlash('error', implode(",", $error));
            }
        }
        return false;
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
