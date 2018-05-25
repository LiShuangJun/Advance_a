<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
return [
    '__pattern__' => [
        'name' => '\w+'
    ],
    
    // 主页
    'download' => 'index/index/download',
    
    // 博客
    'home' => 'blog/index/index',
    'cate/:name' => 'blog/index/cate',
    'article/:key' => 'blog/index/show',
    
    // 后台
    'module/:_module_/:_controller_/:_action_' => 'manage/loader/run',
    'casecommander'=>'manage/start/login',
    //AM聊天
    'service'=>'laychatphone/Login/index',
    
    //advance
    'am'=>'advance/Index/index',
    'services/:id'=>'advance/Index/service_details',
    'mobile_form/:id'=>'advance/Index/mobile_form',
    'loginApi'=>'medicalapi/User/Login',//获取个人信息接口
    'caseApi'=>'medicalapi/User/submitCase', //提交case接口
    'caseList'=>'medicalapi/User/getCaseList', //提交case接口
    'downloadArea'=>'advance/Download/downloadAreaList', //下载地址表
    'yuyueApi'=>'medicalapi/Appointment/submitYuyue', //提交预约信息接口
    
    
    //国内保险公司
    'allianzchina'=>'allianzchina/Index/index',
    'edm/:date/:lang/:page'=>'edm/Index/index'
];
