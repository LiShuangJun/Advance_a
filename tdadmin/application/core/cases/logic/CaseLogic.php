<?php
namespace core\cases\logic;

use core\Logic;
use core\cases\model\CaseModel;

class CaseLogic extends Logic
{

  
    /**
     * 新增或修改jt组
     *
     * @param array $data            
     * @param array $jt_arr                     
     *
     * @return integer
     */
    public function joinjt($id, $jt_arr = [])
    {
        
         
            
            // 关联监听
            $this->attachJt($id, $jt_arr);
            
         
       
    }


    /**
     * 关联监听组
     *
     * @param integer $articleId            
     * @param array $articleCates            
     *
     * @return void
     */
    public function attachJt($caseid, $jt_arr = [])
    {
        is_array($jt_arr) || $jt_arr = array_filter(explode(',', $jt_arr));
        
        // 保存关联
        $case= CaseModel::get($caseid);
        $case->jtarr()->detach();
        if(!empty($jt_arr)){
            return  $case->jtarr()->attach($jt_arr);
        }
       
    }

    
    /*
     * 根据id查询case详情
     * 
     */
    public function casesById($id){
        $casemodel=CaseModel::getInstance();
        $case_alias=$casemodel->alias_name;
         //查询该case信息
         $map = [
            $case_alias.'.delete_time' => 0,
            $case_alias.'.id'=>$id
        ];
        $case = $casemodel->getCaseList($map)->select();
        if(!empty($case)){
          return $case[0];  
        }else{
            return [];
        }
        
    }
   
  
  /*
   * 根据条件查询case数量
   * 
   * 
   */
    public function getCaseCount($map=null,$type=null){
        $casemodel=CaseModel::getInstance();
        $case_alias=$casemodel->alias_name;
         //查询该case信息
        if(!$type){
            $map[ 'delete_time']  = 0;
        }
         $count = $casemodel->where($map)->count();
         return $count;
    }
}