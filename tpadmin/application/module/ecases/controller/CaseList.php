<?php
namespace module\ecases\controller;

use think\Request;
use think\Session;
use think\cache\driver\Redis;
use core\cases\model\CaseModel;
use core\cases\model\CaseTypeModel;
use core\cases\model\ChatUserModel;
use core\cases\logic\CaseTypeLogic;
use core\cases\model\CountryModel;
use core\cases\model\AreaModel;
use core\manage\logic\UserLogic;
use core\manage\model\UserModel;
use core\cases\logic\ChatUserLogic;
use core\cases\validate\CaseValidate;
use core\cases\validate\EcaseValidate;
use core\cases\logic\CaseLogic;
use core\cases\model\ChatGroupModel;
use core\cases\model\GroupDetailModel;
use app\manage\service\LoginService;
use core\manage\model\FileModel;
use core\cases\model\CompanyModel;
use core\cases\model\JtModel;
use app\common\sendemail\SendUser;
class CaseList extends Base
{

    /**
     * case列表
     *
     * @param Request $request            
     * @return string
     */
    public function index(Request $request)
    {

        $this->siteTitle = 'Case List';
        //获取case表的别名
        $case_alias=CaseModel::getInstance()->alias_name;
        // case列表
        $map = [
            $case_alias.'.delete_time' => 0
        ];
      
        $this->assignCaseList($map);
        
        //是否监听
        $this->isJt();
        return $this->fetch();
    }

    /*
     * 当前登录帐号是否监听
     */
    public function isJt() {
        $login = LoginService::getSingleton();   
        $loginUser = $login->getLoginUser();
        $id=$loginUser['user_id'];
        $this->assign('userid', $id);//管理员当前登录id
        $logic =UserLogic::getInstance();
        $list=$logic->isJT($id);
        if(!empty($list)){
            
            $is_jt=1;
        }else{
            $is_jt=0;
        }
        $this->assign('is_jt', $is_jt);
    }
       /**
     * case详情
     *
     * @param Request $request            
     * @return string
     */
    public function case_content($id)
    {
        
        $this->siteTitle = 'Case content';
        
        // case详情
        $model = CaseModel::getInstance();
        
       //获取case详情
        $case_list=CaseLogic::getInstance()->casesById($id);
       //print_r($case_list);exit;
        if(empty($case_list)){
            $this->error('The case does not exist or is invalid', self::JUMP_BACK);
            exit;
        }
        if($case_list['case_manager']){
            $map=[
                'managerid'=>$case_list['case_manager']
            ];
            $users=ChatUserLogic::getInstance()->getUsersAll($map,1);
             
            $this->assign('users',$users);
        }else{
            $this->assign('users',[]);
        }
       
        $jtarr=[];
        foreach ($case_list->jtarr as $key => $value) {
            $jtarr[]=$value['user_name'];
        }
        $this->assign('jtstr', implode(',', $jtarr));
        $this->assign('case_list',$case_list);
        return $this->fetch();
    }

/**
     * 赋值case列表
     *
     * @param array $map            
     *
     * @return void
     */
    protected function assignCaseList($map)
    {
        $request = Request::instance();
        //获取case表的别名
        $case_alias=CaseModel::getInstance()->alias_name;
        // 查询国家
        $cate = $request->param('country');
        if (! empty($cate)) {
            $cate = intval($cate);
            $map[$case_alias.'.country'] = $cate;
        }
        $this->assign('country', $cate);
        
        // 查询条件-状态
        $status = $request->param('status', '');
        if ($status != '') {
            $status = intval($status);
            $map[$case_alias.'.case_status'] = $status;
        }
        $this->assign('status', $status);
        
        // 查询条件-类型
        $casetype = $request->param('casetype','');
        if (!empty($casetype)) {
            $map[$case_alias.'.case_type'] = intval($casetype);
        }
        $this->assign('casetype',intval($casetype));
        
        // 查询条件-关键词
        $keyword = $request->param('keyword');
        if ($keyword != '') {
            $map[$case_alias.'.username'] = [
                'like',
                '%' . $keyword . '%'
            ];
        }
         $this->assign('keyword', $keyword);
        //查询条件-负责人
        $managerid= $request->param('managerid');
        if ($managerid) {
            $managerid = intval($managerid);
            $map[$case_alias.'.case_manager'] = $managerid;
            $map[$case_alias.'.case_status'] = ['in','2,5'];
        }
        $this->assign('managerid', $managerid);
        
        // 分页列表
        $model = CaseModel::getInstance();
        $case_list=$model->getCaseList($map);
        
        $this->casePage($case_list);
        
      
        $this->getTypeList();
        
        $this->getStatusList();
        
        $this->getCountryList();
 
    }
//case分页
    public function casePage($model, $rowNum = null, \Closure $perform = null){
        $rowNum || $rowNum = config('manage_row_num');
        $rowNum || $rowNum = 10;
        
      $model = $this->buildModel($model);
        
        $list = $model->paginate($rowNum);
        $perform && $perform($list);
        foreach ($list as $key => $value) {
             $jtarr=[];
             $users=[];
            foreach ($value->jtarr as $k => $v) {
                $jtarr[]=$v['id'];
            }
            $list[$key]['jtarr']= $jtarr;
            if($value['case_manager']){
                $map=[
                   'managerid'=>$value['case_manager']
                ];
                $users=ChatUserLogic::getInstance()->getUsers($map,1);
            }
            if(!empty($users)){
                $list[$key]['managername']= $users['nickname'].'('.$users['user_name'].')';
            }else{
                if($value['case_status']==2){
                    $list[$key]['managername']= 'Waiting for acceptance'; 
                }else{
                   $list[$key]['managername']= 'Unspecified'; 
                }
                
            }
            //查询公司
            if($value['user_company']){
                $cmap=[
                    'id'=>$value['user_company']
                ];
                $company=CompanyModel::getInstance()->where($cmap)->value('name');
                $list[$key]['company_name']= $company;
            }
        }
     
        $this->assign('_list', $list);
        $this->assign('_page', $list->render());
        $this->assign('_total', $list->total());
    }

