<?php
namespace common\components;

class Area extends \yii\base\Component{
    public $diy_params;
    public function __construct($config = array()) {
        parent::__construct($config);
        echo "地区组件初始化 功能待开发，组件的参数为：".$this->diy_params;
    }
    public function getCountry($id=0){
        echo "areaComponents 获取国别".$id;
    }
    
    public function getProvince($id=0){
        echo "areaComponents 获取省份".$id;
    }
    
    public function getCity($id=0){
        echo "areaComponents 获取城市".$id;
    }
    
    public function getLocalArea($id=0){
        echo "areaComponents 获取市区县".$id;
    }
}