<?php
namespace common\logic;

abstract class AbstractLogic{
    abstract public function getList($to_array,$where,$orderby,$limit,$join,$page_item_num,$http_query,$search_filter);
    abstract public function getOne($id);   
    abstract public function getJoinOne($select,$main_table,$join_type,$join_table,$join_table_on,$orderby,$id);
    abstract public function save($data);
    abstract public function update($id,$data);
    //abstract public function where($condition);
    abstract public function delete($condition);
    abstract public function scenario($scenario);    
    abstract public function getSingleAttribute($attribute,$where);
}