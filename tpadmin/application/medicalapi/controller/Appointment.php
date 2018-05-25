<?php
//命名空间
namespace app\medicalapi\controller;

//导入
use think\Controller;
use think\Request;
use think\Db;
use app\common\sendemail\SendUser;


class Appointment extends Base{
    
   

    
    protected  $db;
    
    public function yuyuedemo(){
      
        //渲染模板输出
        return $this -> fetch();
    }
    
    //预约信息
    public function submitYuyue(){
       
        $body=$this->body;
        
      
        //用户名
        $data['user_name'] = $body['username'];
        
        //预约状态为 1  1是委派中
        $data['appointment_state'] = 1;
        
        $request= Request::instance();
        
        
        //是否关联case  1关联  2不关联
        $iscase = $request->param('iscase');
        if(!empty($iscase)){
            if($iscase == 1){
                
                //关联case id
                $caseid = $request->param('caseid');
                if(!empty($caseid)){
                    $data['iscase'] = 1;
                    $data['caseid'] = $caseid;
                }else{
                    echo json_encode(['code' => 20005,'msg' => 'invalid code']);
                    exit;
                }
                
            }else if($iscase == 2){//不关联
                $data['iscase'] = 2;
            }else{
                echo json_encode(['code' => 20004,'msg' => 'invalid code']);
                exit;
            }
        }else{
            echo json_encode(['code' => 20004,'msg' => 'invalid code']);
            exit;
        }
        
     
        
        
        //获取预约信息
        if($request->isPost()){
            //手机
            $phone = $request->param('phone');
            if(!empty($phone)){
                if(preg_match("/^1[34578]\d{9}$/", $phone)){
                    $data['phone'] = $phone;
                }else{
                    echo json_encode(['code' => 20001,'msg' => 'invalid code']);
                    exit;
                }
            }else{
                echo json_encode(['code' => 20001,'msg' => 'invalid code']);
                exit;
            }
            
            //邮箱
            $email = $request->param('email');
            if(!empty($email)){
                if(preg_match("/^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/",$email)){
                    $data['email'] = $email;
                }else{
                    echo json_encode(['code' => 20002,'msg' => 'invalid code']);
                    exit;
                }
            }else{
                echo json_encode(['code' => 20002,'msg' => 'invalid code']);
                exit;
            }
            
            
            //咨询内容简介
            $advisory_details = $request->param('advisory_details');
            if(!empty($advisory_details)){
                $data['advisory_details'] = $advisory_details;
            }else{
                echo json_encode(['code' => 20003,'msg' => 'invalid code']);
                exit;
            }
            
            
            //预约日期
            $submitdate = $request->param('submitdate');
            if(!empty($submitdate)){
                if(strpos($submitdate,'-')){
                    $data['submitdate'] = $submitdate;
                }else{
                    echo json_encode(['code' => 20006,'msg' => 'invalid code']);
                    exit;
                }
            }else{
                echo json_encode(['code' => 20006,'msg' => 'invalid code']);
                exit;
            }
            
            //预约时间段
            $time_quantum = $request->param('time_quantum');
            if(!empty($time_quantum)){
                    if(strpos($time_quantum,':')){
                             //根据时间段查找,预约时间段表id
                            $atq = Db::table('nd_appointment_time_quantum')->where("time_quantum = '".$time_quantum."'")->select();
                            if(!empty($atq)){
                                //时间段表id
                                $atqid = $atq[0]['id'];
                                $data['time_qid'] = $atqid;
                                
                            }else{
                                echo json_encode(['code' => 20007,'msg' => 'invalid code']);
                                exit;
                            }
                     }else{
                            echo json_encode(['code' => 20007,'msg' => 'invalid code']);
                            exit;
                     }
            }else{
                echo json_encode(['code' => 20007,'msg' => 'invalid code']);
                exit;
            }
            
            
            
            
        }
        
        

        //添加预约信息到数据库
        Db::table('nd_appointment_info')->insert($data);
        
        
    }
    
}
?>

