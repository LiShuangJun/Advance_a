<?php
namespace cms\widget\amazeui\form;

class DateForm extends TextForm
{

    /**
     * fetch
     *
     * @param array $data            
     * @return string
     */
    public static function fetch($data = [])
    {
        if (isset($data['format']) && ! empty($data['format'])) {
            $data['attr'] = 'readonly data-am-datepicker="{format: \'' . $data['format'] . '\'}"';
        } else {
            $data['attr'] = 'readonly data-am-datepicker';
        }
        
        return parent::fetch($data);
    }
}