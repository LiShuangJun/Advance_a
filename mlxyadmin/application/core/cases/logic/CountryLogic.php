<?php
namespace core\cases\logic;

use core\Logic;
use core\cases\model\CountryModel;

class CountryLogic extends Logic
{

    /*
     * 根据条件查询国家信息
     */
    public function getCountryList($map=null,$type=0) {
        if($type){
           $data=CountryModel::getInstance()->where($map)->find(); 
        }else{
           $data=CountryModel::getInstance()->where($map)->find(); 
        }
        
        
        return $data;
    }
  
}