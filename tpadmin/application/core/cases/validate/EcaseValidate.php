<?php
namespace core\cases\validate;

use core\Validate;

class EcaseValidate extends Validate
{

    /**
     * 规则
     *
     * @var unknown
     */
    protected $rule = [

        'username' =>['require','regex'=>'^[\x80-\xffa-zA-Z]+$','max'=>20],
        'birthday' => 'require|date',
        'sex' => 'require',
        'relationship'=>'requireIf:isme,0',
        'applicant_name' => ['require','regex'=>'^[\x80-\xffa-zA-Z]+$','max'=>20],
        'country'=>'require',
        'e_province'=>'max:50',
        'province'=>'requireIf:country,1',
        'city'=>'requireIf:country,1',
        'district'=>'requireIf:country,1',
        'address' => 'require|max:200',
        'preferred_phone'=>['requireIf:email,'.'','regex'=>'^((0\d{2,3}-\d{7,8})|(1[3584]\d{9}))$'],
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
        'username.require' => 'Patient\'s name must be filled in',
        'username.regex'=>'Patient name can only contain Chinese or English',
        'username.max'=>'The maximum patient name length can not exceed 20',
        'birthday.require' => 'Date of birth can not be empty',
        'birthday.date' => 'Date of birth is not in the correct format',
        'sex.require' => 'Sex must be chosen',
        'relationship.requireIf'=>'The relationship with the patient must be completed',
        'applicant_name.require' => 'Applicant\'s name must be completed',
        'applicant_name.regex' => 'Applicant\'s name can only include Chinese or English',
        'applicant_name.max' => 'The maximum length of the applicant name can not exceed 20',
        'preferred_phone.requireIf'=>'Preferred phone number must be filled in',
        'preferred_phone.regex'=>'Preferred phone format is incorrect',
        'address.require' => 'Detailed address can not be empty',
        'address.max' => 'Address length exceeds 200',
        'userid.require' => 'The user submitting the case must choose',
        'country.require'=>'The country must choose',
        'e_province.max'=>'Province (state) beyond length',
        'province.requireIf' => 'Provinces and municipalities have to choose',
        'city.requireIf' => 'Provinces and municipalities have to choose',
        'district.requireIf' => 'Provinces and municipalities have to choose',
        'email.requireIf'=>'E-mail required to fill in',
        'email.regex'=>'E-mail format is incorrect',
        'illness.require' => 'Condition description must be completed',
        'sort.number'=>'Sort must fill in the numbers'
        
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