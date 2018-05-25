<?php
namespace core\cases\model;

use core\Model;
use think\Request;
use core\cases\logic\CountryLogic;
use core\cases\logic\CaseLogic;
use core\cases\logic\CompanyLogic;
use core\cases\logic\ChatUserLogic;
use app\common\sendemail\SendUser;
class CaseModel extends Model
{

    /**
     * 去前缀表名
     *
     * @var unknown
     */
    protected $name = 'cases_case';

    /**
     * 自动写入时间戳
     *
     * @var unknown
     */
    protected $autoWriteTimestamp = true;

    /**
     * 新增时自动完成
     *
     * @var array
     */
    protected $insert = [
        'case_code'
    ];

/*
 * 定义别名变量
 */
   public $alias_name='a_case';
   
   /*
    * 获取全部管理case
    */
   public function getCaseList($map=null){
        $alias=$this->alias_name; //case表别名
        $aliastype=CaseTypeModel::getInstance()->alias_name; //类型表别名
        $counry=CountryModel::getInstance()->alias_name; //国家表别名
        $province=AreaModel::getInstance()->alias_name[0];  //省
        $city=AreaModel::getInstance()->alias_name[1];   //市
        $district=AreaModel::getInstance()->alias_name[2]; //区
        $user=ChatUserModel::getInstance()->alias_name; //用户
        $status=CaseStatusModel::getInstance()->alias_name; //状态
        $ks= KsModel::getInstance()->alias_name;//科室
        $case_list = $this->withCates()->field(
                $alias.'.*,'
                .$aliastype.'.typename,'.$aliastype.'.typeename,'
                .$counry.'.name as country_name,'.$counry.'.ename as country_ename,'.$province.'.area_name as province_name ,'.$city.'.area_name as city_name ,'.$district.'.area_name as district_name ,'
                .$user.'.user_name as case_username , '.$user.'.avatar as user_avatar , '.$user.'.company as user_company , '
                .$status.'.color as statuscolor ,'.$status.'.name as statusname , '
                .$ks.'.ks_name ,'.$ks.'.ks_ename '
                )->where($map)
            ->order($status.'.sort desc, '.$alias.'.sort desc,'.$alias.'.create_time desc');
        
        
        return $case_list;
   }
    /**
     * 使用别名
     *
     * @param unknown $query            
     */
    public function useAlias()
    {
        return $this->alias($this->alias_name);
    }
           /**
     * 关联监听组
     *
     * @return \think\model\relation\BelongsToMany
     */
    public function jtarr()
    {
        return $this->belongsToMany(UserModel::class, JtModel::getInstance()->getTableShortName(), 'user_id', 'cases_id');
    }
   /**
     * 连接分类
     *
     * @return \think\db\Query
     */
    public function withCates()
    {
        $query = $this->useAlias();
        $query=$this->joinCates($query);//加入分类
        $query= $this->withUser($query);//加入用户
        $query=$this->joinCountry($query);//加入国家
        $query= $this->joinStatus($query); //加入状态
        $query= $this->joinKs($query);  //加入科室
        return $this->joinAddress($query);
    }
    
           /**
     * 连接科室
     *
     * @return \think\db\Query
     */
    protected function joinKs($query)
    {
        $ks= KsModel::getInstance();
        return $query->join($ks->getTableShortName() . ' '.$ks->alias_name, $this->alias_name.'.ks_type = '.$ks->alias_name.'.ks_id');
    }  
         /**
     * 连接监听组
     *
     * @return \think\db\Query
     */
    protected function joinjt($query)
    {
        $jt= JtModel::getInstance();
        $user= UserModel::getInstance();
        return $query->join(JtModel::getInstance()->getTableShortName() .' '.$jt->alias_name,$this->alias_name.'.id ='.$jt->alias_name.'.cases_id')
            ->join(JtModel::getInstance()->getTableShortName().' '.$jt->alias_name,$user->alias_name. '.id ='.$jt->alias_name.'.user_id');
    }
   /**
     * 连接状态
     *
     * @return \think\db\Query
     */
    public function joinStatus($query)
    {
        $casestatus= CaseStatusModel::getInstance();
        return $query->join($casestatus->getTableShortName() . ' '.$casestatus->alias_name, $this->alias_name.'.case_status = '.$casestatus->alias_name.'.id');
    }
    /**
     * 连接提交case用户
     *
     * @return \think\db\Query
     */
     public function withUser($query)
    {
       $user=ChatUserModel::getInstance();
       return $query->join($user->getTableShortName() . ' '.$user->alias_name, $this->alias_name.'.userid = '.$user->alias_name.'.id');
    }
    /**
     * 连接分类
     *
     * @return \think\db\Query
     */
    public function joinCates($query)
    {
        $casetype=CaseTypeModel::getInstance();
        return $query->join($casetype->getTableShortName() . ' '.$casetype->alias_name, $this->alias_name.'.case_type = '.$casetype->alias_name.'.id');
    }

