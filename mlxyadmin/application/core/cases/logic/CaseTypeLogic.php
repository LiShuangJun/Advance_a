<?php
namespace core\cases\logic;

use core\Logic;
use core\cases\model\CaseTypeModel;
use core\cases\model\CaseStatusModel;
use core\cases\model\CountryModel;
use core\cases\model\KsModel;

class CaseTypeLogic extends Logic
{

 /*
  * 获取类型下拉列表
  */
    
        public function getSelectType($sort_name='sort',$sort='asc')
    {
           $data= CaseTypeModel::getInstance()->order($sort_name, $sort)->select();
           $list=[

           ];
           foreach ($data as $key => $value) {
               $list[]=[
                 'name'=>$value['typename'],
                 'value'=>$value['id']
               ];
           }
           
           
           return $list;
    }
    
     /*
  * 获取状态下拉列表
  */
    
        public function getSelectStatus($sort_name='sort',$sort='desc')
    {
           $data= CaseStatusModel::getInstance()->order($sort_name, $sort)->select();
           $list=[

           ];
           foreach ($data as $key => $value) {
               $list[]=[
                 'name'=>$value['name'],
                 'value'=>$value['id']
               ];
           }
           
           
           return $list;
    }
    
       /*
  * 获取国家下拉列表
  */
    
        public function getSelectCountry($sort='sort')
    {
           $data= CountryModel::getInstance()->order($sort)->select();
           $list=[

           ];
           foreach ($data as $key => $value) {
               $list[]=[
                 'name'=>$value['ename'],
                 'value'=>$value['id']
               ];
           }
           
           
           return $list;
    }
         /*
  * 获取科室列表
  */
    
        public function getSelectKs($sort_name='ks_sort',$sort='desc')
    {
           $data= KsModel::getInstance()->order($sort_name, $sort)->select();
           $list=[

           ];
           foreach ($data as $key => $value) {
               $list[]=[
                 'name'=>$value['ks_name'].'('.$value['ks_ename'].')',
                 'value'=>$value['ks_id']
               ];
           }
           
           
           return $list;
    }  

          /*
  * 获取性别下拉列表
  */
    
        public function getSelectSex()
    {
        return [
            [
                'name' => '男',
                'value' => 1
            ],
            [
                'name' => '女',
                'value' => 0
            ]
        ];
           
    }
            /*
  * 获取是否下拉列表
  */
    
        public function getSelectIs()
    {
        return [
            [
                'name' => '是',
                'value' => 1
            ],
            [
                'name' => '否',
                'value' => 0
            ]
        ];
           
    }
}