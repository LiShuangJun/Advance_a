<?php
/**
 * author: NickBai
 * createTime: 2017/1/6 0006 下午 5:10
 */
return [

    //默认显示的用户分组
    'user_group' => [
        '1' => '朋友',
        '2' => '家人',
        '3' => '同事',
        '4' => '其他'
    ],


    //性别
    'sex' => [
        '1' => '男',
        '-1' => '女'
    ],

    //年龄
    'age' => [
        '0-18' => '18岁以下',
        '18-22' => '18-22岁',
        '23-26' => '23-26岁',
        '27-35' => '27-35岁',
        '35-120' => '35岁以上'
    ],

    //默认头像
    'avatar' => '/static/common/images/common.jpg',

    'app_debug' => false,
    // 开启应用Trace调试
    'app_trace' =>  false,
        // 视图输出字符串内容替换
    'view_replace_str'       => [
        '__CSS__' => '/static/laychat/admin/css',
        '__JS__' => '/static/laychat/admin/js',
        '__COMMON__' => '/static/laychat/common',
        '__PHONE__' => '/static/laychat/phone',
        '__YUYUE__' => '/static/laychat/phone/yuyue'
    ]

];