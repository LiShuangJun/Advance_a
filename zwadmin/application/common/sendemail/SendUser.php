<?php
namespace app\common\sendemail;
use email\Cs;
use core\cases\logic\ChatUserLogic;
use think\Queue;
use core\cases\logic\CompanyLogic;
class SendUser
{
    
    /*
     * AM应用的layim用户表添加
     */
    public function addSend($user=[],$type=1){
        //调用email接口方法
	    $emails = new Cs();
		
		//为1请求发送邮件
		$to = $user['email'];
		
            if(!isset($user['policy'])){
                $user['policy']='xxxxxx';
            }
    
              if($type==1){
                  
                  	//邮件主题
                   if(isset($user['company'])&& !empty($user['company'])){
                       $map=[
                           'id'=>$user['company']
                       ];
                       $comdata=CompanyLogic::getInstance()->getCompanyList($map, 1);
                       $allow= explode(',', $comdata['allow_casetype']);
                       if(!empty($allow)){
                           foreach ($allow as $key => $value) {
                               $casetype=db('cases_case_type')->where(['id'=>$value])->find();
                               $typename[]=$casetype['typename'];
                               $typeename[]=$casetype['typeename'];
                           }
                          $user['typename']=implode('和', $typename);
                          $user['typeename']=implode(' and ', $typeename);

                       }
                       $comdata['url']=explode(',',$comdata['url']);
                       $user['url']=implode('和',$comdata['url']);
                       $user['eurl']=implode(' and ',$comdata['url']);
                       //公司名称
                       $user['companyname']=$comdata['name'];
                   }
                  $is='user';
              }else{
                  
                  $is='manager';
              }
                  if(empty($user['url'])){
                      $url=$_SERVER['HTTP_HOST'];
                      $user['url']=$url;
                  }
                //查询添加用户邮件内容
                //先查询该公司是否针对添加用户业务单独设置了邮件内容
                  isset($user['language']) || $user['language']=1;
                 $where=[
                     'company'=>$user['company'],
                     'type'=>1 ,  //1代表着添加用户业务
                     'lang'=>$user['language']
                 ];
                $clist=db('cases_email_tcontent')->where($where)->find();
                if(empty($clist)){   //若为设置，则用默认
                    $where=[
                     'company'=>0,
                     'type'=>1,   //1代表着添加用户业务  
                     'lang'=>$user['language']
                    ];
                  $clist=db('cases_email_tcontent')->where($where)->find();
                }
                $cmap=[
                    'id'=>$clist['content']
                ];
                $clist=db('cases_email_content')->where($cmap)->find();
                isset($user['policy']) || $user['policy']='';
                eval('$YouxiangContent='.$clist['content'].';');
//		$YouxiangContent=ChatUserLogic::getInstance()->getLanguage($user,2); //获取邮件内容
                $email_data['to']=$to;
                $email_data['title']=$YouxiangContent['title'];
                $email_data['sendperson']=$YouxiangContent['short_title'];
                $email_data['content']=$YouxiangContent['content'][$is];
                //加入任务队列中
                Queue::push('app\common\jobs\QueueClient@sendMAIL', $email_data, $queue ='jobs');
		//$emailtrue = $emails->activeEmail($to,$YouxiangContent['title'],$YouxiangContent['content'][$is],$email_data['sendperson']);
               
               //查询是否需要给其他邮箱发送邮件内容
               $omap=[
                   'cce.c_id'=>$user['company'],
                   'cce.type'=>1,//添加用户业务表示
               ];
               $list=db('cases_company_email')->alias('cce')
                       ->join(config('database.prefix').'cases_email_content cec','cce.casecontent=cec.id','left')
                       ->field('cce.email,cec.content')
                       ->where($omap)->select();
               $data=$user;
               if(!empty($list)){
                   foreach ($list as $key => $value) {
                        $content=[];
                        $email_data=[];
                        eval('$content='.$value['content'].';');
                        $email_data['to']=$value['email'];
                        $email_data['title']=$content['title'];
                        $email_data['sendperson']=$content['short_title'];
                        $email_data['content']=$content['content'];
                         //加入任务队列中
                        Queue::push('app\common\jobs\QueueClient@sendMAIL', $email_data, $queue ='jobs');
                       // $emailtrue = $emails->activeEmail($email_data['to'],$email_data['title'],$email_data['content'],$email_data['sendperson']);
                   }
               }
    }
        /*
     * AM应用的layim用户表修改密码
     */
    public function editSend($user=[]){
        //调用email接口方法
	    $emails = new Cs();
		
		//为1请求发送邮件
		$to = $user['email'];
		//邮件主题
       if(isset($user['company'])&& !empty($user['company'])){
           $map=[
               'id'=>$user['company']
           ];
           $comdata=CompanyLogic::getInstance()->getCompanyList($map, 1);
           
           $user['url']=$comdata['url'];
           $allow= explode(',', $comdata['allow_casetype']);
                       if(!empty($allow)){
                           foreach ($allow as $key => $value) {
                               $casetype=db('cases_case_type')->where(['id'=>$value])->find();
                               $typename[]=$casetype['typename'];
                               $typeename[]=$casetype['typeename'];
                           }
                           
                           $comdata['kfemail']=explode(',',$comdata['kfemail']);
                           foreach ($comdata['kfemail'] as $key => $value) {
                               $footstr[]="“".$typename[$key]."”服务专属邮箱".$comdata['kfemail'][$key];
                               $efootstr[]=$typeename[$key]." Opinion services at ".$comdata['kfemail'][$key];
                               $tfootstr[]=$typeename[$key]." ของ แอดวานซ์ เมดิคอล ที่ ".$comdata['kfemail'][$key];
                           }
                          
                          $user['footstr']=implode(',', $footstr);
                          $user['efootstr']=implode(' , ', $efootstr);
                          $user['tfootstr']= implode(',', $tfootstr);
                       }
                     
       }
      if(empty($user['url'])){
          $url=$_SERVER['HTTP_HOST'];
          $user['url']=$url;
      }
		//邮件主题
        
	$YouxiangContent=ChatUserLogic::getInstance()->getLanguage($user,3); //获取邮件内容
		$email_data['to']=$to;
                $email_data['title']=$YouxiangContent['title'];
                $email_data['content']=$YouxiangContent['content'];
                $email_data['sendperson']=$YouxiangContent['short_title'];
                //加入任务队列中
              Queue::push('app\common\jobs\QueueClient@sendMAIL', $email_data, $queue ='jobs');
             
		//$emailtrue = $emails->activeEmail($to,$YouxiangContent['title'],$YouxiangContent['content'],$email_data['sendperson']);
    }
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
    /*
     * am应用layim的casemanger接受case
     */
       public function acceptCase($user=[]){
        //调用email接口方法
//	    $emails = new Cs();
		
		//为1请求发送邮件
		$to = $user['email'];
	$url='http://'.$_SERVER['HTTP_HOST'];
        $user['url']=$url;
		//邮件主题
        
	$YouxiangContent=ChatUserLogic::getInstance()->getLanguage($user,6); //获取邮件内容
		$email_data['to']=$to;
                $email_data['title']=$YouxiangContent['title'];
                $email_data['content']=$YouxiangContent['content'];
                $email_data['sendperson']=$YouxiangContent['short_title'];
                //加入任务队列中
                Queue::push('app\common\jobs\QueueClient@sendMAIL', $email_data, $queue ='jobs');
		//$emailtrue = $emails->activeEmail($to,$YouxiangContent['title'],$YouxiangContent['content']);
    }
    
    
    
    
    //预约邮件
    public function yuyueemail($to,$title,$content){
      
               $email_data['to']=$to;
                $email_data['title']=$title;
                $email_data['content']=$content;
                $email_data['sendperson']=$YouxiangContent['short_title'];
                //加入任务队列中
                Queue::push('app\common\jobs\QueueClient@sendMAIL', $email_data, $queue ='jobs');
        //$emails->activeEmail($to,$subject,$body,$receivingparty);
    }
}



