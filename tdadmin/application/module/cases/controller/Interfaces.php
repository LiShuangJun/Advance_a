<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace module\cases\controller;

use think\Controller;
use think\Request;
use cms\Response;
use core\cases\model\AreaModel;
use core\cases\model\CompanyModel;
use core\cases\logic\CompanyLogic;
use core\manage\model\FileModel;
use core\cases\model\CaseModel;
use cms\upload\validates\AmCaseVaildate;
use cms\upload\processes\CropProcess;
use cms\upload\processes\OrientationProcess;
use app\common\App;
use app\common\factories\FileFactory;
class Interfaces extends Controller
{
             
    public function getCity(Request $request){
        $model =AreaModel::getInstance();
    	$ParentId=$request->param('ParentId');
        $where='parent_id='.$ParentId;      
    	$current_city=$model->getlist($where);
    	$data['data']=$current_city;
        return json($data);
    	
    }
    
    public function getDistrict(Request $request){
    	$model =AreaModel::getInstance();
    	$ParentId=$request->param('ParentId');
        if($ParentId){
        $where='parent_id='.$ParentId;
    	$current_county=$model->getlist($where);
    	$data['data']=$current_county;
        
    	 return json($data);
         }
    }
    
    public function getCompanyMore(Request $request){
         $companyid=$request->param('companyid');
        $typeid=CompanyModel::getInstance()->where(['id'=>$companyid])->value('type');
       
//        $data=CompanyLogic::getInstance()->getMoreContent();
        
        return json($typeid);
    }
    
   public function DownloadFile(Request $request){
       $hash_str=$request->param('hash_str');
       $file_data=FileModel::getInstance()->where(['file_hash'=>$hash_str])->find();
       if(empty($file_data)){
           echo '文件丢失，请重新上传!';
           exit;
        }
        $case=CaseModel::getInstance()->where(['options'=>$file_data['id']])->find();
        $file = $file_data['file_url'];
        $filename = $case['case_code'].'.'.$file_data['file_ext'];
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Content-type:text/html;charset=utf-8");
        header('Content-Disposition: attachment; filename='. $filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        readfile($file);
        echo '<script>window.close();</script>';
        exit;
    }
    
    
    public function uploadExcel(Request $request) {
       
        $file = request()->file('upload_file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->validate(['size'=>10485760,'ext'=>'xls,xlsx'])->move(ROOT_PATH. 'public' . DS . 'uploads' . DS .'excel');
        if($info){
            
           $data['url']='uploads/excel/'.$info->getSaveName();
           echo json_encode($data);
        }else{
        // 上传失败获取错误信息
        $data['msg']=$file->getError();
        echo json_encode($data);
        }
        
        
    }
     public function valid_login(){
        if(empty(cookie('phone_user_id'))){
           $data['msg']=0;
        }else{
            $data['msg']=1;
        }
        echo json_encode($data);
        exit;
        
    }
    
}