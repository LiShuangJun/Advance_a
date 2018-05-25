<?php
namespace app\advance\controller;

use think\Config;
use think\Request;
use cms\Response;
use cms\Controller;
class Download extends Controller
{

    /**
     * 上传文件
     *
     * @param Request $request            
     *
     * @return void
     */
    public function downloadAreaList()
    {
       $file ='http://'.$_SERVER['HTTP_HOST'].'/static/downloadfile/area.sql';
        $filename = 'area.sql';
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header("Content-type:text/html;charset=utf-8");
        header('Content-Disposition: attachment; filename='. $filename);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        readfile($file);
        echo '<script>window.close();</script>';
        exit; 
       
    }

  

}