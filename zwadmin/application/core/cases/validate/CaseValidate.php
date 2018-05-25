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
        'province'=>'requireIf:country,1',
        'city'=>'requireIf:country,1',
        'district'=>'requireIf:country,1',
        'address' => 'require|max:200',
        'email'=>['require','regex'=>'^[a-z0-9]+([._\\-]*[a-z0-9])*@([a-z0-9]+[-a-z0-9]*[a-z0-9]+.){1,63}[a-z0-9]+$'],
        'illness'=>'require',
        'userid'=>'require',
        'sort'=>'number',
        'e_province'=>'max:50'

        
    ];

    /**
     * 提示
     *
     * @var unknown
     */
    protected $message = [
        'username.require' => 'The patient\'s name must be filled in',
        'username.regex'=>'The patient\'s name can only contain Chinese or English',
        'username.max'=>'The patient\'s name can not be longer than the length of 50',
        'birthday.require' => 'The date of birth can not be empty',
        'birthday.date' => 'The date of birth is not correct',
        'sex.require' => 'Gender must be selected',
        'relationship.requireIf'=>'The relationship with the patient must be filled in',
        'applicant_name.require' => 'Applicant\'s name must be filled in',
        'applicant_name.regex' => 'Applicant\'s name can only contain Chinese or English',
        'applicant_name.max' => 'Applicant\'s name can not exceed 50 long',
        'preferred_phone.require'=>'Preferred calls must be filled',
        'address.require' => 'The detail address can not be empty',
        'address.max' => 'Address length exceeds 200',
        'userid.require' => 'The user who submitted the case must choose',
        'country.require'=>'The state must choose',
        'e_province.max'=>'The name of the province exceeds the maximum length',
        'province.requireIf' => 'Provincial and municipal areas must choose',
        'city.requireIf' => 'Provincial and municipal areas must choose',
        'district.requireIf' => 'Provincial and municipal areas must choose',
        'email.require'=>'The mailbox needs to be filled',
        'email.regex'=>'E-mail format is incorrect',
        'illness.require' => 'The condition must be filled in',
        'sort.number'=>'Sort must fill in numbers'
        
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
            'country',
            'city',
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