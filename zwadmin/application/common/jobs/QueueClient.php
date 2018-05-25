<?php
namespace app\common\jobs;
use email\Cs;
use think\queue\Job;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class QueueClient
{
    /**
     * 邮件提醒
     * @param array $data  内容
     * @return 
     */
    public function sendMAIL(Job $job, $data) 
    {
        
        $isJobDone = $this->send($data);       
        if ($isJobDone) {
            //成功删除任务
            $job->delete();
        } else {
            //任务轮询4次后删除
            if ($job->attempts() > 3) {              
                // 第1种处理方式：重新发布任务,该任务延迟10秒后再执行
                //$job->release(10); 
                // 第2种处理方式：原任务的基础上1分钟执行一次并增加尝试次数
                //$job->failed();   
                // 第3种处理方式：删除任务
                $job->delete();  
            }
        }
    }
    /**
     * 根据消息中的数据进行实际的业务处理
     * @param array|mixed    $data     发布任务时自定义的数据
     * @return boolean                 任务执行的结果
     */
    private function send($data) 
    {
        $sendemail = new Cs();
        $result    = $sendemail->activeEmail($data['to'],$data['title'],$data['content'],$data['sendperson']); 
        if ($result) {
            return true;
        } else {
            return false;
        }            
    }
}
