<?php
namespace common\logic;

interface FileLogicInterface{
    public function getFile($file_id,$doc_id,$user_id,$type_id,$return_format_url,$get_attributes);
}