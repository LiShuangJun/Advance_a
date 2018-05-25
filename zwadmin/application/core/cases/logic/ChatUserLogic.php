<?php
namespace core\cases\logic;

use think\Loader;
use core\Logic;
use core\cases\model\ChatUserModel;
use core\cases\model\UserModel;
use core\cases\model\CompanyModel;
use excel\excels;
use core\cases\logic\CompanyLogic;
use core\manage\model\FileModel;
use core\cases\model\KsModel;
use core\Validate;
use core\cases\model\LangModel;
class ChatUserLogic extends Logic
{
         /*
  * 获取科室列表
  */
    
        public function getSelectKs($sort_name='ks_sort',$sort='desc')
    {
           $data= KsModel::getInstance()->order($sort_name, $sort)->select();
           $list=[

           ];
           unset($data[0]);
           foreach ($data as $key => $value) {
               $list[]=[
                 'name'=>$value['ks_name'].'('.$value['ks_ename'].')',
                 'value'=>$value['ks_id']
               ];
           }
          
           
           return $list;
    }  
    
                 /*
  * 获取擅长语言列表
  */
    
        public function getBestLang($sort_name='sort',$sort='desc')
    {
           $data= LangModel::getInstance()->order($sort_name, $sort)->select();
           $list=[

           ];
           foreach ($data as $key => $value) {
               $list[]=[
                 'name'=>$value['l_name'].'('.$value['l_ename'].')',
                 'value'=>$value['id']
               ];
           }
           
           
           return $list;
    }  
 /*
  * 获取用户下拉列表
  */
    
        public function getSelectUser($where=[],$sort_name='sort',$sort='asc')
    {

           $data= ChatUserModel::getInstance()->where($where)->order($sort_name, $sort)->select();
           $list=[

           ];
           foreach ($data as $key => $value) {
               $list[]=[
                 'name'=>$value['user_name'],
                 'value'=>$value['id']
               ];
           }
           
           
           return $list;
    }
    
        /**
     * 获取状态下拉
     *
     * @return array
     */
    public function getSelectStatus($type=1)
    {
        if($type==1){
            return [
            [
                'name' => '启用',
                'value' => 1
            ],
            [
                'name' => '禁用',
                'value' => 0
            ]
          ];
        }else{
           return [
            [
                'name' => 'Able',
                'value' => 1
            ],
            [
                'name' => 'Disable',
                'value' => 0
            ]
          ]; 
        }
        
    }
     /*
  * 获取用户公司下拉列表
  */
    
        public function getSelectCompany($where=[],$sort_name='sort',$sort='desc')
    {

           $data= CompanyModel::getInstance()->where($where)->order($sort_name, $sort)->select();
           $list=[

           ];
           foreach ($data as $key => $value) {
               $list[]=[
                 'name'=>$value['name'],
                 'value'=>$value['id']
               ];
           }
           
           
           return $list;
    }
          /**
     * 查询某条件下用户数据是否重复
     *
     * @return array
     */
    
    public function IsOnly($where=null) {
       $where['delete_time']=0;   
      
       $count=ChatUserModel::getInstance()->where($where)->count();
       $result=true;
       $count && $result=false;
       
      return $result;
    }
    
