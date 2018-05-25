<?php
namespace app\allianzchina\controller;

use think\Config;
use cms\Controller;

class Index extends Controller
{
   
    /**
     * 首页
     *
     * @return string
     */
    public function index()
    {
        
        $this->redirect('http://allianzchina.advance-medical.com.cn/');
        
       
    }
    

}
 