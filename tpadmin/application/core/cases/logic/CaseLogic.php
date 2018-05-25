<?php
namespace core\cases\logic;

use core\Logic;
use core\cases\model\CaseModel;
use core\cases\model\CaseStatusModel;
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


/*
 * 获取关联case详情
 * 
 */
       public function getCaseList($mr,$mr2=null,$field,$limit){
        $casemodel=CaseModel::getInstance();
        $casestatus=CaseStatusModel::getInstance();
        $status_name=$casestatus->alias_name;
        $case_alias=$casemodel->alias_name;
         $query= CaseModel::getInstance()->alias($case_alias)->
                 join($casestatus->getTableShortName() . ' '.$status_name, $case_alias.'.case_status = '.$status_name.'.id');
         
            
        
       return $query->field($field)->where($mr)->where($mr2)->limit($limit)->select();
         
    }
    
    
    //根据case类型获取case额外字段
    //$type 中文还是英文  1为中文
     public function getMoreContent($data=[],$type=1)   
    {
        
        //获取是否类型数组
        $idtype=$this->getIdType($type);
       if($type==1){
           $Hypertension='高血压';
           $highCholestero='高胆固醇';
           $heartDisease='心脏病';
           $kidneyDisease='肾脏疾病';
           $eyeDisease='眼病';
           $footLegProblems='脚或腿问题';
           $msIssues='精神压力问题';
           $mfConcerns='男性或女性的担忧';
           $smokingDate='吸烟停止日期';
           $alcoholDate ='酒精停止日期';
           $MRBPressure='最近的血压';
           $HbA1c='最近的HbA1c';
           $isAccept='是否同意协议';
       }else{
          $Hypertension='Hypertension';
           $highCholestero='High cholestero';
           $heartDisease='Heart disease';
           $kidneyDisease='Kidney disease';
           $eyeDisease='Eye disease';
           $footLegProblems='Foot or leg problems';
           $msIssues='Mental stress issues'; 
           $mfConcerns='Male or female concerns';
           $smokingDate='Smoking stop date';
           $alcoholDate='Alcohol stop date';
           $MRBPressure='Most recent blood pressure';
           $HbA1c='Most recent HbA1c';
           $isAccept='Whether to agree to the agreements';
       }
        return $arr=[
            1=>[],
            2=>[
              'Hypertension'=> [
                   'type'=>'radio',
                   'title'=>$Hypertension,
                   'name'=>'Hypertension',
                   'value'=> isset($data['Hypertension'])?$data['Hypertension']:0,
                   'list'=>$idtype
               ],
                'highCholestero'=> [
                   'type'=>'radio',
                   'title'=>$highCholestero,
                   'name'=>'highCholestero',
                   'value'=> isset($data['highCholestero'])?$data['highCholestero']:0,
                   'list'=>$idtype
               ],
                'heartDisease'=> [
                   'type'=>'radio',
                   'title'=>$heartDisease,
                   'name'=>'heartDisease',
                   'value'=>isset($data['heartDisease'])?$data['heartDisease']:0,
                   'list'=>$idtype,
               ],
                 'kidneyDisease'=> [
                   'type'=>'radio',
                   'title'=>$kidneyDisease,
                   'name'=>'kidneyDisease',
                   'value'=>isset($data['kidneyDisease'])?$data['kidneyDisease']:0,
                   'list'=>$idtype,
               ],
                'eyeDisease'=> [
                   'type'=>'radio',
                   'title'=>$eyeDisease,
                   'name'=>'eyeDisease',
                   'value'=>isset($data['eyeDisease'])?$data['eyeDisease']:0,
                   'list'=>$idtype,
               ],
                'footLegProblems'=> [
                   'type'=>'radio',
                   'title'=>$footLegProblems,
                   'name'=>'footLegProblems',
                   'value'=>isset($data['footLegProblems'])?$data['footLegProblems']:0,
                   'list'=>$idtype,
               ],
                'msIssues'=> [
                   'type'=>'radio',
                   'title'=>$msIssues,
                   'name'=>'msIssues',
                   'value'=>isset($data['msIssues'])?$data['msIssues']:0,
                   'list'=>$idtype,
               ],
                'mfConcerns'=> [
                   'type'=>'radio',
                   'title'=>$mfConcerns,
                   'name'=>'mfConcerns',
                   'value'=>isset($data['mfConcerns'])?$data['mfConcerns']:0,
                   'list'=>$idtype,
               ],
                'smokingDate'=> [
                   'type'=>'date',
                   'title'=>$smokingDate,
                   'name'=>'smokingDate',
                   'value'=>isset($data['smokingDate'])?$data['smokingDate']:'',
               ],
                'alcoholDate'=> [
                   'type'=>'date',
                   'title'=>$alcoholDate,
                   'name'=>'alcoholDate',
                   'value'=>isset($data['alcoholDate'])?$data['alcoholDate']:'',
               ],
                'MRBPressure'=> [
                   'type'=>'date',
                   'title'=>$MRBPressure,
                   'name'=>'MRBPressure',
                   'value'=>isset($data['MRBPressure'])?$data['MRBPressure']:'',
               ],
                'HbA1c'=> [
                   'type'=>'date',
                   'title'=>$HbA1c,
                   'name'=>'HbA1c',
                   'value'=>isset($data['HbA1c'])?$data['HbA1c']:'',
               ],
                'isAccept'=> [
                   'type'=>'radio',
                   'title'=>$isAccept,
                   'name'=>'isAccept',
                   'value'=>isset($data['isAccept'])?$data['isAccept']:1,
                   'list'=>$idtype,
               ]
            
            ],
           3=>[],
           4=>[]
        ];
    }
                /*
  * 获取是否下拉列表
  */
    
        public function getIdType($type=1)
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