    //获取类型数组
     protected function getTypeList(){
         
         $logic =CaseTypeLogic::getInstance();
         $typelist=$logic->getSelectType(null,null,2);

         $this->assign('typelist',$typelist);
     }
    
 //获取科室数组
     protected function getKsList(){
         
         $logic =CaseTypeLogic::getInstance();
         $kslist=$logic->getSelectKs();

         $this->assign('kslist',$kslist);
     } 

  //获取状态数组
    protected function getStatusList(){
         
         $logic =CaseTypeLogic::getInstance();
         $status_list=$logic->getSelectStatus();
         $this->assign('status_list',$status_list);
     }
     
       //获取国家数组
    protected function getCountryList(){
         
         $logic =CaseTypeLogic::getInstance();
         $country_list=$logic->getSelectCountry(null,null,2);
         $this->assign('country_list',$country_list);
     }
    
            //获取监听数组
    protected function getJtList(){
         
         $logic =UserLogic::getInstance();
         $where=[
             'user_gid'=>config('am_jianting'),
             'user_status'=>1,
             'delete_time'=>0
         ];
         $jt_list=$logic->getSelectList($where);
       
        ksort($jt_list);  //排序
         $this->assign('jt_list',$jt_list);
     }
            //获取普通用户数组
    protected function getUserList(){
         
         $logic = ChatUserLogic::getInstance();
         $where=[
             'is_manager'=>0,
             'managerid'=>0,
             'delete_time'=>0
         ];
         $chatuser=$logic->getSelectUser($where);
        
         $this->assign('chatuser',$chatuser);
     }
       //获取性别数组
    protected function getSexList(){
         
         $logic =CaseTypeLogic::getInstance();
         $case_manager=$logic->getSelectSex(2);
         $this->assign('sexlist',$case_manager);
     }
       //获取是否数组
    protected function getIsList(){
         
         $logic =CaseTypeLogic::getInstance();
         $case_manager=$logic->getSelectIs(2);
         $this->assign('islist',$case_manager);
     }
     
     //省市区联动
     protected function assignProvinceList(){
        
    	//地区
    	$area= AreaModel::all(['parent_id'=>0]);
    	$this->assign('area',$area);

     }
     

