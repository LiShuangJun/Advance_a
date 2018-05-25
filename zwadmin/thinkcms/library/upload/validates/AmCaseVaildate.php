<?php
namespace cms\upload\validates;

use cms\Common;
use cms\upload\Validate;
use cms\interfaces\FileInterface;
use cms\interfaces\FileValidateInterface;

class AmCaseVaildate extends Validate
{

    /**
     *
     * {@inheritdoc}
     *
     * @see FileValidateInterface::validate()
     */
    public function validate(FileInterface $file)
    {
        // 无配置则不限
        $extensions = $this->getOption('extensions');
        if (empty($extensions)) {
            return true;
        }
     
        // 后缀判断
        if (! in_array($file->getExtension(), $extensions)) {
            $data['msg']='错误后缀文件!';
            echo json_encode($data);exit;
            //throw new \Exception('不允许上传后缀为[' . $file->getExtension() . ']的文件');
        }
          $common = Common::getSingleton();
        
        // 最小值判断
        $minSize = $common->translateBytes($this->getOption('min_size'));
        
        if ($minSize && $file->getSize() < $minSize) {
            $data['msg']='文件小于允许文件上传的最小值[' . $common->formatBytes($minSize) . ']';
            echo json_encode($data);exit;
            //throw new \Exception('文件小于允许文件上传的最小值[' . $common->formatBytes($minSize) . ']');
        }
        
        // 最大值判断
        $maxSize = $common->translateBytes($this->getOption('max_size'));
        if ($maxSize && $file->getSize() > $maxSize) {
            $data['msg']='文件超过允许文件上传的最大值[' . $common->formatBytes($maxSize) . ']';
            echo json_encode($data);exit;
            //throw new \Exception('文件超过允许文件上传的最大值[' . $common->formatBytes($maxSize) . ']');
        }
        
        return true;
    }

}