<?php
namespace app\laychatphone\controller;

use think\Controller;


class Doctoryuyue extends Base{
    
    public function index(){
        //登录用户名
        $uName=$_COOKIE['phone_user_name'];
        
        print_r($uName);exit;
        return $this->fetch();
    }
}