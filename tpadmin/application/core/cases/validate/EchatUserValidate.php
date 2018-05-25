<?php
namespace core\cases\validate;

use core\Validate;

class EchatUserValidate extends Validate
{

    /**
     * 规则
     *
     * @var unknown
     */
    protected $rule = [
        'user_name' => 'require',
        'nickname' => 'require',
        'pwd' => 'require',
        'pwd_again' => 'require|confirm:pwd',
        'tel' => 'require'
    ];

    /**
     * 提示
     *
     * @var unknown
     */
    protected $message = [
        'user_name.require' => 'User name is empty',
        'nickname.require' => 'Name is empty',
        'pwd.require' => 'The password is blank',
        'pwd_again.require' => 'Confirm password is blank',
        'pwd_again.confirm' => 'The password is different twice',
            'tel.require' => 'Phone number needs to be filled in'
    ];

    /**
     * 场景
     *
     * @var unknown
     */
    protected $scene = [
        
        'add' => [
            'user_name',
            'nickname',
            'pwd',
            'pwd_again',
            'tel'
        ],
        'edit_info' => [
            'user_name',
            'nickname',
            'tel'
        ],
        'edit_password'=>[
            'user_name',
            'nickname',
            'pwd',
            'pwd_again',
            'tel'
        ]

    ];
}