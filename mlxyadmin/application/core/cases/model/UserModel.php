<?php
namespace core\cases\model;

use core\Model;

class UserModel extends Model
{

    /**
     * 去前缀表名
     *
     * @var unknown
     */
    protected $name = 'manage_user';

    /**
     * 自动写入时间戳
     *
     * @var unknown
     */
    protected $autoWriteTimestamp = true;
/*
 * 定义别名变量
 */
   public $alias_name='a_manageruser';
    
    /**
     * 关联用户
     *
     * @return \think\model\relation\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(UserGroupModel::class, 'user_gid', 'id');
    }

    /**
     * 获取用户列表
     *
     * @return array
     */
    public function getUserList()
    {
        $list = $this->where(['delete_time'=>0])->select();
        $users = [];
        foreach ($list as $vo) {
            $users[$vo['id']] = [
                'name' => $vo['user_name'] . '(' . $vo['user_nick'] . ')',
                'value' => $vo['id']
            ];
        }
        return $users;
    }

}