     /**
     * 更改case
     *
     * @param Request $request            
     * @return mixed
     */
    public function modify(Request $request)
    {
        $fields = [
            'case_status',
            'case_manager',
           
        ];
        
        $field=$request->param('field');
        $value=$request->param('value','');
        
        
      
        if($field=='case_manager'){
            $value && $this->actionByManager($value);
        }
        if($field=='case_status'){
            
            $value && $this->actionByStatus($value);
            
        }
        
        $this->_modify(CaseModel::class, $fields);
    }
 /*
  * 如果接收到case_manager的值需要将case assigned
  * 
  */
     public function actionByManager($value) {
         $map = [
            'id' => $this->_id(),
            'case_status'=>1
        ];
        //建立聊天群组
        $this->addGroup();
         
         $data=[
                    'case_status'=>2
                ];
         
       $result=CaseModel::getInstance()->save($data,$map);
       if(!$result){
           $this->error('Please adjust the status of the case pending and then modify');
           exit;
       }
       $data=ChatUserModel::where('managerid',$value)->find();
      
      
       if($data){
         $username=$data['nickname'];
           $msg=new \message\mess();
           $url='http://'.$_SERVER['HTTP_HOST'].'/service';
           $data['url']=$url;
           $mess_content=ChatUserLogic::getInstance()->getLanguage($data,1); //获取短信内容
            $msg->send($data['tel'], $mess_content['content']);
            
       }
       
     }
  
     /*
      * 新建群组
      */
     public function addGroup(){
         $id= $this->_id();
         $casemodel=CaseModel::getInstance();
        //获取case详情
        $case=CaseLogic::getInstance()->casesById($id);
       

        //新建群组
        $data=[
            'group_name'=>$case['case_code'],
            'avatar'=>$case['user_avatar'],
            'owner_name'=>$case['case_username'],
            'owner_id'=>$case['userid'],
            'addtime'=>time(),
            'status'=>1
        ];
        // 添加
            $model = ChatGroupModel::getInstance();
            $status = $model->save($data);
            $casemodel->where(['id'=>$id])->update(['groupid'=>$model['id']]);
           
       
        
     }
     
    /*
     * 根据接收不同的状态进行不同的操作
     * 
     */
    public function actionByStatus($value) {
        $id= $this->_id();
        $where = [
            'id' => $id
        ];
       
        $case=CaseLogic::getInstance()->casesById($id);
      
        $group=GroupDetailModel::getInstance();
        switch ($value) {
                case 1:
                  //查询casemanager用户信息
                $managerdata=ChatUserModel::getInstance()->where(['managerid'=>$case['case_manager']])->find();
                $userid=$managerdata['id'];   //casemanager用户id
                $groupid=$case['groupid'];
                
                $map=[
                    'group_id'=>$groupid,
                    'user_id'=>$userid   
                ];
                 $group->where($map)->update(['status'=>0]);   //修改该用户在该表中的状态
                $data=[
                    'case_manager'=>0
                ];
               
                CaseModel::getInstance()->save($data,$where);
                    break;
                case 5:
                    //发送通知邮件
                  
                    
                    $userdata=ChatUserModel::getInstance()->where(['managerid'=>$case['case_manager'],'delete_time'=>0])->find();
                    $userdata['case_code']=$case['case_code'];
                   
                    $email=new SendUser();
                    $email->acceptCase($userdata);
                    $alldata=$this->editByJt($case);  //分配聊天室
                      $group->saveAll($alldata);
                      
                      break;
                
                default:
                    break;
            }
    }
   
