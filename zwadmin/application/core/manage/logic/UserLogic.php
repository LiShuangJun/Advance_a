<?php
namespace core\manage\logic;

use cms\Common;
use core\Logic;
use core\manage\model\UserModel;

class UserLogic extends Logic
{

    /**
     * 获取状态下拉
     *
     * @return array
     */
    public function getSelectStatus()
    {
        return [
            [
                'name' => '启用',
                'value' => 1
            ],
            [
                'name' => '禁用',
                'value' => 0
            ]
        ];
    }

    public function getSelectList($where=[])
    {
        $list = UserModel::getInstance()->where($where)->select();
        $users = [];
        foreach ($list as $vo) {
            $users[$vo['id']] = [
                'name' => $vo['user_name'] . '(' . $vo['user_nick'] . ')',
                'value' => $vo['id']
            ];
        }
       
        return $users;
    }

    /**
     * 是否超级管理员
     *
     * @param integer $userId            
     * @return boolean
     */
    public function isSuperAdmin($userId)
    {
        return $userId == 1;
    }

        /*
     * 该id帐号是否casemanager
     * 
     */
    public function isCm($id){
         $where=[
             'user_gid'=>config('am_casemanage'),
             'id'=>$id,
             'user_status'=>1
         ];
         $list = UserModel::getInstance()->where($where)->find();
         return $list;
    }
    /*
     * 该id帐号是否监听
     * 
     */
    public function isJT($id){
         $where=[
             'user_gid'=>config('am_jianting'),
             'id'=>$id,
             'user_status'=>1
         ];
         $list = UserModel::getInstance()->where($where)->find();
         return $list;
    }
     
    /**
     * 处理密码数据
     *
     * @param array $data            
     * @return array
     */
    public function processPasswdData($data)
    {
        // 加密密码
        isset($data['user_passwd']) && $data['user_passwd'] = $this->encryptPasswd($data['user_passwd']);
        
        // 移除重复密码
        unset($data['user_passwd_confirm']);
        
        return $data;
    }

    /**
     * 验证登录
     *
     * @param string $name            
     * @param string $passwd            
     * @return array($code, $msg, $user, $group)
     */
    public function checkLogin($name, $passwd)
    {
        $map = [
            'user_name' => $name,
            'user_passwd' => $this->encryptPasswd($passwd)
        ];
        $user = UserModel::getInstance()->where($map)->find();
        
        // 用户状态
        if (empty($user)) {
            return [
                - 1,
                '账号或者密码错误',
                null,
                null
            ];
        } elseif ($user['user_status'] == 0) {
            return [
                - 2,
                '未启用的账号',
                null,
                null
            ];
        } elseif ($user['user_status'] == - 1) {
            return [
                - 3,
                '该账号已经被禁用',
                null,
                null
            ];
        }
        
        // 群组状态
        $group = $user->group;
        if (empty($group)) {
            return [
                - 4,
                '尚未分配用户群组',
                null,
                null
            ];
        } elseif ($group['group_status'] == 0) {
            return [
                - 5,
                '用户所在群组被禁止登录',
                null,
                null
            ];
        }
        
        // 登录次数
        $this->addLoginRecord($user['id']);
        
        return [
            1,
            '登录成功',
            $user,
            $group
        ];
    }

    /**
     * 增加登录记录
     *
     * @param integer $userId            
     * @return boolean
     */
    public function addLoginRecord($userId)
    {
        // 登录日志
        UserLoginLogic::getSingleton()->addLogin($userId);
        
        $model = UserModel::getInstance();
        $common = Common::getSingleton();
        $map = [
            'id' => $userId
        ];
        $data = [
            'login_count' => [
                'exp',
                'login_count + 1'
            ],
            'login_time' => time(),
            'login_ip' => $common->getIp()
        ];
        return $model->save($data, $map);
    }

    /**
     * 加密密码
     *
     * @param string $passwd            
     * @return string
     */
    public function encryptPasswd($passwd)
    {
        return md5(gzcompress($passwd) . base64_decode($passwd));
    }
}