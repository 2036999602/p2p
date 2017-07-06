<?php
namespace common\logic;
use yii\web\NotFoundHttpException;

class BaseLogic extends abstractLogic implements logicInterface{
    protected $_model;
    protected $_model_name;
    private static $_instance;
    public $error=null;
    private $_query=null;
    
    protected function __construct() {
    }
    
    protected function __clone() {
    ;
    }
    
    public static function getInstance()
    {
        if( !(self::$_instance instanceof self) )
        {
            if(version_compare(PHP_VERSION, "5.3",">")){
                self::$_instance = new static();
            }else{
                self::$_instance = new self();
            }
        }
        return self::$_instance;
    }
    
    /**
     * 说明：加载模型
     * @author 飞鹰007(email:371399893@qq.com)
     * @param string $model_name 模型名称
     * @param string $file_path 非系统默认的模型文件所在的路径，不含模型名
     * @return mixed
     */
    public function loadModel($model_name='',$file_path=''){
        if(empty($model_name)){
            throw new NotFoundHttpException("logic load:error param !");
        }
        $model_path='';
        if(file_exists(\Yii::getAlias('@backend').DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.$model_name.'.php')){
            $model_path='backend\\models\\';            
        }elseif(file_exists(\Yii::getAlias('@frontend').DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.$model_name.'.php')){
            $model_path='frontend\\models\\';            
        }elseif(file_exists(\Yii::getAlias('@common').DIRECTORY_SEPARATOR.'models'.DIRECTORY_SEPARATOR.$model_name.'.php')){
            $model_path='common\\models\\';            
        }
        if (!empty($file_path)) {
            if(file_exists($file_path.DIRECTORY_SEPARATOR.$model_name.'.php')){
                $model_path = $file_path;
            }
        }
        if(empty($model_path)){
            throw new NotFoundHttpException("Model ".str_replace("model","",strtolower($model_name))." not found !");
        }
        $model=$model_path.$model_name;
        $this->_model=new $model();
        $this->_model_name=null===$this->_model->formName()?$model_name:$this->_model->formName();
        return $this;
    }
    
    /**
     * 说明：获取模型对象
     * @author 飞鹰007(email:371399893@qq.com)
     * @return obj
     */
    public function getModel(){
        return $this->_model;
    }
    
    public function getModelName(){
        return empty($this->_model_name)?$this->_model->formName():$this->_model_name;
    }
    
    public function setQueryModelName($name){
        $this->_model_name=$name;
        return $this;
    }
    
    private function setErrors($error){
        $this->error=$error;
    }
    
    public function loadValidateData($data,$is_validate=true){
        if($is_validate){
            if($this->_model->load($data) && $this->_model->validate()){
                $this->_model->attributes=$data[$this->_model_name];
                return $this;
            }
        }
        return false;
    }
    
    /**
     * 说明：设置模型的场景
     * @author 飞鹰007(email:371399893@qq.com)
     * @param string 场景名称
     * @return obj
     */
    public function scenario($scenario='') {
        if(!empty($scenario)){
            $this->_model->setScenario($scenario);
            return $this;
        }
    }
    
