<?php
namespace app\medicalapi\controller;

use think\Config;
use think\Request;
use cms\Response;
use cms\Controller;
use core\cases\model\CaseModel;
use core\cases\model\CompanyModel;
use core\cases\model\ChatUserModel;
use core\cases\logic\ChatUserLogic;
use core\cases\logic\CompanyLogic;
use cms\upload\processes\CropProcess;
use cms\upload\processes\OrientationProcess;
use app\common\App;
use app\common\factories\FileFactory;
use cms\upload\validates\CaseApiVaildate;
Header("Access-Control-Allow-Origin: * ");
Header("Access-Control-Allow-Methods: POST");
Header('Access-Control-Allow-Headers:x-requested-with,content-type'); 
class Base extends Controller
{
    protected $body=[];
    function _initialize() {
    //function a(){a
//        header("Content-type: text/html; charset=utf-8");
        $request= Request::instance();
       
//      $time=time();
//      echo $time."<br/>";
//      $apiid=md5('THEYUN'.$time);
//      $apipwd=md5($time.'THEYUN');
//      echo $apiid.'<br/>';
//      echo $apipwd.'<br/>';exit;
//      print_r(json_encode($request->param())); 
      
        
//    echo urlencode(base64_encode('{"username":"wangqiang@meetuuu.com","pwd":"123","where":"eyJjYXNlaWQiOnsiZXEiOiJlM2FhYjBlOTZmOWM3YmI4ZDA3OTI4NzhmYTg0MzU3YyJ9fQ%3D%3D","field":"caseid,case_status","limit":"1"}'));
//      exit;   
     
     
//     $body='eyJ1c2VybmFtZSI6IndhbmdxaWFuZ0BtZWV0dXV1LmNvbSIsInB3ZCI6IjEyMyIsIndoZXJlIjoiZXlKallYTmxhV1FpT25zaVpYRWlPaUpsTTJGaFlqQmxPVFptT1dNM1ltSTRaREEzT1RJNE56aG1ZVGcwTXpVM1l5SjlmUSUzRCUzRCIsImZpZWxkIjoiY2FzZWlkLGNhc2Vfc3RhdHVzIiwibGltaXQiOiIxIn0%3D';
//        $time=1504165281;
//     $apiid='fae1642cca025e189c745da5d8b06a57';
//     $apipwd='39dfb57e2b525e81fe68445bfd25cf1a';
//  echo md5(base64_encode($body.$time.$apiid.$apipwd));
// exit;   
        if($request->isPost()){
        
        
      

       
        $apiid=$request->param('apiid');
        if(empty($apiid)){
           echo json_encode(['code' => '40001','msg' => 'invalid code']);
           exit;
        }
        $apipwd=$request->param('apipwd');
        $time=$request->param('timestamp');
        $sign=$request->param('sign');
        $body=$request->param('body');
       

        //验证签名密钥
        $v_sign=md5(base64_encode($body.$time.$apiid.$apipwd));
        if($v_sign!==$sign){
             echo json_encode(['code' => '40004','msg' => 'invalid code']);
             exit;
        }
        //解密body
        $this->jmbody($body);
        $body=$this->body; //赋值给类的属性
       
        //验证用户名和密码
        if(!isset($body['username'])){
           echo json_encode(['code' => '50001','msg' => 'invalid code']);
           exit;
        }
        if(!isset($body['pwd'])){
           echo json_encode(['code' => '50002','msg' => 'invalid code']);
           exit;
        }
        $username=$body['username'];
        $pwd=$body['pwd'];
        $usermap=[
            'user_name'=>$username,
            'pwd'=> md5($pwd)
        ];
        $user_content=$this->ishave($usermap);
        if(empty($user_content)){
            unset($usermap['pwd']);
            $user_content=$this->ishave($usermap);
            if(empty($user_content)){
               echo json_encode(['code' => '50001','msg' => 'invalid code']);
               exit;
            }else{
               echo json_encode(['code' => '50002','msg' => 'invalid code']);
               exit; 
            }
            
        }
        
        $companyid=$user_content['company'];
        $companymap=[
            'id'=>$companyid,
            'apiid'=>$apiid,
            'apipwd'=>$apipwd
        ];
        $company_content=CompanyLogic::getInstance()->getCompanyList($companymap,1);
        if(empty($company_content)){
            unset($companymap['apipwd']);
            $company_content=CompanyLogic::getInstance()->getCompanyList($companymap,1);
            if(empty($company_content)){
                echo json_encode(['code' => '40001','msg' => 'invalid code']);
                exit;
            }else{
               echo json_encode(['code' => '40002','msg' => 'invalid code']);
               exit;
            }
        }
        }else{
           echo json_encode(['code' => '-1','msg' => 'invalid code']);
           exit;
        }
     }
     protected function ishave($where=null) {
         $where['u_status']=1;
         return ChatUserLogic::getInstance()->getUserlist($where,1);
     }
     
   
     //解密body
    protected function jmbody($body=null) {
         //urldecode解密
         $body=urldecode($body);
         //base64解密
         $body= base64_decode($body);
         if(!is_null(json_decode($body,true))){
             $this->body=json_decode($body,true); 
         }
        
        
     }
     
   /**
     * 上传case附件
     *
     * @param array $file            
     * @param array $option            
     *
     * @return array
     */
    protected function uploadCaseFile($file)
    {
        // 上传文件
        $type = is_array($file) ? FileFactory::TYPE_UPLOAD : FileFactory::TYPE_STREAM;
        $upfile = FileFactory::make($type);
        $upfile->load($file);
        
        // 上传对象
        $upload = App::getSingleton()->upload;
        
        // 文件后缀
        $extensions = ['zip','pdf','doc','jpeg','jpg','png'];
        $maxsize='10M';
        if (! empty($extensions)) {
            $option = [
                'extensions' => $extensions,
                'max_size'=>$maxsize
            ];
            $upload->addValidate(new CaseApiVaildate($option));
        }
        
        // 图片重力
        $upload->addProcesser(new OrientationProcess());
        
        // 图片大小
        if (isset($option['width']) || isset($option['height'])) {
            $upload->addProcesser(new CropProcess($option));
        }
        
        // 上传文件
        return $upload->upload($upfile);
    }
     
 
}