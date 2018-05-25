<?php
// +----------------------------------------------------------------------
// | ichat-v3.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\laychatphone\controller;

use think\Controller;
use core\Model;
use app\manage\service\LoginService;
use app\laychatphone\model\ChatUser;
class Base extends Controller
{
    public function _initialize()
    {
        
            $login = LoginService::getSingleton();   
            $loginUser = $login->getLoginUser();
            if(!empty($loginUser)){   //是否已经登录后台
               
                        // 管理员ID
                     $ma_id = $loginUser['user_id'];
                     $chatuser=new ChatUser;
                  $userdata = $chatuser->where('managerid', $ma_id)->find();
                  if(!empty($userdata)){

                                  //设置session标识状态
                        cookie('phone_user_name', $userdata['user_name']);
                        cookie('phone_user_id', $userdata['id']);
                        cookie('phone_user_sign', $userdata['sign']);
                        cookie('phone_user_avatar', $userdata['avatar']);
                  }else{
                if(!cookie('phone_user_id')){
                    $this->redirect(url('/service'));
                }
                }
            }else{
                if(!cookie('phone_user_id')){
                    $this->redirect(url('/service'));
                }
                }
            
        
    }
    
    
}
