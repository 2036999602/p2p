<?php
namespace backend\logic;

class CooperationLogic extends \common\logic\baseLogic implements \common\logic\FileLogicInterface{
    public function __construct() {
        parent::__construct();
        $this->loadModel('CooperationsModel');
    }
    public function getList($to_array=false,$where=[],$orderby=['id'=>SORT_DESC],$limit=0,$join=[],$page_item_num=10,$http_query=[],$search_filter=[]){
        $query=$this->getModel()->find();
        //下面这个只能跟着上面的查询，不能弄乱顺序
        if(!$to_array){
            $dataProvider = new \yii\data\ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => $limit < $page_item_num ? $limit : $page_item_num,
                ],
                'sort'=>['defaultOrder' => $orderby]
            ]);
        }
//        $command=clone $query;
//        echo $command->createCommand()->getRawSql();

        if(!empty($where)){
            $query->where($where);
        }
        
        if(!empty($join)){
            if(isset($join['select']) && isset($join['table']) && isset($join['join_table'])){               
               if(!empty($join['join_table']) && count($join['join_table'][0])==4){
                   $query->from(\Yii::$app->db->tablePrefix.strtolower($join['table']['name']).' as '.strtolower($join['table']['alias']))
                        ->select(strtolower($join['select']));
                   foreach($join['join_table'] as $jk=>$jv){
                       $join_type=$jv['join_type'];
                       $join_table=$jv['name'];
                       $join_on=$jv['on'];
                       $join_alias=$jv['alias'];
                       $query->join($join_type.' join',\Yii::$app->db->tablePrefix.strtolower($join_table).' as '.$join_alias,$join_on);
                   }
               }
            }            
        }
        if($to_array){
            $query->asArray();
        }        
        if($limit>0){
            $query->limit($limit);
        }
        if($orderby){
            $query->orderBy($orderby);
        }
        
        
        if(!$to_array){
            $search_keyword='';
            if(isset($http_query[$this->_model_name]['search_keyword'])){
                $search_keyword=$http_query[$this->_model_name]['search_keyword'];
                unset($http_query[$this->_model_name]['search_keyword']);
            }
            //print_r($http_query);
            $this->_model->load($http_query);
            if(isset($http_query[$this->_model_name])){
                $this->_model->attributes=$http_query[$this->_model_name];
            }
            if(!$this->_model->validate()){
                $error='';
                foreach ($this->_model->getErrors() as $k=>$v){
                    $error.=$v[0]."<br />";
                }
                if(!empty($error)){
                    \Yii::$app->session->setFlash('error', $error);
                }
                return $dataProvider;
            }
            
            if(!empty($search_filter) && isset($http_query[$this->_model_name])){
                foreach($search_filter as $sk=>$sv){
                    $attribute_name=empty($sv['table_alias'])?$sv['var_name']:$sv['table_alias'].'.'.$sv['var_name'];
                    if($sv['var_type']=='int'){//整数类型
                        if(isset($sv['filter_method'])){
                            if($sv['filter_method']=='and'){
                                $query->andFilterWhere([$attribute_name=>$http_query[$this->_model_name][$sv['var_name']]]);
                            }elseif($sv['filter_method']=='or'){
                                $query->orFilterWhere([$attribute_name=>$http_query[$this->_model_name][$sv['var_name']]]);
                            }
                        }                        
                    }
                    if($sv['var_type']=='string'){//字符串类型
                        if(isset($sv['filter_method'])){
                            if($sv['filter_method']=='and'){
                                $query->andFilterWhere(['like',$attribute_name,$http_query[$this->_model_name][$sv['var_name']]]);
                            }elseif($sv['filter_method']=='or'){
                                $query->orFilterWhere(['like',$attribute_name,$http_query[$this->_model_name][$sv['var_name']]]);
                            }
                        }                        
                    }
                }
            }
            if(!empty($search_keyword)){
                if(isset($http_query[$this->_model_name]['referee_id']) && $http_query[$this->_model_name]['referee_id']==1){
                    //$search_keyword=3;
                }
                $query->andFilterWhere(['or',['like','username',$search_keyword],['like','mobile',$search_keyword],['like','email',$search_keyword],['like','referee_id',$search_keyword]]);
            }
            
//          $command=clone $query;
//          echo $command->createCommand()->getRawSql();die;
            return $dataProvider;
           
        }else{
            //$command=clone $query;
            //echo $command->createCommand()->getRawSql();die;
            $list=$query->all();
            //print_r($list);die;
            return $list;
        }
    }
    
    public function delete($condition = []) {        
        $transaction = \Yii::$app->db->beginTransaction();
        try {
            $model_name = $this->_model_name;
            //删除 cooperation
            $result = $this->_model->deleteAll($condition);
            //下面删除图片
            $msg = false;
            $this->loadModel('UploadsModel');            
            $uploads = $this->_model->find()->select('id')->where(['doc_id' => \yii\helpers\ArrayHelper::getValue($condition, 'id'), 'doc_model' => $model_name])->asArray()->all();
            if (!empty($uploads)) {
                foreach ($uploads as $k => $v) {
                    $file_result = \Yii::$app->runAction('/attachments/file/delete', ['id' => $v['id']]);
                    if (!$file_result) {
                        $msg.='删除 文件' . $v . '失败 <br />';
                    }
                }
            }

            if (!$result) {
                $get_error = array_values($this->_model->getFirstErrors());
                if (!empty($get_error)) {
                    $error = $get_error[0];
                } else {
                    $error = '这里出错了' . var_dump($condition, true);
                }
                throw new \Exception($error);
            }

            //下面删除关联的资质信息
            $this->loadModel('AptitudesModel');
            $aptitudes_query = $this->_model->find()->select('id')->where(['cooperation_id' => \yii\helpers\ArrayHelper::getValue($condition, 'id')])->asArray()->all();
            if (!empty($aptitudes_query)) {
                foreach ($aptitudes_query as $key => $val) {
                    $this->loadModel('AptitudesModel');
                    $delete_result = $this->_model->deleteAll(['id' => $val['id']]);
                    if ($delete_result) {
                        $model_name = $this->_model_name;
                        $uploads = $this->loadModel('UploadsModel')->getModel()->find()->select('id')->where(['doc_id' => $val['id'], 'doc_model' => $model_name])->one();
                        if (!empty($uploads)) {

                            $file_result = \Yii::$app->runAction('/attachments/file/delete', ['id' => $uploads['id']]);
                            if (!$file_result) {
                                $msg.='删除 文件' . $v . '失败 <br />';
                            }
                        }
                    } else {
                        $get_error = array_values($this->_model->getFirstErrors());
                        if (!empty($get_error)) {
                            $error = $get_error[0];
                        } else {
                            $error = $this->_model_name . '这里出错了4' . $val['id'];
                        }
                        throw new \Exception($error);
                    }
                }
            }
            
            $transaction->commit();
            if (!empty($msg)) {
                \Yii::$app->session->setFlash('info', $msg);
            }
            return $result;
        } catch (\Exception $e) {
            \Yii::$app->session->setFlash('error', $e->getMessage());
            $transaction->rollBack();
        }
        return false;
    }
    
    /**
     * 说明：获取单一上传文件信息
     * @author 飞鹰007(email:371399893@qq.com)
     * @param integer $file_id 所上传的文件ID
     * @param integer $doc_id 文档ID
     * @param integer $user_id 所上传文件的会员ID     
     * @param integer $type_id 栏目ID
     * @param boolean $return_format_url 是否返回格式化后的文件链接 启用这个 后面的条件无效
     * @param array $get_attributes 指定查询的字段名
     * @return
     */
    public function getFile($file_id = 0,$doc_id=0,$user_id=0,$type_id=0,$return_format_url=false,$get_attributes=[]) {
        $this_model_name=$this->_model_name;
        $query=self::getInstance()->loadModel('UploadsModel')->getModel()->find();
        if($return_format_url){
            $get_attributes=['id','file_name','file_path','file_hash','file_type'];
        }
        if(!empty($get_attributes)){
            $query->select(implode(",", $get_attributes));
        }
        if($file_id===0){
            //return false;
        }
        //$query->andFilterWhere(['id'=>$file_id]);
        
        if($user_id>0){
            $query->andFilterWhere(['user_id'=>$user_id]);
        }
        if($doc_id>0){
            $query->andFilterWhere(['doc_id'=>$doc_id]);
        }
        
        $query->andFilterWhere(['like','doc_model',$this_model_name]);
        if($type_id>0){
            $query->andFilterWhere(['type_id'=>$type_id]);
        }
//        $command=clone $query;
//        echo $command->createCommand()->getRawSql();die;
        $row=$query->asArray()->one();
        if($return_format_url && $row){
            $row=[
                'file_name'=>$row['file_name'],
                'file_url'=>"<a target='_blank' href='".\yii\helpers\Url::to(['/attachments/file/show-image','id'=>$row['id']])."'>查看</a>"
            ];
        }
        return $row;
    }
    
    public function getAptitudesInfo($ids=[]){
        if(!empty($ids) && !is_array($ids)){
            if(is_numeric($ids)){
                $ids=['u.doc_id'=>$ids];
            }elseif(strrpos($ids,",")){
                $ids=['u.doc_id'=>explode(",", $ids)];
            }
        }
        $ids['doc_model']=$this->_model_name;
        $join=[
            'table'=>['name'=>'uploads','alias'=>'u'],//table是查询主表 join_table是要联合查询的表
            'join_table'=>[['name'=>'aptitudes','alias'=>'a','join_type'=>'left','on'=>'u.doc_id=a.id']],
            'select'=>'a.aptitude_name,u.id,u.file_name',
        ];
        $list=$this->getList(false, $ids, 'id desc', 0,$join,'');
        return $list;
    }
    
    public function getJoinOne($select='',$main_table='',$join_type=[],$join_table=[],$join_table_on=[],$orderby='',$id=0){
        if($id==0){
            return $this;
        }
        if(empty($select) || empty($join_type) || empty($join_table) || empty($join_table_on)){
            return $this;
        }
        if(!is_array($id)){
            $id=['id'=>$id];
        }
        
        $query=$this->_model->find();
        $query->from($main_table)
                ->select($select);
        
        foreach($join_table as $k=>$v){
            $query->join($join_type[$k], $join_table[$k], $join_table_on[$k]);//$m=new \common\models\User();$m->find()->join($type, $table, $on, $params)
        }
        $query->where($id);
        if(!empty($orderby)){
            $query->orderby($orderby);
        }
//        $command=clone $query;
//        echo $command->createCommand()->getRawSql();
//        die;
        $row=$query->one();
        return $row;
    
}

    public function getJoinList($to_array=false,$limit=10,$select='',$main_table='',$join_type=[],$join_table=[],$join_table_on=[],$orderby='',$where=[],$page_item_num=10){

        if(empty($select) || empty($join_type) || empty($join_table) || empty($join_table_on)){
            return $this;
        }
        
        $query=$this->_model->find();
        if(!$to_array){
            $dataProvider=new \yii\data\ActiveDataProvider(
                    [
                        'query'=>$query,
                        'pagination' => [
                            'pageSize' => $limit < $page_item_num ? $limit : $page_item_num,
                        ],
                        'sort'=>['defaultOrder' => [ $orderby]],
                    ]
                    );
        }
        $query->from($main_table)
                ->select($select);
        
        foreach($join_table as $k=>$v){
            $query->join($join_type[$k], $join_table[$k], $join_table_on[$k]);//$m=new \common\models\User();$m->find()->join($type, $table, $on, $params)
        }
        if(!empty($where)){
            $query->where($where);
        }
        if($limit>0){
            $query->limit($limit);
        }
        if(!empty($orderby)){
            $query->orderby($orderby);
        }
//        $command=clone $query;
//        echo $command->createCommand()->getRawSql();
//        die;
        
        if($to_array){
            $row=$query->asArray()->all();
        }else{
            $row=$dataProvider;
        }
        return $row;
    
    }
    
    public function update($id = array(), $data = array()) {
        $UploadedFile=false;
        $this->loadModel('CooperationsModel');
        $data[$this->_model_name]['updated_at'] = time();
        $data[$this->_model_name]['status'] = 1;
        $data[$this->_model_name]['auditer_id'] = \Yii::$app->user->id;
        $data[$this->_model_name]['cooperation_start_time'] = strtotime($data[$this->_model_name]['cooperation_start_time']);
        $data[$this->_model_name]['cooperation_end_time'] = strtotime($data[$this->_model_name]['cooperation_end_time']);
        $aptitudes['AptitudesModel']=!isset($data['AptitudesModel'])?'':$data['AptitudesModel'];
        unset($data['AptitudesModel']);
        if (isset($_FILES[$this->_model_name]) && is_uploaded_file($_FILES[$this->_model_name]['tmp_name']['file'])) {
            $UploadedFile=\yii\web\UploadedFile::getInstance($this->_model, 'file');
        }
        unset($data[$this->_model->formName()]['file']);
        if ($this->_model->load($data) && $this->_model->validate()) {
            if ($UploadedFile) {
                $filePath = $path = \Yii::$app->getModule('attachments')->getUserDirPath() . DIRECTORY_SEPARATOR . $UploadedFile->name;                

                $fileHash = md5(microtime(true) . $filePath);
                //$fileType = pathinfo($filePath, PATHINFO_EXTENSION);
                $base_filename = pathinfo($UploadedFile, PATHINFO_FILENAME);
                $fileType=$UploadedFile->extension;
                $newFileName = "$fileHash.$fileType";
                $fileDirPath = \Yii::$app->getModule('attachments')->getFilesDirPath($fileHash);
                $newFilePath = $fileDirPath . DIRECTORY_SEPARATOR . $newFileName;
                $upresult=$UploadedFile->saveAs($newFilePath);
                if(!$upresult){
                    \Yii::$app->session->setFlash('error', print_r($UploadedFile->getHasError(),true));
                }
            }//$um=new \common\models\User();$um->getScenario();$um->find();$um->updateAll($aptitudes, $newFilePath);$um->update();
            $attributes=$data[$this->_model_name];            
            $id=$attributes['id'];
            $result = $this->_model->updateAll($attributes,['id'=>$id]);
            if ($result!== false) {
                $cooperation_id = $id;
                if ($UploadedFile) {
                    if ($upresult) {
                        $fileModel = new \nemmo\attachments\models\File();
                        $fileModel->user_id = \Yii::$app->user->id;
                        $fileModel->file_name = pathinfo($base_filename, PATHINFO_FILENAME);
                        $fileModel->doc_model = $this->_model->formName();
                        $fileModel->doc_id = $cooperation_id;
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
                $addon_model = \common\logic\BaseLogic::getInstance()->loadModel('AptitudesModel')->getModel();
                
                $UploadedFiles=false;
                if (isset($_FILES[$addon_model->formName()]) && is_uploaded_file($_FILES[$addon_model->formName()]['tmp_name']['files'][0])) {
                    $UploadedFiles = \yii\web\UploadedFile::getInstances($addon_model, 'files');
                }
                if ($UploadedFiles && $addon_model->load($aptitudes) && $addon_model->validate() && isset($aptitudes[$addon_model->formName()]['sorts'])) {
                    $sorts=$aptitudes[$addon_model->formName()]['sorts'];
                    $aptitude_name=$aptitudes[$addon_model->formName()]['aptitude_name'];
                    $testmsg='';
                    foreach($sorts as $k=>$v){
                        $addon_model = \common\logic\BaseLogic::getInstance()->loadModel('AptitudesModel')->getModel();
                        //$addon_model = new \common\models\AptitudesModel();
                        $addon_model->sorts=empty($v)?0:$v;
                        $addon_model->aptitude_name=$aptitude_name[$k];
                        $addon_model->cooperation_id=$cooperation_id;
                        $result=$addon_model->save();
                        if (!$result) {
                            \Yii::$app->session->setFlash('error', print_r($addon_model->attributes, true) . '插入表出错' . print_r($addon_model->getErrors(), true));
                            return false;
                        } else {
                            $id = \Yii::$app->db->getLastInsertID();
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
                                    }
                                } else {
                                    \Yii::$app->session->setFlash('error', print_r($UploadedFiles[$k]->getHasError(), true));
                                }
                            }
                        }
                    }
                }else{
                    if($UploadedFiles){
                        \Yii::$app->session->setFlash('error', '附加表操作出错');
                    }
                }
            }
            if(isset($testmsg) && !empty($testmsg)){
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
    
    public function save($data) {        
        $UploadedFile=false;
        $this->loadModel('CooperationsModel');
        $data[$this->_model_name]['created_at'] = time();
        $data[$this->_model_name]['status'] = 1;
        $data[$this->_model_name]['auditer_id'] = \Yii::$app->user->id;
        $data[$this->_model_name]['cooperation_start_time'] = strtotime($data[$this->_model_name]['cooperation_start_time']);
        $data[$this->_model_name]['cooperation_end_time'] = strtotime($data[$this->_model_name]['cooperation_end_time']);
        $aptitudes['AptitudesModel']=$data['AptitudesModel'];
        unset($data['AptitudesModel']);
        if (isset($_FILES[$this->_model_name]) && is_uploaded_file($_FILES[$this->_model_name]['tmp_name']['file'])) {
            $UploadedFile=\yii\web\UploadedFile::getInstance($this->_model, 'file');
        }
        if ($this->_model->load($data) && $this->_model->validate()) {
            $this->_model->user_id=\Yii::$app->user->id;//增加人ID
            if ($UploadedFile) {
                $filePath = $path = \Yii::$app->getModule('attachments')->getUserDirPath() . DIRECTORY_SEPARATOR . $UploadedFile->name;                

                $fileHash = md5(microtime(true) . $filePath);
                //$fileType = pathinfo($filePath, PATHINFO_EXTENSION);
                $base_filename = pathinfo($UploadedFile, PATHINFO_FILENAME);
                $fileType=$UploadedFile->extension;
                $newFileName = "$fileHash.$fileType";
                $fileDirPath = \Yii::$app->getModule('attachments')->getFilesDirPath($fileHash);
                $newFilePath = $fileDirPath . DIRECTORY_SEPARATOR . $newFileName;
                $upresult=$UploadedFile->saveAs($newFilePath);
                if(!$upresult){
                    \Yii::$app->session->setFlash('error', print_r($UploadedFile->getHasError(),true));
                }
            }
            $result = $this->_model->save(false);
            if ($result) {
                $cooperation_id = $this->_model->id;
                if ($UploadedFile) {
                    if ($upresult) {
                        $fileModel = new \nemmo\attachments\models\File();
                        $fileModel->user_id = \Yii::$app->user->id;
                        $fileModel->file_name = pathinfo($base_filename, PATHINFO_FILENAME);
                        $fileModel->doc_model = $this->_model->formName();
                        $fileModel->doc_id = $cooperation_id;
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
                $addon_model = \common\logic\BaseLogic::getInstance()->loadModel('AptitudesModel')->getModel();
                $UploadedFiles=false;
                if (isset($_FILES[$addon_model->formName()]) && is_uploaded_file($_FILES[$addon_model->formName()]['tmp_name']['files'][0])) {
                    $UploadedFiles = \yii\web\UploadedFile::getInstances($addon_model, 'files');
                }
                if ($addon_model->load($aptitudes) && $addon_model->validate()) {
                    $sorts=$aptitudes['AptitudesModel']['sorts'];
                    $aptitude_name=$aptitudes['AptitudesModel']['aptitude_name'];
                    $testmsg='';
                    foreach($sorts as $k=>$v){
                        //$addon_model = \common\logic\BaseLogic::getInstance()->loadModel('AptitudesModel')->getModel();
                        $addon_model = new \common\models\AptitudesModel();
                        $addon_model->sorts=empty($v)?0:$v;
                        $addon_model->aptitude_name=$aptitude_name[$k];
                        $addon_model->cooperation_id=$cooperation_id;
                        $result=$addon_model->save();
                        if (!$result) {
                            \Yii::$app->session->setFlash('error', print_r($addon_model->attributes, true) . '插入表出错' . print_r($addon_model->getErrors(), true));
                            return false;
                        } else {
                            //$id=$addon_model->id;
                            $id = \Yii::$app->db->getLastInsertID();
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
                                    }
                                } else {
                                    \Yii::$app->session->setFlash('error', print_r($UploadedFiles[$k]->getHasError(), true));
                                }
                            }
                        }
                        //$batch_data[]=[$cooperation_id,$v,$aptitude_name[$k]];
                    }

//                    $addon_result = \Yii::$app->db->createCommand()->batchInsert($addon_model->tableName(), ['aptitude_id','sort', 'aptitude_name'], $batch_data)->execute();
//                    if (!$addon_result) {
//                        \Yii::$app->session->setFlash('error', print_r($batch_data,true).'插入表出错' . print_r($addon_result->getErrors(), true));
//                        return false;
//                    }
                }else{
                    \Yii::$app->session->setFlash('error', '附加表操作出错' . print_r($addon_model->getErrors(), true));
                }
            }
            if(isset($testmsg) && !empty($testmsg)){
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
    
    public function getOne($id = 0) {
        if($id>0 && !is_array($id)){
            $id=['c.id'=>$id];
        }
        $id=\yii\helpers\ArrayHelper::merge($id, ['doc_model'=>$this->_model_name]);
        $query=$this->_model->find()
                ->from($this->_model->tableName().' as c')
                ->select('c.*,u.id as upid')
                ->leftjoin(\common\models\UploadsModel::tableName().' as u','u.doc_id=c.id')
                ->where($id);
        //$commond=clone $query;
        //echo $commond->createCommand()->getRawSql();
        $row=$query->one();
        return empty($row)?$this->_model->findOne(['id'=>\yii\helpers\ArrayHelper::getValue($id,'c.id')]):$row;
    }
}