        /*
     * 获取用户接收邮件或短信语言
     */
    public function getLanguage($data,$k) {
        error_reporting(E_ERROR | E_WARNING | E_PARSE);  //修改错误级别，防止报错
        isset($data['case_code']) ||  $data['case_code']='';
        isset($data['nickname']) ||  $data['nickname']='';
        isset($data['url']) ||  $data['url']='';
        isset($data['eurl']) ||  $data['eurl']='';
        isset($data['user_name']) ||  $data['user_name']='';
        isset($data['pwd']) ||  $data['pwd']='';
        isset($data['typename']) ||  $data['typename']='';
        isset($data['typeename']) ||  $data['typeename']='';
        isset($data['footstr']) ||  $data['footstr']='';
        isset($data['efootstr']) ||  $data['efootstr']='';
        isset($data['tfootstr']) ||  $data['tfootstr']='';
        isset($data['companyname']) ||  $data['companyname']='';
        if(is_array($data)){
            
     
        if(isset($data['field'])){
            if($data['field']['country']==1){
                $address=$data['field']['provincename'].'-'.$data['field']['cityname'].'-'.$data['field']['districtname'].'&nbsp;&nbsp;'.$data['field']['address'];
               
            }else{
               $address=$data['field']['e_province'].'&nbsp;&nbsp;'.$data['field']['address']; 
            }
        }
        
       if(isset($data['field']['content'])){
          eval('$casecontent='.$data['field']['content'].';');
       }
       if(isset($data['field']['econtent'])){
          eval('$caseecontent='.$data['field']['econtent'].';');
       }
   
          } 
          
         
        $arr= [
           1=>[
              'name'=>'中文简体',
              'value'=>1, 
              'data'=>[
                1=>[
                  'content'=>'【汇医服务】'.$data['nickname'].'(先生/女士),您好,您被指定负责新的case，请及时登录 '.$data['url'].' 选择接收或者拒绝',
                  'description'=>'被指定case发给casemanager的短信内容',
                  'short_title'=>'汇医服务'
                 ],
                2=>[
                  'content'=>[
                     
                     'user'=>"<strong>亲爱的".$data['nickname']."先生/女士,您好!</strong><br/>"
                        ."<br/>"
                        ."感谢您注册中德安联│汇医全球医学专家意见服务官网。以下是您的登录信息,请妥善保管。<br/>"
                        ."<br/>"
                          ."登录帐号：".$data['user_name']."<br/>"
                        ."<br/>"
                          ."登录密码：".$data['pwd']."<br/>"
                        ."<br/>"
                       ."<br/>"
                          ."登陆后，请通过点击以下链接在线提交全球医学专家意见服务申请，您的私人专案医生会尽快与您联系，以获取更多信息并帮助您解决医疗问题。<br/>"
                        ."<br/>"
                      ."链接：http://allianzchina.advance-medical.com.cn/<br/>"
//                        .'<img src="http://demo.advance-medical.com.cn/static/laychat/common/images/ewm.jpg"  style="width:108px;height:108px;"/>'
//                       ."<br/>"
                          ."感谢您的信任！<br/>"
                          ."中德安联│汇医",
                  
                      'manager'=>"<strong>亲爱的 ".$data['nickname']." 医生,您好!</strong><br/>"
                        ."<br/>"
                        ."您已经成功的取得了ADVANCE-MEDICAL PATIENT PORTAL账号密码如下<br/>"
                        ."<br/>"
                          ."登录帐号：".$data['user_name']."<br/>"
                        ."<br/>"
                          ."登录密码：".$data['pwd']."<br/>"
                        ."<br/>"
                          ."您可以登录 ".$data['url']."/service 进行case处理。<br/>"
                        ."<br/>"
//                      .'<img src="http://demo.advance-medical.com.cn/static/laychat/common/images/ewm.jpg"  style="width:108px;height:108px;"/>'
//                       ."<br/>"
//                          ."请关注公众号，进入点击右下角我的-在线IM系统进行咨询。"
                      
                      
                  ],
                  'description'=>'添加用户帐号需要发送的邮件内容',
                  'title'=>'注册成功，恭喜您可以在线提交全球医学专家意见服务申请啦！',
                  'short_title'=>'汇医服务'
                 ],
                3=>[
                  'content'=>"您好!".$data['nickname'].":<br/>"
                          ."感谢您选择汇医！<br/>"
                          ."您已申请了新的登陆密码。<br/>"
                          ."用户名：".$data['user_name']."<br/>"
                          ."新密码：".$data['pwd']."<br/>"
                          ." 如果您有其他问题，请联系汇医".$data['footstr']."。"
                          ."<br/>"
                          ."<br/>"
                          ."感谢,<br/>"
                          ."汇医（亚太地区）",
//                          ."请扫描下方二维码关注公众号，当您的case受理后，您可以进入公众号点击汇医咨询与您的专属医生进行沟通<br/>"
//                          .'<img src="http://demo.advance-medical.com.cn/static/laychat/common/images/ewm.jpg"  style="width:108px;height:108px;"/>'
//                          ."<br/>",
                  'description'=>'修改用户密码需要发送的邮件内容',
                  'title'=>'重置汇医密码',
                  'short_title'=>'汇医服务'
                 ],
                4=>[
                  'content'=>'【汇医服务】'.$data['nickname'].'医生,您好,有患者向您咨询问题，请及时登录  '.$data['url'].'/service  ，尽快回复',
                  'description'=>'用户寻求帮助，casemanager不在线casemanager收到的短信',
                  'short_title'=>'汇医服务'
                 ],
                5=>[
                  'content'=>'测试自动回复（中文）',
                  'description'=>'layim用户咨询，casemanger超过十分钟未回复的时候对用户的自动回复',
                  'short_title'=>'汇医服务'
                 ],
                6=>[
                  'content'=>'【汇医服务】'.$data['nickname'].'医生，感谢您接受了病案'.$data['case_code'].'。在整个病案服务的过程中，病人可能通过以下三种方式与您沟通咨询：<br/>'
                             .'<br/>'
                             .'1、拨打我们的热线。在收到客户电话之后，case coordinator会通知您尽快回电。<br/>'
                             .'2、客户通过在线平台，提交问题，我们会以短信形式通知您。<br/>'
                             .'3、客户将问题发送至您 '.$data['email'].'的邮箱，您收到后请回复。<br/>'
                             .'<br/>'
                             .'祝，安康！<br/>'
                             .'汇医亚太区',
                             
                  'description'=>'casemanager接受新的case发送的短信',
                  'title'=>'汇医服务提醒',
                  'short_title'=>'汇医服务'
                 ],
                7=>[
                   'content'=>$casecontent, 
                   'description'=>'为用户添加成功case发送的邮件内容',
                   'title'=>'Reminder of medical service',
                   'short_title'=>'汇医服务'
                ]
              
              ]    
           ],
            2=>[
              'name'=>'中文繁体',
              'value'=>2, 
              'data'=>[
                1=>[
                  'content'=>'【汇医服务】'.$data['nickname'].'(先生/女士),您好,您被指定负责新的case，请及时登录 '.$data['url'].' 选择接收或者拒绝',
                  'description'=>'被指定case发给casemanager的短信内容',
                  'short_title'=>'汇医服务'
                 ],
                2=>[
                  'content'=>'',
                  'description'=>'添加用户帐号需要发送的邮件内容',
                  'title'=>'',
                  'short_title'=>'汇医服务'
                 ],
               3=>[
                  'content'=>'么西',
                  'description'=>'修改用户密码需要发送的邮件内容',
                  'title'=>'阿萨德',
                   'short_title'=>'汇医服务'
                 ],
                4=>[
                  'content'=>'',
                  'description'=>'用户寻求帮助，casemanager不在线casemanager收到的短信',
                  'short_title'=>'汇医服务'
                 ],
                5=>[
                  'content'=>'',
                  'description'=>'layim用户咨询，casemanger超过十分钟未回复的时候对用户的自动回复',
                  'short_title'=>'汇医服务'
                 ],
                6=>[
                  'content'=>'',
                  'description'=>'casemanager接受新的case发送的短信',
                  'short_title'=>'汇医服务'
                 ],
                7=>[
                   'content'=>'添加case成功(繁体)',
                   'description'=>'为用户添加成功case发送的邮件内容',
                    'title'=>'汇医服务提醒',
                   'short_title'=>'汇医服务'
                ]
              ]    
           ],
            3=>[
              'name'=>'英文',
              'value'=>3, 
              'data'=>[
                1=>[
                  'content'=>'【Medical service】Dear Mr/Ms '.$data['nickname'].', you are assigned to be responsible for the new case，Please log in  '.$data['url'].' choose to receive or refuse!',
                  'description'=>'被指定case发给casemanager的短信内容',
                  'short_title'=>'Advance Medical'
                 ],
                2=>[
                  'content'=>[
                     
                     'user'=>"<strong>Dear ".$data['nickname'].",</strong><br/>"
                        ."<br/>"
                        ." We understand that you intend to open a case with the ".$data['typeename']." by Advance Medical, the world leader of independent medical advisory and advocacy.<br/>"
                        ."<br/>"
                        ."To enrol in Advance Medical’s portal, please visit: ".$data['eurl']."<br/>"
                        ."<br/>"
                          ."Username：".$data['user_name']."<br/>"
                        ."<br/>"
                          ."Password：".$data['pwd']."<br/>"
                        ."<br/>"
                        ."<br/>"
                          ."Once logged in, kindly fill in the online enrolment form and a physician will contact you shortly to obtain more information and help you with your medical issue.<br/>"
                        ."<br/>"
                          ."Thank you,<br/>"
                          ."Advance Medical (Asia Pacific)",
                  
                      'manager'=>"<strong>亲爱的 ".$data['nickname']." 医生,您好!</strong><br/>"
                        ."<br/>"
                        ." 您已经成功的取得了ADVANCE-MEDICAL PATIENT PORTAL账号密码如下<br/>"
                        ."<br/>"
                          ."登录帐号：".$data['user_name']."<br/>"
                        ."<br/>"
                          ."登录密码：".$data['pwd']."<br/>"
                        ."<br/>"
                          ."您可以登录 ".$data['url']."/service 进行case处理。<br/>"
                        ."<br/>"
                          ."请关注公众号，进入点击右下角我的-在线IM系统进行咨询。"
                      
                  ],
                  'description'=>'添加用户帐号需要发送的邮件内容',
                  'title'=>'Your Advance Medical Portal Username & Password is Ready',
                  'short_title'=>'Advance Medical'
                 ],
                3=>[
                  'content'=>"Hello, ".$data['nickname'].":<br/>"
                          ."Thank you for using Advance Medical’s services.<br/>"
                          ."You have requested a new password.<br/>"
                          ."Username :".$data['user_name']."<br/>"
                          ."New password :".$data['pwd']."<br/>"
                          ." If you have any additional questions. Please contact Advance Medical’s ".$data['efootstr']."."
                          ."<br/>"
                          ."<br/>"
                          ."Thank you,<br/>"
                          ."Advance Medical (APAC)",
                  'description'=>'修改用户密码需要发送的邮件内容',
                  'title'=>'Advance Medical Password is Reset ',
                  'short_title'=>'Advance Medical'
                 ],
                4=>[
                  'content'=>'【Medical service】Dear Dr. '.$data['nickname'].', A patient has sent you a message. Please log in  '.$data['url'].'/service  ，and reply at your earliest convenience.',
                  'description'=>'用户寻求帮助，casemanager不在线casemanager收到的短信',
                  'short_title'=>'Advance Medical'
                 ],
                5=>[
                  'content'=>'测试自动回复（英文）',
                  'description'=>'layim用户咨询，casemanger超过十分钟未回复的时候对用户的自动回复',
                  'short_title'=>'Advance Medical'
                 ],
                6=>[
                  'content'=>'【Medical service】Dr '.$data['nickname'].', thank you for taking case '.$data['case_code'].' . Please be aware that patient may consult you in three ways:<br/>'
                             .'<br/>'
                             .'1.Call our hotline. Case coordinator will inform you of patient’s call and case details for you to call back.<br/>'
                             .'2.Patient submits question over a secured Instant Messaging system. We will arrange an SMS to you upon receiving patient’s message, with a link. Click on the link and reply accordingly.<br/>'
                             .'3.Patient sends an email to your advance-medical.com.cn mailbox. Please reply accordingly. <br/>'
                             .'<br/>'
                             .'Appreciate your effort.<br/>'
                             .'Advance Medical Asia Pacific',
                             
                  'description'=>'casemanager接受新的case发送的短信',
                  'title'=>'Reminder of medical service',
                  'short_title'=>'Advance Medical'
                 ],
                7=>[
                   'content'=>$caseecontent,
                   'description'=>'为用户添加成功case发送的邮件内容',
                   'title'=>'Reminder of medical service',
                   'short_title'=>'Advance Medical'
                ]
              ]    
           ],
            4=>[
              'name'=>'泰文',
              'value'=>3, 
              'data'=>[
                1=>[
                  'content'=>'【Medical service】Dear Mr/Ms '.$data['nickname'].', you are assigned to be responsible for the new case，Please log in  '.$data['url'].' choose to receive or refuse!',
                  'description'=>'被指定case发给casemanager的短信内容',
                  'short_title'=>'Advance Medical'
                 ],
                2=>[
                  'content'=>[
                     
                     'user'=>"<strong>เรียน  ".$data['nickname'].",</strong><br/>"
                        ."<br/>"
                        ." พวกเราเข้าใจดีว่าคุณตั้งใจที่จะเปิดเคส ".$data['typeename']." โดย แอดวานซ์ เมดิคอล ซึ่งเป็นผู้นำของโลกด้านการให้คำปรึกษาและได้รับการสนับสนุนจากแพทย์ <br/>"
                        ."<br/>"
                        ."หากต้องการลงทะเบียน ในระบบ แอดวานซ์ เมดิคอล พอร์ทัล กรุณาเยี่ยมชม ".$data['eurl']."<br/>"
                        ."<br/>"
                          ."ชื่อผู้ใช้ ".$data['user_name']."<br/>"
                        ."<br/>"
                          ."รหัสผ่าน ".$data['pwd']."<br/>"
                        ."<br/>"
                        ."<br/>"
                          ."เมื่อเข้าสู่ระบบกรุณากรอกแบบฟอร์มการลงทะเบียนออนไลน์และแพทย์จะติดต่อคุณในไม่ช้าเพื่อขอรับข้อมูลเ เพิ่มเติมและช่วยคุณแก้ไขปัญหาทางการแพทย์ของคุณ<br/>"
                        ."<br/>"
                          ."ขอขอบคุณ,<br/>"
                          ."แอดวานซ์ เมดิคอล (เอเชียแปซิฟิก)",
                  
                      'manager'=>"<strong>亲爱的 ".$data['nickname']." 医生,您好!</strong><br/>"
                        ."<br/>"
                        ." 您已经成功的取得了ADVANCE-MEDICAL PATIENT PORTAL账号密码如下<br/>"
                        ."<br/>"
                          ."登录帐号：".$data['user_name']."<br/>"
                        ."<br/>"
                          ."登录密码：".$data['pwd']."<br/>"
                        ."<br/>"
                          ."您可以登录 ".$data['url']."/service 进行case处理。<br/>"
                        ."<br/>"
                          ."请关注公众号，进入点击右下角我的-在线IM系统进行咨询。"
                      
                  ],
                  'description'=>'添加用户帐号需要发送的邮件内容',
                  'title'=>'ชื่อผู้ใช้และรหัสผ่านของ แอดวานซ์ เมดิคอล พอร์ทัล พร้อมใช้แล้ว',
                  'short_title'=>'แอดวานซ์ เมดิคอล'
                 ],
                3=>[
                  'content'=>"สวัสดี, ".$data['nickname'].":<br/>"
                          ."ขอขอบคุณที่ใช้บริการของ แอดวานซ์ เมดิคอล <br/>"
                          ."คุณได้ขอรหัสผ่านใหม่<br/>"
                          ."ชื่อผู้ใช้ :".$data['user_name']."<br/>"
                          ."รหัสผ่านใหม่ :".$data['pwd']."<br/>"
                          ." หากคุณมีคำถามเพิ่มเติม กรุณาติดต่อหา".$data['tfootstr']."."
                          ."<br/>"
                          ."<br/>"
                          ."ขอขอบคุณ,<br/>"
                          ."แอดวานซ์ เมดิคอล (APAC)",
//                          ."Please scan the QR code below to pay attention to the public number, and when your case is accepted, you can enter the public number. Click on the consultation and your doctor to communicate.<br/>"
//                          .'<img src="http://demo.advance-medical.com.cn/static/laychat/common/images/ewm.jpg"  style="width:108px;height:108px;"/>'
//                          ."<br/>",
                  'description'=>'修改用户密码需要发送的邮件内容',
                  'title'=>'รหัสผ่านของ แอดวานซ์ เมดิคอล รีเซ็ต เรียบร้อยแล้ว',
                  'short_title'=>'แอดวานซ์ เมดิคอล'
                 ],
                4=>[
                  'content'=>'【Medical service】Dear Dr. '.$data['nickname'].', A patient has sent you a message. Please log in  '.$data['url'].'/service  ，and reply at your earliest convenience.',
                  'description'=>'用户寻求帮助，casemanager不在线casemanager收到的短信',
                  'short_title'=>'Advance Medical'
                 ],
                5=>[
                  'content'=>'测试自动回复（英文）',
                  'description'=>'layim用户咨询，casemanger超过十分钟未回复的时候对用户的自动回复',
                  'short_title'=>'Advance Medical'
                 ],
                6=>[
                  'content'=>'【Medical service】Dr '.$data['nickname'].', thank you for taking case '.$data['case_code'].' . Please be aware that patient may consult you in three ways:<br/>'
                             .'<br/>'
                             .'1.Call our hotline. Case coordinator will inform you of patient’s call and case details for you to call back.<br/>'
                             .'2.Patient submits question over a secured Instant Messaging system. We will arrange an SMS to you upon receiving patient’s message, with a link. Click on the link and reply accordingly.<br/>'
                             .'3.Patient sends an email to your advance-medical.com.cn mailbox. Please reply accordingly. <br/>'
                             .'<br/>'
                             .'Appreciate your effort.<br/>'
                             .'Advance Medical Asia Pacific',
                             
                  'description'=>'casemanager接受新的case发送的短信',
                  'title'=>'Reminder of medical service',
                  'short_title'=>'Advance Medical'
                 ],
                7=>[
                   'content'=>$caseecontent,
                   'description'=>'为用户添加成功case发送的邮件内容',
                   'title'=>'Reminder of medical service',
                   'short_title'=>'Advance Medical'
                ]
              ]    
           ]
           
        ];
        isset($data['language']) || $data['language']=1;
        $key=$data['language'];
       
             $return_arr=$arr[$key]['data'][$k];
        
    
        return $return_arr;
    }
    
    
    /*
     * 获取语言列表
     */
    public function getLanguageList($type=1){
        if($type==1){
            return [
          [
              'name'=>'简体中文',
              'value'=>1,
          ],
          [
              'name'=>'繁体中文',
              'value'=>2,
          ],
            [
              'name'=>'英文',
              'value'=>3,
          ],
          [
              'name'=>'泰文',
              'value'=>4, 
          ]
        ]; 
        }else{
            return [
          [
              'name'=>'Simplified Chinese',
              'value'=>1,
          ],
          [
              'name'=>'Traditional Chinese',
              'value'=>2,
          ],
            [
              'name'=>'English',
              'value'=>3,
          ],
            [
              'name'=>'Thai',
              'value'=>4, 
          ]
        ]; 
        }
       
    }
    
    
    /*
     * 导出用户表的excel表格
     */
    
