<?php
// +----------------------------------------------------------------------
// | ichat-v3.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\laychatphone\controller;

use think\Controller;
use app\laychatphone\model\ChatUser;
use app\laychatphone\model\Friends;
use app\laychatphone\model\GroupDetail;
use app\laychatphone\model\ChatGroup;
use app\laychatphone\model\Cases;
use think\Request;
use think\Db;
use app\laychatphone\model\Message;
use core\cases\logic\CaseLogic;
use core\cases\model\ChatGroupModel;
use core\cases\model\GroupDetailModel;
use core\cases\model\CaseModel;
use core\cases\model\ChatUserModel;
use core\cases\logic\ChatUserLogic;
use core\cases\model\JtModel;
use core\cases\model\CompanyModel;
use core\manage\model\UserModel;
use app\common\sendemail\SendUser;
class Phone extends Base
{
    public function index()
    {
        $this->assign('server_name',$_SERVER['SERVER_NAME']);
        $request=Request::instance();
        $caseid=$request->param('id');
        $caseid || $caseid=1;
        //聊天用户
        $userInfo = [
            'id' => cookie('phone_user_id'),
            'username' => cookie('phone_user_name'),
            'avatar' => cookie('phone_user_avatar'),
            'sign' => cookie('phone_user_sign'),
        ];
      $chatuser=new ChatUser;
      $friendsModle=new Friends;
      $groupdetailModle=new GroupDetail;
      

        // 查询自己的信息
        $uid = cookie('phone_user_id');
        $mine = $chatuser->where('id', $uid)->find();
       
            
           $chatdata= db('cases_case')->alias('c')->field('vg.group_name,vg.id,vg.avatar')->join(['nd_cases_chatgroup'=>'vg'],'c.groupid=vg.id')->where(['c.id'=>$caseid])->find();
         if(empty($chatdata)){
             echo '聊天室不存在';
             exit;
         }
          //查询当前用户的所处的群组
        $groupArr = $groupdetailModle->alias('j')->field('c.group_name groupname,c.id,c.avatar')
            ->join(['nd_cases_chatgroup'=>'c'], 'j.group_id = c.id')->where(['j.user_id'=>$uid,'j.status'=>1] )
            ->group('j.group_id')->select();

            $this->updateLog($chatdata['id']); //更新聊天记录
           $this->assign('chat_alert',$chatdata);
           $this->assign('mineid',$uid);
        $online = 0;
        $group = [];  //记录分组信息
        $userGroup = config('user_group');
        $list = [];  //群组成员信息
        $i = 0;
        $j = 0;
        //查询该用户的好友
        $friends = $friendsModle->alias('f')->field('c.user_name,c.id,c.avatar,c.sign,c.status,f.group_id')
            ->join(['nd_cases_chatuser'=>'c'], 'c.id = f.friend_id')
            ->where('f.user_id', $uid)->select();

        foreach( $userGroup as $key=>$vo ){
            $group[$i] = [
                'groupname' => $vo,
                'id' => $key,
                'online' => 0,
                'list' => []
            ];
            $i++;
        }
        unset( $userGroup );

        foreach( $group as $key=>$vo ){

            foreach( $friends as $k=>$v ) {

                if ($vo['id'] == $v['group_id']) {

                    $list[$j]['username'] = $v['user_name'];
                    $list[$j]['id'] = $v['id'];
                    $list[$j]['avatar'] = $v['avatar'];
                    $list[$j]['sign'] = $v['sign'];
                    $list[$j]['status'] = empty($v['status']) ? 'offline' : 'online';

                    if (1 == $v['status']) {
                        $online++;
                    }

                    $group[$key]['online'] = $online;
                    $group[$key]['list'] = $list;

                    $j++;
                }
            }
            $j = 0;
            $online = 0;
            unset($list);
        }

        //自定义
        // $new_group[0] = [
        //     'groupname' => '聊天室',
        //     'id' => 1,
        //     'online' => 0,
        //     'list' => []
        // ];
        // $new_group[0]['list']=$groupArr;


        //自定义结束
        //print_r($group);die;
        unset( $friends );

        $return = [
            'mine' => [
                    'username' => $mine['user_name'],
                    'id' => $mine['id'],
                    'status' => 'online',
                    'sign' => $mine['sign'],
                    'avatar' => $mine['avatar']
            ],
            'group' => $groupArr,
        ];

        //echo json_encode($return);die;

        $this->assign([
            'userlist' => json_encode($return),
            'uinfo' => $userInfo
        ]);
        
       
        return $this->fetch();
    }
    //手机端case详情
    public function case_content($id=1){
        $action_data=$this->getIdentity();
        //print_r($action_data['is_jt']);exit;
         $this->assign('is_jt',$action_data['is_jt']);
         $this->assign('action_data',$action_data);
        if($id){
            $casemodel=new Cases;
             $chatuser=new ChatUser;
            $arr=['nd_cases_case.id'=>$id];
            $case_content=$casemodel->getList($arr);  //获取单条case
            $case_content=$case_content[0];
             $manager_content=[];
            if($case_content['case_manager']){
               $manager_content = $chatuser->where('managerid', $case_content['case_manager'])->find(); 
            }
            
            
            $user_content = $chatuser->where('id', $case_content['userid'])->find();
            $case=CaseLogic::getInstance()->casesById($id);
            $jt_arr=[];
            foreach ($case->jtarr as $vo) {
                   $jtdata=ChatUserModel::getInstance()->where(['managerid'=>$vo['id']])->find();//jt
                   $jt_arr[]=$jtdata['nickname'];
                  }
            $case_content['jt_str']= implode(',', $jt_arr);   
             $this->assign('user_content',$user_content);
            $this->assign('manager_content',$manager_content);
            $this->assign('case_content',$case_content);
        }
        

         return $this->fetch();
    }
    private function getperson(){
         $chatuser=new ChatUser;
                // 查询自己的信息
        $uid = cookie('phone_user_id');
        $mine = $chatuser->where('id', $uid)->find();
        $company= db('cases_company')->where('id',$mine['company'])->find();
        //print_r($mine['is_manager']);exit;
        $mine['companyname']=$company['name'];
        $this->assign('is_manager',$mine['managerid']);
        return $mine;
    }
    //检测登录者身份
    private function getIdentity(){

        $mine= $this->getperson();
        
        $is_jt=0;
        if($mine['managerid']){
            
            
            $jt_where=['id'=>$mine['managerid'],'user_gid'=>3];
            $is_jt=db("manage_user")->where($jt_where)->count();
            
            if(!$is_jt){
                $arr=['case_manager'=>$mine['managerid']];
                $action='立即帮助';
            }else{
                $arr=[];
                $action='立即干预';
            }
            
        }else{
            $arr=['userid'=>$mine['id']];
            $action='立即咨询';
        }
       return $getarr=[
            'is_jt'=>$is_jt,
            'action'=>$action,
            'where'=>$arr,
           'mine'=>$mine
        ];
    }
    //验证该case是否属于该case_manager
    private function validate_manager($id){
            $mine= $this->getperson();
              $casemodel=new Cases;
              $caseid=$casemodel->where('id',$id)->value('case_manager');
//              print_r($caseid);
//              print_r($mine['managerid']);exit;
              if($mine['managerid']==$caseid){
                  return true;
              }else{
                  return false;
              }
              
    }
    //修改case状态
  public function update_status(){
       $casemodel=new Cases;
      $id=input('post.id');
      $status=input('post.status');

      if($this->validate_manager($id)){
        $case=CaseLogic::getInstance()->casesById($id);    
     
      if(!$status){
          $casemodel->where('id',$id)->setField(['case_manager'=>0,'case_status'=>1,'pended'=>1]);
           $data['msg']='确认成功';
          $data['url']=url("Phone/case_list");
      }else{
      
          $chatuser=ChatUserModel::getInstance();
                    
                    
                    
                      
                    $groupid=$case['groupid'];
                    $case_manager=$case['case_manager'];
                    
                    $managerdata=$chatuser->where(['managerid'=>$case_manager,'delete_time'=>0])->find();
                    $managerdata['case_code']=$case['case_code'];
                       //发送接收通知邮件
                    $email=new SendUser();
                    $email->acceptCase($managerdata);
                    
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
                      $group->saveAll($alldata);
          $casemodel->where('id',$id)->setField(['case_status'=>5]);
          $data['msg']='确认成功';
          $data['url']=url("Phone/case_content",['id'=>$id]);
      }
      
       }else{
           $data['msg']='这不是你的case';
          
       }
       
       return json($data);
  }
    //手机端case列表
    public function case_list(){
        
        
       $data= $this->getIdentity();
 
     //print_r($data);exit;
        $casemodel=new Cases;
  
        if($data['mine']['managerid']){
       
            if(!$data['is_jt']){
                $arr=[
                    'case_manager'=>$data['mine']['managerid'],
                    'delete_time'=>0
                        ];
            }else{
                $arr=[];
            }
           
            $case_list=$casemodel->getList($arr);  //获取case列表
        }else{
            $arr=[
                'userid'=>$data['mine']['id'],
                'delete_time'=>0
                    ];
             
            $case_list=$casemodel->getList($arr);  //获取case列表
        }
  
        $this->assign('action',$data['action']);
        $this->assign('is_jt',$data['is_jt']);
        $this->assign('is_manager',$data['mine']['managerid']);
        $this->assign('case_list',$case_list);
        $this->assign('userdata',$data['mine']);
        return $this->fetch();
    }
    
    
        //获取当前用户有多少个未读通知
    public function getNoRead()
    {
        $message=new Message;
        if(request()->isAjax()){

            $tips = $message->where('`uid`=' . session('f_user_id') . ' and `read`=1')->count();
            return json(['code' => 1, 'data' => $tips, 'msg' => 'success']);
        }
        $this->error('非法访问');
    }
    
    
    //邮件发送
   public function email(){
		
		//调用email接口方法
	    $emails = new \email\Cs();
		
		//为1请求发送邮件
		$to = $_POST['to'];
		
		//邮件主题
        $youxiangtitle="WebEx 会议邀请：text1";
	
		$YouxiangContent = "您好，<br/>webex meetuuu 邀请您加入以下 WebEx 会议。<br/><br/><strong>text1</strong><br/>2017年5月16日<br/>15:00  |  中国时间（北京，GMT+08:00）  |  2 小时<br/>会议号（访问码）： 182 325 056<br/>会议密码： 1234<br/>到时间后，".'<a href="https://meetuuu.webex.com.cn/meetuuu/j.php?MTID=mdafae37f1bc69b8290f5f5e3588278dd">请加入会议。</a>';
		$emailtrue = $emails->sentemail($to,$youxiangtitle,$YouxiangContent);
		
	}
        
