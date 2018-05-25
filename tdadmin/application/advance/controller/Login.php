<?php
// +----------------------------------------------------------------------
// | ichat-v3.0
// +----------------------------------------------------------------------
// | Author: NickBai <1902822973@qq.com>
// +----------------------------------------------------------------------
namespace app\advance\controller;


use think\Config;
use cms\Controller;
use cms\Response;
use core\cases\model\ChatUserModel;
use app\manage\service\ViewService;
use app\common\App;
class Login extends Controller
{
    
        /**
     * 网站标题
     *
     * @var unknown
     */
    protected $siteTitle;
    
    //展示登录页面
    public function index()
    {
        $this->siteTitle='advance|medical Login';
 
         
        
        return $this->fetch();
    }

    //处理登录
    public function doLogin()
    {

        $chatuser=new ChatUserModel;
        if(request()->isAjax()){

            $userName = input('post.user_name');
            if(empty($userName)){
                return json(['code' => -3, 'data' => '', 'msg' => 'Username cannot be empty']);
            }

            $pwd = input('post.pwd');
            if(empty($pwd)){
                return json(['code' => -4, 'data' => '', 'msg' => 'Password cannot be empty']);
            }
           $where=[
               'user_name'=>$userName,
               'u_status'=>1
           ];
            $user = $chatuser->field('id,user_name,pwd,sign,avatar,is_manager')
                ->where($where)->find();
            if(empty($user)){
                return json(['code' => -1, 'data' => '', 'msg' => 'user does not exist']);
            }

            if( md5($pwd) != $user['pwd'] ){
                return json(['code' => -2, 'data' => '', 'msg' => 'Password error']);
            }

            //设置用户登录
            $chatuser->where('id', $user['id'])->setField('status', 1);

            //设置session标识状态
            cookie('phone_user_name', $user['user_name'],1800);
            cookie('phone_user_id', $user['id'],1800);
            cookie('phone_user_sign', $user['sign'],1800);
            cookie('phone_user_avatar', $user['avatar'],1800);
            if(!empty(cookie('amback'))){
                if(!empty(cookie('mobile_login'))){
                    $url= cookie('mobile_login');
                }else{
                   $url= cookie('amback'); 
                }
                
            }else{
                $url=url('/Allianz');
            }
            return json(['code' => 1, 'data' => $url, 'msg' => 'Log in successful']);
        }

        $this->error('Illegal access');
    }
    
           /**
     *
     * {@inheritdoc}
     *
     * @see Controller::beforeViewRender()
     */
    protected function beforeViewRender()
    {
        // 网站标题
        $this->assign('site_title', $this->siteTitle);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see Controller::getView()
     */
    protected function getView()
    {
        return ViewService::getSingleton()->getView();
    }
    
       //退出
    public function logout() {
        cookie('phone_user_id', null);
        cookie('phone_user_name', null);
        cookie('phone_user_sign', null);
        cookie('phone_user_avatar', null);
        if(!empty(cookie('amback'))){
                $url= cookie('amback');
            }else{
                $url=url('/Allianz');
            }

            $this->success('Quit successfully',$url,'',2);
    }
}
