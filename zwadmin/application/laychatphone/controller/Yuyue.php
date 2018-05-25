<?php
namespace app\laychatphone\controller;

use think\Controller;
use think\Db;
use core\cases\logic\ChatUserLogic;
use core\cases\model\ChatUserModel;
use app\common\sendemail\SendUser;
class Yuyue extends Base
{
    //判断用户身份
    public function ismanager(){
        $userid =$_COOKIE['phone_user_id'];
        $chatuser= ChatUserModel::getInstance()->alias_name;//chatuser表别名
        $where=[
            
            $chatuser.'.id'=>$userid
            
        ];
        $cmlist=ChatUserLogic::getInstance()->getCasemanager($where)->find();
        if(empty($cmlist)){
            $result=1;   //是
        }else{
            $result=0;
        }
        return $result;
        
        
    }
    
    
    //加载预约页面
    public function index(){

        $result=$this->ismanager();
        if($result){
            //查询出预约时间段
            $start_times = Db::table('nd_appointment_time_quantum')->select();
            $this -> assign('starttimes',$start_times);
            
            return $this->fetch();
            
        }else{
            
            //登录用户名
            $uName=$_COOKIE['phone_user_name'];
                      
            //查找医生的预约信息         
            $info = Db::table('nd_appointment_info')
            ->alias('a')
            ->join('nd_appointment_time_quantum t','a.time_qid = t.id')
            ->join('nd_appointment_zocdoc z','a.id = z.yuyueinfo_id')
            ->field("a.id as yuyueinfoid,z.id as doctorid,a.submitdate,a.user_name,a.appointment_state,t.time_quantum,a.iscase")
            ->where("z.doctorname = '".$uName."' and a.appointment_state != 4")
            ->select();
            
            //print_r($info);exit;
         
            $this -> assign("info",$info);

            return $this->fetch('Doctoryuyue/index');
        }
    }
    
    
    public function creatingmeeting($yuyueinfoid,$doctorid){
        
      
        //获取用户提交预约信息
        $yuyueinfo =  Db::table('nd_appointment_info')->where('id = '.$yuyueinfoid)->select();
       
        //预约时间段
        $time_quantumselect =  Db::table('nd_appointment_time_quantum')->where('id = '.$yuyueinfo[0]['time_qid'])->select();
        $time_quantum = $time_quantumselect[0]['time_quantum'];
        
        
        $time =strtotime($yuyueinfo[0]['submitdate'].' '.$time_quantum);
        $times = date('m/d/Y H:i:s',$time);
        //预约日期
        $submitdate = $yuyueinfo[0]['submitdate'];
        
   
        
        
        
        
      
        //添加会议，获取会议信息
        //对url的xml参数进行culr获取
        function curlxml($strxml){
            
            //对url的xml参数进行加密
            $urlencode_strxml = urlencode("$strxml");
            
            $curlobj = curl_init();			// 初始化
            curl_setopt($curlobj, CURLOPT_URL, "https://meetuuu.webex.com.cn/WBXService/xml8.0.0/XMLService?XML=".$urlencode_strxml);		// 设置访问网页的URL
            curl_setopt($curlobj, CURLOPT_RETURNTRANSFER, true);			// 执行之后不直接打印出来
            
            // 设置HTTPS支持
            date_default_timezone_set('PRC'); // 使用Cookie时，必须先设置时区
            curl_setopt($curlobj, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查从证书中检查SSL加密算法是否存在
            curl_setopt($curlobj, CURLOPT_SSL_VERIFYHOST, 2);
            
            $output=curl_exec($curlobj);	// 执行
            curl_close($curlobj);			// 关闭cURL
            //echo $output;
            $outputs = str_replace(":","",$output);
            
            $ob= simplexml_load_string($outputs);//将字符串转化为变量
            $json = json_encode($ob);//将对象转化为JSON格式的字符串
            $configData = json_decode($json, true);//将JSON格式的字符串转化为数组
            return $configData;
            //print_r($configData);
            
        }
        
        
        //创建会议
        //会议主题
        $Meeting_Topic = "advance-medical预约会议";
        //会议密码
        $meetingPassword = 123456;
        $CreateMeeting = <<<Eof
<?xml version="1.0" encoding="UTF-8"?><serv:message xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><header><securityContext><siteName>advance-medical</siteName><webExID>zhaojing@advance-medical.com.cn</webExID><password>1314Maggie</password></securityContext></header><body><bodyContent xsi:type="java:com.webex.service.binding.meeting.CreateMeeting"><accessControl><meetingPassword>$meetingPassword</meetingPassword></accessControl><metaData><confName>Sample Meeting</confName><agenda>$Meeting_Topic</agenda></metaData><schedule><startDate>$times</startDate><duration>20</duration></schedule></bodyContent></body></serv:message>
Eof;
        
        
        
      
        
        $CreateMeeting_array = curlxml($CreateMeeting);
        
        $meetmeetingkey = $CreateMeeting_array['servbody']['servbodyContent']['meetmeetingkey'];
        
        $data['meetmeetingkey'] = $meetmeetingkey;
        
    
        //获得主持人开会地址
        $GethosturlMeeting = <<<Eof
<?xml version="1.0" encoding="UTF-8"?><serv:message xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><header><securityContext><siteName>advance-medical</siteName><webExID>zhaojing@advance-medical.com.cn</webExID><password>1314Maggie</password></securityContext></header><body><bodyContent xsi:type="java:com.webex.service.binding.meeting.GethosturlMeeting"><meetingKey>$meetmeetingkey</meetingKey></bodyContent></body></serv:message>
Eof;
        
        $GethosturlMeeting_array = curlxml($GethosturlMeeting);
       
        $hostMeetingURL = $GethosturlMeeting_array['servbody']['servbodyContent']['meethostMeetingURL'];
        
        $hostMeetingURLs = str_replace("https//advance-medical.webex.com.cn/","https://advance-medical.webex.com.cn/",$hostMeetingURL);
        //echo $hostMeetingURLs;
        $data['hostmeetingurl'] = $hostMeetingURLs;
        
    
        
        //获得加会地址
        $GetjoinurlMeeting = <<<Eof
<?xml version="1.0" encoding="UTF-8"?><serv:message xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"><header><securityContext><siteName>advance-medical</siteName><webExID>zhaojing@advance-medical.com.cn</webExID><password>1314Maggie</password></securityContext></header><body><bodyContent xsi:type="java:com.webex.service.binding.meeting.GetjoinurlMeeting"><meetingKey>$meetmeetingkey</meetingKey></bodyContent></body></serv:message>
Eof;
        
        $GetjoinurlMeeting_array = curlxml($GetjoinurlMeeting);
        
        $joinMeetingURL = $GetjoinurlMeeting_array['servbody']['servbodyContent']['meetjoinMeetingURL'];
        
        $joinMeetingURLs = str_replace("https//advance-medical.webex.com.cn/","https://advance-medical.webex.com.cn/",$joinMeetingURL);
        //echo $joinMeetingURLs;
        $data['joinmeetingurl'] = $joinMeetingURLs;

        $data['yuyueinfoid'] = $yuyueinfoid;
        $data['doctorid'] = $doctorid;
        Db::table('nd_appointment_meeting')->insert($data);
        
        //修改预约状态
        Db::table('nd_appointment_info')->where('id', $yuyueinfoid)->update(['appointment_state' => 2]);
        
        Db::table('nd_appointment_zocdoc')->where('id', $doctorid)->update(['yuyue_state' => 2]);


        //邮件
        $email = new SendUser();
        //开会人
        $GetjoinurlMeeting_Theme = "advance-medical预约会议邀请:".$yuyueinfo[0]['user_name'];
        $GetjoinurlMeeting_Body = "您好，<br/>advance-medical 邀请您加入以下预约会议。<br/><br/><strong>$Meeting_Topic</strong><br/>$submitdate<br/>$time_quantum | 中国时间（北京，GMT+08:00） | 2 小时<br/>会议密码： $meetingPassword<br/>".'<a href="'.$joinMeetingURLs.'">到时间后，请加入会议。</a>';
        $email -> yuyueemail(1,$GetjoinurlMeeting_Theme,$GetjoinurlMeeting_Body,'jiang.wang@meetuuu.com');
        
    
        
        //主持人
        $GethosturlMeeting_Theme = "advance-medical预约会议邀请:".$yuyueinfo[0]['user_name'];
        $GethosturlMeeting_Body = "您好，<br/>advance-medical 邀请您主持以下预约会议。<br/><br/><strong>$Meeting_Topic</strong><br/>$submitdate<br/>$time_quantum | 中国时间（北京，GMT+08:00） | 2 小时<br/>会议密码： $meetingPassword<br/>".'<a href="'.$hostMeetingURLs.'">到时间后，请主持会议。</a>';
        $email -> yuyueemail(1,$GethosturlMeeting_Theme,$GethosturlMeeting_Body,'j.wang@meetuuu.com');
        
       
       
        
    }
    
    
    public function addyuyue(){
        

        $yuyueinfoid = $_POST['yuyueinfoid'];
        $data['yuyueinfoid'] = $yuyueinfoid;

        $doctorid = $_POST['doctorid'];
        $data['doctorid'] = $doctorid;
        
        $a = $this->creatingmeeting($yuyueinfoid,$doctorid);
        print_r($a);exit;
       
      
        echo 1;   
      
    }
    
   
    
    
    
    //取消预约
    public function cancel(){
        $id = $_POST['id'];
        
        Db::table('nd_appointment_info')->where('id', '=',$id)->update(['appointment_state' => '4']);
        
        echo 1;
        //print_r($id);exit;
        
    }
    
    //获取预约信息
    public function yuyueinfo(){
        
        //联系电话
        $phone = $_POST['phone'];
        $data['phone'] = $phone;
        
        //邮箱
        $email = $_POST['email'];
        $data['email'] = $email;
        
        //咨询内容简介
        $advisory_details = $_POST['advisory_details'];
        $data['advisory_details'] = $advisory_details;
        
        //预约时间
        $time_quantumid = $_POST['time_quantumid'];
        $data['time_qid'] = $time_quantumid;
        
        $submitdate = $_POST['submitdate'];
      

        $year = str_replace("年","-",$submitdate);
        $month = str_replace("月","-",$year);
        $day = str_replace("日","",$month);
        $submitdates =  preg_replace('/[ ]/', '', $day);

        $data['submitdate'] = $submitdates;
        
        $uName=$_COOKIE['phone_user_name'];
        
       
        //用户名
        $data['user_name'] = $uName;
        
        //预约状态
        $data['appointment_state'] = 1;
        
        //是否关联case
        $data['iscase'] = 2;
        
        
        //用户预约时间
        
        //添加预约信息到数据库
        Db::table('nd_appointment_info')->insert($data);
        
       /*  $start_time = Db::table('nd_appointment_time_quantum')->where('id ='.$time_quantumid)->select(); 
        $start_time['0']['time_quantum'];
        print_r($start_time['0']['time_quantum']); */
        //print_r($submitdate);
        echo 1;
        exit;
    }
    
}