        //退出
        public function logout(){
            
            
            cookie('phone_user_name', null);
            cookie('phone_user_id', null);
            cookie('phone_user_sign', null);
            cookie('phone_user_avatar', null);
            
            
            return json(['url'=>url('/service')]);
        }
        
        
        //发送短信
        public function sendMsg(){
            $data=input('post.data');
            $data=json_decode($data,true);
            
            $msg=new \message\mess();
            $content=ChatUserLogic::getInstance()->getLanguage($data['mess_content'], 4);
            $insert=[
                'content'=>$content['content'],
                'tel'=>$data['tel'],
                'user_id'=>$data['mess_content']['id'],
                'create_time'=>time()
            ];
            Db::name('cases_messlog')->insert($insert);
            if($data){
                $msg->send($data['tel'], $content['content']);
            }
      
        }
        

        
        
        public function updateLog($id){
            $perPage=21; //由于layim框架的显示问题，这里需要多一条数据，用户看到的是20条数据
            $cook_id= cookie('phone_user_id');
            //查询该用户是否可以查询该群组聊天记录
            $count=db('cases_groupdetail')->where(['user_id'=>$cook_id,'group_id'=>$id])->count();
           $chatlogs=[];
            if($count){
                
            
            $field = 'from_name username,to_id id,from_avatar avatar,timeline timestamp,content,type,from_id ';
            $result = db('cases_chatlog')->field($field)->where("to_id={$id} and type='group'")
                       ->order('timestamp desc')->limit($perPage)->select();
           $result = array_reverse($result); //反转
        
            foreach ($result as $key => $value) {
                if($value['from_id']==$cook_id){
                    $result[$key]['mine']=true;
                }else{
                    $result[$key]['mine']=false;
                }
                $result[$key]['timestamp']=$result[$key]['timestamp']*1000;
            }
                $this->assign('chatlogs', json_encode($result));
              }else{
                  $this->assign('chatlogs', json_encode($chatlogs));
              }
    
        }

        
        


}
