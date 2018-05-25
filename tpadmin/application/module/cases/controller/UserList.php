<?php
namespace module\cases\controller;

use think\Request;
use think\Session;

use core\cases\model\ChatUserModel;
use core\cases\model\UserModel;
use core\manage\logic\UserLogic;
use core\cases\logic\ChatUserLogic;
use core\cases\logic\CaseTypeLogic;
use core\cases\logic\CompanyLogic;
use core\cases\validate\ChatUserValidate;
use app\common\sendemail\SendUser;

class UserList extends Base
{

    /**
     * 用户列表
     *
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {

        $this->siteTitle = '用户列表';
        //获取用户表别名
        $chatuser_alias=ChatUserModel::getInstance()->alias_name;
               // 用户列表
        $map = [
            $chatuser_alias.'.delete_time' => 0
        ];

        $this->assignUserList($map);
        return $this->fetch();
    }

/**
     * 赋值用户列表
     *
     * @param array $map
     *
     * @return void
     */
    protected function assignUserList($map)
    {
        $request = Request::instance();

                //获取用户表别名
        $chatuser_alias=ChatUserModel::getInstance()->alias_name;
        // 查询条件-关键词
        $keyword = $request->param('user_name');
        if ($keyword != '') {
            $map[$chatuser_alias.'.user_name'] = [
                'like',
                '%' . $keyword . '%'
            ];
        }
        $this->assign('keyword', $keyword);


        $map[$chatuser_alias.'.managerid']=0;
        $this->assign('wherelist', json_encode($map));
        // 分页列表
        $model = ChatUserModel::getInstance();
        $user_list=$model->getUserList($map);
       
        $this->_page($user_list);

        //查询case管理人员id字符串
//        $map=[
//            'user_gid'=> config('am_casemanage')
//        ];
//        $managestr = UserModel::where($map)->column('id');
//        $this->assign('managestr', implode(',',$managestr));
//        //查询监听人员id字符串
//           $map=[
//            'user_gid'=> config('am_jianting')
//        ];
//        $jiantingstr = UserModel::where($map)->column('id');
//        $this->assign('jiantingstr', implode(',',$jiantingstr));

          //用户状态
          $this->getUserStatus();
    }

    //导出excel用户表格
    public function exportUser(Request $request) {
        $map=$request->param('map');

        $map=json_decode($map,TRUE);

        ChatUserLogic::getInstance()->exportUser($map);
    }
    //导出excel用户表格
    public function importUser(Request $request) {
        if ($request->isPost()) {

            ChatUserLogic::getInstance()->importUser($request->param('options'));
            exit;
        }else{
           return $this->fetch();
        }
    }

       //获取性别数组
    protected function getSexList(){

         $logic =CaseTypeLogic::getInstance();
         $case_manager=$logic->getSelectSex();
         $this->assign('sexlist',$case_manager);
     }