    Public function exportUser($where){
        
         set_time_limit(0);
        $userlist=ChatUserModel::getInstance()->getUserlist($where)->select();
    	 
    		error_reporting(E_ALL);
    		date_default_timezone_set('Europe/London');
                
                $excels=new excels();
                $objPHPExcel=$excels->phpexcel();
                $excels->loaderexcel5(); //加载excel5

                
    		$title=date("Y-m-d")."汇医服务用户导出表";
    		/*设置excel的属性*/
    		$objPHPExcel->getProperties()->setCreator("汇医服务")//创建人
    		->setLastModifiedBy("汇医服务")//最后修改人
    		->setTitle($title)//标题
    		->setSubject($title)//题目
    		->setDescription("")//描述
    		->setKeywords("用户")//关键字
    		->setCategory("result file");//种类
    		//set width
    		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(8);
                $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30);

    		//第一行数据
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('A1', '序号')
    		->setCellValue('B1', '登录名')
    		->setCellValue('C1','姓名')
    		->setCellValue('D1', '性别')
    		->setCellValue('E1', '手机号')
    		->setCellValue('F1', '邮箱')
                ->setCellValue('G1', '联系地址')
                ->setCellValue('H1', '公司')
                ->setCellValue('I1', '出生日期')
                ->setCellValue('J1', '保单开始日期')
                ->setCellValue('K1', '保单结束日期')
                ->setCellValue('L1', '保单号')
                ->setCellValue('M1', '证件类型')
                ->setCellValue('N1', '证件号')
                ->setCellValue('O1', '保单变更信息');   
                           
    		

