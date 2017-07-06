<?php

namespace backend\logic;

class ActivityLogic extends \common\logic\baseLogic {

    public function __construct() {
        $this->loadModel('ActivityModel');
    }
    
    public function getActivityList($to_array=false){
        $join = [
            'table' => ['name' => 'activity', 'alias' => 'a'],
            'join_table' => [
                ['name' => 'financial_type', 'alias' => 'ft', 'join_type' => 'left', 'on' => 't.user_id=u.id'],
                ],
            'select' => 'u.username,t.*',
        ];
        $search_filter =[];
        if(isset($this->get[$model->formName()]['start_time'])){
            array_push($search_filter, ['var_type'=>'int','var_name'=>'start_time','table_alias'=>'t','filter_method'=>'and']);
        }
        if(isset($this->get['FinancialConfigTradesModel']['id'])){
            array_push($search_filter, ['var_type'=>'int','var_name'=>'id','table_alias'=>'t','filter_method'=>'and']);
        }
        $where=[];
        
        $to_array=false;
        $where=[];
        $orderby=['id'=>SORT_DESC];
        $limit=10;
        $join=[];
        $page_item_num=10;
        $http_query=[];
        $search_filter=[];
        
        return $this->getList($to_array,$where,$orderby,$limit,$join,$page_item_num,$http_query,$search_filter);
    }
    
}
