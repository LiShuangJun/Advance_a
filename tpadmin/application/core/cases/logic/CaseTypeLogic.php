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
    
        public function getSelectType($sort_name='sort',$sort='asc',$type=1)   //type 1为获取 中文名称，2为获取英文名称
    {
           $data= CaseTypeModel::getInstance()->order($sort_name, $sort)->select();
       
           $list=[

           ];
           if($type==1){
               $field='typename';
           }else{
              $field='typeename';
           }
     
               foreach ($data as $key => $value) {
               $list[]=[
                 'name'=>$value[$field],
                 'value'=>$value['id'],
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
    
        public function getSelectCountry($sort_name='sort',$sort='asc',$type=1)
    {
           $data= CountryModel::getInstance()->order($sort_name, $sort)->select();
           $list=[

           ];
           if($type==1){
               $field='name';
           }else{
                $field='ename';
           }
           foreach ($data as $key => $value) {
               $list[]=[
                 'name'=>$value[$field],
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
    
        public function getSelectSex($type=1)
    {
            if($type==1){
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
            }else{
                return [
                    [
                        'name' => 'Male',
                        'value' => 1
                    ],
                    [
                        'name' => 'Female',
                        'value' => 0
                    ]
                 ];
            }
        
           
    }
            /*
  * 获取是否下拉列表
  */
    
        public function getSelectIs($type=1)
    {
            if($type==1){
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
            }else{
                 return [
            [
                'name' => 'Yes',
                'value' => 1
            ],
            [
                'name' => 'No',
                'value' => 0
            ]
        ];
            }
       
           
    }
}