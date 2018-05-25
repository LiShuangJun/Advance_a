<?php
use \GatewayWorker\Lib\Gateway;
use \GatewayWorker\Lib\Db;

/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{
    /**
     * 当客户端发来消息时触发
     * @param int $client_id 连接id
     * @param mixed $message 具体消息
     */
    public static function onMessage($client_id, $data)
    {
        
     
        $message = json_decode($data, true);
        $message_type = $message['type'];
        switch ($message_type) {
            case 'init':
                // uid
                $uid = $message['id'];
                // 设置session
                $_SESSION = array(
                    'username' => $message['username'],
                    'avatar' => $message['avatar'],
                    'id' => $uid,
                    'sign' => $message['sign'],
                    'servername' =>$message['servername'],
                    'groupid'=>$message['groupid']
                );
               
                // 将当前链接与uid绑定
                Gateway::bindUid($client_id, $uid);
            
                $db1 = Db::instance('db1');  //数据库链接
            // 查询当前用户身份，若为casemanager上线则消除相应群组内的自动回复消息响应
            $ismanager = $db1->query("select vc.* from `nd_cases_chatuser` as vc 
                                                        inner join  nd_manage_user as ta 
                                                        on ta.id=vc.managerid
                                                        where ta.user_gid=2 and vc.id={$uid} and ta.delete_time=0 and vc.u_status=1");
            if(!empty($ismanager)){
                
                $db1->query("UPDATE `nd_cases_auto` SET `status` = '0' WHERE groupid=" . $message['groupid']." and userid=".$uid);
            }
                //查询最近1周有无需要推送的离线信息
                $time = time() - 7 * 3600 * 24;
                $resMsg = $db1->select('id,from_id,from_name,from_avatar,timeline,content')->from('nd_cases_chatlog')
                    ->where("to_id= {$uid} and timeline > {$time} and type = 'friend' and need_send = 1" )
                    ->query();
                if (!empty($resMsg)) {

                    foreach ($resMsg as $key => $vo) {

                        $log_message = [
                            'message_type' => 'logMessage',
                            'data' => [
                                'username' => $vo['from_name'],
                                'avatar' => $vo['from_avatar'],
                                'id' => $vo['from_id'],
                                'type' => 'friend',
                                'content' => htmlspecialchars($vo['content']),
                                'timestamp' => $vo['timeline'] * 1000,
                            ]
                        ];

                        Gateway::sendToUid($uid, json_encode($log_message));
            
                        //设置推送状态为已经推送
                        $db1->query("UPDATE `nd_cases_chatlog` SET `need_send` = '0' WHERE id=" . $vo['id']);
                        
                        
                        
                       
                    }
                }
                
        
                 //群离线消息推送
//                        $groupMsg = $db1->select('id,from_id,from_name,from_avatar,timeline,content,to_id')->from('v3_chatlog')
//                    ->where(" from_id= {$uid} and timeline > {$time} and type = 'group' " )
//                    ->query();
//                  //  print_r($groupMsg);exit;
//             if (!empty($groupMsg)) {
//
//                    foreach ($groupMsg as $key => $vo) {
//
//                        $log_message = [
//                            'message_type' => 'logMessage',
//                            'data' => [
//                                'username' => $vo['from_name'],
//                                'avatar' => $vo['from_avatar'],
//                                'id' => $vo['from_id'],
//                                'type' => 'group',
//                                'content' => htmlspecialchars($vo['content']),
//                                'timestamp' => $vo['timeline'] * 1000,
//                            ]
//                        ];
//
//                       // Gateway::sendToUid($uid, json_encode($log_message));
//            Gateway::sendToGroup($vo['to_id'], json_encode($log_message), $client_id);
//                        //设置推送状态为已经推送
//                        $db1->query("UPDATE `v3_chatlog` SET `need_send` = '0' WHERE id=" . $vo['id']);
//                        
//                        
//                        
//                       
//                    }
//                }
                // 通知所有该用户好友，此用户上线，将此用户头像变亮
                $friends = $db1->query("select `user_id` from `nd_cases_friends` where `friend_id` = " . $uid);
                if (!empty($friends)) {
                    foreach ($friends as $key => $vo) {
                        $user_client_id = Gateway::getClientIdByUid($vo['user_id']);
                        if (!empty($user_client_id)) {
                            $online_message = [
                                'message_type' => 'online',
                                'id' => $uid,
                            ];
                            Gateway::sendToClient($user_client_id['0'], json_encode($online_message));
                        }
                    }
                }

                //查询当前的用户是在哪个分组中,将当前的链接加入该分组
                $ret = $db1->query("select `group_id` from `nd_cases_groupdetail` where `user_id` = {$uid} and `status`=1 group by `group_id`");
                if (!empty($ret)) {
                    foreach ($ret as $key => $vo) {
                        Gateway::joinGroup($client_id, $vo['group_id']);  //将登录用户加入群组
                        $groupid=$vo['group_id'];
                        /*查询在该群组下有无用户的离线消息*/
                        $log_list = $db1->query("select * from `nd_cases_chatlog` where `to_id` = {$groupid} and `type`='group' and find_in_set('{$uid}',send_id) ");
                       // print_r($log_list);exit;
                        foreach ($log_list as $kk => $vv) {
                            $logs=[
                            'message_type' => 'chatMessage',
                            'data' => [
                                'username' => $vv['from_name'],
                                'avatar' => $vv['from_avatar'],
                                'id' => $vv['to_id'],
                                'type' => 'group',
                                'content' => htmlspecialchars($vv['content']),
                                'timestamp' => $vv['timeline'] * 1000,
                                      ]
                                  ];
                           //print_r($logs);exit;
                            // Gateway::sendToUid($uid, json_encode($logs));
                            //接收成功后，去除该用户离线消息标识
                            $send_arr=explode(',',$vv['send_id']);
                            foreach ( $send_arr as $kkk => $vvv) {
                                if($vvv==$uid){
                                    unset($send_arr[$kkk]);
                                }
                            }
                            $send_str= implode(',',$send_arr);
                         //设置该用户已接收该群组信息
                        $db1->query("UPDATE `nd_cases_chatlog` SET `send_id` = '{$send_str}' WHERE id=" . $vv['id']);
                            unset($logs);
                        }
                    }
                }
 
                unset($ret);
                //设置用户为登录状态
                $db1->query("update `nd_cases_chatuser` set status=1 where id=" . $uid);

                return;
            case 'chatMessage':
                $db1 = Db::instance('db1');  //数据库链接
                // 聊天消息
                $type = $message['data']['to']['type'];
                $to_id = $message['data']['to']['id'];
                $uid = $_SESSION['id'];

                $chat_message = [
                    'message_type' => 'chatMessage',
                    'data' => [
                        'username' => $_SESSION['username'],
                        'avatar' => $_SESSION['avatar'],
                        'id' => $type === 'friend' ? $uid : $to_id,
                        'type' => $type,
                        'content' => htmlspecialchars($message['data']['mine']['content']),
                        'timestamp' => time() * 1000,
                        'group_fromid'=>$type === 'friend' ? 0 : $uid
                    ]
                ];
                // 加入聊天log表
                $param = [
                    'from_id' => $uid,
                    'to_id' => $to_id,
                    'from_name' => $_SESSION['username'],
                    'from_avatar' => $_SESSION['avatar'],
                    'content' => htmlspecialchars($message['data']['mine']['content']),
                    'timeline' => time(),
                    'need_send' => 0
                ];

                switch ($type) {
                    // 私聊
                    case 'friend':
                        // 插入
                        $param['type'] = 'friend';
                        if (empty(Gateway::getClientIdByUid($to_id))) {
                            $param['need_send'] = 1;  //用户不在线,标记此消息推送
                        }
                        $db1->insert('nd_cases_chatlog')->cols($param)->query();
                        return Gateway::sendToUid($to_id, json_encode($chat_message));
                    // 群聊
                    case 'group':
                        $param['type'] = 'group';
                        $user_list = $db1->query("select `user_id` from `nd_cases_groupdetail` where `group_id` = {$to_id} and `user_id`!={$uid} and `status`=1 ");
                        if (!empty($user_list)) {
                            foreach ($user_list as $key => $vo) {
                                if(Gateway::isUidOnline($vo['user_id'])){
                                    unset($user_list[$key]);
                                }else{
                                    $new_arr[]=$vo['user_id'];
                                }
                            }
                        }
                        //查询是否是监听消息
                        $jt_count = $db1->query("select * from `nd_cases_chatuser` as vc 
                                                        inner join  nd_manage_user as ta 
                                                        on ta.id=vc.managerid
                                                        where ta.user_gid=3 and vc.id={$uid} ");
                         
                           if(empty($jt_count)){
                               //发送短信内容存储
                        foreach ($new_arr as $key => $value) {
                             $mess_data=[];
                             $mess_data = $db1->query("select vc.* from `nd_cases_chatuser` as vc 
                                                        inner join  nd_manage_user as ta 
                                                        on ta.id=vc.managerid
                                                        where ta.user_gid=2 and vc.id={$value} and ta.delete_time=0 and vc.u_status=1");
                    
                              if(!empty($mess_data)){
                                  //查询该用户在该群组中有无有效的自动回复记录
                                   $autocount=$db1->query("select * from nd_cases_auto where userid=".$value." and groupid=".$to_id." and status=1");
                                   
                                   if(empty($autocount)){
                                       
                                   
                                     //设置自动回复
                                      $autodata=[
                                          'groupid'=>$to_id,
                                          'userid'=>$value,
                                          'timeline'=>time(),
                                      
                                     ];
                                      
                                     $db1->insert('nd_cases_auto')->cols($autodata)->query();  
                                   }
                                  
                                  
                                  
                                  $create_time=$db1->query("select create_time from nd_cases_messlog where user_id=".$value." order by create_time desc,id desc limit 1");

                                  if(empty($create_time)){
                                      $create_time=0;
                                  }else{
                                      $create_time=$create_time[0]['create_time'];
                                  }
        
                                  $nowtime=time();//当前时间
                                  $vl=$nowtime-$create_time;
                    
                                  if($vl>=60*10){
                                  $mess_data=$mess_data[0];
                                   $mess_data['url']=$_SESSION['servername'];
                                
                              
                                $chat_message['sendmess']=$value;
                                $sendmessage=[
                                    'message_type'=>'sendmsg',
                                    'data'=>[
                                        'mess_content'=>$mess_data,
                                        'tel'=>$mess_data['tel']
                                    ]
                                   ];
                                Gateway::sendToUid($uid, json_encode($sendmessage));
                                  }


                              }
                             
                        }
                        
                           }                            
                      
                        
                        $user_str=implode(',',$new_arr);
                        $param['send_id'] = $user_str;
                        $db1->insert('nd_cases_chatlog')->cols($param)->query();
                        unset($user_list);
                        unset($user_str);
                        return Gateway::sendToGroup($to_id, json_encode($chat_message), $client_id);
                }
                return;
                break;
            case 'addFriend':

                $client_id = Gateway::getClientIdByUid($message['toid']);
                //用户在线才通知
                if(!empty($client_id)){
                    $add_message = [
                        'message_type' => 'addFriend',
                        'data' => [
                            'username' => $message['username'],
                            'avatar' => $message['avatar'],
                            'id' => $message['id'],
                            'type' => 'friend',
                            'sign' => $message['sign'],
                            'groupid' => $message['groupid'],
                        ]
                    ];
                    Gateway::sendToClient($client_id['0'], json_encode($add_message));
                }
                return;
                break;
            case 'black':

                $client_id = Gateway::getClientIdByUid($message['to_id']);
                //用户在线才通知
                if(!empty($client_id)){
                    $add_message = [
                        'message_type' => 'black',
                        'data' => [
                            'id' => $message['del_id']
                        ]
                    ];
                    Gateway::sendToClient($client_id['0'], json_encode($add_message));
                }
                return;
                break;
            case 'delFriend':

                $client_id = Gateway::getClientIdByUid($message['to_id']);
                //用户在线才通知
                if(!empty($client_id)){
                    $add_message = [
                        'message_type' => 'delFriend',
                        'data' => [
                            'id' => $message['del_id']
                        ]
                    ];
                    Gateway::sendToClient($client_id['0'], json_encode($add_message));
                }
                return;
                break;
            case 'addGroup':
                // 创建群组
                $client_id = Gateway::getClientIdByUid($message['join_id']);
                Gateway::joinGroup($client_id['0'], $message['id']);

                $add_message = [
                    'message_type' => 'addGroup',
                    'data' => [
                        'type' => 'group',
                        'avatar'   => $message['avatar'],
                        'id'       => $message['id'],
                        'groupname'     => $message['groupname']
                    ]
                ];
                Gateway::sendToClient($client_id['0'], json_encode($add_message));
                return;
                break;
            case 'applyGroup':
                // 申请加入群组
                // 通知群组管理员，进行入群申请
                $client_id = Gateway::getClientIdByUid($message['to_id']);
                if(!empty($client_id)){
                    $apply_message = [
                        'message_type' => 'applyGroup',
                        'data' => [
                            'uid' => $message['to_id'],  //群组的管理员
                            'groupname' => $message['groupname'],
                            'groupid' => $message['groupid'],
                            'groupavatar' => $message['groupavatar'],
                            'joinid' => $message['join_id'],  //申请加入群组的id
                            'joinname' => $message['join_name'], //申请加入群组的用户名
                            'joinsign' => $message['join_sign'], //申请加组的的用户签名
                            'joinavatar' => $message['join_avatar'], // 申请人头像
                            'remark' => $message['remark'] //附加信息
                        ]
                    ];
                    Gateway::sendToClient($client_id['0'], json_encode($apply_message));
                }
                return;
                break;
            case 'joinGroup':
                //将申请人加入讨论组
                $client_id = Gateway::getClientIdByUid($message['join_id']); //若在线实时推送
                if( !empty($client_id) ){
                    Gateway::joinGroup($client_id['0'], $message['group_id']);  //将该用户加入群组

                    $add_message = [
                        'message_type' => 'addGroup',
                        'data' => [
                            'type' => 'group',
                            'avatar'   => $message['group_avatar'],
                            'id'       => $message['group_id'],
                            'groupname'     => $message['group_name']
                        ]
                    ];
                    Gateway::sendToClient($client_id['0'], json_encode($add_message));
                }
                return;
                break;
            case 'removeMember':
                //将移除群组的成员的群信息移除，并从讨论组移除
                $client_id = Gateway::getClientIdByUid( $message['remove_id'] );
                if( !empty($client_id) ){

                    Gateway::leaveGroup($client_id['0'], $message['group_id']);
                    $del_message = [
                        'message_type' => 'delGroup',
                        'data' => [
                            'type' => 'group',
                            'id'       => $message['group_id']
                        ]
                    ];
                    Gateway::sendToClient($client_id['0'], json_encode($del_message));
                }
                return;
                break;
            case 'leaveGroup':
                // 退出群组
                $client_id = Gateway::getClientIdByUid($message['leave_id']);
                if( !empty($client_id) ){
                    Gateway::leaveGroup($client_id['0'], $message['group_id']);
                }
                return;
                break;
            case "breakUp":
                // 解散群组
                $uids = explode(',', $message['uids']);
                foreach($uids as $key=>$vo){
                    $client_id = Gateway::getClientIdByUid($vo);
                    if(!empty($client_id)){
                        Gateway::leaveGroup($client_id['0'], $message['group_id']);

                        $del_message = [
                            'message_type' => 'delGroup',
                            'data' => [
                                'type' => 'group',
                                'id'       => $message['group_id']
                            ]
                        ];
                        Gateway::sendToClient($client_id['0'], json_encode($del_message));
                    }
                }
                return;
                break;
            case 'online':
                $db1 = Db::instance('db1');  //数据库链接
                // 在线切换状态
                $friends = $db1->query("select `user_id` from `nd_cases_friends` where `friend_id` = " . $message['uid']);
                if (!empty($friends)) {
                    foreach ($friends as $key => $vo) {
                        $user_client_id = Gateway::getClientIdByUid($vo['user_id']);
                        if (!empty($user_client_id)) {
                            $online_message = [
                                'message_type' => ('online' == $message['status']) ? 'online' : 'offline',
                                'id' => $message['uid'],
                            ];
                            Gateway::sendToClient($user_client_id['0'], json_encode($online_message));
                        }
                    }
                }
                return;
                break;
            case 'ping':
               //响应自动回复
               $db1 = Db::instance('db1');  //数据库链接
                $uid=$_SESSION['id'];
                $groupid=$message['groupid'];
                //查询是否是监听
                        $jt_count = $db1->query("select * from `nd_cases_chatuser` as vc 
                                                        inner join  nd_manage_user as ta 
                                                        on ta.id=vc.managerid
                                                        where ta.user_gid=3 and vc.id={$uid} ");
                //若不是监听
                if(empty($jt_count)){
                    $user_list = $db1->query("select `user_id` from `nd_cases_groupdetail` where `group_id` = {$groupid} and `user_id`!={$uid} and `status`=1 ");
                    $managerlist=[];
                    
                    foreach ($user_list as $key => $value) {
                        $mess_data=[];
                        $mess_data = $db1->query("select vc.* from `nd_cases_chatuser` as vc 
                                                        inner join  nd_manage_user as ta 
                                                        on ta.id=vc.managerid
                                                        where ta.user_gid=2 and vc.id={$value['user_id']} and ta.delete_time=0 and vc.u_status=1");
                        
                       if(!empty($mess_data)){
                           $managerlist=$mess_data[0];
                           
                       }
                    }
                   
                    if(!empty($managerlist)){
                        //查询该用户在该群组中有无有效的自动回复记录
                      $autocount=$db1->query("select * from nd_cases_auto where userid=".$managerlist['id']." and groupid=".$groupid." and status=1");
                      
                      
                      if(!empty($autocount)){
                          
                         $autocount=$autocount[0];
                         $nowtime=time();
                         $time=$nowtime-$autocount['timeline'];
                         if($time>10*60){
                             $url=$_SESSION['servername'];
                             $content='自动回复测试';
                            $automessage = [
                                    'message_type' => 'chatMessage',
                                    'data' => [
                                        'username' => $managerlist['user_name'],
                                        'avatar' => $managerlist['avatar'],
                                        'id' => $groupid,
                                        'type' => 'group',
                                        'content' => $content,
                                        'timestamp' => time() * 1000,
                                        'group_fromid'=>$managerlist['id']
                                    ]
                                ];
                            
                            Gateway::sendToClient($client_id,json_encode($automessage)); //给自身客户端发送一个自动回复
                            Gateway::sendToGroup($groupid, json_encode($automessage), $client_id);  //保证其他在线用户也能看到此消息
                            
                                // 加入聊天log表
                                $param = [
                                    'from_id' => $managerlist['id'],
                                    'to_id' => $groupid,
                                    'from_name' => $managerlist['user_name'],
                                    'from_avatar' => $managerlist['avatar'],
                                    'content' => htmlspecialchars($content),
                                    'timeline' => time(),
                                    'need_send' => 0,
                                    'type'=>'group'
                                ]; 
                                
                                 $db1->insert('nd_cases_chatlog')->cols($param)->query();
                                 
                              $db1->query("UPDATE `nd_cases_auto` SET `status` = '0' WHERE groupid=" . $groupid." and userid=".$managerlist['id']);   
                         }
                      }
                    }
                    
                }
                
                return;
            default:
                echo $data;
        }
    }

    /**
     * 当用户断开连接时触发
     * @param int $client_id 连接id
     */
    public static function onClose($client_id)
    {
        //维持连接的worker退出才触发
        if(!empty($_SESSION['id'])){
            $db1 = Db::instance('db1');  //数据库链接
            //通知该用户的好友，该用户下线
            $friends = $db1->query("select `user_id` from `nd_cases_friends` where `friend_id` = " . $_SESSION['id']);
            if (!empty($friends)) {
                foreach ($friends as $key => $vo) {
                    $user_client_id = Gateway::getClientIdByUid($vo['user_id']);
                    if (!empty($user_client_id)) {
                        $online_message = [
                            'message_type' => 'logout',
                            'id' => $_SESSION['id'],
                        ];
                        Gateway::sendToClient($user_client_id['0'], json_encode($online_message));
                    }
                }
            }
            //设置用户为退出状态
            $db1->query("update `nd_cases_chatuser` set `status` = 0 where id = " . $_SESSION['id']);
        }
    }
}
