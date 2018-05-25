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
use core\cases\validate\ChatUserValidate;
use core\cases\logic\ChatUserLogic;
use app\common\sendemail\SendUser;
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
        $this->siteTitle='advance|medical 登录';
 
         
        
        return $this->fetch();
    }

    //处理登录
    public function doLogin()
    {

        $chatuser=new ChatUserModel;
        if(request()->isAjax()){

            $userName = input('post.user_name');
            if(empty($userName)){
                return json(['code' => -3, 'data' => '', 'msg' => '用户名不能为空']);
            }

            $pwd = input('post.pwd');
            if(empty($pwd)){
                return json(['code' => -4, 'data' => '', 'msg' => '密码不能为空']);
            }
           $where=[
               'user_name'=>$userName,
               'u_status'=>1,
               'delete_time'=>0
           ];
 
            $user = $chatuser->field('id,user_name,pwd,sign,avatar,is_manager,company')
                ->where($where)->find();
           
            if(empty($user)){
                return json(['code' => -1, 'data' => '', 'msg' => '用户不存在']);
            }

            if( md5($pwd) != $user['pwd'] ){
                return json(['code' => -2, 'data' => '', 'msg' => '密码错误']);
            }
             //查询该用户是否有登录该pp的权限
             if($user['company']!=9){
                 return json(['code' => -2, 'data' => '', 'msg' => '您没有登录该网站的权限！']);
             }
            //设置用户登录
            $chatuser->where('id', $user['id'])->setField('status', 1);

            //设置session标识状态
            cookie('phone_user_name', $user['user_name'],1800);
            cookie('phone_user_id', $user['id'],1800);
            cookie('phone_user_sign', $user['sign'],1800);
            cookie('phone_user_avatar', $user['avatar'],1800);
            if(!empty(cookie('amback'))){
                $url= cookie('amback');
            }else{
                $url=url('/Allianz/EMO/En');
            }
            return json(['code' => 1, 'data' => $url, 'msg' => '登录成功']);
        }

        $this->error('非法访问');
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
                $url=url('/am');
            }

            $this->success('退出成功',$url,'',2);
    }
    
    
   /*
    * 注册接口
    */
    public function register_user(){
        if(request()->isPost()){
            
          if(session('registerdata')){   //判断存储数据
                     $savedata= json_decode(session('registerdata'),true);
                 }else{
                     echo json_encode(['code'=>0,'msg'=>'不允许提交未审核数据']);
                     exit;
                 }
        
        
         $data = [
                'user_name' => input('post.usernameTwo'),
                'pwd' => input('post.pwd'),
                'pwd_again'=>input('post.pwd_agnin'),
                'nickname' => $savedata['realname'],
                'company' => 9,
                'tel' => $savedata['mobile'],
                'email' => input('post.email'),
                 'idnumber'=> $savedata['cardId']
            ];
           if(input('post.sexM')!=1){
               $data['sex']=0;
           }else{
               $data['sex']=1;
           }
            if(empty($data['avatar'])){
                if($data['sex']){
                    $data['avatar']='/static/laychat/phone/img/moren.png';
                }else{
                    $data['avatar']='/static/laychat/phone/img/moren1.png';
                }
            }   
            $validate=new ChatUserValidate();
            $result=$validate->scene('uadd')->check($data);
            if(!$result){
                echo json_encode(['code'=>0,'msg'=>$validate->getError()]);
                
            }
            
            //检测手机号和用户名是否重复
            //检测用户名重复
            $where=[

               [
                   'where'=>['user_name'=>$data['user_name']],
                   'msg'=>'用户名已存在'
               ],
               [
                   'where'=>['tel'=>$data['tel']],
                   'msg'=>'手机号已存在'
               ]

            ];
            $this->UserOnly($where);
            $model = ChatUserModel::getInstance();
            //发送邮箱
            if($data['email']){
                $email=new SendUser();
                $email->addSend($data);
            }
            //加密密码
            $data['pwd']= md5($data['pwd']);
            unset($data['pwd_again']);
            $status = $model->save($data);
            
            if($data['tel']){
                $msg=new \message\mess();

                $msg->send($data['tel'], '【中德安联】[汇医]尊敬的客户，恭喜您注册成功，请妥善保管您的账号和密码，您可以通过点击以下链接在线提交全球医学专家意见服务申请。链接:http://allianzchina.advance-medical.com.cn/.');
            }
            echo json_encode(['code'=>1,'msg'=>'注册成功,账号密码将发送至您的邮箱和手机，请查收。']);
            exit;
      }else{
         
        
          
          return $this->fetch();
      }
    }
    /*
     * 验证用户唯一
     */
   
    protected function UserOnly($where=null){
       $logic =ChatUserLogic::getInstance();
       if(is_array($where)){
       foreach ($where as $key => $value) {
           $result=$logic->IsOnly($value['where']);
           
           if(!$result){
               echo json_encode(['code'=>0,'msg'=>$value['msg']]);
               exit;
           }
       }
      }


     }
    /*
     * 保险用户验证
     */
    public function valid_user(){
        
        $this->valid();
        
    }
    
    protected function valid() {
        $param=input('post.');
        $data=[];
        foreach ($param as $key => $value) {
            $data[]=$key.'='.$value;
        }
        $signture=$this->signature($data);
       
        echo json_encode(['code'=>1,'data'=>$signture]);
        exit;
    }
    //生成签名
    protected function signature($data) {
       
          
          $str=implode('&', $data);
          $signature= sha1($str.'3%qU8@C72N');
          
          
          return $signature;
    }
    
    /*
     * 审核通过后存储重要信息，以防前端漏洞跳过审核
     */
    public function savemsg() {
        $param=input('post.');
        
        if(is_array($param)){
            //检测身份证号唯一
            $where=[
               [
                   'where'=>['idnumber'=>$param['cardId']],
                   'msg'=>'该身份证号已被注册'
               ]

            ];
            $this->UserOnly($where);
            //签名校验数据的真实性
            $data=[
              'cardId='.$param['cardId'],
              'mobile='.$param['mobile'],
              'realname='.$param['realname']
            ];
            $signture=$this->signature($data);
            if($signture!=$param['signature']){
                 echo json_encode(['code'=>0,'msg'=>'非法操作']);
                 exit;
            }
             session('registerdata',json_encode($param));
             echo json_encode(['code'=>1,'msg'=>'存储成功']);
             exit;
        }else{
            echo json_encode(['code'=>0,'msg'=>'非法操作']);
            exit;
        }
       
       
    }
    
    //发送短信
    public function sendmess() {
        if(request()->isPost()){
            if(session('registerdata')){
                $savedata= json_decode(session('registerdata'),true);
            }else{
                echo json_encode(['code'=>0,'msg'=>'未获取手机号码']);
                exit;
            }
            $tel=$savedata['mobile'];
            $year = date("Y");
            $month = date("m");
            $day = date("d");
            $end= mktime(23,59,59,$month,$day,$year);//当天结束时间戳
 
            $code=rand(100000, 999999);
           
           if(session($tel.'num')){
                $numdata=json_decode(session($tel.'num'),true);
                if($numdata['maxtime']<time()){
                   $numdata=[
                    'num'=>0,
                    'maxtime'=>$end
                    ]; 
                }
            }else{
                $numdata=[
                    'num'=>0,
                    'maxtime'=>$end
                ];
            }
           
               if($numdata['num']<4||$numdata['maxtime']<time()){   //最大获取次数3次
                   $num=[
                        'num'=>$numdata['num']+1,
                        'maxtime'=>$end
                    ];
                   $codedata=[
                        'code'=>$code,
                        'maxtime'=>time()+1800
                    ];
                session($tel.'code', json_encode($codedata));
               
                session($tel.'num', json_encode($num));
                
                $msg=new \message\mess();

                $msg->send($tel, '【中德安联】[汇医]您正在注册中德安联│汇医官网 ，注册验证码为：'.$code.'，30分钟内有效');
                echo json_encode(['code'=>1,'msg'=>'发送成功']);
                exit; 
               }else{
                  echo json_encode(['code'=>0,'msg'=>'今日已达到最大次数']);
                  exit; 
               }
            
            
        }else{
            
            echo json_encode(['code'=>0,'msg'=>'提交方式错误']);
            exit;
        }
    }
    
    
    /*
     * 验证短信是否正确
     */
     public function validmess() {
         if(request()->isPost()){
             $code= input('post.code');
             if(session('registerdata')){
                 $savedata= json_decode(session('registerdata'),true);
             }else{
                 echo json_encode(['code'=>0,'msg'=>'请填写手机号码']);
                 exit;
             }
             
             $tel=$savedata['mobile'];
             if(session($tel.'code')){
                 $codedata=json_decode(session($tel.'code'),true);
                 if($codedata['maxtime']>time()){
                      if($code==$codedata['code']){
                          echo json_encode(['code'=>1,'msg'=>'验证码正确']);
                          exit;
                      }else{
                          echo json_encode(['code'=>0,'msg'=>'验证码错误']);
                          exit;
                      }
                 }else{
                     echo json_encode(['code'=>0,'msg'=>'验证码失效，请重新获取']);
                     exit;
                 }
             }
         }
     }
  
}