    		foreach($userlist as $k => $v){
                    
					$k=$k+1;
    				$num=$k+1;//数据从第二行开始录入

                         //整理数据
                         $v['sex']?$v['sex']='男':$v['sex']='女'; 
                         
                         $idtypearr=CompanyLogic::getInstance()->getIdType();
                         foreach ($idtypearr as $key => $value) {
                            if($value['value']==$v['idtype']){
                                $v['idtype']=$value['name'];
                            }
                         }
    			$objPHPExcel->setActiveSheetIndex(0)
    			//Excel的第A列，uid是你查出数组的键值，下面以此类推
    			->setCellValue('A'.$num, $num-1)
    			->setCellValue('B'.$num, $v['user_name'])
    			->setCellValue('C'.$num, $v['nickname'])
    			->setCellValue('D'.$num, $v['sex'])
    			->setCellValue('E'.$num, $v['tel'])
    			->setCellValue('F'.$num, $v['email'])
    			->setCellValue('G'.$num, $v['area'])
    			->setCellValue('H'.$num, $v['companyname'])
    			->setCellValue('I'.$num, $v['birthday'])
    			->setCellValue('J'.$num, $v['start_time'])
    			->setCellValue('K'.$num, $v['stop_time'])
    			->setCellValue('L'.$num, $v['policy'])
                        ->setCellValue('M'.$num, $v['idtype'])
                        ->setCellValue('N'.$num, $v['idnumber'])
                        ->setCellValue('O'.$num, $v['change_content']);


    		}
                