    /**
     * 连接国家
     *
     * @return \think\db\Query
     */
    public function joinCountry($query)
    {
        $casetype=CountryModel::getInstance();
        return $query->join($casetype->getTableShortName() . ' '.$casetype->alias_name, $this->alias_name.'.country = '.$casetype->alias_name.'.id');
    }
    
       /**
     * 连接省市区
     *
     * @return \think\db\Query
     */
    public function joinAddress($query)
    {
        $casetype=AreaModel::getInstance();
        return $query->join($casetype->getTableShortName() . ' '.$casetype->alias_name[0], $this->alias_name.'.province = '.$casetype->alias_name[0].'.id')
                     ->join($casetype->getTableShortName() . ' '.$casetype->alias_name[1], $this->alias_name.'.city = '.$casetype->alias_name[1].'.id')
                     ->join($casetype->getTableShortName() . ' '.$casetype->alias_name[2], $this->alias_name.'.district = '.$casetype->alias_name[2].'.id');
    }
    
    
 
    /**
     * 自动设置caseId
     *
     * @return string
     */
    protected function setCaseCodeAttr()
    {
        
              $request=\think\Request::instance();
//          if($request->userid){
//              $userid=$request->userid;
//          }
//        
        
        $field=$request->param();
        if(isset($field['country'])&&(isset($field['userid']))){
           
            //后台递交
           $countryid=$field['country'];
           $userid=$field['userid']; 
           return $this->getNewCaseKey($countryid,$userid);
           exit;
        }elseif(isset($field['body'])){
            
            //接口调用
            $body=$field['body'];
            //urldecode解密
         $body=urldecode($body);
         //base64解密
         $body= base64_decode($body);
         if(!is_null(json_decode($body,true))){
             $userdata=json_decode($body,true); 
             $user_alias= ChatUserModel::getInstance()->alias_name;//chatuser表别名
             $map=[
           $user_alias.'.u_status'=>1,
           $user_alias.'.user_name'=>$userdata['username'],
           $user_alias.'.pwd'=>md5($userdata['pwd'])
            ];
           $userid= ChatUserLogic::getInstance()->getUserId($map);  //该用户id
             $countryid=$userdata['country'];
           return $this->getNewCaseKey($countryid,$userid);
           exit;
         }else{
             exit;
         }
            
        }elseif($request->userid){
           
            //前端页面提交
           $countryid=$field['country'];
           $userid=$request->userid; 
           return $this->getNewCaseKey($countryid,$userid);
           exit;
        }
      
        
    
        
        
    }