    /**
     * @example 获取带分页的列表<br />
查询示例  3表关联查询带分页 <br />
 $join=[
            'table'=>['name'=>'member','alias'=>'m'],//table是查询主表 join_table是要联合查询的表
            'join_table'=>[['name'=>'member_ext','alias'=>'ext','join_type'=>'left','on'=>'m.id=ext.user_id'],['name'=>'user','alias'=>'u','join_type'=>'left','on'=>'u.id=m.id']],
            'select'=>'m.*,ext.real_name,ext.add_type,u.username',//注意这里的m,ext,u要与alias对应
        ];<br />
//依据你设计的表单的查询字段增加下面的搜索过滤条件 <br />
$search_filter=[
            [
                'var_type'=>'int',//该字段的类型 int 与 string
                'var_name'=>'add_type',//字段名
                'table_alias'=>'ext',//表的别名，与join_table的设置一致，add_type是member_ext表的字段
                'filter_method'=>'and'//查询关联方法 and 与 or
            ],
            [
                'var_type'=>'string',//该字段的类型 int 与 string
                'var_name'=>'mobile',//字段名
                'table_alias'=>'m',//表的别名，与join_table的设置一致，add_type是member_ext表的字段
                'filter_method'=>'or'//查询关联方法 and 与 or
            ]
        ];
        $list=$this->logic->loadModel('MemberModel')->getList(false,'m.id desc',-1,[],$join,10,$get,$search_filter);
    * @author 飞鹰007 QQ371399893
    * @param boolean $to_array 对象转为数组，默认值 false
    * @param array $where 查询条件，默认值为空数组 []
    * @param string $orderby 排序字段及方法，默认值 id desc
    * @param integer $limit 查询多少条数据，默认值 0    
    * @param array $join 联合查询，默认值为空数组 []
    * @param integer $page_item_num 启用with_page后设置每页显示多少条数据，默认值 10
    * @param array $http_query Model Form HTTP参数，默认值空数组 [] 
    * @param array $search_filter 搜索过滤数组，默认值空数据 []
    * @return mixed
    */
    public function getList($to_array=false,$where=[],$orderby=['id'=>SORT_DESC],$limit=10,$join=[],$page_item_num=10,$http_query=[],$search_filter=[],$groupby=''){
        $query=$this->_model->find();
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

        if(!empty($where)){
            $query->where($where);
        }
        if(!empty($join)){
            if(isset($join['select']) && isset($join['table']) && isset($join['join_table'])){               
               if(!empty($join['join_table']) && count($join['join_table'][0])==4){
                   $query->from((empty(strtolower($join['table']['name']))?$this->_model_name:\Yii::$app->db->tablePrefix.strtolower($join['table']['name'])).' as '.strtolower($join['table']['alias']))
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
        if(!empty($groupby)){
            $query->groupby($groupby);
        }
        
        
        if(!$to_array){
            $search_keyword='';
            if(isset($http_query[$this->_model_name]['search_keyword'])){
                $search_keyword=$http_query[$this->_model_name]['search_keyword'];
                unset($http_query[$this->_model_name]['search_keyword']);
            }
            
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
            if(!empty($search_filter)){
                $operator="";
                foreach($search_filter as $sk=>$sv){
                    $attribute_name=empty($sv['table_alias'])?$sv['var_name']:$sv['table_alias'].'.'.$sv['var_name'];
                    if(isset($sv['operator'])){
                        $operator=$sv['operator'];
                    }
                    
                    if($sv['var_type']=='int'){//整数类型
                        if(isset($sv['filter_method'])){
                            if($sv['filter_method']=='and'){
                                if(isset($sv['var_query_range'])){
                                    if(empty($sv['var_query_range'][1]) && !empty($sv['var_query_range'][0])){
                                        $query->andFilterWhere(['and',['>=',$attribute_name,$sv['var_query_range'][0]]]);
                                    }elseif(empty($sv['var_query_range'][0]) && !empty($sv['var_query_range'][1])){
                                        $query->andFilterWhere(['and',['<=',$attribute_name,$sv['var_query_range'][1]]]);
                                    }else{
                                        $query->andFilterWhere(['and',['>=',$attribute_name,$sv['var_query_range'][0]],["<=",$attribute_name,$sv['var_query_range'][1]]]);
                                    }
                                }else{
                                    if(empty($operator)){
                                        $operator='=';
                                    }
                                    $query->andFilterWhere([$operator,$attribute_name,$this->_model->attributes[$sv['var_name']]]);
                                }
                            }elseif($sv['filter_method']=='or'){
                                if(isset($sv['var_query_range'])){
                                    if(empty($sv['var_query_range'][1]) && !empty($sv['var_query_range'][0])){
                                        $query->orFilterWhere(['or',['>=',$attribute_name,$sv['var_query_range'][0]]]);
                                    }elseif(empty($sv['var_query_range'][0]) && !empty($sv['var_query_range'][1])){
                                        $query->orFilterWhere(['or',['<=',$attribute_name,$sv['var_query_range'][1]]]);
                                    }else{
                                        $query->orFilterWhere(['or',['>=',$attribute_name,$sv['var_query_range'][0]],["<=",$attribute_name,$sv['var_query_range'][1]]]);
                                    }
                                }else{
                                    if(empty($operator)){
                                        $operator='=';
                                    }
                                    $query->orFilterWhere([$operator,$attribute_name,$this->_model->attributes[$sv['var_name']]]);
                                }
                            }
                        }                        
                    }
                    if($sv['var_type']=='string'){//字符串类型
                        if(isset($sv['filter_method'])){
                            if($sv['filter_method']=='and'){
                                if(isset($sv['var_query_range'])){
                                    if(empty($sv['var_query_range'][1]) && !empty($sv['var_query_range'][0])){
                                        $query->andFilterWhere(['and',['>=',$attribute_name,$sv['var_query_range'][0]]]);
                                    }elseif(empty($sv['var_query_range'][0]) && !empty($sv['var_query_range'][1])){
                                        $query->andFilterWhere(['and',['<=',$attribute_name,$sv['var_query_range'][1]]]);
                                    }else{
                                        $query->andFilterWhere(['and',['>=',$attribute_name,$sv['var_query_range'][0]],["<=",$attribute_name,$sv['var_query_range'][1]]]);
                                    }
                                }else{
                                    if(empty($operator)){
                                        $operator='like';
                                    }
                                    $query->andFilterWhere([$operator,$attribute_name,$this->_model->attributes[$sv['var_name']]]);
                                }
                            }elseif($sv['filter_method']=='or'){
                                if(isset($sv['var_query_range'])){
                                    if(empty($sv['var_query_range'][1]) && !empty($sv['var_query_range'][0])){
                                        $query->orFilterWhere(['or',['>=',$attribute_name,$sv['var_query_range'][0]]]);
                                    }elseif(empty($sv['var_query_range'][0]) && !empty($sv['var_query_range'][1])){
                                        $query->orFilterWhere(['or',['<=',$attribute_name,$sv['var_query_range'][1]]]);
                                    }else{
                                        $query->orFilterWhere(['or',['>=',$attribute_name,$sv['var_query_range'][0]],["<=",$attribute_name,$sv['var_query_range'][1]]]);
                                    }
                                }else{
                                    if(empty($operator)){
                                        $operator='like';
                                    }
                                    $query->orFilterWhere([$operator,$attribute_name,$this->_model->attributes[$sv['var_name']]]);
                                }
                            }
                        }                        
                    }
                    
                }
            }
            
            if(!empty($search_keyword)){
                $or_where=['or',['like','username',$search_keyword],['or',['like','mobile',$search_keyword],['=','email',$search_keyword]]];
                if(isset($http_query[$this->_model_name]['referee_id']) && $http_query[$this->_model_name]['referee_id']==1){
                    array_push($or_where, ['or',['like','referee_id',$search_keyword]]);
                }
                $query->andFilterWhere($or_where);
            }
            $this->_query=clone $query;
//            $command=clone $query;
//            echo $command->createCommand()->getRawSql();die;
            $this->_model=$dataProvider;
            return $dataProvider;            
        }else{
            $this->_query=clone $query;
            //$command=clone $query;
            //echo $command->createCommand()->getRawSql();die;
            $list=$query->all();
            //print_r($list);die;
            $this->_model=$list;
            return $list;
        }
    }
    
    /**
     * 说明：获取一条含所有字段的数据
     * @author 飞鹰007(email:371399893@qq.com)
     * @param integer|array $id 整数或数组 activerecord支持的数组方式
     * @return obj|array
     */
    public function getOne($id=0){
        if($id>0 && !is_array($id)){//(new \common\models\User())->find()->one();
            $result=$this->_model->findOne($id);
        }else{
            $result=$this->_model->find()->where($id)->one();
        }
        if($id==0){
            $result=$this->_model->find()->one();
        }
        if(empty($result) || !is_object($result)){
            $result=$this->_model;
        }
        return $result;
    }
    
    /**
     * 说明：获取一条联合查询
     * @author 飞鹰007(email:371399893@qq.com)
     * @param string $select
     * @param string $main_table 查询的主表名
     * @param array $join_table 要联合查询的表名
     * @param array $join_table_on 关联字段
     * @param string|array $orderby 排序可以数组与字符 数组如 ['id'=>SORT_DESC]
     * @param integer|array $id 数组方式 ['id'=>[1,2,3]]
     * @param string $groupby
     * @param boolean $show_sql
     * @return
     */
    public function getJoinOne($select='',$main_table='',$join_type=[],$join_table=[],$join_table_on=[],$orderby='',$id=0,$groupby='id',$show_sql=false){
        if($id==""){
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
        if(!empty($groupby)){
            $query->groupby($groupby);
        }
        if(!empty($orderby)){
            $query->orderby($orderby);
        }
        $this->_query=clone $query;
        if($show_sql){
            return $this->_query->createCommand()->getRawSql();
        }
//        $command=clone $query;
//        echo $command->createCommand()->getRawSql();
//        die;
        $row=$query->one();
        return $row;    
    }
    
    /**
     * 说明：插入数据
     * @author 飞鹰007(email:371399893@qq.com)
     * @param array $data activeform的数据，模型名的数组
     * @return boolean
     */
    public function save($data) {
        if($this->_model->load($data) && $this->_model->validate()){
            $result=$this->_model->save(false);
            if(!$result){
                $error=array_values($this->_model->getFirstErrors());
                if(!empty($error)){
                    $this->setErrors($error[0]);
                    \Yii::$app->session->setFlash('error', $error[0]);
                    return false;
                }
            }
            return true;
            //return $this->_model->save(false);
        }else{
            $error=$this->_model->getFirstErrors();
            if(!empty($error)){
                \Yii::$app->session->setFlash('error', implode(",", $error[0]));
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
    public function update($id=[],$data=[]){
        if($this->_model->load($data) && $this->_model->validate()){
            $error='';
            if(!empty($id)){
                $attributes=$data[$this->_model_name];
                unset($attributes['id']);
                foreach($id as $k=>$v){
                    $result=$this->_model->updateAll($attributes,"id=".$v);
                    if(!$result){
                        $error.='操作ID:'.$v."<br />";
                    }else{
                        $error.='<font color=red>操作成功ID:'.$v."</font><br />";
                    }
                }
                if(!empty($error)){
                    \Yii::$app->session->setFlash('success', $error);
                    return rtrim($error);
                }
                return true;
            }
            return false;
        }else{
            $error=$this->_model->getFirstErrors();
            if(!empty($error)){
                \Yii::$app->session->setFlash('error', implode(",", $error));
            }
            return false;
        }
    }
    
    /**
     * 说明：批量删除数据
     * @author 飞鹰007(email:371399893@qq.com)
     * @param array $condition 一般是指ID的数组 如 $id=[1,2,3,4,5]
     * @return
     */
    public function delete($condition=[]){
        if(!empty($condition) && !is_array($condition) && is_numeric($condition)){
            $condition=['id'=>$condition];
        }
        $result=$this->_model->deleteAll($condition);
        if($result){
            //$this->trigger(self::EVENT_AFTER_DELETE);
            \Yii::$app->session->setFlash('success', '操作成功');
            return true;
        }
        \Yii::$app->session->setFlash('error', '操作失败');
        return false;
    }
    
    /**
     * 说明：获取单一字段值
     * @author 飞鹰007(email:371399893@qq.com)
     * @param string $attribute
     * @param array $where
     * @return mixed
     */
    public function getSingleAttribute($attribute='id',$where=[]){
        if(empty($where)){
            return null;
        }
        return $this->_model->find()->select($attribute)->where($where)->scalar();
    }
    
    public function getRawSql(){
        if(empty($this->_query)){
            return '未设置查询语句';
        }
        return $this->_query->createCommand()->getRawSql();
    }
}