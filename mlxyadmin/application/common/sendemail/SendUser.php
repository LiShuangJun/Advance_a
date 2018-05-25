<?php
namespace app\common\sendemail;
use email\Cs;
use core\cases\logic\ChatUserLogic;
use think\Queue;
class SendUser
{
    
            /*
     * AM应用的layim用户提交case
     */
    public function addCaseSend($user=[]){
      //调用email接口方法
	    $emails = new Cs();
		
		//为1请求发送邮件
		$to = $user['email'];
	$url=$_SERVER['HTTP_HOST'];
        $user['url']=$url;
        $data=$user;
		//邮件主题
        if(isset($data['field'])){
            if($data['field']['country']==1){
                $address=$data['field']['provincename'].'-'.$data['field']['cityname'].'-'.$data['field']['districtname'].'&nbsp;&nbsp;'.$data['field']['address'];
               
            }else{
               $address=$data['field']['e_province'].'&nbsp;&nbsp;'.$data['field']['address']; 
            }
        }
        
         eval('$YouxiangContent='.$data['field']['content'].';');
         
	//$YouxiangContent=ChatUserLogic::getInstance()->getLanguage($user,7); //获取邮件内容
		$email_data['to']=$to;
                $email_data['title']=$YouxiangContent['title'];
                $email_data['content']=$YouxiangContent['content'];
                $email_data['sendperson']=$YouxiangContent['short_title'];
                //加入任务队列中
          Queue::push('app\common\jobs\QueueClient@sendMAIL', $email_data, $queue ='jobs');
                
		//$emailtrue = $emails->activeEmail($to,$YouxiangContent['title'],$YouxiangContent['content'],$email_data['sendperson']);
    }

}



