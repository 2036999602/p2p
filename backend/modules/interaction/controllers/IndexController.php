<?php

namespace backend\modules\interaction\controllers;

use yii\web\Controller;

/**
 * Default controller for the `interaction` module
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
    
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $logic=\common\logic\BaseLogic::getInstance()->loadModel('ActivityLogModel');       
        $model=$logic->getModel();
        $to_array=false;
        $where=[];
        $orderby=['id'=>SORT_DESC];
        $limit=10;
        $join=[];
        $page_item_num=10;
        
        $search_filter=[];
        if(isset($this->get[$model->formName()]['award_type']) && $this->get[$model->formName()]['award_type']){
            $search_filter[]=[
                'var_type'=>'int',//该字段的类型 int 与 string 或者var_query_range=[value1,value2]
                'var_name'=>'award_type',//字段名
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
        return $this->render('index',['title'=>'互动列表','list'=>$list,'model'=>$model]);
    }
    
    public function actionRecommendFriends(){
        $logic=\common\logic\BaseLogic::getInstance()->loadModel('MemberRecommendFriendsModel');       
        $model=$logic->getModel();
        $to_array=false;
        $where=[];
        $orderby=['id'=>SORT_DESC];
        $limit=10;
        $join=[
            'table'=>['name'=>'user','alias'=>'u'],//table是查询主表 join_table是要联合查询的表
            'join_table'=>[['name'=>'member_recommend_friends','alias'=>'mrf','join_type'=>'right','on'=>'u.id=mrf.recommender_user_id']],
            'select'=>'mrf.*,u.username',//注意这里的m,ext,u要与alias对应
        ];
        $page_item_num=10;
        
        $search_filter=[];
        if(isset($this->get[$model->formName()]['create_at']) && $this->get[$model->formName()]['created_at']){
            $this->get[$model->formName()]['create_at']=strtotime($this->get[$model->formName()]['created_at']);
            $search_filter[]=[
                'var_type'=>'int',//该字段的类型 int 与 string 或者var_query_range=[value1,value2]
                'operator'=>'>=',
                'var_name'=>'created_at',//字段名
                'table_alias'=>'mrf',//表的别名，与join_table的设置一致，add_type是member_ext表的字段
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
        $groupby='mrf.recommender_user_id';        
        $list=$logic->getList($to_array,$where,$orderby,$limit,$join,$page_item_num,$http_query,$search_filter,$groupby);
        return $this->render('/recommend_friends/index',['title'=>'推荐好友列表','list'=>$list,'model'=>$model]);
    }
}
