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
            $data=['birthday'=>'','policy'=>'','idtype'=>'','idnumber'=>'','start_time'=>'','stop_time'=>'','change_content'=>''],$type=1
            ){
        
        //获取证件类型数组
        $idtype=$this->getIdType(2);
       if($type==1){
           $birthday='出生日期';
           $start_time='保单开始日期';
           $stop_time='保单结束日期';
           $policy='保单号';
           $idtypename='证件类型';
           $idnumber='证件号';
           $change_content='保单变更信息';
       }else{
          $birthday='Date of Birth';
           $start_time='Begins of Policy';
           $stop_time='End of Policy';
           $policy='Policy number';
           $idtypename='Type of Certificate';
           $idnumber='Number';
           $change_content='Policy change Information'; 
       }
        return $arr=[
            [],
            [
              'birthday'=> [
                   'type'=>'date',
                   'title'=>$birthday,
                   'name'=>'birthday',
                   'value'=>$data['birthday']
               ],
                'start_time'=> [
                   'type'=>'date',
                   'title'=>$start_time,
                   'name'=>'start_time',
                   'value'=>$data['start_time'] 
               ],
                'stop_time'=> [
                   'type'=>'date',
                   'title'=>$stop_time,
                   'name'=>'stop_time',
                   'value'=>$data['stop_time'] 
               ],
             'policy'=>[
                   'type'=>'text',
                   'title'=>$policy,
                   'name'=>'policy',
                   'value'=>$data['policy'] 
               ],
              'idtype'=> [
                   'type'=>'select',
                   'title'=>$idtypename,
                   'name'=>'idtype',
                   'value'=>$data['idtype'] ,
                   'list'=>$idtype
               ],
               'idnumber'=> [
                   'type'=>'text',
                   'title'=>$idnumber,
                   'name'=>'idnumber',
                   'value'=>$data['idnumber'] 
                   
                ],
                'change_content'=>[
                   'type'=>'textarea',
                   'title'=>$change_content,
                   'name'=>'change_content',
                   'value'=>$data['change_content'] 
               ]
            ]
        ];
    }
    
    
    /*
     * 获取证件类型数组
     */
    public function getIdType($type=1) {
        if($type==1){
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
        }else{
           return [
           [
               'name'=>'ID Card',
               'value'=>1
           ],
            [
              'name'=>'Passport',
               'value'=>2   
            ]
        ]; 
        }
        
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