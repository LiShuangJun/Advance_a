<?php
namespace core\manage\validate;

use core\Validate;

class EuserValidate extends Validate
{

    /**
     * 规则
     *
     * @var unknown
     */
    protected $rule = [
        'user_name' => 'require',
        'user_nick' => 'require',
        'user_passwd' => 'require',
        'user_passwd_confirm' => 'require|confirm:user_passwd',
        'user_gid' => 'require'
    ];

    /**
     * 提示
     *
     * @var unknown
     */
    protected $message = [
        'user_name.require' => 'User name is empty',
        'user_nick.require' => 'Nickname is empty',
        'user_passwd.require' => 'The password is blank',
        'user_passwd_confirm.require' => 'Confirm password is blank',
        'user_passwd_confirm.confirm' => 'The password is different twice',
        'user_gid.require' => 'Group ID can not be empty'
    ];

    /**
     * 场景
     *
     * @var unknown
     */
    protected $scene = [
        'login' => [
            'user_name',
            'user_passwd'
        ],
        'add' => [
            'user_name',
            'user_passwd',
            'user_passwd_confirm',
            'user_gid'
        ],
        'edit_info' => [
            'user_name',
            'user_nick',
            'user_gid'
        ],
        'edit_passwd' => [
            'user_name',
            'user_nick',
            'user_passwd',
            'user_passwd_confirm',
            'user_gid'
        ],
        'install' => [
            'user_name',
            'user_nick',
            'user_passwd',
            'user_passwd_confirm'
        ]
    ];
}