<?php
namespace backend\logic;

class UserLogic extends \common\logic\baseLogic{
    
    public function __construct() {
        //parent::__construct();
        $this->loadModel('User');
        //$this->_model=$logic->getModel;
    }
    
    public function getList($to_array=false,$where=[],$orderby='id desc',$limit=0,$join=[],$page_item_num=10,$http_query=[],$search_filter=[]){

        $model=$this->_model;
        $query=$model->find();
        //下面这个只能跟着上面的查询，不能弄乱顺序

        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => $limit < $page_item_num ? $limit : $page_item_num,
            ],
        ]);

        if(!empty($where)){
            $query->where($where);
        }
        if($limit>0){
            $query->limit($limit);
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
        if($to_array && $orderby){
            $query->asArray()->orderBy($orderby);
        }elseif($to_array && empty($orderby)){
            $query->asArray();
        }elseif(!$to_array && $orderby){
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
                        $filter_name='like';
                        //处理特殊字段查询条件 实名
                        if(strrpos($attribute_name,'real_name') && $http_query[$this->_model_name]['real_name']!=""){
                            if($http_query[$this->_model_name]['real_name']==1){//已实名
                                $filter_name='!=';                                
                            }else{
                                $filter_name='=';
                            }
                            $http_query[$this->_model_name]['real_name']='';
                            if(isset($sv['filter_method'])){                            
                                if($sv['filter_method']=='and'){
                                    $query->andWhere([$filter_name,$attribute_name,$http_query[$this->_model_name]['real_name']]);
                                }elseif($sv['filter_method']=='or'){
                                    $query->orWhere([$filter_name,$attribute_name,$http_query[$this->_model_name]['real_name']]);
                                }
                            }
                        }
                        //处理特殊字段查询条件 银行卡
                        elseif(strrpos($attribute_name,'bank_card') && $http_query[$this->_model_name]['bank_card']!=""){
                            if($http_query[$this->_model_name]['bank_card']==1){//已认让
                                $filter_name='!=';                                
                            }else{
                                $filter_name='='; 
                            }
                            $http_query[$this->_model_name]['bank_card']='';
                            if(isset($sv['filter_method'])){                            
                                if($sv['filter_method']=='and'){
                                    $query->andWhere([$filter_name,$attribute_name,$http_query[$this->_model_name]['bank_card']]);
                                }elseif($sv['filter_method']=='or'){
                                    $query->orWhere([$filter_name,$attribute_name,$http_query[$this->_model_name]['bank_card']]);
                                }
                            }
                        }else{
                            if(isset($sv['filter_method'])){                            
                                if($sv['filter_method']=='and'){
                                    $query->andFilterWhere([$filter_name,$attribute_name,$http_query[$this->_model_name][$sv['var_name']]]);
                                }elseif($sv['filter_method']=='or'){
                                    $query->orFilterWhere([$filter_name,$attribute_name,$http_query[$this->_model_name][$sv['var_name']]]);
                                }
                            }  
                        }
                    }
                }
            }
            if(!empty($search_keyword)){
                $or_where=['or',['like','username',$search_keyword],['or',['like','mobile',$search_keyword],['like','email',$search_keyword]]];
                if(isset($http_query[$this->_model_name]['referee_id']) && !empty($http_query[$this->_model_name]['referee_id'])){
                    $referee_id=$this->loadModel('User')->getModel()->find()->select('id')->where(['username'=>$search_keyword])->scalar();
                    array_push($or_where, ['or',['like','referee_id',$referee_id]]);
                }
                $query->andFilterWhere($or_where);
            }
            
//            $command=clone $query;
//            echo $command->createCommand()->getRawSql();
            if($to_array){
                return $dataProvider->query->asArray()->all();
            }else {
                return $dataProvider;
            }            
        }else{
            $list=$query->all();
            return $list;
        }
    }
    
    public function getOne($id=0){
        if($id<=0 || empty($id)){
            return null;
        }
        if(!is_array($id)){
            $id=['m.id'=>$id];
        }
        $row=$this->_model->find()->from(\common\models\User::tableName().' as m')->select('m.username,m.email,m.mobile,m.is_disable,m.status,,ext.*')->leftjoin(\common\models\MemberExtModel::tableName().' as ext','ext.user_id=m.id')->where($id)->orderby('ext.user_id desc')->one();
        
        return $row;
    }
    
    public function save($data) {
        if($this->_model->load($data) && $this->_model->validate()){
            $transaction =\Yii::$app->db->beginTransaction();
            try{
                $this->_model->password_hash=\Yii::$app->security->generatePasswordHash($this->_model->password_hash);
                //unset($this->_model->re_password_hash);     
                $result=$this->_model->save();
                if(!$result){
                    $error=$this->_model->getFirstErrors();
                    if(!empty($error)){
                        throw new \Exception(implode(",", $error));
                    }
                }
                $user_id=\Yii::$app->db->lastInsertID;

                $this->loadModel('MemberExtModel');
                $this->_model->add_type = 1;
                $this->_model->user_id = $user_id;
                $result = $this->_model->save();
                if(!$result){
                    $error=$this->_model->getFirstErrors();
                    if(!empty($error)){
                        throw new \Exception(implode(",", $error));
                    }
                }
                $transaction->commit();
                return $result;
            }catch (Exception $e){
                \Yii::$app->session->setFlash('error', $e->getMessage());
                $transaction->rollBack();
            }
        }else{
            $error=$this->_model->getFirstErrors();
            if(!empty($error)){
                \Yii::$app->session->setFlash('error', implode(",", $error));
            }
        }
        return false;
    }
    
    public function getOneMemberExt($id=0,$to_array=false){
        $row=$this->loadModel('MemberExtModel')->getOne(['id'=>$id]);
        if($to_array && !empty($row)){
            $row=\yii\helpers\ArrayHelper::toArray($row);
        }
        return $row;
    }
    
    public function getAllMemberExt($ids=[],$to_array=false){
        $list=$this->loadModel('MemberExtModel')->getList($to_array, ['id'=>SORT_DESC], 10, array_key_exists('id', $ids)?$ids:['id'=>$ids]);
        if($to_array && !empty($list)){
            $list=\yii\helpers\ArrayHelper::toArray($list);
        }
        return $list;
    }
    
    public function getOneRole($uid=0,$role_type=''){
        $row=$this->loadModel('UserRoleModel')->getOne(['id'=>$uid,'role_type'=>$role_type]);
        return $row;
    }    
}

