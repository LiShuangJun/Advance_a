<?php
namespace module\ecases\controller;

use think\Controller;
use think\Db;
use core\cases\model\ChatUserModel;
use core\manage\model\UserModel;
use core\cases\logic\ChatUserLogic;
use think\Config;
use think\Request;
use app\common\sendemail\SendUser;
class Yuyue extends Base{
    
    public function index(){
        
        //查询出用户提交预约信息
        $info = Db::table('nd_appointment_info')
        ->alias('a')
        ->join('nd_appointment_time_quantum t','a.time_qid = t.id')
        ->field("a.id,a.phone,a.email,a.advisory_details,a.submitdate,a.user_name,a.appointment_state,t.time_quantum")->select();
       
        $this -> assign('info',$info); 
        
        return $this->fetch();
    }
    
    
    //修改
    public function edit(){
        //获取修改id 
        $id = $this->_id();
      
        //根据id查询出用户预约信息
        $yuyue_list = Db::table('nd_appointment_info')
        ->where('id','=',$id)
        ->select(); 
        
        //查找出
        $time_quantum = Db::table('nd_appointment_time_quantum')
        ->where('id','=',$yuyue_list[0]['time_qid'])
        ->select(); 
        //print_r($time_quantum);exit;
        
        //预约时间段
        $this -> assign('time_quantum',$time_quantum);
        
        //预约详情信息
        $this->assign('yuyue_list', $yuyue_list);
 
        return $this->fetch();
    }
    
    
    //取消预约 cancel
    public function cancel(){
        
        //获取修改id
        $id = $this->_id();
        
        Db::table('nd_appointment_info')->where('id', '=',$id)->update(['appointment_state' => '4']);
        
        $this->success('已取消当前预约',self::JUMP_REFRESH);
    }
    
    
    
       
    
    //指定医生
    public function doctor(){
        $request = Request::instance();
        $yuyueinfoid = $request->param('id');
        
        $zocdoc_info = Db::table('nd_appointment_zocdoc')->find();
        
        $zocdoc_state = $zocdoc_info['yuyue_state'];

   
        //查询医生
        $list=ChatUserLogic::getInstance()->getCasemanager();
     
        //预约id
        $this -> assign('yuyueinfoid',$yuyueinfoid);
        
        //指定医生信息状态
        $this -> assign("zocdoc_state",$zocdoc_state);
        
        $this->wjpage($list);
    
        return $this -> fetch();
    }
    
    
    //创建会议发送医生和用户邮件
    public function doctormeeting(){
        
        $request = Request::instance();
        
   
        //添加预约医生表
            $yuyueinfoid = $request->param('yuyueid');
        $data['yuyueinfo_id'] = $yuyueinfoid;
        $doctorname  = $request->param('username');
        $data['doctorname'] = $doctorname;
        //查询医生邮箱
        $docid = $request->param('id');
        $data['yuyue_state'] = 5;
        $data['doctorid']=$docid;
        Db::table('nd_appointment_zocdoc')->insert($data);
        
         //查询医生
        $useralias=ChatUserModel::getInstance()->alias_name; //用户表别名
        $map=[
            $useralias.'.id'=>$docid
        ];
        $docdata=ChatUserLogic::getInstance()->getCasemanager($map)->find();
        //查找会议信息
        $yuyueinfo = Db::table('nd_appointment_info')->where('id',$yuyueinfoid)->select();
        
        //预约时间段
        $time_quantumselect =  Db::table('nd_appointment_time_quantum')->where('id = '.$yuyueinfo[0]['time_qid'])->select();
        $time_quantum = $time_quantumselect[0]['time_quantum'];
        $submitdate = $yuyueinfo[0]['submitdate'];
    
    
        
        //邮件
        $email = new SendUser();
   
        //主持人
        $GethosturlMeeting_Theme = "advance-medical预约会议邀请:".$docdata['user_name'];
      
        $GethosturlMeeting_Body = "您好，<br/>advance-medical 邀请您主持以下预约会议,请在个人中心确认。<br/><br/>会议时间： $submitdate $time_quantum <br/>请及时在个人中心确认该预约!!!";

        $email -> yuyueemail($docdata['email'],$GethosturlMeeting_Theme,$GethosturlMeeting_Body);
       
        $this->success('指定医生成功!!!', self::JUMP_REFERER);
        
    }
  
    
    /**
     * 分页列表
     *
     * @param Model $model
     * @param integer $rowNum
     * @param Closure $perform
     * @return void
     */
    protected function wjpage($model, $rowNum = null, \Closure $perform = null)
    {
        $rowNum || $rowNum = Config::get('manage_row_num');
        $rowNum || $rowNum = 10;
        
        $model = $this->buildModel($model);
        
        $list = $model->paginate($rowNum);
        $perform && $perform($list);
        
        //print_r($list);exit;
        $this->assign('_list', $list);
        $this->assign('_page', $list->render());
        $this->assign('_total', $list->total());
    }

}
?>