     //验证唯一
    protected function UserOnly($where=null){
       $logic =ChatUserLogic::getInstance();
       if(is_array($where)){
       foreach ($where as $key => $value) {
           $result=$logic->IsOnly($value['where']);
           if(!$result){
               $this->error($value['msg']);
           }
       }
      }


     }
            //获取用户状态数组
    protected function getUserStatus(){

         $logic =ChatUserLogic::getInstance();
         $case_manager=$logic->getSelectStatus();
         $this->assign('userstatus',$case_manager);
     }
            //获取可用公司列表数组
    protected function assignCompanyList(){

         $logic =ChatUserLogic::getInstance();
         $where=[
             'status'=>1
         ];
         $company_list=$logic->getSelectCompany($where);
         $this->assign('company_list',$company_list);
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
            'sort',
            'u_status'
        ];
        $this->_modify(ChatUserModel::class, $fields);
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
                'user_name' => $request->param('user_name'),
                'pwd' => $request->param('pwd'),
                'pwd_again'=>$request->param('pwd_again'),
                'nickname' => $request->param('nickname'),
                'sex' => $request->param('sex'),
                'avatar' => $request->param('avatar'),
                'company' => $request->param('company'),
                'tel' => $request->param('tel'),
                'email' => $request->param('email'),
                'sort' => 0,
                'u_status' => $request->param('u_status'),
                'language'=>$request->param('language',1),
                'area'=>$request->param('area')

            ];
           
            if($data['avatar']==''){
                if($data['sex']){
                    $data['avatar']='/static/laychat/phone/img/moren.png';
                }else{
                    $data['avatar']='/static/laychat/phone/img/moren1.png';
                }
            }
            if($data['company']){
                $id=CompanyLogic::getInstance()->getTypeById($data['company']);
                $content=CompanyLogic::getInstance()->getMoreContent();
                foreach ($content[$id] as $key => $value) {
                    $data[$key]=$request->param($key);
                }
            }

           // 验证
            $this->_validate(ChatUserValidate::class, $data, 'add');
            //检测用户名重复
           $where=[

               [
                   'where'=>['user_name'=>$data['user_name']],
                   'msg'=>'用户名已存在'
               ],
               [
                   'where'=>['tel'=>$data['tel']],
                   'msg'=>'手机号已存在'
               ],
               [
                   'where'=>['email'=>$data['email']],
                   'msg'=>'邮箱已存在'
               ]

           ];
           $this->UserOnly($where);
           ;
           //发送邮箱
            $email=new SendUser();
            $email->addSend($data);
            // 添加
            $model = ChatUserModel::getInstance();
            //加密密码
            $data['pwd']= md5($data['pwd']);
            unset($data['pwd_again']);
            $status = $model->save($data);

            $this->success('新增成功', self::JUMP_REFERER);
        } else {
            $this->siteTitle = '新增用户';


           //性别
            $this->getSexList();

          //用户状态
          $this->getUserStatus();


          //公司列表
          $this->assignCompanyList();

         //获取更多内容

         $this->assign('companymore',$this->getCompanyMore());


         //获取语言列表
         $this->getLangList();
            return $this->fetch();
        }
    }
  /*
   * 获取语言列表
   */
  public function getLangList() {
      $list=ChatUserLogic::getInstance()->getLanguageList();
      $this->assign('languagelist', $list);

  }
    /*
     * 获取公司额外填写信息数组
     */
    public function getCompanyMore($data=null){
         return CompanyLogic::getInstance()->getMoreContent($data);
    }
       /**
     * 编辑case
     *
     * @param Request $request
     * @return mixed
     */
    public function edit(Request $request)
    {
        $userid=$this->_id();
        
        if ($request->isPost()) {
            $data = [
                'user_name' => $request->param('user_name'),
                'sex' => $request->param('sex'),
                 'nickname' => $request->param('nickname'),
                'avatar' => $request->param('avatar'),
                'company' => $request->param('company'),
                'tel' => $request->param('tel'),
                'email' => $request->param('email'),
                'sort' => $request->param('sort'),
                'u_status' => $request->param('u_status'),
                 'language'=>$request->param('language'),
                'area'=>$request->param('area')

            ];
            if($data['company']){
                $id=CompanyLogic::getInstance()->getTypeById($data['company']);
                $content=CompanyLogic::getInstance()->getMoreContent();
                foreach ($content[$id] as $key => $value) {
                    $data[$key]=$request->param($key);
                }
            }

           if(!$data['language']){
               $data['language']=ChatUserModel::getInstance()->where(['id'=>$userid])->value('language');
           }

            // 修改
           if($request->param('pwd')){
              $data['pwd']=$request->param('pwd');
              $data['pwd_again']=$request->param('pwd_again');
                 // 验证
            $this->_validate(ChatUserValidate::class, $data, 'edit_password');
             //发送邮箱
            $email=new SendUser();
            $email->editSend($data);

             //加密密码
            $data['pwd']= md5($data['pwd']);
            unset($data['pwd_again']);
          }else{
              // 验证
            $this->_validate(ChatUserValidate::class, $data, 'edit_info');
          }
          //检测用户名重复
           $where=[

               [
                   'where'=>[
                       'user_name'=>$data['user_name'],
                       'id'=>['neq',$userid]
                   ],
                   'msg'=>'用户名已存在'
               ],
               [
                   'where'=>[
                       'tel'=>$data['tel'],
                       'id'=>['neq',$userid]
                       ],
                   'msg'=>'手机号已存在'
               ],
               [
                   'where'=>[
                       'email'=>$data['email'],
                       'id'=>['neq',$userid]
                   ],
                   'msg'=>'邮箱已存在'
               ]

           ];
           $this->UserOnly($where);
            $model = ChatUserModel::getInstance();
            $map = [
            'id' => $userid
            ];
            $status = $model->save($data,$map);
            $this->success('修改成功', self::JUMP_REFERER);
        } else {
            $this->siteTitle = '编辑用户';

         $model = ChatUserModel::getInstance();
        $user_alias=$model->alias_name;
            $map=[
               $user_alias. '.id'=>$userid,
               $user_alias.'.managerid'=>0
            ];

        $user_list=$model->getUserList($map)->select();


        if($user_list){
            $this->assign('user_list', $user_list[0]);
        }else{
            $this->error(非法操作);
        }


                   //性别
            $this->getSexList();

          //用户状态
          $this->getUserStatus();

          //公司列表
          $this->assignCompanyList();

         //获取更多内容
          $this->assign('companymore',$this->getCompanyMore($user_list[0]));

            //获取语言列表
         $this->getLangList();
         return $this->fetch();

        }
    }

    
    /*
     * 重置密码
     */
    public function resetpwd(Request $request) {
        $id=$request->param('userid');
        $map=[
            'id'=>$id
        ];
        $users=ChatUserLogic::getInstance()->getUserlist($map,1);
        if(empty($users)){
             return json(['code'=>0,'msg'=>'该用户状态异常或者不存在']);
        }
        if(empty($users['email'])){
            return json(['code'=>0,'msg'=>'该用户邮件为空，请手动为他设置密码!']);
        }
        $pwd=rand(100000,999999);
        $users['pwd']=$pwd;
        //发送邮箱
            $email=new SendUser();
         $email->editSend($users);
        $data=[
            'pwd'=>md5($pwd)
        ];
        
        $result=ChatUserModel::getInstance()->save($data,$map);
        if($result){
            
            return json(['code'=>1,'msg'=>'重置成功!密码已发送至用户邮箱']);
        }
       
    }
        /**
     * 删除case
     *
     * @param Request $request
     * @return mixed
     */
    public function delete(Request $request)
    {
        $this->_delete(ChatUserModel::class, true);
    }

}