        /**
     * 添加case
     *
     * @param Request $request            
     * @return string
     */
    public function add(Request $request)
    {
        
        if ($request->isPost()) {
            
            $data = [
                'username' => $request->param('username'),
                'birthday' => $request->param('birthday'),
                'sex' => $request->param('sex'),
                'isme' => $request->param('isme'),
                'relationship' => $request->param('relationship'),
                'applicant_name' => $request->param('applicant_name'),
                'address' => $request->param('address'),
                'province' => $request->param('province', 110000),
                'city' => $request->param('city', 110100),
                'district' => $request->param('district', 110101),
                'zip_code' => $request->param('zip_code'),
                'preferred_phone' => $request->param('preferred_phone'),
                'standby_phone' => $request->param('standby_phone'),
                'preferred_time' => $request->param('preferred_time'),
                'illness' => $request->param('illness'),
                'treatment_doctor' => $request->param('treatment_doctor'),
                'treatment_hospital' => $request->param('treatment_hospital'),
                 'specialty' => $request->param('specialty'),
                 'case_type' => $request->param('case_type'),
                'case_note' => $request->param('case_note'),
                'sort' => $request->param('sort',0),
                'userid' => $request->param('userid'),
                'country'=>$request->param('country'),
                'email'=>$request->param('email'),
                'ks_type'=>$request->param('ks_type',1),
                'e_province'=>$request->param('e_province'),
                'Hypertension'=>$request->param('Hypertension'),
                'highCholestero'=>$request->param('highCholestero'),
                'heartDisease'=>$request->param('heartDisease'),
                'kidneyDisease'=>$request->param('kidneyDisease'),
                'eyeDisease'=>$request->param('eyeDisease'),
                'footLegProblems'=>$request->param('footLegProblems'),
                'msIssues'=>$request->param('msIssues'),
                'mfConcerns'=>$request->param('mfConcerns'),
                'smokingDate'=>$request->param('smokingDate'),
                'alcoholDate'=>$request->param('alcoholDate'),
                'MRBPressure'=>$request->param('MRBPressure'),
                'HbA1c'=>$request->param('HbA1c'),
                'isAccept'=>$request->param('isAccept'),
          
            ];
           if(empty($data['province'])){
               $data['province']=110000;
           }
           if(empty($data['city'])){
               $data['city']=110100;
           }
           if(empty($data['district'])){
               $data['district']=110101;
           }
            if($request->param('options')){
                $file=FileModel::getInstance()->where(['file_url'=>$request->param('options')])->find();
                if(!empty($file)){
                    $data['options']=$file['id'];
                }
            }
             // 验证
            $this->_validate(EcaseValidate::class, $data, 'add');
            
            // 添加
            $model = CaseModel::getInstance();
           
            $status = $model->save($data);
            $this->success('Added successfully', self::JUMP_REFERER);
        } else {
            $this->siteTitle = 'Add case';
           
            
           //性别
            $this->getSexList();
            
          //是否
            $this->getIsList();
            
            //获取省列表
            $this->assignProvinceList();
            //获取国家列表
            $this->getCountryList();
          
                //获取监听列表
            $this->getJtList();
        
            //获取服务类型列表
        $this->getTypeList();
            //获取状态类型列表
        //$this->getStatusList();
           
                    //获取用户列表
        $this->getUserList();
       //获取case科室列表
       $this->getKsList();
       //获取额外表单信息表
       $this->assign('typemore', CaseLogic::getInstance()->getMoreContent([],2));
            return $this->fetch();
        }
    }
    
    
       /**
     * 编辑case
     *
     * @param Request $request            
     * @return mixed
     */
    public function edit(Request $request)
    {
        $caseid=$this->_id();
        if ($request->isPost()) {
            $data = [
                'username' => $request->param('username'),
                'birthday' => $request->param('birthday'),
                'sex' => $request->param('sex'),
                'isme' => $request->param('isme'),
                'relationship' => $request->param('relationship'),
                'applicant_name' => $request->param('applicant_name'),
                'address' => $request->param('address'),
                'province' => $request->param('province', 110000),
                'city' => $request->param('city', 110100),
                'district' => $request->param('district', 110101),
                'zip_code' => $request->param('zip_code'),
                'preferred_phone' => $request->param('preferred_phone'),
                'standby_phone' => $request->param('standby_phone'),
                'preferred_time' => $request->param('preferred_time'),
                'illness' => $request->param('illness'),
                'treatment_doctor' => $request->param('treatment_doctor'),
                'treatment_hospital' => $request->param('treatment_hospital'),
                 'specialty' => $request->param('specialty'),
                 'case_type' => $request->param('case_type'),
                'case_note' => $request->param('case_note'),
                'sort' => $request->param('sort',0),
                 'country'=>$request->param('country'),
                'email'=>$request->param('email'),
                'ks_type'=>$request->param('ks_type'),
                'e_province'=>$request->param('e_province'),
                'Hypertension'=>$request->param('Hypertension'),
                'highCholestero'=>$request->param('highCholestero'),
                'heartDisease'=>$request->param('heartDisease'),
                'kidneyDisease'=>$request->param('kidneyDisease'),
                'eyeDisease'=>$request->param('eyeDisease'),
                'footLegProblems'=>$request->param('footLegProblems'),
                'msIssues'=>$request->param('msIssues'),
                'mfConcerns'=>$request->param('mfConcerns'),
                'smokingDate'=>$request->param('smokingDate'),
                'alcoholDate'=>$request->param('alcoholDate'),
                'MRBPressure'=>$request->param('MRBPressure'),
                'HbA1c'=>$request->param('HbA1c'),
                'isAccept'=>$request->param('isAccept')
            ];
             if(empty($data['province'])){
               $data['province']=110000;
           }
           if(empty($data['city'])){
               $data['city']=110100;
           }
           if(empty($data['district'])){
               $data['district']=110101;
           }
            if($request->param('options')){
                $file=FileModel::getInstance()->where(['file_url'=>$request->param('options')])->find();
                if(!empty($file)){
                    $data['options']=$file['id'];
                }
            }
             // 验证
            $this->_validate(EcaseValidate::class, $data, 'edit');    
           
            // 修改
            $model = CaseModel::getInstance();
            $map = [
            'id' => $caseid
            ];
            $status = $model->save($data,$map);
            
            if($status){
                $jt_arr=$request->param('jtlist/a',[]);
               
                $case=CaseLogic::getInstance()->casesById($caseid);
                
                $group=GroupDetailModel::getInstance();
                if($case['groupid']){
                     
                          $jtid_arr=[];
                              foreach ($case->jtarr as $vo) {
                                      $jtid_arr[] = $vo['id'];
                                    }
                        foreach ($jtid_arr as $key => $value) {
                         $jtdata=ChatUserModel::getInstance()->where(['managerid'=>$value])->find();//jt
                         if(empty($jtdata)){
                          $this->error('Check the listener with unopened layim!');
                         }  
                         //查询该监听是否在群中或者有无加群记录
                         $map = [
                        'group_id' => $case['groupid'],
                        'user_id' => $jtdata['id']
                         ];
                         
                           $group->where($map)->update(['status'=>0]); 
                        }
                         
                      
                      
                     CaseLogic::getInstance()->joinjt($caseid, $jt_arr);
                     
                     if(!empty($jt_arr)){
                          //监听
                      $alldata=[];
                      
                      
                     foreach ($jt_arr as $key => $value) {
                         $jtdata=ChatUserModel::getInstance()->where(['managerid'=>$value])->find();//jt
                        if(empty($jtdata)){
                          $this->error('Check the listener with unopened layim!');
                         }  
                         //查询该监听是否在群中或者有无加群记录
                         $map = [
                        'group_id' =>$case['groupid'],
                        'user_id' => $jtdata['id']
                         ];
                          
                    $count=$group->where($map)->count();
                   
                    if($count){
                           $group->where($map)->update(['status'=>1]); 
                      }else{
                        
                          $data=[
                              'user_id'=>$jtdata['id'],
                              'user_name'=>$jtdata['user_name'],
                              'user_avatar'=>$jtdata['avatar'],
                              'group_id'=>$case['groupid'],
                              'status'=>1 
                          ];
                           
                          $alldata[]=$data;
                         
                       }
                      }
                      
                    $group->saveall($alldata);
                     }
                     
                }
               
            }
            $this->success('Edited successfully', self::JUMP_REFERER);
        } else {
            $this->siteTitle = 'Edit case';
            
            
        $model = CaseModel::getInstance();
        $case_list=[];
   
        if($caseid){
           $case_list=CaseLogic::getInstance()->casesById($caseid);

        }else{
            $this->error('Illegal operation', self::JUMP_REFERER);
        }
        
         $jtarr= [];
        foreach ($case_list->jtarr as $vo) {
            $jtarr[] = $vo['id'];
        }
        //查询附件信息
        $filearr=FileModel::getInstance()->where(['id'=>$case_list['options']])->find();
        $case_list['options_data']=$filearr;
        $case_list['case_jt']=$jtarr;
        $this->assign('case_list', $case_list);
            
           //性别
            $this->getSexList();
            
          //是否
            $this->getIsList();
            
            //获取省列表
            $this->assignProvinceList();
            //获取国家列表
            $this->getCountryList();
          
      //获取监听列表
            $this->getJtList();
        
            //获取服务类型列表
        $this->getTypeList();
            //获取状态类型列表
       // $this->getStatusList();
    
        //获取科室列表
        $this->getKsList();
        //获取额外表单信息表
        $this->assign('typemore', CaseLogic::getInstance()->getMoreContent($case_list,2));
            return $this->fetch();
        
        }
    }
    
