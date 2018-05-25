<?php
return [
    // 根命名空间
    'root_namespace' => [
        'core' => APP_PATH . 'core',
        'module' => APP_PATH . 'module'
    ],
    
    // 禁止访问模块
    'deny_module_list' => [
        'common',
        'core',
        'module',
        'extra',
        'install',
        'laychatphone',
    ],
    
    'default_module' => 'advance',//默认模块	
    'default_controller' => 'Index', //默认控制器
    'default_action'         => 'service_details',            // 默认操作名
    'session' => [                //session设置  不同的模块设置不同的session
                    'prefix' => 'module',
                    'type' => '',
                    'auto_start' => true,
                    ],

];