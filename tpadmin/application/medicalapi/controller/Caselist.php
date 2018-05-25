<?php
namespace app\medicalapi\controller;

use cms\Controller;
use think\Request;
use core\cases\model\ChatUserModel;
use core\cases\model\CompanyModel;
use core\cases\logic\ChatUserLogic;
use think\Validate;
use core\cases\model\CaseModel;
use core\manage\model\FileModel;
use core\cases\logic\CaseLogic;
use core\cases\model\CaseStatusModel;
class Caselist extends Controller
{
    
   
 
    
   
    public function casedemo(){
        $data=CaseLogic::getInstance()->casesById(30);
    
      return json($data);
      exit;
    }
}