    /**
     * 获取一个新的CaseID
     *
     * @return string
     */
    public function getNewCaseKey($countryid,$userid)
    {
       $request = Request::instance();
       $field=$request->param();
      //查询国家信息
        $countrymap=[
            'id'=>$countryid
        ];
        $country=CountryLogic::getInstance()->getCountryList($countrymap, 1);
        $country_abbreviation=$country['abbreviation'];
        
        //获取case总数(包含未删除)
        $count=CaseLogic::getInstance()->getCaseCount([],1);
        
        /*
         * 获取公司简称
         */
        //获取用户所在公司
        $usermap=[
            'id'=>$userid
        ];
         
        $companyid=ChatUserModel::getInstance()->where($usermap)->value('company');
        
        if($companyid){
          //获取公司信息 
         $companymap=[
             'id'=>$companyid
         ];
         $company=CompanyLogic::getInstance()->getCompanyList($companymap, 1);
         $company_abbreviation=$company['abbreviation'];
         
        for ($index = 1; $index < 100; $index++) {
            $caseid='';
            $casemap=[];
            
            $caseid=$country_abbreviation.sprintf("%'X6s", $count+$index).$company_abbreviation;
            
            $casemap=[
                'case_code'=>$caseid
            ];
            $casecount=CaseLogic::getInstance()->getCaseCount($casemap,1);
            if(!$casecount){
                //如果成功获取case编号，先给用户发送邮件
//               $userinfo= ChatUserLogic::getInstance()->getUserlist($usermap,1);
//                if(isset($user['email'])||!empty($user['email'])){
//                        //发送邮件  
//                        $email=new SendUser();
//                        $email->addCaseSend($user);
//                  }
                  
                 //给公司绑定的每个邮箱发送邮件
                 //查询公司绑定的邮箱列表
                 $companylist=db('cases_company_email')->where(['c_id'=>$companyid])->select();
                if(!empty($companylist)){ 
                     foreach ($companylist as $key => $value) {
                        $user=[];
                        $user['email']=$value['email'];
                        
                        $user['case_code']=$casecount;
                         //根据公司获取case邮件内容
                        $value['casecontent'] || $value['casecontent']=1;
                        $emailcontent=db('cases_email_content')->where(['id'=>$value['casecontent']])->find();
                        $field['content']= $emailcontent['content'];
                        //用户所在公司
                        $field['company']=$company['name'];
                        $field=$this->updatefield($field);
                        if($company['type']==1){
                            $userinfo= ChatUserLogic::getInstance()->getUserlist(['id'=>$userid],1);
                            $user['policy']=$userinfo['policy'];
                        }else{
                            $user['policy']='';
                        }
                        $user['field']=$field;
                        if(isset($user['email'])||!empty($user['email'])){
                        //发送邮件  
                        $email=new SendUser();
                        $email->addCaseSend($user);
                         }
                     }
                 }
                return $caseid;
                break;
            }
        }
        
       }else{
          return false;
       } 
       
    }   
  
    
    //整理字段
    public function updatefield($field) {
        //查询case类型
            $casetype=db('cases_case_type')->where(['id'=>$field['case_type']])->find();
            $field['typename']=$casetype['typename'];
            $field['typeename']=$casetype['typeename'];
          
        //处理性别
             if($field['sex']==1){
                 $field['sexname']='男';
                 $field['sexename']='Male';
             }else{
                 $field['sexname']='女';
                 $field['sexename']='Female';
             }
        //是否本人
             if($field['isme']==1){
                 $field['ismename']='是';
                 $field['ismeename']='Yes';
             }else{
                 $field['sexname']='否';
                 $field['sexename']='No';
             }
        //与患者关系
             if($field['isme']==1){
                 $field['relationship']='';
               
             }
        //国家
         $country= db('cases_country')->where(['id'=>$field['country']])->find();
         $field['countryname']=$country['name'];
         $field['countryename']=$country['ename'];
       
         if($field['country']==1){
             //省
             $province= db('cases_area')->where(['id'=>$field['province']])->find();
             $field['provincename']=$province['area_name'];
             //市
             $city= db('cases_area')->where(['id'=>$field['city']])->find();
             $field['cityname']=$city['area_name'];
             //区
             $district= db('cases_area')->where(['id'=>$field['district']])->find();
             $field['districtname']=$district['area_name'];
             
         }
         
        return $field;
         
    }
    

//    
//        /**
//     * 自动设置文章key
//     *
//     * @return string
//     */
//    protected function setCaseCodeAttr($value=null)
//    {
//        
//        $request=\think\Request::instance();
//        $id=Request::instance()->param('id');
//        $field=$request->param('field');
//        if(!$id){
//             $status=0;
//        }else{
//            if($field){
//                 $map=[
//                     'id'=>$id,
//                      'delete_time'=>0
//                 ];
//                 $code = $this->where($map)->find();
//                 return $code['case_code'];
//                 exit;
//             }else{
//                 $status=1;
//             }
//           
//        }
//        
//      
//            return $this->getNewCaseKey($value,$status);
//      
//           
//        
//    }

//    /**
//     * 获取一个新的文章Key
//     *
//     * @return string
//     */
//    public function getNewCaseKey($value=null,$status=0)
//    {
//       $request = Request::instance();
//       
//   
//      if($value){
//              $articleKey=$value;
//              $type=1;
//        }else{ 
//            
//                 $articleKey=$this->gethtime();
//                 $type=2;
//             
//              
//         }
//      if($status==0){
//          $map = [
//            'case_code' => $articleKey,
//            'delete_time'=>0
//           ];
//      }else{
//          $map = [
//            'case_code' => $articleKey,
//            'delete_time'=>0,
//              'id'=>['neq',Request::instance()->param('id')]
//           ];
//      }
//        
//        $record = $this->where($map)->find();
//        if (empty($record)) {
//            return $articleKey;
//        } else {
//            if($type==2){
//                return $this->getNewCaseKey();
//            }else{
//                $this->error('caseId已存在请重新添加');
//            }
//            
//        }
//       
//    }
//    
//    /*
//     * 获取当前毫秒时间戳
//     */
//    public function gethtime(){
//         $articleKey = microtime();
//               list($s1, $s2) = explode(' ', $articleKey);		
//         return (float)sprintf('%.0f', (floatval($s1) + floatval($s2)) * 1000);
//    }

}