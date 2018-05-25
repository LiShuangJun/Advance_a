<?php
namespace app\edm\controller;

use think\Config;
use cms\Controller;
use cms\Response;
use app\manage\service\ViewService;
use app\common\App;
use think\Request;
use email\Cs;

class Index extends Controller
{
    /**
     * 网站标题
     *
     * @var unknown
     */
    protected $siteTitle;
    
    public function index($date='20180320',$lang='eng',$page='1') {
        $this->siteTitle='Document';
        
        return $this->fetch('index/'.$date.'/'.$lang.'/'.$page);
    }
    
    /*
     * 发送邮件测试（中文版）
     * 
     */
    public function sendemail() {
         //调用email接口方法
        $aa=file_get_contents('static/edm/chn/index.html');
      
        $emails = new Cs();
        $emails->activeEmail('972270516@qq.com', '发送网页测试邮件(中文版)', $aa, '测试邮件(中文版)');
       exit;
        
        
    }
        /*
     * 发送邮件测试（英文版）
     * 
     */
    public function esendemail() {
         //调用email接口方法
        $aa=file_get_contents('static/edm/eng/index.html');
      
        $emails = new Cs();
        $emails->activeEmail('zhaojing@advance-medical.com.cn', '发送网页测试邮件(英文版)', $aa, '测试邮件(英文版)');
       exit;
        
        
    }
       /**
     *
     * {@inheritdoc}
     *
     * @see Controller::beforeViewRender()
     */
    protected function beforeViewRender()
    {
        // 网站标题
        $this->assign('site_title', $this->siteTitle);
    }

    /**
     *
     * {@inheritdoc}
     *
     * @see Controller::getView()
     */
    protected function getView()
    {
        return ViewService::getSingleton()->getView();
    }
}
 