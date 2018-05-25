<?php
namespace cms\widget\amazeui\form;

use cms\widget\amazeui\Form;

class TextForm extends Form
{

    /**
     * fetch
     *
     * @param array $data            
     * @return string
     */
    public static function fetch($data = [])
    {
        $data = array_merge(self::$form, $data);
        
        $html = '<div class="am-g am-margin-top-sm" '.$data['form_id'].'>';
        if($data['require']){
            $require_str='<span style="color:red;">*</span>';
        }else{
            $require_str='';
        }
        $html .= '<div class="am-u-sm-' . $data['l_sm_num'] . ' am-u-md-' . $data['l_md_num'] . ' am-text-right">' . $require_str.$data['title'] . '</div>';
        $html .= '<div class="am-u-sm-' . $data['r_sm_num'] . ' am-u-md-' . $data['r_md_num'] . ' am-u-end">';
        $html .= '<input type="' . $data['type'] . '" class="am-input-sm ' . $data['class'] . '" name="' . $data['name'] . '" value="' . $data['value'] . '" placeholder="' . $data['holder'] . '" style="' . $data['style'] . '" ' . $data['attr'] . ' />';
        
       
        
      
        $html .= '</div>';
        $html .= '</div>';
        
        return $html;
    }
}