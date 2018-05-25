<?php
namespace app\laychatphone\controller;

use think\Controller;
use think\Db;
class Useryuyue extends Base{
    
    
    
   
    
    //个人中心我的预约
    public function index(){
        //登录用户名
        $uName=$_COOKIE['phone_user_name'];
        
     
        //查询出该用户的预约信息
        $useryuyueinfo = Db::table('nd_appointment_info')
        ->alias('a')
        ->join('nd_appointment_time_quantum t','a.time_qid = t.id')
        ->field("a.id,a.phone,a.iscase,a.email,a.advisory_details,a.submitdate,a.user_name,a.appointment_state,t.time_quantum")->where("user_name = '".$uName."'")->select();

        $this -> assign('useryuyueinfo',$useryuyueinfo);
        return $this->fetch();
    }
    
    //取消预约
    public function cancel(){
        $id = $_POST['id'];
        
        Db::table('nd_appointment_info')->where('id', '=',$id)->update(['appointment_state' => '4']);
        
        echo 1;
        //print_r($id);exit;
        
    }
    

}