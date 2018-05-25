<?php
namespace core\cases\logic;

use core\Logic;
use core\cases\model\CompanyModel;

class CompanyLogic extends Logic
{

    /*
     * 获取对应的公司类型额外字段数组
     */
    public function getMoreContent(
            $data=['birthday'=>'','policy'=>'','idtype'=>'','idnumber'=>'','start_time'=>'','stop_time'=>'','change_content'=>'']
            ){
        
        //获取证件类型数组
        $idtype=$this->getIdType();
       
        return $arr=[
            [],
            [
              'birthday'=> [
                   'type'=>'date',
                   'title'=>'出生日期',
                   'name'=>'birthday',
                   'value'=>$data['birthday']
               ],
                'start_time'=> [
                   'type'=>'date',
                   'title'=>'保单开始日期',
                   'name'=>'start_time',
                   'value'=>$data['start_time'] 
               ],
                'stop_time'=> [
                   'type'=>'date',
                   'title'=>'保单结束日期',
                   'name'=>'stop_time',
                   'value'=>$data['stop_time'] 
               ],
             'policy'=>[
                   'type'=>'text',
                   'title'=>'保单号',
                   'name'=>'policy',
                   'value'=>$data['policy'] 
               ],
              'idtype'=> [
                   'type'=>'select',
                   'title'=>'证件类型',
                   'name'=>'idtype',
                   'value'=>$data['idtype'] ,
                   'list'=>$idtype
               ],
               'idnumber'=> [
                   'type'=>'text',
                   'title'=>'证件号',
                   'name'=>'idnumber',
                   'value'=>$data['idnumber'] 
                   
                ],
                'change_content'=>[
                   'type'=>'textarea',
                   'title'=>'保单变更信息',
                   'name'=>'change_content',
                   'value'=>$data['change_content'] 
               ]
            ]
        ];
    }
    
    
    /*
     * 获取证件类型数组
     */
    public function getIdType() {
        return [
           [
               'name'=>'身份证',
               'value'=>1
           ],
            [
              'name'=>'护照',
               'value'=>2   
            ]
        ];
    }
      /*
     * 根据id查询公司类型
     */
    public function getTypeById($id) {
        return CompanyModel::getInstance()->where(['id'=>$id])->value('type');
               
    }
    
    /*
     * 查询公司列表
     */
    public function getCompanyList($map=null,$type=0,$sort='sort desc') {
        $map['status']=1;
        if($type){
         return    CompanyModel::getInstance()->where($map)->find();
        }else{
         return    CompanyModel::getInstance()->where($map)->order($sort)->select();
        }
        
               
    }
  
}