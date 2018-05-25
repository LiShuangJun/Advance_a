<?php
namespace app\manage\controller;

use think\Request;
use core\manage\logic\UserLogic;
use core\manage\model\UserModel;
use core\manage\validate\UserValidate;
use core\manage\logic\UserGroupLogic;
use core\cases\logic\ChatUserLogic;
use core\cases\model\ChatUserModel;
class User extends Base
{

    /**
     * 用户列表
     *
     * @param Request $request            
     * @return string
     */
    public function index(Request $request)
    {
        $this->siteTitle = '用户管理';
        
        // 分页列表
        $list = UserModel::getInstance()->where(['id'=>['neq',1],'delete_time'=>0])->select();
        foreach ($list as $key => $value) {
            if($value['user_gid']==config('am_casemanage')||$value['user_gid']==config('am_jianting')){
                $ishave=$this->ishave(['managerid'=>$value['id']]);
                if($ishave){
                    $list[$key]['im_menu']='add';
                }else{
                    $list[$key]['im_menu']='edit';
                }
            }else{
                $list[$key]['im_menu']='';
            }
            
        }
       
        $this->_list($list);
        
        // 用户群组下拉
        $this->assignSelectUserGroup();
        
        // 用户状态下拉
        $this->assignSelectUserStatus();
        
        

        
        return $this->fetch();
    }
    
    /*
     * 判断用户是否开通layim帐号
     * 
     */
    protected function ishave($where) {
        $logic =ChatUserLogic::getInstance();
        $result=$logic->IsOnly($where);
        return $result;
    }
 
    /**
     * 添加用户
     *
     * @param Request $request            
     * @return string|void
     */
    public function add(Request $request)
    {
        if ($request->isPost()) {
            $data = [
                'user_name' => $request->param('user_name'),
                'user_nick' => $request->param('user_nick'),
                'user_passwd' => $request->param('user_passwd'),
                'user_passwd_confirm' => $request->param('user_passwd_confirm'),
                'user_gid' => $request->param('user_gid'),
                'user_status' => $request->param('user_status', 0)
            ];
            
            // 验证
            $this->_validate(UserValidate::class, $data, 'add');
            
            // 密码
            $logic = UserLogic::getSingleton();
            $data = $logic->processPasswdData($data);
            
            // 添加
            $this->_add(UserModel::class, $data);
        } else {
            $this->siteTitle = '新增用户';
            
            // 用户群组下拉
            $this->assignSelectUserGroup();
            
            // 用户状态下拉
            $this->assignSelectUserStatus();
            
            return $this->fetch();
        }
    }

    /**
     * 编辑用户
     *
     * @param Request $request            
     * @return string|void
     */
    public function edit(Request $request)
    {
        if ($request->isPost()) {
            $data = [
                'user_name' => $request->param('user_name'),
                'user_nick' => $request->param('user_nick'),
                'user_passwd' => $request->param('user_passwd'),
                'user_passwd_confirm' => $request->param('user_passwd_confirm'),
                'user_gid' => $request->param('user_gid'),
                'user_status' => $request->param('user_status', 0)
            ];
            
            // 验证
            $scene = empty($data['user_passwd']) ? 'edit_info' : 'edit_passwd';
            $this->_validate(UserValidate::class, $data, $scene);
            
            // 密码
            $logic = UserLogic::getSingleton();
            $data = $logic->processPasswdData($data);
            
            // 修改
            $this->_edit(UserModel::class, $data);
        } else {
            $this->siteTitle = '编辑用户';
            
            // 记录
            $this->_record(UserModel::class);
            
            // 用户群组下拉
            $this->assignSelectUserGroup();
            
            // 用户状态下拉
            $this->assignSelectUserStatus();
            
            return $this->fetch();
        }
    }

    /**
     * 更改用户
     *
     * @return void
     */
    public function modify()
    {
        $fields = [
            'user_gid',
            'user_status'
        ];
        $this->_modify(UserModel::class, $fields);
    }

    /**
     * 删除用户
     *
     * @return void
     */
    public function delete()
    {
        $userId = $this->_id();
        if (UserLogic::getInstance()->isSuperAdmin($userId)) {
            $this->error('超级管理员不能被删除');
        } elseif ($this->userId == $userId) {
            $this->error('自己不能删除自己');
        }
       
        
        $this->_delete(UserModel::class, true);
    }

    /**
     * 赋值用户群组下拉
     *
     * @return void
     */
    protected function assignSelectUserGroup()
    {
        $selectUSerGroup = UserGroupLogic::getSingleton()->getSelectList();
        $this->assign('select_user_group', $selectUSerGroup);
    }

    /**
     * 赋值用户状态下拉
     *
     * @return void
     */
    protected function assignSelectUserStatus()
    {
        $selectUserStatus = UserLogic::getSingleton()->getSelectStatus();
        $this->assign('select_user_status', $selectUserStatus);
    }
}