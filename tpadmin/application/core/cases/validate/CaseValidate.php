<?php
namespace core\cases\validate;

use core\Validate;

class CaseValidate extends Validate
{

    /**
     * 规则
     *
     * @var unknown
     */
    protected $rule = [

        'username' =>['require','max'=>50],
        'birthday' => 'require|date',
        'sex' => 'require',
        'relationship'=>'requireIf:isme,0',
        'applicant_name' => ['require','max'=>50],
        'country'=>'require',
        'e_province'=>'max:50',
        'province'=>'requireIf:country,1',
        'city'=>'requireIf:country,1',
        'district'=>'requireIf:country,1',
        'address' => 'require|max:200',
        'preferred_phone'=>['requireIf:email,'.''],
        'email'=>['requireIf:preferred_phone,'.'','regex'=>'^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$'],
        'illness'=>'require',
        'userid'=>'require',
        'sort'=>'number'

        
    ];

    /**
     * 提示
     *
     * @var unknown
     */
    protected $message = [
        'username.require' => '患者姓名必须填写',
        'username.regex'=>'患者姓名只能包含中文或英文',
        'username.max'=>'患者姓名长度最多不能超过50',
        'birthday.require' => '出生日期不能为空',
        'birthday.date' => '出生日期格式不正确',
        'sex.require' => '性别必须选择',
        'relationship.requireIf'=>'与患者的关系必须填写',
        'applicant_name.require' => '申请人姓名必须填写',
        'applicant_name.regex' => '申请人姓名只能包含中文或英文',
        'applicant_name.max' => '申请人姓名长度最多不能超过50',
        'preferred_phone.requireIf'=>'首选电话必须填写',
        'preferred_phone.regex'=>'首选电话格式不正确',
        'address.require' => '详细地址不能为空',
        'address.max' => '地址长度超过200',
        'userid.require' => '提交case的用户必须选择',
        'country.require'=>'国家必须选择',
        'e_province.max'=>'省（州）超出长度',
        'province.requireIf' => '省市区必须选择',
        'city.requireIf' => '省市区必须选择',
        'district.requireIf' => '省市区必须选择',
        'email.requireIf'=>'邮箱需要填写',
        'email.regex'=>'邮箱格式不正确',
        'illness.require' => '病情描述必须填写',
        'sort.number'=>'排序必须填写数字'
        
    ];

    /**
     * 场景
     *
     * @var unknown
     */
    protected $scene = [
        'add' => [
            'username',
            'birthday',
            'sex',
            'applicant_name',
            'address',
            'preferred_phone',
            'userid',
            'country',
            'e_province',
            'city',
            'province',
            'district',
            'email',
            'illness',
            'isme',
            'relationship',
            'sort'
        ],
        'edit' => [
            'username',
            'birthday',
            'sex',
            'applicant_name',
            'address',
            'preferred_phone',
            'country',
            'city',
            'e_province',
            'province',
            'district',
            'email',
            'illness',
            'isme',
            'relationship',
            'sort'
        ]
    ];
}