    		$objPHPExcel->getActiveSheet()->setTitle('User');
    		$objPHPExcel->setActiveSheetIndex(0);
    		ob_end_clean();//清除缓冲区,避免乱码
    		header('Content-Type: application/vnd.ms-excel');
    		header('Content-Disposition: attachment;filename="'.$title.'.xls"');
    		header('Cache-Control: max-age=0');
    		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    		$objWriter->save('php://output');
    		exit;

        
    }
    
       /*
     * 导出casemanager表的excel表格
     */
    
    Public function exportCmanager($where){
        
         set_time_limit(0);
        $userlist=ChatUserModel::getInstance()->getCmlist($where)->select();
    	 
    		error_reporting(E_ALL);
    		date_default_timezone_set('Europe/London');
                
                $excels=new excels();
                $objPHPExcel=$excels->phpexcel();
                $excels->loaderexcel5(); //加载excel5

                
    		$title=date("Y-m-d")."汇医服务casemanger导出表";
    		/*设置excel的属性*/
    		$objPHPExcel->getProperties()->setCreator("汇医服务")//创建人
    		->setLastModifiedBy("汇医服务")//最后修改人
    		->setTitle($title)//标题
    		->setSubject($title)//题目
    		->setDescription("")//描述
    		->setKeywords("CaseManager")//关键字
    		->setCategory("result file");//种类
    		//set width
    		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(8);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    		$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(15);
                

    		//第一行数据
    		$objPHPExcel->setActiveSheetIndex(0)
    		->setCellValue('A1', '序号')
    		->setCellValue('B1', '登录名')
    		->setCellValue('C1','姓名')
    		->setCellValue('D1', '性别')
    		->setCellValue('E1', '手机号')
    		->setCellValue('F1', '邮箱')
                ->setCellValue('G1', '联系地址')
                ->setCellValue('H1', '公司')
                ->setCellValue('I1', '出生日期');
    
                           
    		

    		foreach($userlist as $k => $v){
                    
					$k=$k+1;
    				$num=$k+1;//数据从第二行开始录入

                         //整理数据
                         $v['sex']?$v['sex']='男':$v['sex']='女'; 
                         
                         $idtypearr=CompanyLogic::getInstance()->getIdType();
                         foreach ($idtypearr as $key => $value) {
                            if($value['value']==$v['idtype']){
                                $v['idtype']=$value['name'];
                            }
                         }
    			$objPHPExcel->setActiveSheetIndex(0)
    			//Excel的第A列，uid是你查出数组的键值，下面以此类推
    			->setCellValue('A'.$num, $num-1)
    			->setCellValue('B'.$num, $v['user_name'])
    			->setCellValue('C'.$num, $v['nickname'])
    			->setCellValue('D'.$num, $v['sex'])
    			->setCellValue('E'.$num, $v['tel'])
    			->setCellValue('F'.$num, $v['email'])
    			->setCellValue('G'.$num, $v['area'])
    			->setCellValue('H'.$num, $v['companyname'])
    			->setCellValue('I'.$num, $v['birthday']);



    		}
                
    		$objPHPExcel->getActiveSheet()->setTitle('User');
    		$objPHPExcel->setActiveSheetIndex(0);
    		ob_end_clean();//清除缓冲区,避免乱码
    		header('Content-Type: application/vnd.ms-excel');
    		header('Content-Disposition: attachment;filename="'.$title.'.xls"');
    		header('Cache-Control: max-age=0');
    		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    		$objWriter->save('php://output');
    		exit;

        
    }
    
    //导入用户表
    public function importUser($dirname) {
        echo 'Trying to upload, please do not close the page ...';
        set_time_limit(0);
        
        $excels=new excels();
        $excels->phpexcel();
        
        
       $file_types = explode ( ".", $dirname );
       $exts = $file_types [count ( $file_types ) - 1];
       $companylist=CompanyLogic::getInstance()->getCompanyList();
       
       
      
          if ($exts == 'xls') {
           
            $excels->loaderexcel5(); //加载excel5
            $PHPReader = new \PHPExcel_Reader_Excel5();
        } else if ($exts == 'xlsx') {
            $excels->loaderexcel5(); //加载excel5
            $PHPReader = new \PHPExcel_Reader_Excel2007();
        }
        //载入文件
        $PHPExcel = $PHPReader->load($dirname);
        //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet = $PHPExcel->getSheet(0);
        //获取总列数
        $allColumn = $currentSheet->getHighestColumn();
        //获取总行数
        $allRow = $currentSheet->getHighestRow();
        $errdata=[];
        //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
        for ($currentRow = 2; $currentRow <= $allRow; $currentRow++) {
             $error=0;
            //从哪列开始，A表示第一列
            for ($currentColumn = 'A'; $currentColumn <= $allColumn; $currentColumn++) {
                //数据坐标
                $address = $currentColumn . $currentRow;
                $old_val=$currentSheet->getCell($address)->getValue();
                
                switch ($currentColumn) {
                    case 'B':  //登录名
                        $rowname='user_name';
                        $value=$old_val;
                    
                        break;
                    case 'C':   //密码
                        $rowname='pwd';
                        $value= md5($old_val);
                    
                        break;
                    case 'D':   //性别
                        $rowname='sex';
                        if(trim(strtolower($old_val))=='男' || trim(strtolower($old_val))=='male'){
                            $value=1;
                        }else{
                            $value=0;
                        }
        
                        break;
                    case 'E':   //昵称
                        $rowname='nickname';
                       $value=$old_val;
        
                        break;
                    
                     case 'F':   //手机号
                        $rowname='tel';
                       $value=$old_val;
        
                        break;
                     case 'G':   //邮箱
                        $rowname='email';
                       $value=$old_val;
        
                        break;
                     case 'H':   //公司
                        $rowname='company';
                        if(is_array($companylist)){
                            foreach ($companylist as $kk => $vv) {
                                
                                if(trim(strtolower($vv['name']))==trim(strtolower($old_val))){
                                  $value=$vv['id'];
                                }
                            }
                            if(empty($value)){
                               $error=1; 
                            }
                        }
                       
        
                        break;
                     case 'I':   //地址
                        $rowname='area';
                       $value=$old_val;
        
                        break;
                     case 'J':   //通知语言
                        $rowname='language';
                         
                        if(trim(strtolower($old_val))=='english' || trim(strtolower($old_val))=='英语'){
                            $value=3;
                        }else{
                            $value=1;
                        }
                    
                        break;
                    case 'K':   //生日
                        $rowname='birthday';
                       $value=$old_val;
        
                        break;
                    case 'L':   //保单开始日期
                        $rowname='start_time';
                       $value=$old_val;
        
                        break;
                    case 'M':   //保单结束日期
                        $rowname='stop_time';
                       $value=$old_val;
        
                        break;
                    case 'N':   //保单号
                        $rowname='policy';
                       $value=$old_val;
        
                        break;
                    case 'O':   //证件类型
                        $rowname='idtype';
                        foreach (CompanyLogic::getInstance()->getIdType() as $kk => $vv) {
                            if($vv['value']==$old_val){
                                $value=$vv['name'];
                            }
                        }
                       
        
                        break;
                    case 'P':   //证件号
                        $rowname='idnumber';
                       $value=$old_val;
        
                        break;
                    case 'Q':   //保单变更信息
                        $rowname='change_content';
                       $value=$old_val;
        
                        break;
                    
                   
                }
                if(!empty($rowname)){
                   $data[$currentRow][$rowname]=$value;
                   
                }
                $rowname=''; 
                $value='';
                
                //读取到的数据，保存到数组$arr中
                //$data[$currentRow][$currentColumn] = $currentSheet->getCell($address)->getValue();
            }
           
         if($data[$currentRow]['sex']){
                $data[$currentRow]['avatar']='/static/laychat/common/images/moren.png';
                }else{
                $data[$currentRow]['avatar']='/static/laychat/common/images/moren1.png';
           }
         
           //验证
           if(!$this->UserValidate($data[$currentRow]) || $error==1){
                 
                
                 $errdata[]=$currentSheet->getCell('A'.$currentRow)->getValue();
                 unset($data[$currentRow]);
             }
             
        }
          
          
       
        @unlink ( $dirname ); //删除上传的文件
       
        if($data){
            $result=ChatUserModel::getInstance()->saveAll($data); 
            if(!$result){
             
      
             echo 'Upload error!';
             exit;
         }
         
       
        }
       
        if(!empty($errdata)){
             $str=implode(',', $errdata);
            echo '<br/>upload completed! The error data are: serial number is '.$str.'!';
        }else{
            echo '<br/>upload completed! No error data!';
        }
          
        
         
        
        exit;
    }
    
    public function UserValidate($data,$type=2){
          
        $result = ChatUserModel::getInstance()->validate(
                    $data,
                    [
                    'user_name' => 'require',
                    'nickname' => 'require',
                    'pwd' => 'require',
                    'tel' => 'require',
                    'email'=>'require',
                    'company'=>'require'
                    ]);
        
        if($type==1){
            $usermsg='用户名已存在';
            $telmsg='手机号已存在';
            $emailmsg='邮箱已存在';
        }else{
           $usermsg='Username already exists.';
            $telmsg='Phone number already exists.';
            $emailmsg='E-mail already exists.'; 
        }
      
        if($result){
              //检测用户名重复
           $where=[
                 
               [
                   'where'=>['user_name'=>$data['user_name']],
                   'msg'=>$usermsg
               ],
               [
                   'where'=>['tel'=>$data['tel']],
                   'msg'=>$telmsg
               ],
               [
                   'where'=>['email'=>$data['email']],
                   'msg'=>$emailmsg
               ]
         
           ];
           
           if(is_array($where)){
               foreach ($where as $key => $value) {
                   $rr= $this->IsOnly($value['where']);
                   if(!$rr){
                       return false;
                   }
               }
              }
             
        }
        return $result;
    }
    public function read($filename,$encode='utf-8'){
		$objReader = \PHPExcel_IOFactory::createReader('Excel5');
		$objReader->setReadDataOnly(true);
		$objPHPExcel = $objReader->load($filename);
		$objWorksheet = $objPHPExcel->getActiveSheet();
		$highestRow = $objWorksheet->getHighestRow();
		$highestColumn = $objWorksheet->getHighestColumn();
		$highestColumnIndex = \PHPExcel_Cell::columnIndexFromString($highestColumn);
		$excelData = array();
		for ($row = 1; $row <= $highestRow; $row++) {
			for ($col = 0; $col < $highestColumnIndex; $col++) {
				$excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
			}
		}
		return $excelData;
	}
        
        
                  /**
     * 查询某条件下用户数据(无关联数据)
     *
     * @return array
     */
    
    public function getUserlist($where=null,$type=0) {
       $where['delete_time']=0;   
        if($type){
           $list=ChatUserModel::getInstance()->where($where)->find();  
        }else{
            $list=ChatUserModel::getInstance()->where($where)->select();  
        }
       
      
       
      return $list;
    }
                      /**
     * 查询某条件下用户数据(包含关联数据)
     *
     * @return array
     */
    
    public function getUsers($where=null,$type=0,$fileds='') {
       $user_alias= ChatUserModel::getInstance()->alias_name;//chatuser表别名
       $company_alias= CompanyModel::getInstance()->alias_name;  //公司别名
       $where[$user_alias.'.delete_time']=0;   
        if($type){
           $list=ChatUserModel::getInstance()->getUserlist($where)->find();  
        }else{
            $list=ChatUserModel::getInstance()->getUserlist($where)->select();  
        }
       
      
       
      return $list;
    }
                          /**
     * 查询某条件下用户数据(包含关联数据)
     *
     * @return array
     */
    
    public function getUsersAll($where=null,$type=0,$fileds='') {
       $user_alias= ChatUserModel::getInstance()->alias_name;//chatuser表别名
       $company_alias= CompanyModel::getInstance()->alias_name;  //公司别名
//       $where[$user_alias.'.delete_time']=0;   
        if($type){
           $list=ChatUserModel::getInstance()->getUserlist($where)->find();  
        }else{
            $list=ChatUserModel::getInstance()->getUserlist($where)->select();  
        }
       
      
       
      return $list;
    }
                       /**
     * 查询某条件下有效用户id
     *
     * @return array
     */
    
       public function getUserId($where=null) {
        $user_alias= ChatUserModel::getInstance()->alias_name;//chatuser表别名
        $where[$user_alias.'.delete_time']=0;                
            
        $id=ChatUserModel::getInstance()->alias($user_alias)->where($where)->value('id'); 
        return $id;
       }
       
   /**
     * 新增或修改科室组
     *
     * @param array $data            
     * @param array $ks_arr                     
     *
     * @return integer
     */
    public function joinks($id, $ks_arr = [])
    {
        
         
            
            // 关联监听
            $this->attachKs($id, $ks_arr);
            
         
       
    }


    /**
     * 关联科室组
     *
     * @param integer $id           
     * @param array $ks_arr          
     *
     * @return void
     */
    public function attachKs($id, $ks_arr = [])
    {
        is_array($ks_arr) || $ks_arr = array_filter(explode(',', $ks_arr));
        
        // 保存关联
        $user= ChatUserModel::get($id);
        $user->ksarr()->detach();
        if(!empty($ks_arr)){
            return  $user->ksarr()->attach($ks_arr);
        }
       
    }
    
       /**
     * 新增或修改擅长语言组
     *
     * @param array $data            
     * @param array $lang_arr                     
     *
     * 
     */
    public function joinlang($id, $lang_arr = [])
    {
        
         
            
            // 关联监听
            $this->attachLang($id, $lang_arr);
            
         
       
    }


    /**
     * 关联科室组
     *
     * @param integer $id           
     * @param array $ks_arr          
     *
     * @return void
     */
    public function attachLang($id, $lang_arr = [])
    {
        is_array($lang_arr) || $lang_arr = array_filter(explode(',', $lang_arr));
        
        // 保存关联
        $user= ChatUserModel::get($id);
        $user->langarr()->detach();
        if(!empty($lang_arr)){
            return  $user->langarr()->attach($lang_arr);
        }
       
    }
    
    /*
     * 获取有效的casemanager列表详细信息
     */
    
    public function getCasemanager($where=null,$order='') {
       $manage=UserModel::getInstance()->alias_name; //管理员表别名
       $user=ChatUserModel::getInstance()->alias_name; //用户表别名
       $where[$manage.'.user_gid']=config('am_casemanage');
       $where[$manage.'.delete_time']=0;
       $where[$user.'.delete_time']=0;
       $where[$user.'.u_status']=1;
       $list=ChatUserModel::getInstance()->getCmlist($where,$order);
       return $list;
    }
    
    
  
    
}