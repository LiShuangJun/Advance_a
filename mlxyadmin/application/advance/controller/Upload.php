<?php
namespace app\advance\controller;

use think\Config;
use think\Request;
use cms\Response;
use cms\Controller;
use cms\upload\validates\AmCaseVaildate;
use cms\upload\processes\CropProcess;
use cms\upload\processes\OrientationProcess;
use app\common\App;
use app\common\factories\FileFactory;
use app\manage\service\EditorService;

class Upload extends Controller
{

    /**
     * 上传文件
     *
     * @param Request $request            
     *
     * @return void
     */
    public function upload(Request $request)
    {
        
        // 图片大小
        $option = [
            'width' => 1920,
            'height' => 1080
        ];
        
        
        // 文件是否存在
        $file = isset($_FILES['upload_file']) ? $_FILES['upload_file'] : null;
        if (empty($file)) {
            $this->error('上传文件不存在');
        }
        
        $result = $this->uploadFile($file, $option);
        
        $this->success('上传成功', '', $result);
    }

  

    /**
     * 上传文件
     *
     * @param array $file            
     * @param array $option            
     *
     * @return array
     */
    protected function uploadFile($file, $option)
    {
        // 上传文件
        $type = is_array($file) ? FileFactory::TYPE_UPLOAD : FileFactory::TYPE_STREAM;
        $upfile = FileFactory::make($type);
        $upfile->load($file);
        
        // 上传对象
        $upload = App::getSingleton()->upload;
        
        // 文件后缀
        $extensions = ['docx','zip','pdf','doc','jpeg','jpg','png'];
        $maxsize='10M';
        if (! empty($extensions)) {
            $option = [
                'extensions' => $extensions,
                'max_size'=>$maxsize
            ];
            $upload->addValidate(new AmCaseVaildate($option));
        }
        
        // 图片重力
        $upload->addProcesser(new OrientationProcess());
        
        // 图片大小
        if (isset($option['width']) || isset($option['height'])) {
            $upload->addProcesser(new CropProcess($option));
        }
        
        // 上传文件
        return $upload->upload($upfile);
    }
}