<?php
namespace cms\widget\amazeui;

abstract class Form
{

    /**
     * 表单配置
     *
     * @var unknown
     */
    protected static $form = [
        'l_sm_num' => 4,
        'l_md_num' => 2,
        'l_class' => '',
        'l_style' => '',
        'l_attr' => '',
        'form_id'=>'',  //新加
        'r_sm_num' => 8,
        'r_md_num' => 7,
        'r_class' => '',
        'r_style' => '',
        'r_attr' => '',
        
        'title' => '0',
        'type' => 'text',
        'rows' => 5,
        'holder' => '',
        'name' => '',
        'value' => '',
        'list' => [],
        'tip' => '',
        
        'class' => '',
        'style' => '',
        'attr' => '',
        'option' => '',
        'inline' => true,
        'require'=>true,
        
        'text_ok' => '确定',
        'text_cancel' => '取消',
        'target' => 'ajax-form'
    ];

    /**
     * fetch
     *
     * @param array $data            
     * @return string
     */
    public static function fetch($data = [])
    {
        return '';
    }
}