    /*
     * 根据case修改编辑聊天室
     */
    public function editByJt($case){
         $chatuser=ChatUserModel::getInstance();
                    
                    $managerdata=$chatuser->where(['managerid'=>$case['case_manager']])->find();//casemanager
                    $groupid=$case['groupid'];
                    $case_manager=$case['case_manager'];
                    $user_id=$case['userid'];
                    $user_name=$case['case_username'];
                    $user_avatar=$case['user_avatar'];
                   
                    
                    $alldata=[];
                   $group=GroupDetailModel::getInstance();
                   //配置默认监听
                   //查询该用户所属公司下方有效监听数组
                   $companyarr=CompanyModel::getInstance()->where(['id'=>$managerdata['company']])->find();
                   $default_jt=[];
                   empty($companyarr) || $default_jt=explode(',', $companyarr['default']);
                   $jt_arr=[];
                   foreach (@$default_jt as $key => $value) {
                       $jtcount= UserModel::getInstance()->where(['delete_time'=>0,'id'=>$value,'user_gid'=> config('am_jianting')])->count();
                       if($jtcount){
                           $jt_arr[]=$value;
                       }
                   }
                   //将监听数组分配至聊天室
                   foreach (@$jt_arr as $key => $value) {
                       $caseid=$case['id'];
                       //查询监听有没有跟被该case指定过
                      $cj_count=JtModel::getInstance()->where(['cases_id'=>$caseid,'user_id'=>$value])->count();
                      $cj_map=[
                          'cases_id'=>$caseid,
                          'user_id'=>$value                        
                      ];
                      if(!$cj_count){
                          JtModel::getInstance()->save($cj_map);
                      }
                       $jtdata=$chatuser->where(['managerid'=>$value])->find();//casemanager
                       $map=[
                          'group_id'=>$groupid,
                          'user_id'=>$jtdata['id']                         
                      ];
                      $count=$group->where($map)->count();
                      if($count){
                           $group->where($map)->update(['status'=>1]); 
                      }else{
                          $data=[
                              'user_id'=>$jtdata['id'],
                              'user_name'=>$jtdata['user_name'],
                              'user_avatar'=>$jtdata['avatar'],
                              'group_id'=>$groupid,
                              'status'=>1 
                          ];
                          $alldata[]=$data;
                      }
                   }
                    //查询该case_manager是否在群中或者有无加群记录
                    $map=[
                          'group_id'=>$groupid,
                          'user_id'=>$managerdata['id']                         
                      ];
                      $count=$group->where($map)->count();
                      if($count){
                           $group->where($map)->update(['status'=>1]); 
                      }else{
                          $data=[
                              'user_id'=>$managerdata['id'],
                              'user_name'=>$managerdata['user_name'],
                              'user_avatar'=>$managerdata['avatar'],
                              'group_id'=>$groupid,
                              'status'=>1 
                          ];
                          $alldata[]=$data;
                      }
                   
                   //患者
                    $map=[
                          'group_id'=>$groupid,
                          'user_id'=>$user_id                        
                      ];
                      $count=$group->where($map)->count();
                      if($count){
                           $group->where($map)->update(['status'=>1]); 
                      }else{
                          $data=[
                              'user_id'=>$user_id,
                              'user_name'=>$user_name,
                               'user_avatar'=>$user_avatar,
                              'group_id'=>$groupid,
                              'status'=>1 
                          ];
                          $alldata[]=$data;
                      }
                      
                      return $alldata;
    }
        /**
     * 删除case
     *
     * @param Request $request            
     * @return mixed
     */
    public function delete(Request $request)
    {
        $this->_delete(CaseModel::class, true);
    }
                
    

        
}